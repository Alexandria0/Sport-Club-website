<x-app-layout>

<div class="page-container">
   

    <h1 class="page-title">REZERVĂRI</h1>

    <div class="reservation-title-row">

    <h2 class="reservation-title">
        {{ $reservation->title }}, {{ $reservation->sport }}
    </h2>

    @if(auth()->check() && auth()->user()->role === 'admin')

        <div class="admin-buttons">

        <a
            href="{{ route('rezervari.edit', $reservation->id) }}"
            class="edit-reservation-btn"
        >
            Editează
        </a>

        <form
            action="{{ route('rezervari.destroy', $reservation->id) }}"
            method="POST"
            onsubmit="return confirm('Sigur vrei să ștergi această rezervare?')"
        >
            @csrf
            @method('DELETE')

            <button type="submit" class="delete-reservation-btn">
                Șterge
            </button>
        </form>

    </div>

    @endif

</div>
<div class="reservation-location">
    {{ $reservation->sector }}, {{ $reservation->address }}
</div>


    <h3>Detalii</h3>
    <div class="reservation-details">
    {!! nl2br(e($reservation->details)) !!}
</div>

    <div class="reservation-schedule"><h3>Orar:</h3>
    {{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }}
-
{{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}
</div>

    <!-- FORM -->
    <form method="POST" action="{{ route('bookings.store') }}">
        @csrf

        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
        <input type="hidden" name="date" id="selectedDate">
        <input type="hidden" name="start_time" id="startTime">
        <input type="hidden" name="end_time" id="endTime">


       <!-- TERENURI -->
<div class="terrains-section">

    <h3 class="terrains-title">
        Terenuri disponibile
    </h3>

    <div class="terrains-list">

        @foreach($reservation->terrains as $terrain)

            <label class="terrain-card" data-terrain>

                <input
    type="radio"
    name="terrain_id"
    value="{{ $terrain->id }}"
    class="terrain-radio"
    required
    {{ $loop->first ? 'checked' : '' }}
>

                <div class="terrain-card-content">

                    <div class="terrain-card-top">

                        <h4>
    Teren {{ $loop->iteration }} - 
    {{ $terrain->terrain_type == 'inside' ? 'Interior' : 'Exterior' }}
</h4>

                    </div>

                    <div class="terrain-info-row">

                        <div class="terrain-info">
                            <p>Dimensiune:</strong>
                            {{ $terrain->size ?: '—' }}
                        </div>

                        <div class="terrain-info">
                            <p>Preț:</strong>
                            {{ $terrain->price }} lei/oră
                        </div>

                    </div>

                </div>

            </label>

        @endforeach

    </div>

</div>

        <!-- GRID -->
        <div class="reservation-grid">

            <!-- CALENDAR -->
            <div class="calendar-box">

                <div class="calendar-header">
                    <button type="button" id="prevMonth">◀</button>
                    <h3 id="monthYear"></h3>
                    <button type="button" id="nextMonth">▶</button>
                </div>

                <div class="calendar-days">
                    <div>Lun</div>
                    <div>Mar</div>
                    <div>Mie</div>
                    <div>Joi</div>
                    <div>Vin</div>
                    <div>Sâm</div>
                    <div>Dum</div>
                </div>

                <div class="calendar-grid" id="calendarGrid"></div>

            </div>

            <div id="noTimeMessage" class="no-time-message">
    Nu ați selectat nici o zi
</div>
            <!-- TIME SLOTS -->
            <div class="time-slots">

                @php
                    $start = \Carbon\Carbon::parse($reservation->start_time);
                    $end = \Carbon\Carbon::parse($reservation->end_time);
                @endphp

                @while($start < $end)

                    @php
                        $next = $start->copy()->addHour();
                    @endphp

                    <button type="button" class="time-btn"
    data-start="{{ $start->format('H:i') }}"
    data-end="{{ $next->format('H:i') }}">
    {{ $start->format('H:i') }} - {{ $next->format('H:i') }}
</button>

                    @php
                        $start = $next;
                    @endphp

                @endwhile

            </div>

        </div>
         @if ($errors->any())
    <div style="color:red; margin-bottom:20px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <!-- MATCH -->
        <div class="match-section">

            <label class="match-toggle">
                <input type="checkbox" name="create_match" id="createMatch">
                Creează un meci
            </label>

            <div id="matchFields" class="hidden">

                <div class="form-group">
                    <label>De câte persoane aveți nevoie?</label>

                    <input
                        type="number"
                        name="people"
                        class="form-input small"
                        min="1"
                    >
                </div>

                <div class="form-group">
                    <label>Introduceți detalii</label>

                    <textarea
                        name="details"
                        class="form-input textarea"
                    ></textarea>
                </div>

            </div>

            @auth
    <button type="submit" class="confirm-btn">
        Confirmă rezervarea
    </button>
@else
    <a href="{{ route('login') }}" class="confirm-btn" style="text-decoration:none; display:inline-block; text-align:center;">
        Confirmă rezervarea
    </a>
@endauth

        </div>

    </form>
    <div class="gallery-section">

    <div class="gallery-header">

        <h2>GALERIE</h2>

        <div class="gallery-buttons">
            <button id="prevGallery">◀</button>
            <button id="nextGallery">▶</button>
        </div>

    </div>

    <div class="gallery-wrapper">

        <div class="gallery-track" id="galleryTrack">

            @foreach($reservation->images as $image)

                <div class="gallery-card">

                    <img
                        src="{{ asset('storage/' . $image->image) }}"
                        alt="Gallery image"
                    >

                </div>

            @endforeach

        </div>

    </div>

</div>
<!-- LIGHTBOX -->
<div id="lightbox" class="lightbox hidden">

    <span class="lightbox-close" id="closeLightbox">✕</span>

    <button class="lightbox-nav left" id="prevImg">◀</button>

    <img id="lightboxImg" src="" alt="preview">

    <button class="lightbox-nav right" id="nextImg">▶</button>

</div>

</div>

<style>
/* =========================================
   PAGE
========================================= */

.page-container{
    width:100%;
    padding:20px 40px;
}

.page-title{
    font-family:'Oswald', sans-serif;
    font-size:46px;
    font-weight:600;
    text-align:center;
    margin-bottom:40px;
    line-height:1;
}

/* =========================================
   TITLE SECTION
========================================= */

.reservation-title-row{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;
    margin-bottom:10px;
}

.reservation-title{
    font-size:32px;
    font-weight:600;
    line-height:1.3;
}

.reservation-location{
    font-size:16px;
    color:#555;
    margin-bottom:28px;
}

.reservation-schedule{
    margin-top:20px;
    margin-bottom:30px;
    font-size:16px;
    font-weight:500;
}

/* =========================================
   DETAILS
========================================= */

h3{
    font-size:20px;
    font-weight:500;
    margin-bottom:12px;
}

.reservation-details{
    margin-bottom:25px;
    line-height:1.7;
    font-size:16px;
    color:#333;
}

.reservation-info{
    margin-top:14px;
}

.reservation-price{
    font-size:18px;
    font-weight:600;
    color:#111;
}

.reservation-type{
    font-size:16px;
    color:#666;
}

/* =========================================
   ADMIN BUTTONS
========================================= */

.admin-buttons{
    display:flex;
    align-items:center;
    gap:10px;
}

.edit-reservation-btn,
.delete-reservation-btn{
    border:none;
    border-radius:14px;
    padding:10px 18px;
    font-size:14px;
    cursor:pointer;
    transition:0.2s;
    text-decoration:none;
}

.edit-reservation-btn{
    background:#000;
    color:white;
}

.delete-reservation-btn{
    background:#e53935;
    color:white;
}

.edit-reservation-btn:hover,
.delete-reservation-btn:hover{
    opacity:0.9;
}

/* =========================================
   FORM
========================================= */

.form-group{
    margin-bottom:22px;
}

.form-label{
    display:block;
    margin-top:16px;
    margin-bottom:8px;
    font-size:16px;
    font-weight:500;
    color:#222;
}

/* SELECT TEREN */
.form-input{
    /* width:100%;
    max-width:150px; */
    padding:8px 16px;
    border:1px solid #ccc;
    border-radius:10px;
    font-size:15px;
    background:white;
    outline:none;
    transition:0.2s;
}

.form-input:focus{
    border-color:#0070C8;
}

/* =========================================
   GRID
========================================= */

.reservation-grid{
    position:relative;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:40px;
    margin-top:30px;
}

/* =========================================
   CALENDAR
========================================= */

.calendar-box{
    border:1px solid #e5e5e5;
    border-radius:20px;
    padding:22px;
    background:white;
}

.calendar-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:22px;
}

