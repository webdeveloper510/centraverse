<?php
// echo"<pre>";print_r($event);die;
$settings = App\Models\Utility::settings();
$billings = json_decode($settings['fixed_billing'],true);
$additional_items = json_decode($settings['additional_items'],true);
$labels =
    [
        'venue_rental' => 'Venue',
        'hotel_rooms'=>'Hotel Rooms',
        'equipment'=>'Tent, Tables, Chairs, AV Equipment',
        'setup' =>'Setup',
        'bar_package'=>'Bar Package',
        'special_req' =>'Special Requests/Other',
        'food_package'=>'Food Package',
        'additional_items' =>'Additional Items'
    ];
    $bar = [];
    $barpcks = json_decode($event->bar_package,true);
    if(isset($barpcks) && !empty($barpcks)){
    foreach($barpcks as $key => $barpck){
        $bar[]= $barpck;
    }
    $barpckge = implode(',',$bar);
}
    $foodpcks = json_decode($event->func_package,true);
    $addpcks = json_decode($event->ad_opts,true);

    $food = [];
    $add = [];
    if(isset($foodpcks) && !empty($foodpcks)){
        foreach($foodpcks as $key => $foodpck){
            foreach($foodpck as $foods){
            $food[]= $foods;
            }
        }
        $foodpckge = implode(',',$food);
    }
    if(isset($addpcks) && !empty($addpcks)){
    foreach($addpcks as $key => $adpck){
        foreach($adpck as $ad){
        $add[] = $ad;
        }
    }
    $addpckge = implode(',',$add);
}
    $meetingData = [
        'venue_rental' => $event->venue_selection,
        'hotel_rooms'=>$event->room,
        'equipment' =>$event->spcl_request,
        'bar_package' => (isset($barpckge) && !empty($barpckge)) ? $barpckge : '',
        'food_package' => (isset($foodpckge) && !empty($foodpckge)) ? $foodpckge: '',
        'additional_items' => (isset($addpcks) && !empty($addpcks)) ? $addpckge :'',
        'setup' =>''
    ];
    $totalFoodPackageCost = 0;
    $totalbarPackageCost = 0;
    foreach ($bar as $barItem) {
        foreach ($billings['barpackage'] as $category => $categoryItems) {
            if(isset($categoryItems[$barItem]) && $categoryItems[$barItem] != '') {
            $totalbarPackageCost += $categoryItems[$barItem];
            break;
            }
        }
    }
    if(isset($billings) && !empty($billings)){
        foreach ($food as $foodItem) {
            foreach ($billings['package'] as $category => $categoryItems) {
                if (isset($categoryItems[$foodItem])) {
                $totalFoodPackageCost +=  (int)$categoryItems[$foodItem];
                break;
                }
            }
            }
        $meetingData['food_package_cost'] = $totalFoodPackageCost;
    }
    $additionalItemsCost = 0;
    if(isset($additional_items) && !empty($additional_items)){
        foreach ($additional_items as $category => $categoryItems) {
            foreach ($categoryItems as $item => $subItems) {
                foreach ($subItems as $key => $value) {
                    if (in_array($key, $add)) {
                    // Add the value to the total cost
                    $additionalItemsCost += $value;
                    }
                }
            }
        }
    }


    // Get the value for 'Patio' from the 'venue' array
    $subcategories = array_map('trim', explode(',', $meetingData['venue_rental']));
    $venueRentalCost = 0;
    foreach ($subcategories as $subcategory) {
    $venueRentalCost += $billings['venue'][$subcategory] ?? 0;
    }
    $meetingData['venue_rental_cost'] = number_format($venueRentalCost);
    $meetingData['hotel_rooms_cost'] = number_format($billings['hotel_rooms']) ?? '';
    $meetingData['equipment_cost'] = number_format($billings['equipment']) ?? '';
    $meetingData['bar_package_cost'] = number_format($totalbarPackageCost);
    $meetingData['food_package_cost'] = number_format($totalFoodPackageCost);
    $meetingData['additional_items_cost'] = number_format($additionalItemsCost) ?? '';
    $meetingData['special_req_cost'] = number_format($billings['special_req']) ?? '';
    $meetingData['setup_cost'] = '';
?>
{{Form::open(array('route' => ['billing.addbilling', $id],'method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))}}
<div class="col-md-12">
    <div class="form-group">
        <h4 style="float:right;    background: teal;
    color: white;
    padding: 11px;
    border-radius: 5px;"><b>Guest Count: {{$event->guest_count}}</b></h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{__('Description')}}  <span class="opticy"> dddd</span></th>
                    <th>{{__('Cost(per person)')}}  <span class="opticy"> dddd</span></th>
                    <th>{{__('Quantity')}}  <span class="opticy"> dddd</span></th>
                    <th>{{__('Notes')}}  <span class="opticy"> dddd</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach($labels as $key=> $label)
                <tr>
                    <td>{{ucfirst($label)}}</td>
                    <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" name="billing[{{$key}}][cost]"
                            value="{{ isset($meetingData[$key.'_cost']) ? $meetingData[$key.'_cost'] : '' }}"
                            class="form-control dlr currency_point">
                    </div>
                        <!-- <input type="text" name="billing[{{$key}}][cost]"
                            value="{{ isset($meetingData[$key.'_cost']) ? $meetingData[$key.'_cost'] : '' }}"
                            class="form-control dlr"> -->
                    </td>
                    <td>
                        <input type="number" name="billing[{{$key}}][quantity]" min='0' class="form-control"
                            value="{{ ($key !== 'hotel_rooms') ? 1 : $meetingData[$key]}}" required>
                    </td>
                    <td>
                        <input type="text" name="billing[{{$key}}][notes]" class="form-control"
                            value="{{ ($key !== 'hotel_rooms') ? $meetingData[$key] ?? '' : '' }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
    </div>
    <div class="row form-group">
        <div class="col-md-12">
            <label class="form-label"> Deposit on file: </label>
            <input type="number" name="deposits" min='0' class="form-control" required>
        </div>

    </div>

</div>
{{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
{{ Form::close() }}

<script>
    $('.currency_point').on('input', function() {
                let inputVal = $(this).val();
                inputVal = inputVal.replace(/[^0-9.]/g, ''); // Remove non-numeric characters except for decimal point
                
                let parts = inputVal.split('.');
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Add commas to the integer part
                
                let formattedValue = parts.join('.');
                $(this).val(formattedValue);
            });

            $('.currency_point').on('blur', function() {
                if ($(this).val() === '') {
                    // $(this).val('0.00');
                }
            });
</script>
<style>
.modal-dialog.modal-md {
    max-width: max-content;
}
.table-responsive {
    float: left;
    width: 100%;
}
</style>