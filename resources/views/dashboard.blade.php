@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid header-main mb-4">
    <h2 class="fw-light">Welcome to the dashboard</h2>
</div>

<div class="periodic-income row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border border-start border-primary">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Monthly Income</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($monthlyIncome, 2) }} VND</div>
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
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Annual Income</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($yearlyIncome, 2) }} VND</div>
                    </div>
                    <div class="col-auto"><i class="fa-solid fa-money-bill"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="chart-area container-fluid mb-4 mt-3">
    <h3 class="fw-light">Income Visualization</h3>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-8">
            <canvas id="yearlyIncomeChart"></canvas>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <canvas id="incomeChart"></canvas>
        </div>
    </div>
</div>

<section class="product-section container-fluid mb-4">
    <h3 class="fw-light">Products Overview</h3>
    <div class="row mt-4">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border border-start border-success product-card">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">New Products</div>
                    <ul class="list-group mt-2">
                        @foreach($newProducts as $product)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{ $product->name }}</span>
                                    <span class="badge bg-success">New</span>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border border-start border-warning product-card">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Most Selling Products</div>
                    <ul class="list-group mt-2">
                        @foreach($hotItems as $item => $quantity)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{ $item }}</span>
                                    <span class="badge bg-warning">{{ $quantity }} sold</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Yearly Income Chart
        const yearlyIncomeCtx = document.getElementById('yearlyIncomeChart').getContext('2d');
        const yearlyIncomeChart = new Chart(yearlyIncomeCtx, {
            type: 'line',
            data: {
                labels: Object.keys(@json($yearlyIncomeData)),
                datasets: [{
                    label: 'Yearly Income',
                    data: Object.values(@json($yearlyIncomeData)),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });

        // Monthly Income Pie Chart
        const incomeCtx = document.getElementById('incomeChart').getContext('2d');
        const incomeChart = new Chart(incomeCtx, {
            type: 'pie',
            data: {
                labels: Object.keys(@json($monthlyIncomeData)),
                datasets: [{
                    label: 'Monthly Income',
                    data: Object.values(@json($monthlyIncomeData)),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    });
</script>
@endpush
