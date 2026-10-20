<x-guest-layout>

<div class="auth-box">

    <h1 class="auth-title">PAROLĂ NOUĂ</h1>

    <form method="POST"
          action="{{ route('password.update.custom') }}">

        @csrf

        <input type="hidden"
               name="email"
               value="{{ $email }}">

        <label class="auth-label">
            Parolă nouă
        </label>

        <input type="password"
               name="password"
               class="auth-input"
               required>

        <label class="auth-label" style="margin-top:15px;">
            Confirmă parola
        </label>

        <input type="password"
               name="password_confirmation"
               class="auth-input"
               required>

        @error('password')
            <p style="color:red;">{{ $message }}</p>
        @enderror

        <button class="auth-btn">
            Schimbă parola
        </button>

    </form>

</div>

</x-guest-layout>