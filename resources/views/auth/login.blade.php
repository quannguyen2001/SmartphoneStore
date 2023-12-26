<style>
    .btn-google,
    .btn-facebook {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        border-radius: 5px;
        background-color: #4215F8;
        /* Màu sắc có thể thay đổi tùy thuộc vào thiết kế của bạn */
        color: #ffffff;
        /* Màu văn bản */
        text-decoration: none;
        margin: 5px;
        /* Khoảng cách giữa các nút */
        width: 60%;
        margin-left: 20%;
    }

    .btn-google:hover,
    .btn-facebook:hover{
        background-color: lightblue;
        color: black;
    }

    .icon {
        margin-right: 8px;
        /* Khoảng cách giữa biểu tượng và văn bản */
        width: 24px;
        /* Kích thước của biểu tượng */
        height: 24px;
    }
</style>
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- <x-authentication-card-logo /> -->
            <a href="{{url('/')}}">
                <img src="home/img/logo.jpg" alt="Trang chủ Smartphone Store" title="Trang chủ Smartphone Store" width="250px">
            </a>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <p style="text-align: center; font-family: Arial, Helvetica, sans-serif;"><b>ĐĂNG NHẬP TÀI KHOẢN</b></p>
            </div>

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Mật khẩu') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Ghi nhớ') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Bạn quên mật khẩu?') }}
                </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Đăng nhập') }}
                </x-button>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                    {{ __('Bạn chưa có tài khoản, đăng ký ngay!') }}
                </a>
            </div>

            <div class="block mt-4">
                <p style="text-align: center; font-family: Arial, Helvetica, sans-serif;"><i><b>Đăng nhập bằng</b></i></p>

                <!-- Google Login Button -->
                <a href="{{ route('login.google') }}" class="btn btn-google">
                    <img src="https://img.icons8.com/color/24/000000/google-logo.png" alt="Google Icon" class="icon"> Google
                </a>

                <!-- Facebook Login Button -->
                <!-- <a href="{{ route('login.facebook') }}" class="btn btn-facebook">
                    <img src="https://img.icons8.com/color/24/000000/facebook-new.png" alt="Facebook Icon" class="icon"> Facebook
                </a> -->
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
