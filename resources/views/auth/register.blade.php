<x-layoutform>
<div class="text-center">
        <x-slot name="logo">
            <a href="/">

            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form class="form-signin" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nume')" />

                <x-input id="name" class="form-control mb-3" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Prenume -->
            <div>
                <x-label for="prenume" :value="__('Prenume')" />

                <x-input id="prenume" class="form-control mb-3" type="text" name="prenume" :value="old('prenume')" required autofocus />
            </div>

            <!-- Username -->
            <div>
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="form-control mb-3" type="text" name="username" :value="old('username')" required autofocus />
            </div>


            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="form-control mb-3" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="form-control mb-3"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="form-control mb-3"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <br>

                <x-button class="btn btn-success">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
</div>
</x-layoutform>
