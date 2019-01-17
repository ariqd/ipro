@push('css')
    <style>
        .loading {
            background: lightgrey;
            padding: 15px;
            position: fixed;
            border-radius: 4px;
            left: 50%;
            top: 50%;
            text-align: center;
            margin: -40px 0 0 -50px;
            z-index: 2000;
            display: none;
        }

        a, a:hover {
            color: white;
        }

        .form-group.required label:after {
            content: " *";
            color: red;
            font-weight: bold;
        }
    </style>
@endpush

<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog {{ @$size == 'lg' ? 'modal-lg' : '' }}" role="document">
        <div class="modal-content" id="modal_content"></div>
    </div>
</div>
<div class="loading">
    <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i><br/>
    <span>Loading</span>
</div>

@push('js')
    <script src="{{ asset('js/ajax-crud-modal-form.js') }}"></script>
@endpush