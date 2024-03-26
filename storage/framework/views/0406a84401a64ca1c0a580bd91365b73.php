<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Lead Edit')); ?>

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
<?php $__env->startSection('title'); ?>
    <div class="page-header-title">
        <?php echo e(__('Edit Lead')); ?> <?php echo e('(' . $lead->name . ')'); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('lead.index')); ?>"><?php echo e(__('Lead')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Details')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
        
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                    <div id="useradd-1" class="card">
                    <?php echo e(Form::model($lead, ['route' => ['lead.update', $lead->id], 'method' => 'PUT', 'id' => "formdata"])); ?>

                    <div class="card-header">
                        <h5><?php echo e(__('Overview')); ?></h5>
                        <small class="text-muted"><?php echo e(__('Edit About Your Lead Information')); ?></small>
                    </div>
                    <div class="card-body"> 
                            <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('lead_name',__('Lead Name'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::text('lead_name',$lead->leadname,array('class'=>'form-control','placeholder'=>__('Enter Lead Name')))); ?>

                                    <?php $__errorArgs = ['lead_name'];
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

                                    <?php echo e(Form::text('relationship',null,array('class'=>'form-control','placeholder'=>__('Enter Relationship'),'required'=>'required'))); ?>

                                </div>
                            </div>
                            <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                <h5 style="margin-left: 14px;"><?php echo e(__('Event Details')); ?></h5>
                            </div>
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
                                            <?php echo e(in_array($label, @$venue_function) ? 'checked' : ''); ?>>
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
                                    <?php echo e(Form::label('guest_count',__('Guest Count'),['class'=>'form-label'])); ?>

                                    <?php echo Form::number('guest_count', null,array('class' => 'form-control','min'=> 0)); ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('function', __('Function'), ['class' => 'form-label'])); ?>

                                    <div class="checkbox-group">
                                        <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label>
                                                <input type="checkbox" id="<?php echo e($value['function']); ?>" name="function[]" value="<?php echo e($value['function']); ?>" class="function-checkbox" <?php echo e(in_array( $value['function'], $function_package) ? 'checked' : ''); ?>>
                                                <?php echo e($value['function']); ?>

                                            </label><br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6" id="mailFunctionSection">
                                            <?php if(isset($function) && !empty($function)): ?>
                                            <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-group" data-main-index="<?php echo e($key); ?>" data-main-value="<?php echo e($value['function']); ?>" id="function_package" style="display: none;">
                                                <?php echo e(Form::label('package', __($value['function']), ['class' => 'form-label'])); ?>

                                                <?php $__currentLoopData = $value['package']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div class="form-check" data-main-index="<?php echo e($k); ?>" data-main-package="<?php echo e($package); ?>">
                                                    <?php echo Form::checkbox('package_'.str_replace(' ', '', strtolower($value['function'])).'[]',$package, isset($food_package[ucfirst($value['function'])]) && in_array($package, $food_package[ucfirst($value['function'])]), ['id' => 'package_' . $key.$k, 'data-function' => $value['function'], 'class' => 'form-check-input']); ?>

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
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('Assign Staff',__('Assign Staff'),['class'=>'form-label'])); ?>

                                    <select class="form-control" name= 'user'>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option class= "form-control" value= "<?php echo e($user->id); ?>" <?php echo e($user->id == $lead->assigned_user ? 'selected' : ''); ?>><?php echo e($user->name); ?>  - <?php echo e($user->type); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12  p-0 modaltitle pb-3 mb-3">
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
                                <h5 style="margin-left: 14px;"><?php echo e(__('Estimate Billing Summary Details')); ?></h5>
                            </div>
                            <div class="col-6">
                                            <div class="form-group">
                                                <?php echo Form::label('baropt', 'Bar'); ?>

                                                <?php $__currentLoopData = $baropt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div>
                                                    <?php echo e(Form::radio('baropt', $label,false, ['id' => $label])); ?>

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
                            <div class="col-6">
                                <div class="form-group">
                                <?php echo e(Form::label('rooms',__('Room'),['class'=>'form-label'])); ?>

                                <input type="number" name="rooms" value= "<?php echo e($lead->rooms); ?>"  class = "form-control" >    
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('start_time', __('Estimated Start Time'), ['class' => 'form-label'])); ?>

                                    <?php echo Form::input('time', 'start_time', $lead->start_time, ['class' => 'form-control', 'required' => 'required']); ?>

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <?php echo e(Form::label('end_time', __('Estimated End Time'), ['class' => 'form-label'])); ?>

                                    <?php echo Form::input('time', 'end_time', $lead->end_time, ['class' => 'form-control', 'required' => 'required']); ?>

                                </div>
                            </div>
                            <div class="text-end">
                                <?php echo e(Form::submit(__('Update'), ['class' => 'btn-submit btn btn-primary'])); ?>

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
    </script>

    <script>
        $(document).on('change', 'select[name=parent]', function() {
            console.log('h');
            var parent = $(this).val();
            getparent(parent);
        });

        function getparent(bid) {
            console.log(bid);
            $.ajax({
                url: "<?php echo e(route('task.getparent')); ?>",
                type: 'POST',
                data: {
                    "parent": bid,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    console.log(data);
                    $('#parent_id').empty();
                    // 

                    $.each(data, function(key, value) {
                        $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    if (data == '') {
                        $('#parent_id').empty();
                    }
                }
            });
        }
    </script>
    <script>
        $(document).on('click', '#billing_data', function() {
            $("[name='shipping_address']").val($("[name='billing_address']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/lead/edit.blade.php ENDPATH**/ ?>