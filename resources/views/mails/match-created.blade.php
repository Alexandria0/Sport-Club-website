<div style="font-family: Arial; padding:20px;">

    <h2>{{ $booking->reservation->title }}</h2>

    <p>Un nou meci a fost creat pe platformă.</p>

    <hr>

    <p><strong>Locație:</strong> {{ $booking->reservation->sector }}, {{ $booking->reservation->address }}</p>
    <p><strong>Data:</strong> {{ $booking->date }}</p>
    <p><strong>Ora:</strong> {{ $booking->start_time }} - {{ $booking->end_time }}</p>
    <p><strong>Persoane necesare:</strong> {{ $booking->people }}</p>

    <hr>

    <!-- 🔥 BUTON -->
    <a href="{{ route('matches.show', $booking->id) }}"
       style="
            display:inline-block;
            padding:12px 20px;
            background:#16a34a;
            color:#fff;
            text-decoration:none;
            border-radius:6px;
            font-weight:bold;
       ">
        Vezi meciul
    </a>

</div>