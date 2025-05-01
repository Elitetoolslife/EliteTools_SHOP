 <?php
use App\Models\Tickets;

// Fetch & categorize
$tickets    = new Tickets();
$all        = $tickets->getAllTickets();
$open       = $tickets->getTicketsByStatus(0);
$inProgress = $tickets->getTicketsByStatus(1);
$resolved   = $tickets->getTicketsByStatus(2);

// Counts
$counts = [
    'all'      => count($all),
    'open'     => count($open),
    'inprog'   => count($inProgress),
    'resolved' => count($resolved),
];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="csrf-token" content="<?= App\Helpers\CsrfHelper::generateToken(); ?>">
  <meta name="bearer-token" content="<?= htmlspecialchars($bearer_token); ?>">
  <meta name="theme-color" content="#0d6efd"> <!-- Mobile browser theme -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <title>Elitetools – Admin Tickets</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome (for icons) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- Custom Styles (Make sure this is responsive) -->
  <link href="<?= App\Helpers\AssetsHelper::asset('css/admin.css'); ?>" rel="stylesheet">
</head>

  <!-- Favicons & Touch Icons -->
  <link rel="shortcut icon" href="https://waxa.pw/assets/media/favicons/favicon.png">
  <link rel="icon" type="image/png" sizes="192x192" href="https://waxa.pw/assets/media/favicons/favicon-192x192.png">
  <link rel="apple-touch-icon" sizes="180x180" href="https://waxa.pw/assets/media/favicons/apple-touch-icon-180x180.png">

  <!-- Core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" id="css-main" href="https://waxa.pw/assets/css/oneui.min.css">

  <!-- Plugin CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
  <link rel="stylesheet" href="https://waxa.pw/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://waxa.pw/assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
  <link rel="stylesheet" href="https://waxa.pw/assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
  <link rel="stylesheet" href="https://waxa.pw/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
  <link rel="stylesheet" href="https://waxa.pw/assets/js/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="https://waxa.pw/assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.css">
  <link rel="stylesheet" href="https://waxa.pw/assets/js/plugins/dropzone/min/dropzone.min.css">
  <link rel="stylesheet" href="https://waxa.pw/assets/js/plugins/flatpickr/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<!-- JS: Bootstrap, jQuery, DataTables, AOS, OneUI Helpers, SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/oneui.app.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
  /* —— Reset & Global —— */
  body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    transition: background-color 0.3s, color 0.3s;
    overflow: hidden; /* prevent body scroll */
  }

  body.light-mode {
    background: #f9fafc;
    color: #212529;
  }

  body.dark-mode {
    background: #121212;
    color: #e0e0e0;
  }

  /* —— Header —— */
  .header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 60px;
    background: #2c2c3a;
    color: #fff;
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 1040;
    border-bottom: 1px solid #444;
  }

  .header .btn {
    border-radius: 30px;
  }

  .header a,
  .header .nav-link,
  .header .navbar-brand {
    color: #fff;
    text-decoration: none;
  }

  .header a:hover,
  .header .nav-link:hover {
    color: #f8f9fa;
  }

  /* —— Sidebar —— */
  #admin-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 260px;
    height: 100vh;
    background: #1e1e2f;
    color: #fff;
    z-index: 1030;
    transition: transform .3s ease;
  }

  #admin-sidebar.collapsed {
    transform: translateX(-100%);
  }

  #admin-sidebar .sidebar-header {
    background: #2c2c3a;
  }

  #admin-sidebar .nav-link {
    color: #cfcfd6;
    padding: .75rem 1rem;
    border-radius: .25rem;
    transition: background .2s;
  }

  #admin-sidebar .nav-link.active,
  #admin-sidebar .nav-link:hover {
    background: #343a40;
    color: #fff;
  }

  /* —— Main Content —— */
  .main-content {
    position: absolute;
    top: 60px; /* height of header */
    bottom: 0;
    left: 260px; /* width of sidebar */
    right: 0;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 1rem;
    transition: left .3s ease;
  }

  .main-content.collapsed {
    left: 0;
  }

  /* —— Cards —— */
  .card {
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #e0f7fa, #f8f9fa);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  body.dark-mode .card {
    background: linear-gradient(135deg, #2d2d2d, #1a1a1a);
    color: #e0e0e0;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
  }

  .card h5 {
    font-weight: 600;
    color: #0d6efd;
  }

  /* —— Navigation Pills —— */
  .nav-pills .nav-link {
    border-radius: 50px;
    padding: .5rem 1rem;
    transition: background .3s, box-shadow .3s;
  }

  .nav-pills .nav-link.active {
    background: #0d6efd;
    color: #fff;
    box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
  }

  /* —— Table —— */
  .table-responsive {
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
  }

  .table-responsive table {
    width: max-content;
    min-width: 100%;
  }

  .table thead {
    background: #e3f2fd;
    color: #0d47a1;
  }

  .table td,
  .table th {
    vertical-align: middle;
    white-space: nowrap;
  }

  .table th.text-center {
    text-align: center;
  }

  tr.status-0 {
    background: #fff3cd; /* Open */
  }

  tr.status-1 {
    background: #cff4fc; /* In Progress */
  }

  tr.status-2 {
    background: #d1e7dd; /* Resolved */
  }

  /* —— Buttons —— */
  .btn {
    border-radius: 20px;
    transition: transform .2s, box-shadow .2s;
  }

  .btn:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  /* —— Responsive Adjustments —— */
  @media (max-width:768px) {
    #admin-sidebar {
      transform: translateX(-100%);
    }

    #admin-sidebar.collapsed {
      transform: translateX(0);
    }

    .main-content {
      left: 0;
    }

    .main-content.collapsed {
      left: 260px;
    }
  }

  @media (max-width:576px) {
    .table-sm th,
    .table-sm td {
      padding: .4rem;
      font-size: .8rem;
    }

    .d-sm-table-cell {
      display: none !important;
    }
  }

