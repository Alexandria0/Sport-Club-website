<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informații profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Actualizați informațiile de profil și adresa de email a contului dvs.") }}
        </p>
    </header>

    <!-- SEND VERIFICATION -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- MAIN FORM -->
    <form method="post"
          action="{{ route('profile.update') }}"
          class="mt-6 space-y-6"
          enctype="multipart/form-data">

        @csrf
        @method('patch')

        <!-- AVATAR -->
        <div>
            <x-input-label for="avatar" :value="__('Poză profil')" />

            <!-- BUTTON -->
<label for="avatar" class="avatar-btn">
    Alege poza
</label>

<input id="avatar"
       name="avatar"
       type="file"
       class="hidden"
       accept="image/*"
       onchange="previewAvatar(event)">
                   <div class="mt-3">
    <img id="avatarPreview"
         src="{{ $user->avatar ? asset('storage/'.$user->avatar) : '' }}"
         class="avatar-preview"
         style="{{ $user->avatar ? '' : 'display:none;' }}">
</div>

@if($user->avatar)
    <button type="button"
            onclick="deleteAvatar()"
            class="text-sm text-red-600 mt-2 hover:underline">
        Șterge poza de profil
    </button>
@endif


            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <!-- NAME -->
        <div>
            <x-input-label for="name" :value="__('Nume')" />
            <x-text-input id="name"
                          name="name"
                          type="text"
                          class="mt-1 block w-full"
                          :value="old('name', $user->name)"
                          required />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- USERNAME -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username"
                          name="username"
                          type="text"
                          class="mt-1 block w-full"
                          :value="old('username', $user->username)"
                          required />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <!-- PHONE -->
        <div>
            <x-input-label for="phone" :value="__('Telefon')" />
            <x-text-input id="phone"
                          name="phone"
                          type="text"
                          class="mt-1 block w-full"
                          :value="old('phone', $user->phone)" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <!-- DESCRIPTION -->
        <div>
            <x-input-label for="description" :value="__('Despre tine')" />

            <textarea id="description"
                      name="description"
                      class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                      rows="4">{{ old('description', $user->description) }}</textarea>

            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <!-- EMAIL -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
                          name="email"
                          type="email"
                          class="mt-1 block w-full"
                          :value="old('email', $user->email)"
                          required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        <div class="switch-box">

    <label class="switch">
    <input type="checkbox" name="show_activity"
        {{ old('show_activity', $user->show_activity) ? 'checked' : '' }}>
    <span class="slider"></span>
</label>

    <span class="switch-label">
        Permite altor utilizatori să vadă activitatea mea
    </span>

</div>
<div class="switch-box">

    <label class="switch">
        <input type="checkbox" name="notify_matches"
            {{ old('notify_matches', $user->notify_matches) ? 'checked' : '' }}>
        <span class="slider"></span>
    </label>

    <span class="switch-label">
        Primește notificări despre meciuri noi
    </span>

</div>

        <!-- BUTTON -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvează') }}</x-primary-button>
        </div>

    </form>
</section>
<script>
function previewAvatar(event) {
    const input = event.target;
    const preview = document.getElementById('avatarPreview');

    if (!input.files || !input.files[0]) return;

    const reader = new FileReader();

    reader.onload = function (e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
    };

    reader.readAsDataURL(input.files[0]);
}
</script>
<script>
function deleteAvatar() {
    if (!confirm('Sigur vrei să ștergi poza?')) return;

    fetch("{{ route('profile.delete-avatar') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "X-HTTP-Method-Override": "DELETE",
            "Accept": "application/json"
        }
    })
    .then(res => location.reload());
}
</script>
<style>
    .switch-box{
    display:flex;
    align-items:center;
    gap:12px;
    margin-top:15px;
}

.switch{
    position:relative;
    display:inline-block;
    width:44px;
    height:24px;
}

.switch input{
    opacity:0;
    width:0;
    height:0;
}

.slider{
    position:absolute;
    cursor:pointer;
    top:0; left:0; right:0; bottom:0;
    background:#ccc;
    transition:.3s;
    border-radius:24px;
}

.slider:before{
    position:absolute;
    content:"";
    height:18px;
    width:18px;
    left:3px;
    bottom:3px;
    background:white;
    transition:.3s;
    border-radius:50%;
}

.switch input:checked + .slider{
    background:black;
}

.switch input:checked + .slider:before{
    transform:translateX(20px);
}

.switch-label{
    font-size:14px;
}
    .avatar-preview{
    width:120px;
    height:120px;
    border-radius:50%;
    object-fit:cover;
    border:2px solid #ddd;
    display:block;
}
    .avatar-btn{
    display:inline-block;
    background:black;
    color:white;
    padding:10px 18px;
    border-radius:12px;
    cursor:pointer;
    font-size:14px;
    font-weight:500;
    margin-top:10px;
    transition:0.2s;
}

.avatar-btn:hover{
    opacity:0.8;
}

/* =========================
   PROFILE EDIT RESPONSIVE
========================= */

/* TABLET */
@media (max-width: 1024px) {

    section header h2 {
        font-size: 20px;
    }

    section header p {
        font-size: 13px;
    }

    .switch-label {
        font-size: 13px;
    }

    .avatar-preview {
        width: 100px;
        height: 100px;
    }
}

/* MOBILE */
@media (max-width: 768px) {

    section {
        padding: 16px;
    }

    section header h2 {
        font-size: 18px;
        text-align: center;
    }

    section header p {
        font-size: 13px;
        text-align: center;
    }

    /* INPUT SPACING */
    .mt-1.block.w-full {
        font-size: 14px;
    }

    textarea {
        font-size: 14px;
    }

    /* AVATAR */
    .avatar-btn {
        width: 100%;
        text-align: center;
        display: block;
    }

    .avatar-preview {
        width: 90px;
        height: 90px;
        margin: 10px auto 0 auto;
    }

    /* SWITCH */
    .switch-box {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .switch-label {
        font-size: 13px;
    }
}

/* SMALL MOBILE */
@media (max-width: 480px) {

    section header h2 {
        font-size: 16px;
    }

    section header p {
        font-size: 12px;
    }

    .avatar-preview {
        width: 80px;
        height: 80px;
    }

    .switch-label {
        font-size: 12px;
    }
}
</style>