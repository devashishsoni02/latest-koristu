<!DOCTYPE html>
<html lang="en"
    dir="<?php echo e(company_setting('site_rtl', $proposal->created_by, $proposal->workspace) == 'on' ? 'rtl' : ''); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo e(\App\Models\Proposal::proposalNumberFormat($proposal->proposal_id, $proposal->created_by, $proposal->workspace)); ?>

        |
        <?php echo e(!empty(company_setting('title_text', $proposal->created_by, $proposal->workspace)) ? company_setting('title_text', $proposal->created_by, $proposal->workspace) : (!empty(admin_setting('title_text')) ? admin_setting('title_text') : 'WorkDo')); ?>

    </title>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <style type="text/css">
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

        .view-qrcode img {
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
        html[dir="rtl"] table tr th {
            text-align: right;
        }

        html[dir="rtl"] .text-right {
            text-align: left;
        }

        html[dir="rtl"] .view-qrcode {
            margin-left: 0;
            margin-right: auto;
        }

        p:not(:last-of-type) {
            margin-bottom: 15px;
        }

        .invoice-summary p {
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
                            <img class="invoice-logo" src="<?php echo e($img); ?>" alt="">
                        </td>
                        <td class="text-right">
                            <h3 style="text-transform: uppercase; font-size: 40px; font-weight: bold; ">
                                <?php echo e(__('PROPOSAL')); ?></h3>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="vertical-align-top">
                <tbody>
                    <tr>
                        <td>
                            <p>
                                <?php if(!empty($settings['company_name'])): ?>
                                    <?php echo e($settings['company_name']); ?>

                                <?php endif; ?>
                                <br>
                                <?php if(!empty($settings['company_email'])): ?>
                                    <?php echo e($settings['company_email']); ?>

                                <?php endif; ?>
                                <br>
                                <?php if(!empty($settings['company_telephone'])): ?>
                                    <?php echo e($settings['company_telephone']); ?>

                                <?php endif; ?>
                                <br>
                                <?php if(!empty($settings['company_address'])): ?>
                                    <?php echo e($settings['company_address']); ?>

                                <?php endif; ?>
                                <?php if(!empty($settings['company_city'])): ?>
                                    <br> <?php echo e($settings['company_city']); ?>,
                                <?php endif; ?>
                                <?php if(!empty($settings['company_state'])): ?>
                                    <?php echo e($settings['company_state']); ?>

                                <?php endif; ?>
                                <?php if(!empty($settings['company_country'])): ?>
                                <br><?php echo e($settings['company_country']); ?>

                                <?php endif; ?>
                                <?php if(!empty($settings['company_zipcode'])): ?>
                                    - <?php echo e($settings['company_zipcode']); ?>

                                <?php endif; ?>
                                <br>
                                <?php if(!empty($settings['registration_number'])): ?>
                                    <?php echo e(__('Registration Number')); ?> : <?php echo e($settings['registration_number']); ?>

                                <?php endif; ?>
                                <br>
                                <?php if(!empty($settings['tax_type']) && !empty($settings['vat_number'])): ?>
                                    <?php echo e($settings['tax_type'] . ' ' . __('Number')); ?> : <?php echo e($settings['vat_number']); ?> <br>
                                <?php endif; ?>
                            </p>
                        </td>
                        <td style="width: 60%;">
                            <table class="no-space">
                                <tbody>
                                    <tr>
                                        <td><?php echo e(__('Number: ')); ?></td>
                                        <td class="text-right">
                                            <?php echo e(\App\Models\Proposal::proposalNumberFormat($proposal->proposal_id, $proposal->created_by, $proposal->workspace)); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e(__('Issue Date:')); ?></td>
                                        <td class="text-right">
                                            <?php echo e(company_date_formate($proposal->issue_date, $proposal->created_by, $proposal->workspace)); ?>

                                        </td>
                                    </tr>
                                    <?php if(!empty($customFields) && count($proposal->customField) > 0): ?>
                                        <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($field->name); ?>:</td>
                                                <td class="text-right" style="white-space: normal;">
                                                    <?php if($field->type == 'attachment'): ?>
                                                        <a href="<?php echo e(get_file($proposal->customField[$field->id])); ?>" target="_blank">
                                                            <img src=" <?php echo e(get_file($proposal->customField[$field->id])); ?> " class="wid-75 rounded me-3">
                                                        </a>
                                                    <?php else: ?>
                                                        <p><?php echo e(!empty($proposal->customField[$field->id]) ? $proposal->customField[$field->id] : '-'); ?></p>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td colspan="2">
                                            <div class="view-qrcode">
                                                <?php echo DNS2D::getBarcodeHTML(route('pay.proposalpay', Crypt::encrypt($proposal->proposal_id)), 'QRCODE', 2, 2); ?>

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
                        <?php if(!empty($customer->billing_name) && !empty($customer->billing_address) && !empty($customer->billing_zip)): ?>
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
                        <?php endif; ?>
                        <?php if($settings['proposal_shipping_display'] == 'on'): ?>
                            <?php if(!empty($customer->shipping_name) && !empty($customer->shipping_address) && !empty($customer->shipping_zip)): ?>
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
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
            <table class="add-border invoice-summary" style="margin-top: 30px;">
                <thead style="background-color: var(--theme-color);color: <?php echo e($font_color); ?>;">
                    <tr>
                        <?php if($proposal->proposal_module == "account"): ?>
                            <th><?php echo e(__('Item Type')); ?></th>
                        <?php endif; ?>
                        <th><?php echo e(__('Item')); ?></th>
                        <th><?php echo e(__('Quantity')); ?></th>
                        <th><?php echo e(__('Rate')); ?></th>
                        <th><?php echo e(__('Discount')); ?></th>
                        <th><?php echo e(__('Tax')); ?> (%)</th>
                        <th><?php echo e(__('Price')); ?><small><?php echo e(__('After discount & tax')); ?></small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($proposal->itemData) && count($proposal->itemData) > 0): ?>
                        <?php $__currentLoopData = $proposal->itemData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($proposal->proposal_module == "account"): ?>
                                    <td><?php echo e(!empty($item->product_type) ? Str::ucfirst($item->product_type) : '--'); ?></td>
                                <?php endif; ?>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->quantity); ?></td>
                                <td><?php echo e(currency_format_with_sym($item->price, $proposal->created_by, $proposal->workspace)); ?>

                                </td>
                                <td><?php echo e($item->discount != 0 ? currency_format_with_sym($item->discount, $proposal->created_by, $proposal->workspace) : '-'); ?>

                                </td>
                                <td>
                                    <?php if(!empty($item->itemTax)): ?>
                                        <?php $__currentLoopData = $item->itemTax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span><?php echo e($taxes['name']); ?> </span><span> (<?php echo e($taxes['rate']); ?>) </span>
                                            <span><?php echo e($taxes['price']); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <p>-</p>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(currency_format_with_sym($item->price * $item->quantity - $item->discount + (isset($item->tax_price) ? $item->tax_price : 0), $proposal->created_by, $proposal->workspace)); ?>

                                </td>
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
                        <?php if($proposal->proposal_module == "account"): ?>
                            <td></td>
                        <?php endif; ?>
                        <td><?php echo e(__('Total')); ?></td>
                        <td><?php echo e($proposal->totalQuantity); ?></td>
                        <td><?php echo e(currency_format_with_sym($proposal->totalRate, $proposal->created_by, $proposal->workspace)); ?>

                        </td>
                        <td><?php echo e(currency_format_with_sym($proposal->totalDiscount, $proposal->created_by, $proposal->workspace)); ?>

                        </td>
                        <td><?php echo e(currency_format_with_sym($proposal->totalTaxPrice, $proposal->created_by, $proposal->workspace)); ?>

                        </td>
                        <td><?php echo e(currency_format_with_sym($proposal->getSubTotal(), $proposal->created_by, $proposal->workspace)); ?>

                        </td>
                    </tr>
                    <tr>
                        <?php
                            $colspan = 4;
                            if($proposal->proposal_module == "account"){
                                $colspan = 5;
                            }
                        ?>
                        <td colspan="<?php echo e($colspan); ?>"></td>
                        <td colspan="2" class="sub-total">
                            <table class="total-table">
                                <?php if($proposal->getTotalDiscount()): ?>
                                    <tr>
                                        <td><?php echo e(__('Discount')); ?>:</td>
                                        <td><?php echo e(currency_format_with_sym($proposal->getTotalDiscount(), $proposal->created_by, $proposal->workspace)); ?>

                                        </td>
                                    </tr>
                                <?php endif; ?>
                                <?php if(!empty($proposal->taxesData)): ?>
                                    <?php $__currentLoopData = $proposal->taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($taxName); ?> :</td>
                                            <td><?php echo e(currency_format_with_sym($taxPrice, $proposal->created_by, $proposal->workspace)); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <tr>
                                    <td><?php echo e(__('Total')); ?>:</td>
                                    <td><?php echo e(currency_format_with_sym($proposal->getSubTotal() - $proposal->getTotalDiscount() + $proposal->getTotalTax(), $proposal->created_by, $proposal->workspace)); ?>

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="invoice-footer">
                <p> <?php echo e($settings['proposal_footer_title']); ?> <br>
                    <?php echo e($settings['proposal_footer_notes']); ?> </p>
            </div>
        </div>
    </div>
    <?php if(!isset($preview)): ?>
        <?php echo $__env->make('proposal.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</body>

</html>
<?php /**PATH /opt/lampp/htdocs/Koristu-latest/resources/views/proposal/templates/template1.blade.php ENDPATH**/ ?>