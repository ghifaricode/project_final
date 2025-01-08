<x-modal name="login-modal" :show="$errors->isNotEmpty()" focusable maxWidth="md">
    <div class="p-8">
        <h2 class="text-3xl font-playfair font-bold text-gray-900 mb-2 text-center">Selamat Datang Kembali</h2>
        <p class="text-center text-gray-600 mb-8">Masuk ke akun Anda untuk melanjutkan</p>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" value="Email" class="text-gray-700" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition duration-300" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" value="Password" class="text-gray-700" />
                <x-text-input id="password" type="password" name="password" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition duration-300" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label class="inline-flex items-center">
                    <input type="checkbox"
                        class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring-primary"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-primary hover:text-primary/80 transition duration-300"
                        href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>

            <button type="submit"
                class="w-full py-3 bg-primary text-white rounded-lg font-medium hover:bg-primary/90 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                Masuk
            </button>

            <p class="text-center text-sm text-gray-600">
                Belum punya akun?
                <button type="button"
                    @click="$dispatch('close-modal', 'login-modal'); $dispatch('open-modal', 'register-modal')"
                    class="text-primary hover:text-primary/80 transition duration-300 font-medium">
                    Daftar disini
                </button>
            </p>
        </form>
    </div>
</x-modal>