.calendar-header h3{
    font-size:20px;
    margin:0;
}

.calendar-header button{
    background:white;
    border:1px solid #ddd;
    border-radius:12px;
    padding:8px 14px;
    cursor:pointer;
    transition:0.2s;
}

.calendar-header button:hover:not(:disabled){
    background:#0070C8;
    color:white;
}

.calendar-header button:disabled{
    opacity:0.4;
    cursor:not-allowed;
}

/* DAYS */

.calendar-days{
    display:grid;
    grid-template-columns:repeat(7,1fr);
    text-align:center;
    margin-bottom:12px;
    font-size:14px;
    font-weight:600;
}

.calendar-grid{
    display:grid;
    grid-template-columns:repeat(7,1fr);
    gap:8px;
}

.day{
    border:1px solid #e5e5e5;
    border-radius:12px;
    padding:13px 0;
    text-align:center;
    font-size:14px;
    cursor:pointer;
    transition:0.2s;
    background:white;
}

.day:hover{
    background:#0070C8;
    color:white;
}

.day.today{
    border:2px solid #0070C8;
}

.day.selected{
    background:#0070C8;
    color:white;
}

.day.disabled{
    background:#ddd;
    color:#999;
    cursor:not-allowed;
}

.day.full{
    background:#e53935;
    color:white;
}

