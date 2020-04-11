@extends('admin._layout.layout')

@section('seo_title', 'Posts')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('Posts')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index.index') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Posts')</li>
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
                            <h3 class="card-title">@lang('Search Posts')</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.posts.add') }}" class="btn btn-success">
                                    <i class="fas fa-plus-square"></i>
                                    @lang('Add new Post')
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="entities-filter-form">
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label>@lang('Title')</label>
                                        <input type="text" name="title" class="form-control" placeholder="@lang('Search by title')">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label>@lang('Author')</label>
                                        <select class="form-control" name="user_id">
                                            <option value="">--@lang('Choose Author') --</option>
                                            @foreach(App\User::all() as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label>@lang('Category')</label>
                                        <select class="form-control" name="post_category_id">
                                            <option value="">--@lang('Choose Category') --</option>
                                            @foreach(App\Models\PostCategory::all() as $postCategory)
                                            <option value="{{ $postCategory->id }}">{{ $postCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <label>@lang('Important')</label>
                                        <select class="form-control" name="important">
                                            <option value="">-- @lang('All') --</option>
                                            <option value="1">@lang('yes')</option>
                                            <option value="0">@lang('no')</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <label>@lang('Status')</label>
                                        <select class="form-control" name="status">
                                            <option value="">-- @lang('All') --</option>
                                            <option value="1">@lang('enabled')</option>
                                            <option value="0">@lang('disabled')</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label>@lang('With Tag')</label>
                                        <select class="form-control" multiple name="tag_ids">
                                            @foreach(App\Models\Tag::all() as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
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
                            <h3 class="card-title">@lang('All Posts')</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered" id="entities-list-table">
                                <thead>                  
                                    <tr>
                                        <th style="width: 5px">#</th>
                                        <th class="text-center">@lang('Photo')</th>
                                        <th style="10px">@lang('Imp')</th>
                                        <th style="10px">@lang('Status')</th>
                                        <th style="width: 5px;">@lang('Title')</th>
                                        <th style="width: 5%;">@lang('Author')</th>
                                        <th class="text-center">@lang('Category')</th>
                                        <th class="text-center" style="width: 5px">@lang('Tags')</th>
                                        <th class="text-center" style="width: 3px">@lang('C')</th>
                                        <th class="text-center" style="width: 5px">@lang('V')</th>
                                        <th class="text-center" style="5px">@lang('Created At')</th>
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

    <form class="modal fade" id="delete-modal" action="{{ route('admin.posts.delete') }}" method="post">
        @csrf
        <input type="hidden" name="id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Delete Post')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to delete post')?</p>
                    <strong data-container="name"></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
                    <button type="submit" class="btn btn-danger">@lang('Delete')</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->
    
    <form action="{{route('admin.posts.disable')}}" method="post" class="modal fade" id="disable-modal">
        @csrf
        <input type="hidden" name="id" value="">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Disable Post')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to disable post')?</p>
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

    <form action="{{route('admin.posts.enable')}}" method="post" class="modal fade" id="enable-modal">
        @csrf
        <input type="hidden" name="id" value="">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Enable Post')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to enable post')?</p>
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
    
    <form action="{{route('admin.posts.unimportant')}}" method="post" class="modal fade" id="unimportant-modal">
        @csrf
        <input type="hidden" name="id" value="">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Set as Unimportant Post')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to set as unimportant post')?</p>
                    <strong data-container="name"></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-minus-circle"></i>
                        @lang('Set as Unimportant')
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->

    <form action="{{route('admin.posts.important')}}" method="post" class="modal fade" id="important-modal">
        @csrf
        <input type="hidden" name="id" value="">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Set as Important Post')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to set as important post')?</p>
                    <strong data-container="name"></strong>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i>
                        @lang('Set as Important')
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

<script>
    
 $('#entities-filter-form [name="user_id"]').select2({
     'theme': "bootstrap4"
 });
 
 $('#entities-filter-form [name="post_category_id"]').select2({
     'theme': "bootstrap4"
 });
    
 $('#entities-filter-form [name="tag_ids"]').select2({
     'theme': "bootstrap4"
 });
    
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
            "url": "{{route('admin.posts.datatable')}}",
            "type": "post",
            "data": function (dtData) {
                dtData["_token"] = "{{csrf_token()}}";

                dtData["status"] = $('#entities-filter-form [name="status"]').val();
                dtData["title"] = $('#entities-filter-form [name="title"]').val();
                dtData["user_id"] = $('#entities-filter-form [name="user_id"]').val();
                dtData["post_category_id"] = $('#entities-filter-form [name="post_category_id"]').val();
                dtData["important"] = $('#entities-filter-form [name="important"]').val();
                dtData["tag_ids"] = $('#entities-filter-form [name="tag_ids"]').val();
            }
        },
        "columns": [
            {"name": "id", "data": "id"},
            {"name": "photo", "data": "photo", "orderable": false, "searchable": false},
            {"name": "important", "data": "important", "orderable": false, "searchable": false},
            {"name": "status", "data": "status", "orderable": false, "searchable": false},
            {"name": "title", "data": "title"},
            {"name": "user_name", "data": "user_name"},
            {"name": "post_category_name", "data": "post_category_name"},
            {"name": "tags", "data": "tags", "orderable": false},
            {"name": "comments_number", "data": "comments_number", "searchable": false, "orderable": false},
            {"name": "visits_number", "data": "visits_number", "searchable": false, "orderable": false},
            {"name": "created_at", "data": "created_at", "searchable": false},
            {"name": "actions", "data": "actions", "orderable": false, "searchable": false},
        ]
    });
    
        // delete post
    
    $('#entities-list-table').on('click', '[data-action="delete"]', function (e) {
        
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');
        
        
        $('#delete-modal [name="id"]').val(id);
        $('#delete-modal [data-container="name"]').text(name);
    });
    
        $('#delete-modal').on('submit', function (e) {
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


            toastr.error('Error while disabling post');
        });
    });
    
    // disable post
    
    $('#entities-list-table').on('click', '[data-action="disable"]', function (e) {
        
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');
        
        
        $('#disable-modal [name="id"]').val(id);
        $('#disable-modal [data-container="name"]').text(name);
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


            toastr.error('Error while disabling post');
        });
    });
    
    
    // enable post
    
    $('#entities-list-table').on('click', '[data-action="enable"]', function (e) {
        
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');
        
        
        $('#enable-modal [name="id"]').val(id);
        $('#enable-modal [data-container="name"]').text(name);
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


            toastr.error('Error while enabling post');
        });
    });
    
    
        // set as unimportant post
    
    $('#entities-list-table').on('click', '[data-action="unimportant"]', function (e) {
        
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');
        
        
        $('#unimportant-modal [name="id"]').val(id);
        $('#unimportant-modal [data-container="name"]').text(name);
    });
    
        $('#unimportant-modal').on('submit', function (e) {
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


            toastr.error('Error while set as unimportant post');
        });
    });
    
    
    // set as unimportant post
    
    $('#entities-list-table').on('click', '[data-action="important"]', function (e) {
        
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');
        
        
        $('#important-modal [name="id"]').val(id);
        $('#important-modal [data-container="name"]').text(name);
    });
    
        $('#important-modal').on('submit', function (e) {
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


            toastr.error('Error while set as important post');
        });
    });

</script>

@endpush