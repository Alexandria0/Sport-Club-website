<x-app-layout>

<!-- FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Oswald:wght@500;600&display=swap" rel="stylesheet">

<style>
    /* TERRAIN RADIO */
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
    border-color:#4A7D89;
    background:#4A7D89;
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
    .input-error{
    color: #dc2626;
    font-size: 13px;
    margin-top: 6px;
    font-weight: 500;
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
    font-weight: 200;
}

.form-input {
    width: 100%;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid #e5e5e5;
    font-size: 16px;
    font-family: 'Poppins', sans-serif;
    transition: all 0.2s ease;
}

.form-input::placeholder {
    color: #bdbdbd;
}

.form-input:focus {
    outline: none;
    border-color: #999;
    background-color: #fff;
}

textarea.form-input {
    min-height: 120px;
}

.days-group {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.form-button {
    margin-top: 5px;
    background: #111;
    color: white;
    padding: 10px 20px;
    border-radius: 12px;
    border: none;
    font-size: 14px;
    cursor: pointer;
    transition: 0.2s;
}

.form-button:hover {
    background: #333;
}

#preview {
    margin-top: 10px;
    display: flex;
    flex-wrap: wrap;
}

#preview img {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border-radius: 10px;
    margin: 6px;
}
#galleryInput {
    font-size: 14px;
}

.custom-checkbox {
    display: flex;
    align-items: center;
    gap: 5px;
    cursor: pointer;
    font-size: 16px;
    color: #444;
    user-select: none;
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
    transition: 0.2s;
}

/* când e bifat */
.custom-checkbox input:checked + .checkmark {
    background-color: #4A7D89; 
    border-color: #4A7D89;
}

/* bifa */
.custom-checkbox input:checked + .checkmark::after {
    content: "";
    position: absolute;
    left: 7px;
    top: 3px;
    width: 4px;
    height: 9px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}
.form-input:focus {
    outline: none;
    border-color: #4A7D89; /* verde */
    box-shadow: 0 0 0 3px rgba(36, 190, 224, 0.2); 
}
.preview-box{
    position: relative;
}

.delete-image{
    position: absolute;
    top: -8px;
    right: -8px;

    width: 24px;
    height: 24px;

    border: none;
    border-radius: 50%;

    background: red;
    color: white;

    cursor: pointer;

    font-size: 12px;
    font-weight: bold;

    display: flex;
    align-items: center;
    justify-content: center;

    box-shadow: 0 2px 6px rgba(0,0,0,0.2);

    transition: 0.2s;
}

.delete-image:hover{
    background: #cc0000;
    transform: scale(1.05);
}
/* .input-invalid{
    border-color: #dc2626 !important;
    box-shadow: 0 0 0 3px rgba(220,38,38,0.15);
} */
.bg-preview-box{
    position: relative;
    display: inline-block;
    margin-top: 10px;
}

.bg-delete{
    position: absolute;
    top: -8px;
    right: -8px;

    width: 24px;
    height: 24px;

    border: none;
    border-radius: 50%;

    background: red;
    color: white;

    cursor: pointer;

    font-size: 12px;
    font-weight: bold;

    display: flex;
    align-items: center;
    justify-content: center;

    box-shadow: 0 2px 6px rgba(0,0,0,0.2);

    transition: 0.2s;
}

.bg-delete:hover{
    background: #cc0000;
    transform: scale(1.05);
}

/* =========================
   TABLET
========================= */
@media(max-width:768px){

    input[type="file"]{
        font-size:13px;
    }

}

