@extends('layouts.app')
@section('title', 'Cancellation & Refunds')

@section('content')

    <section id="about-section" class="about_section">
        <div class="container pt-3">
            <section class="breadcrumbs ">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li><span>Cancellation & Refunds</span></li>
                </ul>
            </section>
            <div class="heading pt-3">
                <h3> Cancellation & Refunds</h3>
            </div>
            <hr>
        </div>
        <div class="container mb">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <p>{!! getConfiguration('cancellation') !!}</p>
                </div>
            </div>
        </div>
    </section>

@endsection