</style>

<body class="light-mode">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/assets/js/oneui.app.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // Sidebar toggle
    document.getElementById('sidebarToggle').addEventListener('click', ()=>{
      document.getElementById('admin-sidebar').classList.toggle('collapsed');
      document.querySelector('.main-content').classList.toggle('collapsed');
    });
    // Theme toggle
    document.getElementById('toggleTheme').addEventListener('click', ()=>{
      document.body.classList.toggle('dark-mode');
      document.body.classList.toggle('light-mode');
    });
  });
</script>

<div class="d-flex">

      <div class="header mb-4">
      <button id="sidebarToggle" class="btn btn-primary d-md-none">
        <i class="fas fa-bars"></i>
      </button>

        <button id="toggleTheme" class="btn btn-outline-light btn-sm">
          <i class="fa fa-moon"></i> Theme
        </button>
      </div><!-- Sidebar -->

<nav id="admin-sidebar" class="d-flex flex-column">
  <div class="sidebar-header d-flex align-items-center justify-content-between px-3 py-3 border-bottom border-secondary">
    <a href="<?= App\Helpers\AssetsHelper::url('admin/'); ?>"
       class="text-white fw-bold fs-5 text-decoration-none">
      <i class="fa fa-cogs me-2"></i> Admin Panel
    </a>
    <button id="sidebarCloseMobile" class="btn btn-sm btn-alt-secondary d-lg-none text-white">
      <i class="fa fa-fw fa-times"></i>
    </button>
  </div>

  <div class="flex-grow-1 overflow-auto px-2 pt-3">
    <ul class="nav flex-column fs-sm">

      <!-- Dashboard -->
      <li class="nav-item mb-1">
        <a href="<?= App\Helpers\AssetsHelper::url('admin/'); ?>"
           class="nav-link d-flex align-items-center rounded <?= $activePage==='dashboard' ? 'active' : '' ?>">
          <i class="fa fa-chart-line me-2 text-primary"></i> Dashboard
        </a>
      </li>

      <!-- Account -->
      <li class="mt-4 mb-2 text-uppercase text-muted small px-3">Account</li>
      <li class="nav-item mb-1">
        <a href="<?= App\Helpers\AssetsHelper::url('admin/profile'); ?>"
           class="nav-link d-flex align-items-center rounded <?= $activePage==='profile' ? 'active' : '' ?>">
          <i class="fa fa-user me-2 text-secondary"></i> Profile
        </a>
      </li>

      <!-- Reports -->
      <li class="mt-4 mb-2 text-uppercase text-muted small px-3">Reports</li>
      <li class="nav-item mb-1">
        <a href="<?= App\Helpers\AssetsHelper::url('admin/reports'); ?>"
           class="nav-link d-flex align-items-center rounded <?= $activePage==='reports' ? 'active' : '' ?>">
          <i class="fa fa-flag me-2 text-warning"></i> All Reports
        </a>
      </li>
      <li class="nav-item mb-1">
        <a href="<?= App\Helpers\AssetsHelper::url('admin/reports?status=pending'); ?>"
           class="nav-link d-flex align-items-center rounded <?= $activePage==='reports.status=pending' ? 'active' : '' ?>">
          <i class="fa fa-flag-checkered me-2 text-warning"></i> Pending Reports
          <span class="badge bg-warning ms-auto"><?= $counts['open'] ?? 0 ?></span>
        </a>
      </li>

      <!-- Tickets -->
      <li class="nav-item mt-4">
        <a class="nav-link d-flex justify-content-between align-items-center <?= strpos($activePage,'tickets')===0?'':'collapsed' ?>"
           data-bs-toggle="collapse" href="#collapseTickets"
           aria-expanded="<?= strpos($activePage,'tickets')===0?'true':'false' ?>">
          <span><i class="fa fa-ticket-alt me-2 text-warning"></i> Tickets</span>
          <i class="fa fa-chevron-down"></i>
        </a>
        <div id="collapseTickets" class="collapse <?= strpos($activePage,'tickets')===0?'show':'' ?>">
          <ul class="nav flex-column ms-3">
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/tickets?tab=open') ?>"
                 class="nav-link <?= $activeTab==='open'?'active':'' ?>">
                Open <span class="badge bg-warning ms-auto"><?= $counts['open'] ?? 0 ?></span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/tickets?tab=all') ?>"
                 class="nav-link <?= $activeTab==='all'?'active':'' ?>">
                All <span class="badge bg-primary ms-auto"><?= $counts['all'] ?? 0 ?></span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/tickets?tab=inprog') ?>"
                 class="nav-link <?= $activeTab==='inprog'?'active':'' ?>">
                In Progress <span class="badge bg-info ms-auto"><?= $counts['inprog'] ?? 0 ?></span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/tickets?tab=resolved') ?>"
                 class="nav-link <?= $activeTab==='resolved'?'active':'' ?>">
                Resolved <span class="badge bg-success ms-auto"><?= $counts['resolved'] ?? 0 ?></span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Users -->
      <li class="nav-item mt-4">
        <a class="nav-link d-flex justify-content-between align-items-center <?= strpos($activePage,'users')===0?'':'collapsed' ?>"
           data-bs-toggle="collapse" href="#collapseUsers"
           aria-expanded="<?= strpos($activePage,'users')===0?'true':'false' ?>">
          <span><i class="fa fa-users me-2 text-info"></i> Users</span>
          <i class="fa fa-chevron-down"></i>
        </a>
        <div id="collapseUsers" class="collapse <?= strpos($activePage,'users')===0?'show':'' ?>">
          <ul class="nav flex-column ms-3">
            <?php foreach (['pending'=>'Pending','active'=>'Approved','rejected'=>'Rejected','all'=>'All'] as $tab=>$label): ?>
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url("admin/users?tab={$tab}") ?>"
                 class="nav-link <?= $activeTab===$tab?'active':'' ?>">
                <?= $label ?> <span class="badge bg-<?= $tab==='pending'?'warning':($tab==='active'?'success':($tab==='rejected'?'danger':'primary')) ?> ms-auto"><?= $counts[$tab] ?? 0 ?></span>
              </a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </li>

      <!-- Orders & Sales -->
      <li class="nav-item mt-4">
        <a class="nav-link d-flex justify-content-between align-items-center <?= in_array($activePage,['orders','sales'])?'':'collapsed' ?>"
           data-bs-toggle="collapse" href="#collapseOrders"
           aria-expanded="<?= in_array($activePage,['orders','sales'])?'true':'false' ?>">
          <span><i class="fa fa-shopping-bag me-2 text-success"></i> Orders & Sales</span>
          <i class="fa fa-chevron-down"></i>
        </a>
        <div id="collapseOrders" class="collapse <?= in_array($activePage,['orders','sales'])?'show':'' ?>">
          <ul class="nav flex-column ms-3">
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/orders'); ?>"
                 class="nav-link <?= $activePage==='orders'?'active':'' ?>">
                Orders <span class="badge bg-primary ms-auto"><?= $counts['orders'] ?? 0 ?></span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/sales'); ?>"
                 class="nav-link <?= $activePage==='sales'?'active':'' ?>">
                Sales <span class="badge bg-success ms-auto"><?= $counts['sales'] ?? 0 ?></span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Finance -->
      <li class="nav-item mt-4">
        <a class="nav-link d-flex justify-content-between align-items-center <?= in_array($activePage,['financial','payments','withdrawals','withdraw.approval'])?'':'collapsed' ?>"
           data-bs-toggle="collapse" href="#collapseFinance"
           aria-expanded="<?= in_array($activePage,['financial','payments','withdrawals','withdraw.approval'])?'true':'false' ?>">
          <span><i class="fa fa-chart-area me-2 text-success"></i> Finance</span>
          <i class="fa fa-chevron-down"></i>
        </a>
        <div id="collapseFinance" class="collapse <?= in_array($activePage,['financial','payments','withdrawals','withdraw.approval'])?'show':'' ?>">
          <ul class="nav flex-column ms-3">
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/status'); ?>"
                 class="nav-link <?= $activePage==='financial'?'active':'' ?>">Status</a>
            </li>
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/payments'); ?>"
                 class="nav-link <?= $activePage==='payments'?'active':'' ?>">
                Payments <span class="badge bg-info ms-auto"><?= $counts['payments'] ?? 0 ?></span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/withdrawals'); ?>"
                 class="nav-link <?= $activePage==='withdrawals'?'active':'' ?>">
                Withdrawals <span class="badge bg-secondary ms-auto"><?= $counts['withdrawals'] ?? 0 ?></span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/withdrawals/approval'); ?>"
                 class="nav-link <?= $activePage==='withdraw.approval'?'active':'' ?>">
                Withdraw Approval <span class="badge bg-warning ms-auto"><?= $counts['withdrawApproval'] ?? 0 ?></span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- News -->
      <li class="nav-item mt-4">
        <a class="nav-link d-flex justify-content-between align-items-center <?= in_array($activePage,['news','news.add'])?'':'collapsed' ?>"
           data-bs-toggle="collapse" href="#collapseNews"
           aria-expanded="<?= in_array($activePage,['news','news.add'])?'true':'false' ?>">
          <span><i class="fa fa-newspaper me-2 text-primary"></i> News</span>
          <i class="fa fa-chevron-down"></i>
        </a>
        <div id="collapseNews" class="collapse <?= in_array($activePage,['news','news.add'])?'show':'' ?>">
          <ul class="nav flex-column ms-3">
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/news'); ?>"
                 class="nav-link <?= $activePage==='news'?'active':'' ?>">
                All News <span class="badge bg-primary ms-auto"><?= $counts['news'] ?? 0 ?></span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/news/add'); ?>"
                 class="nav-link <?= $activePage==='news.add'?'active':'' ?>">
                Add News
              </a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Tools & Settings -->
      <li class="nav-item mt-4">
        <a class="nav-link d-flex justify-content-between align-items-center <?= in_array($activePage,['tools.visualize','settings'])?'':'collapsed' ?>"
           data-bs-toggle="collapse" href="#collapseTools"
           aria-expanded="<?= in_array($activePage,['tools.visualize','settings'])?'true':'false' ?>">
          <span><i class="fa fa-cog me-2"></i> Tools & Settings</span>
          <i class="fa fa-chevron-down"></i>
        </a>
        <div id="collapseTools" class="collapse <?= in_array($activePage,['tools.visualize','settings'])?'show':'' ?>">
          <ul class="nav flex-column ms-3">
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/tools/visualize'); ?>"
                 class="nav-link <?= $activePage==='tools.visualize'?'active':'' ?>">Visualize Tools</a>
            </li>
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/settings'); ?>"
                 class="nav-link <?= $activePage==='settings'?'active':'' ?>">Settings</a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Shop -->
      <li class="nav-item mt-4">
        <a class="nav-link d-flex justify-content-between align-items-center <?= in_array($activePage,['shop.dashboard','shop.brand'])?'':'collapsed' ?>"
           data-bs-toggle="collapse" href="#collapseShop"
           aria-expanded="<?= in_array($activePage,['shop.dashboard','shop.brand'])?'true':'false' ?>">
          <span><i class="fa fa-chart-pie me-2"></i> Shop</span>
          <i class="fa fa-chevron-down"></i>
        </a>
        <div id="collapseShop" class="collapse <?= in_array($activePage,['shop.dashboard','shop.brand'])?'show':'' ?>">
          <ul class="nav flex-column ms-3">
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('elitetools.life'); ?>"
                 class="nav-link <?= $activePage==='shop.dashboard'?'active':'' ?>">Marketplace</a>
            </li>
            <li class="nav-item">
              <a href="<?= App\Helpers\AssetsHelper::url('admin/shop/brand'); ?>"
                 class="nav-link <?= $activePage==='shop.brand'?'active':'' ?>">Brand</a>
            </li>
          </ul>
        </div>
      </li>

      <!-- Logout -->
      <li class="nav-item mt-4">
        <a href="<?= App\Helpers\AssetsHelper::url('logout'); ?>"
           class="nav-link d-flex align-items-center rounded text-white">
          <i class="fa fa-sign-out-alt me-2 text-danger"></i> Logout
        </a>
      </li>

    </ul>
  </div>
