
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Event Review')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Review Event')); ?>

<?php $__env->stopSection(); ?>
<?php
$plansettings = App\Models\Utility::plansettings();
$setting = App\Models\Utility::settings();
$type_arr= explode(',',$setting['event_type']);
$type_arr = array_combine($type_arr, $type_arr);
$venue = explode(',',$setting['venue']);
$meal = ['Formal Plated' ,'Buffet Style' , 'Family Style'];
if(isset($setting['function']) && !empty($setting['function'])){
$function = json_decode($setting['function'],true);
}
$baropt = ['Open Bar', 'Cash Bar', 'Package Choice'];
if(isset($setting['barpackage']) && !empty($setting['barpackage'])){
$bar_package = json_decode($setting['barpackage'],true);
}
if(isset($setting['additional_items']) && !empty($setting['additional_items'])){
$additional_items = json_decode($setting['additional_items'],true);
}
?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('meeting.index')); ?>"><?php echo e(__('Event')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Review')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
    .floorimages {
        height: 400px;
        width: 600px;
        margin:0px !important;
    }

    .selected-image {
        border: 2px solid #3498db;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.5);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .selected-image:hover {
        border-color: #2980b9;
        box-shadow: 0 0 15px rgba(41, 128, 185, 0.8);
    }

    .zoom {
        background-color: none;
        transition: transform .2s;
    }
    .fa-asterisk {
    font-size: xx-small;
    position: absolute;
    padding: 1px;
}
    .zoom:hover {
        -ms-transform: scale(1.5);
        -webkit-transform: scale(1.5);
        transform: scale(1.2);
    }
