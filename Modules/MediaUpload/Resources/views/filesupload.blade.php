@extends('mediaupload::layouts.master')

@push('css')
<link rel="stylesheet" href="{{ asset('dist/css/dropzone.css') }}">
@endpush

@section('content')
<div class="container-fluid mt-5">

    <form action="{{ route('filesubmit') }}" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
        @csrf

    </form>

    

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

