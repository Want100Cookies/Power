@extends('layouts.app')

@section('content')
    <div id="configuration">
        <section id="costprice">
            <h2 class="page-header">
                <a href="#costprice">Cost prices</a>
            </h2>

            <cost-price></cost-price>
        </section>

        <section id="pv-settings">
            <h2 class="page-header">
                <a href="#pv-settings">PV Settings</a>
            </h2>

            <inverter></inverter>
        </section>

        <section id="api-settings">
            <h2 class="page-header">
                <a href="#api-settings">API settings</a>
            </h2>
            <passport-clients></passport-clients>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-personal-access-tokens></passport-personal-access-tokens>
        </section>
    </div>
@endsection