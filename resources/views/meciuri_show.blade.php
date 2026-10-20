<x-app-layout>

<div class="page-container">

    <!-- TITLE -->
    <h1 class="page-title">MECIURI</h1>

    <div class="reservation-title-row">

        <h2 class="reservation-title">
            {{ $match->reservation->title }}, {{ $match->reservation->sport }}
        </h2>

    </div>

    <!-- LOCATION -->
    <div class="reservation-location">
        {{ $match->reservation->sector }},
        {{ $match->reservation->address }}
    </div>

    <!-- DETALII -->
    <h3>Detalii</h3>
    <div class="reservation-details">
        {!! nl2br(e($match->reservation->details)) !!}
    </div>

    <!-- ORAR GENERAL -->
    <div class="reservation-schedule">
        <h3>Orar:</h3>
        {{ \Carbon\Carbon::parse($match->reservation->start_time)->format('H:i') }}
        -
        {{ \Carbon\Carbon::parse($match->reservation->end_time)->format('H:i') }}
    
        <br>
        <br>

    <!-- TIP TEREN -->
    
<div class="reservation-type">
    {{ $match->terrain->name ?? 'Teren necunoscut' }}
</div>
<div class="reservation-type">
    {{ $match->terrain->terrain_type == 'inside' ? 'Teren Interior' : 'Teren Exterior' }}
</div>


<div class="reservation-price">
    {{ $match->terrain->price ?? '—' }} lei/oră
</div>

@if($match->terrain->size ?? false)
<div class="reservation-type">
    Dimensiune: {{ $match->terrain->size }}
</div>
@endif

    </div>

    <hr style="margin:30px 0;">

    <!-- 🔥 DATE MECI (personalizate) -->
    <div class="match-details">

        <p>
            <strong>Data:</strong>
            {{ $match->date }}
        </p>

        <p>
            <strong>Oră meci:</strong>
            {{ \Carbon\Carbon::parse($match->start_time)->format('H:i') }}
            -
            {{ \Carbon\Carbon::parse($match->end_time)->format('H:i') }}
        </p>

        <p>
            <strong>Locuri ocupate:</strong>
            {{ $match->participants->count() }}
            /
            {{ $match->people }}
        </p>

       <p>
    <strong>Organizator:</strong>

    <a href="{{ auth()->id() === $match->organizer->id 
        ? route('profile.show') 
        : route('profile.show.user', $match->organizer->id) }}">

        <span>@</span>{{ $match->organizer->username }},
        {{ $match->organizer->name }}

    </a>
</p>
        <p>
            <strong>Detalii organizator:</strong>
        </p>

        <div class="reservation-details">
            {!! nl2br(e($match->details)) !!}
        </div>

    </div>

    <br>

    <!-- PARTICIPANTI -->
    <h3>Participanți înscriși:</h3>

    @foreach($match->participants as $p)
    <a href="{{ auth()->id() === $p->user->id 
        ? route('profile.show') 
        : route('profile.show.user', $p->user->id) }}">
        
        <span>@</span>{{ $p->user->username }},
        {{ $p->user->name }}
    </a>
    <br>
@endforeach

    <br>

    <div class="action-buttons">


<div class="action-buttons">

    @auth
        <form method="POST" action="{{ route('matches.join', $match->id) }}" id="joinForm">

            @csrf

            <!-- 🔹 CHECKBOX -->
            <label class="custom-checkbox">
                <input type="checkbox" required>
                Sunt de acord cu condițiile
            </label>

            <!-- 🔹 BUTOANE -->
            <div class="join-buttons">
                <button type="submit" class="confirm-btn">Înscrie-mă</button>

                <a href="{{ route('rezervari.show', $match->reservation->id) }}"
                   class="view-reservation-btn">
                    Vezi terenul
                </a>
            </div>

            <!-- 🔥 MESAJ MUTAT AICI -->
            <div id="joinMessage" class="info-message" style="display:none;"></div>

        </form>
    @else
        <a href="{{ route('login') }}" class="confirm-btn">
            Înscrie-mă
        </a>
    @endauth

