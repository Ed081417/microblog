
<x-guest-layout>
    
    <x-auth-card>
        <h1 style="text-align: center;">REGISTER</h1>
        <hr>
     

        <!-- Validation Errors -->
         {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" />  --}}

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-label for="fname" :value="__('First Name (required)')" />

                <x-input id="fname" class="block  w-full" type="text" name="fname" :value="old('fname')"  autofocus />
            </div>
            @error('fname')
                <span style="color: red;">*First Name is required!</span>
            @enderror

            <div>
                <x-label for="mname" :value="__('Middle Name (optional)')" />

                <x-input id="mname" class="block  w-full" type="text" name="mname" :value="old('mname')"  autofocus />
            </div>

            <div>
                <x-label for="lname" :value="__('Last Name (required)')" />

                <x-input id="lname" class="block  w-full" type="text" name="lname" :value="old('lname')"  autofocus />
            </div>
            @error('lname')
                <span style="color: red;">*Last Name is required!</span>
            @enderror

            <div>
                <x-label for="date of bith" :value="__('Date of Birth (required)')" />

                <x-input id="dob" class="block w-full" type="date" name="dob" :value="old('dob')"  autofocus />
            </div>
            @error('dob')
                <span style="color: red;">{{ $message }}</span>
            @enderror
      
            <div>
                <x-label for="uname" :value="__('Username (required)')" />

                <x-input id="uname" class=" w-full" type="text" name="uname" :value="old('uname')"  autofocus />
            </div>
            @error('uname')
                <span style="color: red;">*Username is required!</span>
            @enderror
            
            <div>
                <x-label for="email" :value="__('Email (required)')" />

                <x-input id="email" class="block w-full" type="text" name="email" :value="old('email')"  />
            </div>
            @error('email')
                <span style="color: red;">*{{ $message }}</span>
            @enderror

            <div >
                <x-label for="password" :value="__('Password (required)')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
            </div>

            <div >
                <x-label for="password_confirmation" :value="__('Confirm Password (required)')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"  />
            </div>
            @error('password')
                <span style="color: red;">*{{ $message }}</span>
            @enderror

            <div >
                <x-label for="image" :value="__('Upload image (optional, max. 5mb, type: .jpg, .jpeg, .png)')" />

                <x-input id="image" type="file" name="image"  />
            </div>
            @error('image')
                <span style="color: red;">*{{ $message }}</span>
            @enderror

            <div class="flex items-center justify-end ">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
