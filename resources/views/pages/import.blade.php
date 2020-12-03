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

                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('start.import') }}" method="post" class="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <input type="file" name="file" required>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="radio" name="channel" value="calls" checked> Phone
                                            <input type="radio" name="channel" value="emails" class="ml-3"> Emails
                                        </div>

                                    </div>
                                    <button class="btn btn-primary btn-sm">Upload</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
