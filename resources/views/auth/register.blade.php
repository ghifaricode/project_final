<x-modal name="register-modal" :show="$errors->isNotEmpty()" focusable maxWidth="md">
    <div class="p-8">
        <h2 class="text-3xl font-playfair font-bold text-gray-900 mb-2 text-center">Buat Akun Baru</h2>
        <p class="text-center text-gray-600 mb-8">Bergabunglah dengan Sabaleh Homestay</p>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" value="Nama Lengkap" class="text-gray-700" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition duration-300" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" value="Email" class="text-gray-700" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition duration-300" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div>
                <x-input-label for="phone" value="Nomor Telepon" class="text-gray-700" />
                <x-text-input id="phone" type="text" name="phone" :value="old('phone')" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition duration-300" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" value="Password" class="text-gray-700" />
                <x-text-input id="password" type="password" name="password" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition duration-300" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-gray-700" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary transition duration-300" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit"
                class="w-full py-3 bg-primary text-white rounded-lg font-medium hover:bg-primary/90 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                Daftar Sekarang
            </button>

            <p class="text-center text-sm text-gray-600">
                Sudah punya akun?
                <button type="button"
                    @click="$dispatch('close-modal', 'register-modal'); $dispatch('open-modal', 'login-modal')"
                    class="text-primary hover:text-primary/80 transition duration-300 font-medium">
                    Masuk disini
                </button>
            </p>
        </form>
    </div>
</x-modal>
