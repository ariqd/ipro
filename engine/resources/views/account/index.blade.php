@extends('layouts.carbon')

@section('title', 'Master Data User')

@push('css')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />
@endpush

@push('js')
<script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.19/features/scrollResize/dataTables.scrollResize.min.js"></script>

<script type="text/javascript">
    $('.data-table').DataTable();

</script>
@endpush

@section('content')
@include('layouts.ajax')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Master Data</h5>
                    <h2 class="font-weight-bold">User</h2>
                </div>
                <div>
                    <a href="{{ url('branches') }}" class="btn btn-secondary"><i class="fa fa-tree"></i> Atur Cabang</a>
                    <a href="#modalForm" data-toggle="modal" data-href="{{ url('accounts/create') }}"
                        class="btn btn-dark"><i class="fa fa-plus"></i> Tambah User</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include("layouts.feedback")
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table table-responsive">
                <table class="table bg-light table-hover data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Cabang</th>
                            {{--<th>Branch</th>--}}
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>
                                {{ $user->role == 'admin' || $user->role == 'finance' ?  '-'  : @$user->branch->name }}
                            </td>
                            <td>
                                <a href="#modalForm" data-toggle="modal"
                                    data-href="{{ url('accounts/'.$user->id.'/edit') }}"
                                    class="btn btn-secondary btn-sm">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
