<!DOCTYPE html>
<html lang="ms">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Log Masuk - Sistem Pengurusan Temu Janji Klinik ENT</title>
  <meta name="description" content="Sistem Pengurusan Temu Janji dan Giliran untuk Klinik ENT">
  <meta name="keywords" content="Klinik ENT, Temu Janji, Sistem Giliran">

  <link href="Logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #1977cc;
      --secondary-color: #3291e6;
      --light-color: #f6f9fe;
      --dark-color: #444444;
    }
    
    body {
      font-family: "Poppins", sans-serif;
          background-image: url('htcm.jpg'); 
      background-size: cover;                
      background-position: center;            
      background-repeat: no-repeat;            
      background-attachment: fixed;            
      font-family: Arial, sans-serif;

    }
    
    .login-container {
      max-width: 500px;
      margin: 100px auto;
      padding: 40px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }
    
    .login-header {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .login-header img {
      height: 60px;
      margin-bottom: 15px;
    }
    
    .login-header h2 {
      color: var(--primary-color);
      font-weight: 600;
    }
    
    .form-control {
      height: 50px;
      border-radius: 5px;
      border: 1px solid #ddd;
      padding-left: 15px;
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(25, 119, 204, 0.25);
    }
    
    .input-group-text {
      background-color: white;
      border-left: none;
      cursor: pointer;
    }
    
    .input-group .form-control {
      border-right: none;
    }
    
    .input-group .form-control:focus + .input-group-text {
      border-color: var(--primary-color);
    }
    
    .btn-login {
      background-color: var(--primary-color);
      border: none;
      color: white;
      padding: 12px;
      font-weight: 500;
      width: 100%;
      border-radius: 5px;
      transition: all 0.3s;
    }
    
    .btn-login:hover {
      background-color: var(--secondary-color);
    }
    
    .forgot-password {
      text-align: right;
      margin-top: 10px;
    }
    
    .forgot-password a {
      color: var(--dark-color);
      text-decoration: none;
      font-size: 14px;
    }
    
    .forgot-password a:hover {
      color: var(--primary-color);
    }
    
    .divider {
      display: flex;
      align-items: center;
      margin: 20px 0;
    }
    
    .divider::before, .divider::after {
      content: "";
      flex: 1;
      border-bottom: 1px solid #ddd;
    }
    
    .divider-text {
      padding: 0 10px;
      color: #777;
      font-size: 14px;
    }
    
    .register-link {
      text-align: center;
      margin-top: 20px;
    }
    
    .register-link a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 500;
    }
    
    .register-link a:hover {
      text-decoration: underline;
    }
    
    /* Password toggle eye icon */
    .password-toggle {
      cursor: pointer;
      color: #777;
    }
    
    .password-toggle:hover {
      color: var(--primary-color);
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="login-container" data-aos="fade-up">

            @if($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show small" style="font-size: 12px;" role="alert">
          <strong>Whoops !</strong> {{ session()->get('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show small" style="font-size: 12px;" role="alert">
          <strong>Success!</strong> {{ session()->get('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


      <div class="login-header">
        <a href="/"><img src="Logo.png" alt="Klinik ENT Logo"></a>
        <h2>Log Masuk</h2>
        <p>Sila masukkan maklumat akaun anda</p>
      </div>
      
          <form action="postloginusr" method="POST">
              @csrf
        
        <div class="mb-3">
          <label for="email" class="form-label">Alamat Emel</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan emel anda" required>
        </div>
        
        <div class="mb-3">
          <label for="password" class="form-label">Kata Laluan</label>
          <div class="input-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata laluan" required>
            <span class="input-group-text password-toggle" id="togglePassword">
              <i class="bi bi-eye-slash" id="eyeIcon"></i>
            </span>
          </div>
        </div>
        
        <button type="submit" class="btn btn-login mt-3">Log Masuk</button>
        
      </form>
    </div>
  </div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('bi-eye-slash');
        eyeIcon.classList.add('bi-eye');
      } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('bi-eye');
        eyeIcon.classList.add('bi-eye-slash');
      }
    });
  </script>
</body>

</html>