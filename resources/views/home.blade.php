<x-app-layout>

<div class="home-container">

    <h1 class="home-title">YOUR SPORT JOURNEY</h1>

    <div class="images-grid reveal">

        <div class="img-large reveal">
            <img src="{{ asset('images/tennis.jpg') }}" alt="">
        </div>

        <div class="img-small reveal">
            <img src="{{ asset('images/badminton.jpg') }}" alt="">
        </div>

        <div class="img-small reveal">
            <img src="{{ asset('images/basket.jpg') }}" alt="">
        </div>

    </div>

    <div class="home-info reveal">

        <div class="info-left">
            <h2>Ce este Sport Club?</h2>

            <a href="{{ route('despre-noi') }}" class="about-btn">
    Despre Noi
</a>
        </div>

        <div class="info-right">
            <p>
                Conectăm oameni prin sport. Platforma noastră te ajută să găsești
                jocuri și terenuri în Chișinău.
            </p>

            <p>
                Susținem, de asemenea, companiile și terenurile sportive să își
                promoveze serviciile și să ajungă mai ușor la jucători.
            </p>
        </div>

    </div>
</div>


<div class="sports-section reveal">

    <div class="sports-header">
        <h2>Sporturile</h2>

        <div class="arrows">
            <button onclick="scrollSports(-1)">◀</button>
            <button onclick="scrollSports(1)">▶</button>
        </div>
    </div>

    <div class="sports-wrapper">
    <div class="sports-container" id="sportsContainer">

        @php
            $gradients = [
                'linear-gradient(135deg, #13161B, #1f5777)',
                'linear-gradient(145deg, #091E10, #81AC85)',
                'linear-gradient(135deg, #457B92, #8CBECF)',
            ];
        @endphp

        @foreach($sports as $index => $sport)
    <div class="sport-card"
         onclick="window.location='{{ route('rezervari', ['sport' => $sport->sport]) }}'"
         style="background: {{ $gradients[$index % count($gradients)] }}">

        <h3>{{ $sport->sport }}</h3>

        <a class="explore-btn">
            Explorează →
        </a>

    </div>
@endforeach
    </div>
</div>
    </div>

<div class="services-section reveal">

    <div class="services-left">
        <h2>
            <span>Serviciile Noastre:</span><br>
            Descoperă ce îți oferim
        </h2>

        <p>
            Oferim soluții pentru sportivi, echipe și terenuri sportive.
            Totul într-o singură platformă.
        </p>

        <div class="service-image">
            <img src="{{ asset('images/service-main.jpg') }}" alt="">
        </div>
    </div>

    <div class="services-right">

        <div class="service-card active">
            <div class="service-header" onclick="toggleService(this)">
                <span>01.</span>
                <h3>Rezervări Terenuri</h3>
            </div>

            <div class="service-content">
                <p>
                    Descoperă terenuri și activități sportive disponibile pentru rezervare rapidă în Chișinău. Alege sportul preferat și rezervă direct online.
                </p>

                <a href="{{ route('rezervari') }}">Vezi detalii</a>

            </div>
        </div>


        <div class="service-card">
            <div class="service-header" onclick="toggleService(this)">
                <span>02.</span>
                <h3>Meciuri</h3>
            </div>

            <div class="service-content">
                <p>
                    Intră în joc alături de alți pasionați de sport. Găsește meciuri active, echipe și jucători disponibili în comunitate.
                </p>

                <a href="{{ route('matches') }}">Vezi detalii</a>

            </div>
        </div>


        <div class="service-card">
            <div class="service-header" onclick="toggleService(this)">
                <span>03.</span>
                <h3>Promovare pentru Companii Sportive</h3>
            </div>

            <div class="service-content">
                <p>
                    Oferim cluburilor și companiilor sportive posibilitatea de a-și promova terenurile, evenimentele și serviciile către o comunitate activă de jucători.
                </p>
                 <a href="/contacte">Vezi detalii</a>
            </div>
        </div>


        <div class="service-card">
            <div class="service-header" onclick="toggleService(this)">
                <span>04.</span>
                <h3>Suport Comunitate</h3>
            </div>

            <div class="service-content">
                <p>
                    Conectăm sportivii și formăm comunități active.
                </p>
            </div>
        </div>

    </div>
</div>

<div class="join-match-section reveal">

    <img src="{{ asset('images/girl_tennis.png') }}" alt="" class="join-bg">

    <div class="join-overlay">

        <h2>
            Intră într-un meci chiar azi
        </h2>

        <p>
            Găsește jucători, alătură-te unui meci activ și
            fă parte din comunitatea Sport Club.
        </p>

        <a href="{{ route('matches') }}" class="join-match-btn">
            Intră în meci
        </a>

    </div>

</div>



<script>
let currentIndex = 0;

const container = document.getElementById('sportsContainer');
const cards = document.querySelectorAll('.sport-card');
const prevBtn = document.querySelector('.arrows button:first-child');
const nextBtn = document.querySelector('.arrows button:last-child');

function getMaxIndex() {
    return Math.max(0, cards.length - 3); // 🔥 3 vizibile
}

