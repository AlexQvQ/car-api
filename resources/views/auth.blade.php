@extends('template.template')
@section('content')
<div class="col-md-6 col-lg-4">
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h2 class="card-title text-center mb-4">Вход</h2>
            <form method="POST" action="{{ Route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input name="password" type="password" class="form-control" id="password" required>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Войти</button>
                </div>
            </form>
        </div>
    </div>
    <div class="text-center mt-3">
        <p>Нет аккаунта? <a href="{{ Route('registerPage') }}" class="text-decoration-none">Зарегистрироваться</a></p>
    </div>
</div>
@endsection
