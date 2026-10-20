<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Actualizați parola') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Asigurați-vă că contul dvs. folosește o parolă lungă și aleatoare pentru a rămâne în siguranță.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Parola curentă')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Parola nouă')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmă parola')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvează') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Parola a fost actualizată.') }}</p>
            @endif
        </div>
    </form>
</section>
<style>
    /* =========================
   PASSWORD SECTION BASE
========================= */

section {
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
    font-family: 'Poppins', sans-serif;
}

section header h2 {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 8px;
}

section header p {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
}

/* FORM */
form.space-y-6 > div {
    margin-bottom: 18px;
}

/* INPUTS */
input[type="password"] {
    width: 100%;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid #e5e5e5;
    font-size: 15px;
    transition: 0.2s;
}

input[type="password"]:focus {
    outline: none;
    border-color: #4A7D89;
    box-shadow: 0 0 0 3px rgba(36, 190, 224, 0.2);
}

/* LABELS (BLADE COMPONENTS) */
label {
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 6px;
    display: block;
}

/* ERROR */
.text-red-600,
.x-input-error {
    font-size: 13px;
    color: #dc2626;
    margin-top: 6px;
}

/* BUTTON + STATUS */
.flex.items-center.gap-4 {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.text-sm.text-gray-600 {
    font-size: 13px;
    color: #666;
}

/* =========================
   TABLET
========================= */
@media (max-width: 1024px) {

    section {
        padding: 20px;
        margin: 30px auto;
    }

    section header h2 {
        font-size: 20px;
    }
}

/* =========================
   MOBILE
========================= */
@media (max-width: 768px) {

    section {
        padding: 16px;
        margin: 20px auto;
    }

    section header h2 {
        font-size: 18px;
        text-align: center;
    }

    section header p {
        text-align: center;
        font-size: 13px;
    }

    input[type="password"] {
        font-size: 14px;
        padding: 11px 12px;
    }

    .flex.items-center.gap-4 {
        flex-direction: column;
        align-items: stretch;
    }
}

/* =========================
   SMALL MOBILE
========================= */
@media (max-width: 480px) {

    section header h2 {
        font-size: 16px;
    }

    section header p {
        font-size: 12px;
    }

    input[type="password"] {
        font-size: 13px;
    }
}
</style>
