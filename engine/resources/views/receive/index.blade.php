@extends('layouts.carbon')

@section('title', 'Goods Receive')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @include("layouts.feedback")

            <div class="d-flex justify-content-between">
                <div>
                    <h2><b>Goods Receive</b></h2>
                </div>
                <div>
                    <a href="{{ url('/goods-receive/create') }}" class="btn btn-dark"><i
                        class="fa fa-plus"></i> New Goods Receive</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-light">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>No Receive</th>
                                <th>No PO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key)
                            <tr>
                              <td>{{ date("d-m-Y",strtotime($key->created_at)) }}</td>
                              <td>{{ $key->receipt }}</td>
                              <td>{{ $key->purchase->purchase_number }}</td>
                              <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-dark btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">

                                    @if(Gate::allows('isAdmin'))
                                    <a href="{{ url('goods-receive/'.$key->id) }}"
                                    class="dropdown-item">
                                    <i class="fa fa-eye"></i> Detail</a>
                                    <form action="{{ url('goods-receive/'.$key->id) }}"
                                      method="post" class="formDelete d-none">
                                      {!! csrf_field() !!}
                                      {!! method_field('delete') !!}
                                  </form>
                                  @endif
                              </div>
                              </
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
  @endsection