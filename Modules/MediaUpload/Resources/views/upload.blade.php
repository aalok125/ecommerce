@extends('mediaupload::layouts.master')

@push('css')
<link rel="stylesheet" href="{{ asset('dist/css/dropzone.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"></div>
        <div class="col-md-3 mt-3">
            <a href="{{ route('filesupload')}}" type="button" class="btn form-control btn-primary" style="margin-top:4px;">Upload File</a>
        </div>
    </div>

    <div class="row mt-4 pl-4">

        @foreach($files as $file)
        <div class="col-md-4 mb-5">
            {{-- @if($file->extension ==) --}}
            <img src="{{ asset($file->filename) }}" height="300px" width="300px" alt=""><br><br>
            <a href="{{ route('filedelete',$file->id) }}" type="button" class="btn btn-primary pl-3" style="width: 300px;">Delete</a>
            {{-- @dd($file) --}}
        </div>

        @endforeach
    </div>

</div>

@endsection

@push('js')
<script src="{{ asset('dist/js/dropzone.js') }}"></script>

<script>
    $("div#myId").dropzone({ url: "/file/post" });

    Dropzone.options.myAwesomeDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
    accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
        done("Naha, you don't.");
        }
        else { done(); }
    }
    };
</script>
@endpush

