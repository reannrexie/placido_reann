<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Font Awesome for eye icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    /* Global body styling */
    body {
      margin: 0;
      min-height: 100vh;
      font-family: "Poppins", sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      background: linear-gradient(135deg, #CDD7DF, #A6BED1, #8AA7BC);
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      position: relative;
      color: #0D273D;
    }

    /* Floating Blobs */
    .blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.3;
      animation: blob 15s infinite;
    }
    .blob1 { width: 300px; height: 300px; background: #3E6985; top: -50px; left: -50px; }
    .blob2 { width: 400px; height: 400px; background: #0D273D; bottom: -80px; right: -80px; animation-delay: 5s; }
    .blob3 { width: 350px; height: 350px; background: #A6BED1; top: 150px; right: -100px; animation-delay: 10s; }

    @keyframes blob {
      0%, 100% { transform: translate(0px, 0px) scale(1); }
      33% { transform: translate(30px, -50px) scale(1.1); }
      66% { transform: translate(-20px, 20px) scale(0.9); }
    }

    /* Login Card */
    .login-container {
      position: relative;
      z-index: 10;
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(12px);
      border-radius: 2rem;
      padding: 50px 40px;
      width: 100%;
      max-width: 420px;
      box-shadow: 0 25px 50px rgba(0,0,0,0.2);
      text-align: center;
      color: #0D273D;
      animation: fadeIn 0.8s ease forwards;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .login-container:hover {
      transform: translateY(-5px) scale(1.01);
      box-shadow: 0 35px 70px rgba(0,0,0,0.25);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .login-container h2 {
      font-weight: 700;
      font-size: 2em;
      margin-bottom: 25px;
      text-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* Error Message */
    .error-box {
      background: rgba(244, 67, 54, 0.1);
      color: #d32f2f;
      padding: 12px;
      border: 1px solid #e57373;
      border-radius: 12px;
      margin-bottom: 20px;
      font-size: 0.95em;
      text-align: left;
    }

    /* Form Inputs */
    .form-group {
      position: relative;
      margin-bottom: 18px;
    }
    .form-group input {
      width: 100%;
      padding: 14px 45px 14px 16px;
      font-size: 15px;
      border: 1px solid rgba(255,255,255,0.5);
      border-radius: 12px;
      background: rgba(255,255,255,0.6);
      color: #0D273D;
      font-weight: 500;
      transition: 0.3s ease, transform 0.2s;
      box-sizing: border-box;
      backdrop-filter: blur(8px);
    }
    .form-group input::placeholder {
      color: #0D273D80;
      font-weight: 400;
    }
    .form-group input:focus {
      border-color: #3E6985;
      box-shadow: 0 0 8px rgba(62,105,133,0.5);
      outline: none;
      transform: scale(1.02);
    }

    /* Password Toggle */
    .toggle-password {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 1.1em;
      color: #3E6985;
      transition: color 0.2s;
    }
    .toggle-password:hover {
      color: #0D273D;
    }

    /* Submit Button */
    .btn-submit {
      width: 100%;
      padding: 16px;
      border: none;
      border-radius: 14px;
      background: linear-gradient(135deg, #3E6985, #0D273D);
      color: #fff;
      font-size: 1.1em;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s ease, transform 0.2s;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    .btn-submit:hover {
      transform: translateY(-3px) scale(1.02);
      opacity: 0.95;
      box-shadow: 0 12px 25px rgba(0,0,0,0.25);
    }

    /* Links */
    .group {
      margin-top: 18px;
      font-size: 0.95em;
      font-weight: 500;
    }
    .group a {
      color: #3E6985;
      font-weight: 500;
      text-decoration: none;
      transition: 0.2s;
    }
    .group a:hover {
      text-decoration: underline;
      color: #0D273D;
    }
  </style>
</head>
<body>

  <!-- Floating Blobs -->
  <div class="blob blob1"></div>
  <div class="blob blob2"></div>
  <div class="blob blob3"></div>

  <div class="login-container">
    <h2>Login</h2>

    <!-- Error -->
    <?php if (!empty($error)): ?>
      <div class="error-box">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth/login') ?>">
      <div class="form-group">
        <input type="text" placeholder="Username" name="username" required>
      </div>

      <div class="form-group">
        <input type="password" placeholder="Password" name="password" id="password" required>
        <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
      </div>

      <button type="submit" class="btn-submit">Login</button>
    </form>

    <div class="group">
      Don’t have an account? <a href="<?= site_url('auth/register'); ?>">Register here</a>
    </div>
  </div>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    if (togglePassword) {
      togglePassword.addEventListener('click', function () {
        const type = password.type === 'password' ? 'text' : 'password';
        password.type = type;

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    }
  </script>
</body>
</html>
