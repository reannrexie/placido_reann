<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User List</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-[#CDD7DF] via-[#A6BED1] to-[#8AA7BC]">

  <!-- Floating Background Blobs -->
  <div class="absolute top-20 left-10 w-72 h-72 bg-[#3E6985] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
  <div class="absolute top-60 right-20 w-80 h-80 bg-[#0D273D] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
  <div class="absolute bottom-20 left-1/3 w-96 h-96 bg-[#A6BED1] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

  <!-- Card Container -->
  <div class="relative backdrop-blur-xl bg-white/20 border border-white/30 p-8 rounded-3xl shadow-2xl w-full max-w-5xl animate-fadeIn">
    
    <!-- Title -->
    <h1 class="text-4xl font-extrabold text-center text-[#0D273D] drop-shadow-lg mb-6 tracking-wide">
      👥 User List
    </h1>

    <!-- Table -->
    <div class="overflow-x-auto rounded-2xl border border-[#8AA7BC] shadow-lg">
      <table class="min-w-full backdrop-blur-sm bg-white/40 rounded-xl">
        <thead class="bg-gradient-to-r from-[#0D273D] to-[#3E6985] text-white shadow-lg">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold">ID</th>
            <th class="px-6 py-3 text-left text-sm font-semibold">Username</th>
            <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
            <th class="px-6 py-3 text-left text-sm font-semibold">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-[#CDD7DF]/50">
          <?php foreach (html_escape($users) as $user): ?>
            <tr class="hover:bg-[#A6BED1]/60 transition duration-300 ease-in-out transform hover:scale-[1.02] hover:shadow-md">
              <td class="px-6 py-4 text-sm text-gray-700"><?= $user['id']; ?></td>
              <td class="px-6 py-4 text-sm font-medium text-[#0D273D]"><?= $user['username']; ?></td>
              <td class="px-6 py-4 text-sm text-gray-700"><?= $user['email']; ?></td>
              <td class="px-6 py-4 text-sm space-x-3">
                <a href="<?=site_url('users/update/'.$user['id']);?>" 
                   class="px-3 py-1 rounded-md bg-[#3E6985]/20 text-[#0D273D] font-semibold transition hover:bg-[#3E6985]/40 hover:shadow-lg hover:text-white">
                  Update
                </a>
                <button onclick="openModal(<?= $user['id']; ?>)" 
                        class="px-3 py-1 rounded-md bg-red-500/20 text-red-600 font-semibold transition hover:bg-red-500 hover:text-white hover:shadow-lg">
                  Delete
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Create Button -->
    <div class="mt-8 text-center">
      <a href="<?= site_url('users/create'); ?>"
        class="inline-block bg-gradient-to-r from-[#3E6985] to-[#0D273D] text-white px-8 py-3 rounded-2xl shadow-lg hover:scale-105 hover:shadow-[0_0_20px_#3E6985] transition duration-300 animate-pulse-slow">
        + Create New User
      </a>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div id="deleteModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white/90 border border-[#8AA7BC] rounded-2xl shadow-2xl p-8 w-full max-w-sm animate-dropIn">
      <h2 class="text-xl font-bold text-[#0D273D] mb-4">⚠️ Confirm Delete</h2>
      <p class="text-gray-700 mb-6">Are you sure you want to delete this user? This action <b>cannot</b> be undone.</p>
      <div class="flex justify-end space-x-3">
        <button onclick="closeModal()" 
                class="px-4 py-2 bg-[#CDD7DF] text-[#0D273D] rounded-lg hover:bg-[#A6BED1] transition hover:scale-105">
          Cancel
        </button>
        <a id="confirmDeleteBtn" href="#" 
           class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 hover:scale-105 transition">
          Delete
        </a>
      </div>
    </div>
  </div>

  <!-- Animations -->
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes dropIn {
      from { opacity: 0; transform: translateY(-40px) scale(0.95); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes blob {
      0%, 100% { transform: translate(0px, 0px) scale(1); }
      33% { transform: translate(30px, -50px) scale(1.1); }
      66% { transform: translate(-20px, 20px) scale(0.9); }
    }
    .animate-fadeIn { animation: fadeIn 0.8s ease-out forwards; }
    .animate-dropIn { animation: dropIn 0.5s ease-out forwards; }
    .animate-blob { animation: blob 10s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
    .animate-pulse-slow { animation: pulse 3s infinite; }
  </style>

  <!-- JS -->
  <script>
    let deleteUrl = "";

    function openModal(userId) {
      deleteUrl = "<?= site_url('users/delete/'); ?>" + userId;
      document.getElementById("confirmDeleteBtn").setAttribute("href", deleteUrl);

      document.getElementById("deleteModal").classList.remove("hidden");
      document.getElementById("deleteModal").classList.add("flex");
    }

    function closeModal() {
      document.getElementById("deleteModal").classList.add("hidden");
      document.getElementById("deleteModal").classList.remove("flex");
    }
  </script>

</body>
</html>
