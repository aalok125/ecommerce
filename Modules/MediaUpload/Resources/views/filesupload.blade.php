@extends('mediaupload::layouts.master')

@push('css')
<link rel="stylesheet" href="{{ asset('dist/css/dropzone.css') }}">
@endpush

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-6">
            <h6 class="pl-2">Upload New file</h6>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('upload') }}" style="text-decoration: none;color:black;">
                <i class="fas fa-angle-left"></i>
                <span>Back to uploaded files</span>
            </a>
        </div>
    </div>
    <div class="card mt-3" style="box-shadow: 4px 15px 54px -5px rgba(0,0,0,0.75);
    -webkit-box-shadow: 4px 15px 54px -5px rgba(0,0,0,0.75);
    -moz-box-shadow: 4px 15px 54px -5px rgba(0,0,0,0.75);padding:20px;">
    <div class="card-header">
        <h5 class="h6"> Drag & Drop your files here</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('filesubmit') }}" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data" style="height: 400px">
            @csrf

        </form>
    </div>

    </div>





</div>

@endsection

@push('js')
<script src="{{ asset('dist/js/dropzone.js') }}"></script>

<script>
$('body').on('change','.dropzone',function(e){
    e.preventDefault();
    alert("hello");
    var formData = new FormData(this);
    let TotalImages = $('#images')[0].files.length; //Total Images
    let images = $('#images')[0];
    for (let i = 0; i < TotalImages; i++) {
    formData.append('images' + i, images.files[i]);
    }
    formData.append('TotalImages', TotalImages);
    $.ajax({
    type:'POST',
    url: "{{ url('filesubmit')}}",
    data: formData,
    cache:false,
    contentType: false,
    processData: false,
    // success: (data) => {
    // this.reset();
    // console.log('Images has been uploaded using jQuery ajax with preview');
    // $('.show-multiple-image-preview').html("");
    // },
    success: function(response){
        console.log(response.success);
        // img();
        // $('.show-multiple-image').hide();
    },

    error: function(data){
    console.log(data);
    }
    });
    });

</script>

@endpush

