<?php if(\Auth::user()->type == 'super admin'): ?>
<?php echo e(Form::open(array('url'=>'user','method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="form-group">
    <?php echo e(Form::label('name',__('User Name'),['class'=>'form-label'])); ?>

    <?php echo e(Form::text('username',null,array('class'=>'form-control','placeholder'=>__('Enter User Name'),'required'=>'required'))); ?>

</div>
<div class="form-group">
    <?php echo e(Form::label('name',__('Name'),array('class'=>'form-label'))); ?>

    <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter User Name'),'required'=>'required'))); ?>

</div>
<div class="form-group">
    <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

    <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email'),'required'=>'required'))); ?>

</div>
<div class="form-group">
    <?php echo e(Form::label('password',__('Password'),['class'=>'form-label'])); ?>

    <?php echo e(Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter User Password'),'required'=>'required','minlength'=>"6"))); ?>

</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light"
        data-bs-dismiss="modal">Close</button>
        <?php echo e(Form::submit(__('Create'),array('class'=>'btn btn-primary '))); ?>

</div>

<?php echo e(Form::close()); ?>

<?php else: ?>
<?php echo e(Form::open(array('url'=>'user','method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Username'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('username',null,array('class'=>'form-control','placeholder'=>__('Enter Username'),'required'=>'required'))); ?>

        </div>
        <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Title'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter Title'),'required'=>'required'))); ?>

        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Phone'),['class'=>'form-label'])); ?>

            <div class="intl-tel-input">
            <input type="tel" id="phone-input" name="phone" class="phone-input form-control" placeholder="Enter Phone">
        </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group ">
            <?php echo e(Form::label('name',__('Gender'),['class'=>'form-label'])); ?>

            <?php echo Form::select('gender', $gender, null,array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <!-- <hr class ="mb-4"> -->
    <hr>
    <div class="col-12 p-0 modaltitle pb-3 mb-3">
        <!-- <hr> -->
        <h5 style="margin-left: 14px;"><?php echo e(__('Login Details')); ?></h5>
        <!-- <hr class ="mt-3"> -->
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Password'),['class'=>'form-label'])); ?>

            <?php echo e(Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter Password'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('user_roles',__('Roles'),['class'=>'form-label'])); ?>

            <?php echo Form::select('user_roles', $roles, null,array('class' => 'form-control ','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group" style="margin-top: 35px;">
            <?php echo e(Form::label('name',__('Active'),['class'=>'form-label'])); ?>

                <input type="checkbox" class="form-check-input" name="is_active" checked>
        </div>
    </div>
    <hr>
    <div class="col-12 p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;"><?php echo e(__('Avatar')); ?></h5>
        <!-- <hr class ="mb-4"> -->
    </div>
    
    <div class="col-12 mb-3 field" data-name="avatar">
        <div class="attachment-upload">
            <div class="attachment-button">
                <div class="pull-left">
                    
                        <input type="file"name="avatar" class="form-control mb-3" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <img id="blah"  width="25%"  />
                </div>
            </div>
            <div class="attachment"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light"
            data-bs-dismiss="modal">Close</button>
                <?php echo e(Form::submit(__('Save'),array('class'=>'btn  btn-primary  '))); ?>

    </div>
</div>
<?php echo e(Form::close()); ?>

                        <script>
                        $(document).ready(function() {
      var input = document.querySelector("#phone-input");
      var iti = window.intlTelInput(input, {
        separateDialCode: true,
      });

      var indiaCountryCode = iti.getSelectedCountryData().iso2;
      if (indiaCountryCode !== 'us') {
        iti.setCountry('us');
      }
    });
    </script>

<?php endif; ?>
<?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/user/create.blade.php ENDPATH**/ ?>