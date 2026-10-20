<x-guest-layout>

<div class="auth-box">

    <h1 class="auth-title">CONECTARE</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- EMAIL / USERNAME -->
        <div>
            <label class="auth-label">Email sau Username</label>

            <input type="text"
                   name="login"
                   value="{{ old('login') }}"
                   class="auth-input"
                   required autofocus>

            @error('login')
                <p style="color:red; font-size:13px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- PAROLA -->
        <div style="margin-top:15px;">
            <label class="auth-label">Parolă</label>

            <input type="password"
                   name="password"
                   class="auth-input"
                   required>

            @error('password')
                <p style="color:red; font-size:13px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- REMEMBER -->
        <div style="margin-top:15px;">
            <label>
                <input type="checkbox" name="remember">
                <span style="font-size:14px;">Ține-mă minte</span>
            </label>
        </div>

        <!-- BUTTON -->
        <button class="auth-btn">
            Conectează-te
        </button>

        <!-- 🔥 LINKURI -->
        <div class="auth-links">

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    Ai uitat parola?
                </a>
            @endif

            <a href="{{ route('register') }}">
                Nu ai cont? Creează unul
            </a>

        </div>

    </form>

</div>

<style>
.auth-links{
    margin-top:20px;
    display:flex;
    justify-content:space-between;
    font-size:13px;
}

.auth-links a{
    color:#0070C8;
    text-decoration:none;
}

.auth-links a:hover{
    text-decoration:underline;
}
/* =========================
   AUTH BOX BASE
========================= */

.auth-box {
    max-width: 420px;
    margin: 60px auto;
    padding: 25px;
    font-family: 'Poppins', sans-serif;
}

.auth-title {
    font-family: 'Oswald', sans-serif;
    font-size: 42px;
    text-align: center;
    margin-bottom: 25px;
}

/* LABEL */
.auth-label {
    font-size: 14px;
    font-weight: 500;
    display: block;
    margin-bottom: 6px;
}

/* INPUT */
.auth-input {
    width: 100%;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid #e5e5e5;
    font-size: 15px;
    transition: 0.2s;
}

.auth-input:focus {
    outline: none;
    border-color: #4A7D89;
    box-shadow: 0 0 0 3px rgba(36, 190, 224, 0.2);
}

/* BUTTON */
.auth-btn {
    width: 100%;
    margin-top: 20px;
    padding: 12px;
    background: #111;
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 15px;
    cursor: pointer;
    transition: 0.2s;
}

.auth-btn:hover {
    background: #333;
}

/* REMEMBER */
.auth-box label span {
    font-size: 14px;
}

/* LINKS */
.auth-links {
    margin-top: 18px;
    display: flex;
    justify-content: space-between;
    font-size: 13px;
}

.auth-links a {
    color: #0070C8;
    text-decoration: none;
}

.auth-links a:hover {
    text-decoration: underline;
}

/* =========================
   TABLET
========================= */
@media (max-width: 1024px) {

    .auth-box {
        max-width: 380px;
        margin: 50px auto;
    }

    .auth-title {
        font-size: 36px;
    }
}

/* =========================
   MOBILE
========================= */
@media (max-width: 768px) {

    .auth-box {
        max-width: 100%;
        padding: 20px;
        margin: 30px auto;
    }

    .auth-title {
        font-size: 28px;
    }

    .auth-input {
        font-size: 14px;
    }

    .auth-btn {
        font-size: 14px;
    }

    .auth-links {
        flex-direction: column;
        gap: 10px;
        align-items: center;
    }
}

/* =========================
   SMALL MOBILE
========================= */
@media (max-width: 480px) {

    .auth-title {
        font-size: 24px;
    }

    .auth-input {
        font-size: 13px;
    }

    .auth-btn {
        font-size: 13px;
    }
}
</style>

</x-guest-layout>