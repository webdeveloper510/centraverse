<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Lead Information')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Lead Information')); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Lead Information')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">

        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <!-- <th scope="col" class="sort" data-sort="name"><?php echo e(__('Lead')); ?></th> -->
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Phone')); ?></th>
                                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Email')); ?></th>
                                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Address')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Status')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Type')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Converted events')); ?></th>
                                                <?php if(Gate::check('Show Lead') || Gate::check('Edit Lead') ||
                                                Gate::check('Delete Lead')): ?>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($lead->name); ?></td>
                                                <td><?php echo e($lead->phone); ?></td>
                                                <td><?php echo e($lead->email ?? '--'); ?></td>
                                                <td><?php echo e($lead->address ?? '--'); ?></td>

                                                <td><?php echo e(__(\App\Models\Lead::$stat[$lead->lead_status])); ?></td>
                                                <td><?php echo e($lead->type); ?></td>
                                                <?php if(App\Models\Meeting::where('attendees_lead',$lead->id)->exists()): ?>
                                                <td> Yes </td>
                                                <?php else: ?>
                                                <td> No </td>
                                                <?php endif; ?>
                                                <!-- <td>
                                                    <div class="action-btn bg-info ms-2" style="float: right;">
                                                        <a href="#" data-size="md"
                                                            data-url="<?php echo e(route('lead.uploads',$lead->id)); ?>"
                                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                                            data-title="<?php echo e(__('Upload Document')); ?>"
                                                            title="<?php echo e(__('Upload Document')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-upload"></i>
                                                        </a>
                                                    </div>
                                                    <?php if(App\Models\LeadDoc::where('lead_id',$lead->id)->exists()): ?>
                                                    <div class="action-btn bg-warning ms-2" style="float: right;">
                                                        <a href="#" data-size="md"
                                                            data-url="<?php echo e(route('lead.uploaded_docs',$lead->id)); ?>"
                                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                                            data-title="<?php echo e(__('View Document')); ?>"
                                                            title="<?php echo e(__(' View Documents')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(!App\Models\Meeting::where('attendees_lead',$lead->id)->exists()
                                                    && $lead->status == 2): ?>
                                                    <div class="action-btn bg-secondary ms-2" style="    float: right;">
                                                        <a href="<?php echo e(route('meeting.create',['meeting',0])); ?>?lead=<?php echo e(urlencode(encrypt($lead->id))); ?>"
                                                            data-size="md" data-url="#" data-id="<?php echo e($lead->id); ?>"
                                                            data-bs-toggle="tooltip" data-title="<?php echo e(__('Convert')); ?>"
                                                            title="<?php echo e(__('Convert To Event')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="fas fa-plus"></i> </a>
                                                    </div>
                                                    <?php endif; ?>
                                                </td> -->
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
            <!-- <h4 class="m-b-10">
                <div class="page-header-title">
                    <?php echo e(__(' Billing Details')); ?>

                </div>
            </h4> -->

            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                       
                            <div class="card-body table-border-style">
                            <h3>Billing Details</h3>
                                <div class="table-responsive mt-4">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <!-- <th scope="col" class="sort" data-sort="name"><?php echo e(__('Lead')); ?></th> -->
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Created On')); ?></th>
                                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Name')); ?></th>
                                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Amount')); ?></th>
                                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Due')); ?></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php 
                                $event= App\Models\Meeting::where('attendees_lead',$lead->id)->first();
                                
                                    if($event)
                                    {
                                        $billing = App\Models\PaymentLogs::where('event_id',$event->id)->get();
                                        
                                            $lastpaid = App\Models\PaymentLogs::where('event_id',$event->id)->orderby('id','DESC')->first();
                                        
                                            if(isset($lastpaid) && !empty($lastpaid)){
                                            $amount = App\Models\PaymentInfo::where('event_id',$event->id)->first();
                                            $amountpaid = 0;
                                            foreach($billing as $pay){
                                                $amountpaid += $pay->amount;
                                            }
                                            echo "<tr>";
                                            echo "<td>".Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lastpaid->created_at)->format('M d, Y')."</td>";
                                            echo "<td>".$lead->name."</td>";
                                            echo "<td>".$amount->amount."</td>";
                                            echo "<td>".$amount->amounttobepaid - $amountpaid."</td>";
                                            echo "</tr>";
                                        }
                                    }else{
                                        echo "<tr>";
                                        echo "<td></td>";
                                        echo "<td style='text-align: center;'><b><h4 class='text-secondary'>Lead Not Converted to Event Yet.</h4><b></td>";
                                        echo "<td></td>";
                                        echo "</tr>";
                                    }
                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <h4 class="m-b-10">
                <div class="page-header-title">
                    <?php echo e(__('Documents')); ?>

                </div>
            </h4> -->

            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Upload Documents</h3>
                                <?php echo e(Form::open(array('route' => ['lead.uploaddoc', $lead->id],'method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))); ?>

                                <label for="customerattachment">Attachment</label>
                                <input type="file" name="customerattachment" id="customerattachment"
                                    class="form-control" required>
                                <input type="submit" value="Submit" class="btn btn-primary mt-4" style="float: right;">
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    
                    <!-- <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <h3>Add Notes/Comments</h3>
                                <form method="POST" id="addnotes">
                                    <?php echo csrf_field(); ?>
                                    <label for="notes">Notes</label>
                                    <input type="text" class="form-control" name="notes" required>
                                    <input type="submit" value="Submit" class="btn btn-primary mt-4"
                                        style=" float: right;">
                                </form>
                            </div>
                        </div>
                    </div> -->
                    
                    <div class="col-lg-12">
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
                    <!-- <div class="col-lg-6">
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
                                            <td><?php echo e((App\Models\User::where('id',$note->created_by)->first()->name)); ?></td>
                                            <td><?php echo e(\Auth::user()->dateFormat($note->created_at)); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
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
    $('#addnotes').on('submit', function(e) {
        e.preventDefault();
        var id = <?php echo  $lead->id; ?>;
        var notes = $('input[name="notes"]').val();
        var createrid = <?php echo Auth::user()->id ;?>;

        $.ajax({
            url: "<?php echo e(route('addleadnotes', ['id' => $lead->id])); ?>", // URL based on the route with the actual user ID
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/resources/views/lead/leadinfo.blade.php ENDPATH**/ ?>