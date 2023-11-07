<?php
declare(strict_types=1);

namespace Dcblogdev\Box;

use Dcblogdev\Box\Resources\Folders;
use Dcblogdev\Box\Resources\Files;
use Dcblogdev\Box\Models\BoxToken;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Exception;
use Rawilk\Settings\Support\Context;


class Box
{
    public function files(): object
    {
        return new Files();
    }

    public function folders(): object 
    {
        return new Folders();
    }

    protected $baseUrl = 'https://api.box.com/2.0/';

    public function __call($function, $args): ?array
    {
        $options = ['get', 'post', 'patch', 'put', 'delete'];
        $path = (isset($args[0])) ? $args[0] : null;
        $data = (isset($args[1])) ? $args[1] : null;

        if (in_array($function, $options)) {
            return $this->guzzle($function, $path, $data);
        } else {
            //request verb is not in the $options array
            throw new Exception($function.' is not a valid HTTP Verb');
        }
    }

    public function connect(): redirect
    {      
        session()->put('box_auth_back_url' , \URL::previous());

        if (! request()->has('code')) {
            //redirect to box
            $url = config('box.urlAuthorize') . '?' . http_build_query([
                'response_type' => 'code',
                'client_id' => company_setting('box_client_id'),
                'redirect_uri' => url('box/oauth')
            ]);

            return $this->redirect($url);

        } elseif (request()->has('code')) {
            $params = [
                'grant_type' => 'authorization_code',
                'code' => request('code'),
                'client_id' => company_setting('box_client_id'),
                'client_secret' => company_setting('box_client_secret')
            ];

            $token = $this->dopost(config('box.urlAccessToken'), $params);

            $this->storeToken($token->access_token, $token->refresh_token, $token->expires_in , $token);

            return $this->redirect(\Session::get('box_auth_back_url'));
        }

    }

    public function getAccessToken()
    {
        // $token = BoxToken::where('user_id', auth()->id())->first();
        $access_token = company_setting('box_access_token');

        // Check if tokens exist otherwise run the oauth request
        if (! isset($access_token)) {
            return $this->redirect(url('box/oauth'));
        }

        //process token
        return $this->getToken($access_token);
    }

    protected function getToken($token): string
    {
        // Check if token is expired
        // Get current time + 5 minutes (to allow for time differences)
        $now = time() + 300;
        if (company_setting('box_expires') <= $now) {
            // Token is expired (or very close to it) so let's refresh
            $params = [
                'grant_type'    => 'refresh_token',
                'refresh_token' => company_setting('box_refresh_token'),
                'client_id'     => company_setting('box_client_id'),
                'client_secret' => company_setting('box_client_secret')
            ];

            $accessToken = $this->dopost(config('box.urlAccessToken'), $params);

            // Store the new values
            $this->storeToken($accessToken->access_token, $accessToken->refresh_token, $accessToken->expires_in ,$accessToken);

            return $accessToken->access_token;
        } 
        
        // Token is still valid, just return it
        return company_setting('box_tokens_data');
    }

    protected function storeToken($access_token, $refresh_token, $expires, $token=''): void
    {
        $userContext = new Context(['user_id' => \Auth::user()->id,'workspace_id'=>getActiveWorkSpace()]);

        \Settings::context($userContext)->set('box_tokens_data', $token);
        \Settings::context($userContext)->set('box_access_token', $access_token );
        \Settings::context($userContext)->set('box_refresh_token', $refresh_token );
        \Settings::context($userContext)->set('box_expires', $expires );

        //create a new record or if the user id exists update record
        // BoxToken::updateOrCreate(['user_id' => auth()->id()], [
        //     'user_id'       => auth()->id(),
        //     'access_token'  => $access_token,
        //     'expires'       => $expires,
        //     'refresh_token' => $refresh_token
        // ]);

    }

    protected function guzzle($type, $request, $data = [])
    {
        try {
            $client = new Client;

            $response = $client->$type($this->baseUrl.$request, array_merge([
                'headers' => [
                    'Authorization' => 'Bearer '.$this->getAccessToken(),
                    'content-type' => 'application/json',
                ]
            ], empty($data) ? [] : ['body' => json_encode($data)]));

            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            throw new Exception($e->getResponse()->getBody()->getContents());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    protected static function dopost($url, $params)
    {
        try {
            $client = new Client;
            $response = $client->post($url, ['form_params' => $params]);

            return json_decode($response->getBody()->getContents());

        } catch (ClientException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents());
            if ($response->error_description === 'Refresh token has expired') {
                 header('Location: '.url('box/oauth'));
                exit();
            }
            throw new Exception($e->getResponse()->getBody()->getContents());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
	}

    protected function redirect($url): void
    {
        header('Location: '.$url);
        exit();
    }

    public function getFolderSharedLink($folderId): ?array
    {
        
        // Set your Box API credentials and folder ID
        $accessToken = $this->getAccessToken(); // Use the valid access token

        // Initialize Guzzle HTTP client
        $client = new Client();

        // Request data for creating the shared link
        $requestData = [
            'shared_link' => [
                'access' => 'open',
            ]
        ];

        // Make a PUT request to update the folder with the shared link settings
        $response = $client->put("https://api.box.com/2.0/folders/{$folderId}?fields=shared_link", [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
                'Content-Type' => 'application/json',
            ],
            'json' => $requestData
        ]);

        $responseBody = $response->getBody()->getContents();
        return json_decode($responseBody, true);


    }
   
 

}
