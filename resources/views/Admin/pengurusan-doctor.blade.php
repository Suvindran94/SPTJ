<?php $page = 'doctor'; ?>
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
    <h4 class="fw-bold py-3 mb-4">Pengurusan Doctor</h4>

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
      <h5 class="card-header">Senarai Doctor
        <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal" data-bs-target="#createDoctorModal" style="float:right;">
          <i class="bx bx-plus me-1"></i> Tambah Doctor
        </button>
      </h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-striped" id="doctorTable">
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
            @foreach($doctors as $key => $doc)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $doc->name }}</td>
              <td>{{ $doc->fullname }}</td>
              <td>{{ $doc->email }}</td>
              <td>{{ $doc->phone }}</td>
              <td>
                @if($doc->status == 'A')
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
                      data-id="{{ $doc->id }}"
                      data-name="{{ $doc->name }}"
                      data-fullname="{{ $doc->fullname }}"
                      data-email="{{ $doc->email }}"
                      data-phone="{{ $doc->phone }}"
                      data-status="{{ $doc->status }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <a href="#" class="dropdown-item text-danger delete-btn" data-id="{{ $doc->id }}">
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

<!-- Create Doctor Modal -->
<div class="modal fade" id="createDoctorModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="createDoctorForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Doktor Baru</h5>
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

<!-- Edit Doctor Modal -->
<div class="modal fade" id="editDoctorModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editDoctorForm">
      @csrf
      @method('PUT')
      <input type="hidden" name="doctor_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Kemaskini Doktor</h5>
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
  $('#doctorTable').DataTable({
  });
  
  $('#createDoctorForm').on('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = $(this).find('button[type="submit"]');
    submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Menyimpan...');
    
    $.ajax({
      url: "{{ route('doctor.store') }}",
      method: "POST",
      data: $(this).serialize(),
      success: function(response) {
        if (response.success) {
          $('#createDoctorModal').modal('hide');
          alert(response.message);
          location.reload();
        }
      },
      error: function(xhr) {
        submitBtn.prop('disabled', false).text('Simpan');
        alert(xhr.responseJSON.message || 'Ralat berlaku semasa menambah doktor.');
      }
    });
  });

  $(document).on('click', '.edit-btn', function() {
    const modal = $('#editDoctorModal');
    modal.modal("show");

    modal.find('input[name=doctor_id]').val($(this).data('id'));
    modal.find('input[name=name]').val($(this).data('name'));
    modal.find('input[name=fullname]').val($(this).data('fullname'));
    modal.find('input[name=email]').val($(this).data('email'));
    modal.find('input[name=phone]').val($(this).data('phone'));
    modal.find('select[name=status]').val($(this).data('status'));
  });

  $('#editDoctorForm').on('submit', function(e) {
    e.preventDefault();

    const id = $('input[name=doctor_id]').val();
    const submitBtn = $(this).find('button[type="submit"]');
    submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Mengemaskini...');
    
    $.ajax({
      url: `/doctor/${id}`,
      method: "POST",
      data: $(this).serialize() + '&_method=PUT',
      success: function(response) {
        if (response.success) {
          $('#editDoctorModal').modal('hide');
          alert(response.message);
          location.reload();
        }
      },
      error: function(xhr) {
        submitBtn.prop('disabled', false).text('Kemaskini');
        alert(xhr.responseJSON.message || 'Ralat berlaku semasa mengemaskini doktor.');
      }
    });
  });

  $('.delete-btn').on('click', function() {
    if (!confirm('Adakah anda pasti mahu memadam doktor ini?')) return;
    const id = $(this).data('id');
    
    $.ajax({
      url: `/doctor/${id}`,
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
        alert("Gagal memadam doktor. Sila cuba lagi.");
      }
    });
  });
});
</script>
