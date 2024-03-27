<div class="row">
    <div class="col-md-12">
        <dl class="row">

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Customer Name')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->name }}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Amount')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->total }}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Advance Payment')}}</span></dt>
            <dd class="col-md-6">
                <span class="text-md">{{ $deposit = App\Models\Billing::where('event_id',$event->id)->pluck('deposits')->first() }}</span>
            </dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Balance Due')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->total - $deposit }}</span></dd>

        </dl>
    </div>
</div>