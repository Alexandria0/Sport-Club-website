<x-app-layout>

<style>

.page-container {
    font-family: 'Poppins', sans-serif;
    padding: 10px 40px;
    width: 100%;
}

/* TITLE */
.page-title {
    font-family: 'Oswald', sans-serif;
    font-size: 42px;
    text-align: center;
    font-weight: 600;
    font-size: 46px;
    margin-bottom: 40px;
}

/* FILTER BOX */
.filters-box {
    background: #fff;
    border: 1px solid #e5e5e5;
    padding: 20px;
    border-radius: 20px;
    display: flex;
    gap: 20px;
    margin-bottom: 65px;
}

.filter-group {
    flex: 1;
}

.filter-group label {
    font-size: 16px;
    font-weight: 200;
}

.form-input {
    width: 100%;
    padding: 10px 14px;
    border-radius: 12px;
    border: 1px solid #e5e5e5;
    /* background: #fff; */
    margin-top: 4px;
    /* color: #000; */
}

/* CARD */
.reservation-card {
    background: #fff;
    border: 1px solid #e5e5e5;
    padding: 20px 20px;
    border-radius: 20px;
    margin-bottom: 30px;
}

/* IMAGE */
.reservation-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 20px;
}

/* TEXT */
.reservation-info {
    margin-top: 10px;
}

.reservation-title {
    font-weight: 500;
    font-size: 16px;
    text-transform: uppercase;
}

.reservation-sub {
    color: #666;
    font-size: 14px;
}

.form-input:focus {
    outline: none;
    border-color: #4A7D89; 
    box-shadow: 0 0 0 3px rgba(36, 190, 224, 0.2); 
}
.reservation-card {
    cursor: pointer;
}
/* =========================================
   TABLET
========================================= */

@media(max-width:1024px){

    .page-container{
        padding:20px;
    }

    .page-title{
        font-size:60px;
        line-height:1;
        margin-bottom:35px;
    }

    /* FILTERS */
    .filters-box{
        flex-direction:column;
        gap:18px;
        padding:24px;
        margin-bottom:50px;
    }

    .filter-group{
        width:100%;
    }

    .form-input{
        padding:12px 14px;
        font-size:15px;
    }

    /* CARDS */
    .reservation-card{
        padding:18px;
        margin-bottom:24px;
    }

    .reservation-image{
        height:280px;
    }

    .reservation-title{
        font-size:18px;
    }

    .reservation-sub{
        font-size:15px;
    }
}


/* =========================================
   MOBILE
========================================= */

@media(max-width:768px){

    .page-container{
        padding:16px;
    }

    .page-title{
        font-size:42px;
        margin-bottom:25px;
    }

    .filters-box{
        padding:18px;
        border-radius:18px;
        margin-bottom:35px;
    }

    .filter-group label{
        font-size:14px;
    }

    .form-input{
        font-size:14px;
        border-radius:10px;
    }

    .reservation-card{
        padding:14px;
        border-radius:18px;
    }

    .reservation-image{
        height:220px;
        border-radius:16px;
    }

    .reservation-title{
        font-size:16px;
        line-height:1.4;
    }

    .reservation-sub{
        font-size:14px;
    }
}


/* =========================================
   SMALL MOBILE
========================================= */

@media(max-width:480px){

    .page-title{
        font-size:32px;
    }

    .filters-box{
        padding:16px;
        gap:14px;
    }

    .reservation-image{
        height:180px;
    }

    .reservation-title{
        font-size:15px;
    }

    .reservation-sub{
        font-size:13px;
    }
}
/* GRID CONTAINER */
.reservations-grid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

/* CARD FULL WIDTH în grid */
.reservation-card{
    margin-bottom: 0; /* scoatem spațiul vechi */
}

