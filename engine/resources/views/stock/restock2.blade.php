@extends('layouts.carbon')

@section('title', 'Stock')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet"/>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
                paging: false,
                dom: "<'myfilter'f><'mylength'l>t",
                scrollY: '4000px',
                scrollCollapse: true,
                pageResize: true
            });

            countStock();
            countWeight();
            countPrice();

            function countStock() {
                var sum = 0;
                $('.stock').each(function () {
                    sum += parseInt($(this).text());
                });
                $('.total_stock').text(sum);
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
                countStock();
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

        $('.select2').select2();
        $('#restock-btn').on('click', function (e) {
            $('.select2').select2('destroy');
            var selectorParent = $('#restock-form').html();
            $('#restock-row').append(selectorParent);
            $('.select2').select2();
        });
    </script>
@endpush

@section('content')
    @include('layouts.ajax')
    <div class="container fill">
        <div class="row">
            <div class="col-lg-4">
                <h2>Restock</h2>
            </div>
            <div class="col-lg-8">

            </div>
        </div>
        @include('layouts.feedback')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <div id="restock-form">
                                <div class="form-row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="brand">Produk</label>
                                            <select class="select2 form-control" name="brand"
                                                    id="brand">
                                                <option value="0" disabled selected>- Pilih Produk -</option>
                                                @foreach($stocks as $stock)
                                                    <option value="{{ $stock->id }}">{{ $stock->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="quantity">Restock Quantity</label>
                                            <input type="number" class="form-control" id="number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="restock-row"></div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="button" id="restock-btn" class="btn btn-secondary"><i
                                                class="fa fa-plus"></i> Tambah produk lain
                                    </button>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary float-right"><i
                                                class="fa fa-check"></i> Restock
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection