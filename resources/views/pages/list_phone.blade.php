@extends('layouts.app')

@section('content')
    <div class="p-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>
                            <a class="btn btn-primary btn-sm " href="{{ route('home') }}">Dashboard</a>
                            <a class="btn btn-primary btn-sm float-right ml-3" href="{{ route('email') }}">Emails</a>
                            <a class="btn btn-primary btn-sm float-right ml-3" href="{{ route('phone') }}">Phones</a>
                        </b>

                    </div>

                    <div class="card-body">
                        @include('layouts.notice')

                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('phone') }}" method="get" class="" style="display: inline-flex; min-width: 300px">
                                    <input type="hidden" value="{{ @$type }}" name="type">
                                    <input type="text" class="form-control" name="key" value="{{ @$key }}" placeholder="Enter name, SCN or phone" autocomplete="off">
                                    <button class="btn btn-primary btn-sm ml-2">Find</button>
                                </form>
                                <a class="btn btn-primary" href="{{ route('phone') }}">All</a>
                                <a class="btn btn-primary" href="{{ route('phone',['type'=>'unresolved']) }}">Unresolved</a>
                                <a class="btn btn-primary" href="{{ route('export.excel','phone') }}">Download Excel</a>

                            </div>
                        </div>
                        <div>
                            <h5 class="mt-3">Phone calls</h5>
                        </div>
                        <br>
                        <div class="">

                            <div class="table-scrollable">
                                <table class="table table-hover table-checkable order-column full-width" id="example4">
                                    <thead>
                                    <tr>
                                        <th class="center"> Date </th>
                                        <th class="center"> Identifier (SCN/Email...)  </th>
                                        <th class="center"> Name </th>
                                        <th class="center"> Phone </th>
                                        <th class="center"> Issue </th>
                                        <th class="center"> Status </th>
                                        <th class="center"> Action </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $entry)
                                        <tr class="odd gradeX">
                                            <td class="center">{{ date('F d, Y', strtotime($entry->opened)) }}</td>
                                            <td class="center">{{ $entry->scn }}</td>
                                            <td class="center">{{ $entry->name }}</td>
                                            <td class="center">{{ $entry->phone }}</td>
                                            <td class="center">{{ $entry->issue }}</td>
                                            <td class="center">{{ $entry->status }}</td>
                                            <td class="center">
                                                <a href="{{ route('phone.edit', $entry->uuid) }}" class="btn btn-primary btn-sm">Edit</a>
                                                @if($entry->resolved)
                                                    <a title="Resolved" class="btn btn-danger btn-sm" href="{{ route('toggle.case',['uuid'=>$entry->uuid , 'type'=>'phone']) }}">
                                                        Set to Not Resolved
                                                    </a>
                                                @else
                                                    <a title="Resolved" class="btn btn-success btn-sm" href="{{ route('toggle.case',['uuid'=>$entry->uuid , 'type'=>'phone']) }}">
                                                        Set to Resolved
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
