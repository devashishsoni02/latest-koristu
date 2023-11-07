<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Account\Entities\BankAccount;
use Modules\Account\Entities\BillPayment;
use App\Models\InvoicePayment;
use Modules\Account\Entities\Payment;
use Modules\Account\Entities\Revenue;
use Modules\Account\Entities\Transaction;
use Modules\Account\Events\CreateBankAccount;
use Modules\Account\Events\DestroyBankAccount;
use Modules\Account\Events\UpdateBankAccount;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(Auth::user()->can('bank account manage'))
        {
            $accounts = BankAccount::where('workspace',getActiveWorkSpace())->get();
            return view('account::bankAccount.index', compact('accounts'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if(Auth::user()->can('bank account create'))
        {

            return view('account::bankAccount.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if(Auth::user()->can('bank account create'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'holder_name' => 'required',
                                   'bank_name' => 'required',
                                   'account_number' => 'required',
                                   'opening_balance' => 'required|gt:0',
                                   'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                                   'bank_address' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->route('bank-account.index')->with('error', $messages->first());
            }
            $account                  = new BankAccount();
            $account->holder_name     = $request->holder_name;
            $account->bank_name       = $request->bank_name;
            $account->account_number  = $request->account_number;
            $account->opening_balance = $request->opening_balance;
            $account->contact_number  = $request->contact_number;
            $account->bank_address    = $request->bank_address;
            $account->workspace       = getActiveWorkSpace();
            $account->created_by      = \Auth::user()->id;
            $account->save();

            event(new CreateBankAccount($request,$account));

            return redirect()->route('bank-account.index')->with('success', __('Account successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(BankAccount $bankAccount)
    {
        if(Auth::user()->can('bank account edit'))
        {
            if($bankAccount->created_by == creatorId() && $bankAccount->workspace == getActiveWorkSpace())
            {

                return view('account::bankAccount.edit', compact('bankAccount'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, BankAccount $bankAccount)
    {
        if(Auth::user()->can('bank account edit'))
        {
            if($bankAccount->created_by == creatorId() && $bankAccount->workspace == getActiveWorkSpace())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                    'holder_name' => 'required',
                                    'bank_name' => 'required',
                                    'account_number' => 'required',
                                    'opening_balance' => 'required|gt:0',
                                    'contact_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                                    'bank_address' => 'required',
                                ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('bank-account.index')->with('error', $messages->first());
                }

                $bankAccount->holder_name     = $request->holder_name;
                $bankAccount->bank_name       = $request->bank_name;
                $bankAccount->account_number  = $request->account_number;
                $bankAccount->opening_balance = $request->opening_balance;
                $bankAccount->contact_number  = $request->contact_number;
                $bankAccount->bank_address    = $request->bank_address;
                $bankAccount->save();
                event(new UpdateBankAccount($request,$bankAccount));

                return redirect()->route('bank-account.index')->with('success', __('Account successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(BankAccount $bankAccount)
    {

        if(Auth::user()->can('bank account delete'))
        {
            if($bankAccount->created_by == creatorId() && $bankAccount->workspace == getActiveWorkSpace())
            {
                $revenue        = Revenue::where('account_id', $bankAccount->id)->first();
                $invoicePayment = InvoicePayment::where('account_id', $bankAccount->id)->first();
                $transaction    = Transaction::where('account', $bankAccount->id)->first();
                $payment        = Payment::where('account_id', $bankAccount->id)->first();
                $billPayment    = BillPayment::first();

                if(!empty($revenue) || !empty($invoicePayment) || !empty($transaction) || !empty($payment) || !empty($billPayment))
                {
                    return redirect()->route('bank-account.index')->with('error', __('Please delete related record of this account.'));
                }
                else
                {
                    event(new DestroyBankAccount($bankAccount));
                    $bankAccount->delete();

                    return redirect()->route('bank-account.index')->with('success', __('Account successfully deleted.'));
                }
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