</nav>
  </nav>   

   <main id="main-container">
     <div class="bg-body-light">
<div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                     </div>
                    </div>
                </div>
<!-- END Main Navigation -->
            </div>
           </div>
        </div>

<main id="main-container">
    <div class="content content-full">      </div>

      </div>  <title>Admin — <?= htmlspecialchars($page_title, ENT_QUOTES) ?></title>

  <!-- Tailwind CSS (alternative modern approach) -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- DataTables & SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <style>
/* ================================
   Base Styles
================================ */
:root {
  --primary-color: #27ae60;
  --secondary-color: #2c3e50;
  --background-color: #f5f7fa;
  --text-color: #4a5568;
  --text-light: #a0aec0;
  --border-color: #e2e8f0;
  --white: #fff;
  --black: #000;
  --shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  font-family: 'Inter', 'Helvetica Neue', Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  color: var(--text-color);
  background-color: var(--background-color);
}

a {
  color: var(--primary-color);
  text-decoration: none;
  transition: color 0.2s ease;
}

a:hover {
  color: var(--secondary-color);
}

img {
  max-width: 100%;
  height: auto;
}

/* ================================
   Layout
================================ */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 1rem;
}

.container-fluid {
  width: 100%;
  padding: 1rem;
}

.row {
  display: flex;
  flex-wrap: wrap;
}