/* =========================================
   TIME SLOTS
========================================= */

.time-slots{
    display:none;
    grid-template-columns:repeat(3,1fr);
    gap:14px;
}

.time-btn{
    padding:12px;
    border:1px solid #d5d5d5;
    border-radius:16px;
    background:white;
    font-size:14px;
    cursor:pointer;
    transition:0.2s;
}

.time-btn:hover{
    background:#0070C8;
    color:white;
}

.time-btn.active{
    background:green;
    color:white;
}

.time-btn.booked{
    background:red !important;
    color:white !important;
    border:none;
    cursor:not-allowed;
}

.time-btn.past{
    background:#d32f2f !important;
    color:white !important;
    border:none;
    opacity:0.75;
    cursor:not-allowed;
}

/* =========================================
   EMPTY MESSAGE
========================================= */

.no-time-message{
    position:absolute;
    right:0;
    top:50%;
    transform:translateY(-50%);
    width:50%;
    text-align:center;
    font-size:17px;
    color:#777;
    pointer-events:none;
}

/* =========================================
   MATCH
========================================= */

.match-section{
    margin-top:40px;
}

.match-toggle{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:20px;
    font-size:15px;
}

.form-input.small{
    width:90px;
}

.textarea{
    width:100%;
    min-height:120px;
    padding:14px;
    border:1px solid #ccc;
    border-radius:18px;
    font-size:15px;
    resize:vertical;
}

/* =========================================
   BUTTON
========================================= */

.confirm-btn{
    margin-top:20px;
    padding:12px 22px;
    border:none;
    border-radius:16px;
    background:#0070C8;
    color:white;
    font-size:15px;
    cursor:pointer;
    transition:0.2s;
}

