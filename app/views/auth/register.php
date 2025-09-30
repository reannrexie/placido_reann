<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <!-- Font Awesome for eye icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      min-height: 100vh;
      font-family: "Poppins", sans-serif;
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

    /* Register Card */
    .register-container {
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
      animation: fadeIn 0.8s ease forwards;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .register-container:hover {
      transform: translateY(-5px) scale(1.01);
      box-shadow: 0 35px 70px rgba(0,0,0,0.25);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .register-container h2 {
      font-weight: 700;
      font-size: 2em;
      margin-bottom: 25px;
      color: #0D273D;
      text-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* Error box */
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

    /* Form Groups */
    .form-group {
      position: relative;
      margin-bottom: 18px;
    }
    .form-group input,
    .form-group select {
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
    .form-group input:focus,
    .form-group select:focus {
      border-color: #3E6985;
      box-shadow: 0 0 8px rgba(62,105,133,0.5);
      outline: none;
      transform: scale(1.02);
    }

    /* Toggle Password */
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
      margin-top: 5px;
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

  <div class="register-container">
    <h2>Register</h2>
    
    <?php if (!empty($error)): ?>
      <div class="error-box">
          <?= $error ?>
      </div>
    <?php endif; ?>
    
    <form method="POST" action="<?= site_url('auth/register'); ?>">
      <div class="form-group">
        <input type="text" name="username" placeholder="Username" required>
      </div>

      <div class="form-group">
        <input type="email" name="email" placeholder="Email" required>
      </div>

      <div class="form-group">
        <input type="password" id="password" name="password" placeholder="Password" required>
        <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
      </div>

      <div class="form-group">
        <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required>
        <i class="fa-solid fa-eye toggle-password" id="toggleConfirmPassword"></i>
      </div>

      <div class="form-group">
        <select name="role" required>
          <option value="user" selected>User</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <button type="submit" class="btn-submit">Register</button>
    </form>

    <div class="group">
      Already have an account? <a href="<?= site_url('auth/login'); ?>">Login here</a>
    </div>
  </div>

  <script>
    function toggleVisibility(toggleId, inputId) {
      const toggle = document.getElementById(toggleId);
      const input = document.getElementById(inputId);

      toggle.addEventListener('click', function () {
        const type = input.type === 'password' ? 'text' : 'password';
        input.type = type;

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    }

    toggleVisibility('togglePassword', 'password');
    toggleVisibility('toggleConfirmPassword', 'confirmPassword');
  </script>
</body>
</html>
