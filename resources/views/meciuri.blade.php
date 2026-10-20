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
    font-size: 46px;
    text-align: center;
    font-weight: 600;
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
    margin-top: 4px;
}

/* CARD */
.match-card {
    background: #fff;
    border: 1px solid #e5e5e5;
    padding: 20px;
    border-radius: 20px;
    margin-bottom: 30px;
    cursor: pointer;
}

/* IMAGE */
.match-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 20px;
}

/* TEXT */
.match-info {
    margin-top: 10px;
}

.match-title {
    font-weight: 500;
    font-size: 16px;
    text-transform: uppercase;
}

.match-sub {
    color: #666;
    font-size: 14px;
}

.form-input:focus {
    outline: none;
    border-color: #4A7D89;
    box-shadow: 0 0 0 3px rgba(36, 190, 224, 0.2); 
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

    /* MATCH CARDS */
    .match-card{
        padding:18px;
        margin-bottom:24px;
    }

    .match-image{
        height:280px;
    }

    .match-title{
        font-size:18px;
    }

    .match-sub{
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

    .match-card{
        padding:14px;
        border-radius:18px;
    }

    .match-image{
        height:220px;
        border-radius:16px;
    }

    .match-title{
        font-size:16px;
        line-height:1.4;
    }

    .match-sub{
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

    .match-image{
        height:180px;
    }

    .match-title{
        font-size:15px;
    }

    .match-sub{
        font-size:13px;
    }
}
.matches-grid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

/* scoatem margin-ul vechi */
.match-card{
    margin-bottom: 0;
}

/* TABLET */
@media(max-width:1024px){
    .matches-grid{
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
}

/* MOBILE */
@media(max-width:768px){
    .matches-grid{
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

<div class="page-container">

    <h1 class="page-title">MECIURI</h1>

    <!-- FILTER -->
    <div class="filters-box">

        <!-- SPORT -->
        <div class="filter-group">
            <label>Sportul</label>
            <select id="filterSport" class="form-input">
                <option value="">Alegeți sportul</option>

                @foreach($matches->unique('reservation.sport') as $m)
                    <option value="{{ $m->reservation->sport }}">
                        {{ $m->reservation->sport }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- SECTOR -->
        <div class="filter-group">
            <label>Sectorul</label>
            <select id="filterSector" class="form-input">
                <option value="">Alegeți sectorul</option>

                @foreach($matches->unique('reservation.sector') as $m)
                    <option value="{{ $m->reservation->sector }}">
                        {{ $m->reservation->sector }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <!-- MECIURI -->
     <div class="matches-grid reveal">
    @foreach($matches as $match)

        <div class="match-card"
             onclick="window.location='{{ route('matches.show', $match->id) }}'"
             data-sport="{{ $match->reservation->sport }}"
             data-sector="{{ $match->reservation->sector }}">

            <!-- IMAGINE -->
            <img class="match-image"
                 src="{{ asset('storage/'.$match->reservation->background_image) }}">

            <div class="match-info">

                <!-- TITLU -->
                <div class="match-title">
                    {{ strtoupper($match->reservation->sport) }}
                    - {{ $match->reservation->title }}
                </div>

                <!-- SECTOR -->
                <div class="match-sub">
                    {{ $match->reservation->sector }}
                </div>

                <!-- LOCURI -->
                <div class="match-sub">
    Locuri libere:
    {{ $match->people - $match->participants->count() }}
</div>
<div class="match-sub">
    {{ $match->terrain->name ?? '—' }} -
    {{ $match->terrain->terrain_type == 'inside' ? 'Interior' : 'Exterior' }} -
    {{ $match->terrain->price ?? '—' }} lei/oră
</div>
                <!-- ORAR -->
                <div class="match-sub">
    {{ $match->date }} |
    {{ \Carbon\Carbon::parse($match->start_time)->format('H:i') }}
    -
    {{ \Carbon\Carbon::parse($match->end_time)->format('H:i') }}
</div>


            </div>

        </div>

    @endforeach
</div>
</div>

<script>

const sportFilter = document.getElementById('filterSport');
const sectorFilter = document.getElementById('filterSector');

const cards = document.querySelectorAll('.match-card');

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