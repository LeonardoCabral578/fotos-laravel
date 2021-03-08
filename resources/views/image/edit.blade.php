@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">Esitar mi imágen</div>

                    <div class="card-body">

                        <form action="{{ route('image.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="image_id" value="{{ $image->id }}">

                            <div class="form-group row">
                                <label for="image_path" class="col-md-3 col-form-label text-md-right">Imágen</label>
                                <div class="col-md-7">

                                    @if ($image->user->image)
                                        <div class="container-avatar">
                                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="">
                                        </div>
                                    @endif

                                    <input type="file" id="image_path" name="image_path"
                                        class="form-control @error('image_path') is-invalid @enderror">

                                    @error('image_path')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>
                                <div class="col-md-7">
                                    <textarea id="description" name="description" class="form-control"
                                        required>{{ $image->description }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-3">
                                    <input type="submit" class="btn btn-primary" value="Actualizar imágen">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
