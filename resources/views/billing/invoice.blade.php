<?php $event = App\Models\Meeting::find($payinformaton->event_id); ?>
<div class="card-body">
    <table class="table dataTable">
        <tr>
            <th>{{__('Transaction Id ')}}</th>
            <td>{{$payinformaton->transaction_id }}</td>
        </tr>
        <tr>
            <th>{{__('Name')}}</th>
            <td>{{ $payinformaton->name_of_card }}</td>
        </tr>
        <tr>
            <th>{{__('Amount')}}</th>
            <td>{{ $payinformaton->amount }}</td>
        </tr>
        <tr>
            <th>{{__('Event')}}</th>
            <td>{{ $event->type }}</td>
        </tr>
    </table>
</div>