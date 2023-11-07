<?php

namespace Modules\Pos\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\LandingPage\Entities\MarketplacePageSetting;

class MarketPlaceSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $data['product_main_banner'] = '';
        $data['product_main_status'] = 'on';
        $data['product_main_heading'] = 'POS';
        $data['product_main_description'] = '<p>Spend less time managing your sales and purchases, and more time on actually growing your business. Whether you have 1, 2, or 10 branches, Pos allows you to manage them all from one place.</p>';
        $data['product_main_demo_link'] = '#';
        $data['product_main_demo_button_text'] = 'View Live Demo';
        $data['dedicated_theme_heading'] = '<h2>Manage Your Purchases.</h2>';
        $data['dedicated_theme_description'] = '<p>It is easy to record the purchases of each firm effectively with the help of barcodes. You can also view your purchase records through well-maintained data.POS allows you to keep a tab on the total as well as the monthly amounts of sales and purchases.</p>';
        $data['dedicated_theme_sections'] = '[{"dedicated_theme_section_image":"","dedicated_theme_section_heading":"Ease in maintaining customer and vendor details","dedicated_theme_section_description":"<p>POS allows you to create and maintain the data of each customer and vendor. You get access to all essential information through a well-maintained format.<\/p>","dedicated_theme_section_cards":{"1":{"title":"Manage vital information from one dashboard","description":"Stay on top of your total and monthly purchases and sales. Get an interactive purchase and sales report graph to help you make informed decisions. Get progress reports of each branch, along with to-do lists and event calendars."},"2":{"title":"Set your sales targets and achieve them faster","description":"Create sales targets and keep track of their progress in your dashboard. Use the expense list to cut down on unnecessary expenses, and put more resources into reaching your sales targets."},"3":{"title":"Manage your products with ease","description":"Never stress about managing your inventory ever again! With PosGo, you can create your products and assign them a brand, category, unit and tax rate. You can even modify product descriptions, images, and price whenever you want."}}},{"dedicated_theme_section_image":"","dedicated_theme_section_heading":"Take Control Of Your Purchase and Sales","dedicated_theme_section_description":"<p>Manage all buying and selling activities with one tool. From managing all your products and tracking inventory to managing your branches - POS has everything you need to simplify your organization`s day-to-day tasks.<\/p>","dedicated_theme_section_cards":{"1":{"title":"Record Purchases and Sales","description":"It is easy to record the purchases and sales of each firm effectively with the help of barcodes. You can also view your purchase and sales records through well-maintained data."},"2":{"title":"Comprehensive Dashboard","description":"POS allows you to keep a tab on the total as well as the monthly amounts of sales and purchases. The interactive purchase sales report graph allows you to make informed decisions.  You would receive notifications on the dashboard if products reach the minimum quantity."},"3":{"title":"Get Instant Notifications","description":"Integrate the Twilio app and never miss an important notification again. Get notified when tasks or orders are completed and get notifications about meetings and new orders sent to your mobile phone via text."}}},{"dedicated_theme_section_image":"","dedicated_theme_section_heading":"Oprate a Fast and Easy Pos process","dedicated_theme_section_description":"<p>Make your Pos process fast and convenient for your customers by sending them accurate purchase in record-time. select and add the products your customers want to buy, add notes and assign reference number them, and immediately send email.<\/p>","dedicated_theme_section_cards":{"1":{"title":null,"description":null}}},{"dedicated_theme_section_image":"","dedicated_theme_section_heading":"Take Control Of Your Supply Chain","dedicated_theme_section_description":"<p>You could create your product by assigning brand, category, and unit, and determining tax rate to it. It is easy to create separate listings for each of these modules. This tool allows you to upload product images and descriptions, and fix purchase and selling prices along with Stock Keeping Unit. This tool would solve all your stock mismanagement problems.<\/p>","dedicated_theme_section_cards":{"1":{"title":null,"description":null}}}]';
        $data['dedicated_theme_sections_heading'] = '';
        $data['screenshots'] = '[{"screenshots":"","screenshots_heading":"POS"},{"screenshots":"","screenshots_heading":"POS"},{"screenshots":"","screenshots_heading":"POS"},{"screenshots":"","screenshots_heading":"POS"},{"screenshots":"","screenshots_heading":"POS"}]';
        $data['addon_heading'] = '<h2>Why choose dedicated modules<b> for Your Business?</b></h2>';
        $data['addon_description'] = '<p>With Dash, you can conveniently manage all your business functions from a single location.</p>';
        $data['addon_section_status'] = 'on';
        $data['whychoose_heading'] = 'Why choose dedicated modulesfor Your Business?';
        $data['whychoose_description'] = '<p>With Dash, you can conveniently manage all your business functions from a single location.</p>';
        $data['pricing_plan_heading'] = 'Empower Your Workforce with DASH';
        $data['pricing_plan_description'] = '<p>Access over Premium Add-ons for Accounting, HR, Payments, Leads, Communication, Management, and more, all in one place!</p>';
        $data['pricing_plan_demo_link'] = '#';
        $data['pricing_plan_demo_button_text'] = 'View Live Demo';
        $data['pricing_plan_text'] = '{"1":{"title":"Pay-as-you-go"},"2":{"title":"Unlimited installation"},"3":{"title":"Secure cloud storage"}}';
        $data['whychoose_sections_status'] = 'on';
        $data['dedicated_theme_section_status'] = 'on';

        foreach($data as $key => $value){
            if(!MarketplacePageSetting::where('name', '=', $key)->where('module', '=', 'Pos')->exists()){
                MarketplacePageSetting::updateOrCreate(
                [
                    'name' => $key,
                    'module' => 'Pos'

                ],
                [
                    'value' => $value
                ]);
            }
        }
    }
}
