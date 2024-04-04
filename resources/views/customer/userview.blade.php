<div class="col-lg-12 order-lg-1">
    <div class="row align-items-center">
        <div class="col-md-4">
            <small class="h6 text-md mb-3 mb-md-0">{{__('Name')}} </small>
        </div>
        <div class="col-md-5">
            <span class="text-md">{{ $users->name }}</span>
        </div>
        <div class="col-md-4  mt-1">
            <small class="h6 text-md mb-3 mb-md-0">{{__('Email')}}</small>
        </div>
        <div class="col-md-5  mt-1">
            <span class="text-md">{{ $users->email }}</span>
        </div>
        <div class="col-md-4  mt-1">
            <small class="h6 text-md mb-3 mb-md-0">{{__('Phone')}}</small>
        </div>
        <div class="col-md-5  mt-1">
            <span class="text-md">{{ $users->phone }}</span>
        </div>
        <div class="col-md-4  mt-1">
            <small class="h6 text-md mb-3 mb-md-0">{{__('Address')}}</small>
        </div>
        <div class="col-md-5  mt-1">
            <span class="text-md">{{ $users->address }}</span>
        </div>
        <div class="col-md-4  mt-1">
            <small class="h6 text-md mb-3 mb-md-0">{{__('Category')}}</small>
        </div>
        <div class="col-md-5  mt-1">
            <span class="text-md">{{ $users->category }}</span>
        </div>
    </div>
</div>
<style>
.list-group-flush .list-group-item {
    background: none;
}
</style>