.col {
  flex: 1;
  padding: 0.5rem;
}

.col-6 {
  flex: 0 0 50%;
  max-width: 50%;
}

.col-12 {
  flex: 0 0 100%;
  max-width: 100%;
}

.card {
  background-color: var(--white);
  border-radius: 0.5rem;
  box-shadow: var(--shadow);
  padding: 1.5rem;
  margin-bottom: 1.5rem;
}

/* ================================
   Typography
================================ */
h1, h2, h3, h4, h5, h6 {
  margin-bottom: 1rem;
  font-weight: 600;
  color: var(--secondary-color);
}

h1 { font-size: 2.5rem; }
h2 { font-size: 2rem; }
h3 { font-size: 1.75rem; }
h4 { font-size: 1.5rem; }
h5 { font-size: 1.25rem; }
h6 { font-size: 1rem; }

p {
  margin-bottom: 1rem;
  color: var(--text-color);
}

small {
  font-size: 0.875rem;
  color: var(--text-light);
}

/* ================================
   Buttons
================================ */
button, .btn {
  display: inline-block;
  padding: 0.75rem 1.25rem;
  font-size: 1rem;
  font-weight: 500;
  text-align: center;
  border: none;
  border-radius: 0.5rem;
  cursor: pointer;
  transition: background-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
}

