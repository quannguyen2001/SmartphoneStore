<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- <x-authentication-card-logo /> -->
            <a href="{{url('/')}}">
                <img src="home/img/logo.jpg" alt="Trang chủ Smartphone Store" title="Trang chủ Smartphone Store" width="250px">
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Bạn quên mật khẩu? Không có gì. Chỉ cần cho chúng tôi biết địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn liên kết đặt lại mật khẩu qua email để cho phép bạn chọn địa chỉ mới.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Liên kết đặt lại mật khẩu email') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
