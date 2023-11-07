<!DOCTYPE html>
<html lang="en" dir="<?php echo e($settings['site_rtl'] == 'on'?'rtl':''); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(\Modules\Pos\Entities\Purchase::purchaseNumberFormat($purchase->purchase_id,$purchase->created_by,$purchase->workspace)); ?> | <?php echo e(!empty(company_setting('title_text',$purchase->created_by,$purchase->workspace)) ? company_setting('title_text',$purchase->created_by,$purchase->workspace) : (!empty(admin_setting('title_text')) ? admin_setting('title_text') :'WorkDo')); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <style type="text/css">
        html[dir="rtl"]  {
                letter-spacing: 0.1px;
            }
        :root {
            --theme-color: <?php echo e($color); ?>;
            --white: #ffffff;
            --black: #000000;
        }

        body {
            font-family: 'Lato', sans-serif;
        }

        p,
        li,
        ul,
        ol {
            margin: 0;
            padding: 0;
            list-style: none;
            line-height: 1.5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table tr th {
            padding: 0.75rem;
            text-align: left;
        }

        table tr td {
            padding: 0.75rem;
            text-align: left;
        }

        table th small {
            display: block;
            font-size: 12px;
        }

        .invoice-preview-main {
            max-width: 700px;
            width: 100%;
            margin: 0 auto;
            background: #ffff;
            box-shadow: 0 0 10px #ddd;
        }

        .invoice-logo {
            max-width: 200px;
            width: 100%;
        }

        .invoice-header table td {
            padding: 15px 30px;
        }

        .text-right {
            text-align: right;
        }

        .no-space tr td {
            padding: 0;
            white-space: nowrap;
        }

        .vertical-align-top td {
            vertical-align: top;
        }

        .view-qrcode {
            max-width: 139px;
            height: 139px;
            width: 100%;
            margin-left: auto;
            margin-top: 15px;
            background: var(--white);
            padding: 13px;
            border-radius: 10px;
        }

        .view-qrcode img{
            width: 100%;
            height: 100%;
        }

        .invoice-body {
            padding: 30px 25px 0;
        }

        table.add-border tr {
            border-top: 1px solid var(--theme-color);
        }

        tfoot tr:first-of-type {
            border-bottom: 1px solid var(--theme-color);
        }

        .total-table tr:first-of-type td {
            padding-top: 0;
        }

        .total-table tr:first-of-type {
            border-top: 0;
        }

        .sub-total {
            padding-right: 0;
            padding-left: 0;
        }

        .border-0 {
            border: none !important;
        }

        .invoice-summary td,
        .invoice-summary th {
            font-size: 13px;
            font-weight: 600;
        }

        .total-table td:last-of-type {
            width: 146px;
        }

        .invoice-footer {
            padding: 15px 20px;
        }

        .itm-description td {
            padding-top: 0;
        }
        html[dir="rtl"] table tr td,
        html[dir="rtl"] table tr th{
            text-align: right;
        }
        html[dir="rtl"]  .text-right{
            text-align: left;
        }
        html[dir="rtl"] .view-qrcode{
            margin-left: 0;
            margin-right: auto;
        }
        p:not(:last-of-type){
            margin-bottom: 15px;
        }
        .invoice-summary p{
            margin-bottom: 0;
        }
        .wid-75 {
            width: 75px;
        }
    </style>
</head>

<body>
    <div class="invoice-preview-main" id="boxes">
        <div class="invoice-header" style="background-color: var(--theme-color); color: <?php echo e($font_color); ?>;">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <img class="invoice-logo"
                                src="<?php echo e($img); ?>"
                                alt="">
                        </td>
                        <td class="text-right">
                            <h3 style="text-transform: uppercase; font-size: 40px; font-weight: bold; "><?php echo e(__('PURCHASE')); ?></h3>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="vertical-align-top">
                <tbody>
                    <tr>
                        <td>
                            <p>
                                <?php if(!empty($settings['company_name'])): ?><?php echo e($settings['company_name']); ?><?php endif; ?><br>
                                <?php if(!empty($settings['company_email'])): ?><?php echo e($settings['company_email']); ?><?php endif; ?><br>
                                <?php if(!empty($settings['company_telephone'])): ?><?php echo e($settings['company_telephone']); ?><?php endif; ?><br>
                                <?php if(!empty($settings['company_address'])): ?><?php echo e($settings['company_address']); ?><?php endif; ?>
                                <?php if(!empty($settings['company_city'])): ?> <br> <?php echo e($settings['company_city']); ?>, <?php endif; ?>
                                <?php if(!empty($settings['company_state'])): ?><?php echo e($settings['company_state']); ?><?php endif; ?>
                                <?php if(!empty($settings['company_country'])): ?> <br><?php echo e($settings['company_country']); ?><?php endif; ?>
                                <?php if(!empty($settings['company_zipcode'])): ?> - <?php echo e($settings['company_zipcode']); ?><?php endif; ?><br>
                                <?php if(!empty($settings['registration_number'])): ?><?php echo e(__('Registration Number')); ?> : <?php echo e($settings['registration_number']); ?> <?php endif; ?><br>
                                <?php if(!empty($settings['tax_type']) && !empty($settings['vat_number'])): ?><?php echo e($settings['tax_type'].' '. __('Number')); ?> : <?php echo e($settings['vat_number']); ?> <br><?php endif; ?>
                            </p>
                        </td>
                        <td style="width: 60%;">
                            <table class="no-space">
                                <tbody>
                                    <tr>
                                        <td><?php echo e(__('Number: ')); ?></td>
                                        <td class="text-right"><?php echo e(\Modules\Pos\Entities\Purchase::purchaseNumberFormat($purchase->purchase_id,$purchase->created_by,$purchase->workspace)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('Purchase Date:')); ?></td>
                                        <td class="text-right"><?php echo e(company_date_formate($purchase->purchase_date,$purchase->created_by,$purchase->workspace)); ?></td>
                                    </tr>
                                    <?php if(!empty($customFields) && count($purchase->customField)>0): ?>
                                        <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($field->name); ?> :</td>
                                                <td class="text-right" style="white-space: normal;"> 
                                                    <?php if($field->type == 'attachment'): ?>
                                                        <a href="<?php echo e(get_file($purchase->customField[$field->id])); ?>" target="_blank">
                                                            <img src=" <?php echo e(get_file($purchase->customField[$field->id])); ?> " class="wid-75 rounded me-3">
                                                        </a>
                                                    <?php else: ?>
                                                        <?php echo e(!empty($purchase->customField)?$purchase->customField[$field->id]:'-'); ?>

                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td colspan="2">
                                            <div class="view-qrcode">
                                                <p> <?php echo DNS2D::getBarcodeHTML(route('purchase.link.copy',\Crypt::encrypt($purchase->purchase_id)), "QRCODE",2,2); ?>

                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="invoice-body">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <strong style="margin-bottom: 10px; display:block;"><?php echo e(__('Bill To')); ?>:</strong>
                            <p>
                                <?php if(!empty($purchase->vender_name)): ?>
                                <?php echo e((!empty( $purchase->vender_name)?$purchase->vender_name:'')); ?>

                           <?php else: ?>
                           <?php if(!empty($vendor->billing_name) && !empty($vendor->billing_address) && !empty($vendor->billing_zip)): ?>
                           <?php echo e(!empty($vendor->billing_name) ? $vendor->billing_name : ''); ?><br>
                           <?php echo e(!empty($vendor->billing_address) ? $vendor->billing_address : ''); ?><br>
                           <?php echo e(!empty($vendor->billing_city) ? $vendor->billing_city . ' ,' : ''); ?>

                           <?php echo e(!empty($vendor->billing_state) ? $vendor->billing_state . ' ,' : ''); ?>

                           <?php echo e(!empty($vendor->billing_zip) ? $vendor->billing_zip : ''); ?><br>
                           <?php echo e(!empty($vendor->billing_country) ? $vendor->billing_country : ''); ?><br>
                           <?php echo e(!empty($vendor->billing_phone) ? $vendor->billing_phone : ''); ?><br>
                           <?php endif; ?>
                           <?php endif; ?>
                            </p>
                        </td>
                        <?php if($settings['purchase_shipping_display']=='on'): ?>
                        <?php if(!empty($vendor->shipping_name) && !empty($vendor->shipping_address) && !empty($vendor->shipping_zip)): ?>
                        <td class="text-right">
                            <strong style="margin-bottom: 10px; display:block;"><?php echo e(__('Ship To')); ?>:</strong>
                            <p>
                                <?php echo e(!empty($vendor->shipping_name) ? $vendor->shipping_name : ''); ?><br>
                                <?php echo e(!empty($vendor->shipping_address) ? $vendor->shipping_address : ''); ?><br>
                                <?php echo e(!empty($vendor->shipping_city) ? $vendor->shipping_city .' ,': ''); ?>

                                <?php echo e(!empty($vendor->shipping_state) ? $vendor->shipping_state .' ,': ''); ?>

                                <?php echo e(!empty($vendor->shipping_zip) ? $vendor->shipping_zip : ''); ?><br>
                                <?php echo e(!empty($vendor->shipping_country) ? $vendor->shipping_country : ''); ?><br>
                                <?php echo e(!empty($vendor->shipping_phone) ? $vendor->shipping_phone : ''); ?><br>
                            </p>
                        </td>
                        <?php endif; ?>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
            <table class="add-border invoice-summary" style="margin-top: 30px;">
                <thead style="background-color: var(--theme-color);color: <?php echo e($font_color); ?>;">
                    <tr>
                        <th><?php echo e(__('Item Type')); ?></th>
                        <th><?php echo e(__('Item')); ?></th>
                        <th><?php echo e(__('Quantity')); ?></th>
                        <th><?php echo e(__('Rate')); ?></th>
                        <th><?php echo e(__('Discount')); ?></th>
                        <th><?php echo e(__('Tax')); ?> (%)</th>
                        <th><?php echo e(__('Price')); ?><small><?php echo e(__('After discount & tax')); ?></small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($purchase->itemData) && count($purchase->itemData) > 0): ?>
                        <?php $__currentLoopData = $purchase->itemData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(!empty($item->product_type) ? Str::ucfirst($item->product_type) : '--'); ?></td>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->quantity); ?></td>
                                <td><?php echo e(currency_format_with_sym($item->price,$purchase->created_by,$purchase->workspace)); ?></td>
                                <td><?php echo e(($item->discount!=0)?currency_format_with_sym($item->discount,$purchase->created_by,$purchase->workspace):'-'); ?></td>
                                <td>
                                    <?php if(!empty($item->itemTax)): ?>
                                        <?php $__currentLoopData = $item->itemTax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span><?php echo e($taxes['name']); ?> </span><span> (<?php echo e($taxes['rate']); ?>) </span> <span><?php echo e($taxes['price']); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                       <p>-</p>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(currency_format_with_sym(($item->price * $item->quantity),$purchase->created_by,$purchase->workspace)); ?></td>
                                <?php if($item->description != null): ?>
                                    <tr class="border-0 itm-description ">
                                        <td colspan="6"><?php echo e($item->description); ?> </td>
                                    </tr>
                                <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>
                                <p>-</p>
                                <p>-</p>
                            </td>
                            <td>-</td>
                            <td>-</td>
                        <tr class="border-0 itm-description ">
                                <td colspan="6">-</td>
                            </tr>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td><?php echo e(__('Total')); ?></td>
                        <td><?php echo e($purchase->totalQuantity); ?></td>
                        <td><?php echo e(currency_format_with_sym($purchase->totalRate,$purchase->created_by,$purchase->workspace)); ?></td>
                        <td><?php echo e(currency_format_with_sym($purchase->totalDiscount,$purchase->created_by,$purchase->workspace)); ?></td>
                        <td><?php echo e(currency_format_with_sym($purchase->totalTaxPrice,$purchase->created_by,$purchase->workspace)); ?></td>
                        <td><?php echo e(currency_format_with_sym($purchase->getSubTotal(),$purchase->created_by,$purchase->workspace)); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                        <td colspan="2" class="sub-total">
                            <table class="total-table">
                                <tr>
                                    <td><?php echo e(__('Subtotal')); ?>:</td>
                                    <td><?php echo e(currency_format_with_sym($purchase->getSubTotal(),$purchase->created_by,$purchase->workspace)); ?></td>
                                </tr>
                                <?php if($purchase->getTotalDiscount()): ?>
                                    <tr>
                                        <td><?php echo e(__('Discount')); ?>:</td>
                                        <td><?php echo e(currency_format_with_sym($purchase->getTotalDiscount(),$purchase->created_by,$purchase->workspace)); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase->taxesData)): ?>
                                    <?php $__currentLoopData = $purchase->taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($taxName); ?> :</td>
                                            <td><?php echo e(currency_format_with_sym($taxPrice,$purchase->created_by,$purchase->workspace)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <tr>
                                    <td><?php echo e(__('Total')); ?>:</td>
                                    <td><?php echo e(currency_format_with_sym(($purchase->getSubTotal()-$purchase->getTotalDiscount()+$purchase->getTotalTax()),$purchase->created_by,$purchase->workspace)); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Paid')); ?>:</td>
                                    <td><?php echo e(currency_format_with_sym(($purchase->getTotal()-$purchase->getDue()),$purchase->created_by,$purchase->workspace)); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Due Amount')); ?>:</td>
                                    <td><?php echo e(currency_format_with_sym($purchase->getDue(),$purchase->created_by,$purchase->workspace)); ?></td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="invoice-footer">
                <p> <?php echo e($settings['purchase_footer_title']); ?> <br>
                    <?php echo e($settings['purchase_footer_notes']); ?> </p>
            </div>
        </div>
    </div>
    <?php if(!isset($preview)): ?>
        <?php echo $__env->make('pos::purchase.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <?php endif; ?>
</body>
</html>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Pos/Resources/views/purchase/templates/template1.blade.php ENDPATH**/ ?>