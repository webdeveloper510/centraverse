<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Lead Type</th>
                    <th scope="col">Converted events</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                <tr>
                    <td>{{$lead->name}}</td>
                    <td>{{$lead->email}}</td>
                    <td>{{$lead->phone}}</td>
                    <td>{{$lead->type}}</td>
                    @if(App\Models\Meeting::where('attendees_lead',$lead->id)->exists())
                    <td> Yes </td>
                    @else
                    <td> No </td>
                    @endif
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        @if(!App\Models\Meeting::where('attendees_lead',$lead->id)->exists())
                        <div class="action-btn bg-secondary ms-2" style="    float: right;">
                            <a href="{{ route('meeting.create',['meeting',0]) }}" data-size="md" data-url="#"
                                data-bs-toggle="tooltip" data-title="{{ __('Convert') }}"
                                title="{{ __('Convert To Event') }}"
                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                <i class="fas fa-plus"></i> </a> 
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;">{{ __('Customer Information') }}</h5>
    </div>
    <div class="col-md-12">
        <h5>{{$lead->name}}</h5>
        <p>{{$lead->lead_address}}</p>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <h5 style="margin-left: 14px;">{{ __('Billing Details') }}</h5>
    </div>
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Created On</th>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Due</th>
                    <!-- <th scope="col">Converted events</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                <?php 
                $event= App\Models\Meeting::where('attendees_lead',$lead->id)->first();
                    if($event){
                            $billing = App\Models\PaymentLogs::where('event_id',$event->id)->get();
                            $lastpaid = App\Models\PaymentLogs::where('event_id',$event->id)->orderby('id','DESC')->first();
                            $amount = App\Models\PaymentInfo::where('event_id',$event->id)->first();      
                            $amountpaid = 0;
                            foreach($billing as $pay){
                                $amountpaid += $pay->amount;
                            }
                            echo "<tr>";
                            echo "<td>'".Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lastpaid->created_at)->format('M d, Y')."'</td>";
                            echo "<td>'".$lead->name."'</td>";
                            echo "<td>'".$amount->amount."'</td>";
                            echo "<td>'".$amount->amount - $amountpaid."'</td>";
                            echo "</tr>";
                        }
                ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>