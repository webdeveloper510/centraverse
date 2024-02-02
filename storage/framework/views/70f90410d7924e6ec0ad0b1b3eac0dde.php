<div class="col-lg-12 order-lg-1">

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <small class="h6 text-md mb-3 mb-md-0"><?php echo e(__('User Name')); ?> </small>
                        </div>
                        <div class="col-md-5">
                            <span class="text-md"><?php echo e($user->username); ?></span>
                        </div>
                        <div class="col-md-3 text-md-end">
                            <?php
                                $profile=\App\Models\Utility::get_file('upload/profile/');

                            ?>
                        <img src="<?php echo e((!empty($user->avatar))? asset($profile.$user->avatar): ($profile.'avatar.png')); ?>" width="50px;">

                        </div>
                        <div class="col-md-4">
                            <small class="h6 text-md mb-3 mb-md-0"><?php echo e(__('Name')); ?> </small>
                        </div>
                        <div class="col-sm-5">
                            <span class="text-md"><?php echo e($user->name); ?></span>
                        </div>

                        <div class="col-sm-4">
                            <small class="h6 text-md mb-3 mb-md-0"><?php echo e(__('Title')); ?></small>
                        </div>
                        <div class="col-md-5">
                            <span class="text-md"><?php echo e($user->title); ?></span>
                        </div>
                        <div class="col-md-4">
                            <small class="h6 text-md mb-3 mb-md-0"><?php echo e(__('Email')); ?></small>
                        </div>
                        <div class="col-md-5">
                            <span class="text-md"><?php echo e($user->email); ?></span>
                        </div>
                        <div class="col-md-4">
                            <small class="h6 text-md mb-3 mb-md-0"><?php echo e(__('Phone')); ?></small>
                        </div>
                        <div class="col-md-5">
                            <span class="text-md"><?php echo e($user->phone); ?></span>
                        </div>
                        <div class="col-md-4">
                            <small class="h6 text-md mb-3 mb-md-0"><?php echo e(__('Gender')); ?></small>
                        </div>
                        <div class="col-md-5">
                            <span class="text-md"><?php echo e($user->gender); ?></span>
                        </div>
                        <div class="col-md-4">
                            <small class="h6 text-md mb-3 mb-md-0"><?php echo e(__('Created At :')); ?> </small>
                        </div>
                        <div class="col-md-5">
                            <span class="text-md"><?php echo e(\Auth::user()->dateFormat($user->created_at )); ?></span>
                        </div>

                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-12">
                            <small class="h6 text-md mb-3 mb-md-0"><?php echo e(__('Teams and Access Control')); ?></small>
                        </div>
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <small class="h6 text-md mb-3 mb-md-0"><?php echo e(__('Type')); ?></small>
                                </div>
                                <div class="col-md-5">
                                    <span class="text-md"><?php echo e($user->type); ?></span>
                                </div>
                                <!-- <div class="col-md-4">
                                    <small class="h6 text-md mb-3 mb-md-0"><?php echo e(__('Is Active')); ?></small>
                                </div>
                                <div class="col-md-5">
                                    <input type="checkbox" class="form-check-input" disabled name="is_active" <?php echo e(($user->is_active == 1)? 'checked': ''); ?>>
                                </div> -->
                                <div class="col-md-4">
                                    <small class="h6 text-md mb-3 mb-md-0"><?php echo e(__('Roles')); ?></small>
                                </div>
                                <div class="col-md-5">
                                        <span class="text-md"><?php echo e(!empty($roles[0]->name)?$roles[0]->name:'-'); ?></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </li>
            </ul>

    <div class=" text-end ">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit User')): ?>
        <div class="action-btn bg-info ms-2">
            <a href="<?php echo e(route('user.edit',$user->id)); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"><i class="ti ti-edit"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/user/view.blade.php ENDPATH**/ ?>