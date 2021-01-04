@extends('admin.layouts.app')
@section('title', 'Deal Product')

@section('content')

@include('partials.message-success')
@include('partials.message-error')

<div class="col-xs-6">
	<section>
		<input type="hidden" class="deal_id" value="{{ $deal->id }}">
		<div class="row">
		        <div class="alert alert-success alert-message">
        {!! session('success') !!}
    </div>
			<h3>Add Products To Deals</h3>
			<div class="content__box content__box--shadow">
			    <form action="{{ Request::fullUrl() }}" method="get">
		        <div class="pull-left">
			        Vendors
    			    <select name="vendor_sort" class="vendor">
    			        <option value="" selected>Select</option>
    			        @foreach($vendors as $vendor)
    			        <option value="{{ $vendor->id }}">{{ $vendor->user_name }}</option>
    			        @endforeach
    			    </select>
			    </div>
			    <div class="pull-right">
			    Category
			    <select name="category_sort" class="category">
			        <option value="" selected>Select</option>
			        @foreach($categories as $category)
			        <option value="{{ $category->id }}">{{ $category->name }}</option>
			        @endforeach
			    </select>
			    </div>
			    <br>
			    <hr>
			    </form>
				<table class="table table-striped table-hover" id="dealProductAddTable">
					<thead>
						<tr>
							<th>SN</th>
							<th>Name</th>
							{{-- <th>Priority</th> --}}
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					    @foreach($products as $product)
						<tr>
						    <td>{{ $loop->iteration }}</td>
							<td>{{ $product->name }}</td>
							<td>
								<button name="submit" class="btn btn-default btn-xs add-to-deal" data-id="{{ $product->id }}">Add To Deal</button>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>SN</th>
							<th>Name</th>
							{{-- <th>Priority</th> --}}
							<th>Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</section>
</div>

<div class="col-xs-6">
	<section>
		<div class="row">
			<h3>All Deal Products</h3>
			<div class="content__box content__box--shadow">
				<table class="table table-hover table-striped" id="dealProductTable">
					<thead>
						<tr>
							<th>SN</th>
							<th>Name</th>
							{{-- <th>Priority</th> --}}
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<th>SN</th>
							<th>Name</th>
							{{-- <th>Priority</th> --}}
							<th>Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</section>
</div>
@endsection

