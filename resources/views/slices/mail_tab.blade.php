<form action="{{ route('save.email') }}" method="post">
    @csrf
    <div class="form-group mt-3 mb-3">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}" autocomplete="off">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Enrollment" name="scn" value="{{ old('scn') }}" autocomplete="off">
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
                    <th class="center"> Email </th>
                    <th class="center"> Enrollment </th>
                    <th class="center"> Name </th>
                    <th class="center"> Issue </th>
                    <th class="center"> Status </th>
                    <th class="center"> Action </th>
                </tr>
                </thead>
                <tbody>
                @foreach($emails as $email)
                    <tr class="odd gradeX">
                        <td class="center">{{ date('F d, Y', strtotime($email->opened)) }}</td>
                        <td class="center">{{ $email->email }}</td>
                        <td class="center">{{ $email->scn }}</td>
                        <td class="center">{{ $email->name }}</td>
                        <td class="center">{{ $email->issue }}</td>
                        <td class="center">{{ $email->status }}</td>
                        <td class="center">
                            <a href="{{ route('email.edit', $email->uuid) }}" class="btn btn-primary btn-sm">Edit</a>
                            @if($email->resolved)
                                <a title="Resolved" class="btn btn-danger btn-xs" href="{{ route('toggle.case',['uuid'=>$email->uuid , 'type'=>'mail']) }}">
                                    Not Resolved
                                </a>
                            @else
                                <a title="Resolved" class="btn btn-success btn-xs" href="{{ route('toggle.case',['uuid'=>$email->uuid , 'type'=>'mail']) }}">
                                    Resolved
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