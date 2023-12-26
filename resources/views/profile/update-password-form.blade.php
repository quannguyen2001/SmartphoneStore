<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Cập nhật mật khẩu mới') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Hãy đảm bảo tài khoản của bạn đang sử dụng có mật khẩu dài, ngẫu nhiên để giữ an toàn.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Mật khẩu hiện tại') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('Mật khẩu mới') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Nhập lại mật khẩu') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Đã lưu.') }}
        </x-action-message>

        <x-button>
            {{ __('Lưu') }}
        </x-button>
    </x-slot>
</x-form-section>
