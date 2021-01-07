@extends('merchant.layouts.app')
@section('title', 'Ratings')

@section('content')

    <section>

        <div class="row">
            <h3>Ratings</h3>
            <div class="col-md-12 content__box content__box--shadow">
                <table id="myTable" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Star</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Date</th>
                        {{--<th class="sorting-false">Action</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Star</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Date</th>

                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
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
                {data: 'user_name',
                    render: function (data, type, row) {
                        {{--url = "{{ route('vendor.dashboard.index',['brands',':id'] ) }}";--}}
                        //                        url = url.replace(':id', row.id);
                        return '<a href="'+ '#' +'">' + data + '</a>';
                    }
                },
              
                {data: 'stars', name: 'stars'},
                {data: 'review', name: 'review'},
                {
                    data: 'status',
                    render: function (data, type, row) {
                        var updateLink = "{{ url('/admin/review/status') }}" + "/" + row.id;
                        var status = '<a href="javascript:void(0);" class="review-status" data-url="' + updateLink + '" data-status="' + data + '">';
                        status += data === '1' ? '<span class="label label-success">Enabled' : '<span class="label label-danger">Disabled';
                        status +=  '</span></a>';
                        return status;
                    }
                },
                {data: 'created_at', name: 'created_at'},

            ],
            ajax: '{{route('vendor.rating.json')}}'

        });
    });


   
</script>

@endpush