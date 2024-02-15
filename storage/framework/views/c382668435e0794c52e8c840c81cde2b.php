<style>
    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }

    #pagebox2 .list-group-item {
        background-color: #f0f0f0;
    }
</style>
<div class="row">
    <div class="col-md-6">
        <h6>List</h6>
        <div class="form-group">
            <input type="text" name="search" id="search"class="form-control"placeholder ="Search By List name">
            <div class="selectpagebox" id="pagebox1">
                <ul class="list-group">
                    <?php $__currentLoopData = $leadsuser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item"><?php echo e(ucfirst($user->name)); ?><input type="checkbox" name="users[]"class="pages" value="<?php echo e($user->id); ?>" style="  float: right;"></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
          
        </div>    
    </div>
    <div class="col-md-6">
        <h6>Selected Users</h6>
        <div class="form-group">
            <input type="text" name="search" id="search"class="form-control ">
            <div class="selectpagebox" id="pagebox2">
            <ul class="list-group">
            </ul>
            </div>
        </div>    
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <input type="submit" value="Save" class="btn  btn-success">
    </div>
</div>
<script>
    $(".pages").change(function () {
        var page = $(this);
        var listItem = page.parent();
        if (page.prop('checked')) {
            listItem.detach().appendTo("#pagebox2 ul");
        } else {
            listItem.detach().appendTo("#pagebox1 ul");
        }
    });
</script>
<?php /**PATH C:\xampp\htdocs\centraverse\resources\views/customer/existingleads.blade.php ENDPATH**/ ?>