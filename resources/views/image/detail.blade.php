@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('includes.message')

                <div class="card pub_image pub_image_detail">
                    <div class="card-header">

                        @if ($image->user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" class="avatar"
                                    alt="">
                            </div>
                        @endif

                        <div class="data-user">
                            <a href="{{ route('user.profile', ['id' => $image->user->id]) }}">
                                {{ $image->user->name . ' ' . $image->user->surname }}
                            </a>
                            <span class="nickname">
                                {{ ' | @' . $image->user->nick }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="image-container image-detail">
                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="">
                        </div>
                        <div class="description">
                            <span class="nickname">{{ '@' . $image->user->nick }}</span>
                            <span
                                class="nickname date">{{ ' | ' .
    \Carbon\Carbon::parse($image->created_at)->locale('es-AR')->diffForHumans(\Carbon\Carbon::now()) }}</span>
                            <p>{{ $image->description }}</p>
                        </div>

                        <div class="likes">

                            <!-- Comprobar si el usuario le dio like a la imágen -->
                            <?php $user_like = false; ?>
                            @foreach ($image->likes as $like)
                                @if ($like->user->id == Auth::user()->id)
                                    <?php $user_like = true; ?>
                                @endif
                            @endforeach

                            @if ($user_like)
                                <img src="{{ asset('img/heart-red.png') }}" data-id="{{ $image->id }}"
                                    class="btn-dislike" alt="">
                            @else
                                <img src="{{ asset('img/heart-black.png') }}" data-id="{{ $image->id }}"
                                    class="btn-like" alt="">
                            @endif

                            <span class="number_likes">{{ count($image->likes) }}</span>
                        </div>

                        @if (Auth::user() && Auth::user()->id == $image->user->id)
                            <div class="actions">
                                <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-sm btn-primary">Actualizar</a>

                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                                    Eliminar
                                </button>

                                <!-- The Modal -->
                                <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">¿Estás seguro?</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                Si eliminas esta imágen nunca podrás recuperarla, ¿estás seguro de querer borrarla?
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <a href="{{ route('image.delete', ['id' => $image->id]) }}"
                                                    class="btn btn-danger">Borrar</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif

                        <div class="clearfix"></div>
                        <div class="comments">
                            <h2>Comentarios ({{ count($image->comments) }})</h2>
                            <hr>

                            <form action="{{ route('comment.save') }}" method="POST">
                                @csrf

                                <input type="hidden" name="image_id" value="{{ $image->id }}">
                                <p>
                                    <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                                        required></textarea>

                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </p>
                                <button type="submit" class="btn btn-success">Enviar</button>
                            </form>

                            <hr>
                            @foreach ($image->comments as $comment)
                                <div class="comment">
                                    <span class="nickname">{{ '@' . $comment->user->nick }}</span>
                                    <span
                                        class="nickname date">{{ ' | ' .
    \Carbon\Carbon::parse($comment->created_at)->locale('es-AR')->diffForHumans(\Carbon\Carbon::now()) }}</span>
                                    <p>{{ $comment->content }}

                                        @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                            <a href="{{ route('comment.delete', ['id' => $comment->id]) }}"
                                                class="btn btn-sm btn-danger">
                                                Eliminar
                                            </a>
                                        @endif
                                    </p>

                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
