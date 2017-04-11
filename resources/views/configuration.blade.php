@extends('layouts.app')

@section('content')
    <section id="pv-settings">
        <h2 class="page-header">
            <a href="#pv-settings">PV Settings</a>
        </h2>

        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Inverter address</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ config('inverter.ip') }}:{{ config('inverter.port') }}" disabled>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Inverter Serial:</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ config('inverter.serial') }}" disabled>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Inverter ID:</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ config('inverter.id') }}" disabled>
                </div>
            </div>
        </div>
    </section>

    <section id="api-settings">
        <h2 class="page-header">
            <a href="#api-settings">API settings</a>
        </h2>
        <div id="passport">
            <passport-clients></passport-clients>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-personal-access-tokens></passport-personal-access-tokens>
        </div>
    </section>
@endsection