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

                        <h5>Records Left: <b>{{ $phones }}</b></h5>
                        @if(!empty($phone))
                            <form action="{{ route('update.unfiltered') }}" method="post">
                                @csrf
                                <input type="hidden" name="uuid", value="{{ $phone->uuid }}">
                                <p>{{ $phone->comment }}</p>
                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col">
                                            @include('layouts.issues_field')
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-primary btn-block" type="submit">Update and Proceed</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        @else
                            <div class="jumbotron">
                                <h5 class="">No Records. Upload new records if available.</h5>
                                <p class="">If you have already done this, please ignore</p>
                            </div>
                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