@media(max-width:480px){

    input[type="file"]{
        font-size:12px;
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

    .form-input {
        font-size: 15px;
    }

    .days-group {
        gap: 10px;
    }

}
@media(max-width:768px){

    .form-input{
        font-size:14px;
        padding:10px 12px;
    }

    .custom-checkbox,
    .terrain-radio{
        font-size:14px;
    }

    .terrain-type-title{
        font-size:18px;
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

    /* zile mai compacte */
    .days-group {
        flex-direction: column;
        gap: 8px;
        font-size: 14px;
    }

    .custom-checkbox {
        font-size: 14px;
    }

    /* program (start/end) */
    select.form-input {
        font-size: 14px;
    }

    /* preview imagini */
    #preview img {
        width: 70px;
        height: 70px;
    }

    /* background preview */
    .bg-preview-box img {
        width: 100px !important;
        height: 100px !important;
    }

    .form-button {
        width: 100%;
        font-size: 14px;
        padding: 12px;
    }

    .input-error {
        font-size: 12px;
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

    #preview img {
        width: 60px;
        height: 60px;
    }

    .bg-preview-box img {
        width: 90px !important;
        height: 90px !important;
    }
}
</style>
<style>

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

@media(max-width:700px){
    .terrain-grid{
        grid-template-columns:1fr;
    }
}
@media (max-width:768px){

    .form-label{
        font-size:14px !important;
    }

    input[type="file"]{
        font-size:13px !important;
    }

}

@media (max-width:480px){

    .form-label{
        font-size:13px !important;
    }

    input[type="file"]{
        font-size:12px !important;
    }

}


</style>

<div class="page-container">

    <h1 class="page-title">Rezervări</h1>

    <form method="POST" action="{{ route('rezervari') }}" enctype="multipart/form-data">
        @csrf

        <!-- DENUMIRE -->
        <div class="form-group">
            <label class="form-label">Denumirea instituției</label>
            <input type="text" name="title" class="form-input @error('title') input-invalid @enderror" placeholder="denumirea" value="{{ old('title') }}">
        @error('title')
    <p class="input-error">{{ $message }}</p>
    @enderror
        </div>

        <!-- SPORT -->
        <div class="form-group">
            <label class="form-label">Sport</label>
            <input type="text" name="sport" class="form-input @error('sport') input-invalid @enderror" placeholder="sport" value="{{ old('sport') }}">
            @error('sport')
    <p class="input-error">{{ $message }}</p>
@enderror
        </div>
        <!-- SECTOR -->
<div class="form-group">
            <label class="form-label">Sector</label>
    <select name="sector" class="form-input">

    <option disabled {{ old('sector') ? '' : 'selected' }}>
        Alege sector
    </option>

    <option value="Centru" {{ old('sector') == 'Centru' ? 'selected' : '' }}>Centru</option>

    <option value="Botanica" {{ old('sector') == 'Botanica' ? 'selected' : '' }}>Botanica</option>

    <option value="Râșcani" {{ old('sector') == 'Râșcani' ? 'selected' : '' }}>Râșcani</option>

    <option value="Ciocana" {{ old('sector') == 'Ciocana' ? 'selected' : '' }}>Ciocana</option>

    <option value="Buiucani" {{ old('sector') == 'Buiucani' ? 'selected' : '' }}>Buiucani</option>

</select>
    
 @error('sector')
    <p class="input-error">{{ $message }}</p>
@enderror
</div>

        <!-- ADRESA -->
        <div class="form-group">
            <label class="form-label">Adresa</label>
            <input type="text" name="address" class="form-input" placeholder="strada" value="{{ old('address') }}">
            @error('address')
    <p class="input-error">{{ $message }}</p>
@enderror
        </div>
        <!-- PREȚ -->
<div class="form-group">

</div>
<!-- TIPURI TEREN -->
<div class="form-group">

    <label class="form-label">Tipuri teren</label>

    <div class="terrain-types">
        <p id="terrainTypeError"
   class="input-error"
   style="display:none;">
   Selectează cel puțin un tip de teren.
</p>


        <label class="custom-checkbox">
            <input type="checkbox" id="insideCheck">
            <span class="checkmark"></span>
            Interior
        </label>

        <label class="custom-checkbox">
            <input type="checkbox" id="outsideCheck">
            <span class="checkmark"></span>
            Exterior
        </label>
        @error('terrains')
<p class="input-error">{{ $message }}</p>
@enderror

    </div>

</div>

<!-- TERENURI GENERATE -->
<div id="terrainFields"></div>

        <!-- DETALII -->
        <div class="form-group">
            <label class="form-label">Detalii (dimensiune teren, condiții de acces, etc.)</label>
            <textarea name="details" class="form-input" placeholder="detalii">{{ old('details') }}</textarea>
            @error('details')
    <p class="input-error">{{ $message }}</p>
@enderror
        </div>

        <!-- ZILE -->
        <div class="form-group">
            <label class="form-label">Zile disponibile</label>

            <div class="days-group">
                @php
                    $days = ['Luni','Marti','Miercuri','Joi','Vineri','Sambata','Duminica'];
                @endphp

                @foreach($days as $day)
                    <label class="custom-checkbox">
    <input type="checkbox" name="working_days[]" value="{{ $day }}" {{ in_array($day, old('working_days', [])) ? 'checked' : '' }}>
    <span class="checkmark"></span>
    {{ $day }}
</label>
                @endforeach
            </div>
            @error('working_days')
    <p class="input-error">{{ $message }}</p>
@enderror
        </div>

  <!-- PROGRAM -->
<div class="form-group">
    <label class="form-label">Program</label>

    <!-- START TIME -->
    <select id="start_time"
            name="start_time"
            class="form-input @error('start_time') input-invalid @enderror">

        <option value="" disabled {{ old('start_time') ? '' : 'selected' }}>
            Ora de început
        </option>

        @for($h = 0; $h <= 23; $h++)

            <option
                value="{{ sprintf('%02d:00', $h) }}"
                {{ old('start_time') == sprintf('%02d:00', $h) ? 'selected' : '' }}
            >
                {{ sprintf('%02d:00', $h) }}
            </option>

        @endfor

    </select>

    @error('start_time')
        <p class="input-error">{{ $message }}</p>
    @enderror

    <br><br>

    <!-- END TIME -->
    <select id="end_time"
            name="end_time"
            class="form-input @error('end_time') input-invalid @enderror">

        <option value="" disabled {{ old('end_time') ? '' : 'selected' }}>
            Ora de sfârșit
        </option>

        @for($h = 0; $h <= 23; $h++)

            <option
                value="{{ sprintf('%02d:00', $h) }}"
                {{ old('end_time') == sprintf('%02d:00', $h) ? 'selected' : '' }}
            >
                {{ sprintf('%02d:00', $h) }}
            </option>

        @endfor

    </select>

    @error('end_time')
        <p class="input-error">{{ $message }}</p>
    @enderror

    <p id="timeError" class="input-error" style="display:none;">
        Ora de sfârșit trebuie să fie mai mare decât ora de început.
    </p>

</div>
        <!-- GALERIE -->
        <div class="form-group">
            <label class="form-label">Galerie imagini</label>

            <input type="file" name="images[]" multiple id="galleryInput" class="form-input">
            @error('images')
            <p class="input-error">{{ $message }}</p>
            @enderror

            <div id="preview"></div>
        </div>

       <!-- BACKGROUND -->
<div class="form-group">
    <label class="form-label" style="font-size:16px;">Imagine background</label>
   
    <input type="file" name="background_image" id="bgInput" class="form-input" style="font-size:14px;">
     @error('background_image')
    <p class="input-error">{{ $message }}</p>
    @enderror

    <div id="bgPreview"></div>
</div>

        <button class="form-button">Salvează</button>

    </form>

</div>

<script>
let filesArray = [];

const input = document.getElementById('galleryInput');
const preview = document.getElementById('preview');

input.addEventListener('change', function (e) {

    const newFiles = Array.from(e.target.files);

    newFiles.forEach((file) => {

        filesArray.push(file);

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

                filesArray = filesArray.filter(f => f !== file);
                syncInput();
                box.remove();
            };

            box.appendChild(img);
            box.appendChild(btn);

            preview.appendChild(box);
        };

        reader.readAsDataURL(file);
    });

    input.value = "";
    syncInput();
});

