@extends('adminlte::page')

@section('template_title')
    {{ __('Create') }} Infantes Tutore
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Registrar') }} Infantes y Tutores</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('infantes-tutores.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('infantes-tutore.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
