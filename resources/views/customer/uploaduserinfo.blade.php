{{Form::open(array('route'=>['uploadusersinfo'],'method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    <div class="col-md-12">
    <div class="form-group">
        <label for="users">Upload File</label>
    <input type="file" name="users" id="users" class="form-control">
    </div>
    </div>
</div>
{{Form::close()}}