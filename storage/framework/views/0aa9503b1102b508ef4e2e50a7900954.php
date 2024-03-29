
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Event Create')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Create Event')); ?>

<?php $__env->stopSection(); ?>
<?php
$plansettings = App\Models\Utility::plansettings();
$setting = App\Models\Utility::settings();
$type_arr= explode(',',$setting['event_type']);
$type_arr = array_combine($type_arr, $type_arr);
$venue = explode(',',$setting['venue']);
if(isset($setting['function']) && !empty($setting['function'])){
$function = json_decode($setting['function'],true);
}
if(isset($setting['additional_items']) && !empty($setting['additional_items'])){
$additional_items = json_decode($setting['additional_items'],true);
}
$meal = ['Formal Plated' ,'Buffet Style' , 'Family Style'];
$baropt = ['Open Bar', 'Cash Bar', 'Package Choice'];
if(isset($setting['barpackage']) && !empty($setting['barpackage'])){
$bar_package = json_decode($setting['barpackage'],true);
}
?>
<?php $__env->startSection('content'); ?>
<style>
    .floorimages {
        height: 400px;
        width: 600px;
        margin: 26px;
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
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <h5><?php echo e(__('Event')); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo e(Form::label('Select Existing Lead/New Event',__('Select Existing Lead/New Event'),['class'=>'form-label'])); ?>

                                    <div class="form-group">
                                        <?php echo e(Form::radio('newevent',__('Existing Lead'),false)); ?>

                                        <?php echo e(Form::label('newevent','Existing Lead')); ?>

                                        <?php echo e(Form::radio('newevent',__('New Event'),false)); ?>

                                        <?php echo e(Form::label('newevent','New Event')); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="event_option" style="display: none;">
                            <?php echo e(Form::open(['url' => 'meeting', 'method' => 'post', 'enctype' => 'multipart/form-data','id'=>'formdata'] )); ?>

                            <div id="useradd-1" class="card">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <h5><?php echo e(__('Create Event')); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6" id="lead_select" style="display: none;">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('lead', __('Lead'), ['class' => 'form-label'])); ?>

                                                    <?php echo Form::select('lead', $attendees_lead, null, ['class' => 'form-control']); ?>

                                                </div>
                                            </div>
                                            <div class="col-6" id="new_event" style="display: none;">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('eventname', __('Event Name'), ['class' => 'form-label'])); ?>

                                                    <?php echo e(Form::text('eventname',null,array('class'=>'form-control','placeholder'=>__('Enter Event Name')))); ?>

                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('Assigned Staff',__('Assigned Staff'),['class'=>'form-label'])); ?>

                                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="user[]" value="<?php echo e($user->id); ?>" id="user_<?php echo e($user->id); ?>">
                                                        <label class="form-check-label" for="user_<?php echo e($user->id); ?>">
                                                            <?php echo e($user->name); ?> (<?php echo e($user->type); ?>)
                                                        </label>
                                                    </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($errors->has('user')): ?>
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('user')); ?></strong>
            </span>
        <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('type',__('Event Type'),['class'=>'form-label'])); ?>

                                                    <?php echo Form::select('type', $type_arr, null,array('class' => 'form-control')); ?>

                                                </div>
                                                <?php if($errors->has('type')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('type')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('company_name',__('Company Name'),['class'=>'form-label'])); ?>

                                                    <?php echo e(Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter Company Name')))); ?>

                                                </div>
                                                <?php if($errors->has('company_name')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('company_name')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                                <h5 style="margin-left: 14px;"><?php echo e(__('Contact Information')); ?></h5>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

                                                    <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

                                                </div>
                                                <?php if($errors->has('name')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
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
                                                <?php if($errors->has('email')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('lead_address',__('Address'),['class'=>'form-label'])); ?>

                                                    <?php echo e(Form::text('lead_address',null,array('class'=>'form-control','placeholder'=>__('Address')))); ?>

                                                </div>
                                               
                                            </div>
                                            <div class="col-6">
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
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <?php echo e(Form::label('alter_name',__('Name'),['class'=>'form-label'])); ?>

                                                            <?php echo e(Form::text('alter_name',null,array('class'=>'form-control','placeholder'=>__('Enter Name')))); ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <?php echo e(Form::label('alter_phone',__('Phone'),['class'=>'form-label'])); ?>

                                                            <?php echo e(Form::text('alter_phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone')))); ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <?php echo e(Form::label('alter_email',__('Email'),['class'=>'form-label'])); ?>

                                                            <?php echo e(Form::text('alter_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email')))); ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <?php echo e(Form::label('alter_lead_address',__('Address'),['class'=>'form-label'])); ?>

                                                            <?php echo e(Form::text('alter_lead_address',null,array('class'=>'form-control','placeholder'=>__('Address')))); ?>

                                                        </div>
                                                    </div>

                                                    <div class="col-6">
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


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('guest_count',__('Guest Count'),['class'=>'form-label'])); ?>

                                                    <?php echo Form::number('guest_count', null,array('class' => 'form-control','min'=> 0)); ?>

                                                </div>
                                                <?php if($errors->has('guest_count')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('guest_count')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="venue_selection" class="form-label">Venue</label>
                                                    <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div>
                                                        <input type="checkbox" name="venue[]" value="<?php echo e($label); ?>" id="venue<?php echo e($key + 1); ?>">
                                                        <label for="<?php echo e($label); ?>"><?php echo e($label); ?></label>
                                                    </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <?php if($errors->has('venue')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('venue')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>



                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                                                    <?php echo Form::date('start_date', null, ['class' => 'form-control', 'required' => 'required']); ?>

                                                </div>
                                                <?php if($errors->has('start_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('start_date')); ?></strong>
                                                    </span>
                                                <?php endif; ?>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                                                    <?php echo Form::date('end_date',null, ['class' => 'form-control', 'required' => 'required']); ?>

                                                </div>
                                                <?php if($errors->has('end_date')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('end_date')); ?></strong>
                                                    </span>
                                                <?php endif; ?>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('start_time', __('Start Time'), ['class' => 'form-label'])); ?>

                                                    <?php echo Form::input('time', 'start_time', null, ['class' => 'form-control', 'required' => 'required']); ?>

                                                </div>
                                                <?php if($errors->has('start_time')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('start_time')); ?></strong>
                                                    </span>
                                                <?php endif; ?>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('end_time', __('End Time'), ['class' => 'form-label'])); ?>

                                                    <?php echo Form::input('time', 'end_time', null, ['class' => 'form-control', 'required' => 'required']); ?>

                                                </div>
                                                <?php if($errors->has('end_time')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('end_time')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('function', __('Function'), ['class' => 'form-label'])); ?>

                                                    <?php if(isset($function) && !empty($function)): ?>
                                                    <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check">
                                                        <?php echo Form::checkbox('function[]',$value['function'], null, ['id' => 'function_' . $key, 'class' => 'form-check-input']); ?>

                                                        <?php echo e(Form::label($value['function'], $value['function'], ['class' => 'form-check-label'])); ?>

                                                    </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if($errors->has('function')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('end_time')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-6" id="mailFunctionSection">
                                                <?php if(isset($function) && !empty($function)): ?>
                                                <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-group" data-main-index="<?php echo e($key); ?>" data-main-value="<?php echo e($value['function']); ?>" id="function_package" style="display: none;">
                                                    <?php echo e(Form::label('package', __($value['function']), ['class' => 'form-label'])); ?>

                                                    <?php $__currentLoopData = $value['package']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check" data-main-index="<?php echo e($k); ?>" data-main-package="<?php echo e($package); ?>">
                                                        <?php echo Form::checkbox('package_'.str_replace(' ', '', strtolower($value['function'])).'[]',$package, null, ['id' => 'package_' . $key.$k, 'data-function' => $value['function'], 'class' => 'form-check-input']); ?>

                                                        <?php echo e(Form::label($package, $package, ['class' => 'form-check-label'])); ?>

                                                    </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-6" id="additionalSection">
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
                                                    <div class="col-6  mt-4">
                                                        <input type="radio" id="image_<?php echo e($loop->index); ?>" name="uploadedImage" class="form-check-input " value="<?php echo e(asset('floor_images/' . $s->image)); ?>" style="display:none;">
                                                        <label for="image_<?php echo e($loop->index); ?>" class="form-check-label">
                                                            <img src="<?php echo e(asset('floor_images/'.$s->image)); ?>" alt="Uploaded Image" class="img-thumbnail floorimages zoom" data-bs-toggle="tooltip" title="<?php echo e($s->Description); ?>">
                                                        </label>
                                                    </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                <?php $__errorArgs = ['uploadedImage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="alert alert-danger mt-1 mb-1"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                                <?php echo e(Form::label('rooms',__('Room'),['class'=>'form-label'])); ?>

                                                <input type="number" name="rooms" min=0 class="form-control">

                                            </div>
                                            <div class="col-6">
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
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <input type="reset" id="resetForm" value="" style="display: none;">
                                        <?php echo e(Form::submit(__('Save'), ['class' => 'btn  btn-primary '])); ?>

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
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    document.addEventListener('DOMContentLoaded', async function() {
        try {
            const getSessionStorage = () => {
                return new Promise((resolve, reject) => {
                    try {
                        const storedSessionData = window.sessionStorage.getItem("selectedDate");
                        resolve(storedSessionData);
                    } catch (error) {
                        reject(error);
                    }
                });
            };
            const storedSessionData = await getSessionStorage();
            if (storedSessionData) {
                console.log(`sessionStorage: ${storedSessionData}`);
                document.getElementById('newevent').click();
                const startDateInput = document.getElementById('start_date');
                if (startDateInput) {
                    startDateInput.setAttribute('value', storedSessionData);
                    startDateInput.value = storedSessionData;
                    console.log("Value set successfully.");
                } else {
                    console.error("Element with ID 'start_date' not found.");
                }
            } else {
                console.log("No sessionStorage data found.");
            }
        } catch (error) {
            console.error("Error occurred while retrieving sessionStorage:", error);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('input[name=newevent]').prop('checked', false);
        $('input[name="newevent"]').on('click', function() {
            $('#lead_select').hide();
            $('#new_event').hide();
            $('#event_option').show();
            var selectedValue = $(this).val();
            if (selectedValue == 'Existing Lead') {
                $('#lead_select').show();
            } else {
                $('#new_event').show();
                $('input#resetForm').trigger('click');
            }
        });
        $('select[name= "lead"]').on('change', function() {
            $("input[name='user[]'").prop('checked', false);
            $("input[name='bar']").prop('checked', false);
            $("input[name='user[]']").prop('checked', false);
            $("input[name='venue[]']").prop('checked', false);
            $("input[name='function[]']").prop('checked', false);
            var venu = this.value;
            $.ajax({
                url: "<?php echo e(route('meeting.lead')); ?>",
                type: 'POST',
                data: {
                    "venue": venu,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    venue_str = data.venue_selection;
                    venue_arr = venue_str.split(",");
                    func_str = data.function;
                    func_arr = func_str.split(",");
                    $('input[name ="company_name"]').val(data.company_name);
                    $('input[name ="name"]').val(data.name);
                    $('input[name ="phone"]').val(data.phone);
                    $('input[name ="relationship"]').val(data.relationship);
                    $('input[name ="start_date"]').val(data.start_date);
                    $('input[name ="end_date"]').val(data.end_date);
                    $('input[name ="start_time"]').val(data.start_time);
                    $('input[name ="end_time"]').val(data.end_time);
                    $('input[name ="rooms"]').val(data.rooms);
                    $('input[name ="email"]').val(data.email);
                    $('input[name ="lead_address"]').val(data.lead_address);
                    $("select[name='type'] option[value='" + data.type + "']").prop("selected", true);
                    $("input[name='bar'][value='" + data.bar + "']").prop('checked', true);
                    $("input[name='user[]'][value='" + data.assigned_user + "']").prop('checked', true);
                    $.each(venue_arr, function(i, val) {
                        $("input[name='venue[]'][value='" + val + "']").prop('checked', true);
                    });

                    $.each(func_arr, function(i, val) {
                        $("input[name='function[]'][value='" + val + "']").prop('checked', true);
                    });
                    $('input[name ="guest_count"]').val(data.guest_count);
                    var checkedFunctions = $('input[name="function[]"]:checked').map(function() {
                        return $(this).val();
                    }).get();
                    var mailFunctionSection = document.getElementById('mailFunctionSection');
                    var divs = mailFunctionSection.querySelectorAll('.form-group');
                    divs.forEach(function(div) {
                        var mainValue = div.getAttribute('data-main-value');
                        if (checkedFunctions.includes(mainValue)) {
                            div.style.display = 'block';
                        } else {
                            div.style.display = 'none';
                        }
                    });                   
                }
            });
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
               if(value == 'Package Choice'){
                    $('div#barpacakgeoptions').show();
               }
            });
        });
    });
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/meeting/create.blade.php ENDPATH**/ ?>