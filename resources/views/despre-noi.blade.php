<x-app-layout>

<div class="about-container">

    <h1 class="about-title reveal">DESPRE NOI</h1>

    <div class="about-hero reveal">
        <img src="{{ asset('images/footbal.jpg') }}" alt="">
    </div>


</div>
    <div class="about-box">

        <div class="about-text">
            <h2>Ce este Sport Club?</h2>

            <p>
                Sport Club este o platformă dedicată tuturor celor care iubesc sportul.
                Scopul nostru este să conectăm jucători, echipe și terenuri sportive
                într-un singur loc.
            </p>

            <p>
                Cu ajutorul platformei poți rezerva terenuri, participa la meciuri
                și descoperi noi oportunități sportive în oraș.
            </p>
        </div>

        <div class="stats-grid reveal">
            <div class="stat-card">
                <h3 class="counter" data-target="{{ $totalBookings }}">0</h3>
                <p>Rezervări realizate</p>
            </div>

            <div class="stat-card">
                <h3 class="counter" data-target="{{ $usersCount }}">0</h3>
                <p>Jucători activi</p>
            </div>

            <div class="stat-card ">
                <h3 class="counter" data-target="{{ $reservationsCount }}">0</h3>
                <p>Terenuri sportive</p>
            </div>
        </div>

        <div class="mission-section reveal">
            <div class="mission-card">
                <h3>Misiunea noastră</h3>
                <p>
                    Să facem sportul accesibil tuturor și să simplificăm modul
                    în care oamenii se conectează prin activități sportive.
                </p>
            </div>

            <div class="mission-card">
                <h3>Viziunea noastră</h3>
                <p>
                    O comunitate sportivă puternică, activă și conectată.
                </p>
            </div>
        </div>

        <div class="about-images reveal">
            <img src="{{ asset('images/baseball.jpg') }}" alt="">
            <img src="{{ asset('images/football.jpg') }}" alt="">
        </div>

    </div>

</div>

</x-app-layout>

<style>
.about-container {
    padding: 10px 40px;
}

.about-title {
    font-family: 'Oswald', sans-serif;
    text-align: center;
    font-size: 46px;
    font-weight: 600;
    margin-bottom: 40px;
}

.about-hero img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    border-radius: 25px;
    margin-bottom: 50px;
    filter:brightness(0.7);
}

.about-box{
    background:#f8f8f8;
    padding:70px;
    border-radius:30px;
}

.about-text h2{
    font-size:34px;
    margin-bottom:20px;
}

.about-text p{
    line-height:1.8;
    color:#555;
    margin-bottom:15px;
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:25px;
    margin:60px 0;
}

.stat-card{
    background:white;
    padding:35px;
    border-radius:20px;
    text-align:center;
    transition:.3s;
}

.stat-card h3{
    font-size:42px;
    color:#1f5777;
}

.mission-section{
    display:flex;
    gap:30px;
    margin-bottom:60px;
}

.mission-card{
    flex:1;
    background:white;
    padding:35px;
    border-radius:20px;
}

.mission-card h3{
    margin-bottom:15px;
    font-size:26px;
}

.about-images {
    display: flex;
    gap: 20px;
    margin-top: 30px;
}

.about-images img {
    width: 160px;
    height: 160px;
    object-fit: cover;
    border-radius: 20px;
}


@media(max-width:1024px){

    .about-container{
        padding:20px;
    }

    .about-title{
        font-size:60px;
        line-height:1;
        margin-bottom:35px;
    }

    .about-hero img{
        height:320px;
        border-radius:22px;
    }

    .about-box{
        padding:40px 30px;
        border-radius:25px;
    }

    .about-text h2{
        font-size:30px;
    }

    .stats-grid{
        grid-template-columns:1fr;
        gap:20px;
        margin:50px 0;
    }

    .stat-card{
        padding:30px;
    }

    .stat-card h3{
        font-size:36px;
    }

    .mission-section{
        flex-direction:column;
        gap:20px;
    }

    .mission-card{
        padding:30px;
    }

    .mission-card h3{
        font-size:24px;
    }

    .about-images{
        gap:15px;
    }

    .about-images img{
        width:100%;
        height:240px;
        flex:1;
    }
}


@media(max-width:768px){

    .about-container{
        padding:16px;
    }

    .about-title{
        font-size:40px;
        margin-bottom:25px;
    }

    .about-hero img{
        height:220px;
        border-radius:18px;
        margin-bottom:30px;
    }

    .about-box{
        padding:25px 18px;
        border-radius:20px;
    }

    .about-text h2{
        font-size:24px;
        margin-bottom:15px;
    }

    .about-text p{
        font-size:15px;
        line-height:1.7;
    }

    .stats-grid{
        margin:35px 0;
    }

    .stat-card{
        padding:22px;
    }

    .stat-card h3{
        font-size:30px;
    }

    .mission-card{
        padding:22px;
    }

    .mission-card h3{
        font-size:20px;
    }

    .about-images{
        flex-direction:column;
        margin-top:20px;
    }

    .about-images img{
        width:100%;
        height:180px;
        border-radius:16px;
    }
}


@media(max-width:480px){

    .about-title{
        font-size:32px;
    }

    .about-hero img{
        height:180px;
    }

    .about-box{
        padding:20px 16px;
    }

    .about-text h2{
        font-size:22px;
    }

    .stat-card h3{
        font-size:26px;
    }

    .mission-card h3{
        font-size:18px;
    }

    .about-images img{
        height:150px;
    }
}
.reveal {
    opacity: 0;
    transform: translateY(40px);
    transition: all 0.8s ease;
    will-change: transform, opacity;
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}

.stat-card,
.mission-card {
    transition: 0.3s ease;
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
<script>
document.addEventListener("DOMContentLoaded", () => {

    const counters = document.querySelectorAll(".counter");

    const animateCounter = (el) => {
        const target = +el.dataset.target;
        let current = 0;

        const increment = Math.ceil(target / 1000); // viteza

        const update = () => {
            current += increment;

            if (current >= target) {
                el.textContent = target;
            } else {
                el.textContent = current;
                requestAnimationFrame(update);
            }
        };

        update();
    };

    const observer = new IntersectionObserver((entries, observer) => {

        entries.forEach(entry => {
            if (entry.isIntersecting) {

                // pornește o singură dată
                if (!entry.target.classList.contains("done")) {
                    entry.target.classList.add("done");
                    animateCounter(entry.target);
                }
            }
        });

    }, {
        threshold: 0.6
    });

    counters.forEach(counter => observer.observe(counter));

});
</script>