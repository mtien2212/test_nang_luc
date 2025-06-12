@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Dashboard</h2>
    @if (session('success'))
        <div class="toast align-items-center text-bg-success border-0 show position-fixed top-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true" id="successToast" style="z-index: 1055;">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var toastEl = document.getElementById('successToast');
                if (toastEl) {
                    var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                    toast.show();
                }
            });
        </script>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng số người dùng</h5>
                    <p class="card-text display-6">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng số lượt đăng nhập</h5>
                    <p class="card-text display-6">{{ $totalLogins }}</p>
                </div>
            </div>
        </div>
    </div>
    <canvas id="loginChart" width="400" height="200"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// (Tùy chọn) Vẽ biểu đồ nếu muốn, dữ liệu mẫu
const ctx = document.getElementById('loginChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Users', 'Logins'],
        datasets: [{
            label: 'Thống kê',
            data: [{{ $totalUsers }}, {{ $totalLogins }}],
            backgroundColor: ['#007bff', '#28a745']
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } }
    }
});
</script>
@endsection
