{{Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    <div class="col-md-12">
    <div class="form-group">
        <label for="users">Upload File</label>
    <input type="file" name="users" id="users" class="form-control">
    </div>
    <input type="submit" value="Submit" class="btn btn-primary">
    </div>
</div>
{{Form::close()}}