function syncInput()
{
    const dt = new DataTransfer();

    filesArray.forEach(file => {
        dt.items.add(file);
    });

    input.files = dt.files;
}
/* =========================
   BACKGROUND IMAGE
========================= */
const bgInput = document.getElementById('bgInput');
const bgPreview = document.getElementById('bgPreview');

bgInput.addEventListener('change', function (e) {

    const file = e.target.files[0];

    if (!file) return;

    const reader = new FileReader();

    reader.onload = function (event) {

        bgPreview.innerHTML = "";

        const box = document.createElement('div');
        box.classList.add('bg-preview-box');

        const img = document.createElement('img');
        img.src = event.target.result;

        img.style.width = "120px";
        img.style.height = "120px";
        img.style.objectFit = "cover";
        img.style.borderRadius = "10px";

        const btn = document.createElement('button');
        btn.type = "button";
        btn.classList.add('bg-delete');
        btn.innerHTML = "✕";

        btn.onclick = function () {
            bgInput.value = "";
            bgPreview.innerHTML = "";
        };

        box.appendChild(img);
        box.appendChild(btn);

        bgPreview.appendChild(box);
    };

    reader.readAsDataURL(file);
});
/* =========================
   VALIDARE PROGRAM LIVE
========================= */

const startTime = document.getElementById('start_time');
const endTime = document.getElementById('end_time');
const timeError = document.getElementById('timeError');

