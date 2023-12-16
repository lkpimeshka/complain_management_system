@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="padding-top: 20px; padding-bottom: 10px;">Edit Article</h2>

    <form  method="post" action="{{ route('update-article') }}" novalidate>
        @csrf

    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-body">

                    <input type="hidden" name="id" id="id" value="{{$article->id}}">

                    <div class="row">
                        <div class="col-sm-12">
                            <label>Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{$article->title}}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <label>Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{$article->description}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <input type="submit" name="send" value="Submit" class="btn btn-info btn-block" style="margin-bottom: 20px; margin-top: 20px;">

                </div>
            </div>
        </div>
    </div>

    </form>
</div>
@endsection
