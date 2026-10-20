<x-app-layout>

<div class="page-container">

    <h1 class="page-title">PROFILUL MEU</h1>

    <!-- AVATAR -->
@if($user->avatar)

<div class="avatar-section">
    <img src="{{ asset('storage/'.$user->avatar) }}"
         class="profile-avatar">
</div>

@endif

    <!-- USERNAME -->
    <h2 class="username">
        {{ $user->username }}
    </h2>

    <hr class="divider">

    <!-- INFO BOX -->
    <div class="info-box">

        <div class="info-row">
            <span class="label">Nume</span>
            <span class="value">{{ $user->name }}</span>
        </div>

        @if($user->phone)
        <div class="info-row">
            <span class="label">Telefon</span>
            <span class="value">{{ $user->phone }}</span>
        </div>
        @endif

        @if($user->email)
        <div class="info-row">
            <span class="label">Email</span>
            <span class="value">{{ $user->email }}</span>
        </div>
        @endif

    </div>

    @if($user->description)
    <div class="profile-details">
        <h3>Descriere</h3>

        <div class="details-box">
            {!! nl2br(e($user->description)) !!}
        </div>
    </div>
    @endif

    <!-- EDIT BUTTON -->
    <div class="edit-section">
        <a href="{{ route('profile.edit') }}" class="edit-btn">
            Editează profilul
        </a>
    </div>
    
<!-- ACTIVITATE -->
<h1 class="page-title">MECIURI CREATE</h1>

@forelse($myMatches as $booking)

<div class="booking-card"
     onclick="window.location='{{ route('matches.show', $booking->id) }}'">

    <div class="booking-left">

        <h2>
            {{ $booking->reservation->title }},
            {{ $booking->reservation->sport }}
        </h2>

        <p class="sub">
            {{ $booking->reservation->sector }},
            {{ $booking->reservation->address }}
        </p>

        <p>
            <strong>Creator:</strong>
            {{ $booking->user->username }}
        </p>

        <p><strong>Data:</strong> {{ $booking->date }}</p>

        <p>
            <strong>Ora:</strong>
            {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}
            -
            {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
        </p>
        {{-- 🔥 TEREN --}}
        <p>
            <strong>Teren:</strong>
            {{ optional($booking->terrain)->name ?? '—' }} -
            {{ optional($booking->terrain)->terrain_type == 'inside' ? 'Interior' : 'Exterior' }} -
            {{ optional($booking->terrain)->price ?? '—' }} lei/oră
        </p>

        <p>
            <strong>Dimensiune:</strong>
            {{ optional($booking->terrain)->size ?? '—' }}
        </p>


    </div>

</div>

@empty
<p>Nu ai meciuri create.</p>
@endforelse
<h1 class="page-title">PARTICIPĂRI</h1>

@forelse($participations as $p)

<div class="booking-card"
     onclick="window.location='{{ route('matches.show', $p->booking->id) }}'">

    <div class="booking-left">

        <h2>
            {{ $p->booking->reservation->title }},
            {{ $p->booking->reservation->sport }}
        </h2>

        <p class="sub">
            {{ $p->booking->reservation->sector }},
            {{ $p->booking->reservation->address }}
        </p>

        <p>
            <strong>Creator:</strong>
            {{ $p->booking->user->username }}
        </p>

        <p><strong>Data:</strong> {{ $p->booking->date }}</p>

        <p>
            <strong>Ora:</strong>
            {{ \Carbon\Carbon::parse($p->booking->start_time)->format('H:i') }}
            -
            {{ \Carbon\Carbon::parse($p->booking->end_time)->format('H:i') }}
        </p>
        {{-- 🔥 TEREN --}}
        <p>
    <strong>Teren:</strong>

    {{ optional($p->booking->terrain)->name ?? '—' }} -

    {{ optional($p->booking->terrain)->terrain_type == 'inside'
        ? 'Interior'
        : 'Exterior' }} -

    {{ optional($p->booking->terrain)->price ?? '—' }} lei/oră
</p>

<p>
    <strong>Dimensiune:</strong>

    {{ optional($p->booking->terrain)->size ?? '—' }}
</p>


    </div>

</div>

@empty
<p>Nu participi la niciun meci.</p>
@endforelse
</div>

<style>
    .booking-card {
    display: flex;
    justify-content: space-between;
    align-items: center;

    border: 1px solid #e5e5e5;
    border-radius: 20px;
    padding: 20px;
    margin-bottom: 20px;

    transition: 0.2s;
}

.booking-card:hover {
    background: #fafafa;
    cursor: pointer;
}

.booking-left {
    max-width: 80%;
}

.sub {
    color: #666;
    margin-bottom: 10px;
}
    .user-activity{
    margin-top:40px;
}

.section-title{
    font-size:22px;
    margin-bottom:15px;
    font-weight:600;
}

.activity-card{
    border:1px solid #e5e5e5;
    padding:15px;
    border-radius:12px;
    margin-bottom:10px;
    cursor:pointer;
    transition:0.2s;
}

.activity-card:hover{
    background:#f9f9f9;
}
    .avatar-section{
    text-align:center;
    margin-bottom:20px;
}

.profile-avatar{
    width:100px;
    height:100px;
    border-radius:50%;
    object-fit:cover;
}
    .profile-details {
    margin-top: 40px;
}

.profile-details h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.details-box {
    background: #f5f5f5;
    padding: 15px;
    border-radius: 12px;
    line-height: 1.6;
    color: #333;
}

.page-container {
    padding: 10px 40px;
}

/* TITLE */
.page-title {
    font-family: 'Oswald', sans-serif;
    font-size: 46px;
    text-align: center;
    margin-bottom: 40px;
    margin-top: 40px;
}

/* USERNAME */
.username {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 10px;
}

/* LINE */
.divider {
    margin-bottom: 30px;
}

/* INFO BOX */

/* ROW */
.info-row {
    background: #fafbff;
    padding: 12px 15px;
    border-radius: 15px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
}

/* LABEL */
.label {
    font-weight: 500;
}

/* VALUE */
.value {
    color: #333;
}

/* EDIT BUTTON */
.edit-section {
    margin-top: 30px;
}

.edit-btn {
    background: #000;
    color: white;
    padding: 10px 18px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
}

.edit-btn:hover {
    opacity: 0.8;
}

/* =========================
   TABLET
========================= */
@media (max-width: 1024px) {

    .page-container {
        padding: 20px;
    }

    .page-title {
        font-size: 38px;
        margin-bottom: 30px;
    }

    .username {
        font-size: 24px;
    }

    .info-box {
        max-width: 100%;
    }
}

/* =========================
   MOBILE
========================= */
@media (max-width: 768px) {

    .page-container {
        padding: 16px;
    }

    .page-title {
        font-size: 28px;
        margin-bottom: 25px;
    }

    .username {
        font-size: 20px;
        text-align: center;
    }

    .avatar-section {
        margin-bottom: 15px;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
    }

    /* INFO BOX devine full width */
    .info-box {
        width: 100%;
    }

    .info-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }

    .label {
        font-size: 13px;
        color: #777;
    }

    .value {
        font-size: 14px;
    }

    /* EDIT BUTTON */
    .edit-btn {
        width: 100%;
        display: block;
        text-align: center;
    }

    /* BOOKING CARDS */
    .booking-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        padding: 16px;
    }

    .booking-left {
        max-width: 100%;
    }

    .booking-left h2 {
        font-size: 18px;
    }

    .sub {
        font-size: 13px;
    }
}