</div>
</div>
<hr style="margin:40px 0;">

<h3 style="text-align:center;">COMENTARII</h3>

<!-- LISTA COMENTARII -->
 
<div class="comments-box">

    @foreach($match->comments as $c)
        <div class="comment">

            <div class="comment-header">
    <strong>
    <a href="{{ auth()->id() === $c->user->id 
        ? route('profile.show') 
        : route('profile.show.user', $c->user->id) }}">
        
        {{ $c->user->username }}
    </a>
</strong>

    @if(auth()->check() && (auth()->id() === $c->user_id || auth()->user()->role === 'admin'))
        <form method="POST"
      action="{{ route('matches.comment.delete', $c->id) }}"
      onsubmit="openConfirm(this, 'Sigur dorești să ștergi acest comentariu?')">
            @csrf
            @method('DELETE')

            <button class="delete-btn"
            onclick="event.stopPropagation()">
        Șterge
    </button>
        </form>
    @endif
</div>

            <p>{!! nl2br(e($c->comment)) !!}</p>

        </div>
    @endforeach

</div>
<!-- FORM -->
@auth
<form method="POST" action="{{ route('matches.comment', $match->id) }}">
    @csrf

    <textarea
        name="comment"
        class="comment-input"
        placeholder="Scrieți un comentariu"
        required
    ></textarea>

    <button class="comment-btn">Trimite</button>
</form>
@else
    <a href="{{ route('login') }}" class="comment-btn">
        Conectați-vă pentru a comenta
    </a>
@endauth

</div>



</x-app-layout>

<style>
    /* container vertical */
.action-buttons form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* checkbox + mesaj */
.join-top {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

/* butoane pe rand */
.join-buttons {
    display: flex;
    gap: 15px;
    align-items: center;
}
    .info-message {
    margin-top: 10px;
    padding: 10px;
    border-radius: 10px;
    background: #ffe0e0;
    color: #a10000;
    font-size: 14px;
}
    .action-buttons {
    display: flex;
    gap: 15px;
    align-items: center;
    margin-top: 15px;
}

/* facem form-ul să nu strice layout-ul */
.action-buttons form {
    margin: 0;
}

/* butoane egale */
.confirm-btn,
.view-reservation-btn {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 10px;
    text-align: center;
    font-size: 15px;
}

/* deja ai confirm-btn, dar îl ajustăm */
.confirm-btn {
    background: #0070C8;
    color: white;
    border: none;
}

.confirm-btn:hover {
    background: #004f8c;
}

/* uniformizăm view button */
.view-reservation-btn {
    background: #111;
    color: white;
}

.view-reservation-btn:hover {
    background: #333;
}
    a {
    color: #0070C8;
    text-decoration: none;
}

a:hover {
    cursor: pointer;
}
   
/* HEADER COMENTARII - CLEAN ALIGN */
.comment-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:10px;
    flex-wrap:nowrap; /* 🔥 important */
}

.comment-header form{
    margin-left:auto;
    display:flex;
    align-items:center;
}

/* USERNAME */
.comment-header strong a{
    font-weight:600;
    font-size:15px;
}

/* DELETE BUTTON - discret */
.delete-btn{
    background:none;
    border:none;
    color:#e53935;
    font-size:13px;
    cursor:pointer;
    padding:4px 6px;
    border-radius:6px;
    transition:0.2s;
}

.delete-btn:hover{
    background:#ffe5e5;
}
    .comments-box {
    margin-top: 30px;
}

.comment {
    border: 1px solid #e5e5e5;
    padding: 15px;
    border-radius: 15px;
    margin-bottom: 10px;
    margin-top: 10px;
    background: #fafafa;
}

.comment strong {
    display: block;
    margin-bottom: 5px;
}

.comment-input {
    width: 100%;
    margin-top: 15px;
    padding: 12px;
    border-radius: 15px;
    border: 1px solid #ccc;
    resize: none;
}