/* =========================
   TABLET
========================= */
@media(max-width:1024px){
    .reservations-grid{
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
}

/* =========================
   MOBILE
========================= */
@media(max-width:768px){
    .reservations-grid{
        grid-template-columns: 1fr;
        gap: 16px;
    }
}
/* ===== ANIMAȚII REZERVĂRI ===== */
.reveal {
    opacity: 0;
    transform: translateY(35px);
    transition: all 0.7s ease;
    will-change: transform, opacity;
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}


</style>
@php
    $selectedSport = request('sport');
@endphp
<div class="page-container">

    <h1 class="page-title">TERENURI</h1>

    <div class="filters-box">
        <div class="filter-group">
            <label>Sportul</label>
            <select id="filterSport" class="form-input">
    <option value="">Alegeți sportul</option>

    @foreach($reservations->unique('sport') as $r)
        <option value="{{ $r->sport }}" {{ $r->sport == $selectedSport ? 'selected' : '' }}>
            {{ $r->sport }}
        </option>
    @endforeach
</select>
        </div>

        <div class="filter-group">
            <label>Sectorul</label>
            <select id="filterSector" class="form-input" >
                <option value="">Alegeți sectorul</option>
                @foreach($reservations->unique('sector') as $r)
                    <option value="{{ $r->sector }}">{{ $r->sector }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="reservations-grid">
    @foreach($reservations as $r)
        <div class="reservation-card reveal"
     onclick="window.location='{{ route('rezervari.show', $r->id) }}'"
             data-sport="{{ $r->sport }}"
             data-sector="{{ $r->sector }}">

            <img class="reservation-image"
                 src="{{ asset('storage/'.$r->background_image) }}">

            <div class="reservation-info">

    <div class="reservation-title">
        {{ strtoupper($r->sport) }} - {{ $r->title }}
    </div>

  @php
    $terrains = $r->terrains ?? collect();

    // tipuri existente
    $insideCount = $terrains->where('terrain_type', 'inside')->count();
    $outsideCount = $terrains->where('terrain_type', 'outside')->count();

    // prețuri
    $prices = $terrains->pluck('price')->unique()->sort()->values();

    $minPrice = $prices->first();
    $maxPrice = $prices->last();
@endphp

<div class="reservation-sub">

    {{-- TIPURI TEREN (doar dacă există) --}}
    @if($outsideCount > 0)
        Exterior: {{ $outsideCount }} {{ $outsideCount == 1 ? 'teren' : 'terenuri' }}
    @endif

    @if($insideCount > 0 && $outsideCount > 0)
        •
    @endif

     @if($insideCount > 0)
        Interior: {{ $insideCount }} {{ $insideCount == 1 ? 'teren' : 'terenuri' }}
    @endif

</div>
<div class="reservation-sub">
  {{-- PREȚ --}}
    @if($prices->count() > 1)
         {{ $minPrice }} - {{ $maxPrice }} lei/oră
    @elseif($prices->count() == 1)
         {{ $minPrice }} lei/oră
    @endif
</div>

    <!-- SECTOR -->
    <div class="reservation-sub">
        {{ $r->sector }}
    </div>

</div>

        </div>
    @endforeach
    </div>

</div>


<script>
const sportFilter = document.getElementById('filterSport');
const sectorFilter = document.getElementById('filterSector');

const cards = document.querySelectorAll('.reservation-card');

function filterCards() {

    const sport = sportFilter.value.toLowerCase();
    const sector = sectorFilter.value.toLowerCase();

    cards.forEach(card => {

        const cardSport = card.dataset.sport?.toLowerCase() || '';
        const cardSector = card.dataset.sector?.toLowerCase() || '';

        const matchSport = !sport || cardSport === sport;
        const matchSector = !sector || cardSector === sector;

        card.style.display = (matchSport && matchSector) ? "block" : "none";
    });
}

sportFilter.addEventListener('change', filterCards);
sectorFilter.addEventListener('change', filterCards);

window.addEventListener('load', () => {

    // dacă avem sport din URL → filtrăm automat
    if (sportFilter.value) {
        filterCards();
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const elements = document.querySelectorAll(".reveal");

    const observer = new IntersectionObserver((entries) => {

        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("active");
            }
        });

    }, {
        threshold: 0.15
    });

    elements.forEach(el => observer.observe(el));

});
</script>

</x-app-layout>