function updateCarousel() {

    const cardWidth = cards[0].offsetWidth + 20; // gap
    container.style.transform = `translateX(-${currentIndex * cardWidth}px)`;

    // 🔥 dezactivează butoane
    prevBtn.disabled = currentIndex === 0;
    nextBtn.disabled = currentIndex >= getMaxIndex();
}

function scrollSports(direction) {

    currentIndex += direction;

    if (currentIndex < 0) currentIndex = 0;
    if (currentIndex > getMaxIndex()) currentIndex = getMaxIndex();

    updateCarousel();
}

window.addEventListener('load', () => {
    updateCarousel();

    setTimeout(() => {
        container.style.transition = "transform 0.4s ease";
    }, 50);
});

// init
updateCarousel();
</script>
<script>
function toggleService(element){

    const cards = document.querySelectorAll('.service-card');

    cards.forEach(card => {
        card.classList.remove('active');
    });

    element.parentElement.classList.add('active');
}
</script>

</x-app-layout>


<style>
.join-match-section{
    position:relative;
    margin:80px 40px;
    height:620px;
    border-radius:30px;
    overflow:hidden;
    position: relative;
    z-index: 5;
    margin-top: 80px;
}

.join-bg{
    width:100%;
    height:100%;
    object-fit:cover;
    filter:brightness(0.65);
}

.join-overlay{
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    background: rgba(255, 255, 255, 0.85);
    /* backdrop-filter: blur(29px);
    -webkit-backdrop-filter: blur(12px); */
    border: 1px solid rgba(255,255,255,0.3);
    padding:35px 45px;
    border-radius:25px;
    text-align:center;
    max-width:700px;
    width:100%;
    box-shadow:0 20px 60px rgba(0,0,0,0.2);
}

.join-overlay h2{
    font-size:28px;
    line-height:1.2;
    font-weight:500;
    margin-bottom:20px;
}

.join-overlay p{
    font-size:15px;
    max-width:380px;
    margin:auto;
    margin-bottom:25px;
    color:#555;
}

.join-match-btn{
    display:inline-block;
    padding:14px 28px;
    border: 1px solid rgba(0, 0, 0, 0.8);
    color:black;
    text-decoration:none;
    border-radius:40px;
    transition:0.3s;
}

.join-match-btn:hover{
    background:black;
    color:white;
}
    .sports-wrapper {
    overflow: hidden;
    width: 100%;
}

.sports-container {
    display: flex;
    gap: 20px;
}

.sports-section {
    background: #f5f5f5;
    padding: 40px;
    border-radius: 25px;
    width-max: 100%;
    margin-bottom: 50px;
}

.sports-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 60px;
}

.sports-header h2 {
    font-size: 22px;
    font-weight: 500;
}

.arrows button {
    border: 1px solid #ccc;
    background: white;
    padding: 6px 12px;
    border-radius: 8px;
    cursor: pointer;
}

.arrows button:hover {
    background: #eee;
}

.sports-container::-webkit-scrollbar {
    display: none;
}

.sport-card {
    flex: 0 0 calc((100% - 40px) / 3); 
    height: 140px;
    border-radius: 20px;
    padding: 25px 30px;
    color: white;

    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin-bottom: 60px;

    cursor: pointer;
    transition: 0.25s;
}

.sport-card h3 {
    font-size: 22px;
    font-weight: 500;
    color: white;
}
.services-section{
    display:flex;
    gap:60px;
    padding:40px;
    margin-top:200px;
    margin-bottom:100px;
    position: relative;
    z-index: 1;
     height: 600px;
    overflow: hidden;

}

.services-left{
    flex:1;
}

.services-left h2{
    font-size:30px;
    font-weight:500;
    line-height:1.1;
    margin-bottom:20px;
}

.services-left p{
    color:#666;
    max-width:400px;
    margin-bottom:40px;
}

.service-image img{
    width:100%;
    max-width:500px;
    height:280px;
    object-fit:cover;
    border-radius:20px;
}

.services-right {
    flex: 1;
    min-height: 420px;
}

.service-card {
    border-top: 1px solid #ddd;
    padding: 20px 0;
    cursor: pointer;
    transition: 0.3s ease;
}
.service-card:nth-child(1) { top: 0; }
.service-card:nth-child(2) { top: 120px; }
.service-card:nth-child(3) { top: 240px; }
.service-card:nth-child(4) { top: 360px; }

.service-header{
    display:flex;
    align-items:center;
    gap:20px;
}

.service-header span{
    color:#aaa;
    font-size:22px;
}

.service-header h3{
    font-size:26px;
    font-weight:400;
}

.service-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease;
    padding-left: 60px;
}

.service-card.active .service-content {
    max-height: 300px;
}

.service-content p{
    color:#555;
    margin-bottom:20px;
    max-width:350px;
}

.service-content a{
    display:inline-block;
    padding:10px 18px;
    border:1px solid black;
    border-radius:30px;
    text-decoration:none;
    color:black;
    margin-bottom:20px;
    transition:0.3s ease;
    background:white;
}

