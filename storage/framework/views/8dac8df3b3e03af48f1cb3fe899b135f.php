<?php
    $setting = App\Models\Utility::colorset();

?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e($setting['SITE_RTL'] == 'on' ? 'rtl' : ''); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">


    <style type="text/css">
        :root {
            --theme-color: #003580;
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
        }

        .vertical-align-top td {
            vertical-align: top;
        }

        .view-qrcode {
            max-width: 114px;
            height: 114px;
            margin-left: auto;
            margin-top: 15px;
            background: var(--white);
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
    </style>
</head>

<body>
    <div class="invoice-preview-main" id="boxes">
        <div class="invoice-header" style="background: <?php echo e($color); ?>;color:<?php echo e($font_color); ?>">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <img src="<?php echo e($img); ?>" style="max-width: 250px" />
                        </td>
                        <td class="text-right">
                            <h3 style="text-transform: uppercase; font-size: 40px; font-weight: bold;">SALES ORDER</h3>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="vertical-align-top">
                <tbody>
                    <tr>
                        <td>
                            <strong><?php echo e(__('From')); ?>:</strong>
                            <p>
                                <?php if($settings['company_name']): ?>
                                    <?php echo e($settings['company_name']); ?><?php endif; ?>
                                <br>
                                <?php if($settings['company_address']): ?>
                                    <?php echo e($settings['company_address']); ?><?php endif; ?>
                                <?php if($settings['company_city']): ?> <br>
                                    <?php echo e($settings['company_city']); ?>, <?php endif; ?>
                                <?php if($settings['company_state']): ?>
                                    <?php echo e($settings['company_state']); ?><?php endif; ?>
                                <?php if($settings['company_zipcode']): ?> -
                                    <?php echo e($settings['company_zipcode']); ?><?php endif; ?>
                                <?php if($settings['company_country']): ?>
                                    <br><?php echo e($settings['company_country']); ?>

                                <?php endif; ?>
                            </p>
                        </td>
                        <td>
                            <table class="no-space">
                                <tbody>
                                    <tr>
                                        <td>Number: </td>
                                        <td class="text-right">
                                            <?php echo e(\App\Models\Utility::salesorderNumberFormat($settings, $salesorder->quote)); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Issue Date:</td>
                                        <td class="text-right">
                                            <?php echo e(\App\Models\Utility::dateFormat($settings, $salesorder->issue_date)); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="view-qrcode">
                                                <?php echo DNS2D::getBarcodeHTML(
                                                    route('pay.salesorder', \Illuminate\Support\Facades\Crypt::encrypt($salesorder->id)),
                                                    'QRCODE',
                                                    2,
                                                    2,
                                                ); ?>

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
                            <strong style="margin-bottom: 10px; display:block;">Bill To:</strong>
                            <p>
                                <?php echo e(!empty($user->name) ? $user->name : ''); ?><br>
                                <?php echo e(!empty($user->email) ? $user->email : ''); ?><br>
                                <?php echo e(!empty($user->mobile) ? $user->mobile : ''); ?><br>
                                <?php echo e(!empty($user->bill_address) ? $user->bill_address : ''); ?><br>
                                <?php echo e(!empty($user->bill_zip) ? $user->bill_zip : ''); ?><br>
                                <?php echo e(!empty($user->bill_city) ? $user->bill_city : '' . ''); ?>

                                <?php echo e(!empty($user->bill_state) ? $user->bill_state : ''); ?> <?php echo e(!empty($user->bill_country) ? $user->bill_country : ''); ?>

                            </p>
                        </td>
                        <td class="text-right">
                            <strong style="margin-bottom: 10px; display:block;">Ship To:</strong>
                            <p>
                                <?php echo e(!empty($user->name) ? $user->name : ''); ?><br>
                                <?php echo e(!empty($user->email) ? $user->email : ''); ?><br>
                                <?php echo e(!empty($user->mobile) ? $user->mobile : ''); ?><br>
                                <?php echo e(!empty($user->address) ? $user->address : ''); ?><br>
                                <?php echo e(!empty($user->zip) ? $user->zip : ''); ?><br>
                                <?php echo e(!empty($user->city) ? $user->city : '' . ', '); ?>,<?php echo e(!empty($user->state) ? $user->state : ''); ?>,<?php echo e(!empty($user->country) ? $user->country : ''); ?>

                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="add-border invoice-summary" style="margin-top: 30px;">
                <thead style="background: <?php echo e($color); ?>;color:<?php echo e($font_color); ?>">
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Tax (%)</th>
                        <th>Discount</th>
                        <th>Price <small>before tax & discount</small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($salesorder->items) && count($salesorder->items) > 0): ?>
                        <?php $__currentLoopData = $salesorder->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->quantity); ?></td>
                                <td><?php echo e(\App\Models\Utility::priceFormat($settings, $item->price)); ?></td>
                                <td>
                                    <?php $__currentLoopData = $item->itemTax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span><?php echo e($taxes['name']); ?></span> <span>(<?php echo e($taxes['rate']); ?>)</span>
                                        <span><?php echo e($taxes['price']); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <?php if($item->discount != 0): ?>
                                    <td><?php echo e(\App\Models\Utility::priceFormat($settings, $item->discount)); ?></td>
                                <?php else: ?>
                                    <td>-</td>
                                <?php endif; ?>
                                <td><?php echo e(\App\Models\Utility::priceFormat($settings, $item->price * $item->quantity)); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td><?php echo e($salesorder->totalQuantity); ?></td>
                        <td><?php echo e(\App\Models\Utility::priceFormat($settings, $salesorder->totalRate)); ?></td>
                        <td><?php echo e(\App\Models\Utility::priceFormat($settings, $salesorder->totalTaxPrice)); ?></td>
                        <?php if($salesorder->discount_apply == 1): ?>
                            <td><?php echo e(\App\Models\Utility::priceFormat($settings, $salesorder->totalDiscount)); ?></td>
                        <?php else: ?>
                            <td>-</td>
                        <?php endif; ?>
                        <td><?php echo e(\App\Models\Utility::priceFormat($settings, $salesorder->getSubTotal())); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2" class="sub-total">
                            <table class="total-table">
                                <?php if($salesorder->discount_apply == 1): ?>
                                    <?php if($salesorder->getTotalDiscount()): ?>
                                        <tr>
                                            <td>Discount :</td>
                                            <td><?php echo e(\App\Models\Utility::priceFormat($settings, $salesorder->getTotalDiscount())); ?>

                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if(!empty($salesorder->taxesData)): ?>
                                    <?php $__currentLoopData = $salesorder->taxesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxName => $taxPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($taxName); ?> :</td>
                                            <td><?php echo e(\App\Models\Utility::priceFormat($settings, $taxPrice)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <tr>
                                    <td>Total:</td>
                                    <td><?php echo e(\App\Models\Utility::priceFormat($settings, $salesorder->getSubTotal() - $salesorder->getTotalDiscount() + $salesorder->getTotalTax())); ?>

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <div class="d-header-50">
        <p>
            <?php echo e($settings['footer_title']); ?> :<br>
            <?php echo e($settings['footer_notes']); ?>

        </p>
    </div>
    <?php if(!isset($preview)): ?>
        <?php echo $__env->make('salesorder.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
    <?php endif; ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\centraverse\resources\views/salesorder/templates/template1.blade.php ENDPATH**/ ?>