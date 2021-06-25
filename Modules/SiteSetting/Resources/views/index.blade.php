@extends('Admin.layout.master')
{{-- @extends('sitesetting::layouts.master') --}}

{{--
@push('title')
All forms
@endpush --}}

@push('css')
    <style>
        .img-upload{
            cursor: pointer;
            border: 1px solid black;
        }
    </style>
@endpush

@section('content')

<div class="container">
    <h3 style="font-weight:500; color:royalblue;"> Create Site setting</h3>
    <form  method="post" action="{{ route('sitesettingsubmit')}}" enctype="multipart/form-data">
        @csrf
        <div class="row" style="margin-top: 30px">
            <div class="col-6 text-left">
                <div class="form-group">
                    {{-- <img src="{{ asset(app\Sitesetting::returnValue('site_icon')) }}" height="200px" width="200px" data-target="#site_icon" class="img-upload"  alt=""><br> --}}
                     @if($siteicon->hasImage($siteicon->value))
                        <img src="{{ asset($siteicon->value) }}" height="200px" width="200px" id="previewImg" data-target="#site_icon" class="img-upload"  alt=""><br>
                    @else
                        <img src="{{ asset('uploads/1624180852Art 42.jpg')}}" height="200px" width="200px" id="previewImg" data-target="#site_icon" class="img-upload" alt="">
                    @endif
                    <label for="first">Select site icon</label>
                    {{-- <input type="file" class="form-control" onchange="previewFile(this);"  name="icon" id="site_icon" placeholder="Enter site icon"> --}}
                    <input type="file" class="form-control" onchange="previewFile(this);"  name="icon" id="site_icon" placeholder="Enter site icon" style="display: none;">
                    @error('icon')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6 text-center">
                <div class="form-group">
                    @if($siteicon->hasImage($favicon->value))
                    <img src="{{ asset($favicon->value) }}" height="200px" width="200px" id="previewfav" data-target="#fav_icon" class="img-upload"  alt=""><br>
                    @else
                        <img src="{{ asset('uploads/1624180852Art 42.jpg')}}" height="200px" width="200px" id="previewfav" data-target="#fav_icon" class="img-upload"  alt="">
                    @endif
                    {{-- <img src="{{ asset(app\Sitesetting::returnValue('fav_icon')) }}" height="200px" width="200px" data-target="#fav_icon" class="img-upload"  alt=""><br> --}}
                    <label for="first">Enter site favicon</label>
                    {{-- <input type="file" class="form-control" onchange="previewFav(this);" name="favicon" id="fav_icon" placeholder="Enter site favicon"> --}}
                    <input type="file" class="form-control" onchange="previewFav(this);" name="favicon" id="fav_icon" placeholder="Enter site favicon" style="display: none;">
                    @error('favicon')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">

                <div class="form-group">
                    <label for="first">Enter Site Title</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-file-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" value="{{ $title['title'] ?? "" }}" name="title" id="description" placeholder="Enter Title">

                    </div>
                    {{-- <input type="text" class="form-control" value="{{ $description->value }}" name="description" id="description" placeholder="Enter Description"> --}}
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first">Enter Site Description</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-file-alt"></i></span>
                        </div>
                        <textarea name="description" id="" cols="10" rows="1" placeholder="Enter Description" class="form-control">
                            {{ $description['description'] ?? "" }}
                        </textarea>

                    </div>
                    {{-- <input type="text" class="form-control" value="{{ $description->value }}" name="description" id="description" placeholder="Enter Description"> --}}
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>


        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>


@endsection

@push('script')
    <script>


        $('.img-upload').on('click', function(){
            var target = $(this).attr('data-target');
            $(target).click();
        })


        function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }

    function previewFav(input){
        var file = $("#fav_icon").get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $("#previewfav").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }
    </script>
@endpush


{{-- value="{{ isset($form->foreignemployment) ? $form->foreignemployment : "" }}" --}}

