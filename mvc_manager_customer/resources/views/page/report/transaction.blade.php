@extends('layouts.main')
@section('content')
    <main class="content" style="margin-top: -65px; margin-left: -40px">
        <div class="container-fluid p-0">
            <div class="row mb-4">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h1 class="h3">Thống kê giao dịch</h1>
                    <select id="chartType" class="form-select w-auto">
                        <option value="month">Theo tháng ({{ $currentYear }})</option>
                        <option value="year">Theo năm</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <canvas id="transactionChart" height="120"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('transactionChart').getContext('2d');

        const monthlyLabels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
            'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
        const monthlyData = @json($monthlyAmounts);
        const yearlyLabels = @json($years);
        const yearlyData = @json($yearlyAmounts);

        let chart;

        function formatCurrency(value) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
        }

        function renderChart(type) {
            if (chart) chart.destroy();

            const data = type === 'month' ? monthlyData : yearlyData;
            const labels = type === 'month' ? monthlyLabels : yearlyLabels;
            const title = type === 'month' ? 'Tổng số tiền giao dịch theo tháng ({{ $currentYear }})' : 'Tổng số tiền giao dịch theo năm';

            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Tổng số tiền (VND)',
                        data: data,
                        backgroundColor: 'rgba(255, 206, 86, 0.6)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: title
                        },
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return formatCurrency(context.parsed.y);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return formatCurrency(value);
                                }
                            }
                        }
                    }
                }
            });
        }

        renderChart('month');

        document.getElementById('chartType').addEventListener('change', function () {
            renderChart(this.value);
        });
    </script>
@endsection
