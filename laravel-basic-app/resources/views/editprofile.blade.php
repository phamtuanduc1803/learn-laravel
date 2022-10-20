@extends('layout')
@section('body')
    <div class="col-md-9 order-md-last pr-md-5" style="margin: 50px">
        <form class="form form-vertical" action="{{route('user.update',['id' => Auth::user()->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
            <div class="col-sm-4">
                <div class="kv-avatar">
                    <div>
                        <img id="img-preview" style="width: 65%" src="@if(Auth::user()->image_path) {{asset('storage'.Auth::user()->image_path)}} @endif">
                    </div>
                    <div class="file-loading">
                        <input id="avatar-1" name="image" type="file" accept="image/*" onchange="showPreview(event);">
                    </div>
                </div>
                @if ($errors->has('image'))
                    <p>{{$errors->first('image')}}</p>
                @endif
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="fname">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{{Auth::user()->first_name}}" required>
                        </div>
                        @if($errors->has('first_name'))
                            <p>{{ $errors->first('first_name') }}</p>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{{Auth::user()->last_name}}" required>
                        </div>
                        @if($errors->has('last_name'))
                            <p>{{ $errors->first('last_name') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <hr>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
        <script>
            function showPreview(event){
                if(event.target.files.length > 0){
                    var src = URL.createObjectURL(event.target.files[0]);
                    var preview = document.getElementById("img-preview");
                    preview.src = src;
                    preview.style.display = "block";
                }
            }
        </script>
@endsection
