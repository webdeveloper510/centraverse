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
   <div class = "container">
   <div class="container-fluid inner-page">
  <div class="card-panel">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1>Laravel Athorized.net Payment</h1>
        </div>
        <div class="col-md-12">
          <?php if(session('success_msg')): ?>
          <div class="alert alert-success"><?php echo e(session('success_msg')); ?></div>
          <?php endif; ?>
          <?php if(session('error_msg')): ?>
          <div class="alert alert-danger"><?php echo e(session('error_msg')); ?></div>
          <?php endif; ?>
        </div>
        <div class="col-md-6" style="background: lightgreen;border-radius: 5px;padding: 10px;">
          <div class="panel panel-primary">
            <div>
              <form method="post" action="<?php echo e(route('dopay.online')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                  <div class="form-group col-md-8">
                    <label>Owner</label>
                    <input type="text" name="owner" class="form-control" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label>CVV</label>
                    <input type="number" name="cvv" class="form-control" required>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-8">
                    <label>Card Number</label>
                    <input type="text" name="cardNumber" class="form-control" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Amount</label>
                    <input type="number" name="amount" class="form-control" required>
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
                    <button class="btn btn-primary" type="submit">Make Payment</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <!-- <div class="row">
        <div class="col-md-12">
        <div class="card-panel">
        <div class="media wow fadeInUp" data-wow-duration="1s"> 
            <div class="companyIcon">
            </div>
            <div class="media-body">
                <div class="container">
                    <?php if(session('success_msg')): ?>
                    <div class="alert alert-success fade in alert-dismissible show">                
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true" style="font-size:20px">×</span>
                        </button>
                        <?php echo e(session('success_msg')); ?>

                    </div>
                    <?php endif; ?>
                    <?php if(session('error_msg')): ?>
                    <div class="alert alert-danger fade in alert-dismissible show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true" style="font-size:20px">×</span>
                        </button>    
                        <?php echo e(session('error_msg')); ?>

                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Payment</h1>
                        </div>                       
                    </div>    
                    <div class="row">                        
                        <div class="col-xs-12 col-md-6" style="background: lightgreen; border-radius: 5px; padding: 10px;">
                            <div class="panel panel-primary">                                       
                                <div class="creditCardForm">                                    
                                    <div class="payment">
                                        <form id="payment-card-info" method="post" action="<?php echo e(route('dopay.online')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="form-group owner col-md-8">
                                                    <label for="owner">Owner</label>
                                                    <input type="text" class="form-control" id="owner" name="owner" value="<?php echo e(old('owner')); ?>" required>
                                                    <span id="owner-error" class="error text-red">Please enter owner name</span>
                                                </div>
                                                <div class="form-group CVV col-md-4">
                                                    <label for="cvv">CVV</label>
                                                    <input type="number" class="form-control" id="cvv" name="cvv" value="<?php echo e(old('cvv')); ?>" required>
                                                    <span id="cvv-error" class="error text-red">Please enter cvv</span>
                                                </div>
                                            </div>    
                                            <div class="row">
                                                <div class="form-group col-md-8" id="card-number-field">
                                                    <label for="cardNumber">Card Number</label>
                                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" value="<?php echo e(old('cardNumber')); ?>" required>
                                                    <span id="card-error" class="error text-red">Please enter valid card number</span>
                                                </div>
                                                <div class="form-group col-md-4" >
                                                    <label for="amount">Amount</label>
                                                    <input type="number" class="form-control" id="amount" name="amount" min="1" value="<?php echo e(old('amount')); ?>" required>
                                                    <span id="amount-error" class="error text-red">Please enter amount</span>
                                                </div>
                                            </div>    
                                            <div class="row">
                                                <div class="form-group col-md-6" id="expiration-date">
                                                    <label>Expiration Date</label><br/>
                                                    <select class="form-control" id="expiration-month" name="expiration-month" style="float: left; width: 100px; margin-right: 10px;">
                                                        <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($k); ?>" <?php echo e(old('expiration-month') == $k ? 'selected' : ''); ?>><?php echo e($v); ?></option>                                                        
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>  
                                                    <select class="form-control" id="expiration-year" name="expiration-year"  style="float: left; width: 100px;">
                                                        
                                                        <?php for($i = date('Y'); $i <= (date('Y') + 15); $i++): ?>
                                                        <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>            
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>                                                
                                                <div class="form-group col-md-6" id="credit_cards" style="margin-top: 22px;">
                                                    <img src="<?php echo e(asset('images/visa.jpg')); ?>" id="visa">
                                                    <img src="<?php echo e(asset('images/mastercard.jpg')); ?>" id="mastercard">
                                                    <img src="<?php echo e(asset('images/amex.jpg')); ?>" id="amex">
                                                </div>
                                            </div>
                                            
                                            <br/>
                                            <div class="form-group" id="pay-now">
                                                <button type="submit" class="btn btn-success themeButton" id="confirm-purchase">Confirm Payment</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>                                
                            </div>
                        </div>                               
                    </div>
                </div>
            </div>

        </div>
    </div> 
    <div class="clearfix"></div> 
        </div>
    </div> -->
   </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\centraverse\resources\views/payments/pay.blade.php ENDPATH**/ ?>