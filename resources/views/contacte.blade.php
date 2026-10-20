<x-app-layout>

<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<div class="contact-page">

    <div class="contact-header">
        <h1 class="contact-title">CONTACTE</h1>
        <div class="contact-line"></div>
    </div>

    <div class="contact-box">

        <div class="contact-left">

            <span class="contact-badge">colaborare</span>

            <h2>
                Hai să dezvoltăm împreună comunitatea sportivă din Chișinău
            </h2>

            <p>
                Dacă administrați un teren sportiv sau reprezentați o companie
                care dorește să își promoveze serviciile, platforma
                <strong>Sport Club</strong> vă oferă posibilitatea de a deveni
                parte dintr-o comunitate activă de pasionați de sport.
            </p>

            <p>
                Prin intermediul aplicației puteți publica informații despre
                terenurile disponibile, programul de funcționare și activitățile
                sportive organizate, facilitând accesul utilizatorilor către
                serviciile oferite.
            </p>

            <p>
                Pentru întrebări, colaborări sau informații suplimentare,
                ne puteți contacta folosind datele afișate alături.
            </p>

        </div>

        <div class="contact-right">

            <div class="contact-card">
                <span>telefon</span>
                <h3>+373 67 226 590</h3>
            </div>

            <div class="contact-card">
                <span>email</span>
                <h3>laravel.sport.club@gmail.com</h3>
            </div>

            <div class="contact-card">
                <span>program</span>
                <h3>Luni - Duminică</h3>
                <p>08:00 - 20:00</p>
            </div>

        </div>

    </div>

</div>

</x-app-layout>

<style>

.contact-page{
    padding:20px 40px;
}

.contact-header{
    text-align:center;
    margin-bottom:40px;
}

.contact-title{
    font-family:'Oswald',sans-serif;
    font-size:46px;
    font-weight:600;
    margin-bottom:0;
    line-height:1;
}

.contact-box{
    background:#f5f7f5;
    border-radius:30px;
    padding:60px;
    display:flex;
    justify-content:space-between;
    gap:60px;
    box-shadow:0 10px 40px rgba(0,0,0,0.04);
}

.contact-left{
    flex:1;
}

.contact-badge{
    display:inline-block;
    background:#dcebdd;
    color: #4a6d82;
    padding:8px 18px;
    border-radius:30px;
    font-size:13px;
    text-transform:uppercase;
    letter-spacing:1px;
    margin-bottom:25px;
}

.contact-left h2{
    font-size:38px;
    line-height:1.2;
    margin-bottom:25px;
    color:#111;
    font-weight:600;
}

.contact-left p{
    color:#555;
    line-height:1.9;
    margin-bottom:18px;
    font-size:15px;
}


/* RIGHT */

.contact-right{
    width:320px;
    display:flex;
    flex-direction:column;
    gap:20px;
}

.contact-card{
    background:white;
    border-radius:22px;
    padding:28px;
    border:1px solid #e7e7e7;
    transition:0.3s;
}


.contact-card span{
    display:block;
    text-transform:uppercase;
    letter-spacing:2px;
    font-size:11px;
    color:#6b8d71;
    margin-bottom:12px;
}

.contact-card h3{
    font-size:16px;
    font-weight:600;
    color:#111;
    margin-bottom:5px;
}

.contact-card p{
    color:#666;
    font-size:14px;
}

@media(max-width:1024px){

    .contact-page{
        padding:25px;
    }

    .contact-title{
        font-size:52px;
    }

    .contact-box{
        flex-direction:column;
        padding:40px;
        gap:40px;
    }

    .contact-right{
        width:100%;
    }

    .contact-left h2{
        font-size:32px;
    }
}


@media(max-width:768px){

    .contact-page{
        padding:16px;
    }

    .contact-title{
        font-size:42px;
    }

    .contact-header{
        margin-bottom:25px;
    }
    .contact-box{
        padding:25px 20px;
        border-radius:22px;
    }

    .contact-left h2{
        font-size:26px;
    }

    .contact-left p{
        font-size:14px;
        line-height:1.7;
    }

    .contact-card{
        padding:22px;
    }

    .contact-card h3{
        font-size:18px;
    }
}


@media(max-width:480px){

    .contact-title{
        font-size:32px;
    }

    .contact-left h2{
        font-size:22px;
    }

    .contact-box{
        padding:20px 16px;
    }

    .contact-card{
        border-radius:18px;
    }
}
.contact-header,
.contact-left,
.contact-card{
    will-change: transform, opacity;
}

</style>
<script>

document.addEventListener("DOMContentLoaded", () => {

    const elements = [
        document.querySelector('.contact-header'),
        document.querySelector('.contact-left'),
        ...document.querySelectorAll('.contact-card')
    ];

    elements.forEach((el, index) => {

        el.style.opacity = "0";
        el.style.transform = "translateY(40px)";
        el.style.transition = "all 0.8s ease";

        setTimeout(() => {
            el.style.opacity = "1";
            el.style.transform = "translateY(0)";
        }, 200 * index);

    });

});

</script>