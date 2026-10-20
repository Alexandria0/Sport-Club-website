<x-app-layout>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Oswald:wght@500;600&display=swap" rel="stylesheet">

<style>



.input-invalid {
    border-color: #dc2626 !important;
    box-shadow: 0 0 0 3px rgba(220,38,38,0.15);
}

/* TEXT EROARE SUB INPUT */
.input-error {
    color: #dc2626;
    font-size: 13px;
    margin-top: 6px;
    font-weight: 500;
}
    /* TERRAIN */
.terrain-group{
    display:flex;
    gap:16px;
    flex-wrap:wrap;
    margin-top:8px;
}

.terrain-radio{
    display:flex;
    align-items:center;
    gap:8px;
    cursor:pointer;
    font-size:15px;
    color:#444;
    user-select:none;
}

.terrain-radio input{
    display:none;
}

.terrain-check{
    width:18px;
    height:18px;
    border:1px solid #ccc;
    border-radius:50%;
    position:relative;
    transition:0.2s;
}

.terrain-radio input:checked + .terrain-check{
    background:#4A7D89;
    border-color:#4A7D89;
}

.terrain-radio input:checked + .terrain-check::after{
    content:"";
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    width:8px;
    height:8px;
    border-radius:50%;
    background:white;
}
@media(max-width:768px){

    .terrain-group{
        gap:12px;
    }

    .terrain-radio{
        font-size:14px;
    }
}

@media(max-width:480px){

    .terrain-group{
        flex-direction:column;
        align-items:flex-start;
        gap:10px;
    }

    .terrain-radio{
        font-size:13px;
    }
}
.page-container {
    padding: 10px 40px;
    max-width: 100%;
    font-family: 'Poppins', sans-serif;
}

.page-title {
    font-family: 'Oswald', sans-serif;
    font-size: 46px;
    font-weight: 600;
    margin-bottom: 40px;
    text-align: center;
    text-transform: uppercase;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 4px;
    font-size: 16px;
    font-weight: 300;
}

.form-input {
    width: 100%;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid #e5e5e5;
    font-size: 16px;
    font-family: 'Poppins', sans-serif;
    transition: 0.2s ease;
}

.form-input:focus {
    outline: none;
    border-color: #4A7D89;
    box-shadow: 0 0 0 3px rgba(36, 190, 224, 0.2);
}

textarea.form-input {
    min-height: 120px;
}

