@extends('layouts/default')

@push('styles')
    @vite(['resources/css/loginregisterStyles.css'])
@endpush

@section('title') Registro @endsection

@section('content')
<main class="w-100 d-flex justify-content-center align-items-center _mainContainer">
    <div class="border shadow p-3 rounded _formContainer">
        <h1 class="text-center fs-3 fw-bold mb-3">Registrar</h1>
        <div class="d-flex align-items-center justify-content-center">
            <form method="POST" action="{{ route('register') }}" class="w-100">
                @csrf
                <!-- Name -->
                <div class="mb-3">
                    <label for="InputName" class="form-label fs-6 fw-semibold">Usuario</label>
                    <input type="text" class="form-control p-1" id="InputName" value = "{{ old('name') }}" name="name" required autocomplete="name">
                    @error('name')
                        <p class="bg-red-500 text-danger my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Email -->
                <div class="mb-3">
                    <label for="InputEmail" class="form-label fs-6 fw-semibold">Email</label>
                    <input type="email" class="form-control p-1" id="InputEmail" value = "{{ old('emil') }}" name="email" required autocomplete="username">
                    @error('email')
                        <p class="bg-red-500 text-danger my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="row mb-3">
                    <!-- Password -->
                    <div class="col">
                        <label for="InputPassword" class="form-label fs-6 fw-semibold">Contraseña</label>
                        <input type="password" class="form-control p-1" id="InputPassword" name="password" required autocomplete="new-password">
                        @error('password')
                            <p class="bg-red-500 text-danger my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Confirm Password -->
                    <div class="col">
                        <label for="InputConfirmPassword" class="form-label fs-6 fw-semibold">Confirma la contraseña</label>
                        <input type="password" class="form-control p-1" id="InputConfirmPassword" name="password_confirmation" required autocomplete="new-password">
                        @error('password_confirmation')
                            <p class="bg-red-500 text-danger my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="d-flex align-items-center justify-content-center mt-4" id="boxbutton">
                    <button type="submit" class=" w-100 btn btn-primary bg-primaryHeaderFooter fs-5 fw-bold" id="buttonUaslp">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
