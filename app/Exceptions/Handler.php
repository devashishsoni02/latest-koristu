<?php

namespace App\Exceptions;

use App\Models\Sidebar;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {

        });
    }
//     public function render($request, Throwable $e)
//     {
//         if(\Auth::check())
//         {
//             $data = Sidebar::GetDashboardRoute();
//             if($data['status'] == true)
//             {
//                 return redirect()->route($data['route'])->with('error',$e->getMessage());
//             }
//             else
//             {
//                 return redirect()->route('home')->with('error',$e->getMessage());
//             }
//         }
//         else
//         {
//             return redirect()->route('login')->with('error',$e->getMessage());
//         }
//     }

}
