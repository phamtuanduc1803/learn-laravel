@extends('layout')
@section('body')
    <section class="ftco-section">
        <div class="container">
            <div class="row">
        <form action={{ route('post.store') }} method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" name='title' value="{{old('title') }}">
            </div>
            @if ($errors->has('title'))
                <p>{{ $errors->first('title') }}</p>
            @endif
            <div class="form-group">
                <select name='category_id' class='form-control'>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <div>
                    <img id="img1-preview" style="width: 30%">
                </div>
                <div class="file-loading">
                    <input type="file" id="" name="image" accept="image/*" onchange="showPreview(event);" required="true">
                </div>
            </div>
            <div class="form-group">
                <textarea name="body" id="create_post" cols="60" rows="20" class="form-control" placeholder="Content" >{{ old('body') }}</textarea>
            </div>
            @if($errors->has('body'))
                <p>{{ $errors->first('body') }}</p>
            @endif
            <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-primary py-3 px-5">
            </div>
        </form>
    </div>
            </div>
    </section>
    <script>
        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("img1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