</style>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo e(Form::model($meeting, ['route' => ['meeting.review_agreement.update', $meeting->id], 'method' => 'POST' ,'id'=> 'formdata'])); ?>

                        <div id="useradd-1" class="card">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <h5><?php echo e(__('Event')); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                    <?php if($meeting->attendees_lead != 0 ): ?>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('attendees_lead', __('Lead'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::text('attendees_lead',$attendees_lead,array('class'=>'form-control','required'=>'required','readonly'=>'readonly'))); ?>

                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('eventname', __('Event Name'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::text('eventname',$meeting->eventname,array('class'=>'form-control','required'=>'required','readonly'=>'readonly'))); ?>

                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('Assigned Staff',__('Assigned Staff'),['class'=>'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="user[]" value="<?php echo e($user->id); ?>" id="user_<?php echo e($user->id); ?>" <?php echo e(in_array($user->id, $user_id) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="user_<?php echo e($user->id); ?>">
                                                        <?php echo e($user->name); ?> (<?php echo e($user->type); ?>)
                                                    </label>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('company_name',__('Company Name'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter Company Name')))); ?>

                                            </div>
                                        </div>

                                        <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                            <h5 style="margin-left: 14px;"><?php echo e(__('Contact Information')); ?></h5>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('phone',__('Phone'),['class'=>'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <div class="intl-tel-input">
                                                    <input type="tel" id="phone-input" name="phone"
                                                        class="phone-input form-control" placeholder="Enter Phone"
                                                        maxlength="16" required>
                                                    <input type="hidden" name="countrycode" id="country-code">
                                                </div>
                                            </div>                                            
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('lead_address',__('Address'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('lead_address',null,array('class'=>'form-control','placeholder'=>__('Address')))); ?>

                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('relationship',__('Relationship'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('relationship',null,array('class'=>'form-control','placeholder'=>__('Enter Relationship')))); ?>

                                            </div>
                                        </div>

                                        <div id="contact-info" style="display:none">
                                            <div class="row">
                                                <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                                    <h5 style="margin-left: 14px;"><?php echo e(__('Other Contact Information')); ?></h5>
                                                </div>
                                                <div class="col-6 need_full">
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('alter_name',__('Name'),['class'=>'form-label'])); ?>

                                                        <?php echo e(Form::text('alter_name',null,array('class'=>'form-control','placeholder'=>__('Enter Name')))); ?>

                                                    </div>
                                                </div>
                                                <div class="col-6 need_full">
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('alter_phone',__('Phone'),['class'=>'form-label'])); ?>

                                                        <?php echo e(Form::text('alter_phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone')))); ?>

                                                    </div>
                                                </div>
                                                <div class="col-6 need_full">
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('alter_email',__('Email'),['class'=>'form-label'])); ?>

                                                        <?php echo e(Form::text('alter_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email')))); ?>

                                                    </div>
                                                </div>
                                                <div class="col-6 need_full">
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('alter_lead_address',__('Address'),['class'=>'form-label'])); ?>

                                                        <?php echo e(Form::text('alter_lead_address',null,array('class'=>'form-control','placeholder'=>__('Address')))); ?>

                                                    </div>
                                                </div>
                                                <div class="col-6 need_full">
                                                    <div class="form-group">
                                                        <?php echo e(Form::label('alter_relationship',__('Relationship'),['class'=>'form-label'])); ?>

                                                        <?php echo e(Form::text('alter_relationship',null,array('class'=>'form-control','placeholder'=>__('Enter Relationship')))); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-end mt-3">
                                            <button data-bs-toggle="tooltip" id="opencontact" title="<?php echo e(__('Add Contact')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
                                                <i class="ti ti-plus"></i>
                                            </button>
                                        </div>
                                        <?php if(isset($setting['is_enabled']) && $setting['is_enabled'] == 'on'): ?>
                                        <div class="form-group col-md-6">
                                            <label><?php echo e(__('Synchronize in Google Calendar')); ?></label>
                                            <div class="form-check form-switch pt-2">
                                                <input id="switch-shadow" class="form-check-input" value="1" name="is_check" type="checkbox">
                                                <label class="form-check-label" for="switch-shadow"></label>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="event-details" class="card">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <h5><?php echo e(__('Event Details')); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('type',__('Event Type'),['class'=>'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php echo Form::select('type', $type_arr, null,array('class' => 'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <label for="venue" class="form-label"><?php echo e(__('Venue')); ?></label>
                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div>
                                                    <input type="checkbox" name="venue[]" id="<?php echo e($label); ?>" value="<?php echo e($label); ?>" <?php echo e(in_array($label, $venue_function) ? 'checked' : ''); ?>>
                                                    <label for="<?php echo e($label); ?>"><?php echo e($label); ?></label>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>

                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php echo Form::date('start_date', null, ['class' => 'form-control', 'required' => 'required']); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php echo Form::date('end_date', null, ['class' => 'form-control', 'required' => 'required']); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('start_time', __('Start Time'), ['class' => 'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php echo Form::input('time', 'start_time',null, ['class' => 'form-control', 'required' => 'required']); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('end_time', __('End Time'), ['class' => 'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php echo Form::input('time', 'end_time', null, ['class' => 'form-control', 'required' => 'required']); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('guest_count',__('Guest Count'),['class'=>'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php echo Form::number('guest_count', null,array('class' => 'form-control','min'=> 0)); ?>

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo e(Form::label('function', __('Function'), ['class' => 'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php if(isset($function) && !empty($function)): ?>
                                                <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-check">
                                                    <?php echo Form::checkbox('function[]',$value['function'],   in_array( $value['function'], $function_p) ? true : false , ['id' => 'function_' . $key, 'class' => 'form-check-input']); ?>

                                                    <?php echo e(Form::label($value['function'], $value['function'], ['class' => 'form-check-label'])); ?>

                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                        <div class="col-6 need_full" id="mailFunctionSection">
                                            <?php if(isset($function) && !empty($function)): ?>
                                            <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group" data-main-index="<?php echo e($key); ?>" data-main-value="<?php echo e($value['function']); ?>" id="function_package" style="display: none;">
                                                <?php echo e(Form::label('package', __($value['function']), ['class' => 'form-label'])); ?>

                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <?php $__currentLoopData = $value['package']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $isChecked = false; ?>
                                            <?php if(isset($food_package) && !empty($food_package)): ?>
                                            <?php $__currentLoopData = $food_package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $func => $pack): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $pack; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keypac => $packval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($package == $packval): ?>
                                            <?php $isChecked = true; ?>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                                <div class="form-check" data-main-index="<?php echo e($k); ?>" data-main-package="<?php echo e($package); ?>">
                                                    <?php echo Form::checkbox('package_'.str_replace(' ', '', strtolower($value['function'])).'[]',$package, $isChecked, ['id' => 'package_' . $key.$k, 'data-function' => $value['function'], 'class' => 'form-check-input']); ?>

                                                    <?php echo e(Form::label($package, $package, ['class' => 'form-check-label'])); ?>

                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-6 need_full" id="additionalSection">
                                            <?php if(isset($additional_items) && !empty($additional_items)): ?>
                                            <?php echo e(Form::label('additional', __('Additional items'), ['class' => 'form-label'])); ?>

                                            <?php $__currentLoopData = $additional_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad_key =>$ad_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $ad_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fun_key =>$packageVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group" data-additional-index="<?php echo e($fun_key); ?>" data-additional-value="<?php echo e(key($packageVal)); ?>" id="ad_package" style="display: none;">
                                                <?php echo e(Form::label('additional', __($fun_key), ['class' => 'form-label'])); ?>

                                                <?php $__currentLoopData = $packageVal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pac_key =>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-check" data-additional-index="<?php echo e($pac_key); ?>" data-additional-package="<?php echo e($pac_key); ?>">
                                                    <?php echo Form::checkbox('additional_'.str_replace(' ', '_', strtolower($fun_key)).'[]',$pac_key, null, ['data-function' => $fun_key, 'class' => 'form-check-input']); ?>

                                                    <?php echo e(Form::label($pac_key, $pac_key, ['class' => 'form-check-label'])); ?>

                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <label><b>Setup</b></label>
                                                <?php $__currentLoopData = $setup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-6  mt-4 need_full">
                                                    <input type="radio" id="image_<?php echo e($loop->index); ?>" name="uploadedImage" class="form-check-input " value="<?php echo e(asset('/floor_images/' . $s->image)); ?>" style="display:none;" <?php echo e(asset('floor_images/' .$s->image)==$meeting->floor_plan ? 'checked' : ''); ?>>
                                                    <label for="image_<?php echo e($loop->index); ?>" class="form-check-label">
                                                        <img src="<?php echo e(asset('floor_images/'.$s->image)); ?>" alt="Uploaded Image" class="img-thumbnail floorimages zoom" data-bs-toggle="tooltip" title="<?php echo e($s->Description); ?>">
                                                    </label>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="special_req" class="card">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <h5><?php echo e(__('Any Special Requirements')); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <!-- <?php echo Form::checkbox('room', 1, null, ['id'=>'room', 'class' => 'checkbox']); ?>

                                                <?php echo Form::label('room', 'Rooms at the hotel'); ?>  -->
                                            <?php echo e(Form::label('rooms',__('Room'),['class'=>'form-label'])); ?>

                                            <input type="number" name="rooms" min=0 class="form-control" value="<?php echo e($meeting->room); ?>">
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo Form::label('meal', 'Meal Preference'); ?>

                                               
                                                <?php $__currentLoopData = $meal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div>
                                                    <?php echo e(Form::radio('meal', $label , false, ['id' => $label])); ?>

                                                    <?php echo e(Form::label('meal' . ($key + 1), $label)); ?>

                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <?php echo Form::label('baropt', 'Bar'); ?>

                                                <?php $__currentLoopData = $baropt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div>
                                                    <?php echo e(Form::radio('baropt', $label, isset($meeting->bar) && $meeting->bar == $label ? true :false, ['id' => $label])); ?>

                                                    <?php echo e(Form::label('baropt' . ($key + 1), $label)); ?>

                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full" id="barpacakgeoptions" style="display: none;">
                                            <?php if(isset($bar_package) && !empty($bar_package)): ?>
                                            <?php $__currentLoopData = $bar_package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group" data-main-index="<?php echo e($key); ?>" data-main-value="<?php echo e($value['bar']); ?>">
                                                <?php echo e(Form::label('bar', __($value['bar']), ['class' => 'form-label'])); ?>

                                                <?php $__currentLoopData = $value['barpackage']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $bar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-check" data-main-index="<?php echo e($k); ?>" data-main-package="<?php echo e($bar); ?>">
                                                    <?php echo Form::radio('bar'.'_'.str_replace(' ', '', strtolower($value['bar'])), $bar, false, ['id' => 'bar_' . $key.$k, 'data-function' => $value['bar'], 'class' => 'form-check-input']); ?>

                                                    <?php echo e(Form::label($bar, $bar, ['class' => 'form-check-label'])); ?>

                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <?php echo e(Form::label('spcl_request',__('Special Requests / Considerations'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('spcl_request',null,array('class'=>'form-control'))); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="other_info" class="card">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <h5><?php echo e(__('Other Information')); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <?php echo e(Form::label('allergies',__('Allergies'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('allergies',null,array('class'=>'form-control','placeholder'=>__('Enter Allergies(if any)')))); ?>

                                            </div>
                                        </div>
                                        <div class="col-12">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('atttachment',__('Attachments (If Any)'),['class'=>'form-label'])); ?>

                                                    <input type="file" name="atttachment" id="atttachment" class="form-control">

                                                </div>
                                            </div>

                                    </div>
                              
                                <div class="row">
                                <div class="col-12">
                                <div class="col-6 need_full">
                                    <div class="form-group">
                                        <?php echo e(Form::label('status', __('Status'), ['class' => 'form-label'])); ?>

                                        <div class="checkbox-group">
                                            <input type="checkbox" id="approveCheckbox" name="status" value="Approve" <?php echo e($meeting->status == 2 ? 'checked' : ''); ?>>
                                            <label for="approveCheckbox">Approve</label>

                                            <input type="checkbox" id="resendCheckbox" name="status" value="Resend" <?php echo e($meeting->status == 0 ? 'checked' : ''); ?>>
                                            <label for="resendCheckbox">Resend</label>

                                            <input type="checkbox" id="withdrawCheckbox" name="status" value="Withdraw" <?php echo e($meeting->status == 3 ? 'checked' : ''); ?>>
                                            <label for="withdrawCheckbox">Withdraw</label>
                                        </div>
                                    </div>
                                </div>
</div>
</div>
</div>
                                <div class="card-footer text-end">
                                    <?php echo e(Form::submit(__('Submit'), ['class' => 'btn  btn-primary '])); ?>

                                </div>
                            </div>
                        </div>

                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<style>
.iti.iti--allow-dropdown.iti--separate-dial-code {
    width: 100%;
}
</style>
<script>
function validateCheckboxGroup(groupName) {
    var checkboxes = $("input[name='" + groupName + "']");
    var isChecked = checkboxes.is(":checked");
    var errorMessage = '';
    if (!isChecked) {
            if (checkboxes.attr('type') === 'checkbox') {
                errorMessage = 'At least one ' + groupName.replace('[]', '') + ' must be selected.';
            } else if (checkboxes.attr('type') === 'radio') {
                errorMessage = 'Please select one ' + groupName.replace('[]', '') + '.';
            }
        }
    // if (!isChecked) {
    //     errorMessage = 'At least one ' + groupName.replace('[]', '') + ' must be selected.';
    // }

    // Remove any existing error message
    checkboxes.closest('.form-group').find('.validation-error').remove();

    // Append the error message if it exists
    if (errorMessage != '') {
        checkboxes.closest('.form-group').append(
            '<div class="validation-error text-danger" style="padding:2px;">' +
            errorMessage + '</div>');
    }
}
$(document).ready(function() {
    // Attach a keyup event listener to input fields
    $('input').on('keyup', function() {
        // Get the input value
        var value = $(this).val();
        // Check if the input value contains spaces
        if (value.indexOf(' ') !== -1) {
            // Display validation message
            $('#validationMessage').text('Spaces are not allowed in this field').show();
        } else {
            // Hide validation message if no spaces are found
            $('#validationMessage').hide();
        }
    });
});
$('#formdata').on('submit', function(event) {
    let isValid = true;

    // Remove previous error messages
    $('.error-message').remove();

    // Function to display error messages
    function displayError(inputId, message) {
        $(`<span class="error-message">${message}</span>`).insertAfter(`#${inputId}`);
    }


    // Name validation
    let name = $('#name').val().trim();
    if (name === '') {
        displayError('name', 'Name is required and must not contain only spaces.');
        isValid = false;
    }
    let startTime = $('#start_time').val();
    let endTime = $('#end_time').val();
    if (startTime != '' && endTime <= startTime) {
        displayError('end_time', 'End time must be after start time.');
        isValid = false;
    }

    // Prevent form submission if any validation fails
    if (!isValid) {
        event.preventDefault();
    }
});
$(document).ready(function() {
    $("input[type='text'][name='lead_name'],input[type='text'][name='name'],input[type='text'][name='email'], select[name='type'],input[type='tel'][name='phone'],input[name='guest_count'],input[name='start_date'],input[name='start_time'],input[name='end_time'],input[type='checkbox']")
        .focusout(function() {

            var input = $(this);
            var errorMessage = '';
            if (input.attr('name') === 'email' && input.val() !== '') {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(input.val())) {
                    errorMessage = 'Invalid email address.';
                }
            } else if (input.val() == '') {
                errorMessage = 'This field is required.';
            }

            if (errorMessage != '') {
                input.css('border', 'solid 2px red');
            } else {
                // If it is not blank. 
                input.css('border', 'solid 2px black');
            }

            // Remove any existing error message
            input.next('.validation-error').remove();

            // Append the error message if it exists
            if (errorMessage != '') {
                input.after('<div class="validation-error text-danger" style="padding:2px;">' +
                    errorMessage + '</div>');
            }
            $("input[name='user[]']").change(validateCheckboxGroup('user[]'));
            $("input[name='user[]']").focusout(validateCheckboxGroup('user[]'));
            $("input[name='venue[]']").change(validateCheckboxGroup('venue[]'));
            $("input[name='venue[]']").focusout(validateCheckboxGroup('venue[]'));
            $("input[name='function[]']").change(validateCheckboxGroup('function[]'));
            $("input[name='function[]']").focusout(validateCheckboxGroup('function[]'));
            $("input[type='radio'][name='meal']").focusout(validateInputGroup('meal'));
            $("input[type='radio'][name='meal']").change(validateInputGroup('meal'));
});
});
</script>
<script>
$(document).ready(function() {
    var phoneNumber = "<?php echo $meeting->phone;?>";
    var num = phoneNumber.trim();
    // if (phoneNumber.trim().length < 10) {
    //     alert('Please enter a valid phone number with at least 10 digits.');
    //     return;
    // }
    var lastTenDigits = phoneNumber.substr(-10);
    var formattedPhoneNumber = '(' + lastTenDigits.substr(0, 3) + ') ' + lastTenDigits.substr(3, 3) + '-' +
        lastTenDigits.substr(6);
    $('#phone-input').val(formattedPhoneNumber);
})
</script>
<script>
$(document).ready(function() {
    var input = document.querySelector("#phone-input");
    var iti = window.intlTelInput(input, {
        separateDialCode: true,
    });

    var indiaCountryCode = iti.getSelectedCountryData().iso2;
    var countryCode = iti.getSelectedCountryData().dialCode;
    $('#country-code').val(countryCode);
    if (indiaCountryCode !== 'us') {
        iti.setCountry('us');
    }
});

</script>
<script>
const isNumericInput = (event) => {
    const key = event.keyCode;
    return ((key >= 48 && key <= 57) || // Allow number line
        (key >= 96 && key <= 105) // Allow number pad
    );
};
const isModifierKey = (event) => {
    const key = event.keyCode;
    return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
        (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
        (key > 36 && key < 41) || // Allow left, up, right, down
        (
            // Allow Ctrl/Command + A,C,V,X,Z
            (event.ctrlKey === true || event.metaKey === true) &&
            (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
        )
};
const enforceFormat = (event) => {
    // Input must be of a valid number format or a modifier key, and not longer than ten digits
    if (!isNumericInput(event) && !isModifierKey(event)) {
        event.preventDefault();
    }
};
const formatToPhone = (event) => {
    if (isModifierKey(event)) {
        return;
    }
    // I am lazy and don't like to type things more than once
    const target = event.target;
    const input = event.target.value.replace(/\D/g, '').substring(0, 10); // First ten digits of input only
    const zip = input.substring(0, 3);
    const middle = input.substring(3, 6);
    const last = input.substring(6, 10);

    if (input.length > 6) {
        target.value = `(${zip}) ${middle} - ${last}`;
    } else if (input.length > 3) {
        target.value = `(${zip}) ${middle}`;
    } else if (input.length > 0) {
        target.value = `(${zip}`;
    }
};
const inputElement = document.getElementById('phone-input');
inputElement.addEventListener('keydown', enforceFormat);
inputElement.addEventListener('keyup', formatToPhone);
</script>
<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
    $(document).ready(function() {
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
        var selectedValue = $('input[name="bar"]:checked').val();
        if (selectedValue == 'Package Choice') {
            $('#package').show();
        }
    });
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
</script>

<script>
    document.getElementById('opencontact').addEventListener('click', function(event) {
        var x = document.getElementById("contact-info");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
        event.stopPropagation();
        event.preventDefault();
    });
</script>
<script>
    $('input:checkbox[name= "status"]').click(function() {
        var isChecked = $(this).prop('checked');
        var group = $(this).attr('name');

        if (isChecked) {
            $('input[name="' + group + '"]').not(this).prop('checked', false);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('input[name="uploadedImage"]').change(function() {
            $('.floorimages').removeClass('selected-image');

            if ($(this).is(':checked')) {
                var imageId = $(this).attr('id');
                $('label[for="' + imageId + '"] img').addClass('selected-image');
            }
        });
    });
</script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/meeting/agreement/review_agreement.blade.php ENDPATH**/ ?>