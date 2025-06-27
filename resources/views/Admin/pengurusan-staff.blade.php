<?php $page = 'staff'; ?>
@include('include.appadmin')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

<style>
#myTable_wrapper {
  padding: 20px !important;
  min-height: 500px;
}

/* Status badges */
.status-badge {
  padding: 5px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 500;
}

.status-available {
  background-color: #d1fae5;
  color: #065f46;
}

.status-occupied {
  background-color: #fee2e2;
  color: #b91c1c;
}

.status-maintenance {
  background-color: #fef3c7;
  color: #92400e;
}

/* Modal styles */
.modal-body {
  max-height: 70vh;
  overflow-y: auto;
  padding: 20px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .table-responsive {
    overflow-x: auto;
  }
}
</style>
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Pengurusan Staff</h4>

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Ralat!</strong> {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berjaya!</strong> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
      <h5 class="card-header">Senarai Staff
        <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal" data-bs-target="#createStaffModal" style="float:right;">
          <i class="bx bx-plus me-1"></i> Tambah Staff
        </button>
      </h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-striped" id="staffTable">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Nama Penuh</th>
              <th>Email</th>
              <th>Telefon</th>
              <th>Status</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($staffs as $key => $staff)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $staff->name }}</td>
              <td>{{ $staff->fullname }}</td>
              <td>{{ $staff->email }}</td>
              <td>{{ $staff->phone }}</td>
              <td>
                @if($staff->status == 'A')
                  <span class="badge bg-success">Aktif</span>
                @else
                  <span class="badge bg-danger">Tidak Aktif</span>
                @endif
              </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a href="#" class="dropdown-item edit-btn"
                      data-id="{{ $staff->id }}"
                      data-name="{{ $staff->name }}"
                      data-fullname="{{ $staff->fullname }}"
                      data-email="{{ $staff->email }}"
                      data-phone="{{ $staff->phone }}"
                      data-status="{{ $staff->status }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <a href="#" class="dropdown-item text-danger delete-btn" data-id="{{ $staff->id }}">
                      <i class="bx bx-trash me-1"></i> Padam
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

<!-- Create Staff Modal -->
<div class="modal fade" id="createStaffModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="createStaffForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Staff Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama*</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Nama Penuh*</label>
            <input type="text" name="fullname" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Email*</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Telefon*</label>
            <input type="text" name="phone" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Kata Laluan*</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Sahkan Kata Laluan*</label>
            <input type="password" name="password_confirmation" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Status*</label>
            <select name="status" class="form-select" required>
              <option value="A">Aktif</option>
              <option value="I">Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Staff Modal -->
<div class="modal fade" id="editStaffModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editStaffForm">
      @csrf
      @method('PUT')
      <input type="hidden" name="staff_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Kemaskini Staff</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama*</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Nama Penuh*</label>
            <input type="text" name="fullname" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Email*</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Telefon*</label>
            <input type="text" name="phone" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Kata Laluan (Biarkan kosong jika tidak mahu tukar)</label>
            <input type="password" name="password" class="form-control">
          </div>
          
          <div class="mb-3">
            <label class="form-label">Sahkan Kata Laluan</label>
            <input type="password" name="password_confirmation" class="form-control">
          </div>
          
          <div class="mb-3">
            <label class="form-label">Status*</label>
            <select name="status" class="form-select" required>
              <option value="A">Aktif</option>
              <option value="I">Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Kemaskini</button>
        </div>
      </div>
    </form>
  </div>
</div>
@include('include.footer')
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

<script>
$(document).ready(function() {
  // Initialize DataTable
  $('#staffTable').DataTable({
  });
  
  // Handle create form submission
  $('#createStaffForm').on('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = $(this).find('button[type="submit"]');
    submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Menyimpan...');
    
    $.ajax({
      url: "{{ route('staff.store') }}",
      method: "POST",
      data: $(this).serialize(),
      success: function(response) {
        if (response.success) {
          $('#createStaffModal').modal('hide');
          alert(response.message);
          location.reload();
        }
      },
      error: function(xhr) {
        submitBtn.prop('disabled', false).text('Simpan');
        alert(xhr.responseJSON.message || 'Ralat berlaku semasa menambah staff.');
      }
    });
  });

  // Handle edit button click
  $(document).on('click', '.edit-btn', function() {
    const modal = $('#editStaffModal');
    modal.modal("show");

    modal.find('input[name=staff_id]').val($(this).data('id'));
    modal.find('input[name=name]').val($(this).data('name'));
    modal.find('input[name=fullname]').val($(this).data('fullname'));
    modal.find('input[name=email]').val($(this).data('email'));
    modal.find('input[name=phone]').val($(this).data('phone'));
    modal.find('select[name=status]').val($(this).data('status'));
  });

  // Handle edit form submission
  $('#editStaffForm').on('submit', function(e) {
    e.preventDefault();
    
    const id = $('input[name=staff_id]').val();
    const submitBtn = $(this).find('button[type="submit"]');
    submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Mengemaskini...');
    
    $.ajax({
      url: `/staff/${id}`,
      method: "POST",
      data: $(this).serialize() + '&_method=PUT',
      success: function(response) {
        if (response.success) {
          $('#editStaffModal').modal('hide');
          alert(response.message);
          location.reload();
        }
      },
      error: function(xhr) {
        submitBtn.prop('disabled', false).text('Kemaskini');
        alert(xhr.responseJSON.message || 'Ralat berlaku semasa mengemaskini staff.');
      }
    });
  });

  // Handle delete button click
  $('.delete-btn').on('click', function() {
    if (!confirm('Adakah anda pasti mahu memadam staff ini?')) return;
    const id = $(this).data('id');
    
    $.ajax({
      url: `/staff/${id}`,
      method: "POST",
      data: {
        _token: "{{ csrf_token() }}",
        _method: "DELETE"
      },
      success: function(response) {
        if (response.success) {
          alert(response.message);
          location.reload();
        }
      },
      error: function() {
        alert("Gagal memadam staff. Sila cuba lagi.");
      }
    });
  });
});
</script>
