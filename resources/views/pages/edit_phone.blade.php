@extends('layouts.app')

@section('content')
    <div class="p-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>
                            <a class="btn btn-primary btn-sm " href="{{ route('home') }}">Dashboard</a>
                            <span class="mb-0" >Edit Record </span>
                            <a class="btn btn-primary btn-sm " href="{{ route('phone') }}">Phones</a>
                        </b>
                    </div>

                    <div class="card-body">
                        @include('layouts.notice')
                        <br>
                        <form action="{{ route('phone.edit', $item->uuid) }}" method="post">
                            @csrf
                            <div class="form-group mt-3 mb-3">
                                <div class="row">
                                    <div class="col">
                                        <small>Phone</small>
                                        <input type="text" class="form-control" onkeypress="return isNumberKey(event);" placeholder="Phone Number" name="phone" value="{{ $item->phone }}" autocomplete="off">
                                    </div>
                                    <div class="col">
                                        <small>Identifier</small>
                                        <input type="text" class="form-control" placeholder="Identifier (SCN/Email...) " name="scn" value="{{ $item->scn }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col">
                                        <small>Issue</small>
                                        @include('layouts.issues_field2')
                                    </div>
                                    <div class="col">
                                        <small>Names</small>
                                        <input type="text" class="form-control" placeholder="Name" name="name" autocomplete="off" value="{{ $item->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <small>Opened date</small>
                                        <input type="date" class="form-control" name="date" autocomplete="off" value="{{ date('Y-m-d', strtotime($item->opened)) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary btn-block" type="submit">Update Record</button>
                                    </div>
                                    <div class="col-6">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
