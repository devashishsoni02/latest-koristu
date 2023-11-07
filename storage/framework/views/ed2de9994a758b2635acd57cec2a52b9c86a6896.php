<!DOCTYPE html>
<html lang="en" dir="<?php echo e($settings['site_rtl'] == 'on'?'rtl':''); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(\Modules\Pos\Entities\Pos::posNumberFormat($pos->pos_id)); ?> | <?php echo e(!empty(company_setting('title_text')) ? company_setting('title_text') : (!empty(admin_setting('title_text')) ? admin_setting('title_text') :'WorkDo')); ?></title>
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
                            <h3 style="text-transform: uppercase; font-size: 40px; font-weight: bold; "><?php echo e(__('POS')); ?></h3>
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
                        <td>
                            <table class="no-space"  style="width: 45%;margin-left: auto;">
                                <tbody>
                                    <tr>
                                        <td><?php echo e(__('Number: ')); ?></td>
                                        <td class="text-right"><?php echo e(\Modules\Pos\Entities\Pos::posNumberFormat($pos->pos_id)); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('POS Date:')); ?></td>
                                        <td class="text-right"><?php echo e(company_date_formate($pos->pos_date)); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">

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
                                <?php echo e(!empty($customer->billing_name) ? $customer->billing_name : ''); ?><br>
                                <?php echo e(!empty($customer->billing_address) ? $customer->billing_address : ''); ?><br>
                                <?php echo e(!empty($customer->billing_city) ? $customer->billing_city . ' ,' : ''); ?>

                                <?php echo e(!empty($customer->billing_state) ? $customer->billing_state . ' ,' : ''); ?>

                                <?php echo e(!empty($customer->billing_zip) ? $customer->billing_zip : ''); ?><br>
                                <?php echo e(!empty($customer->billing_country) ? $customer->billing_country : ''); ?><br>
                                <?php echo e(!empty($customer->billing_phone) ? $customer->billing_phone : ''); ?><br>
                            </p>
                        </td>
                        <?php if($settings['pos_shipping_display']=='on'): ?>
                        <td class="text-right">
                            <strong style="margin-bottom: 10px; display:block;"><?php echo e(__('Ship To')); ?>:</strong>
                            <p>
                                <?php echo e(!empty($customer->shipping_name) ? $customer->shipping_name : ''); ?><br>
                                <?php echo e(!empty($customer->shipping_address) ? $customer->shipping_address : ''); ?><br>
                                <?php echo e(!empty($customer->shipping_city) ? $customer->shipping_city .' ,': ''); ?>

                                <?php echo e(!empty($customer->shipping_state) ? $customer->shipping_state .' ,': ''); ?>

                                <?php echo e(!empty($customer->shipping_zip) ? $customer->shipping_zip : ''); ?><br>
                                <?php echo e(!empty($customer->shipping_country) ? $customer->shipping_country : ''); ?><br>
                                <?php echo e(!empty($customer->shipping_phone) ? $customer->shipping_phone : ''); ?><br>
                            </p>
                        </td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
            <table class="add-border invoice-summary" style="margin-top: 30px;">
                <thead style="background-color: var(--theme-color);color: <?php echo e($font_color); ?>;">
                    <tr>
                        <th><?php echo e(__('Item')); ?></th>
                        <th><?php echo e(__('Quantity')); ?></th>
                        <th><?php echo e(__('Price')); ?></th>
                        <th><?php echo e(__('Tax')); ?> (%)</th>
                        <th><?php echo e(__('Tax Amount')); ?></th>
                        <th><?php echo e(__('Total')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($pos->itemData) && count($pos->itemData) > 0): ?>
                        <?php $__currentLoopData = $pos->itemData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->quantity); ?></td>
                                <td><?php echo e(currency_format_with_sym($item->price)); ?></td>
                                <td>
                                    <?php
                                        $totalTaxRate = 0;
                                        $totalTaxPrice=0;
                                    ?>
                                    <?php if(!empty($item->itemTax)): ?>
                                        <?php $__currentLoopData = $item->itemTax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $res = str_ireplace( array( '%' ), ' ', $taxes['rate']);
                                                $taxPrice=\Modules\Pos\Entities\Pos::taxRate($res,$item->price,$item->quantity);
                                                $totalTaxPrice+=$taxPrice;
                                            ?>
                                                <span><?php echo e($taxes['name']); ?></span> <span>(<?php echo e($taxes['rate']); ?>)</span><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(currency_format_with_sym($totalTaxPrice)); ?></td>
                                <td ><?php echo e(currency_format_with_sym(($item->price*$item->quantity)+$totalTaxPrice)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
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
                        <td><?php echo e(__('Total')); ?></td>
                        <td><?php echo e($pos->totalQuantity); ?></td>
                        <td><?php echo e(currency_format_with_sym($pos->totalRate)); ?></td>
                        <td>-</td>
                        <td><?php echo e(currency_format_with_sym($pos->totalTaxPrice)); ?></td>
                        <td><?php echo e(currency_format_with_sym($posPayment->amount)); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2" class="sub-total">
                            <table class="total-table">
                                <tr>
                                    <td><?php echo e(__('Subtotal')); ?>:</td>
                                    <td><?php echo e(currency_format_with_sym($posPayment->amount)); ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Discount')); ?>:</td>
                                    <?php if(!empty($posPayment->discount)): ?>
                                        <td><?php echo e(currency_format_with_sym($posPayment->discount)); ?></td>
                                    <?php else: ?>
                                        <td>0</td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <td><?php echo e(__('Total')); ?>:</td>
                                    <?php if(!empty($posPayment->discount)): ?>
                                        <td><?php echo e(currency_format_with_sym($posPayment->amount - $posPayment->discount)); ?></td>
                                    <?php else: ?>
                                       <td><?php echo e(currency_format_with_sym($posPayment->amount)); ?></td>
                                    <?php endif; ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="invoice-footer">
                <p> <?php echo e($settings['pos_footer_title']); ?> <br>
                    <?php echo e($settings['pos_footer_notes']); ?> </p>
            </div>
        </div>
    </div>
    <?php if(!isset($preview)): ?>
        <?php echo $__env->make('pos::pos.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <?php endif; ?>
</body>
</html>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/Modules/Pos/Resources/views/pos/templates/template1.blade.php ENDPATH**/ ?>