
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
    $bar = ['Open Bar', 'Cash Bar', 'Package Choice'];
    $platinum = ['Platinum - 4 Hours', 'Platinum - 3 Hours', 'Platinum - 2 Hours'];
    $gold = ['Gold - 4 Hours', 'Gold - 3 Hours', 'Gold - 2 Hours'];
    $silver = ['Silver - 4 Hours', 'Silver - 3 Hours', 'Silver - 2 Hours'];
    $beer = ['Beer & Wine - 4 Hours', 'Beer & Wine - 3 Hours', 'Beer & Wine - 2 Hours'];
    $function = explode(',',$setting['function']);
    ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('meeting.index')); ?>"><?php echo e(__('Event')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Review')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
    .floorimages{
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
        <div id="sidebar-wrapper">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                    <a href="#useradd-1" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                        <span class="dash-mtext"><?php echo e(__('Review Event')); ?> </span></a>
                </div>
            </div>
        </div>
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('attendees_lead', __('Lead'), ['class' => 'form-label'])); ?>

                                                <?php echo e(Form::text('attendees_lead',$attendees_lead,array('class'=>'form-control','required'=>'required','readonly'=>'readonly'))); ?>

                                            </div>
                                        </div>
                                        <div class="col-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('Assigned Staff',__('Assigned Staff'),['class'=>'form-label'])); ?>

                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="user[]" value="<?php echo e($user->id); ?>" id="user_<?php echo e($user->id); ?>"<?php echo e(in_array($user->id, $user_id) ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="user_<?php echo e($user->id); ?>">
                                                        <?php echo e($user->name); ?> (<?php echo e($user->type); ?>)
                                                    </label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('company_name',__('Company Name'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter Company Name'),'required'=>'required'))); ?>

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
                                        
                                        <div id = "contact-info" style = "display:none">
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
                                            <button  data-bs-toggle="tooltip" id="opencontact" 
                                                title="<?php echo e(__('Add Contact')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
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
                        <div id ="event-details" class="card">
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
                                                <?php echo e(Form::label('type',__('Event Type'),['class'=>'form-label'])); ?>

                                                <?php echo Form::select('type', $type_arr, null,array('class' => 'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="venue" class="form-label"><?php echo e(__('Venue')); ?></label>
                                                <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div>
                                                        <input type="checkbox" name="venue[]" id="<?php echo e($label); ?>" value="<?php echo e($label); ?>" 
                                                            <?php echo e(in_array($label, $venue_function) ? 'checked' : ''); ?>>
                                                        <label for="<?php echo e($label); ?>"><?php echo e($label); ?></label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                                                <?php echo Form::date('start_date', null, ['class' => 'form-control', 'required' => 'required']); ?>

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                                                <?php echo Form::date('end_date', null, ['class' => 'form-control', 'required' => 'required']); ?>

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('start_time', __('Start Time'), ['class' => 'form-label'])); ?>

                                                <?php echo Form::input('time', 'start_time',null, ['class' => 'form-control', 'required' => 'required']); ?>

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('end_time', __('End Time'), ['class' => 'form-label'])); ?>

                                                <?php echo Form::input('time', 'end_time', null, ['class' => 'form-control', 'required' => 'required']); ?>

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('guest_count',__('Guest Count'),['class'=>'form-label'])); ?>

                                                <?php echo Form::number('guest_count', null,array('class' => 'form-control','min'=> 0)); ?>

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('function', __('Function'), ['class' => 'form-label'])); ?>

                                                <br>
                                                <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <label>
                                                        <input type="checkbox" id="<?php echo e($value); ?>" name="function[]" value="<?php echo e($value); ?>" class="function-checkbox" <?php echo e(in_array($value, $function_p) ? 'checked' : ''); ?> onchange="toggleDiv('<?php echo e($value); ?>')">
                                                        <?php echo e($value); ?>

                                                    </label>
                                                    <br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <div class="col-6" id="breakfast">
                                            <div class="form-group">
                                                <?php echo e(Form::label('break_package', __('Breakfast Package'), ['class' => 'form-label'])); ?>

                                                <?php $__currentLoopData = $breakfast; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div>
                                                        <?php echo e(Form::radio('break_package[]', $label, in_array($label, $food_package), ['id' => $label])); ?>

                                                        <?php echo e(Form::label($label, $label)); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                            </div>
                                        </div>
                                        <div class="col-6" id="lunch">
                                            <div class="form-group">
                                                <?php echo e(Form::label('lunch_package', __('Lunch Package'), ['class' => 'form-label'])); ?>

                                                <?php $__currentLoopData = $lunch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div>
                                                        <?php echo e(Form::radio('lunch_package[]', $label, in_array($label, $food_package), ['id' => 'lunch_package' . ($key + 1)])); ?>

                                                        <?php echo e(Form::label($label, $label)); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                            </div>
                                        </div>

                                        <div class="col-6" id="dinner">
                                            <div class="form-group">
                                                <?php echo e(Form::label('dinner_package', __('Dinner Package'), ['class' => 'form-label'])); ?>

                                                <?php $__currentLoopData = $dinner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div>
                                                        <?php echo e(Form::radio('dinner_package[]', $label, in_array($label, $food_package), ['id' => 'dinner_package' . ($key + 1)])); ?>

                                                        <?php echo e(Form::label($label, $label)); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                            </div>
                                        </div>

                                        <div class="col-6" id="wedding">
                                            <div class="form-group">
                                                <?php echo e(Form::label('wedding_package', __('Wedding Package'), ['class' => 'form-label'])); ?>

                                                <?php $__currentLoopData = $wedding; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div>
                                                        <?php echo e(Form::radio('wedding_package[]', $label, in_array($label, $food_package), ['id' => 'wedding_package' . ($key + 1)])); ?>

                                                        <?php echo e(Form::label($label, $label)); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                            </div>
                                        </div> 
                                        <div class = "col-12">
                                            <?php echo e(Form::label('add_opts',__('Additional Options'),['class'=>'form-label'])); ?>

                                            <button  data-bs-toggle="tooltip" id = "ad_opt" class="btn btn-sm  btn-icon m-1">
                                                <i class="ti ti-plus"></i></button>
                                        </div>
                                        <div class="col-12" id ='add_opts' style ="display:none" >
                                            <div class="form-group">
                                                <?php echo e(Form::text('add_opts',null,array('class'=>'form-control','placeholder'=>__('Any Additional Optionas')))); ?>

                                            </div>
                                        </div> 
                                        <div class="col-12">
                                        <div class="row">
                                            <label><b>Setup</b></label>
                                            <?php $__currentLoopData = $setup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-6  mt-4">    
                                                    <input type="radio" id="image_<?php echo e($loop->index); ?>" name="uploadedImage" class="form-check-input " value="<?php echo e(asset('/floor_images/' . $s->image)); ?>" style="display:none;"<?php echo e($meeting->floor_plan ==$s->image ? 'checked' :''); ?>>
                                                    <label for="image_<?php echo e($loop->index); ?>" class="form-check-label">
                                                        <img src="<?php echo e(asset('floor_images/'.$s->image)); ?>" alt="Uploaded Image" class="img-thumbnail floorimages zoom"data-bs-toggle="tooltip" title="<?php echo e($s->Description); ?>">
                                                    </label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="special_req" class= "card">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <h5><?php echo e(__('Any Special Requirements')); ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class ="row">
                                            <div class="form-group">
                                                <!-- <?php echo Form::checkbox('room', 1, null, ['id'=>'room', 'class' => 'checkbox']); ?>

                                                <?php echo Form::label('room', 'Rooms at the hotel'); ?>  -->
                                                <?php echo e(Form::label('rooms',__('Room'),['class'=>'form-label'])); ?>

                                            <input type="number" name="rooms" min = 0 class = "form-control" value="<?php echo e($meeting->room); ?>" > 
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
                                            <?php echo Form::label('bar', 'Bar'); ?>

                                            <?php $__currentLoopData = $bar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div>
                                                    <?php echo e(Form::radio('bar', $label, false, ['id' => $label])); ?>

                                                    <?php echo e(Form::label('bar' . ($key + 1), $label)); ?>

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class="row" id = "package" style = "display:none">
                                        <?php echo e(Form::label('bar_package', __('Bar Packages'), ['class' => 'form-label'])); ?>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('platinum_package', __('Platinum Package'), ['class' => 'form-label'])); ?>

                                                <?php $__currentLoopData = $platinum; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div>
                                                        <?php echo e(Form::radio('bar_package', 'platinum_package' . ($key + 1), false)); ?>

                                                        <?php echo e(Form::label('platinum_package' . ($key + 1), $label)); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('gold_package', __('Gold Package'), ['class' => 'form-label'])); ?>

                                                <?php $__currentLoopData = $gold; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div>
                                                        <?php echo e(Form::radio('bar_package', 'gold_package' . ($key + 1), false)); ?>

                                                        <?php echo e(Form::label('gold_package' . ($key + 1), $label)); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <?php echo e(Form::label('silver_package', __('Silver Package'), ['class' => 'form-label'])); ?>

                                                <?php $__currentLoopData = $silver; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div>
                                                        <?php echo e(Form::radio('bar_package', 'silver_package' . ($key + 1), false)); ?>

                                                        <?php echo e(Form::label('silver_package' . ($key + 1), $label)); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                            </div>
                                        </div>
                                        <div class="col-6" >
                                            <div class="form-group" >
                                                <?php echo e(Form::label('beer_package', __('Beer & Wine'), ['class' => 'form-label'])); ?>

                                                <?php $__currentLoopData = $beer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div>
                                                        <?php echo e(Form::radio('bar_package', 'beer_package' . ($key + 1), false)); ?>

                                                        <?php echo e(Form::label('beer_package' . ($key + 1), $label)); ?>

                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                            </div>
                                        </div>
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
                        <div id="other_info" class ="card">
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
                                <div class="col-6">
                                    <div class="form-group">
                                    <?php echo e(Form::label('status', __('Status'), ['class' => 'form-label'])); ?>

                                    <div class="checkbox-group">
                                        <input type="checkbox" id="approveCheckbox" name="status" value="Approve"<?php echo e($meeting->status == 2 ? 'checked' : ''); ?>>
                                        <label for="approveCheckbox">Approve</label>

                                        <input type="checkbox" id="resendCheckbox" name="status" value="Resend" <?php echo e($meeting->status == 0 ? 'checked' : ''); ?>>
                                        <label for="resendCheckbox">Resend</label>

                                        <input type="checkbox" id="withdrawCheckbox" name="status" value="Withdraw"<?php echo e($meeting->status == 3 ? 'checked' : ''); ?>>
                                        <label for="withdrawCheckbox">Withdraw</label>
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
    <!-- <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-2">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-1" class="list-group-item list-group-item-action"><?php echo e(__('Review Event')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10">
                     
                </div>
            </div>
    </div> -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
        $(document).ready(function() {
        var selectedValue = $('input[name="bar"]:checked').val();
        // alert(selectedValue);
        if(selectedValue == 'Package Choice'){
                    $('#package').show();
        }    
    });
        $('input[type=radio][name=bar]').change(function() {
            $('#package').hide();
                var val = $(this).val();
                if(val == 'Package Choice'){
                    $('#package').show();
                }
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
    document.addEventListener("DOMContentLoaded", function () {
        var checkboxes = document.querySelectorAll('.function-checkbox');
        checkboxes.forEach(function (checkbox) {
            toggleDiv(checkbox.id);
        });
        document.getElementById('ad_opt').addEventListener('click', function(event) {
            $('#add_opts').toggle();
            event.stopPropagation();
            event.preventDefault();
        });
        function toggleDiv(value) {
            var divId = value.toLowerCase();
            var div = document.getElementById(divId);

            if (div) {
                div.style.display = document.getElementById(value).checked ? 'block' : 'none';
            }
        }

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                toggleDiv(checkbox.id);
            });
        });
    });
</script>
<script>
        $('input:checkbox[name= "status"]').click(function(){
            var isChecked = $(this).prop('checked');
            var group = $(this).attr('name');

            if (isChecked) {
                $('input[name="' + group + '"]').not(this).prop('checked', false);
            }
        });
</script>
<script>
        $(document).ready(function () {
            $('input[name="uploadedImage"]').change(function () {
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