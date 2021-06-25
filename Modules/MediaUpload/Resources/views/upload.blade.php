@extends('mediaupload::layouts.master')

@push('css')
<link rel="stylesheet" href="{{ asset('dist/css/dropzone.css') }}">
@endpush

@section('content')




<div class="container-fluid">
    <div class="row">

        <div class="col-md-3 mt-4">
            <h5 style="padding-left:30px;">All uploaded files</h5>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-3 mt-3">
            <a href="{{ route('filesupload')}}" type="button" class="btn btn-primary"
                style="margin-top:4px;width:150px;margin-left:107px;">Upload File</a>
        </div>
    </div>

    <div class="container-fluid mt-2">
        <div class="card bg-light mb-3" style="box-shadow: 4px 15px 54px -5px rgba(0,0,0,0.75);
        -webkit-box-shadow: 4px 15px 54px -5px rgba(0,0,0,0.75);
        -moz-box-shadow: 4px 15px 54px -5px rgba(0,0,0,0.75);padding:20px;">
            <div class="card-header row gutters-5">
                <div class="col-md-3">
                    <h5 class="mb-0 h6">All files</h5>
                </div>

                <div class="col-md-3 ml-auto mr-0">
                    <form action="{{ route('search') }}" method="POST">
                    @csrf
                    <div class="form-group">

                        <select class="form-control" name="image">
                            <option>Select any</option>
                            <option value="filename">Name</option>
                            <option value="file_size">Size</option>
                            <option value="extension">Extension</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" name="img_name" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-group">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            </div>
            <div class="card-body">
                <div class="row ml-2">
                    @foreach($files as $file)
                    <div class="col-auto w-130px w-lg-220px">
                        <div class="file-box" style="width: 200px;">
                            <div class="dropdown-file">

                                <div class="dropdown-menu dropdown-menu-right" >
                                    <a href="{{ route('filedelete',$file->id) }}" class="dropdown-item" style="text-decoration:none;color:black;">Delete</a>
                                    <a href="" class="dropdown-item" style="text-decoration:none;color:black;">Download</a>
                                </div>
                                <a href="dropdown-link" data-toggle="dropdown" style="color: #5a5a5a;
                                font-size: 22px;
                                background: #f5f6fa;
                                cursor: pointer;margin-left:180px;">
                                    <i class="la la-ellipsis-v">...</i>
                                </a>
                            </div>
                            <div class="card card-file">
                                <div class="card-file-thumb" style="padding:10px;">
                                    <img src="{{ asset($file->filename) }}" class="img-fit" height="150px" width="180px" alt="">
                                </div>
                                <div class="card-body" style=" height:50px;">

                                    <h6 style="margin-top:-15px;">
                                        <span class="text-truncate title">abc..</span>
                                        <span class="ext">{{ $file->extension }}</span>
                                        <p>{{ $file->file_size}}</p>

                                    </h6>
                                </div>

                            </div>

                        </div>

                    </div>

                    @endforeach
                </div>

            </div>
        <div class="col-10 pagination ml-4 mb-5">
            {{ $files->links() }}

        </div>


    </div>


</div>

@endsection

@push('js')
<script src="{{ asset('dist/js/dropzone.js') }}"></script>

<script>
    $("div#myId").dropzone({
        url: "/file/post"
    });

    Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        accept: function (file, done) {
            if (file.name == "justinbieber.jpg") {
                done("Naha, you don't.");
            } else {
                done();
            }
        }
    };

</script>
@endpush

