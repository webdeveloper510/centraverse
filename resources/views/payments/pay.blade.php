@php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
    @endphp 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
@include('partials.admin.head')
<body>
        <div class="container mt-5">
          <div class="row">
            <div class="col-md-12">
              @if(session('success_msg'))
              <div class="alert alert-success">{{session('success_msg')}}</div>
              @endif
              @if(session('error_msg'))
              <div class="alert alert-danger">{{session('error_msg')}}</div>
              @endif
            </div>
            <div class="col-md-12" style="background: #e4e8f0;border-radius: 5px;padding: 10px;">
              <div class="panel panel-primary">
                <div>
                  <form method="post" action="{{ route('dopay.online',$event->id) }}">
                    @csrf
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
                        <input type="number" name="amount" class="form-control" value="{{$event->total}}">
                      </div>
                    </div>


                    <div class="row">
                      @php
                      $months = ['1' => 'Jan','2' => 'Feb','3' => 'March','4' => 'April','5' => 'May','6'
                      => 'Jun','7' => 'July','8' => 'Aug','9' => 'Sep','10' => 'OCT','11' => 'Nov','12' =>
                      'Dec'];
                      @endphp
                      <div class="form-group col-md-6">
                        <label>Exp Date</label>
                        <select class="form-control" name="expiration-month">
                          @foreach($months as $k => $v)
                          <option value="{{ $k }}">{{$v}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Exp Year</label>
                        <select class="form-control" name="expiration-year">
                          @for($i = date('Y'); $i <= (date('Y') + 15); $i++) <option value="{{ $i }}">
                            {{$i}}</option>
                            @endfor
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
@include('partials.admin.footer')