.days-group {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.custom-checkbox {
    display: flex;
    align-items: center;
    gap: 5px;
    cursor: pointer;
    font-size: 16px;
    color: #444;
}

.custom-checkbox input {
    display: none;
}

.checkmark {
    width: 18px;
    height: 18px;
    border: 1px solid #ccc;
    border-radius: 3px;
    position: relative;
}

.custom-checkbox input:checked + .checkmark {
    background: #4A7D89;
    border-color: #4A7D89;
}

.custom-checkbox input:checked + .checkmark::after {
    content: "";
    position: absolute;
    left: 6px;
    top: 2px;
    width: 4px;
    height: 9px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.form-button {
    margin-top: 10px;
    background: #111;
    color: white;
    padding: 10px 22px;
    border-radius: 12px;
    border: none;
    font-size: 14px;
    cursor: pointer;
}

.form-button:hover {
    background: #333;
}

#preview,
#existingImages {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}

.preview-box {
    position: relative;
}

.preview-box img {
    width: 100px;
    height: 100px;
    border-radius: 10px;
    object-fit: cover;
}

.delete-image {
    position: absolute;
    top: -6px;
    right: -6px;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    border: none;
    background: red;
    color: white;
    cursor: pointer;
    font-size: 12px;
}

.bg-preview img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 12px;
    margin-top: 10px;
}
.preview-box{
    position:relative;
}

.delete-image{
    position:absolute;
    top:-8px;
    right:-8px;

    width:24px;
    height:24px;

    border:none;
    border-radius:50%;

    background:red;
    color:white;

    cursor:pointer;

    font-size:12px;
    font-weight:bold;
}
.terrain-type-title{
    font-size:22px;
    font-weight:700;
    margin-bottom:20px;
    margin-top:10px;
    color:black;
    text-transform:uppercase;
}
.terrain-box{
    border:1px solid #ddd;
    border-radius:16px;
    padding:20px;
    margin-top:20px;
}

.terrain-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

/* =========================
   TABLET
========================= */
@media (max-width: 1024px) {

    .page-container {
        padding: 20px;
    }

    .page-title {
        font-size: 38px;
        margin-bottom: 30px;
    }

    .form-input {
        font-size: 15px;
    }
}

/* =========================
   MOBILE
========================= */
@media (max-width: 768px) {

    .page-container {
        padding: 16px;
    }

    .page-title {
        font-size: 28px;
        margin-bottom: 25px;
    }

    .form-label {
        font-size: 14px;
    }

    .form-input {
        font-size: 14px;
        padding: 10px 12px;
        border-radius: 10px;
    }

    textarea.form-input {
        min-height: 100px;
    }

    /* ZILE - vertical */
    .days-group {
        flex-direction: column;
        gap: 8px;
    }

    .custom-checkbox {
        font-size: 14px;
    }

    /* IMAGINI */
    #preview img,
    .preview-box img {
        width: 80px;
        height: 80px;
    }

    .bg-preview img {
        width: 100px !important;
        height: 100px !important;
    }

    /* buton */
    .form-button {
        width: 100%;
        font-size: 14px;
        padding: 12px;
    }
}

/* =========================
   SMALL MOBILE
========================= */
@media (max-width: 480px) {

    .page-title {
        font-size: 22px;
    }

    .form-input {
        font-size: 13px;
    }

    .form-label {
        font-size: 13px;
    }

    .custom-checkbox {
        font-size: 13px;
    }

    #preview img,
    .preview-box img {
        width: 65px;
        height: 65px;
    }

    .bg-preview img {
        width: 90px !important;
        height: 90px !important;
    }
    .terrain-type-title{
    font-size:24px;
    font-weight:700;
    margin-bottom:20px;
    margin-top:10px;
    text-transform:uppercase;
}



@media(max-width:700px){

    .terrain-grid{
        grid-template-columns:1fr;
    }
}

}
</style>

<div class="page-container">

    <h1 class="page-title">Editare rezervare</h1>

    <form
        method="POST"
        action="{{ route('rezervari.update', $reservation->id) }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <!-- DENUMIRE -->
        <div class="form-group">
            <label class="form-label">Denumirea instituției</label>

            <input
                type="text"
                name="title"
                class="form-input @error('title') input-invalid @enderror"
                value="{{ $reservation->title }}"
            >
            @error('title')
    <p class="input-error">{{ $message }}</p>
@enderror
        </div>

        <!-- SPORT -->
        <div class="form-group">
            <label class="form-label">Sport</label>

            <input
                type="text"
                name="sport"
                class="form-input @error('sport') input-invalid @enderror"
                value="{{ $reservation->sport }}"
            >
            @error('sport')
    <p class="input-error">{{ $message }}</p>
@enderror
        </div>

        <!-- SECTOR -->
        <div class="form-group">
            <label class="form-label">Sector</label>

            <select name="sector" class="form-input @error('sector') input-invalid @enderror">

                <option {{ $reservation->sector == 'Centru' ? 'selected' : '' }}>
                    Centru
                </option>

                <option {{ $reservation->sector == 'Botanica' ? 'selected' : '' }}>
                    Botanica
                </option>

                <option {{ $reservation->sector == 'Râșcani' ? 'selected' : '' }}>
                    Râșcani
                </option>

                <option {{ $reservation->sector == 'Ciocana' ? 'selected' : '' }}>
                    Ciocana
                </option>

                <option {{ $reservation->sector == 'Buiucani' ? 'selected' : '' }}>
                    Buiucani
                </option>

            </select>
            @error('sector')
    <p class="input-error">{{ $message }}</p>
@enderror
        </div>

        <!-- ADRESA -->
        <div class="form-group">
            <label class="form-label">Adresa</label>

            <input
                type="text"
                name="address"
                class="form-input @error('address') input-invalid @enderror"
                value="{{ $reservation->address }}"
            >
            @error('address')
    <p class="input-error">{{ $message }}</p>
@enderror
        </div>
<!-- TIPURI TEREN -->
<div class="form-group">

    <label class="form-label">
        Tipuri teren
    </label>

    @php

        $insideTerrains = $reservation->terrains
            ->where('terrain_type', 'inside');

        $outsideTerrains = $reservation->terrains
            ->where('terrain_type', 'outside');

    @endphp

    <div class="terrain-types">

        <label class="custom-checkbox">

            <input
                type="checkbox"
                id="insideCheck"
                {{ $insideTerrains->count() ? 'checked' : '' }}
            >

            <span class="checkmark"></span>

            Interior

        </label>

        <label class="custom-checkbox">

            <input
                type="checkbox"
                id="outsideCheck"
                {{ $outsideTerrains->count() ? 'checked' : '' }}
            >

            <span class="checkmark"></span>

            Exterior

        </label>

    </div>

</div>

<!-- TERENURI -->
<div id="terrainFields"></div>

        <!-- DETALII -->
        <div class="form-group">
            <label class="form-label">
                Detalii
            </label>

            <textarea
                name="details"
                class="form-input @error('details') input-invalid @enderror"
            >{{ $reservation->details }}</textarea>
            @error('details')
                <p class="input-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- ZILE -->
        <div class="form-group">

            <label class="form-label">
                Zile disponibile
            </label>

            <div class="days-group">

                @php
                    $days = [
                        'Luni',
                        'Marti',
                        'Miercuri',
                        'Joi',
                        'Vineri',
                        'Sambata',
                        'Duminica'
                    ];
                @endphp

                @foreach($days as $day)

                    <label class="custom-checkbox">

                        <input
                            type="checkbox"
                            name="working_days[]"
                            value="{{ $day }}"
                            {{ in_array($day, $reservation->working_days ?? []) ? 'checked' : '' }}
                        >

                        <span class="checkmark"></span>

                        {{ $day }}

                    </label>

                @endforeach

            </div>

        </div>

        <!-- PROGRAM -->
        <div class="form-group">

            <label class="form-label">Program</label>

            <select name="start_time" class="form-input @error('start_time') input-invalid @enderror">

    @for($h = 0; $h <= 23; $h++)

        @php
            $time = sprintf('%02d:00', $h);
        @endphp

        <option
            value="{{ $time }}"
            {{
                \Carbon\Carbon::parse($reservation->start_time)
                ->format('H:i') == $time
                ? 'selected'
                : ''
            }}
        >
            {{ $time }}
        </option>

    @endfor

</select>

            <br><br>

            <select name="end_time" class="form-input @error('end_time') input-invalid @enderror">

    @for($h = 0; $h <= 23; $h++)

        @php
            $time = sprintf('%02d:00', $h);
        @endphp

        <option
            value="{{ $time }}"
            {{
                \Carbon\Carbon::parse($reservation->end_time)
                ->format('H:i') == $time
                ? 'selected'
                : ''
            }}
        >
            {{ $time }}
        </option>

    @endfor

</select>

        </div>

        <!-- IMAGINI EXISTENTE -->
        <div class="form-group">

            <label class="form-label">
                Imagini existente
            </label>

   <div id="existingImages">

    @foreach($reservation->images as $image)

        <div
            class="preview-box"
            id="image-{{ $image->id }}"
        >

            <img
                src="{{ asset('storage/' . $image->image) }}"
            >

            <button
                type="button"
                class="delete-image"
                onclick="deleteImage({{ $image->id }})"
            >
                ✕
            </button>

        </div>

    @endforeach

</div>

        </div>

        <!-- ADAUGĂ IMAGINI -->
        <div class="form-group">

            <label class="form-label">
                Adaugă imagini noi
            </label>

            <input
                type="file"
                name="images[]"
                multiple
                id="galleryInput"
                class="form-input @error('images') input-invalid @enderror"
            >
            @error('images')
                <p class="input-error">{{ $message }}</p>
            @enderror

            <div id="preview"></div>

        </div>

        <!-- BACKGROUND -->
        <div class="form-group">

            <label class="form-label">
                Imagine background
            </label>

            <input
                type="file"
                name="background_image"
                id="bgInput"
                class="form-input @error('background_image') input-invalid @enderror"
            >
            @error('background_image')
                <p class="input-error">{{ $message }}</p>
            @enderror

            <div class="bg-preview">

                @if($reservation->background_image)

                    <img
                        src="{{ asset('storage/' . $reservation->background_image) }}"
                    >

                @endif

            </div>

        </div>

        <button class="form-button">
            Salvează modificările
        </button>

    </form>

</div>

<script>
let filesArray = [];

const input = document.getElementById('galleryInput');
const preview = document.getElementById('preview');

input.addEventListener('change', function (e) {
    filesArray = filesArray.concat(Array.from(e.target.files));

    updatePreview();
    updateInputFiles();
});

function updatePreview() {

    preview.innerHTML = "";

    filesArray.forEach((file, index) => {

        const reader = new FileReader();

        reader.onload = function (event) {

            const box = document.createElement('div');
            box.classList.add('preview-box');

            const img = document.createElement('img');
            img.src = event.target.result;

            const btn = document.createElement('button');
            btn.type = "button";
            btn.classList.add('delete-image');
            btn.innerHTML = "✕";

            btn.onclick = function () {

                filesArray.splice(index, 1);

                updatePreview();
                updateInputFiles();
            };

            box.appendChild(img);
            box.appendChild(btn);

            preview.appendChild(box);
        };

        reader.readAsDataURL(file);
    });
}

function updateInputFiles() {
    const dataTransfer = new DataTransfer();

    filesArray.forEach(file => {
        dataTransfer.items.add(file);
    });

    input.files = dataTransfer.files;
}

const bgInput = document.getElementById('bgInput');

bgInput.addEventListener('change', function(e){

    const previewBox =
        document.querySelector('.bg-preview');

    previewBox.innerHTML = "";

    const file = e.target.files[0];

    if(!file) return;

    const reader = new FileReader();

    reader.onload = function(event){

        const img = document.createElement('img');

        img.src = event.target.result;

        previewBox.appendChild(img);
    };

    reader.readAsDataURL(file);

});

</script>
<script>
async function deleteImage(id)
{
    const response = await fetch(`/reservation-images/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    });

    const data = await response.json();

    if (data.success) {
        const el = document.getElementById(`image-${id}`);
        if (el) el.remove();
    }
}
</script>
<script>

const insideCheck = document.getElementById('insideCheck');
const outsideCheck = document.getElementById('outsideCheck');

const terrainFields = document.getElementById('terrainFields');

const terrainsData = {

    inside: @json(
        $insideTerrains->values()
    ),

    outside: @json(
        $outsideTerrains->values()
    )
};

insideCheck.addEventListener(
    'change',
    renderTerrains
);

outsideCheck.addEventListener(
    'change',
    renderTerrains
);

renderTerrains();

function renderTerrains(){

    terrainFields.innerHTML = '';

    if(insideCheck.checked){

        createTerrainSection(
            'inside',
            'Interior',
            terrainsData.inside
        );
    }

    if(outsideCheck.checked){

        createTerrainSection(
            'outside',
            'Exterior',
            terrainsData.outside
        );
    }
}

function createTerrainSection(type, label, terrains){

    const wrapper = document.createElement('div');

    wrapper.classList.add('terrain-box');

    wrapper.innerHTML = `

        <div class="terrain-type-title">
            Terenuri ${label}
        </div>

        <div class="form-group">

            <label class="form-label">
                Număr terenuri
            </label>

            <input
                type="number"
                min="1"
                value="${terrains.length || 1}"
                class="form-input terrain-count"
                data-type="${type}"
            >

        </div>

        <div
            class="terrain-items"
            id="${type}-items"
        ></div>
    `;

    terrainFields.appendChild(wrapper);

    generateTerrainInputs(
        type,
        terrains.length || 1,
        terrains
    );

    const countInput = wrapper.querySelector(
        '.terrain-count'
    );

    countInput.addEventListener('input', function(){

        let count = parseInt(this.value);

        if(count < 1 || isNaN(count)){
            count = 1;
        }

        generateTerrainInputs(type, count, terrains);
    });
}

function generateTerrainInputs(
    type,
    count,
    terrains = []
){

    const container = document.getElementById(
        `${type}-items`
    );

    container.innerHTML = '';

    for(let i = 0; i < count; i++){

        const terrain = terrains[i] || {};

        container.innerHTML += `

            <div class="terrain-box">

                <h3>
                    Teren ${i + 1}
                </h3>

                <div class="terrain-grid">

                    <div class="form-group">

                        <label class="form-label">
                            Denumire teren
                        </label>

                        <input
                            type="text"
                            name="terrains[${type}][${i}][name]"
                            class="form-input"
                            value="${
                                terrain.name ||
                                `Teren ${i + 1}`
                            }"
                        >

                    </div>

                    <div class="form-group">

                        <label class="form-label">
                            Preț
                        </label>

                        <input
                            type="number"
                            name="terrains[${type}][${i}][price]"
                            class="form-input"
                            value="${
        terrain.price ?? ''
    }"
                        >

                    </div>

                    <div class="form-group">

                        <label class="form-label">
                            Dimensiune
                        </label>

                        <input
                            type="text"
                            name="terrains[${type}][${i}][size]"
                            class="form-input"
                            value="${
                                terrain.size || ''
                            }"
                        >

                    </div>

                </div>

            </div>
        `;
    }
}

</script>

</x-app-layout>