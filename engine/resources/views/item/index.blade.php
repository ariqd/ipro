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
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }

            var table = $('.data-table').DataTable({
                responsive: true,
                // paging: false,
                // dom: "<'myfilter'f><'mylength'l>t",
                // scrollY: '4000px',
                // scrollCollapse: true,
                // pageResize: true
            });

            countitem();
            countWeight();
            countPrice();

            function countitem() {
                var sum = 0;
                $('.item').each(function () {
                    sum += parseInt($(this).text());
                });
                $('.total_item').text(sum);
            }

            function countWeight() {
                var sum = 0;
                $('.weight').each(function () {
                    sum += parseFloat($(this).text());
                });
                var text = sum + ' kg';
                if (sum > 1000) {
                    sum = sum / 1000;
                    var weight = Number(sum).toFixed(2);
                    text = weight + ' ton';
                }
                $('.total_weight').text(text);
            }

            function countPrice() {
                var sum = 0;
                $('.price').each(function () {
                    sum += parseFloat($(this).text());
                });
                $('.total_price').text(addCommas(sum));
            }

            $('#myInput').on('keyup', function () {
                table.search(this.value).draw();

                countPrice();
                countWeight();
                countitem();
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
                {{--@if(isset($filtered))--}}
                {{--<a href="{{ url('items') }}" class="btn btn-dark mr-2"><i class="fa fa-refresh"></i> Clear--}}
                {{--Filter</a>--}}
                {{--@else--}}
                {{--<a class="btn btn-secondary mr-2" data-toggle="collapse" href="#collapseExample" role="button"--}}
                {{--aria-expanded="false" aria-controls="collapseExample">--}}
                {{--Filter <i class="fa fa-chevron-down"></i>--}}
                {{--</a>--}}
                {{--@endif--}}
                {{--<a href="{{ url('items/reitem') }}"--}}
                {{--class="btn btn-success mr-2"><i class="fa fa-plus-circle"></i> Reitem</a>--}}
                {{--<a href="#modalForm" data-toggle="modal" data-href="{{ url('items/reitem') }}"--}}
                {{--class="btn btn-success mr-2"><i class="fa fa-plus-circle"></i> Reitem</a>--}}
                @if(Gate::allows('isAdmin'))
                    <a href="#modalForm" data-toggle="modal" data-href="{{ url('items/create') }}"
                       class="btn btn-dark"><i class="fa fa-plus"></i> Add Item</a>
                @endif
            </div>
        </div>
        @if(!empty(Request::all()))
            <div class="row">
                <div class="col-lg-12">
                    {{-- <b>Filters:</b> <br>
                    @if(Request::has("brands"))
                    Brands:
                    @php
                    $brands = Request::get("brands");
                    @endphp
                    @foreach($brands as $key => $brand)
                    {{ $brand }}{{ $key == (count($brands) - 1) ? '' : ',' }}
                    @endforeach
                    <br>
                    @endif

                    @if(Request::has("branches"))
                    Branches:
                    @php
                    $branches = Request::get("branches");
                    @endphp
                    @foreach($branches as $key => $branch)
                    {{ $branch }}{{ $key == (count($branches) - 1) ? '' : ',' }}
                    @endforeach
                    @endif --}}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <form action="{{ url('items') }}" id="find-table" method="get">
                            <div class="row">
                                <label for="brands" class="col-lg-2 col-form-label text-right"><h4>Brands :</h4></label>
                                <div class="col-lg-10">
                                    <div class="row p-2">
                                        {{-- @foreach($brands as $key => $brand)
                                        <div class="col-lg-2 mb-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="brands[]"
                                                class="custom-control-input check" id="{{ $brand }}"
                                                value="{{ $brand }}"
                                                                                                           {{ $brand == Request::get("brands")[$i] ? 'checked' : '' }}
                                                >
                                                <label class="custom-control-label"
                                                for="{{ $brand }}">{{ $brand }}</label>
                                            </div>
                                        </div>
                                        @endforeach --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="brands" class="col-lg-2 col-form-label text-right"><h4>Branch :</h4></label>
                                <div class="col-lg-10">
                                    <div class="row p-2">
                                        {{--   @foreach($branches as $branch)
                                          <div class="col-lg-2 mb-2">
                                              <div class="custom-control custom-checkbox">
                                                  <input type="checkbox" name="branches[]"
                                                  class="custom-control-input check" id="{{ $branch }}"
                                                  value="{{ $branch }}"
                                                  >
                                                  <label class="custom-control-label"
                                                  for="{{ $branch }}">{{ $branch }}</label>
                                              </div>
                                          </div>
                                          @endforeach --}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-dark float-right" id="btnFilter">Apply Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.feedback')
        <div class="row" id="table">
            <div class="col-lg-12">
                {{--<div class="card">--}}
                {{--<div class="card-body">--}}
                <div class="table-responsive">
                    <table class="table table-bordered data-table table-light w-100">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Code</th>
{{--                            <th>Brand</th>--}}
{{--                            <th>Category</th>--}}
                            <th>Name</th>
                            {{--<th></th>--}}
                            {{--<th"></th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->category->brand->name }} {{ $item->category->name }} {{ $item->name }}</td>
                                <td></td>
                                <td></td>
                                {{--<td class="cabang">{{ $item->branch }}</td>--}}

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection