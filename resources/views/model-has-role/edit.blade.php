@extends('adminlte::page')

@section('template_title')
    {{ __('Editar Roles') }} - {{ $user->name }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="col-md-8 offset-md-2">

        <div class="card shadow-sm rounded-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ __('Editar Roles de') }} {{ $user->name }}</h4>
            </div>

            <div class="card-body bg-white">
                <form method="POST" action="{{ route('model-has-roles.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    @include('model-has-role.form')

                </form>
            </div>
        </div>

    </div>
</section>
@endsection
