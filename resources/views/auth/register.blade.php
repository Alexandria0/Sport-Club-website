<x-guest-layout>


<div class="auth-box">

    <h1 class="auth-title">ÎNREGISTRARE</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- NUME -->
        <div>
            <label class="auth-label">Nume</label>

            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="auth-input"
                   required autofocus>

            @error('name')
                <p style="color:red; font-size:13px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- USERNAME -->
        <div style="margin-top:15px;">
            <label class="auth-label">Username</label>

            <input type="text"
                   name="username"
                   value="{{ old('username') }}"
                   class="auth-input"
                   required>

            @error('username')
                <p style="color:red; font-size:13px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- EMAIL -->
        <div style="margin-top:15px;">
            <label class="auth-label">Email</label>

            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="auth-input"
                   required>

            @error('email')
                <p style="color:red; font-size:13px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- TELEFON -->
        <div style="margin-top:15px;">
            <label class="auth-label">Telefon</label>

            <input type="text"
                   name="phone"
                   value="{{ old('phone') }}"
                   class="auth-input"
                   required>

            @error('phone')
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

        <!-- CONFIRMARE -->
        <div style="margin-top:15px;">
            <label class="auth-label">Confirmă parola</label>

            <input type="password"
                   name="password_confirmation"
                   class="auth-input"
                   required>

            @error('password_confirmation')
                <p style="color:red; font-size:13px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- BUTTON -->
        <button class="auth-btn">
            Creează cont
        </button>

        <!-- LINKURI -->
        <div class="auth-links">

            <a href="{{ route('login') }}">
                Ai deja cont? Conectează-te
            </a>

        </div>

    </form>

</div>

<style>
.auth-box {
    margin-top: 60px; 
    margin-bottom: 60px;
}
.auth-links{
    margin-top:20px;
    display:flex;
    justify-content:center;
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
   AUTH BOX BASE (REGISTER)
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

/* ERROR */
.auth-box p {
    font-size: 13px;
    color: red;
    margin-top: 6px;
}

/* LINKS */
.auth-links {
    margin-top: 18px;
    display: flex;
    justify-content: center;
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