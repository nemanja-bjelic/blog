@extends('admin._layout.layout')

@section('seo_title', 'Post Comments')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('comments')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                        <li class="breadcrumb-item active">@lang('Comments')</li>
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
                            <h3 class="card-title">@lang('All Comments')</h3>
                            
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered" id="entities-list-table">
                                <thead>                  
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th class="text-center">@lang('Status')</th>
                                        <th class="text-center">@lang('Post')</th>
                                        <th style="width: 20%;">@lang('Comment')</th>
                                        <th style="width: 30%;">@lang('Url')</th>
                                        <th class="text-center">@lang('Created At')</th>
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
<!-- /.modal -->
    <form action="{{route('admin.comments.disable')}}" method="post" class="modal fade" id="disable-modal">
        @csrf

        <input type="hidden" name="id" value="">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Disable Comment')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to disable comment')?</p>
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

    <form action="{{route('admin.comments.enable')}}" method="post" class="modal fade" id="enable-modal">
        @csrf

        <input type="hidden" name="id" value="">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Enable Comment')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('Are you sure you want to enable comment')?</p>
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
<script>
    
    function pageRefresh () {
    
    $.ajax({
    "url" : "{{route('admin.comments.comments_table')}}",
    "type" : "get",
    "data" : {}
    
    }).done(function(response){
        $('#sort-list').html(response)
    }).fail(function(jqXHR, textStatus, error){
        console.log('Greska prilikom ucitavanja');

    });
    
}

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
    
    pageRefresh();
</script>
@endpush