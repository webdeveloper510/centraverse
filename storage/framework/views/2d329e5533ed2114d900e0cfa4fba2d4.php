<?php
    $plansettings = App\Models\Utility::plansettings();
    $settings = Utility::settings();
    $type_arr= explode(',',$settings['event_type']);
    $type_arr = array_combine($type_arr, $type_arr);
    $venue = explode(',',$settings['venue']);
    $function = explode(',',$settings['function']);
    $function = array_combine($function, $function);
    $bar = ['Open Bar', 'Cash Bar', 'Package Choice'];
    $platinum = ['Platinum - 4 Hours', 'Platinum - 3 Hours', 'Platinum - 2 Hours'];
    $gold = ['Gold - 4 Hours', 'Gold - 3 Hours', 'Gold - 2 Hours'];
    $silver = ['Silver - 4 Hours', 'Silver - 3 Hours', 'Silver - 2 Hours'];
    $beer = ['Beer & Wine - 4 Hours', 'Beer & Wine - 3 Hours', 'Beer & Wine - 2 Hours'];
?>
<?php echo e(Form::open(array('url'=>'lead','method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))); ?>

<input type="hidden" name="storedid" value="">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('lead_name',__('Lead Name'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('lead_name',null,array('class'=>'form-control','placeholder'=>__('Enter Lead Name')))); ?>

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

                <!-- <?php echo e(Form::text('phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required','id'=>'phone-input'))); ?> -->
                <div class="intl-tel-input">
            <input type="tel" id="phone-input" name="phone" class="phone-input form-control" placeholder="Enter Phone" maxlength="16" required>
        <input type="hidden" name="countrycode" id="country-code">
        </div>
            </div>
        </div>
<!-- <input type="hidden" name="countrycode"id ="country-code"> -->
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

                <?php echo Form::select('type', isset($type_arr) ? $type_arr : '', null,array('class' => 'form-control','required'=>'required')); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('venue_selection', __('Venue'), ['class' => 'form-label'])); ?>

                <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <?php echo e(Form::checkbox('venue[]', $label, false, ['id' => 'venue' . ($key + 1)])); ?>

                        <?php echo e(Form::label($label, $label)); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                <?php echo Form::date('start_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required','min' => date('Y-m-d')]); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                <?php echo Form::date('end_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required','min' => date('Y-m-d')]); ?>

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

                <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-check">
                        <?php echo Form::checkbox('function[]', $value, null, ['class' => 'form-check-input', 'id' => 'function_' . $key]); ?>

                        <?php echo e(Form::label($value, $value, ['class' => 'form-check-label'])); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('Assign Staff',__('Assign Staff'),['class'=>'form-label'])); ?>

                <select class="form-control" name= 'user'>
                    <option class= "form-control" selected disabled >Select Staff</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option class= "form-control" value= "<?php echo e($user->id); ?>"><?php echo e($user->name); ?> (<?php echo e($user->type); ?>)</option>
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
                <?php echo Form::label('bar', 'Bar'); ?>

                <?php $__currentLoopData = $bar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <?php echo e(Form::radio('bar', $label, false, ['id' => $label])); ?>

                        <?php echo e(Form::label('bar' . ($key + 1), $label)); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
            <?php echo e(Form::label('rooms',__('Room'),['class'=>'form-label'])); ?>

            <!-- <?php echo e(Form::number('rooms',null,array('class'=>'form-control','placeholder'=>__('Enter No. of Room(if required)')))); ?> -->
            <input type="number" name="rooms" id="" placeholder = "Enter No. of Room(if required)" min = 0 class = "form-control" required>    
        </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('start_time', __('Estimated Start Time'), ['class' => 'form-label'])); ?>

                <?php echo Form::input('time', 'start_time', 'null', ['class' => 'form-control', 'required' => 'required']); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('end_time', __('Estimated End Time'), ['class' => 'form-label'])); ?>

                <?php echo Form::input('time', 'end_time', 'null', ['class' => 'form-control', 'required' => 'required']); ?>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">Close</button>
        <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

    </div>
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
	if(!isNumericInput(event) && !isModifierKey(event)){
		event.preventDefault();
	}
};

const formatToPhone = (event) => {
	if(isModifierKey(event)) {return;}

	// I am lazy and don't like to type things more than once
	const target = event.target;
	const input = event.target.value.replace(/\D/g,'').substring(0,10); // First ten digits of input only
	const zip = input.substring(0,3);
	const middle = input.substring(3,6);
	const last = input.substring(6,10);

	if(input.length > 6){target.value = `(${zip}) ${middle} - ${last}`;}
	else if(input.length > 3){target.value = `(${zip}) ${middle}`;}
	else if(input.length > 0){target.value = `(${zip}`;}
};

const inputElement = document.getElementById('phone-input');
inputElement.addEventListener('keydown',enforceFormat);
inputElement.addEventListener('keyup',formatToPhone);

</script>
    <script>
        $(document).ready(function(){
            var storedId = localStorage.getItem('clickedLinkId');
            $.ajax({
                url: "<?php echo e(route('getcontactinfo')); ?>",
                type: 'POST',
                data: {
                    "customerid": storedId,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data){
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
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\centraverse\resources\views/lead/create.blade.php ENDPATH**/ ?>