.btn-primary {
  background-color: var(--primary-color);
  color: var(--white);
}

.btn-primary:hover {
  background-color: darken(var(--primary-color), 10%);
}

.btn-secondary {
  background-color: var(--secondary-color);
  color: var(--white);
}

.btn-secondary:hover {
  background-color: darken(var(--secondary-color), 10%);
}

.btn-outline {
  background: none;
  border: 2px solid var(--primary-color);
  color: var(--primary-color);
}

.btn-outline:hover {
  background-color: var(--primary-color);
  color: var(--white);
}

/* ================================
   Forms
================================ */
input, select, textarea {
  display: block;
  width: 100%;
  padding: 0.75rem 1rem;
  font-size: 1rem;
  border: 1px solid var(--border-color);
  border-radius: 0.5rem;
  background-color: var(--white);
  color: var(--text-color);
  transition: box-shadow 0.2s ease, border-color 0.2s ease;
}

input:focus, select:focus, textarea:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 2px rgba(39, 174, 96, 0.2);
  outline: none;
}

label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: var(--text-color);
}

/* ================================
   Tables
================================ */
.table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 1.5rem;
}

.table th, .table td {
  padding: 0.75rem 1rem;
  text-align: left;
  border: 1px solid var(--border-color);
}

.table th {
  background-color: var(--background-color);
  font-weight: 600;
}

.table-striped tr:nth-child(odd) {
  background-color: rgba(0, 0, 0, 0.05);
}

.table-responsive {
  overflow-x: auto;
}

/* ================================
   Utilities
================================ */
.text-center {
  text-align: center;
}

.text-right {
  text-align: right;
}

.text-uppercase {
  text-transform: uppercase;
}

.text-muted {
  color: var(--text-light);
}

.mt-1 { margin-top: 0.25rem; }
.mt-2 { margin-top: 0.5rem; }
.mt-3 { margin-top: 1rem; }
.mt-4 { margin-top: 1.5rem; }
.mt-5 { margin-top: 3rem; }

.mb-1 { margin-bottom: 0.25rem; }
.mb-2 { margin-bottom: 0.5rem; }
.mb-3 { margin-bottom: 1rem; }
.mb-4 { margin-bottom: 1.5rem; }
.mb-5 { margin-bottom: 3rem; }

.p-1 { padding: 0.25rem; }
.p-2 { padding: 0.5rem; }
.p-3 { padding: 1rem; }
.p-4 { padding: 1.5rem; }
.p-5 { padding: 3rem; }

