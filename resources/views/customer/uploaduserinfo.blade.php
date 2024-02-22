@php 
$settings = App\Models\Utility::settings();
$campaign_type = explode(',',$settings['campaign_type'])
@endphp
{{Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    <div class="col-md-6">
    <div class="form-group">
        <label for="category">Select Category</label>
        <select name="category" id="category" class="form-control" required>
            <option selected disabled>Select Category</option>
            @foreach($campaign_type as $campaign)
            <option value="{{$campaign}}" class="form-control">{{$campaign}}</option>
            @endforeach
        </select>
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
        <label for="users">Upload File</label>
        <input type="file" name="users" id="users" class="form-control"required>
    </div>
    <input type="submit" value="Submit" class="btn btn-primary">
    </div>
</div>
{{Form::close()}}