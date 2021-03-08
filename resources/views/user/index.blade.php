@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Gente</h1>
                <hr>
                @foreach ($users as $user)
                    <div class="profile-user">

                        @if ($user->image)
                            <div class="container-avatar">

                                <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" alt="">
                            </div>
                        @endif

                        <div class="user-info">
                            <h2>{{ '@' . $user->nick }}</h2>
                            <h3>{{ $user->name . ' ' . $user->surname }}</h3>
                            <p>{{ ' Se unió: ' .\Carbon\Carbon::parse($user->created_at)->locale('es-AR')->diffForHumans(\Carbon\Carbon::now()) }}
                            </p>
                            <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="btn btn-success">Ver perfil</a>
                        </div>

                        <div class="clearfix"></div>
                        <hr>
                    </div>
                @endforeach

                <!-- PAGINATION -->
                <div class="clearfix">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
