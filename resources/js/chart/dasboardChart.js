<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/dashboard.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <title>Admin Dashboard</title>
    </head>
<body>
    <nav class="vertical-nav">
        <a class="navbar-brand text-white ms-3 mb-4" href="#">Admin Dashboard</a>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Orders</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Admins</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Admin registration</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Log Out</a></li>
        </ul>
    </nav>
    <div class="main-content bg-white">
        <header class="d-flex justify-content-between align-items-center p-3 header-main">
            <div class="search-form">
                <input type="text" class="form-control" placeholder="Search...">
            </div>
            <div class="admin-info d-flex align-items-center">
                <span class="admin-name me-2">Admin Name</span>
                <img src="https://via.placeholder.com/50" alt="Admin Image" class="admin-img">
            </div>
        </header>
        <section class="main-section">
            <div class="container-fluid header-main mb-4">
                <h2 class="fw-light">Welcome to the dashboard</h2>
            </div>
            <div class="periodic-income row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border border-start border-primary">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Monthly income</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">2 trieu!</div>
                                </div>
                                <div class="col-auto"><i class="fa-solid fa-money-bill"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border border-start border-primary">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Annual income</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">2 trieu!</div>
                                </div>
                                <div class="col-auto"><i class="fa-solid fa-money-bill"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chart-area container-fluid mb-4">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-8">
                        <canvas id="yearlyIncomeChart"></canvas> <!-- Yearly Income Chart -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <canvas id="incomeChart"></canvas>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer mt-auto py-3">
            <div class="container">
                <span class="text-muted">© 2024 Your Company</span>
            </div>
        </footer>
    </div>
    
    <script>
        // Your JavaScript for Chart.js goes here
    </script>
</body>
</html>