@media(max-width:480px){

    .comment-header strong a{
        font-size:13px;
    }

    .comment p{
        font-size:13px;
    }

    .delete-btn{
        font-size:11px;
    }
}

.comment-btn {
    margin-top: 10px;
    padding: 10px 20px;
    border-radius: 10px;
    border: none;
    background: #0070C8;
    color: white;
    cursor: pointer;
}

.comment-btn:hover {
    background: #004f8c;
}
    .view-reservation-btn {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 10px;
    background: #111;
    color: white;
    text-decoration: none;
    transition: 0.2s;
}

.view-reservation-btn:hover {
    background: #333;
}
.page-container {
    padding: 10px 40px;
}

.page-title {
    font-family: 'Oswald', sans-serif;
    font-size: 42px;
    text-align: center;
    font-weight: 600;
    font-size: 46px;
    margin-bottom: 40px;
}

button {
    padding: 8px 16px;
    border-radius: 20px;
    border: 1px solid #ccc;
    background: #fff;
    cursor: pointer;
}

button:hover {
    background: #f5f5f5;
}

.match-details p {
    margin-bottom: 5px;
    font-size: 16px;
}

/* PARTICIPANTI */
.participants-list {
    margin-top: 10px;
}

.participants-list p {
    background: #f5f5f5;
    padding: 8px 12px;
    border-radius: 10px;
    margin-bottom: 6px;
    font-size: 14px;
}

.confirm-btn {
    padding: 10px 20px;
    border-radius: 10px;
    border: none;
    background: #0070C8;
    color: white;
    cursor: pointer;
    transition: 0.2s;
}
.confirm-btn:hover {
    background: #004f8c;
}

.reservation-details {
    margin: 0px 0 20px;
    line-height: 1.6;
}
  .reservation-title {
    font-size: 32px;
    margin-bottom: 5px;
}

.reservation-location {
    color: #333;
    margin-bottom: 25px;
}

.reservation-schedule {
    margin-bottom: 30px;
    font-weight: 600;
}
@media(max-width:1024px){

    .page-container{
        padding:20px;
    }

    .page-title{
        font-size:60px;
        line-height:1;
        margin-bottom:35px;
    }

    .reservation-title{
        font-size:26px;
    }

    /* ACTION BUTTONS */
    .action-buttons{
        flex-direction:column;
        align-items:stretch;
        gap:10px;
    }

    .join-buttons{
        width:100%;
        justify-content:space-between;
    }

    .confirm-btn,
    .view-reservation-btn{
        width:100%;
        text-align:center;
    }

    /* COMMENTS */
    .comment-header{
        flex-direction:column;
        align-items:flex-start;
        gap:5px;
    }
}
@media(max-width:768px){

    .page-container{
        padding:16px;
    }

    .page-title{
        font-size:42px;
        margin-bottom:25px;
    }

    .reservation-title{
        font-size:22px;
        line-height:1.3;
    }

    .reservation-location{
        font-size:14px;
    }

    .reservation-details{
        font-size:14px;
        line-height:1.5;
    }

    .match-details p{
        font-size:14px;
    }

    /* ACTION BUTTONS */
    .join-buttons{
        flex-direction:column;
        gap:10px;
    }

    .confirm-btn,
    .view-reservation-btn{
        width:100%;
        font-size:14px;
        padding:10px;
        border-radius:12px;
    }

    .action-buttons{
        gap:10px;
    }

    /* CHECKBOX */
    .custom-checkbox{
        font-size:13px;
    }

    /* COMMENTS */
    .comment-input{
        font-size:14px;
        padding:10px;
    }

    .comment-btn{
        width:100%;
        padding:10px;
        font-size:14px;
    }

    .comment{
        padding:12px;
    }

    .delete-btn{
        font-size:12px;
    }
}
@media(max-width:480px){

    .page-title{
        font-size:32px;
    }

    .reservation-title{
        font-size:18px;
    }

    .match-details p{
        font-size:13px;
    }

    .comment{
        font-size:13px;
    }

    .comment-header a{
        font-size:13px;
    }
}
@media(max-width:768px){

    /* TITLU SECTIUNE */
    h3{
        font-size:16px;
        margin-top:20px;
    }

    /* LISTA PARTICIPANTI */
    .comments-box a,
    .participants-list p{
        font-size:14px;
    }

    /* LINKURI PARTICIPANTI */
    .comments-box a{
        display:block;
        margin-bottom:6px;
        word-break:break-word;
    }
}
@media(max-width:480px){

    h3{
        font-size:16px;
    }

    .comments-box a,
    .participants-list p{
        font-size:13px;
    }
}
@media(max-width:1024px){

    .reservation-schedule{
        font-size:16px;
        margin-bottom:20px;
    }

    .reservation-schedule h3{
        font-size:18px;
        margin-bottom:5px;
    }
}

