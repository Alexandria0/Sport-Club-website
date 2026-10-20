<x-app-layout>

<div class="page-container">

    <h1 class="page-title">PROFIL UTILIZATOR</h1>

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

        <!-- NUME -->
        <div class="info-row">
            <span class="label">Nume</span>
            <span class="value">{{ $user->name }}</span>
        </div>

        <!-- TELEFON -->
        @if($user->phone)
        <div class="info-row">
            <span class="label">Telefon</span>
            <span class="value">{{ $user->phone }}</span>
        </div>
        @endif

        <!-- EMAIL -->
        @if($user->email)
        <div class="info-row">
            <span class="label">Email</span>
            <span class="value">{{ $user->email }}</span>
        </div>
        @endif

    </div>

    <!-- DESCRIERE + INFO -->
@if($user->description)
<div class="profile-details">
    <h3>Descriere</h3>

    <div class="details-box">
        {!! nl2br(e($user->description)) !!}
    </div>
</div>
@endif


<!-- ACTIVITATE -->
 @if($user->show_activity)
<div class="activity-section">

    <h1 class="page-title">MECIURI CREATE</h1>

    @forelse($bookings as $booking)

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
            <p>
    <strong>Teren:</strong>
    {{ $booking->terrain->name ?? '—' }} -
    {{ $booking->terrain->terrain_type == 'inside' ? 'Interior' : 'Exterior' }} -
    {{ $booking->terrain->price ?? '—' }} lei/oră
</p>

<p>
    <strong>Dimensiune:</strong>
    {{ $booking->terrain->size ?? '—' }}
</p>

        </div>

    </div>

    @empty
    <p>Nu există meciuri create.</p>
    @endforelse


    <h1 class="page-title">MECIURI LA CARE PARTICIPĂ</h1>

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
   <p>
    <strong>Teren:</strong>
    {{ optional($p->booking->terrain)->name ?? '—' }} -
{{ optional($p->booking->terrain)->terrain_type == 'inside' ? 'Interior' : 'Exterior' }} -
{{ optional($p->booking->terrain)->price ?? '—' }} lei/oră
</p>

<p>
    <strong>Dimensiune:</strong>
    {{ $p->booking->terrain->size ?? '—' }}
</p>

        </div>

    </div>

    @empty
    <p>Nu participă la niciun meci.</p>
    @endforelse

</div>
@endif

</div>

<style>
    .activity-section{
    margin-top:40px;
}

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


/* ROW */
.info-row {
    background: #fafbff;
    padding: 12px 15px;
    display: flex;
    border-radius: 15px;
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

/* =========================
   TABLET (<=1024px)
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
        font-size: 22px;
    }

    .profile-details h3 {
        font-size: 17px;
    }

    .details-box {
        font-size: 14px;
    }

    .info-box {
        max-width: 100%;
    }

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

/* =========================
   MOBILE (<=768px)
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

    .profile-avatar {
        width: 80px;
        height: 80px;
    }

    .profile-details h3 {
        font-size: 16px;
    }

    .details-box {
        font-size: 14px;
        line-height: 1.5;
    }

    /* INFO */
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

    /* BOOKING CARDS */
    .booking-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        padding: 14px;
    }

    .booking-left {
        max-width: 100%;
    }

    .booking-card h2 {
        font-size: 16px;
    }

    .booking-card p {
        font-size: 13px;
    }

    .sub {
        font-size: 12px;
    }
}

/* =========================
   SMALL MOBILE (<=480px)
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

    .profile-details h3 {
        font-size: 15px;
    }

    .details-box {
        font-size: 13px;
    }

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