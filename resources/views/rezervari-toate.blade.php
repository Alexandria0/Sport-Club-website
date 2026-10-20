<x-app-layout>

<div class="page-container">
    <h1 class="page-title">TOATE REZERVĂRILE</h1>
<div class="bookings-grid">

    @forelse($bookings as $booking)

        <div class="booking-card" onclick="window.location='{{ route('rezervari.show', $booking->reservation->id) }}'">

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
    <strong>Utilizator:</strong>

    <a href="
        {{ $booking->user->id === auth()->id()
            ? route('profile.show')
            : route('profile.show.user', $booking->user->id)
        }}"
        class="user-link"
        onclick="event.stopPropagation()"
    >
        {{ $booking->user->username }}
    </a>
</p>

                <p><strong>Data:</strong> {{ $booking->date }}</p>

                <p>
                    <strong>Ora:</strong>
                    {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}
                    -
                    {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                </p>
<p>
    {{ $booking->terrain->name ?? '—' }} -
    {{ $booking->terrain->terrain_type == 'inside' ? 'Interior' : 'Exterior' }} -
</p>
<p><strong>Dimensiune:</strong> {{ $booking->terrain->size ?? '—' }}</p>
            </div>
            <div class="booking-right">

    <!-- @if(auth()->user()->role === 'admin')
    <form method="POST"
          action="{{ route('bookings.delete', $booking->id) }}"
          onclick="event.stopPropagation()">

        @csrf
        @method('DELETE')

        <button class="delete-btn">
            Șterge
        </button>
    </form>
    @endif -->

</div>

        </div>

    @empty
        <p>Nu există rezervări.</p>
    @endforelse
    </div>


    <h1 class="page-title">TOATE MECIURILE</h1>
<div class="bookings-grid">
    @forelse($matches as $match)

        <div class="booking-card" onclick="window.location='{{ route('matches.show', $match->id) }}'">

            <div class="booking-left">

                <h2>
                    {{ $match->reservation->title }},
                    {{ $match->reservation->sport }}
                </h2>

                <p class="sub">
                    {{ $match->reservation->sector }},
                    {{ $match->reservation->address }}
                </p>

                <p>
    <strong>Creator:</strong>

    <a href="
        {{ $match->user->id === auth()->id()
            ? route('profile.show')
            : route('profile.show.user', $match->user->id)
        }}"
        class="user-link"
        onclick="event.stopPropagation()"
    >
        {{ $match->user->username }}
    </a>
</p>

                <p><strong>Data:</strong> {{ $match->date }}</p>

                <p>
                    <strong>Ora:</strong>
                    {{ \Carbon\Carbon::parse($match->start_time)->format('H:i') }}
                    -
                    {{ \Carbon\Carbon::parse($match->end_time)->format('H:i') }}
                </p>
                <p>
</p>

<p>
    <strong>Tip teren:</strong>
    {{ $match->reservation->terrain_type == 'inside' ? 'Interior' : 'Exterior' }}
</p>
                <strong>Jucători:</br></strong>

                @foreach($match->participants as $p)
    <a href="
        {{ $p->user->id === auth()->id()
            ? route('profile.show')
            : route('profile.show.user', $p->user->id)
        }}"
        class="user-link"
        onclick="event.stopPropagation()"
    >
        {{ $p->user->username }}
    </a><br>
@endforeach

                <p class="details">
                    {!! \Illuminate\Support\Str::limit($match->details, 120) !!}
                </p>

            </div>
            <div class="booking-right">

    <!-- @if(auth()->user()->role === 'admin')
    <form method="POST"
          action="{{ route('matches.delete', $match->id) }}"
          onclick="event.stopPropagation()">

        @csrf
        @method('DELETE')

        <button class="delete-btn">
            Șterge
        </button> -->
    <!-- </form>
    @endif -->

</div>

        </div>

    @empty
        <p>Nu există meciuri.</p>
    @endforelse
</div>
</div>

<style>

.bookings-grid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

    .user-link {
    color: #0070C8;
    text-decoration: none;
    font-weight: 500;
}

.user-link:hover {
    text-decoration: underline;
}
.booking-card {
    position: relative;
}

.booking-right {
    display: flex;
    align-items: center;
}

.delete-btn {
    background: red;
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 10px;
    cursor: pointer;
}

.delete-btn:hover {
    opacity: 0.8;
}
.page-container {
    padding: 10px 40px;
}

/* TITLU */
.page-title {
    font-family: 'Oswald', sans-serif;
    font-size: 46px;
    text-align: center;
    margin-bottom: 40px;
}

/* CARD */
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

/* LEFT */
.booking-left {
    max-width: 80%;
}

.booking-left h2 {
    margin-bottom: 5px;
}

.sub {
    color: #666;
    margin-bottom: 10px;
}

.details {
    color: #777;
    margin-top: 10px;
}
@media (max-width: 1024px){
    .bookings-grid{
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px){
    .bookings-grid{
        grid-template-columns: 1fr;
    }
}
@media (max-width: 1024px) {

    .page-container {
        padding: 20px;
    }

    .page-title {
        font-size: 38px;
        margin-bottom: 30px;
    }

    .booking-card {
        padding: 16px;
    }

    .booking-left {
        max-width: 75%;
    }
}

/* TABLET + MOBILE */
@media (max-width: 768px) {

    .page-container {
        padding: 16px;
    }

    .page-title {
        font-size: 28px;
        margin-bottom: 25px;
    }

    /* CARD devine vertical */
    .booking-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .booking-left {
        max-width: 100%;
    }

    .booking-right {
        width: 100%;
        justify-content: flex-end;
    }

    /* USER + LINKS mai lizibile */
    .user-link {
        display: inline-block;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .booking-left h2 {
        font-size: 18px;
    }

    .sub {
        font-size: 14px;
    }

    .details {
        font-size: 13px;
    }

    /* jucători mai ok pe mobil */
    .booking-left br {
        display: none;
    }

    .booking-left a.user-link {
        display: inline-block;
        margin-right: 6px;
    }

}

/* SMALL MOBILE */
@media (max-width: 480px) {

    .page-title {
        font-size: 22px;
    }

    .booking-card {
        padding: 14px;
    }

    .booking-left h2 {
        font-size: 16px;
    }

    .sub {
        font-size: 13px;
    }

    .booking-left p {
        font-size: 13px;
    }

    .details {
        font-size: 12px;
    }

    .user-link {
        font-size: 13px;
    }
}

</style>

</x-app-layout>