.confirm-btn:hover{
    opacity:0.9;
}

/* =========================================
   GALLERY
========================================= */

.gallery-section{
    margin-top:90px;
}

.gallery-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:24px;
}

.gallery-header h2{
    font-size:18px;
    font-weight:600;
}

.gallery-buttons{
    display:flex;
    gap:10px;
}

.gallery-buttons button{
    width:42px;
    height:42px;
    border:1px solid #ccc;
    border-radius:12px;
    background:white;
    font-size:18px;
    cursor:pointer;
    transition:0.2s;
}

.gallery-buttons button:hover:not(:disabled){
    background:#0070C8;
    color:white;
}

.gallery-buttons button:disabled{
    opacity:0.4;
    cursor:not-allowed;
}

.gallery-wrapper{
    overflow:hidden;
}

.gallery-track{
    display:flex;
    gap:16px;
    transition:0.4s ease;
}

.gallery-card{
    min-width:calc(50% - 10px);
    height:300px;
    border-radius:20px;
    overflow:hidden;
    flex-shrink:0;
    background:#f2f2f2;
}

.gallery-card img{
    width:100%;
    height:100%;
    object-fit:cover;
    cursor:pointer;
}

/* =========================================
   LIGHTBOX
========================================= */

.lightbox{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.9);
    display:flex;
    justify-content:center;
    align-items:center;
    z-index:9999;
}

.lightbox img{
    max-width:90%;
    max-height:90%;
    border-radius:12px;
}

.lightbox-close{
    position:absolute;
    top:20px;
    right:30px;
    font-size:32px;
    color:white;
    cursor:pointer;
}

.lightbox-nav{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    border:none;
    border-radius:10px;
    background:rgba(255,255,255,0.15);
    color:white;
    padding:10px 15px;
    font-size:26px;
    cursor:pointer;
}

.lightbox-nav.left{
    left:30px;
}

.lightbox-nav.right{
    right:30px;
}

.lightbox-nav:hover{
    background:rgba(255,255,255,0.3);
}

.hidden{
    display:none;
}

.terrains-section{
    margin:30px 0;
}

.terrains-title{
    font-size:20px;
    margin-bottom:20px;
    font-weight:500;
}

.terrains-list{
    display:flex;
    flex-direction:column;
    gap:16px;
}

.terrain-card{
    border:1px solid #e5e5e5;
    border-radius:18px;
    padding:18px;
    cursor:pointer;
    transition:0.2s ease;
    background:white;
}

.terrain-card:hover{
    border-color:#4A7D89;
}


.terrain-card.active{
    border:1px solid #4A7D89;
    background:#f5fbfc;
}

.terrain-card.active h4{
    color:#4A7D89;
}
    .terrain-radio{
    position:absolute;
    opacity:0;
    pointer-events:none;
}
.terrain-card-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:14px;
}

.terrain-card-top h4{
    font-size:20px;
    margin:0;
}

.terrain-type-badge{
    background:#f2f2f2;
    padding:6px 12px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
}

