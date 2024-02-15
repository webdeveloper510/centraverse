<style>
    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }

    #pagebox2 .list-group-item {
        background-color: #f0f0f0;
    }
</style>
<div class="row">
    <div class="col-md-6">
        <h6>List</h6>
        <div class="form-group">
            <input type="text" name="search" id="search"class="form-control"placeholder ="Search By List name">
            <div class="selectpagebox" id="pagebox1">
                <ul class="list-group">
                    @foreach($leadsuser as $user)
                    <li class="list-group-item">{{ucfirst($user->name)}}<input type="checkbox" name="users[]"class="pages" value="{{$user->id}}" style="  float: right;"></li>
                    @endforeach
                </ul>
            </div>
          
        </div>    
    </div>
    <div class="col-md-6">
        <h6>Selected Users</h6>
        <div class="form-group">
            <input type="text" name="search" id="search"class="form-control ">
            <div class="selectpagebox" id="pagebox2">
            <ul class="list-group">
            </ul>
            </div>
        </div>    
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <input type="submit" value="Save" class="btn  btn-success">
    </div>
</div>
<script>
    $(".pages").change(function () {
        var page = $(this);
        var listItem = page.parent();
        if (page.prop('checked')) {
            listItem.detach().appendTo("#pagebox2 ul");
        } else {
            listItem.detach().appendTo("#pagebox1 ul");
        }
    });
</script>