@media(max-width:768px){

    .reservation-schedule{
        font-size:14px;
        margin-bottom:18px;
    }

    .reservation-schedule h3{
        font-size:16px;
    }
}

@media(max-width:480px){

    .reservation-schedule{
        font-size:13px;
    }

    .reservation-schedule h3{
        font-size:15px;
    }
}
.custom-checkbox{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:15px;
}


/* TITLU PARTICIPANTI DOAR PENTRU SECTIUNEA ASTA */
.page-container > h3 {
    font-size:16px;
    font-weight:600;
    margin-top:25px;
    margin-bottom:2px;
    color:#111;
}
@media(max-width:768px){

    .page-container > h3{
        font-size:15px;
        margin-top:20px;
        margin-bottom:8px;
    }

    .comments-box a{
        font-size:13px;
        display:block;
        margin-bottom:5px;
    }
}

@media(max-width:480px){

    .page-container > h3{
        font-size:14px;
    }

    .comments-box a{
        font-size:12px;
    }
}
.reservation-info{
    margin-top: 15px;
}

.reservation-price{
    margin-top: 2px;
    font-size: 16px;
    font-weight: 400;
    color: #111;
    line-height: 1.2;
}

.reservation-type{
    margin-top: 2px;
    font-size: 16px;
    color: #000000;
    line-height: 1.3;
    font-weight: 400;
}
/* =========================
   TABLET
========================= */
@media (max-width: 1024px) {

    .reservation-price{
        font-size: 17px;
    }

    .reservation-type{
        font-size: 15px;
    }
}

/* =========================
   MOBILE
========================= */
@media (max-width: 768px) {

    .reservation-price{
        font-size: 16px;
    }

    .reservation-type{
        font-size: 14px;
        margin-top: 4px;
    }
}

/* =========================
   SMALL MOBILE
========================= */
@media (max-width: 480px) {

    .reservation-price{
        font-size: 15px;
    }

    .reservation-type{
        font-size: 13px;
    }
}
</style>
<script>
document.addEventListener("DOMContentLoaded", function(){

    const isOrganizer =
        {{ auth()->check() && auth()->id() === $match->user_id ? 'true' : 'false' }};

    const alreadyJoined =
        {{ auth()->check() && $match->participants->contains('user_id', auth()->id()) ? 'true' : 'false' }};

    const isFull =
        {{ $match->participants->count() >= $match->people ? 'true' : 'false' }};

    const form = document.getElementById("joinForm");
    const messageBox = document.getElementById("joinMessage");

    if(form){

        form.addEventListener("submit", function(e){

            // 🔥 FULL
            if(isFull){
                e.preventDefault();

                messageBox.style.display = "block";
                messageBox.innerText =
                    "Nu mai sunt locuri disponibile.";

                return;
            }

            // 🔥 ORGANIZATOR
            if(isOrganizer){
                e.preventDefault();

                messageBox.style.display = "block";
                messageBox.innerText =
                    "Ești organizatorul și nu te poți înscrie.";

                return;
            }

            // 🔥 DEJA ÎNSCRIS
            if(alreadyJoined){
                e.preventDefault();

                messageBox.style.display = "block";
                messageBox.innerText =
                    "Te-ai înscris deja la acest meci.";

                return;
            }

        });

    }

});
</script>
