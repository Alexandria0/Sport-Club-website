<x-app-layout>

<div class="page-container">

    <h1 class="page-title">REZERVĂRILE MELE</h1>

    <div class="bookings-grid">
    @forelse($bookings as $booking)

        <div class="booking-card"
             onclick="window.location='{{ route('rezervari.show', $booking->reservation->id) }}'">

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
                    <strong>Data:</strong> {{ $booking->date }}
                </p>

                <p>
                    <strong>Ora:</strong>
                    {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}
                    -
                    {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                </p>
 <p>
                <strong>Teren:</strong>
                {{ $booking->terrain->name ?? '—' }}
            </p>

            <p>
                <strong>Tip:</strong>
                {{ $booking->terrain->terrain_type == 'inside'
                    ? 'Interior'
                    : 'Exterior' }}
            </p>

            <p>
                <strong>Dimensiune:</strong>
                {{ $booking->terrain->size ?? '—' }}
            </p>

                <!-- <p class="details">
                    {!! Str::limit($booking->reservation->details, 120) !!}
                </p> -->

            </div>

            <div class="booking-right">

                <form method="POST"
      action="{{ route('bookings.delete', $booking->id) }}"
      onsubmit="return confirm('Sigur dorești să anulezi rezervarea?')">
                    @csrf
                    @method('DELETE')

                    <button class="delete-btn"
            onclick="event.stopPropagation()">
        Anulează
    </button>
                </form>

            </div>

        </div>

    @empty
        <p>Nu ai rezervări.</p>
    @endforelse
    </div>


   <!-- ⚽ MECIURILE MELE -->
<h1 class="page-title" style="margin-top: 20px;">MECIURILE MELE</h1>

<div class="bookings-grid">

@forelse($myMatches as $match)

    <div class="booking-card match-card"
         onclick="window.location='{{ route('matches.show', $match->id) }}'">

        <div class="booking-left">

            <h2>
                {{ $match->reservation->sport }}, {{ $match->reservation->title }}
            </h2>

            <p>
                {{ $match->reservation->sector }},
                {{ $match->reservation->address }}
            </p>

            <br>

            <p>
                <strong>Data:</strong> {{ $match->date }}
            </p>

            <p>
                <strong>Ora:</strong>
                {{ \Carbon\Carbon::parse($match->start_time)->format('H:i') }}
                -
                {{ \Carbon\Carbon::parse($match->end_time)->format('H:i') }}
            </p>

            <p>
                <strong>Teren:</strong>
                {{ $match->terrain->name ?? '—' }}
            </p>

            <p>
                <strong>Tip:</strong>
                {{ $match->terrain->terrain_type == 'inside'
                    ? 'Interior'
                    : 'Exterior' }}
            </p>

            <p>
                <strong>Dimensiune:</strong>
                {{ $match->terrain->size ?? '—' }}
            </p>

            <br>

            <p>
                <strong>Jucători:</strong>
                {{ $match->participants->count() }}/{{ $match->people }}
            </p>

        </div>

        <div class="booking-right">

            <form method="POST"
                  action="{{ route('matches.delete', $match->id) }}"
                  onsubmit="return confirm('Sigur dorești să anulezi meciul?')">

                @csrf
                @method('DELETE')

                <button class="delete-btn"
                        onclick="event.stopPropagation()">
                    Anulează
                </button>

            </form>

        </div>

    </div>

@empty
    <p>Nu ai meciuri.</p>
@endforelse

</div>
            <h1 class="page-title" style="margin-top: 20px;">PARTICIPĂRILE MELE</h1>
            <div class="bookings-grid">


@forelse($joinedMatches as $match)

    <div class="booking-card"
         onclick="window.location='{{ route('matches.show', $match->id) }}'">

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
                <strong>Data:</strong> {{ $match->date }}
            </p>

            <p>
                <strong>Ora:</strong>
                {{ \Carbon\Carbon::parse($match->start_time)->format('H:i') }}
                -
                {{ \Carbon\Carbon::parse($match->end_time)->format('H:i') }}
            </p>
            <p>
    <strong>Teren:</strong>
    {{ $match->terrain->name ?? '—' }}
</p>

<p>
    <strong>Tip:</strong>
    {{ optional($match->terrain)->terrain_type == 'inside'
        ? 'Interior'
        : 'Exterior' }}
</p>

<p>
    <strong>Dimensiune:</strong>
    {{ $match->terrain->size ?? '—' }}
</p>
<br>

            <p>
                <strong>Locuri:</strong>
                {{ $match->participants->count() }}/{{ $match->people }}
            </p>

            <p class="details">
                {!! Str::limit($match->details, 120) !!}
            </p>

        </div>

        <div class="booking-right">

            <form method="POST"
      action="{{ route('matches.leave', $match->id) }}"
      onsubmit="return confirm('Sigur dorești să ieși din acest meci?')">
                @csrf
                @method('DELETE')

                <button class="delete-btn"
            onclick="event.stopPropagation()">
        Ieși din meci
    </button>
            </form>

        </div>

    </div>


@empty
    <p>Nu participi la niciun meci.</p>
@endforelse

</div>
</div>

<style>

.page-container {
    padding: 10px 40px;
}

.page-title {
    font-family: 'Oswald', sans-serif;
    font-size: 46px;
    text-align: center;
    margin-bottom: 20px;
}

.section-title {
    font-size: 22px;
    margin-bottom: 20px;
}
.bookings-grid{
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}

/* CARD FULL WIDTH */
.booking-card{
    flex-direction: column;
    align-items: flex-start;
    height: 100%;

    background: #fff;
    border:1px solid #e5e5e5;
    padding:20px;
    border-radius:20px;
    cursor:pointer;
    transition:0.2s;
}

 .booking-card:hover {
    background: #fafafa;
}

/* LEFT */
/* .booking-left {
    max-width: 80%;
} 

.booking-left h2 {
    margin-bottom: 5px;
} */

.sub {
    color: #666;
    margin-bottom: 10px;
}

.details {
    color: #777;
    margin-top: 10px;
}

/* RIGHT */
.booking-right{
    width:100%;
    margin-top:auto;
    display:flex;
    justify-content:flex-end;
}

/* DELETE */
.delete-btn {
    background: red;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 12px;
    cursor: pointer;
}

.delete-btn:hover {
    opacity: 0.8;
}
/* RESPONSIVE */
@media (max-width: 1024px){
    .page-container{
        padding: 20px;
    }

    .page-title{
        font-size: 36px;
    }
}

@media (max-width: 768px){

    .page-container{
        padding: 15px;
    }

    .page-title{
        font-size: 28px;
        line-height: 1.2;
        margin-bottom: 15px;
    }

    .booking-card{
        flex-direction: column;
        align-items: stretch;
        padding: 18px;
        gap: 15px;
    }

    .booking-left h2{
        font-size: 18px;
        line-height: 1.3;
    }

    .booking-left p{
        font-size: 15px;
    }

    .booking-right{
        width: 100%;
        justify-content: stretch;
    }

    .delete-btn{
        width: 100%;
        padding: 14px;
        font-size: 16px;
    }

    .match-badge{
        width: fit-content;
    }
}

@media (max-width: 480px){

    .page-container{
        padding: 10px;
    }

    .page-title{
        font-size: 22px;
    }

    .booking-card{
        padding: 14px;
        border-radius: 15px;
    }

    .booking-left h2{
        font-size: 16px;
    }

    .booking-left p,
    .sub,
    .details{
        font-size: 14px;
    }

    .delete-btn{
        font-size: 14px;
        padding: 12px;
        border-radius: 10px;
    }
}
</style>

</x-app-layout>