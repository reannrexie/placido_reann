<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-[#CDD7DF] via-[#A6BED1] to-[#8AA7BC]">

  <!-- Floating Background Blobs -->
  <div class="absolute top-20 left-10 w-72 h-72 bg-[#3E6985] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
  <div class="absolute top-60 right-20 w-80 h-80 bg-[#0D273D] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
  <div class="absolute bottom-20 left-1/3 w-96 h-96 bg-[#A6BED1] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

  <!-- Card Container -->
  <div class="relative backdrop-blur-xl bg-white/20 border border-white/30 p-8 rounded-3xl shadow-2xl w-full max-w-md animate-fadeIn">
    
    <!-- Title -->
    <h1 class="text-4xl font-extrabold text-center text-[#0D273D] mb-6 drop-shadow-lg tracking-wide">✏️ Update User</h1>

    <!-- Form -->
    <form action="<?= site_url('users/update/'.$user['id']); ?>" method="POST" class="space-y-5">
      
      <!-- Username -->
      <div>
        <label for="username" class="block text-sm font-semibold text-[#0D273D]/90">Username</label>
        <input type="text" id="username" name="username"
          value="<?= html_escape($user['username']); ?>"
          required
          class="mt-2 block w-full px-4 py-3 rounded-xl bg-white/70 border border-[#8AA7BC] text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-[#3E6985] focus:border-[#3E6985] shadow-md">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-semibold text-[#0D273D]/90">Email</label>
        <input type="email" id="email" name="email"
          value="<?= html_escape($user['email']); ?>"
          required
          class="mt-2 block w-full px-4 py-3 rounded-xl bg-white/70 border border-[#8AA7BC] text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-[#0D273D] focus:border-[#0D273D] shadow-md">
      </div>

      <!-- Role (Admin Only) -->
      <?php if(!empty($logged_in_user) && $logged_in_user['role'] === 'admin'): ?>
      <div>
        <label for="role" class="block text-sm font-semibold text-[#0D273D]/90">Role</label>
        <select id="role" name="role"
          class="mt-2 block w-full px-4 py-3 rounded-xl bg-white/70 border border-[#8AA7BC] text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-[#3E6985] focus:border-[#3E6985] shadow-md">
          <option value="user" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
          <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select>
      </div>

      <!-- Password -->
      <div class="relative">
        <label for="password" class="block text-sm font-semibold text-[#0D273D]/90">New Password</label>
        <input type="password" id="password" name="password"
          placeholder="Leave blank if unchanged"
          class="mt-2 block w-full px-4 py-3 rounded-xl bg-white/70 border border-[#8AA7BC] text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-[#3E6985] focus:border-[#3E6985] shadow-md">
        <i class="fa-solid fa-eye absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer text-[#3E6985]" id="togglePassword"></i>
      </div>
      <?php endif; ?>

      <!-- Action Buttons -->
      <div class="flex space-x-3 pt-2">
        <button type="submit"
          class="flex-1 bg-gradient-to-r from-[#3E6985] to-[#0D273D] text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:scale-105 hover:shadow-[0_0_20px_#3E6985] transition duration-300">
          ✅ Update
        </button>

        <a href="<?= site_url('users'); ?>"
          class="flex-1 text-center bg-white/50 text-[#0D273D] font-semibold py-3 px-4 rounded-xl shadow hover:bg-white/70 hover:scale-105 transition duration-300">
          ❌ Cancel
        </a>
      </div>
    </form>
  </div>

  <!-- Animations -->
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes blob {
      0%, 100% { transform: translate(0px,0px) scale(1); }
      33% { transform: translate(30px,-50px) scale(1.1); }
      66% { transform: translate(-20px,20px) scale(0.9); }
    }
    .animate-fadeIn { animation: fadeIn 0.8s ease-out forwards; }
    .animate-blob { animation: blob 10s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
  </style>

  <!-- Toggle Password Script -->
  <script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    if(togglePassword){
      togglePassword.addEventListener('click', () => {
        password.type = password.type === 'password' ? 'text' : 'password';
        togglePassword.classList.toggle('fa-eye');
        togglePassword.classList.toggle('fa-eye-slash');
      });
    }
  </script>

</body>
</html>
