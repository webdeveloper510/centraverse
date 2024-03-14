<?php
$settings = App\Models\Utility::settings();
$campaign_type = explode(',',$settings['campaign_type'])
?>
<div class="form-group col-md-12">
    <div class="badges">
        <ul class="nav nav-tabs tabActive" style="border-bottom: none">
            <li class="badge rounded p-2 m-1 px-3 bg-primary">
                <a style="color: white" data-toggle="tab" href="#barmenu0" class="active">Customer insert</a>
            </li>
            <li class="badge rounded p-2 m-1 px-3 bg-primary">
                <a style="color: white" data-toggle="tab" href="#barmenu1" class="">Import file</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="barmenu0" class="tab-pane fade in active show">
                <?php echo e(Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data'))); ?>

                <div class="row">
                    <div class="col-6">
                        <input type="hidden" name="customerType" value="addForm" />
                        <div class="form-group">
                            <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

                            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <?php echo e(Form::label('phone',__('Phone'),['class'=>'form-label'])); ?>

                            <div class="intl-tel-input">
                                <input type="tel" id="phone-input" name="phone" class="phone-input form-control" placeholder="Enter Phone" maxlength="16" required>
                                <input type="hidden" name="countrycode" id="country-code">
                            </div>
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
                            <?php echo e(Form::label('address',__('Address'),['class'=>'form-label'])); ?>

                            <?php echo e(Form::text('address',null,array('class'=>'form-control','placeholder'=>__('Enter Address')))); ?>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <?php echo e(Form::label('organization',__('Organization'),['class'=>'form-label'])); ?>

                            <?php echo e(Form::text('organization',null,array('class'=>'form-control','placeholder'=>__('Enter Organization')))); ?>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="category">Select Category</label>
                            <select name="category" id="category" class="form-control" required>
                                <option selected disabled value="">Select Category</option>
                                <?php $__currentLoopData = $campaign_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($campaign); ?>" class="form-control"><?php echo e($campaign); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary  '))); ?>

                        </div>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
            <div id="barmenu1" class="tab-pane fade">
                <?php echo e(Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data'))); ?>

                <div class="row">
                    <input type="hidden" name="customerType" value="uploadFile" />
                    <div class="col-12">
                        <div class="form-group">
                            <label for="category">Select Category</label>
                            <select name="category" id="category" class="form-control" required>
                                <option selected disabled value="">Select Category</option>
                                <?php $__currentLoopData = $campaign_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($campaign); ?>" class="form-control"><?php echo e($campaign); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="users">Upload File</label>
                            <input type="file" name="users" id="users" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary  '))); ?>

                        </div>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/customer/uploaduserinfo.blade.php ENDPATH**/ ?>