.service-content a:hover{
    background:black;
    color:white;
}

.service-content img{
    width:140px;
    height:100px;
    object-fit:cover;
    border-radius:15px;
}


.sport-card a {
    font-size: 13px;
    text-decoration: none;
    color: white;
    opacity: 0.8;
}

/* CONTAINER */
.home-container {
    padding: 10px 40px;
    width: 100%;
}
.sport-card:hover .explore-btn {
    color: white;
    opacity: 1;
    transition: 0.3s;
}


/* TITLE */
.home-title {
    font-family: 'Oswald', sans-serif;
    font-size: 42px;
    text-align: center;
    font-weight: 600;
    font-size: 46px;
    margin-bottom: 40px;
}

.images-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    grid-template-rows: 300px 200px;
    gap: 20px;
}

.images-grid img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px;
}

.img-large {
    grid-column: 1 / 3;
    grid-row: 1;
}

.img-small:nth-child(2) {
    grid-column: 1;
    grid-row: 2;
}

.img-small:nth-child(3) {
    grid-column: 2;
    grid-row: 2;
}

.home-info {
    display: flex;
    justify-content: space-between;
    margin-top: 150px;
    gap: 40px;
    margin-bottom: 150px;
}

.info-left h2 {
    font-size: 24px;
    margin-bottom: 20px;
    font-weight: 500;
}

.about-btn {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    border: 1px solid #ccc;
    text-decoration: none;
    color: #000;
    font-size: 14px;
}

.about-btn:hover {
    background: #f5f5f5;
}

.info-right {
    max-width: 500px;
}

.info-right p {
    margin-bottom: 10px;
    color: #444;
    line-height: 1.6;
    font-weight: 400;
}

@media (max-width: 1024px){

    .home-container{
        padding: 20px;
    }

    .home-title{
        font-size: 60px;
        line-height: 1;
        margin-bottom: 40px;
    }

    .images-grid{
        grid-template-columns: 1fr;
        grid-template-rows: auto;
        gap: 16px;
    }

    .img-large,
    .img-small:nth-child(2),
    .img-small:nth-child(3){
        grid-column: auto;
        grid-row: auto;
    }

    .img-large img{
        height: 380px;
    }

    .img-small img{
        height: 240px;
    }

    .home-info{
        flex-direction: column;
        margin-top: 80px;
        margin-bottom: 80px;
        gap: 30px;
    }

    .info-right{
        max-width: 100%;
    }

    /* SPORTS */
    .sports-section{
        margin: 0 20px 50px 20px;
        padding: 25px 20px;
    }

    .sports-header{
        margin-bottom: 30px;
    }

    .sport-card{
        flex: 0 0 calc((100% - 20px) / 2);
        margin-bottom: 10px;
    }

    .services-section{
        flex-direction: column;
        height: auto;
        overflow: visible;

        padding: 20px;
        gap: 50px;

        margin-top: 100px;
        margin-bottom: 80px;
    }

    .services-left p{
        max-width: 100%;
    }

    .service-image img{
        max-width: 100%;
        height: 260px;
    }

    .services-right{
        width: 100%;
    }

    .service-header h3{
        font-size: 24px;
    }

    .service-content{
        padding-left: 40px;
    }

    .service-content p{
        max-width: 100%;
    }

    .join-match-section{
        margin: 60px 20px;
        height: 500px;
    }

    .join-overlay{
        width: calc(100% - 40px);
        max-width: 700px;
    }
}

@media (max-width: 768px){

    .home-title{
        font-size: 42px;
    }

    .img-large img{
        height: 260px;
    }

    .img-small img{
        height: 180px;
    }

    .sport-card{
        flex: 0 0 100%;
        height: 130px;
    }

    .services-left h2{
        font-size: 32px;
    }

    .service-header{
        gap: 12px;
    }

    .service-header h3{
        font-size: 20px;
        line-height: 1.3;
    }

    .service-content{
        padding-left: 20px;
    }

    .join-match-section{
        height: 420px;
    }

    .join-overlay{
        padding: 25px 20px;
    }

    .join-overlay h2{
        font-size: 26px;
    }
}

@media (max-width: 480px){

    .home-container{
        padding: 16px;
    }

    .home-title{
        font-size: 32px;
        margin-bottom: 25px;
    }

    .img-large img{
        height: 220px;
    }

    .img-small img{
        height: 150px;
    }

    .sports-section{
        margin: 0 16px 40px 16px;
        padding: 18px;
    }

    .sports-header{
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
    }

    .services-section{
        padding: 16px;
    }

    .services-left h2{
        font-size: 26px;
    }

    .service-header h3{
        font-size: 18px;
    }

    .join-match-section{
        margin: 50px 16px;
        height: 380px;
    }

    .join-overlay h2{
        font-size: 22px;
    }

    .join-match-btn{
        width: 100%;
        text-align: center;
    }
}
.reveal {
    opacity: 0;
    transform: translateY(40px);
    transition: all 0.8s ease;
}

.reveal.show {
    opacity: 1;
    transform: translateY(0);
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}

</style>
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