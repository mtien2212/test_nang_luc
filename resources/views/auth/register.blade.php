@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Đăng ký</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form id="registerForm" method="POST" action="/register" novalidate>
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Họ tên</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <div class="invalid-feedback">Vui lòng nhập họ tên.</div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback">Vui lòng nhập email hợp lệ.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="6">
            <div class="invalid-feedback">Mật khẩu tối thiểu 6 ký tự.</div>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="6">
            <div class="invalid-feedback">Mật khẩu xác nhận không khớp.</div>
        </div>
        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
</div>
<script>
// Validate realtime
const form = document.getElementById('registerForm');
const password = document.getElementById('password');
const password_confirmation = document.getElementById('password_confirmation');
form.addEventListener('input', function(e) {
    if (password.value.length < 6) {
        password.setCustomValidity('Mật khẩu tối thiểu 6 ký tự.');
    } else {
        password.setCustomValidity('');
    }
    if (password.value !== password_confirmation.value) {
        password_confirmation.setCustomValidity('Mật khẩu xác nhận không khớp.');
    } else {
        password_confirmation.setCustomValidity('');
    }
});
form.addEventListener('submit', function(e) {
    if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
    }
    form.classList.add('was-validated');
});
</script>
@endsection