.terrain-info-row{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

.terrain-info{
    font-size:14px;
    color:#444;
}

</style>

<script>
const bookings = @json($bookings);
const calendarGrid = document.getElementById("calendarGrid");
const monthYear = document.getElementById("monthYear");

let currentDate = new Date();

const today = new Date();
today.setHours(0,0,0,0);

const minMonth = new Date(today.getFullYear(), today.getMonth(), 1);
const maxMonth = new Date(today.getFullYear(), today.getMonth() + 2, 1);

const workingDays = @json($reservation->working_days);

const daysMap = {
    "luni":1,
    "marti":2,
    "miercuri":3,
    "joi":4,
    "vineri":5,
    "sambata":6,
    "duminica":0
};

const allowedDays = workingDays.map(
    d => daysMap[d.toLowerCase()]
);

const months = [
    "Ianuarie",
    "Februarie",
    "Martie",
    "Aprilie",
    "Mai",
    "Iunie",
    "Iulie",
    "August",
    "Septembrie",
    "Octombrie",
    "Noiembrie",
    "Decembrie"
];

function renderCalendar(date){

    calendarGrid.innerHTML = "";

    const year = date.getFullYear();
    const month = date.getMonth();

    monthYear.innerText = `${months[month]} ${year}`;

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    let startDay = firstDay === 0 ? 6 : firstDay - 1;

    for(let i = 0; i < startDay; i++){
        calendarGrid.innerHTML += `<div></div>`;
    }

    for(let i = 1; i <= daysInMonth; i++){

        const dayDate = new Date(year, month, i);
        const dayOfWeek = dayDate.getDay();
        const formattedDate = `${year}-${String(month+1).padStart(2,'0')}-${String(i).padStart(2,'0')}`;

// 🔥 verificăm dacă ziua este FULL
const reservationId = {{ $reservation->id }};

// toate intervalele din ziua respectivă
const totalSlots = document.querySelectorAll(".time-btn").length;

// câte sunt ocupate
const bookedSlots = bookings.filter(b => 
    b.reservation_id == reservationId &&
    b.terrain_id == selectedTerrain &&
    b.date === formattedDate
).length;

const isFull = totalSlots > 0 && bookedSlots >= totalSlots;

let classes = "day";
        if(isFull){
    classes += " full";
}

        if(dayDate < today){
            classes += " disabled";
        }

        if(!allowedDays.includes(dayOfWeek)){
            classes += " disabled";
        }

        if(
            i === today.getDate() &&
            month === today.getMonth() &&
            year === today.getFullYear()
        ){
            classes += " today";
        }

        if(classes.includes("disabled")){

            calendarGrid.innerHTML += `
                <div class="${classes}">
                    ${i}
                </div>
            `;

        }else{

            calendarGrid.innerHTML += `
                <div
                    class="${classes}"
                    data-date="${year}-${String(month+1).padStart(2,'0')}-${String(i).padStart(2,'0')}"
                >
                    ${i}
                </div>
            `;
        }
    }

    document.getElementById("nextMonth").disabled =
        currentDate.getFullYear() === maxMonth.getFullYear()
        &&
        currentDate.getMonth() === maxMonth.getMonth();

    document.getElementById("prevMonth").disabled =
        currentDate.getFullYear() === minMonth.getFullYear()
        &&
        currentDate.getMonth() === minMonth.getMonth();
}

document.getElementById("nextMonth").onclick = () => {

    const next = new Date(currentDate);

    next.setMonth(currentDate.getMonth() + 1);

    if(next <= maxMonth){

        currentDate = next;

        renderCalendar(currentDate);
    }
};

document.getElementById("prevMonth").onclick = () => {

    const prev = new Date(currentDate);

    prev.setMonth(currentDate.getMonth() - 1);

    if(prev >= minMonth){

        currentDate = prev;

        renderCalendar(currentDate);
    }
};

// /* SELECT DAY */
// document.addEventListener("click", function(e){

//     if(
//         e.target.classList.contains("day")
//         &&
//         !e.target.classList.contains("disabled")
//     ){

//         document.querySelectorAll(".day").forEach(
//             d => d.classList.remove("selected")
//         );

//         e.target.classList.add("selected");

//         document.getElementById("selectedDate").value =
//             e.target.dataset.date;
//     }
// });

/* SELECT TIME */
let selectedBtn = null;

document.querySelectorAll(".time-btn").forEach(btn => {

    btn.addEventListener("click", function() {

        if (this.classList.contains("disabled")) return;

        if (selectedBtn) selectedBtn.classList.remove("active");

        this.classList.add("active");
        selectedBtn = this;

        const interval = this.innerText.split(" - ");

        document.getElementById("startTime").value = interval[0];
        document.getElementById("endTime").value = interval[1];
    });

});

/* SHOW MATCH */
document.getElementById("createMatch")
.addEventListener("change", function(){

    document.getElementById("matchFields")
    .classList.toggle("hidden", !this.checked);
});

/* VALIDATION */
document.querySelector("form")
.addEventListener("submit", function(e){

    const selectedDate = document.getElementById("selectedDate").value;
    const startTime = document.getElementById("startTime").value;
    const createMatch = document.getElementById("createMatch").checked;
    const people = document.querySelector("input[name='people']").value;

    // ❌ nu ai selectat zi
    if(!selectedDate){
        e.preventDefault();
        alert("Selectează ziua!");
        return;
    }

    // ❌ ai zi dar nu ai oră
    if(!startTime){
        e.preventDefault();
        alert("Selectează ora!");
        return;
    }

    // ❌ dacă creezi meci → persoane obligatoriu
    if(createMatch && (!people || people <= 0)){
        e.preventDefault();
        alert("Introdu numărul de persoane!");
        return;
    }

});

let selectedDateGlobal = null;
let selectedTerrain =
    document.querySelector(".terrain-radio:checked")?.value;

if(!selectedTerrain){
    selectedTerrain =
        document.querySelector(".terrain-radio")?.value;
}

function updateTerrainSelection(){

    document.querySelectorAll(".terrain-card")
    .forEach(card => {
        card.classList.remove("active");
    });

    const checkedRadio = document.querySelector(".terrain-radio:checked");

    if(checkedRadio){

        checkedRadio
        .closest(".terrain-card")
        .classList.add("active");
    }
}

updateTerrainSelection();

document.querySelectorAll(".terrain-radio").forEach(radio => {

    radio.addEventListener("change", function(){

        selectedTerrain = this.value;

        updateTerrainSelection();

        // 🔥 RESET ZI
        selectedDateGlobal = null;

        document.getElementById("selectedDate").value = "";

        document.querySelectorAll(".day").forEach(day => {
            day.classList.remove("selected");
        });

        // 🔥 RESET ORĂ
        document.getElementById("startTime").value = "";
        document.getElementById("endTime").value = "";

        document.querySelectorAll(".time-btn").forEach(btn => {
            btn.classList.remove("active");
        });

        selectedBtn = null;

        // rerender calendar
        renderCalendar(currentDate);

        // 🔥 afișează din nou mesajul
        updateTimeSlots();

    });

});
        updateTerrainSelection();

document.addEventListener("click", function(e) {

    if (e.target.classList.contains("day") && !e.target.classList.contains("disabled")) {

        document.querySelectorAll(".day").forEach(d => d.classList.remove("selected"));
        e.target.classList.add("selected");

        selectedDateGlobal = e.target.dataset.date;

        document.getElementById("selectedDate").value = selectedDateGlobal;

        // 🔥 RESET ORĂ SELECTATĂ
        selectedBtn = null;
        document.getElementById("startTime").value = "";
        document.getElementById("endTime").value = "";

        // 🔥 scoate highlight-ul de pe butoane
        document.querySelectorAll(".time-btn").forEach(btn => {
            btn.classList.remove("active");
        });

        updateTimeSlots();
    }
});

function updateTimeSlots() {

    const timeSlots = document.querySelector(".time-slots");
    const message = document.getElementById("noTimeMessage");

    if (!selectedDateGlobal) {
        timeSlots.style.display = "none";
        message.style.display = "block";
        message.innerText = "Nu ați selectat nici o zi";
        return;
    }

    message.style.display = "none";
    timeSlots.style.display = "grid";

    const buttons = document.querySelectorAll(".time-btn");

    buttons.forEach(btn => {

    const start = btn.dataset.start;
    const end = btn.dataset.end;

    const reservationId = {{ $reservation->id }};

    // 🔥 verificăm booking
    const isBooked = bookings.some(b => {

    const bookingStart = b.start_time.substring(0,5);
    const bookingEnd = b.end_time.substring(0,5);

    return (
        b.reservation_id == reservationId &&
        b.terrain_id == selectedTerrain &&
        b.date === selectedDateGlobal &&
        bookingStart === start &&
        bookingEnd === end
    );

});

    // 🔥 verificăm dacă ora a trecut
    const now = new Date();

    const currentDate =
        now.getFullYear() + "-" +
        String(now.getMonth()+1).padStart(2,'0') + "-" +
        String(now.getDate()).padStart(2,'0');

    const currentTime =
        String(now.getHours()).padStart(2,'0') + ":" +
        String(now.getMinutes()).padStart(2,'0');

    const isPast =
        selectedDateGlobal === currentDate &&
        end <= currentTime;

    // RESET
    btn.classList.remove("booked");
    btn.classList.remove("past");

    btn.disabled = false;

    // 🔥 ocupat
    if (isBooked) {

        btn.classList.add("booked");
        btn.disabled = true;

    }

    // 🔥 trecut
    if (isPast) {

        btn.classList.add("past");
        btn.disabled = true;

    }

});

}
const track = document.getElementById("galleryTrack");

const cards = document.querySelectorAll(".gallery-card");

const nextBtn = document.getElementById("nextGallery");
const prevBtn = document.getElementById("prevGallery");

let currentIndex = 0;

/*
    se mișcă câte o imagine,
    dar se văd mereu 2
*/
const maxIndex = cards.length - 2;

function updateGallery() {

    const moveAmount = cards[0].offsetWidth + 20;

    track.style.transform =
        `translateX(-${currentIndex * moveAmount}px)`;

    // disable butoane
    prevBtn.disabled = currentIndex === 0;
    nextBtn.disabled = currentIndex >= maxIndex;
}

nextBtn.addEventListener("click", () => {

    if(currentIndex < maxIndex){

        currentIndex++;

        updateGallery();
    }
});

prevBtn.addEventListener("click", () => {

    if(currentIndex > 0){

        currentIndex--;

        updateGallery();
    }
});

updateGallery();

window.addEventListener("resize", updateGallery);

const lightbox = document.getElementById("lightbox");
const lightboxImg = document.getElementById("lightboxImg");
const closeLightbox = document.getElementById("closeLightbox");

const images = Array.from(document.querySelectorAll(".gallery-card img"));
let currentIndexImg = 0;

// deschidere imagine
images.forEach((img, index) => {
    img.addEventListener("click", () => {
        currentIndexImg = index;
        openLightbox();
    });
});

function openLightbox() {
    lightbox.classList.remove("hidden");
    updateLightboxImage();
}

function updateLightboxImage() {
    lightboxImg.src = images[currentIndexImg].src;
}

// next
document.getElementById("nextImg").addEventListener("click", () => {
    currentIndexImg = (currentIndexImg + 1) % images.length;
    updateLightboxImage();
});

// prev
document.getElementById("prevImg").addEventListener("click", () => {
    currentIndexImg =
        (currentIndexImg - 1 + images.length) % images.length;
    updateLightboxImage();
});

// close
closeLightbox.addEventListener("click", () => {
    lightbox.classList.add("hidden");
});

// click pe fundal
lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox) {
        lightbox.classList.add("hidden");
    }
});

