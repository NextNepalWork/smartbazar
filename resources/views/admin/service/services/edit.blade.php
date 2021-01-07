


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
      <h3>Add New Services</h3>
      <div class="col-md-12">
        <form action="{{ route('admin.services.update')  }}" enctype="multipart/form-data" id="serviceCategory" method="post">
          {{csrf_field()}}
          <input type="hidden" name="id" value="{{ $service->id }}">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ $service->name }}" required>
          </div>
          <div class="row">
            <div class="col-md-4">

              <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
                @if($service->getImage())
                  <img src="{{$service->getImage()->smallUrl}}" alt="Image" style="width:50%;height:auto;">
                @endif
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                  @if($service->status == 1)
                  <option value="1" selected>Approved</option>
                    <option value="0" >Unapproved</option>
                  @else
                  <option value="0" selected>Unapproved</option>
                    <option value="1" >Approved</option>
                    @endif
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="status">Parent Service</label>
                <select name="parent_id" class="form-control">
                  <option value="0">Select Parent</option>
                  @foreach($serviceCategory as $sc)
                    <option value="{{ $sc->id }}" @if($service->parent_id == $sc->id) selected @endif>{{ $sc->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="title">Service Description</div>
            <textarea class="longdescrip" name="description">
              {{ $service->description }}
            </textarea>
          </div>
          <div class="row">
            <div class="col-md-6">

              <div class="form-group">
                <label for="name">Aviliable Location</label>
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-bordered table-locations">
                      <thead>
                      <tr>
                        <th>SN</th>
                        <th>Location</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @if(isset($service->locations))
                        @foreach($service->locations as $location)
                          <tr data-row="{{ $loop->iteration }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                              <div class="form-group">
                                <input type="text"
                                       name="locations[location][{{ $location->id }}]"
                                       value="{{ $location->location }}"
                                       class="form-control" required>
                              </div>
                            </td>
                            <td>
                              <button type="button"
                                      class="btn btn-danger btn-xs btn-delete-location"
                                      data-location="{{ $location->id }}"><i
                                        class="fa fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                        @endforeach
                      @endif
                      </tbody>
                      <tfoot>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>
                          <button class="btn btn-danger btn-sm btn-add-location">Add New</button>
                        </th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">

              <div class="form-group">
                <label for="name">Service Required Time</label>
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-bordered table-times">
                      <thead>
                      <tr>
                        <th>SN</th>
                        <th>Time Preoid</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      @if(isset($service->times))
                        @foreach($service->times as $time)
                          <tr data-row="{{ $loop->iteration }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                              <div class="form-group">
                                <input type="text"
                                       name="times[time][{{ $time->id }}]"
                                       value="{{ $time->time }}"
                                       class="form-control" required>
                              </div>
                            </td>
                            <td>
                              <button type="button"
                                      class="btn btn-danger btn-xs btn-delete-time"
                                      data-time="{{ $time->id }}"><i
                                        class="fa fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                        @endforeach
                      @endif
                      </tbody>
                      <tfoot>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>
                          <button class="btn btn-danger btn-sm btn-add-time">Add New</button>
                        </th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" name="submit">Update Service</button>
        </form>
      </div>
    </div>
  </section>

@endsection

@push('scripts')


<script>
    function generateRandomInteger() {
        return Math.floor(Math.random() * 90000) + 10000;
    }

    jQuery(document).on('click', '.btn-delete-location', function (e) {
        e.preventDefault();

        var $this = $(this);

        var location = $this.attr('data-location');

        if (!location) {
            $this.closest("tr").remove();
            return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('admin.service.location.delete')  }}",
            data: {
                location: location
            },
            beforeSend: function () {
                $this.prop('disabled', true);
            },
            success: function (data) {
                $this.closest("tr").remove();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //
            },
            complete: function () {
                $this.prop('disabled', false);
            }
        });
    });
    jQuery(document).on('click', '.btn-add-location', function (e) {
        e.preventDefault();
        console.log('tgd');
        var lastRow = $('table.table-locations > tbody > tr').last().attr('data-row');
        var counter = lastRow ? parseInt(lastRow) + 1 : 1;
        var randomInteger = generateRandomInteger();
        var newRow = jQuery('<tr data-row="' + counter + '">' +
            '<td>' + counter + '</td>' +
            '<td><input type="text" name="locations[location][' + randomInteger + ']" class="form-control" required/></td>'  +
            '<td><button type="button" class="btn btn-danger btn-xs btn-delete-location" data-feature=""><i class="fa fa-trash"></i></button></td>' +
            '</tr>');
        jQuery('table.table-locations').append(newRow);
    });






    jQuery(document).on('click', '.btn-delete-time', function (e) {
        e.preventDefault();

        var $this = $(this);

        var time = $this.attr('data-time');

        if (!time) {
            $this.closest("tr").remove();
            return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('admin.service.time.delete')  }}",
            data: {
                time: time
            },
            beforeSend: function () {
                $this.prop('disabled', true);
            },
            success: function (data) {
                $this.closest("tr").remove();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //
            },
            complete: function () {
                $this.prop('disabled', false);
            }
        });
    });



    jQuery(document).on('click', '.btn-add-time', function (e) {
        e.preventDefault();
        console.log('tgd');
        var lastRow = $('table.table-times > tbody > tr').last().attr('data-row');
        var counter = lastRow ? parseInt(lastRow) + 1 : 1;
        var randomInteger = generateRandomInteger();
        var newRow = jQuery('<tr data-row="' + counter + '">' +
            '<td>' + counter + '</td>' +
            '<td><input type="text" name="times[time][' + randomInteger + ']" class="form-control" required/></td>'  +
            '<td><button type="button" class="btn btn-danger btn-xs btn-delete-time" data-feature=""><i class="fa fa-trash"></i></button></td>' +
            '</tr>');
        jQuery('table.table-times').append(newRow);
    });
</script>

@endpush