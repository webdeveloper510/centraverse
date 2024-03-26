<?php
$plansettings = App\Models\Utility::plansettings();
$settings = Utility::settings();
$type_arr= explode(',',$settings['event_type']);
$type_arr = array_combine($type_arr, $type_arr);
$venue = explode(',',$settings['venue']);
if(isset($settings['function']) && !empty($settings['function'])){
$function = json_decode($settings['function'],true);
}
if(isset($settings['barpackage']) && !empty($settings['barpackage'])){
$bar_package = json_decode($settings['barpackage'],true);
}
$baropt = ['Open Bar', 'Cash Bar', 'Package Choice'];
if(isset($settings['barpackage']) && !empty($settings['barpackage'])){
$bar_package = json_decode($settings['barpackage'],true);
}
if(isset($settings['additional_items']) && !empty($settings['additional_items'])){
$additional_items = json_decode($settings['additional_items'],true);
}
?>
<?php echo e(Form::open(array('url'=>'lead','method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))); ?>

<input type="hidden" name="storedid" value="">
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('lead_name',__('Lead Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('lead_name',null,array('class'=>'form-control','placeholder'=>__('Enter Lead Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('company_name',__('Company Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter Company Name')))); ?>

        </div>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;"><?php echo e(__('Contact Information')); ?></h5>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('phone',__('Phone'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))); ?>

        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('lead_address',__('Address'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('lead_address',null,array('class'=>'form-control','placeholder'=>__('Address'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('relationship',__('Relationship'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('relationship',null,array('class'=>'form-control','placeholder'=>__('Enter Relationship')))); ?>

        </div>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;"><?php echo e(__('Event Details')); ?></h5>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('type',__('Event Type'),['class'=>'form-label'])); ?>

            <?php echo Form::select('type', isset($type_arr) ? $type_arr : '', null,array('class' =>
            'form-control','required'=>'required')); ?>

        </div>
    </div>
    <?php if(isset($venue) && !empty($venue)): ?>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('venue_selection', __('Venue'), ['class' => 'form-label'])); ?>

            <div>
                <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e(Form::checkbox('venue[]', $label, false, ['id' => 'venue' . ($key + 1)])); ?>

                <?php echo e(Form::label($label, $label)); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

            <?php echo Form::date('start_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required']); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

            <?php echo Form::date('end_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required']); ?>

        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('guest_count',__('Guest Count'),['class'=>'form-label'])); ?>

            <?php echo Form::number('guest_count',old('guest_count'),array('class' => 'form-control','min'=> 0)); ?>

        </div>
    </div>
    <?php if(isset($function) && !empty($function)): ?>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('function', __('Function'), ['class' => 'form-label'])); ?>

            <div>
                <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-check" style="    padding-left: 2.75em !important;">
                    <?php echo Form::checkbox('function[]', $value['function'], null, ['class' => 'form-check-input', 'id' =>
                    'function_' . $key]); ?>

                    <?php echo e(Form::label($value['function'], $value['function'], ['class' => 'form-check-label'])); ?>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div class="col-6" id="mailFunctionSection">
        <?php if(isset($function) && !empty($function)): ?>
        <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="form-group" data-main-index="<?php echo e($key); ?>" data-main-value="<?php echo e($value['function']); ?>"
            id="function_package" style="display: none;">
            <?php echo e(Form::label('package', __($value['function']), ['class' => 'form-label'])); ?>

            <?php $__currentLoopData = $value['package']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check" data-main-index="<?php echo e($k); ?>" data-main-package="<?php echo e($package); ?>">
                <?php echo Form::checkbox('package_'.str_replace(' ', '', strtolower($value['function'])).'[]',$package, null,
                ['id' => 'package_' . $key.$k, 'data-function' => $value['function'], 'class' => 'form-check-input']); ?>

                <?php echo e(Form::label($package, $package, ['class' => 'form-check-label'])); ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
    <?php if(isset($additional_items) && !empty($additional_items)): ?>
    <div class="col-6" id="additionalSection">

        <?php echo e(Form::label('additional', __('Additional items'), ['class' => 'form-label'])); ?>

        <?php $__currentLoopData = $additional_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad_key =>$ad_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $ad_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fun_key =>$packageVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="form-group" data-additional-index="<?php echo e($fun_key); ?>" data-additional-value="<?php echo e(key($packageVal)); ?>"
            id="ad_package" style="display: none;">
            <?php echo e(Form::label('additional', __($fun_key), ['class' => 'form-label'])); ?>

            <?php $__currentLoopData = $packageVal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pac_key =>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check" data-additional-index="<?php echo e($pac_key); ?>" data-additional-package="<?php echo e($pac_key); ?>">
                <?php echo Form::checkbox('additional_'.str_replace(' ', '_', strtolower($fun_key)).'[]',$pac_key, null,
                ['data-function' => $fun_key, 'class' => 'form-check-input']); ?>

                <?php echo e(Form::label($pac_key, $pac_key, ['class' => 'form-check-label'])); ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    <?php endif; ?>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('Assign Staff',__('Assign Staff'),['class'=>'form-label'])); ?>

            <select class="form-control" name='user' required>
                <option class="form-control"  disabled>Select Staff</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option class="form-control" value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?> (<?php echo e($user->type); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <!-- <hr class="mt-2 mb-2"> -->
        <h5 style="margin-left: 14px;"><?php echo e(__('Other Information')); ?></h5>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('allergies',__('Allergies'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('allergies',null,array('class'=>'form-control','placeholder'=>__('Enter Allergies(if any)')))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('spcl_req',__('Any Special Requirements'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('spcl_req',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Any Special Requirements')))); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('Description',__('How did you hear about us?'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','rows'=>2))); ?>

        </div>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <!-- <hr class="mt-2 mb-2"> -->
        <h5 style="margin-left: 14px;"><?php echo e(__('Estimate Billing Summary Details')); ?></h5>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo Form::label('baropt', 'Bar'); ?>

            <?php $__currentLoopData = $baropt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <?php echo e(Form::radio('baropt', $label, false, ['id' => $label])); ?>

                <?php echo e(Form::label('baropt' . ($key + 1), $label)); ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="col-6" id="barpacakgeoptions" style="display: none;">
        <?php if(isset($bar_package) && !empty($bar_package)): ?>
        <?php $__currentLoopData = $bar_package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="form-group" data-main-index="<?php echo e($key); ?>" data-main-value="<?php echo e($value['bar']); ?>">
            <?php echo e(Form::label('bar', __($value['bar']), ['class' => 'form-label'])); ?>

            <?php $__currentLoopData = $value['barpackage']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $bar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check" data-main-index="<?php echo e($k); ?>" data-main-package="<?php echo e($bar); ?>">
                <?php echo Form::radio('bar'.'_'.str_replace(' ', '', strtolower($value['bar'])), $bar, false, ['id' => 'bar_'
                . $key.$k, 'data-function' => $value['bar'], 'class' => 'form-check-input']); ?>

                <?php echo e(Form::label($bar, $bar, ['class' => 'form-check-label'])); ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('rooms',__('Room'),['class'=>'form-label'])); ?>

            <input type="number" name="rooms" id="" placeholder="Enter No. of Room(if required)" min='0'
                class="form-control" value="<?php echo e(old('guest_count')); ?>">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('start_time', __('Estimated Start Time (24-Hour Format)'), ['class' => 'form-label'])); ?>

            <?php echo Form::input('time', 'start_time', 'null', ['class' => 'form-control', 'required' => 'required']); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('end_time', __('Estimated End Time (24-Hour Format)'), ['class' => 'form-label'])); ?>

            <?php echo Form::input('time', 'end_time', 'null', ['class' => 'form-control', 'required' => 'required']); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

</div>
<script>
jQuery(function() {
    $('input[name="function[]"]').change(function() {
        $('div#mailFunctionSection > div').hide();
        $('input[name="function[]"]:checked').each(function() {
            var funVal = $(this).val();
            $('div#mailFunctionSection > div').each(function() {
                var attr_value = $(this).data('main-value');
                if (attr_value == funVal) {
                    $(this).show();
                }
            });
        });
    });
});
jQuery(function() {
    $('div#mailFunctionSection input[type=checkbox]').change(function() {
        $('div#additionalSection > div').hide();
        $('div#mailFunctionSection input[type=checkbox]:checked').each(function() {
            var funcValue = $(this).val();
            $('div#additionalSection > div').each(function() {
                var ad_val = $(this).data('additional-index');
                if (funcValue == ad_val) {
                    $(this).show();
                }
            });
        });
    });
});
jQuery(function() {
    $('input[type=radio][name = baropt]').change(function() {
        $('div#barpacakgeoptions').hide();
        var value = $(this).val();
        if (value == 'Package Choice') {
            $('div#barpacakgeoptions').show();
        }
    });
});
$(document).ready(function() {
    var storedId = localStorage.getItem('clickedLinkId');
    $.ajax({
        url: "<?php echo e(route('getcontactinfo')); ?>",
        type: 'POST',
        data: {
            "customerid": storedId,
            "_token": "<?php echo e(csrf_token()); ?>",
        },
        success: function(data) {
            localStorage.removeItem('clickedLinkId');
            $('input[name="name"]').val(data[0].name);
            $('input[name="phone"]').val(data[0].phone);
            $('input[name="email"]').val(data[0].email);
            $('input[name="lead_address"]').val(data[0].address);
            $('input[name="company_name"]').val(data[0].organization);
        }
    });
})

//   $('input[name = "storedid"]').val(storedId);
</script>
<?php echo e(Form::close()); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/lead/create.blade.php ENDPATH**/ ?>