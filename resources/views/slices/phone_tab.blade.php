<form action="{{ route('save.phone') }}" method="post">
    @csrf
    <div class="form-group mt-3 mb-3">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" onkeypress="return isNumberKey(event);" placeholder="Phone Number" name="phone" value="{{ old('phone') }}" autocomplete="off">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Identifier (SCN/Email...) " name="scn" value="{{ old('scn') }}" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="row">
            <div class="col">
                @include('layouts.issues_field')
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Name" name="name" autocomplete="off" value="{{ old('name') }}">
            </div>
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="row">
            <div class="col">
                <select type="text" class="form-control" required name="status">
                    <option value=""></option>
                    <option value="Not Resolved" {{ old('status')==='Not Resolved'?'selected':'' }}>Not Resolved</option>
                    <option value="Resolved" {{ old('status')==='Resolved'?'selected':'' }}>Resolved</option>
                </select>
            </div>
            <div class="col">
                <input type="date" class="form-control" name="date" autocomplete="off" value="{{ old('date') }}">
            </div>
        </div>
    </div>
    <div class="form-group mb-3">
        <div class="row">
            <div class="col-6">
                <button class="btn btn-primary btn-block" type="submit">Enter Log</button>
            </div>
            <div class="col-6">
            </div>
        </div>
    </div>
</form>

<div class="row mt-5">
    <div class="col-12">
        Latest Entries
    </div>
    <div class="col-12">
        <div class="table-scrollable">
            <table class="table table-hover table-checkable order-column full-width" id="example4">
                <thead>
                <tr>
                    <th class="center"> Date </th>
                    <th class="center"> Identifier (SCN/Email...) </th>
                    <th class="center"> Name </th>
                    <th class="center"> Phone </th>
                    <th class="center"> Issue </th>
                    <th class="center"> Status </th>
                    <th class="center"> Action </th>
                </tr>
                </thead>
                <tbody>
                @foreach($phones as $entry)
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
    </div>
</div>