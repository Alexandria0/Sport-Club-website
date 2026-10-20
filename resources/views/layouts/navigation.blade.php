<style>

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body{
        font-family: 'Montserrat', sans-serif;
    }
    .navbar{
    font-family: 'Montserrat', sans-serif;
}

    .navbar{
        width: 100%;
        background: white;
        padding: 22px 40px;
    }

    .navbar-container{
        max-width: 1200px;
        margin: 0 auto;

        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* LOGO */

    .navbar-logo{
        display: flex;
        align-items: center;
        gap: 10px;

        text-decoration: none;
    }

    .navbar-logo img{
        width: 30px;
        height: 30px;
        object-fit: contain;
    }

    .navbar-logo span{
        font-size: 18px;
        font-weight: 600;
        color: black;
    }

    /* MENU */

    .navbar-menu{
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .navbar-menu a{
    text-decoration: none;
    color: black;
    font-size: 14px;
    font-weight: 400;
    padding: 6px 16px;
    border-radius: 999px;
    transition: 0.25s ease;

    border: 1px solid transparent; /* IMPORTANT */
}

    .navbar-menu a:hover{
        border: 1px solid #d1d5db;
        background: #f7f7f7;
    }

    .navbar-menu .active-link{
        border: 1px solid #d1d5db;
        background: white;
    }

    /* RIGHT */

    .navbar-right a{
        text-decoration: none;

        background: black;
        color: white;

        padding: 8px 22px;

        border-radius: 999px;

        font-size: 13px;
        font-weight: 500;

        transition: 0.25s ease;
    }

    .navbar-right a:hover{
        opacity: 0.9;
    }

.navbar-user {
    position: relative;
    display: inline-block;
}

.user-trigger {
    background: black;
    color: white;
    padding: 8px 22px;
    border-radius: 999px;
    font-size: 13px;
    cursor: pointer;
}

/* dropdown ascuns */
.user-dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;

    background: white;
    border: 1px solid #ddd;
    border-radius: 10px;

    min-width: 160px;

    box-shadow: 0 10px 30px rgba(0,0,0,0.1);

    z-index: 1000;
}

/* link-uri */
.user-dropdown a,
.user-dropdown button {
    display: block;
    width: 100%;
    padding: 10px 14px;

    text-align: left;
    text-decoration: none;
    color: black;

    background: none;
    border: none;

    font-size: 14px;

    cursor: pointer;
}

.user-dropdown a:hover,
.user-dropdown button:hover {
    background: #f5f5f5;
}

/* SHOW ON HOVER */
.navbar-user:hover .user-dropdown {
    display: block;
}


</style>


<nav class="navbar">

    <div class="navbar-container">

        <!-- LOGO -->

        <a href="/" class="navbar-logo">

            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo"
            >

            <span>Sport Club</span>

        </a>
        <!-- MOBILE BUTTON -->
<div class="menu-toggle" onclick="toggleMenu()">
    ☰
</div>



        <!-- MENU -->

        <div class="navbar-menu" id="mobileMenu">

            <a href="/home" class="{{ request()->is('home') ? 'active-link' : '' }}">
    Acasă
</a>

            <a href="/despre-noi" class="{{ request()->is('despre-noi') ? 'active-link' : '' }}">
    Despre Noi
</a>

            <a href="/rezervari" class="{{ request()->is('rezervari') ? 'active-link' : '' }}">
    Rezervări
</a>
            <a href="/meciuri" class="{{ request()->is('meciuri') ? 'active-link' : '' }}">
    Meciuri
</a>

            <a href="/contacte" class="{{ request()->is('contacte') ? 'active-link' : '' }}">
    Contacte
</a>

        </div>
        


        <!-- RIGHT -->

        <div class="navbar-right">

           @auth
<div class="navbar-user">

    <div class="user-trigger">
        {{ Auth::user()->username }} ▾
    </div>

    <div class="user-dropdown">

    <a href="{{ route('profile.show') }}">
    Profil
</a>

{{-- ADMIN ONLY --}}
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('rezervari.create') }}">
            Adaugă un teren
        </a>
            <a href="{{ route('rezervari.toate') }}">
        Toate rezervările
        </a>
    @endif
    
    <a href="{{ route('bookings.my') }}">
    Rezervările mele
</a>

    

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit">
            Deconectare
        </button>
    </form>

</div>

</div>
@else

<a href="{{ route('login') }}">
    Conectare
</a>

@endauth
        </div>

    </div>

</nav>

    <script>
function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggle('show-menu');
}
</script>
<style>
    /* HAMBURGER */
.menu-toggle{
    display: none;
    font-size: 28px;
    cursor: pointer;
}

/* MOBILE */
@media(max-width: 900px){

    .navbar{
        padding: 18px 20px;
    }

    .navbar-container{
        display:flex;
        align-items:center;
        justify-content:space-between;
        flex-wrap: wrap;
        gap:15px;
    }

    .menu-toggle{
        display:block;
    }

    .navbar-menu{
        display:none;
        width:100%;
        flex-direction:column;
        gap:12px;
        margin-top:10px;
    }

    .navbar-menu.show-menu{
        display:flex;
    }

    .navbar-menu a{
        width:100%;
        text-align:center;
        padding:12px;
    }

    .navbar-right{
        width:100%;
    }

    .navbar-user{
        width:100%;
    }

    .user-trigger{
        width:100%;
        text-align:center;
    }

    .user-dropdown{
        position:static;
        width:100%;
        margin-top:10px;
    }
    
    
}
</style>