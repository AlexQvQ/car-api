@extends('template.template')
@section('content')
<div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4">Регистрация</h2>
                        <form method="POST" action="{{ Route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Имя</label>
                                <input name="name" type="text" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Пароль</label>
                                <input name="password" type="password" class="form-control" id="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Должность</label>
                                <input name="vacancy" type="text" class="form-control" id="password" required>
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p>Уже есть аккаунт? <a href="#" class="text-decoration-none">Войти</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
