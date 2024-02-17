<div class="row">
    <div class="col-md-4">
        <h6>List</h6>
        <div class="form-group">
            <input type="text" name="search" id="search"class="form-control"placeholder ="Search By List a">
            <ul class="list-group">
                @foreach($leadsuser as $user)
                <li class="list-group-item">{{ucfirst($user->name)}}<input type="checkbox" name="" value="{{$user->id}}" style="  float: right;"><span class="dash-arrow"><i data-feather="chevron-right"></i></span></li>
                @endforeach
            </ul>
        </div>    
    </div>
    <div class="col-md-4">
        <h6>Selected Users</h6>
        <div class="form-group">
            <input type="text" name="search" id="search"class="form-control">
            <!-- <ul class="list-group">
                @foreach($leadsuser as $user)
                <li class="list-group-item">{{ucfirst($user->name)}}<input type="checkbox" name="" value="{{$user->id}}" style="    float: right;"></li>
                @endforeach
            </ul> -->
        </div>    
    </div>
</div>