<div class="" aria-label="User actions">
    <button type="button" title="Sửa" data-user-id="{{ $user->id }}" class="user-action-btn user-action-btn--edit">
        <x-icon-edit />
    </button>

    <button id="delete-user-btn" type="button" title="Xóa" data-delete-url="{{ route('users.destroy', $user->id) }}"
        class="user-action-btn user-action-btn--delete">
        <x-icon-delete />
    </button>
</div>
