
<?php
$labels =
    [ 
        'venue_rental' => 'Venue Rental',
        'hotel_rooms'=>'Hotel Rooms',
        'equipment'=>'Tent, Tables, Chairs, AV Equipment',
        'setup' =>'Setup',
        'bar_package'=>'Bar Package',
        'special_req' =>'Special Requests /Other',
        'food_package'=>'Brunch/Lunch/Dinner Package',
        'additional_items'=>'Additional Items'
    ]; 
    $bill = unserialize($billing->data);

?>

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
            {{ Form::model($billing, ['route' => ['billing.edit', $billing->id],'enctype' => 'multipart/form-data', 'method' => 'post' ,'id'=> 'formdata']) }}

                        <div class="col-md-12">
                        <div class="form-group">
        <h4 style="float:right;    background: teal;
    color: white;
    padding: 11px;
    border-radius: 5px;"><b>Guest Count: {{App\Models\Meeting::find($billing->event_id)->first()->guest_count}}</b></h4>
                                <div class="form-group">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{__('Description')}} </th>
                                                <th>{{__('Cost')}} </th>
                                                <th>{{__('Quantity')}} </th>
                                                <th>{{__('Notes')}} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach($bill as $key=> $item)
                                                <tr>
                                                    <td>{{ ucfirst(str_replace('_', ' ', $key))}}</td>
                                                    <td>
                                                        <input type = "number" name ="billing[{{$key}}][cost]"  class= "form-control" value="{{ $item['cost'] ?? '' }}"></td>
                                                    <td> 
                                                    <input type = "number" name ="billing[{{$key}}][quantity]" min = '0' class= "form-control" value="{{ $item['quantity'] ?? 1 }}"required>
                                                    </td>
                                                    <td><input type = "text" name ="billing[{{$key}}][notes]" class= "form-control"  value="{{ $item['notes'] ?? '' }}"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class= "form-group">
                                    <label class = "form-label"> Deposit on file: </label>
                                    <input type = "number" name = "deposits" min = '0' value="{{$billing->deposits}}" class= "form-control" >
                                    </div>
                            </div>
                        </div>
                    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
                    {{ Form::close() }}    
            </div>
        </div>
    </div>
    <style>
.modal-dialog.modal-md {
    max-width: max-content;
}
.table-responsive {
    float: left;
    width: 100%;
}
</style>