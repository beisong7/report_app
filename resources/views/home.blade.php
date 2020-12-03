@extends('layouts.app')

@section('content')
    <div class="p-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @include('layouts.nav')
                    </div>

                    <div class="card-body">
                        @include('layouts.notice')
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Phone Calls</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Emails</a>
                            <a class="nav-item nav-link" id="nav-statistic-tab" data-toggle="tab" href="#nav-statistic" role="tab" aria-controls="nav-profile" aria-selected="false">Statistics</a>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                @include('slices.phone_tab')
                            </div>

                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                @include('slices.mail_tab')
                            </div>

                            <div class="tab-pane fade" id="nav-statistic" role="tabpanel" aria-labelledby="nav-statistic-tab">
                                <div class="container">
                                    <div class="p-5">
                                        <div class="row">
                                            <div class="col">
                                                <h2 class="text-center">{{ $week_calls  }}</h2>
                                                <h3 class="text-center">CALLS THIS WEEK </h3>

                                            </div>
                                            <div class="col">
                                                <h2 class="text-center">{{ $week_emails }}</h2>
                                                <h3 class="text-center">EMAILS THIS WEEK </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
