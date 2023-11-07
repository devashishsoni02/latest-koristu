<?php

namespace Modules\Pos\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pos\Entities\Pos;
use Modules\Pos\Entities\Purchase;
use Modules\Pos\Entities\Warehouse;
use Modules\Pos\Entities\WarehouseProduct;
use Carbon\Carbon;


class ReportController extends Controller
{


    public function yearMonth()
    {

        $month[] = __('January');
        $month[] = __('February');
        $month[] = __('March');
        $month[] = __('April');
        $month[] = __('May');
        $month[] = __('June');
        $month[] = __('July');
        $month[] = __('August');
        $month[] = __('September');
        $month[] = __('October');
        $month[] = __('November');
        $month[] = __('December');

        return $month;
    }
    public function yearList()
    {
        $starting_year = date('Y', strtotime('-5 year'));
        $ending_year   = date('Y');

        foreach(range($ending_year, $starting_year) as $year)
        {
            $years[$year] = $year;
        }

        return $years;
    }

    public function warehouseReport()
    {
        if(\Auth::user()->can('report warehouse'))
        {
            $warehouse = Warehouse::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get();
            $totalWarehouse = Warehouse::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->count();
            $totalProduct = WarehouseProduct::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->count();
            $warehousename = [];
            $warehouseProductData =[];
            foreach ($warehouse as $warehouse_data)
            {
                $warehouseGet = WarehouseProduct::where('created_by', '=', creatorId())
                            ->where('workspace',getActiveWorkSpace())
                            ->where('warehouse_id', $warehouse_data->id)
                            ->count();
                $warehousename[] = $warehouse_data->name;
                $warehouseProductData[] = $warehouseGet;
            }

            return view('pos::report.warehouse',compact('warehouse','totalWarehouse','totalProduct','warehouseProductData','warehousename'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function purchaseDailyReport(Request $request)
    {

        if(\Auth::user()->can('report purchase'))
        {
            $warehouse     = Warehouse::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');
            $warehouse->prepend('All Warehouse',0);
            $query = Purchase::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace());

            if(module_is_active('Account'))
            {
                $vendor     =  User::where('type','vendor')->where('created_by', creatorId())->where('workspace_id',getActiveWorkSpace())->get()->pluck('name', 'id');
            }
            else{
                $vendor = $query->where('vender_id', '=', NULL)->where('created_by', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('vender_name', 'id');
            }

            $vendor->prepend('All Vendor', 0);

            if(!empty($request->warehouse))
            {
                $query->where('warehouse_id', '=', $request->warehouse);
            }
            if(!empty($request->vendor) && module_is_active('Account'))
            {
                $query->where('vender_id', '=', $request->vendor);
            }
            else{
                $query->where('vender_id', '=', NULL);
            }
            $arrDuration = [];
            $data=[];
            if(!empty($request->start_date) && !empty($request->end_date))
            {
                $first_date=$request->start_date;
                $end_date=$request->end_date;
            }
            else
            {
                $first_date=date('Y-m-d', strtotime('today - 30 days'));
                $end_date=date('Y-m-d', strtotime('today - 1 days'));
            }

            $query->whereBetween('purchase_date', [$first_date, $end_date]);

            $purchases = $query->get()->groupBy(
                function ($val) {

                    return Carbon::parse($val->purchase_date)->format('Y-m-d');
                });


            $total = [];

            if (!empty($purchases) && count($purchases) > 0) {
                foreach ($purchases as $day => $onepurchase) {
                    $totals = 0;
                    foreach ($onepurchase as $purchase) {
                        $totals += $purchase->getTotal();
                    }
                    $total[$day] = $totals;
                }
            }
            $previous_days = strtotime("-1 month +1 days");
            for($i = 0; $i < 30; $i++)
            {
                $previous_days = strtotime(date('Y-m-d', $previous_days) . " +1 day");
                $arrDuration[] = date('d-M', $previous_days);
                $date=date('Y-m-d', $previous_days);
                $data[]=isset($total[$date])?$total[$date]:0;
            }

            $filter['startDate'] =  $first_date;
            $filter['endDate']   =  $end_date;
            $warehouses = Warehouse::where('id', '=', $request->warehouse)->where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->first();
            $filter['warehouse']       = !empty($warehouses)?$warehouses->name:'';

            if(module_is_active('Account'))
            {
                $vendors                =  User::where('type','vendor')->where('id', '=', $request->vendor)->where('created_by', creatorId())->where('workspace_id',getActiveWorkSpace())->first();
                $filter['vendor']       = !empty($vendors)?$vendors->name:'';
            }
            else{
                $filter['vendor']       = !empty($purchase)?$purchase->vender_name:'';
            }


            return view('pos::report.daily_purchase',compact('warehouse','vendor','arrDuration','data','filter'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }


    public function purchaseMonthlyReport(Request $request)
    {
        if(\Auth::user()->can('report purchase'))
        {
            $monthList = $this->yearMonth();
            $yearList = $this->yearList();
            $warehouse     = Warehouse::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');
            $warehouse->prepend('All Warehouse',0);
            $query = Purchase::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace());

            if(module_is_active('Account'))
            {
                $vendor     =  User::where('type','vendor')->where('created_by', creatorId())->where('workspace_id',getActiveWorkSpace())->get()->pluck('name', 'id');
            }
            else{
                $vendor = $query->where('vender_id', '=', NULL)->where('created_by', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('vender_name', 'id');
            }
            $vendor->prepend('All Vendor', 0);

            if(!empty($request->warehouse))
            {
                $query->where('warehouse_id', '=', $request->warehouse);
            }
            if(!empty($request->vendor) && module_is_active('Account'))
            {
                $query->where('vender_id', '=', $request->vendor);
            }
            else{
                $query->where('vender_id', '=', NULL);
            }

            $arrDuration = [];
            if(!empty($request->year))
            {
                $year= $request->year;
            }
            else
            {
                $year=date('Y');
            }

            $query->whereYear('purchase_date', $year);
            $purchases = $query->get()->groupBy(
                function ($val) {
                    return Carbon::parse($val->purchase_date)->format('m');
                });

            $total = [];
            if (!empty($purchases) && count($purchases) > 0) {
                foreach ($purchases as $month => $onepurchase) {
                    $totals = 0;
                    foreach ($onepurchase as $purchase) {
                        $totals += $purchase->getTotal();
                    }
                    $total[$month] = $totals;
                }
            }

            $data=[];
            for($i = 1; $i <= 12; $i++)
            {
                $dateFormat=date('Y-'.$i.'-01');
                $arrDuration[] = date("my", strtotime($dateFormat));
                $month1=date("m", strtotime($dateFormat));
                $data[]=isset($total[$month1])?$total[$month1]:0;
            }


            $filter['startMonth'] = 'Jan-' . $year;
            $filter['endMonth']   = 'Dec-' . $year;
            $warehouses = warehouse::where('id', '=', $request->warehouse)->where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->first();
            $filter['warehouse']       = !empty($warehouses)?$warehouses->name:'';

            if(module_is_active('Account'))
            {
                $vendors     =  User::where('type','vendor')->where('id', '=', $request->vendor)->where('created_by', creatorId())->where('workspace_id',getActiveWorkSpace())->first();
                $filter['vendor']       = !empty($vendors)?$vendors->name:'';
            }
            else{
                $filter['vendor']       = !empty($purchase)?$purchase->vender_name:'';
            }

            return view('pos::report.monthly_purchase',compact('monthList','yearList','warehouse','vendor','arrDuration','data','filter'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function posDailyReport(Request $request)
    {

        if(\Auth::user()->can('report pos'))
        {
            $warehouse     = Warehouse::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace())->get()->pluck('name', 'id');
            $warehouse->prepend('All Warehouse',0);

            $query = Pos::where('created_by', '=', creatorId())->where('workspace',getActiveWorkSpace());

            $customer     =  User::where('type','client')->where('created_by', creatorId())->where('workspace_id',getActiveWorkSpace())->get()->pluck('name', 'id');
            $customer->prepend('All Customer', 0);

            if(!empty($request->warehouse))
            {
                $query->where('warehouse_id', '=', $request->warehouse);
            }
            if(!empty($request->customer))
            {
                $query->where('customer_id', '=', $request->customer);
            }

            $arrDuration = [];
            $data=[];
            if(!empty($request->start_date) && !empty($request->end_date))
            {
                $first_date=$request->start_date;
                $end_date=$request->end_date;
            }
            else
            {
                $first_date=date('Y-m-d', strtotime('today - 30 days'));
                $end_date=date('Y-m-d', strtotime('today - 1 days'));

            }
            $query->whereBetween('pos_date', [$first_date, $end_date]);
            $poses = $query->get()->groupBy(
                function ($val) {
                    return Carbon::parse($val->pos_date)->format('Y-m-d');
                });
            $total = [];
            if (!empty($poses) && count($poses) > 0) {
                foreach ($poses as $day => $onepos) {
                    $totals = 0;
                    foreach ($onepos as $pos) {

                        $totals += $pos->getTotal();
                    }
                    $total[$day] = $totals;
                }
            }
            $previous_days = strtotime("-1 month +1 days");
            for($i = 0; $i < 30; $i++)
            {
                $previous_days = strtotime(date('Y-m-d', $previous_days) . " +1 day");
                $arrDuration[] = date('d-M', $previous_days);
                $date=date('Y-m-d', $previous_days);
                $data[]=isset($total[$date])?$total[$date]:0;
            }


            $filter['startDate'] =  $first_date;
            $filter['endDate']   =  $end_date;
            $warehouses = warehouse::where('id', '=', $request->warehouse)->where('created_by', creatorId())->first();
            $filter['warehouse']       = !empty($warehouses)?$warehouses->name:'';
            $customers     =  User::where('type','client')->where('id', '=', $request->customer)->where('created_by', creatorId())->where('workspace_id',getActiveWorkSpace())->first();
            $filter['customer']       = !empty($customers)?$customers->name:'';

            return view('pos::report.daily_pos',compact('warehouse','customer','arrDuration','data','filter'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function posMonthlyReport(Request $request)
    {
        if(\Auth::user()->can('report pos'))
        {
            $monthList = $this->yearMonth();
            $yearList = $this->yearList();

            $warehouse     = warehouse::where('created_by', creatorId())->get()->pluck('name', 'id');
            $warehouse->prepend('All Warehouse',0);


            $customer     =  User::where('type','client')->where('created_by', creatorId())->where('workspace_id',getActiveWorkSpace())->get()->pluck('name', 'id');
            $customer->prepend('All Customer', 0);

            $query = Pos::where('created_by', '=', creatorId());
            if(!empty($request->warehouse))
            {
                $query->where('warehouse_id', '=', $request->warehouse);
            }
            if(!empty($request->customer))
            {
                $query->where('customer_id', '=', $request->customer);
            }
            $arrDuration = [];
            $data=[];
            if(!empty($request->year))
            {
                $year= $request->year;
            }
            else
            {
                $year=date('Y');
            }
            $query->whereYear('pos_date', $year);
            $poses = $query->get()->groupBy(
                function ($val) {
                    return Carbon::parse($val->pos_date)->format('m');
                });
            $total = [];
            if (!empty($poses) && count($poses) > 0) {
                foreach ($poses as $month => $onepos) {
                    $totals = 0;
                    foreach ($onepos as $pos) {
                        $totals += $pos->getTotal();
                    }
                    $total[$month] = $totals;
                }
            }
            for($i = 1; $i <= 12; $i++)
            {

                $dateFormat=date('Y-'.$i.'-01');
                $arrDuration[] = date("my", strtotime($dateFormat));
                $month1=date("m", strtotime($dateFormat));
                $data[]=isset($total[$month1])?$total[$month1]:0;

            }



            $filter['startMonth'] = 'Jan-' . $year;
            $filter['endMonth']   = 'Dec-' . $year;
            $warehouses = warehouse::where('id', '=', $request->warehouse)->where('created_by', creatorId())->first();
            $filter['warehouse']       = !empty($warehouses)?$warehouses->name:'';
            $customers     =  User::where('type','client')->where('id', '=', $request->customer)->where('created_by', creatorId())->where('workspace_id',getActiveWorkSpace())->first();
            $filter['customer']       = !empty($customers)?$customers->name:'';

            return view('pos::report.monthly_pos',compact('monthList','yearList','warehouse','customer','arrDuration','data','filter'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function posVsPurchaseReport(Request $request)
    {
        if(\Auth::user()->can('report pos'))
        {
            $data['monthList'] = $month = $this->yearMonth();
            $data['yearList']  = $this->yearList();

            if(isset($request->year))
            {
                $year = $request->year;
            }
            else
            {
                $year = date('Y');
            }
            $data['currentYear'] = $year;


            // ------------------------------TOTAL POS-----------------------------------------------------------

            $posData = Pos:: selectRaw('MONTH(pos_date) as month,YEAR(pos_date) as year,pos_id,id')
                ->where('created_by', creatorId());
            $posData->whereRAW('YEAR(pos_date) =?', [$year]);

            $posData        = $posData->get();
            $posTotalArray = [];
            foreach($posData as $pos)
            {
                $posTotalArray[$pos->month] = $pos->getTotal();
            }


            // ------------------------------ TOTAL PAYMENT-----------------------------------------------------------
            $purchaseData = Purchase:: selectRaw('MONTH(send_date) as month,YEAR(send_date) as year,purchase_id,id')
                ->where('created_by', creatorId())
                ->where('status', '!=', 0);
            $purchaseData->whereRAW('YEAR(send_date) =?', [$year]);
            $purchaseData        = $purchaseData->get();
            $purchaseTotalArray = [];
            foreach($purchaseData as $purchase)
            {
                $purchaseTotalArray[$purchase->month] = $purchase->getTotal();
            }

//            -----------------------------

            for($i = 1; $i <= 12; $i++)
            {
                $PosTotal[] = array_key_exists($i, $posTotalArray) ? $posTotalArray[$i] : 0;
                $PurchaseTotal[] = array_key_exists($i, $purchaseTotalArray) ? $purchaseTotalArray[$i] : 0;

            }
            $totalPos = array_map(
                function (){
                    return array_sum(func_get_args());
                }, $PosTotal
            );

            $totalPurchase = array_map(
                function (){
                    return array_sum(func_get_args());
                }, $PurchaseTotal
            );


            $profits = [];
            $keys   = array_keys($totalPos + $totalPurchase);
            foreach($keys as $v)
            {
                $profits[$v] = number_format((empty($totalPos[$v]) ? 0 : $totalPos[$v]) - (empty($totalPurchase[$v]) ? 0 : $totalPurchase[$v]), 2);
            }

            $data['posTotal']        = $PosTotal;
            $data['purchaseTotal']        = $PurchaseTotal;
            $data['profits']              = $profits;
            $filter['startDateRange'] = 'Jan-' . $year;
            $filter['endDateRange']   = 'Dec-' . $year;


            return view('pos::report.pos_vs_purchase', compact('filter'),  $data);
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }




}