/* ================================
   Responsiveness
================================ */
@media (max-width: 768px) {
  .row {
    flex-direction: column;
  }

  .col {
    width: 100%;
  }

  .container {
    padding: 1rem;
  }
}
    body {
      background-color: #f9fafb;
    }

    /* Custom styles for floating button */
    #addBankBtn {
      position: fixed;
      bottom: 2rem;
      right: 2rem;
      background-color: #10b981;
      color: white;
      padding: 0.75rem 1.25rem;
      border-radius: 9999px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 576px) {
      #addBankBtn {
        bottom: 1rem;
        right: 1rem;
        padding: 0.5rem 0.75rem;
      }
    }
  </style>
</head>
<body class="font-sans antialiased text-gray-700">

  <!-- Header -->
  <header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <h1 class="text-xl font-semibold"><?= htmlspecialchars($page_title) ?></h1>
      <button id="addBankBtn" class="flex items-center space-x-2">
        <span>Add Bank</span>
      </button>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto px-4 py-6">
    <!-- Toolbar -->
    <section id="bulkToolbar" class="bg-white rounded-lg shadow p-4 flex justify-between items-center mb-6">
      <div class="space-x-3">
        <button id="bulk-add-csv" class="px-4 py-2 bg-gray-200 rounded-lg">Bulk CSV</button>
        <button id="bulk-update" class="px-4 py-2 bg-blue-500 text-white rounded-lg" disabled>Bulk Update</button>
        <button id="bulk-delete" class="px-4 py-2 bg-red-500 text-white rounded-lg" disabled>Bulk Delete</button>
      </div>
      <input type="file" id="csv-file" class="hidden">
    </section>

    <!-- Tabs -->
    <nav class="border-b mb-4">
      <ul class="flex space-x-4">
        <?php foreach ($tabs as $i => $t): ?>
          <li class="<?= $i === 0 ? 'border-b-2 border-green-500' : '' ?>">
            <a href="#" class="px-4 py-2 block text-gray-600 hover:text-green-500">
              <i class="fa <?= htmlspecialchars($t['icon']) ?>"></i>
              <?= htmlspecialchars($t['label']) ?>
              <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-sm"><?= (int) $counts[$t['id']] ?></span>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <!-- Tab Content -->
    <div>
      <?php foreach ($tabs as $i => $t): ?>
        <section id="<?= htmlspecialchars($t['id']) ?>" class="<?= $i === 0 ? 'block' : 'hidden' ?>">
          <div class="overflow-auto bg-white rounded-lg shadow">
            <table id="banksTable-<?= htmlspecialchars($t['id']) ?>" class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50 text-gray-600">
                <tr>
                  <th><input type="checkbox" id="select-all-<?= htmlspecialchars($t['id']) ?>"></th>
                  <th>ID</th>
                  <th>Type</th>
                  <th>Website</th>
                  <th>Balance</th>
                  <th>Country</th>
                  <th>Price</th>
                  <th>Seller</th>
                  <th>Date Added</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200"></tbody>
            </table>
          </div>
        </section>
      <?php endforeach; ?>
    </div>
  </main>

  <!-- Offcanvas: Add/Edit Bank -->
  <aside id="bankFormCanvas" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white w-full max-w-lg h-full overflow-y-auto shadow-lg">
      <header class="px-4 py-3 border-b">
        <h2 id="bankFormLabel" class="text-lg font-semibold">Add / Edit Bank</h2>
        <button class="text-gray-500 hover:text-gray-900" data-dismiss="offcanvas">&times;</button>
      </header>
      <div class="p-4">
        <form id="bankForm" class="space-y-4">
          <input type="hidden" id="bankId" name="id">
          <!-- Form Fields -->
          <!-- Similar to the original structure -->
        </form>
      </div>
    </div>
  </aside>

  <!-- JS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    // Modernized JS logic
    document.addEventListener('DOMContentLoaded', () => {
      const addBankBtn = document.getElementById('addBankBtn');
      const bankFormCanvas = document.getElementById('bankFormCanvas');

      addBankBtn.addEventListener('click', () => {
        bankFormCanvas.classList.remove('hidden');
      });

      document.querySelector('[data-dismiss="offcanvas"]').addEventListener('click', () => {
        bankFormCanvas.classList.add('hidden');
      });
    });
  </script>