/* =========================
   SMALL MOBILE
========================= */
@media (max-width: 480px) {

    .page-title {
        font-size: 22px;
    }

    .username {
        font-size: 18px;
    }

    .profile-avatar {
        width: 70px;
        height: 70px;
    }

    .booking-left h2 {
        font-size: 16px;
    }

    .sub {
        font-size: 12px;
    }
}
@media (max-width: 1024px) {

    .username {
        font-size: 22px;
    }

    .page-title {
        font-size: 38px;
    }

    .profile-details h3 {
        font-size: 17px;
    }

    .details-box {
        font-size: 14px;
    }
}
@media (max-width: 768px) {

    .username {
        font-size: 20px;
    }

    .page-title {
        font-size: 28px;
    }

    .profile-details h3 {
        font-size: 16px;
    }

    .details-box {
        font-size: 14px;
        line-height: 1.5;
    }
}
@media (max-width: 480px) {

    .username {
        font-size: 18px;
    }

    .page-title {
        font-size: 22px;
    }

    .profile-details h3 {
        font-size: 15px;
    }

    .details-box {
        font-size: 13px;
    }
}
@media (max-width: 1024px) {

    .booking-card h2 {
        font-size: 18px;
    }

    .booking-card p {
        font-size: 14px;
    }

    .sub {
        font-size: 13px;
    }
}
@media (max-width: 768px) {

    .booking-card h2 {
        font-size: 16px;
    }

    .booking-card p {
        font-size: 13px;
    }

    .sub {
        font-size: 12px;
    }

    .booking-card {
        padding: 14px;
    }
}
@media (max-width: 480px) {

    .booking-card h2 {
        font-size: 15px;
    }

    .booking-card p {
        font-size: 12px;
    }

    .sub {
        font-size: 11px;
    }
}

</style>

</x-app-layout>