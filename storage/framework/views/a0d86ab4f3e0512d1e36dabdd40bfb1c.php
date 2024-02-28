<?php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
    ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php echo $__env->make('partials.admin.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>
        <div class="container mt-5">
          <div class="row">
            <div class="col-md-12">
              <?php if(session('success_msg')): ?>
              <div class="alert alert-success"><?php echo e(session('success_msg')); ?></div>
              <?php endif; ?>
              <?php if(session('error_msg')): ?>
              <div class="alert alert-danger"><?php echo e(session('error_msg')); ?></div>
              <?php endif; ?>
            </div>
            <div class="col-md-12" style="background: #e4e8f0;border-radius: 5px;padding: 10px;">
              <div class="panel panel-primary">
                <div>
                  <form method="post" action="<?php echo e(route('dopay.online',$event->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                      <div class="form-group col-md-8">
                        <label>Owner</label>
                        <input type="text" name="owner" class="form-control" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label>CVV</label>
                        <input type="number" name="cvv" class="form-control" required >
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-md-8">
                        <label>Card Number</label>
                        <input type="number" name="cardNumber" class="form-control" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control" value="<?php echo e($event->total); ?>">
                      </div>
                    </div>


                    <div class="row">
                      <?php
                      $months = ['1' => 'Jan','2' => 'Feb','3' => 'March','4' => 'April','5' => 'May','6'
                      => 'Jun','7' => 'July','8' => 'Aug','9' => 'Sep','10' => 'OCT','11' => 'Nov','12' =>
                      'Dec'];
                      ?>
                      <div class="form-group col-md-6">
                        <label>Exp Date</label>
                        <select class="form-control" name="expiration-month">
                          <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($k); ?>"><?php echo e($v); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Exp Year</label>
                        <select class="form-control" name="expiration-year">
                          <?php for($i = date('Y'); $i <= (date('Y') + 15); $i++): ?> <option value="<?php echo e($i); ?>">
                            <?php echo e($i); ?></option>
                            <?php endfor; ?>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <br>
                        <button class="btn btn-primary" type="submit" style="float: right;">Make Payment</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
</body>
</html>
<?php echo $__env->make('partials.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH C:\xampp\htdocs\centraverse\resources\views/payments/pay.blade.php ENDPATH**/ ?>