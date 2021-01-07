@extends('admin.layouts.app')


@section('content')
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $e)
                    <li> {{ $e }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    <section>
    <div class="modal right fade" id="quickViewModal" tabindex="-1">

	</div>

		<div class="row">
            <h3>All Services</h3>
			<div class="col-md-12 content__box content__box--shadow">
				<table id="myTable" class="table table-striped table-hover">
					<thead>
						<tr>
							<th>SN</th>
							<th>Name</th>
							<th>Parent</th>
                            <th>Description</th>
							<th>Image</th>
							<th>Status</th>
							<th class="sorting-false">Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<th>SN</th>
							<th>Name</th>
							<th>Parent</th>
							<th>Description</th>
							<th>Image</th>
							<th>Status</th>
							<th class="sorting-false">Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
    </section>

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


    $(document).on("click", ".btn-delete", function (e) {
        e.preventDefault();
        if (!confirm('Are you sure you want to delete?')) {
            return false;
        }
        var $this = $(this);

        var id = $this.attr('data-id');
        var tempDeleteUrl = "{{ route('admin.services.delete', ':id') }}";
        tempDeleteUrl = tempDeleteUrl.replace(':id', id);


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
                $('#myTable').DataTable().ajax.reload();
            }
        });


    });



    $(document).ready(function(){
        $('#myTable').DataTable({
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
                {data: 'category', name: 'category'},
                {data: 'description', name: 'description'},
                {data: 'image',
                    orderable: false,
                    render: function (data, type, row) {
                        return '<img src="' + data + '" style="width:50%;height:auto;">';
                    }
                },

                {data: 'status', name: 'status',
                    render: function(data, type, row) {
                        if(data==='1'){
                            return '<span class="label label-success">Published</span>';
                        }
                        else{
                            return '<span class="label label-warning">Unpublished</span>';
                        }
                    }
                },
                {
                    data: 'id',
                    orderable: false,
                    render: function (data, type, row) {
            		var tempEditUrl = "{{ route('admin.services.edit', ':id') }}"
            		tempEditUrl = tempEditUrl.replace(':id', data);
                        var actions = '';
                        actions += "<a href=" + tempEditUrl + " class='btn btn-xs btn-default btn-edit' style='margin-right:5px' data-id=" + row.id + "><span class='lnr lnr-pencil'></span></a>";
                        actions += "<button type='submit' class='btn btn-xs btn-default btn-delete' data-id=" + row.id + "><span class='lnr lnr-trash'></span></button>";

                        return actions;
                    }
                }

            ],
            ajax: '{{route('admin.services.json')}}'

        });
    });




</script>


@endpush