@push('scripts')
	<script>
		$(document).ready(function() {
			$('#dealProductAddTable').DataTable({
				// processing: true,
				// serverSide: true,
				// columns: [
				// 	{ 
	   //             	"data": "id",
	   //                 render: function (data, type, row, meta) {
	   //                    return meta.row + meta.settings._iDisplayStart + 1;
	   //                }
	   //            	},
				// 	{data: 'name', name: 'name'},
				// 	// {
				// 	// 	data: 'id',
				// 	// 	orderable: false,
				// 	// 	render: function (data, type, row) {
				// 	// 		var actions = '';
				// 	// 		// actions += "<form action='' method='post'>";
				// 	// 		actions += "<input type='number' name='priority' min='0' id='priority'>";
				// 	// 		// actions += "</form>";

				// 	// 		return actions;
				// 	// 	}
				// 	// },
				// 	{
				// 		data: 'id',
	   //                     orderable: false,
	   //                     render: function (data, type, row) {

	   //                         var actions = '';
	   //                         actions += "<button href='javascript:void(0);' class='btn btn-default btn-xs add-to-deal' data-id='"+ row.id +" '>Add To Deal</button>";

	   //                         return actions;
	   //                     }
				// 	}
				// ],
				// ajax: '{{ route('admin.deals.deal-product-add.json') }}'
			});
		});
	</script>
	<script>
    	$('.category, .vendor').change(function () {
            $(this).closest('form').submit();
        });
        
		$(document).ready(function() {
            var deal_id = $('.deal_id').val();
			$('#dealProductTable').DataTable({
				processing: true,
				serverSide: true,
				columns: [
					{ 
	                	"data": "id",
	                    render: function (data, type, row, meta) {
	                       return meta.row + meta.settings._iDisplayStart + 1;
	                   }
	               	},
					{data: 'name', name: 'name'},
					// {data: 'priority', name: 'priority'},
					{
						data: 'id',
	                        orderable: false,
	                        render: function (data, type, row) {

	                            var actions = '';
	                            actions += "<button href='javascript:void(0);' class='btn btn-default btn-xs remove-deal-product' data-id='"+ row.id +" '>&times;</button>";

	                            return actions;
	                        }
					}
				],
				ajax: '/admin/deal-product/json/' + deal_id 						
			});
		});
	</script>
	<script>
		$(document).on('click', '.add-to-deal', function(e) {
			e.preventDefault();
            var product_id = $(this).attr('data-id');
            var deal_id = $('.deal_id').val();
            // var id = $(this).attr('value');
            // console.log(id);
            // var priority = document.getElementById('id');
            // console.log(priority.value);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('admin.deal-product.store')  }}",
                // contentType: false,
                // processData: false,
                // cache: false,
                data: {
                	product_id: product_id , 
                	deal_id: deal_id
                	// priority: priority
                },

                beforeSend: function (data) {
                },
                success: function (data) {
                    $('.alert-message.alert-danger').fadeOut();
                    var message = '<div><span><strong><i class="fa fa-thumbs-o-up"></i>Success!</strong> ';
                    message += data.message;
                	$('.alert-message.alert-success').html(message).fadeIn().delay(5000).fadeOut('slow');
            	    if (($('.alert-message').offset().top - 80) < $(window).scrollTop()) {
				        $('html, body').animate({
				            scrollTop: $('.alert-message').offset().top - 80
				        }, 1000);
				    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  	var errorsHolder = '';
	                errorsHolder += '<ul>';
	                var err = eval("(" + xhr.responseText + ")");
	                $.each(err.errors, function (key, value) {
	                    errorsHolder += '<li>' + value + '</li>';
	                });
	                errorsHolder += '</ul>';
	                $('.alert-message.alert-danger').fadeIn().html(errorsHolder);  
	                if (($('.alert-message').offset().top - 80) < $(window).scrollTop()) {
				        $('html, body').animate({
				            scrollTop: $('.alert-message').offset().top - 80
				        }, 1000);
				    }  
                },
                complete: function () {
                	$('#dealProductTable').DataTable().ajax.reload();
                }
            });
		});
	</script>
	<script>
		$(document).on("click", ".remove-deal-product", function (e) {
        e.preventDefault();
       	if (!confirm('Are you sure you want to delete?')) {
            return false;
        }
     	var $this = $(this);
       
        var id = $this.attr('data-id');
     	var tempDeleteUrl = "{{ route('admin.deal-product.delete', ':id') }}";
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
                $('.alert-message.alert-danger').fadeOut();
                var message = '<div><span><strong><i class="fa fa-thumbs-o-up"></i>Success!</strong> ';
                message += data.message;
            	$('.alert-message.alert-success').html(message).fadeIn().delay(5000).fadeOut('slow');
        	    if (($('.alert-message').offset().top - 80) < $(window).scrollTop()) {
			        $('html, body').animate({
			            scrollTop: $('.alert-message').offset().top - 80
			        }, 1000);
			    }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorsHolder = '';
	                errorsHolder += '<ul>';
	                var err = eval("(" + xhr.responseText + ")");
	                $.each(err.errors, function (key, value) {
	                    errorsHolder += '<li>' + value + '</li>';
	                });
	                errorsHolder += '</ul>';
	                $('.alert-message.alert-danger').fadeIn().html(errorsHolder);  
	                if (($('.alert-message').offset().top - 80) < $(window).scrollTop()) {
				        $('html, body').animate({
				            scrollTop: $('.alert-message').offset().top - 80
				        }, 1000);
				    } 
            },
            complete: function () {
            	$('#dealProductTable').DataTable().ajax.reload();
            }
        });
    });
	</script>
@endpush