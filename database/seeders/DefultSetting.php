<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;
use App\Models\Language;
use App\Models\User;
use Rawilk\Settings\Support\Context;


class DefultSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // currency code

        $currencys = [
            ['Leke', 'ALL', 'Lek'],
            ['Dollars', 'USD', '$'],
            ['Afghanis', 'AFN', '؋'],
            ['Pesos', 'ARS', '$'],
            ['Guilders', 'AWG', 'ƒ'],
            ['Dollars', 'AUD', '$'],
            ['New Manats', 'AZN', 'ман'],
            ['Dollars', 'BSD', '$'],
            ['Dollars', 'BBD', '$'],
            ['Rubles', 'BYR', 'p.'],
            ['Euro', 'EUR', '€'],
            ['Dollars', 'BZD', 'BZ$'],
            ['Dollars', 'BMD', '$'],
            ['Bolivianos', 'BOB', '$b'],
            ['Convertible Marka', 'BAM', 'KM'],
            ['Pula', 'BWP', 'P'],
            ['Leva', 'BGN', 'лв'],
            ['Reais', 'BRL', 'R$'],
            ['Pounds', 'GBP', '£'],
            ['Dollars', 'BND', '$'],
            ['Riels', 'KHR', '៛'],
            ['Dollars', 'CAD', '$'],
            ['Dollars', 'KYD', '$'],
            ['Pesos', 'CLP', '$'],
            ['Yuan Renminbi', 'CNY', '¥'],
            ['Pesos', 'COP', '$'],
            ['Colón', 'CRC', '₡'],
            ['Kuna', 'HRK', 'kn'],
            ['Pesos', 'CUP', '₱'],
            ['Koruny', 'CZK', 'Kč'],
            ['Kroner', 'DKK', 'kr'],
            ['Pesos', 'DOP', 'RD$'],
            ['Dollars', 'XCD', '$'],
            ['Pounds', 'EGP', '£'],
            ['Colones', 'SVC', '$'],
            ['Pounds', 'FKP', '£'],
            ['Dollars', 'FJD', '$'],
            ['Cedis', 'GHC', '¢'],
            ['Pounds', 'GIP', '£'],
            ['Quetzales', 'GTQ', 'Q'],
            ['Pounds', 'GGP', '£'],
            ['Dollars', 'GYD', '$'],
            ['Lempiras', 'HNL', 'L'],
            ['Dollars', 'HKD', '$'],
            ['Forint', 'HUF', 'Ft'],
            ['Kronur', 'ISK', 'kr'],
            ['Rupees', 'INR', 'Rp'],
            ['Rupiahs', 'IDR', 'Rp'],
            ['Rials', 'IRR', '﷼'],
            ['Pounds', 'IMP', '£'],
            ['New Shekels', 'ILS', '₪'],
            ['Dollars', 'JMD', 'J$'],
            ['Yen', 'JPY', '¥'],
            ['Pounds', 'JEP', '£'],
            ['Tenge', 'KZT', 'лв'],
            ['Won', 'KPW', '₩'],
            ['Won', 'KRW', '₩'],
            ['Soms', 'KGS', 'лв'],
            ['Kips', 'LAK', '₭'],
            ['Lati', 'LVL', 'Ls'],
            ['Pounds', 'LBP', '£'],
            ['Dollars', 'LRD', '$'],
            ['Switzerland Francs', 'CHF', 'CHF'],
            ['Litai', 'LTL', 'Lt'],
            ['Denars', 'MKD', 'ден'],
            ['Ringgits', 'MYR', 'RM'],
            ['Rupees', 'MUR', '₨'],
            ['Pesos', 'MXN', '$'],
            ['Tugriks', 'MNT', '₮'],
            ['Meticais', 'MZN', 'MT'],
            ['Dollars', 'NAD', '$'],
            ['Rupees', 'NPR', '₨'],
            ['Guilders', 'ANG', 'ƒ'],
            ['Dollars', 'NZD', '$'],
            ['Cordobas', 'NIO', 'C$'],
            ['Nairas', 'NGN', '₦'],
            ['Krone', 'NOK', 'kr'],
            ['Rials', 'OMR', '﷼'],
            ['Rupees', 'PKR', '₨'],
            ['Balboa', 'PAB', 'B/.'],
            ['Guarani', 'PYG', 'Gs'],
            ['Nuevos Soles', 'PEN', 'S/.'],
            ['Pesos', 'PHP', 'Php'],
            ['Zlotych', 'PLN', 'zł'],
            ['Rials', 'QAR', '﷼'],
            ['New Lei', 'RON', 'lei'],
            ['Rubles', 'RUB', 'руб'],
            ['Pounds', 'SHP', '£'],
            ['Riyals', 'SAR', '﷼'],
            ['Dinars', 'RSD', 'Дин.'],
            ['Rupees', 'SCR', '₨'],
            ['Dollars', 'SGD', '$'],
            ['Dollars', 'SBD', '$'],
            ['Shillings', 'SOS', 'S'],
            ['Rand', 'ZAR', 'R'],
            ['Rupees', 'LKR', '₨'],
            ['Kronor', 'SEK', 'kr'],
            ['Dollars', 'SRD', '$'],
            ['Pounds', 'SYP', '£'],
            ['New Dollars', 'TWD', 'NT$'],
            ['Baht', 'THB', '฿'],
            ['Dollars', 'TTD', 'TT$'],
            ['Lira', 'TRY', '₺'],
            ['Liras', 'TRL', '£'],
            ['Dollars', 'TVD', '$'],
            ['Hryvnia', 'UAH', '₴'],
            ['Pesos', 'UYU', '$U'],
            ['Sums', 'UZS', 'лв'],
            ['Bolivares Fuertes', 'VEF', 'Bs'],
            ['Dong', 'VND', '₫'],
            ['Rials', 'YER', '﷼'],
            ['Zimbabwe Dollars', 'ZWD', 'Z$'],
            ['Bahraini Dinar', 'BHD', '$'],
            ['Turkish lira', 'TL', '₺'],
        ];

        foreach ($currencys as  $currency) {
            $ckeck = Currency::where('code',$currency[1])->first();
            if(empty($ckeck))
            {
                $currency_data       = new Currency();
                $currency_data->name = $currency[0];
                $currency_data->code = $currency[1];
                $currency_data->symbol = $currency[2];
                $currency_data->timestamps = false;
                $currency_data->save();
            }
        }

        // admin settings
            $admin = User::where('type','super admin')->first();
            $admin_setting = [
                "currency_format" => "1",
                "defult_currancy" => "USD",
                "defult_currancy_symbol" => "$",
                "defult_language" => "en",
                "defult_timezone" => "Asia/Kolkata",
                "title_text" => !empty(env('APP_NAME')) ? env('APP_NAME') : 'WorkDo Dash',
                "footer_text" => "Copyright © ".(!empty(env('APP_NAME')) ? env('APP_NAME') : 'WorkDo Dash'),
                "landing_page" => "on",
                "site_rtl" => "off",
                "cust_darklayout" => "off",
                "site_transparent" => "on",
                "signup" => "on",
                "color" => "theme-1",

                // for plan
                "plan_package" => "on",
                "custome_package" => "on",

                'email_verification'=>'on',

                // for cookie
                'enable_cookie'=>'on',
                'necessary_cookies'=>'on',
                'cookie_logging'=>'on',
                'cookie_title'=>'We use cookies!',
                'cookie_description'=>'Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it',
                'strictly_cookie_title'=>'Strictly necessary cookies',
                'strictly_cookie_description'=>'These cookies are essential for the proper functioning of my website. Without these cookies, the website would not work properly',
                'more_information_description'=>'For any queries in relation to our policy on cookies and your choices, please contact us',
                'contactus_url'=>'#',

                // for cookie

                "meta_title" => "WorkDo Dash SaaS - Open Source ERP with Multi-Workspace",
                "meta_keywords" => "WorkDo Dash,SaaS solution,Multi-workspace functionality, Cloud-based access,Scalability,Multi-addons,Collaboration tool,Data management,Business productivity,Operational effectiveness",
                "meta_description" => "Discover the efficiency of Dash, a user-friendly web application by Rajodiya Apps. Streamline project management, organize tasks, collaborate seamlessly, and track progress effortlessly. Boost productivity with Dash's intuitive interface and comprehensive features. Revolutionize your project management process today. Try Dash!",

                "storage_setting" => "local",
                "local_storage_max_upload_size" => "204800",
                "local_storage_validation" => [
                    0 => "jpeg",
                    1 => "jpg",
                    2 => "png",
                    3 => "pdf",
                    4 => "gif",
                    5 => "svg",
                ],
            ];

            $userContext = new Context(['user_id' => $admin->id,'workspace_id'=> 0]);
            foreach($admin_setting as $key =>  $p){
                if(empty(admin_setting($key)))
                {
                    \Settings::context($userContext)->set($key, $p);
                }
            }
        // admin settings End

    }
}
