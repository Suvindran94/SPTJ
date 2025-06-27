<?php
$page = 'locations';
?>
@include('include.appadmin')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

<style>
#myTable_wrapper {
  padding: 20px !important;
  min-height: 500px;
}
</style>

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Event Location Management</h4>

    @if($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Whoops!</strong> {{ session()->get('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> {{ session()->get('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
      <h5 class="card-header">Location List
        <a type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal" data-bs-target="#createLocationModal" style="float:right; color:white;">
          Create Location
        </a>
      </h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-striped" id="myTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Location</th>
              <th>Sub-Locations</th>
              <th>Updated</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($locations as $location)
            <tr>
              <td>{{ $location->el_id }}</td>
              <td>{{ $location->event_location }}</td>
              <td>
                @foreach($location->subLocations as $sub)
                <div class="d-flex justify-content-between">
                  <span>{{ $sub->event_sub_location }}</span>
                  <form method="POST" action="{{ route('sublocations.destroy', $sub->esb_id) }}" onsubmit="return confirm('Delete this sub-location?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger btn-icon ms-2"><i class="bx bx-trash"></i></button>
                  </form>
                </div>
                @endforeach
              </td>
              <td>{{ $location->updated_at ? date('d/m/Y H:i', strtotime($location->updated_at)) : '-' }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a href="#" class="dropdown-item edit-location-btn" data-id="{{ $location->el_id }}" data-name="{{ $location->event_location }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit Location
                    </a>
                    <a href="#" class="dropdown-item text-danger delete-location-btn" data-id="{{ $location->el_id }}">
                      <i class="bx bx-trash me-1"></i> Delete Location
                    </a>
                    <a href="#" class="dropdown-item add-sublocation-btn" data-id="{{ $location->el_id }}">
                      <i class="bx bx-plus-circle me-1"></i> Add Sub-Location
                    </a>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Create Location Modal -->
<div class="modal fade" id="createLocationModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('locations.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Event Location</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="event_location" class="form-control" placeholder="Location Name" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Location Modal -->
<div class="modal fade" id="editLocationModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" id="editLocationForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Location</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="location_id">
          <input type="text" name="event_location" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Add Sub Location Modal -->
<div class="modal fade" id="addSubLocationModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('sublocations.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Sub Location</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="el_id" id="parent_location_id">
          <input type="text" name="event_sub_location" class="form-control" placeholder="Sub Location Name" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add</button>
        </div>
      </div>
    </form>
  </div>
</div>

@include('include.footer')
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script>
$(document).ready(function () {
  $('#myTable').DataTable();

  $('.edit-location-btn').on('click', function () {
    let id = $(this).data('id');
    let name = $(this).data('name');
    $('#editLocationForm').attr('action', `/locations/${id}/update`);
    $('#editLocationForm input[name=location_id]').val(id);
    $('#editLocationForm input[name=event_location]').val(name);
    $('#editLocationModal').modal('show');
  });

  $('.delete-location-btn').on('click', function () {
    if (!confirm('Are you sure to delete this location?')) return;
    let id = $(this).data('id');
    $.ajax({
      url: `/locations/${id}`,
      method: 'DELETE',
      data: {
        _token: '{{ csrf_token() }}'
      },
      success: function () {
        location.reload();
      },
      error: function () {
        alert('Delete failed.');
      }
    });
  });

  $('.add-sublocation-btn').on('click', function () {
    let id = $(this).data('id');
    $('#parent_location_id').val(id);
    $('#addSubLocationModal').modal('show');
  });
});
</script>
