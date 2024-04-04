<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <!-- <th scope="col">Email</th> -->
                    <th scope="col">Status</th>
                    <th scope="col">Lead Type</th>
                    <th scope="col">Converted events</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                <tr>
                    <td>{{$lead->name}}</td>
                    <td>{{$lead->phone}}</td>
                    <td>{{$lead->type}}</td>
                    @if(App\Models\Meeting::where('attendees_lead',$lead->id)->exists())
                    <td> Yes </td>
                    @else
                    <td> No </td>
                    @endif
                    <td>
                        
                        <div class="action-btn bg-info ms-2" style="float: right;">
                            <a href="#" data-size="md" data-url="{{ route('lead.uploads',$lead->id) }}"
                                data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{ __('Upload Document') }}"
                                title="{{ __('Upload Document') }}"
                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                <i class="ti ti-upload"></i>
                            </a>
                        </div>
                        @if(App\Models\LeadDoc::where('lead_id',$lead->id)->exists())
                        <div class="action-btn bg-warning ms-2" style="float: right;">
                        <a href="#" data-size="md" data-url="{{ route('lead.uploaded_docs',$lead->id) }}"
                                data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{ __('View Document') }}"
                                title="{{ __(' View Documents') }}"
                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                <i class="ti ti-eye"></i>
                            </a>
                        </div>
                        @endif
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
    <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-3">
        <h5 style="margin-left: 14px;">{{ __('Customer Information') }}</h5>
    </div>
    <div class="col-md-12">
        <h5>{{$lead->name}}</h5>
        <div style="float:right" class="mb-3">
        <b>Phone :</b> {{$lead->phone}}<br>
<b>Address :</b> {{$lead->lead_address}}
    </div>
        
    </div>
<hr>
    <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-3">
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
                        
                    }
                ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<style>
.modal-dialog.modal-md {
    max-width: 850px;
}
</style>