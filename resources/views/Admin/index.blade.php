<?php $page = 'bilik'; ?>
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
    <h4 class="fw-bold py-3 mb-4">Pengurusan Bilik</h4>

    @if($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Ralat!</strong> {{ session()->get('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berjaya!</strong> {{ session()->get('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
      <h5 class="card-header">Senarai Bilik
        <button type="button" class="btn rounded-pill btn-primary" data-bs-toggle="modal" data-bs-target="#createBilikModal" style="float:right;">
          <i class="bx bx-plus me-1"></i> Tambah Bilik
        </button>
      </h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-striped" id="myTable">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Bilik</th>
              <th>Jenis Rawatan</th>
              <th>Doktor</th>
              <th>Status</th>
              <th>Keterangan</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($biliks as $key => $bilik)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $bilik->nama_bilik }}</td>
              <td>{{ $bilik->jenis_rawatan }}</td>
              <td>{{ $bilik->doktor_id ? $bilik->doctor->name : '-' }}</td>
              <td>
                @if($bilik->status == 'Aktif')
                  <span class="status-badge status-available">Aktif</span>
                @elseif($bilik->status == 'Tidak Aktif')
                  <span class="status-badge status-occupied">Tidak Aktif</span>
                @endif
              </td>
              <td>{{ $bilik->keterangan ?? '-' }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a href="#" class="dropdown-item edit-btn"
                      data-id="{{ $bilik->id }}"
                      data-nama="{{ $bilik->nama_bilik }}"
                      data-jenis="{{ $bilik->jenis_rawatan }}"
                      data-doktor="{{ $bilik->doktor_id }}"
                      data-status="{{ $bilik->status }}"
                      data-keterangan="{{ $bilik->keterangan }}">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <a href="#" class="dropdown-item text-danger delete-btn" data-id="{{ $bilik->id }}">
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

<!-- Create Bilik Modal -->
<div class="modal fade" id="createBilikModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="createBilikForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Bilik Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Bilik</label>
            <input type="text" name="nama_bilik" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Jenis Rawatan</label>
            <input type="text" name="jenis_rawatan" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Doktor Bertugas</label>
            <select name="doktor_id" class="form-select">
              <option value="">-- Pilih Doktor --</option>
              @foreach($doctors as $doctor)
              <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
              @endforeach
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
       <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Keterangan (Optional)</label>
            <textarea name="keterangan" class="form-control" rows="3"></textarea>
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

<!-- Edit Bilik Modal -->
<div class="modal fade" id="editBilikModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editBilikForm">
      @csrf
      <input type="hidden" name="bilik_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Kemaskini Bilik</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Bilik</label>
            <input type="text" name="nama_bilik" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Jenis Rawatan</label>
            <input type="text" name="jenis_rawatan" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Doktor Bertugas</label>
            <select name="doktor_id" class="form-select">
              <option value="">-- Pilih Doktor --</option>
              @foreach($doctors as $doctor)
              <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
              @endforeach
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
              <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Keterangan (Optional)</label>
            <textarea name="keterangan" class="form-control" rows="3"></textarea>
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
  $('#myTable').DataTable({
  });
  
  $('#createBilikForm').on('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = $(this).find('button[type="submit"]');
    submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Menyimpan...');
    
    $.ajax({
      url: "{{ route('bilik.store') }}",
      method: "POST",
      data: $(this).serialize(),
      success: function(response) {
        if (response.success) {
          $('#createBilikModal').modal('hide');
          alert('Bilik berjaya ditambah!');
          location.reload();
        }
      },
      error: function(xhr) {
        submitBtn.prop('disabled', false).text('Simpan');
        alert(xhr.responseJSON.message || 'Ralat berlaku semasa menambah bilik.');
      }
    });
  });

  $(document).on('click', '.edit-btn', function() {
    const modal = $('#editBilikModal');
    modal.modal("show");

    modal.find('input[name=bilik_id]').val($(this).data('id'));
    modal.find('input[name=nama_bilik]').val($(this).data('nama'));
    modal.find('input[name=jenis_rawatan]').val($(this).data('jenis'));
    modal.find('select[name=doktor_id]').val($(this).data('doktor'));
    modal.find('select[name=status]').val($(this).data('status'));
    modal.find('textarea[name=keterangan]').val($(this).data('keterangan'));
  });

    $('#editBilikForm').on('submit', function(e) {
    e.preventDefault();
    
    const id = $('input[name=bilik_id]').val();
    const submitBtn = $(this).find('button[type="submit"]');
    submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status"></span> Mengemaskini...');
    
    $.ajax({
      url: `/bilik/${id}`,
      method: "POST",
      data: $(this).serialize() + '&_method=PUT',
      success: function(response) {
        if (response.success) {
          $('#editBilikModal').modal('hide');
          alert(response.message);
          location.reload();
        }
      },
      error: function(xhr) {
        submitBtn.prop('disabled', false).text('Kemaskini');
        alert(xhr.responseJSON.message || 'Ralat berlaku semasa mengemaskini bilik.');
      }
    });
  });

  $('.delete-btn').on('click', function() {
    if (!confirm('Adakah anda pasti mahu memadam bilik ini?')) return;
    const id = $(this).data('id');
    
    $.ajax({
      url: `/bilik/${id}`,
      method: "DELETE",
      data: {
        _token: "{{ csrf_token() }}"
      },
      success: function() {
        alert('Bilik berjaya dipadam!');
        location.reload();
      },
      error: function() {
        alert("Gagal memadam bilik. Sila cuba lagi.");
      }
    });
  });
});
</script>