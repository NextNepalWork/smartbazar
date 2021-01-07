@extends('admin.layouts.app')
@section('title', 'All Orders')

@section('content')
    @include('partials.message-success')
    @include('partials.message-error')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Orders</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">

                        <a href="{{ route('admin.order.create') }}" class="btn btn-sm btn-danger pull-right">Add New</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Order By</th>
                                <th>Location</th>
                                <th>Time</th>
                                <th>Date</th>
                                @role('admin', 'manager', 'editor')
                                <th class="sorting-false">Action</th>
                                @endrole
                            </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Order By</th>
                                <th>Location</th>
                                <th>Time</th>
                                <th>Date</th>
                                @role('admin', 'manager', 'editor')
                                <th class="sorting-false">Action</th>
                                @endrole
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@push('scripts')


<script>

    function sweetAlert(type, title, message) {
        swal({
            title: title,
            html: message,
            type: type,
            showConfirmButton: false,
            timer: 3000,
        }).catch(swal.noop);
    }

    $(document).ready(function(){
        $('#example1').DataTable({
            aaSorting: [0,'desc'],
            processing: true,
            serverSide: true,
            columns: [
                {
                    "data": "id",
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'name',
                    render: function (data, type, row) {
                        return '<a href="#"  data-id="' + row.id + '">' + data + '</a>';
                    }
                },
                {
                    data: 'status',
                    render: function (data, type, row) {
                        var statusClass = '';
                        switch (data) {
                            case 'pending':
                                statusClass = "warning";
                                break;
                            case 'approved':
                                statusClass = "primary";
                                break;
                            case 'cancelled':
                                statusClass = "danger";
                                break;
                            case 'complete':
                                statusClass = "info";
                                break;
                            default:
                                statusClass = "info";
                        }

                        return '<span class="label label-' + statusClass + '">' + data + '</span>';
                    }
                },
                {data: 'first_name'},
                {data: 'location', name: 'location'},
                {data: 'time', name: 'time'},
                {data: 'created_at', name: 'created_at'},
                {
                    data: 'id',
                    orderable: false,
                    render: function (data, type, row) {
                        var tempEditUrl = "{{ route('admin.service.order.edit', ':id') }}";
                        tempEditUrl = tempEditUrl.replace(':id', data);
                        var actions = '';
                        actions += "<a href='" + tempEditUrl + "' class='btn btn-xs btn-default mr-5'><span class='lnr lnr-pencil'></span></a>";
                        actions += "<button type='submit' class='btn btn-xs btn-default btn-delete' data-id=" + row.id + "><span class='lnr lnr-trash'></span></button>";

                        return actions;
                    }
                }

            ],
            ajax: '{{route('admin.service.json')}}'

        });
    });
</script>


<script>
    $(document).on("click", ".btn-delete", function (e) {
        e.preventDefault();
        if (!confirm('Are you sure you want to delete?')) {
            return false;
        }
        var $this = $(this);

        var id = $this.attr('data-id');
        var tempDeleteUrl = "{{ route('admin.service.order.delete', ':id') }}";                               tempDeleteUrl = tempDeleteUrl.replace(':id', id);


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "GET",
            url: tempDeleteUrl,
            data: id,
            beforeSend: function (data) {
            },
            success: function (data) {
                $(".alert-success").fadeTo(5000, 5000).html(data).slideUp(500, function() {
                    $("#alert").slideUp(5000);
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorsHolder = '';
                errorsHolder += '<ul>';

                var err = eval("(" + xhr.responseText + ")");
                $.each(err.errors, function (key, value) {
                    errorsHolder += '<li>' + value + '</li>';
                });


                errorsHolder += '</ul>';

                $(".alert-danger").fadeTo(5000, 5000).html(errorsHolder).slideUp(500, function() {
                    $("#alert").slideUp(5000);
                });
            },
            complete: function () {
                $('#example1').DataTable().ajax.reload();
            }
        });


    });
</script>


@endpush