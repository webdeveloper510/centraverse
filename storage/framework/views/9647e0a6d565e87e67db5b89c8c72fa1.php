<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Event Customer')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Event Customer')); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('userlist')); ?>"><?php echo e(__('Customers')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('event_customers')); ?>"><?php echo e(__('Event Customers')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Customer Details')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Meeting')): ?>
<div class="col-12 text-end mt-3">
    <a href="<?php echo e(route('meeting.create',['meeting',0])); ?>">
        <button data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
            <i class="ti ti-plus"></i></button>
    </a>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz p0">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="row align-items-center">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Lead Type')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Guest Count')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Event Date')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Function')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Bar')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Status')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Billing Amount')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Amount Due')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Created On')); ?></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php 
                                            $pay = App\Models\PaymentLogs::where('event_id',$event->id)->get();
                                            $total = 0;
                                            foreach($pay as $p){
                                            $total += $p->amount;
                                            }
                                        ?>
                                            <tr>
                                                <td>
<!-- 
                                                    <a href="" data-size="md" title="<?php echo e(__('Event Details')); ?>"
                                                        class="action-item text-primary"
                                                        style="color:#1551c9 !important;"> -->
                                                        <b> <?php echo e(ucfirst($event->name)); ?></b>
                                                    <!-- </a> -->
                                                </td>
                                                <td><b> <?php echo e(ucfirst($event->type)); ?></b></td>
                                                <td>
                                                    <span class="budget"><?php echo e($event->guest_count); ?></span>
                                                </td>
                                                <td><?php echo e(\Auth::user()->dateFormat($event->start_date)); ?></td>

                                                <td><?php echo e(ucfirst($event->function)); ?></td>
                                                <td><?php echo e(($event->bar)); ?></td>

                                                <td><?php echo e(__(\App\Models\Meeting::$status[$event->status])); ?></td>
                                                <td>$<?php echo e(($event->total)); ?></td>
                                                <td>$<?php echo e($event->total - $total); ?></td>
                                                <td><?php echo e(\Auth::user()->dateFormat($event->created_at)); ?></td>

                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container-fluid xyz mt-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card" id="useradd-1">
                                <div class="card-body table-border-style">
                                    <h3>Attachments</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Attachment</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(Storage::disk('public')->exists($doc->filepath)): ?>
                                            <tr>
                                                <td><?php echo e($doc->filename); ?></td>
                                                <td><a href="<?php echo e(Storage::url('app/public/'.$doc->filepath)); ?>" download
                                                        style="color: teal;" title="Download">View Document <i
                                                            class="fa fa-download"></i></a>
                                            </tr>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card" id="useradd-1">
                                <div class="card-body table-border-style">
                                    <h3>Notes</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Notes</th>
                                            <th>Created By</th>
                                            <th>Date</th>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(ucfirst($note->notes)); ?></td>
                                                <td><?php echo e((App\Models\User::where('id',$note->created_by)->first()->name)); ?>

                                                </td>
                                                <td><?php echo e(\Auth::user()->dateFormat($note->created_at)); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card" id="useradd-1">
                                <div class="card-body table-border-style">
                                    <h3>Upload Documents</h3>
                                    <?php echo e(Form::open(array('route' => ['event.uploaddoc', $event->id],'method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))); ?>


                                    <label for="customerattachment">Attachment</label>
                                    <input type="file" name="customerattachment" id="customerattachment"
                                        class="form-control" required>
                                    <input type="submit" value="Submit" class="btn btn-primary mt-4"
                                        style="float: right;">
                                    <?php echo e(Form::close()); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body table-border-style">
                                    <h3>Add Notes/Comments</h3>
                                    <form method="POST" id="addeventnotes">
                                        <?php echo csrf_field(); ?>
                                        <label for="notes">Notes</label>
                                        <input type="text" class="form-control" name="notes" required>
                                        <input type="submit" value="Submit" class="btn btn-primary mt-4"
                                            style=" float: right;">
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <style>
.modal-dialog.modal-md {
    max-width: 850px;
}
</style> -->
    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('script-page'); ?>
    <script>
    $(document).ready(function() {
        $('#addeventnotes').on('submit', function(e) {
            e.preventDefault();
            var id = <?php echo  $event->id; ?>;
            var notes = $('input[name="notes"]').val();
            var createrid = <?php echo Auth::user()->id ;?>;

            $.ajax({
                url: "<?php echo e(route('addeventnotes', ['id' => $event->id])); ?>", // URL based on the route with the actual user ID
                type: 'POST',
                data: {
                    "notes": notes,
                    "createrid": createrid,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    location.reload();
                }
            });

        });
    });
    </script>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/resources/views/customer/eventuserview.blade.php ENDPATH**/ ?>