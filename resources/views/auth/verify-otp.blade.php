<x-guest-layout>

<div class="auth-box">

    <h1 class="auth-title">VERIFICARE OTP</h1>

    <form method="POST" action="{{ route('password.verify.post') }}">
        @csrf

        <label class="auth-label">Email</label>

        <input type="email"
               name="email"
               value="{{ session('email') }}"
               class="auth-input"
               required>

        <label class="auth-label" style="margin-top:15px;">
            Cod OTP
        </label>

        <input type="text"
               name="otp"
               class="auth-input"
               required>

        @error('otp')
            <p style="color:red;">{{ $message }}</p>
        @enderror

        <button class="auth-btn">
            Verifică
        </button>

    </form>

</div>

</x-guest-layout>