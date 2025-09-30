<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Users Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Import Google Font */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    /* Base */
    body {
      min-height: 100vh;
      margin: 0;
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, #CDD7DF, #8AA7BC);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    /* Glass Container */
    .glass-container {
      width: 100%;
      max-width: 1100px;
      padding: 40px;
      border-radius: 25px;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255,255,255,0.3);
      box-shadow: 0 20px 40px rgba(0,0,0,0.2);
      animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px);}
      to { opacity: 1; transform: translateY(0);}
    }

    /* Header */
    .glass-container h2 {
      text-align: center;
      font-size: 2.3em;
      font-weight: 700;
      color: #0D273D;
      margin-bottom: 35px;
      letter-spacing: 1px;
    }

    /* User status */
    .user-status {
      background: rgba(255,255,255,0.25);
      border: 1px solid #8AA7BC;
      padding: 12px 18px;
      border-radius: 12px;
      display: inline-block;
      margin-bottom: 20px;
      color: #0D273D;
      font-weight: 500;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .user-status.error {
      background: #fff0f0;
      border: 1px solid #FFC0C0;
      color: #B03030;
    }

    /* Top Bar */
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      flex-wrap: wrap;
      gap: 10px;
    }

    .logout-btn {
      padding: 10px 20px;
      border-radius: 12px;
      background: linear-gradient(to right, #3E6985, #0D273D);
      border: none;
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .logout-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.25);
    }

    /* Search */
.search-form {
  display: flex;
  flex: 1;
  gap: 8px;
  padding: 5px 10px;
  border: 1px solid #8AA7BC;
  border-radius: 12px;
  background: rgba(255,255,255,0.3);
}

.search-form input,
.search-form button {
  border: none;
  outline: none;
  padding: 8px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 500;
}

.search-form input {
  flex: 1;
  background: transparent;
  color: #0D273D;
}

.search-form input:focus {
  background: rgba(255,255,255,0.5);
}

.search-form button {
  padding: 8px 16px;
  border-radius: 12px;
  background: linear-gradient(to right, #3E6985, #0D273D);
  color: #fff;
  cursor: pointer;
  transition: all 0.3s ease;
}

.search-form button:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.25);
}


    /* Table */
    .table-responsive {
      border-radius: 15px;
      overflow: hidden;
      margin-bottom: 25px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      overflow: hidden;
    }

    th, td {
      padding: 14px;
      text-align: center;
      color: #0D273D;
      font-weight: 500;
    }

    th {
      background: linear-gradient(to right, #3E6985, #0D273D);
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    tr:hover {
      background: rgba(255,255,255,0.4);
      transition: 0.3s ease;
    }

    /* Action buttons */
    a[href*="update"], a[href*="delete"] {
      padding: 6px 12px;
      border-radius: 12px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
      display: inline-block;
    }

    a[href*="update"] {
      background: linear-gradient(to right, #3E6985, #0D273D);
      color: #fff;
    }

    a[href*="delete"] {
      background: linear-gradient(to right, #D94F4F, #B03030);
      color: #fff;
    }

    a[href*="update"]:hover, a[href*="delete"]:hover {
      box-shadow: 0 5px 15px rgba(0,0,0,0.25);
      transform: scale(1.05);
    }

    /* Create button */
    .btn-create {
      display: inline-block;
      padding: 14px 30px;
      background: linear-gradient(to right, #3E6985, #0D273D);
      color: #fff;
      font-size: 1.1em;
      font-weight: 600;
      border-radius: 20px;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .btn-create:hover {
      transform: translateY(-2px) scale(1.02);
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }

    /* Pagination */
    .pagination-container {
      display: flex;
      justify-content: center;
      margin: 20px 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .top-bar { flex-direction: column; }
      .btn-create { width: 100%; text-align: center; }
      table th, table td { font-size: 13px; padding: 10px; }
    }
  </style>
</head>
<body>
  <section>
    <div class="glass-container">
      <h2><?= ($logged_in_user['role'] === 'admin') ? 'Admin Dashboard' : 'User Dashboard'; ?></h2>

      <?php if(!empty($logged_in_user)): ?>
        <div class="user-status">
          <strong>Welcome:</strong> 
          <span class="username"><?= html_escape($logged_in_user['username']); ?></span>
        </div>
      <?php else: ?>
        <div class="user-status error">
          Logged in user not found
        </div>
      <?php endif; ?>

      <div class="top-bar">
        <a href="<?=site_url('auth/logout'); ?>"><button class="logout-btn">Logout</button></a>
        <form action="<?=site_url('users');?>" method="get" class="search-form">
          <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
          <input name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
          <button type="submit">Search</button>  
        </form>
      </div>

      <div class="table-responsive">
        <table>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <?php if ($logged_in_user['role'] === 'admin'): ?>
              <th>Password</th>
              <th>Role</th>
            <?php endif; ?>
            <th>Action</th>
          </tr>
          <?php foreach ($users as $user): ?>
          <tr>
            <td><?=html_escape($user['id']); ?></td>
            <td><?=html_escape($user['username']); ?></td>
            <td><?=html_escape($user['email']); ?></td>
              <?php if ($logged_in_user['role'] === 'admin'): ?>
                <td>*******</td>
                <td><?= html_escape($user['role']); ?></td>
              <?php endif; ?>
            <td>
              <?php if ($logged_in_user['role'] === 'admin'): ?>
                <a href="<?=site_url('/users/update/'.$user['id']);?>">Update</a>
                <a href="<?=site_url('/users/delete/'.$user['id']);?>" onclick="return confirm('Are you sure?')">Delete</a>
              <?php else: ?>
                <span class="text-muted">View Only</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </table>
      </div>

      <div class="pagination-container">
        <?php echo $page; ?>
      </div>

      <?php if ($logged_in_user['role'] === 'admin'): ?>
        <div class="text-center mt-4">
          <a href="<?=site_url('users/create'); ?>" class="btn-create">+ Create New User</a>
        </div>
      <?php endif; ?>
    </div>
  </section>
</body>
</html>