function validateTime() {

    if (!startTime.value || !endTime.value) {

        timeError.style.display = "none";

        startTime.style.borderColor = "#e5e5e5";
        endTime.style.borderColor = "#e5e5e5";

        return;
    }

    if (endTime.value <= startTime.value) {

        timeError.style.display = "block";

        startTime.style.borderColor = "#e5e5e5";
        endTime.style.borderColor = "#e5e5e5";

    } else {

        timeError.style.display = "none";

        startTime.style.borderColor = "#e5e5e5";
        endTime.style.borderColor = "#e5e5e5";
    }
}

startTime.addEventListener('change', validateTime);
endTime.addEventListener('change', validateTime);

/* =========================
   SCROLL LA PRIMA EROARE
========================= */

window.addEventListener('load', () => {

    const firstError = document.querySelector('.input-error');

    if (firstError) {

        firstError.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }
});

/* =========================
   VALIDARE LIVE INPUTURI
========================= */

const requiredInputs = document.querySelectorAll(
    'input[type="text"], textarea, select'
);

requiredInputs.forEach(input => {

    input.addEventListener('blur', () => {

        let error =
            input.parentElement.querySelector('.live-error');

        if (!error) {

            error = document.createElement('p');

            error.classList.add(
                'input-error',
                'live-error'
            );

            input.parentElement.appendChild(error);
        }

        if (!input.value.trim()) {

            error.innerText =
                'Acest câmp este obligatoriu.';

            input.style.borderColor = '#dc2626';

        } else {

            error.innerText = '';

            input.style.borderColor = '#e5e5e5';
        }
    });
});

/* =========================
   DELETE IMAGINI EXISTENTE
========================= */

