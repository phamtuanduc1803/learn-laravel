@extends('layout')
@section('body')
    <div class="col-md-9 order-md-last pr-md-5" style="margin: 50px">
        <form action={{ route('post.update', ['post' => $post->id]) }} method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name='title' value="{{ old('title',$post->title) }}">
            </div>
            @if($errors->has('title'))
                <p>{{ $errors->first('title') }}</p>
            @endif
            <div class="form-group">
                <select name='category_id' class='form-control'>
                    @foreach ($categories as $category)
                        @if ( $post->category_id == $category->id)
                           <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <div>
                    <img id="img2-preview" style="width: 65%" src="@if($post->image_path) {{asset('storage'.$post->image_path)}} @endif">
                </div>
                <div class="file-loading">
                    <input id="avatar-1" name="image" type="file" accept="image/*" onchange="showPreview(event);">
                </div>
            </div>
            <div class="form-group">
                <textarea name="body" id="edit_post" cols="60" rows="20" class="form-control" >{{ old('body',$post->body) }}</textarea>
            </div>
            @if($errors->has('body'))
                <p>{{ $errors->first('body') }}</p>
            @endif
            <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-primary py-3 px-5">
            </div>
        </form>
    </div>
    <script>
        function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("img2-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
@endsection
