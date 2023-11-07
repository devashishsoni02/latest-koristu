<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Account\Entities\CreditNote;
use App\Models\Invoice;
use Modules\Account\Entities\AccountUtility;

class CreditNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('account::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($invoice_id)
    {
        if(Auth::user()->can('creditnote create'))
        {
            $invoiceDue = Invoice::where('id', $invoice_id)->first();

            return view('account::creditNote.create', compact('invoiceDue', 'invoice_id'));
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
    public function store(Request $request, $invoice_id)
    {
        if(Auth::user()->can('creditnote create'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'amount' => 'required|numeric',
                                   'date' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $invoiceDue = Invoice::where('id', $invoice_id)->first();
            if($request->amount > $invoiceDue->getDue())
            {
                return redirect()->back()->with('error', 'Maximum ' .currency_format_with_sym($invoiceDue->getDue()) . ' credit limit of this invoice.');
            }
            $invoice = Invoice::where('id', $invoice_id)->first();

            $credit              = new CreditNote();
            $credit->invoice     = $invoice_id;
            $credit->customer    = $invoice->customer_id;
            $credit->date        = $request->date;
            $credit->amount      = $request->amount;
            $credit->description = $request->description;
            $credit->save();

            AccountUtility::updateUserBalance('customer', $invoice->customer_id, $request->amount, 'debit');

            return redirect()->back()->with('success', __('Credit Note successfully created.'));
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
        return view('account::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($invoice_id, $creditNote_id)
    {
        if(Auth::user()->can('creditnote edit'))
        {
            $creditNote = CreditNote::find($creditNote_id);

            return view('account::creditNote.edit', compact('creditNote'));
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
    public function update(Request $request, $invoice_id, $creditNote_id)
    {
        if(Auth::user()->can('creditnote edit'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'amount' => 'required|numeric',
                                   'date' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $invoiceDue = Invoice::where('id', $invoice_id)->first();
            $credit = CreditNote::find($creditNote_id);
            if($request->amount > $invoiceDue->getDue()+$credit->amount)
            {
                return redirect()->back()->with('error', 'Maximum ' .currency_format_with_sym($invoiceDue->getDue()) . ' credit limit of this invoice.');
            }

            AccountUtility::updateUserBalance('customer', $invoiceDue->customer_id, $credit->amount, 'credit');
            $credit->date        = $request->date;
            $credit->amount      = $request->amount;
            $credit->description = $request->description;
            $credit->save();
            AccountUtility::updateUserBalance('customer', $invoiceDue->customer_id, $request->amount, 'debit');

            return redirect()->back()->with('success', __('Credit Note successfully updated.'));
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
    public function destroy($invoice_id, $creditNote_id)
    {
        if(Auth::user()->can('creditnote delete'))
        {
            $creditNote = CreditNote::find($creditNote_id);
            $creditNote->delete();

            AccountUtility::updateUserBalance('customer', $creditNote->customer, $creditNote->amount, 'credit');

            return redirect()->back()->with('success', __('Credit Note successfully deleted.'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
