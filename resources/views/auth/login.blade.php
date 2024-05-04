@extends('layouts/default')

@push('styles')
    @vite(['resources/css/loginregisterStyles.css'])
@endpush

@section('title') Inicio de sesión @endsection

@section('content')
<main class="w-100 d-flex justify-content-center align-items-center _mainContainer">
    <div class="border shadow p-3 rounded _formContainer">
        <h1 class="text-center fs-3 fw-bold mb-5">Iniciar sesión</h1>
        <div class="d-flex align-items-center justify-content-center">
            <form method="POST" action="{{ route('login') }}" class="w-100">
                @csrf
                <!-- Email Address -->
                <div class="mb-3">
                    <label for="InputName" class="form-label fs-6 fw-semibold">Usuario</label>
                    <input type="text" class="form-control p-2" id="InputName" aria-describedby="nameHelp" value = "{{ old('name') }}" name="name">
                    @error('name')
                        <p class="bg-red-500 text-danger my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password -->
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label fs-6 fw-semibold">Contraseña</label>
                    <input type="password" class="form-control p-2" id="exampleInputPassword1" name="password">
                    @error('password')
                        <p class="bg-red-500 text-danger my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Remember Me -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="remember">
                    <label class="form-check-label" for="gridCheck">
                        Mantener sesión abierta 
                    </label>
                </div>
                <div class="d-flex align-items-center justify-content-center mt-3" id="boxbutton">
                    <button type="submit" class=" w-100 btn btn-primary bg-primaryHeaderFooter fs-5 fw-bold" id="buttonUaslp">Iniciar sesión</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection