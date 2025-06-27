<?php $page = 'logs'; ?>
@include('include.appadmin')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

<style>
#loginLogsTable_wrapper {
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

.status-login {
  background-color: #d1fae5;
  color: #065f46;
}

.status-logout {
  background-color: #dbeafe;
  color: #1e40af;
}

.status-failed {
  background-color: #fee2e2;
  color: #b91c1c;
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
  
  .filter-container {
    flex-direction: column;
    gap: 10px;
  }
  
  .filter-container .btn {
    width: 100%;
  }
}
</style>

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Pengurusan Log Masuk</h4>

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
      <h5 class="card-header">Senarai Log Masuk
        <div class="filter-container d-flex" style="float:right; gap:10px;">
          <select id="eventFilter" class="form-select" style="width: 150px;">
            <option value="">Semua Event</option>
            <option value="login">Log Masuk</option>
            <option value="logout">Log Keluar</option>
            <option value="failed">Gagal</option>
          </select>
          <input type="date" id="dateFromFilter" class="form-control" style="width: 150px;">
          <input type="date" id="dateToFilter" class="form-control" style="width: 150px;">
          <button id="filterBtn" class="btn btn-primary">Filter</button>
          <button id="resetFilterBtn" class="btn btn-outline-secondary">Reset</button>
        </div>
      </h5>
      <div class="table-responsive text-nowrap">
        <table class="table table-striped" id="loginLogsTable">
          <thead>
            <tr>
              <th>#</th>
              <th>Pengguna</th>
              <th>Email</th>
              <th>Event</th>
              <th>IP Address</th>
              <th>Peranti</th>
              <th>Masa</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($loginLogs as $key => $log)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $log->user ? $log->user->name : 'N/A' }}</td>
              <td>{{ $log->email }}</td>
       <td>
  <span class="status-badge 
    @if($log->event == 'login') status-login
    @elseif($log->event == 'logout') status-logout
    @else status-failed @endif">
    @if($log->event == 'login')
      Log Masuk
    @elseif($log->event == 'logout')
      Log Keluar
    @else
      Gagal
    @endif
  </span>
</td>
              <td>{{ $log->ip_address }}</td>
              <td>
                @if(strpos($log->user_agent, 'Mobile') !== false)
                  Mobile
                @else
                  Desktop
                @endif
              </td>
              <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i') }}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a href="#" class="dropdown-item view-btn"
                      data-id="{{ $log->id }}"
                      data-user="{{ $log->user ? $log->user->name : 'N/A' }}"
                      data-email="{{ $log->email }}"
                      data-event="{{ $log->event }}"
                      data-ip="{{ $log->ip_address }}"
                      data-useragent="{{ $log->user_agent }}"
                      data-time="{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i:s') }}">
                      <i class="bx bx-show me-1"></i> Lihat
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

<div class="modal fade" id="viewLogModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Butiran Log Masuk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label">Pengguna:</label>
              <input type="text" class="form-control" id="viewUser" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label">Email:</label>
              <input type="text" class="form-control" id="viewEmail" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label">Event:</label>
              <input type="text" class="form-control" id="viewEvent" readonly>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="form-label">IP Address:</label>
              <input type="text" class="form-control" id="viewIp" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label">Masa:</label>
              <input type="text" class="form-control" id="viewTime" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label">User Agent:</label>
              <textarea class="form-control" id="viewUserAgent" rows="3" readonly></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

@include('include.footer')
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

<script>
$(document).ready(function() {
  const table = $('#loginLogsTable').DataTable({
    language: {
      url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/ms.json'
    }
  });
  
  $('#filterBtn').on('click', function() {
    let eventFilter = $('#eventFilter').val();
    let dateFrom = $('#dateFromFilter').val();
    let dateTo = $('#dateToFilter').val();
    
    table.column(3).search(eventFilter).draw();
    
    if (dateFrom || dateTo) {
      table.draw();
    }
  });
  
  $('#resetFilterBtn').on('click', function() {
    $('#eventFilter').val('');
    $('#dateFromFilter').val('');
    $('#dateToFilter').val('');
    table.search('').columns().search('').draw();
  });
  
  $(document).on('click', '.view-btn', function() {
    const modal = $('#viewLogModal');
    modal.modal("show");
    
    modal.find('#viewUser').val($(this).data('user'));
    modal.find('#viewEmail').val($(this).data('email'));
    modal.find('#viewEvent').val($(this).data('event'));
    modal.find('#viewIp').val($(this).data('ip'));
    modal.find('#viewUserAgent').val($(this).data('useragent'));
    modal.find('#viewTime').val($(this).data('time'));
  });

  $.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
      let dateFrom = $('#dateFromFilter').val();
      let dateTo = $('#dateToFilter').val();
      let rowDate = new Date(data[6]);
      
      if (!dateFrom && !dateTo) {
        return true;
      }
      
      if (dateFrom && !dateTo) {
        return rowDate >= new Date(dateFrom);
      }
      
      if (!dateFrom && dateTo) {
        return rowDate <= new Date(dateTo);
      }
      
      return rowDate >= new Date(dateFrom) && rowDate <= new Date(dateTo);
    }
  );
});
</script>