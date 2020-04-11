@extends('admin._layout.layout')

@section('seo_title', __('Users'))

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('Users')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.index.index')}}">
                                @lang('Home')
                            </a>
                        </li>
                        <li class="breadcrumb-item active">@lang('Users')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('Search User by status')</h3>
                            <div class="card-tools">
                                <a href="{{route('admin.users.add')}}" class="btn btn-success">
                                    <i class="fas fa-plus-square"></i>
                                    @lang('Add new User')
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="entities-filter-form">
                                <div class="row">
                                    <div class="col-md-1 form-group">
                                        <label>@lang('Status')</label>
                                        <select class="form-control" name="status">
                                            <option value="">-- @lang('All') --</option>
                                            <option value="1">@lang('enabled')</option>
                                            <option value="0">@lang('disabled')</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>@lang('Email')</label>
                                        <input type="text" class="form-control" placeholder="@lang('Search by email')" name="email">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>@lang('Name')</label>
                                        <input type="text" class="form-control" placeholder="@lang('Search by name')" name="name">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" placeholder="@lang('Search by phone')" name="phone">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('All Users')</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="entities-list-table" class="table table-bordered">
                                <thead> 
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th style="width: 20px">@lang('Status')</th>
                                        <th class="text-center">@lang('Photo')</th>
                                        <th>@lang('Email')</th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Phone')</th>
                                        <th class="text-center">@lang('Created At')</th>
                                        <th class="text-center">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- /.modal -->
    <form action="{{route('admin.users.disable')}}" method="post" class="modal fade" id="disable-modal">
        @csrf
        <input type="hidden" name="id" value="">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Disable User')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to disable user')?</p>
                    <strong data-container="name"></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-minus-circle"></i>
                        @lang('Disable')
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->

    <form action="{{route('admin.users.enable')}}" method="post" class="modal fade" id="enable-modal">
        @csrf
        <input type="hidden" name="id" value="">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Enable User')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to enable user')?</p>
                    <strong data-container="name"></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i>
                        @lang('Enable')
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->
</div>
<!-- /.content-wrapper -->
@endsection

@push('footer_javascript')

<script type="text/javascript">

    $('#entities-filter-form [name]').on('change keyup', function (e) {
        $('#entities-filter-form').trigger('submit');
    });

    $('#entities-filter-form').on('submit', function (e) {
        e.preventDefault();

        entitiesDataTable.ajax.reload(null, true);
    });

    let entitiesDataTable = $('#entities-list-table').DataTable({
        "serverSide": true,
        "ajax": {
            "url": "{{route('admin.users.datatable')}}",
            "type": "post",
            "data": function (dtData) {
                dtData["_token"] = "{{csrf_token()}}";

                dtData["status"] = $('#entities-filter-form [name="status"]').val();
                dtData["email"] = $('#entities-filter-form [name="email"]').val();
                dtData["name"] = $('#entities-filter-form [name="name"]').val();
                dtData["phone"] = $('#entities-filter-form [name="phone"]').val();
            }
        },
        "lengthMenu": [5, 10, 15],
        "columns": [
            {"name": "id", "data": "id"},
            {"name": "status", "data": "status", "orderable": false, "searchable": false},
            {"name": "photo", "data": "photo", "orderable": false, "searchable": false},
            {"name": "email", "data": "email"},
            {"name": "name", "data": "name"},
            {"name": "phone", "data": "phone", "orderable": false},
            {"name": "created_at", "data": "created_at"},
            {"name": "actions", "data": "actions", "orderable": false, "searchable": false},
        ]
    });



    // enable user
    $('#entities-list-table').on('click', '[data-action="enable"]', function (e) {

        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');

        $('#enable-modal [name="id"]').val(id);
        $('#enable-modal [data-container="name"]').html(name);
    });

    $('#enable-modal').on('submit', function (e) {
        e.preventDefault();

        $(this).modal('hide');

        $.ajax({
            "url": $(this).attr('action'),
            "type": "post",
            "data": $(this).serialize()
        }).done(function (response) {

            toastr.success(response.system_message);

            entitiesDataTable.ajax.reload(null, false);

        }).fail(function () {


            toastr.error('Error while enabling user');
        });
    });

    // disable user
    $('#entities-list-table').on('click', '[data-action="disable"]', function (e) {

        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');

        $('#disable-modal [name="id"]').val(id);
        $('#disable-modal [data-container="name"]').html(name);
    });

    $('#disable-modal').on('submit', function (e) {
        e.preventDefault();

        $(this).modal('hide');

        $.ajax({
            "url": $(this).attr('action'),
            "type": "post",
            "data": $(this).serialize()
        }).done(function (response) {

            toastr.success(response.system_message);

            entitiesDataTable.ajax.reload(null, false);

        }).fail(function () {


            toastr.error('Error while disabling user');
        });
    });

</script>

@endpush