async function deleteImage(id)
{
    const token =
        document.querySelector('meta[name="csrf-token"]').content;

    const response = await fetch(`/reservation-images/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    });

    const data = await response.json();

    if (data.success) {
        document.getElementById(`image-${id}`)?.remove();
    }
}



</script>
<script>

const insideCheck = document.getElementById('insideCheck');
const outsideCheck = document.getElementById('outsideCheck');

const terrainFields =
    document.getElementById('terrainFields');

const oldTerrains =
    @json(old('terrains', []));

const terrainData = {
    inside: oldTerrains.inside || [],
    outside: oldTerrains.outside || []
};

insideCheck.addEventListener(
    'change',
    renderTerrains
);

outsideCheck.addEventListener(
    'change',
    renderTerrains
);

window.addEventListener('load', () => {

    if(
        terrainData.inside &&
        Object.keys(terrainData.inside).length
    ){
        insideCheck.checked = true;
    }

    if(
        terrainData.outside &&
        Object.keys(terrainData.outside).length
    ){
        outsideCheck.checked = true;
    }

    renderTerrains();
});

function renderTerrains(){

    terrainFields.innerHTML = '';

    if(insideCheck.checked){
        createTerrainSection('inside', 'Interior');
    }

    if(outsideCheck.checked){
        createTerrainSection('outside', 'Exterior');
    }
}

function createTerrainSection(type, label){

    const wrapper = document.createElement('div');

    wrapper.classList.add('terrain-box');

    const count =
    Object.keys(terrainData[type]).length || 1;

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
                value="${count}"
                class="form-input terrain-count"
                data-type="${type}"
            >

        </div>

        <div class="terrain-items"
             id="${type}-items"></div>
    `;

    terrainFields.appendChild(wrapper);

    generateTerrainInputs(type, count);

    const countInput =
        wrapper.querySelector('.terrain-count');

    countInput.addEventListener('input', function(){

        let count = parseInt(this.value);

        if(count < 1 || isNaN(count)){
            count = 1;
        }

        saveTerrainData(type);

        generateTerrainInputs(type, count);
    });
}

function saveTerrainData(type){

    terrainData[type] = [];

    const container =
        document.getElementById(`${type}-items`);

    if(!container) return;

    const boxes =
        container.querySelectorAll('.terrain-box');

    boxes.forEach((box, index) => {

        terrainData[type][index + 1] = {

            name:
                box.querySelector(
                    `[name*="[name]"]`
                )?.value || '',

            price:
                box.querySelector(
                    `[name*="[price]"]`
                )?.value || '',

            size:
                box.querySelector(
                    `[name*="[size]"]`
                )?.value || '',
        };
    });
}

function generateTerrainInputs(type, count){

    const container =
        document.getElementById(`${type}-items`);

    container.innerHTML = '';

    for(let i = 1; i <= count; i++){

        const terrain =
            terrainData[type][i] || {};
           const errors = @json($errors->toArray());

container.innerHTML += `

<div class="terrain-box">

    <h3>Teren ${i}</h3>

    <div class="terrain-grid">

        <div class="form-group">

            <label class="form-label">
                Denumire teren
            </label>

            <input
                type="text"
                name="terrains[${type}][${i}][name]"
                class="form-input
                ${errors[`terrains.${type}.${i}.name`] ? 'input-invalid' : ''}"
                value="${terrain.name || `Teren ${i}`}"
            >

            ${
                errors[`terrains.${type}.${i}.name`]
                ? `<p class="input-error">${errors[`terrains.${type}.${i}.name`][0]}</p>`
                : ''
            }

        </div>

        <div class="form-group">

            <label class="form-label">
                Preț
            </label>

            <input
                type="number"
                name="terrains[${type}][${i}][price]"
                class="form-input
                ${errors[`terrains.${type}.${i}.price`] ? 'input-invalid' : ''}"
                value="${terrain.price || ''}"
                placeholder="500"
            >

            ${
                errors[`terrains.${type}.${i}.price`]
                ? `<p class="input-error">${errors[`terrains.${type}.${i}.price`][0]}</p>`
                : ''
            }

        </div>

        <div class="form-group">

            <label class="form-label">
                Dimensiune
            </label>

            <input
                type="text"
                name="terrains[${type}][${i}][size]"
                class="form-input
                ${errors[`terrains.${type}.${i}.size`] ? 'input-invalid' : ''}"
                value="${terrain.size || ''}"
                placeholder="45x60m"
            >

            ${
                errors[`terrains.${type}.${i}.size`]
                ? `<p class="input-error">${errors[`terrains.${type}.${i}.size`][0]}</p>`
                : ''
            }

        </div>

    </div>

</div>
`;
    }
}
document.querySelector('form').addEventListener('submit', function(e){

    let hasError = false;

    const terrainTypeError =
        document.getElementById(
            'terrainTypeError'
        );

    // reset
    terrainTypeError.style.display =
        'none';

    // verifică checkbox-uri
    if(
        !insideCheck.checked &&
        !outsideCheck.checked
    ){

        hasError = true;

        terrainTypeError.style.display =
            'block';
    }

    // șterge erorile vechi
    document.querySelectorAll('.terrain-error')
        .forEach(error => error.remove());

    document.querySelectorAll('.terrain-required')
        .forEach(input => {
            input.classList.remove('input-invalid');
        });

    const terrainInputs = document.querySelectorAll(
        '#terrainFields .terrain-required'
    );

    terrainInputs.forEach(input => {

        const value = input.value;

        if(!value || value.trim() === ''){

            hasError = true;

            input.classList.add('input-invalid');

            const group =
                input.closest('.form-group');

            const error =
                document.createElement('p');

            error.className =
                'input-error terrain-error';

            error.innerText =
                'Acest câmp este obligatoriu.';

            // adaugă sub câmp
            group.appendChild(error);
        }
    });

    if(hasError){

        e.preventDefault();

        document.querySelector(
            '.input-invalid'
        )?.scrollIntoView({
            behavior:'smooth',
            block:'center'
        });
    }

});
document.addEventListener('input', function(e){

    if(
        e.target.classList.contains(
            'terrain-required'
        )
    ){

        if(e.target.value !== ''){

            e.target.classList.remove(
                'input-invalid'
            );

            const group =
                e.target.closest('.form-group');

            const error =
                group.querySelector(
                    '.terrain-error'
                );

            if(error){
                error.remove();
            }
        }
    }

});
insideCheck.addEventListener('change', () => {

    if(
        insideCheck.checked ||
        outsideCheck.checked
    ){
        document.getElementById(
            'terrainTypeError'
        ).style.display = 'none';
    }

});

outsideCheck.addEventListener('change', () => {

    if(
        insideCheck.checked ||
        outsideCheck.checked
    ){
        document.getElementById(
            'terrainTypeError'
        ).style.display = 'none';
    }

});

</script>
</x-app-layout>