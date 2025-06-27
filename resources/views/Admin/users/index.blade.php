<?php
$page = 'users';
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
    <h4 class="fw-bold py-3 mb-4">User Management</h4>

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
      <h5 class="card-header">User List
        <a type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal" style="float:right; color:white;">
          Create User
        </a>
      </h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-striped" id="myTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Updated</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ ucfirst($user->role) }}</td>
              <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a href="#" class="dropdown-item edit-btn" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-role="{{ $user->role }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <a href="#" class="dropdown-item text-danger delete-btn" data-id="{{ $user->id }}">
                      <i class="bx bx-trash me-1"></i> Delete
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

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="createUserForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="name" class="form-control mb-2" placeholder="Full Name" required>
          <input type="email" name="email" class="form-control mb-2" placeholder="Email Address" required>
          <select name="role" class="form-control" required>
            <option value="">-- Select Role --</option>
            <option value="admin">Admin</option>
            <option value="organizer">Organizer</option>
            <option value="participant">Participant</option>
          </select>
          <small class="text-muted">Default password will be <strong>P@ssw0rd</strong></small>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editUserForm">
      @csrf
      <input type="hidden" name="user_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="name" class="form-control mb-2" required>
          <input type="email" name="email" class="form-control mb-2" required>
          <select name="role" class="form-control" required>
            <option value="admin">Admin</option>
            <option value="organizer">Organizer</option>
            <option value="participant">Participant</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Update</button>
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

  $('#createUserForm').on('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    $.ajax({
      url: "{{ route('users.store') }}",
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function () {
        $('#createUserModal').modal('hide');
        location.reload();
      },
      error: function () {
        alert("Creation failed.");
      }
    });
  });

  $('.edit-btn').on('click', function () {
    const modal = $('#editUserModal');
    modal.find('input[name=user_id]').val($(this).data('id'));
    modal.find('input[name=name]').val($(this).data('name'));
    modal.find('input[name=email]').val($(this).data('email'));
    modal.find('select[name=role]').val($(this).data('role'));
    modal.modal('show');
  });

  $('#editUserForm').on('submit', function (e) {
    e.preventDefault();
    const id = $('input[name=user_id]').val();
    const formData = new FormData(this);
    $.ajax({
      url: `/users/${id}/update`,
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function () {
        $('#editUserModal').modal('hide');
        location.reload();
      },
      error: function () {
        alert("Update failed.");
      }
    });
  });

  $('.delete-btn').on('click', function () {
    if (!confirm('Are you sure to delete this user?')) return;
    const id = $(this).data('id');
    $.ajax({
      url: `/users/${id}`,
      method: 'DELETE',
      data: {
        _token: "{{ csrf_token() }}"
      },
      success: function () {
        location.reload();
      },
      error: function () {
        alert("Delete failed.");
      }
    });
  });
});
</script>