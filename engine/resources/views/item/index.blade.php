@extends('layouts.carbon')

@section('title', 'Master Data Item')

@push('css')
    <link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/features/scrollResize/dataTables.scrollResize.min.js"></script>
@endpush

@push('style')
    <style>
        .fill {
            min-height: 100%;
            height: 100%;
        }

        .dataTables_filter {
            display: none;
        }

        .dataTables_wrapper .myfilter .dataTables_filter {
            float: left
        }

        .dataTables_wrapper .mylength .dataTables_length {
            float: right
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function () {
            function addCommas(nStr) {
                nStr += '';
                let x = nStr.split('.');
                let x1 = x[0];
                let x2 = x.length > 1 ? '.' + x[1] : '';
                let rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }

            $('.data-table').DataTable({
                responsive: true
            });

            $('.btnDelete').on('click', function (e) {
                e.preventDefault();
                var parent = $(this).parent();

                swal({
                    title: "Apa anda yakin?",
                    text: "Data akan terhapus secara permanen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true
                })
                    .then(function (willDelete) {
                        if (willDelete) {
                            parent.find('.formDelete').submit();
                        }
                    });
            });
        });
    </script>
@endpush

@section('content')
    @include('layouts.ajax')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h5 class="mb-0">Master Data</h5>
                <h2><b>Items</b></h2>
            </div>
            <div class="d-flex align-items-center ">
                <div class="input-group mr-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="add-on"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" id="myInput" class="form-control" placeholder="Search item..."
                           aria-label="Search" aria-describedby="add-on">
                </div>
                @if(Gate::allows('isAdmin'))
                    <a href="#modalForm" data-toggle="modal" data-href="{{ url('items/create') }}"
                       class="btn btn-dark"><i class="fa fa-plus"></i> Add Item</a>
                @endif
            </div>
        </div>
        @include('layouts.feedback')
        <div class="row" id="table">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table data-table table-light w-100">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Code</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->category->brand->name }} </td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="#modalForm" data-toggle="modal" data-href="items/{{ $item->id }}/edit"
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