renderCalendar(currentDate);
updateTimeSlots();

</script>
<style>
    /* =========================================
   RESPONSIVE TABLET
========================================= */

@media(max-width:1024px){

    .page-container{
        padding:20px;
    }

    .reservation-grid{
        grid-template-columns:1fr;
        gap:30px;
    }

    .reservation-title-row{
        flex-direction:column;
        align-items:flex-start;
    }

    .admin-buttons{
        width:100%;
        justify-content:flex-end;
        flex-wrap:wrap;
    }

    .calendar-box{
        padding:18px;
    }

    .time-slots{
        grid-template-columns:repeat(2,1fr);
    }

    .no-time-message{
        font-size:14px;
        position:static;
        transform:none;
        width:100%;
        margin-top:20px;
    }

    .gallery-card{
        min-width:100%;
        height:260px;
    }
    .terrains-title{
    font-size:18px;
    margin-bottom:20px;
    font-weight:500;
}

}

/* =========================================
   RESPONSIVE MOBILE
========================================= */

@media(max-width:768px){

    .page-container{
        padding:16px;
    }

    .page-title{
        font-size:38px;
        margin-bottom:25px;
    }

    .reservation-title{
        font-size:22px;
        line-height:1.3;
    }

    .reservation-location,
    .reservation-details,
    .reservation-schedule{
        font-size:14px;
    }

    .reservation-details{
        line-height:1.5;
    }

    h3{
        font-size:18px;
    }

    /* BUTTONS */
    .admin-buttons{
        width:100%;
        justify-content:flex-start;
    }

    .edit-reservation-btn,
    .delete-reservation-btn{
        padding:8px 14px;
        font-size:13px;
    }

    /* CALENDAR */
    .calendar-box{
        padding:14px;
        border-radius:16px;
    }

    .calendar-header h3{
        font-size:16px;
    }

    .calendar-header button{
        padding:6px 10px;
    }

    .calendar-days{
        font-size:11px;
    }

    .day{
        font-size:12px;
        padding:9px 0;
    }

    /* TIME */
    .time-slots{
        grid-template-columns:repeat(2,1fr);
        gap:10px;
    }

    .time-btn{
        font-size:12px;
        padding:10px;
        border-radius:12px;
    }

    /* TERRAINS */
    .terrain-card{
        padding:16px;
    }

    .terrain-card-top{
        flex-direction:column;
        align-items:flex-start;
        gap:8px;
    }

    .terrain-card-top h4{
        font-size:17px;
    }

    .terrain-info{
        font-size:13px;
    }

    /* MATCH */
    .match-section{
        margin-top:30px;
    }

    .match-toggle{
        font-size:14px;
    }

    .form-group label{
        font-size:14px;
    }

    .form-input.small{
        width:70px;
        font-size:13px;
    }

    .textarea{
        min-height:100px;
        font-size:13px;
        padding:10px;
    }

    .confirm-btn{
        width:100%;
        padding:12px;
        font-size:14px;
    }

    /* GALLERY */
    .gallery-section{
        margin-top:60px;
    }

    .gallery-card{
        height:220px;
        border-radius:16px;
    }

    .gallery-buttons button{
        width:36px;
        height:36px;
        font-size:15px;
    }

    /* LIGHTBOX */
    .lightbox-nav{
        padding:8px 12px;
        font-size:20px;
    }

    .lightbox-close{
        font-size:28px;
        top:14px;
        right:18px;
    }
}

/* =========================================
   SMALL MOBILE
========================================= */

@media(max-width:480px){

    .page-title{
        font-size:30px;
    }

    .reservation-title{
        font-size:18px;
    }

    .reservation-location,
    .reservation-details,
    .reservation-schedule{
        font-size:13px;
    }

    .calendar-grid{
        gap:6px;
    }

    .day{
        font-size:11px;
        padding:8px 0;
    }

    .time-slots{
        grid-template-columns:1fr;
    }

    .time-btn{
        font-size:12px;
    }

    .gallery-card{
        height:180px;
    }

    .gallery-header h2{
        font-size:15px;
    }

    .gallery-buttons{
        gap:6px;
    }

    .gallery-buttons button{
        width:32px;
        height:32px;
        font-size:13px;
    }

    .terrain-card{
        padding:14px;
    }

    .terrain-card-top h4{
        font-size:15px;
    }

    .terrain-info{
        font-size:12px;
    }

    .confirm-btn{
        font-size:13px;
    }

    .form-input.small{
        width:60px;
        font-size:12px;
    }

    .textarea{
        font-size:12px;
    }
}
</style>

</x-app-layout>