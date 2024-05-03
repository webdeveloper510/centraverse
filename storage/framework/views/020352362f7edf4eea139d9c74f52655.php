<?php
$settings = App\Models\Utility::settings();
$billings = json_decode($settings['fixed_billing'],true);
$foodpcks = json_decode($lead->func_package,true);
$barpcks = json_decode($lead->bar_package,true);
// $barpcks = json_decode($lead->bar,true);
$labels =
[
    'venue_rental' => 'Venue',
    'hotel_rooms'=>'Hotel Rooms',
    'food_package'=>'Food Package',
    'bar_package'=>'Beverage/Bar Package'
];
$food = [];
$totalFoodPackageCost = 0;
$totalBarPackageCost= 0;
if(isset($billings) && !empty($billings)){
    if(isset($foodpcks) && !empty($foodpcks)){
        foreach($foodpcks as $key => $foodpck){
            foreach($foodpck as $foods){
                $food[]= $foods;
            }
        }
        $foodpckge = implode(',',$food);
        foreach ($food as $foodItem) {
            foreach ($billings['package'] as $category => $categoryItems) {
                if (isset($categoryItems[$foodItem])) {
                    $totalFoodPackageCost +=  (int)$categoryItems[$foodItem];
                    break;
                }
            }
        }
    }
    if(isset($barpcks) && !empty($barpcks)){
        foreach($barpcks as $key => $barpck){
                $bar[]= $barpck;
           
        }
        $barpckge = implode(',',$bar);
        foreach ($bar as $barItem) {
            foreach ($billings['barpackage'] as $category => $categoryItems) {
                if (isset($categoryItems[$barItem])) {
                    $totalBarPackageCost +=  (int)$categoryItems[$barItem];
                    break;
                }
            }
        }
    }
}



$leaddata = [
    'venue_rental' => $lead->venue_selection,
    'hotel_rooms'=>$lead->rooms,
    'food_package' => (isset($foodpckge) && !empty($foodpckge)) ? $foodpckge: '',
    'bar_package' => (isset($barpckge) && !empty($barpckge)) ? $barpckge : '',

];
$venueRentalCost = 0;
$subcategories = array_map('trim', explode(',', $leaddata['venue_rental']));
foreach ($subcategories as $subcategory) {
$venueRentalCost += $billings['venue'][$subcategory] ?? 0;
}

$leaddata['hotel_rooms_cost'] = $billings['hotel_rooms'] ?? 0;
$leaddata['venue_rental_cost'] = $venueRentalCost;
$leaddata['food_package_cost'] = $totalFoodPackageCost;
$leaddata['bar_package_cost'] = $totalBarPackageCost;


?>
<div class="row">
    <div class="col-lg-12">
        <div id="notification" class="alert alert-success mt-1">Link copied to clipboard!</div>
        <?php echo e(Form::model($lead, ['route' => ['lead.pdf', urlencode(encrypt($lead->id))], 'method' => 'POST','enctype'=>'multipart/form-data'])); ?>


        <div class="">
            <dl class="row">
                <input type="hidden" name="lead" value="<?php echo e($lead->id); ?>">
                <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Name')); ?></span></dt>
                <dd class="col-md-6">
                    <input type="text" name="name" class="form-control" value="<?php echo e($lead->name); ?>" readonly>
                </dd>

                <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Recipient')); ?></span></dt>
                <dd class="col-md-6">
                    <input type="email" name="email" class="form-control" value="<?php echo e($lead->email); ?>" required>
                </dd>

                <dt class="col-md-12"><span class="h6  mb-0"><?php echo e(__('Subject')); ?></span></dt>
                <dd class="col-md-12"><input type="text" name="subject" id="Subject" class="form-control" required></dd>

                <dt class="col-md-12"><span class="h6  mb-0"><?php echo e(__('Content')); ?></span></dt>
                <dd class="col-md-12"><textarea name="emailbody" id="emailbody" cols="30" rows="10" class="form-control"
                        required></textarea></dd>

                <dt class="col-md-12"><span class="h6  mb-0"><?php echo e(__('Upload Document')); ?></span></dt>
                <dd class="col-md-12"><input type="file" name="attachment" id="attachment" class="form-control"></dd>
            </dl>
            <!-- <hr class="mt-2 mb-2"> -->

            <hr class="mt-4 mb-4">
            <!-- <hr> -->
            <div class="col-12  p-0 modaltitle pb-3 mb-3 flex-title">
                <!-- <hr class="mt-2 mb-2"> -->
                <h5 class="bb"><?php echo e(__('Estimated Billing Details')); ?></h5>
                <span class="h6 mb-0" style="float:right;  
