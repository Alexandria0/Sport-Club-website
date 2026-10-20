<x-guest-layout>

<div class="auth-box">

    <h1 class="auth-title">RESETARE PAROLĂ</h1>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label class="auth-label">Email</label>

        <input type="email"
               name="email"
               class="auth-input"
               required>

        @error('email')
            <p style="color:red;">{{ $message }}</p>
        @enderror

        <button class="auth-btn">
            Trimite cod
        </button>

    </form>

</div>

</x-guest-layout>