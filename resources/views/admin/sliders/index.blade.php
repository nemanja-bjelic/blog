@extends('admin._layout.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('Blog Sliders')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index.index')}}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Blog Sliders')</li>
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
                            <h3 class="card-title">@lang('All Blog Sliders')</h3>
                            <div class="card-tools">
                                <form 
                                    class="btn-group" 
                                    id="order-form" 
                                    action="{{route('admin.sliders.change_priority')}}" 
                                    method="post"
                                    style="display: none"
                                >
                                    @csrf
                                    
                                    <input type="hidden" name="priorities" value="">
                                    
                                    <button 
                                        type="submit" class="btn btn-outline-success">
                                        <i class="fas fa-check"></i>
                                        @lang('Save Order')
                                    </button>
                                    <button 
                                        type="button" 
                                        class="btn btn-outline-danger"
                                        data-action="hide-order"
                                    >
                                        <i class="fas fa-remove"></i>
                                        @lang('Cancel')
                                    </button>
                                </form>
                                <button 
                                    class="btn btn-outline-secondary"
                                    data-action="show-order"
                                >
                                    <i class="fas fa-sort"></i>
                                    @lang('Change Order')
                                </button>
                                <a href="{{route('admin.sliders.add')}}" class="btn btn-success">
                                    <i class="fas fa-plus-square"></i>
                                    @lang('Add new Category')
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" id="table-content">
                            <table class="table table-bordered" id="entities-list-table">
                                <thead>                  
                                    <tr>
                                        <th style="width: 20%">#</th>
                                        <th class="text-center">@lang('Photo')</th>
                                        <th style="width: 30%;">@lang('Title')</th>
                                        <th style="width: 30%;">@lang('Button Url')</th>
                                        <th class="text-center">@lang('Status')</th>
                                        <th class="text-center">@lang('Last Change')</th>
                                        <th class="text-center">@lang('Actions')</th>
                                    </tr>
                                </thead>
                                <tbody id="sort-list">
                                   
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

    <form action="{{route('admin.sliders.delete')}}" method="post" class="modal fade" id="delete-modal">
        @csrf
        <input type="hidden" name="id">
        
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Delete Category')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to delete category')?</p>
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
    <form action="{{route('admin.sliders.disable')}}" method="post" class="modal fade" id="disable-modal">
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

    <form action="{{route('admin.sliders.enable')}}" method="post" class="modal fade" id="enable-modal">
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

@push('head_links')
<link href="{{url('/themes/admin/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{url('/themes/admin/plugins/jquery-ui/jquery-ui.theme.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@push('footer_javascript')
<script src="{{url('/themes/admin/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script>

    function pageRefresh () {
    
    $.ajax({
    "url" : "{{route('admin.sliders.slider_table')}}",
    "type" : "get",
    "data" : {}
    
    }).done(function(response){
        $('#sort-list').html(response)
    }).fail(function(jqXHR, textStatus, error){
        console.log('Greska prilikom ucitavanja');

    });
    
}

    
    // delete slider
    
    $('#entities-list-table').on('click', '[data-action="delete"]', function (e) {
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');

        $('#delete-modal [data-container="name"]').html(name);
        $('#delete-modal [name="id"]').val(id);

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
            
            pageRefresh();
        }).fail(function () {
            toastr.error("@lang('Error while deleting user')");
        });
    });
    
    
        // enable slider action
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
            
            pageRefresh();

        }).fail(function () {
            toastr.error('Something went wrong');
        });
    });

    // disable slider action
    $('#entities-list-table').on('click', '[data-action="disable"]', function () {


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
            
            pageRefresh();

        }).fail(function () {
            toastr.error('Something went wrong');
        });
    });
    
    // sortable list
    $( "#sort-list" ).sortable({
        "handle": ".handle",
        "update": function( event, ui ) {
           let priorities = $("#sort-list").sortable('toArray', {
               "attribute": "data-id"
           });
           
           $('#order-form [name="priorities"]').val(priorities.join(','));
        }
        
    });
    
    $('[data-action="show-order"]').on('click', function (e) {
        $('[data-action="show-order"]').hide();
        $('#order-form').show();
        $('.handle').show();
    });
    
    $('[data-action="hide-order"]').on('click', function (e) {
        $('[data-action="show-order"]').show();
        $('#order-form').hide();
        $('.handle').hide();
        $('#sort-list').sortable('cancel');
    });
    
    pageRefresh();

</script>
@endpush