"><?php echo e(__('Guest Count')); ?> : <?php echo e($lead->guest_count); ?></span>
            </div>
            <dl class="row">
                <!-- <dt class="col-md-12"><span class="h6  mb-0"><?php echo e(__('Guest Count')); ?> : <?php echo e($lead->guest_count); ?></span></dt>
               <hr class="mt-2 mb-2"> -->
                <!-- <div class="col-md-12"> -->

                <div class="form-group">
                    <table class="table table-share">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Description')); ?> </th>
                                <th><?php echo e(__('Cost(per person)')); ?> </th>
                                <th><?php echo e(__('Quantity')); ?> </th>
                                <th><?php echo e(__('Notes')); ?> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(ucfirst($label)); ?></td>
                                <td>
                                    <input type="text" name="billing[<?php echo e($key); ?>][cost]"
                                        value="<?php echo e(isset($leaddata[$key.'_cost']) ? $leaddata[$key.'_cost'] : ''); ?>"
                                        class="form-control dlr">
                                </td>
                                <td>
                                    <input type="number" name="billing[<?php echo e($key); ?>][quantity]" min='0' class="form-control"
                                        value="<?php echo e($leaddata[$key] ?? ''); ?>" required>
                                </td>
                                <td>
                                    <input type="text" name="billing[<?php echo e($key); ?>][notes]" class="form-control"
                                        value="<?php echo e(isset($key) && ($key !== 'hotel_rooms') ? $leaddata[$key] ?? '' : ''); ?>">
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <label class="form-label"> Deposit on file: </label>
                        <input type="number" name="deposits" min='0' class="form-control">
                    </div>

                </div>
            </dl>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-toggle="tooltip" onclick="getDataUrlAndCopy(this)"
                data-url="<?php echo e(route('lead.signedproposal',urlencode(encrypt($lead->id)))); ?>" title='Copy To Clipboard'>
                <i class="ti ti-copy"></i>
            </button>
            <?php echo e(Form::submit(__('Share via mail'),array('class'=>'btn btn-primary'))); ?>

        </div>

    </div>
    <?php echo e(Form::close()); ?>

</div>

<style>
#notification {
    display: none;
}
</style>
<script>
function getDataUrlAndCopy(button) {
    var dataUrl = button.getAttribute('data-url');
    copyToClipboard(dataUrl);
    // alert("Copied the data URL: " + dataUrl);
}

function copyToClipboard(text) {
    /* Create a temporary input element */
    var tempInput = document.createElement("input");

    /* Set the value of the input element to the text to be copied */
    tempInput.value = text;

    document.body.appendChild(tempInput);

    /* Select the text in the input element */
    tempInput.select();

    /* Copy the selected text to the clipboard */
    document.execCommand("copy");

    /* Remove the temporary input element from the DOM */
    document.body.removeChild(tempInput);
    showNotification();

    /* Hide the notification after 2 seconds (adjust as needed) */
    setTimeout(hideNotification, 2000);
}

function showNotification() {
    var notification = document.getElementById('notification');
    notification.style.display = 'block';
}

function hideNotification() {
    var notification = document.getElementById('notification');
    notification.style.display = 'none';
}
</script>
<?php /**PATH /home/crmcentraverse/public_html/resources/views/lead/share_proposal.blade.php ENDPATH**/ ?>