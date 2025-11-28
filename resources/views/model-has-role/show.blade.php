@extends('adminlte::page')

@section('template_title')
    {{ $modelHasRole->name ?? __('Show') . " " . __('Model Has Role') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Model Has Role</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('model-has-roles.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Role Id:</strong>
                                    {{ $modelHasRole->role_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Model Type:</strong>
                                    {{ $modelHasRole->model_type }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Model Id:</strong>
                                    {{ $modelHasRole->model_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
