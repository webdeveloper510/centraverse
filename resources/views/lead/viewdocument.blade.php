<div class="row">
    <div class="col-md-12">
        @foreach($docs as $doc)
<!-- Assuming $folder and $filename are passed to the view -->
@if(Storage::disk('public')->exists($doc->filepath))
 
    <img src="{{ asset('extension_img/images.png') }}"style="    width: 5%;
    height: 15%;">
    <h6>{{$doc->filename}}</h6>
    <p><a href="{{ Storage::url('app/public/'.$doc->filepath) }}" download>Download File</a></p>

@endif

        @endforeach
    </div>
</div>