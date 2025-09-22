<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Students Info</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-[#CDD7DF] via-[#A6BED1] to-[#8AA7BC]">

  <!-- Floating Background Blobs -->
  <div class="absolute top-20 left-10 w-72 h-72 bg-[#3E6985] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
  <div class="absolute top-60 right-20 w-80 h-80 bg-[#0D273D] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
  <div class="absolute bottom-20 left-1/3 w-96 h-96 bg-[#A6BED1] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

  <!-- Card Container -->
  <div class="relative backdrop-blur-xl bg-white/20 border border-white/30 shadow-2xl rounded-3xl p-8 w-full max-w-5xl animate-fadeIn">
    
    <!-- Title -->
    <h1 class="text-4xl font-extrabold text-center text-[#0D273D] mb-6 drop-shadow-lg">👥 Students Info</h1>

    <!-- Search Form -->
    <form action="<?= site_url('users'); ?>" method="get" class="flex justify-end mb-5 space-x-2">
      <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
      <input type="text" name="q" placeholder="Search..." value="<?= html_escape($q); ?>"
        class="px-4 py-2 w-64 rounded-xl bg-white/70 border border-[#8AA7BC] text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-[#3E6985] focus:border-[#3E6985] transition">
      <button type="submit"
        class="px-5 py-2 rounded-xl bg-gradient-to-r from-[#3E6985] to-[#0D273D] text-white font-semibold shadow hover:scale-105 transform transition duration-300">
        🔍 Search
      </button>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full border-collapse bg-white/40 backdrop-blur-md rounded-2xl shadow-lg overflow-hidden">
        <thead>
          <tr class="bg-[#1E3D59] text-white text-left">
            <th class="px-6 py-3 text-sm uppercase">ID</th>
            <th class="px-6 py-3 text-sm uppercase">Username</th>
            <th class="px-6 py-3 text-sm uppercase">Email</th>
            <th class="px-6 py-3 text-sm uppercase">Action</th>
          </tr>
        </thead>
        <tbody class="text-[#0D273D]">
          <?php foreach (html_escape($user) as $users): ?>
          <tr class="hover:bg-white/70 transition">
            <td class="px-6 py-3"><?= $users['id']; ?></td>
            <td class="px-6 py-3"><?= $users['username']; ?></td>
            <td class="px-6 py-3"><?= $users['email']; ?></td>
            <td class="px-6 py-3 space-x-2 flex">
              <button onclick="confirmUpdate('<?= site_url('/users/update/'.$users['id']); ?>')" 
                class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#3E6985] to-[#0D273D] text-white rounded-full text-sm font-semibold shadow-md hover:scale-105 hover:shadow-lg transition transform">
                ✏️ Update
              </button>
              <button onclick="confirmDelete('<?= site_url('/users/delete/'.$users['id']); ?>')" 
                class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#D94F4F] to-[#B03030] text-white rounded-full text-sm font-semibold shadow-md hover:scale-105 hover:shadow-lg transition transform">
                🗑️ Delete
              </button>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-5 flex justify-center gap-2 flex-wrap">
      <?php 
        $total_pages = 5; 
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        if ($current_page > 1):
      ?>
        <button onclick="confirmPage(1)" class="px-4 py-2 bg-[#3E6985] text-white rounded-full hover:bg-[#0D273D] shadow-md hover:shadow-lg transition">First</button>
        <button onclick="confirmPage(<?= $current_page-1 ?>)" class="px-4 py-2 bg-[#3E6985] text-white rounded-full hover:bg-[#0D273D] shadow-md hover:shadow-lg transition">&larr; Prev</button>
      <?php endif; ?>

      <span class="px-4 py-2 bg-[#0D273D] text-white rounded-full font-semibold shadow-md"><?= $current_page ?></span>

      <?php if ($current_page < $total_pages): ?>
        <button onclick="confirmPage(<?= $current_page+1 ?>)" class="px-4 py-2 bg-[#3E6985] text-white rounded-full hover:bg-[#0D273D] shadow-md hover:shadow-lg transition">Next &rarr;</button>
        <button onclick="confirmPage(<?= $total_pages ?>)" class="px-4 py-2 bg-[#3E6985] text-white rounded-full hover:bg-[#0D273D] shadow-md hover:shadow-lg transition">Last</button>
      <?php endif; ?>
    </div>

    <script>
      function confirmPage(page) {
        Swal.fire({
          title: 'Go to page ' + page + '?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#0D273D',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "<?= site_url('users?page='); ?>" + page;
          }
        });
      }

      function confirmUpdate(url) {
        Swal.fire({
          title: 'Do you want to update this user?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#0D273D',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        });
      }

      function confirmDelete(url) {
        Swal.fire({
          title: 'Are you sure you want to delete this user?',
          text: "This action cannot be undone!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#D94F4F',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        });
      }
    </script>

    <!-- Create Button -->
    <div class="text-center mt-6">
      <a href="<?= site_url('users/create'); ?>"
        class="inline-block px-6 py-3 bg-gradient-to-r from-[#3E6985] to-[#0D273D] text-white font-bold rounded-full shadow-lg hover:scale-105 transform transition">
        ➕ Create New User
      </a>
    </div>
  </div>

  <!-- Animations -->
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes blob {
      0%, 100% { transform: translate(0px, 0px) scale(1); }
      33% { transform: translate(30px, -50px) scale(1.1); }
      66% { transform: translate(-20px, 20px) scale(0.9); }
    }
    .animate-fadeIn { animation: fadeIn 0.8s ease-out forwards; }
    .animate-blob { animation: blob 10s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
  </style>

</body>
</html>