</body>
</html>

  <!-- JS Libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/assets/js/bootstrap.bundle.min.js"></script>

  <!-- Unified Custom JS -->
  <script>
  (function($) {
    const region = '<?= $region ?>', slug = '<?= $slug ?>';
    let currentStatus = 'all', updateCount = 1, lowHighToggle = true;

    function showToast(type, msg) {
      Swal.fire({ toast:true, position:'top-end', icon:type, title:msg,
        showConfirmButton:false, timer:3000, timerProgressBar:true,
        didOpen(t){ t.addEventListener('mouseenter', Swal.stopTimer); t.addEventListener('mouseleave', Swal.resumeTimer);}
      });
    }

    function updateBalanceAndPrice() {
      const min = lowHighToggle ? 6100 : 5600;
      const max = lowHighToggle ? 35600 : 36240;
      const balance = Math.floor(Math.random() * (max - min + 1)) + min;
      const price   = Math.round(Math.max(balance / 124, 99));

      $('#balance').val(balance);
      $('#hiddenBalance').val(balance);
      $('#price').val(price);
      $('#hiddenPrice').val(price);

      if (++updateCount === 5) {
        lowHighToggle = !lowHighToggle;
        updateCount = 1;
      }
    }

    function initDrag() {
      const btn = $('#addBankBtn')[0];
      let dragging = false, dx=0, dy=0;
      $(btn).on('mousedown', e=>{
        dragging=true; dx=e.clientX-btn.offsetLeft; dy=e.clientY-btn.offsetTop; btn.style.transition='none';
      });
      $(document).on('mousemove', e=>{
        if (dragging) {
          btn.style.left = (e.clientX-dx)+'px';
          btn.style.top  = (e.clientY-dy)+'px';
        }
      }).on('mouseup', ()=>{
        dragging=false; btn.style.transition='';
      });
    }

    function updateBulkButtons() {
      const count = $('.select-bank:checked').length;
      $('#bulk-delete').prop('disabled', !count).text(count ? `Bulk Delete (${count})` : 'Bulk Delete');
      $('#bulk-update').prop('disabled', !count).text(count ? `Bulk Update (${count})` : 'Bulk Update');
    }

    function initTable(status) {
      currentStatus = status;
      const tbl = $(`#banksTable-${status}`);
      if ($.fn.dataTable.isDataTable(tbl)) return tbl.DataTable().ajax.reload();

      tbl.DataTable({
        serverSide:true, processing:true, pageLength:50,
        ajax:{ url:`/admin/banks/${slug}/data`, data:{ status }, cache:true },
        columns:[
          { data:'id', orderable:false, render:id=>`<input type="checkbox" class="select-bank" value="${id}">` },
          { data:'id' },{ data:'acctype' },{ data:'bankname' },{ data:'balance' },
          { data:'country' },{ data:'price' },{ data:'resseller' },{ data:'date_added' },
          { data:null, orderable:false, render:(_,__,r)=>{
              let b='';
              if (['all','available'].includes(status)) {
                b+=`<button class="btn btn-sm btn-primary edit-btn" data-id="${r.id}">Edit</button> `;
                b+=`<button class="btn btn-sm btn-danger delete-btn" data-id="${r.id}">Delete</button>`;
              } else if (status==='sold') {
                b+=`<button class="btn btn-sm btn-info mark-available-btn" data-id="${r.id}">Mark Avail</button> `;
                b+=`<button class="btn btn-sm btn-secondary mark-available-url-btn" data-id="${r.id}">Mark URL</button>`;
              } else if (status==='restore') {
                b+=`<button class="btn btn-sm btn-success restore-btn" data-id="${r.id}">Restore</button>`;
              }
              return b;
            }
          }
        ],
        order:[[1,'desc']],
        initComplete(){
          $(`#select-all-${status}`).off('change').on('change', function(){
            tbl.find('.select-bank').prop('checked',this.checked).trigger('change');
          });
          tbl.on('change','.select-bank', function(){
            $(this).closest('tr').toggleClass('selected-row',this.checked);
            updateBulkButtons();
          });
          updateBulkButtons();
        }
      });
    }

    function doBulk(action, updates=null) {
      const ids = $('.select-bank:checked').map((_,e)=>e.value).get();
      if (!ids.length) return showToast('warning','No rows selected');

      Swal.fire({ title:`Confirm ${action}`, text:`${action} ${ids.length} item(s)?`, icon:'question', showCancelButton:true })
        .then(({isConfirmed})=>{
          if (!isConfirmed) return;
          const payload = { action, ids, ...(action==='update' && updates?{ updates }: {}) };
          $.ajax({
            url:`/admin/banks/${region}/${slug}banks/bulk`,
            type:'POST', contentType:'application/json', data:JSON.stringify(payload),
            success(res){ showToast(res.success?'success':'warning',res.message); initTable(currentStatus); },
            error(){ Swal.fire('Error','Bulk failed','error'); }
          });
        });
    }

    $('#bulk-delete').click(()=> doBulk('delete'));
    $('#bulk-update').click(async()=>{
      const { value } = await Swal.fire({
        title:'Bulk Update',
        html:`<input id="swal-price" class="swal2-input" placeholder="New price">
              <input id="swal-country" class="swal2-input" placeholder="New country">`,
        focusConfirm:false,
        preConfirm:()=>({
          price: parseFloat($('#swal-price').val())||undefined,
          country: $('#swal-country').val()||undefined
        })
      });
      if (!value) return;
      const u={}; if (value.price!=null) u.price=value.price; if (value.country) u.country=value.country;
      if (Object.keys(u).length) doBulk('update',u);
    });

    $('#bulk-add-csv').click(()=>$('#csv-file').click());
    $('#csv-file').change(function(){
      const file=this.files[0]; if (!file) return;
      Swal.fire({ title:'Upload CSV?', text:file.name, icon:'question', showCancelButton:true })
        .then(({isConfirmed})=>{
          if (!isConfirmed) return;
          const fm=new FormData(); fm.append('csv',file);
          $.ajax({
            url:`/admin/banks/${region}/${slug}banks/bulk-add`,
            type:'POST', data:fm, processData:false, contentType:false,
            success(res){
              const msg=res.success?`${res.added} added`:`${res.added} added, ${res.failed.length} failed`;
              Swal.fire({ icon:res.success?'success':'warning', title:msg, timer:2000, showConfirmButton:false });
              console.table(res.failed); initTable(currentStatus);
            },
            error(){ Swal.fire('Error','Upload failed','error'); }
          });
        });
    });

    $('#addBankBtn').click(()=>{
      $('#bankForm')[0].reset(); $('#bankId').val('');
      $('#bankFormLabel').text('Add Bank');
      new bootstrap.Offcanvas($('#bankFormCanvas')).show();
    });

    $(document).on('click','.edit-btn',function(){
      const id=$(this).data('id');
      $.getJSON(`/admin/banks/${region}/${slug}banks/${id}/edit`,({success,data})=>{
        if(!success) return Swal.fire('Error','No data','error');
        $('#bankId').val(data.id);
        $('#bankTypeSelect').val(data.acctype);
        $('#site').val(data.bankname);
        $('#balance').val(data.balance); $('#hiddenBalance').val(data.balance);
        $('#country').val(data.country);
        $('#infos').val(data.infos||'');
        data.infos==='Other'?$('#customInfosWrapper').collapse('show'):$('#customInfosWrapper').collapse('hide');
        $('#customInfos').val(data.custom_infos||'');
        $('#price').val(data.price); $('#hiddenPrice').val(data.price);
        $('#bankFormLabel').text('Edit Bank');
        new bootstrap.Offcanvas($('#bankFormCanvas')).show();
      }).fail(()=>Swal.fire('Error','Fetch failed','error'));
    });

    function handleRowAction(sel,suf,msg){
      $(document).on('click',sel,function(){
        const id=$(this).data('id');
        Swal.fire({title:'Are you sure?',icon:'question',showCancelButton:true})
          .then(({isConfirmed})=>{
            if(!isConfirmed) return;
            $.ajax({
              url:`/admin/banks/${region}/${slug}banks/${id}/${suf}`,
              type:'POST', contentType:'application/json', data:JSON.stringify({id}), dataType:'json'
            }).done(j=>{
              if(j.success){ showToast('success',msg); initTable(currentStatus); }
              else Swal.fire('Error',j.message||'Failed','error');
            });
          });
      });
    }
    handleRowAction('.delete-btn','delete','Deleted');
    handleRowAction('.mark-available-btn','update','Marked available');
    handleRowAction('.mark-available-url-btn','sold','Marked via URL');
    handleRowAction('.restore-btn','restore','Restored');

    $('#bankForm').on('submit',function(e){
      e.preventDefault();
      const data=Object.fromEntries(new FormData(this));
      const isEdit=Boolean(data.id);
      const url=`/admin/banks/${region}/${slug}banks/${isEdit?`${data.id}/update`:'add'}`;
      $.ajax({
        url,type:'POST',contentType:'application/json',
        data:JSON.stringify(data),dataType:'json'
      }).done(res=>{
        if(res.success){
          new bootstrap.Offcanvas($('#bankFormCanvas')).hide();
          showToast('success',isEdit?'Updated':'Added');
          initTable(currentStatus);
        } else Swal.fire('Error',res.message||'Save failed','error');
      }).fail(()=>Swal.fire('Error','Save failed','error'));
    });

    $('#infos').on('change',function(){
      $(this).val()==='Other'?$('#customInfosWrapper').collapse('show'):$('#customInfosWrapper').collapse('hide');
    });

    $(function(){
      updateBalanceAndPrice();
      setInterval(updateBalanceAndPrice,1000);
      initDrag();
      initTable('all');
    });

  })(jQuery);
  </script>

</body>
</html>