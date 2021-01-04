@extends('admin.layouts.app')
@section('title', 'Vendors')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Service Provider Stats</h3>
        </div>
        <!-- /.col-lg-12-->
    </div>
    <div class="content__box content__box--shadow">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel content__box content__box--shadow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <div class="huge">{{ $service }}</div>
                                <div>Total Service</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.provider.stat.index') .'?status=' .'all'.'&id=' . $providerId }}">
                        <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><svg class="svg-inline--fa fa-arrow-circle-right fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="arrow-circle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path></svg><!-- <i class="fa fa-arrow-circle-right"></i> --></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel content__box content__box--shadow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <div class="huge">{{ $providerReviews }}</div>
                                <div>Total Reviews</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.provider.rating.index') .'?id=' . $providerId }}">
                        <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><svg class="svg-inline--fa fa-arrow-circle-right fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="arrow-circle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path></svg><!-- <i class="fa fa-arrow-circle-right"></i> --></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel content__box content__box--shadow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <div class="huge">{{ $providerRating }}</div>
                                <div>Total Rating</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.provider.rating.index') .'?id=' . $providerId }}">
                        <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><svg class="svg-inline--fa fa-arrow-circle-right fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="arrow-circle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path></svg><!-- <i class="fa fa-arrow-circle-right"></i> --></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section>

        <div class="content__box content__box--shadow">
            <div class="row">
                <h5>Services</h5>
                <div class="col-lg-3 col-md-6">
                    <div class="panel content__box content__box--shadow">
                        <div class="text-center">
                            <div>Pending Services</div>
                            <div class="huge">{{ $servicePending }}</div>
                        </div>
                        <a href="{{ route('admin.provider.stat.index') .'?status=' .'pending'.'&id=' . $providerId }}">
                            <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><svg class="svg-inline--fa fa-arrow-circle-right fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="arrow-circle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path></svg><!-- <i class="fa fa-arrow-circle-right"></i> --></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel content__box content__box--shadow">
                        <div class="text-center">
                            <div>Approved Services</div>
                            <div class="huge">{{ $serviceApprove }}</div>
                        </div>
                        <a href="{{ route('admin.provider.stat.index') .'?status=' .'approve'.'&id=' . $providerId }}">
                            <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><svg class="svg-inline--fa fa-arrow-circle-right fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="arrow-circle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path></svg><!-- <i class="fa fa-arrow-circle-right"></i> --></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel content__box content__box--shadow">
                        <div class="text-center">
                            <div>Complete Services</div>
                            <div class="huge">{{ $serviceComplete }}</div>
                        </div>
                        <a href="{{ route('admin.provider.stat.index') .'?status=' .'complete'.'&id=' . $providerId }}">
                            <div class="panel-footer"><span class="pull-left">View Details</span>
                                <span class="pull-right"><svg class="svg-inline--fa fa-arrow-circle-right fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="arrow-circle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path></svg><!-- <i class="fa fa-arrow-circle-right"></i> --></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel content__box content__box--shadow">
                        <div class="text-center">
                            <div>Canclled Services</div>
                            <div class="huge">{{ $serviceCancelled }}</div>
                        </div>
                        <a href="{{ route('admin.provider.stat.index') .'?status=' .'cancelled'.'&id=' . $providerId }}">
                            <div class="panel-footer"><span class="pull-left">View Details</span><span class="pull-right"><svg class="svg-inline--fa fa-arrow-circle-right fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="arrow-circle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z"></path></svg><!-- <i class="fa fa-arrow-circle-right"></i> --></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')

@endpush