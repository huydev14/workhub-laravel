<div class="" aria-label="User actions">
    <button type="button" title="Sửa" data-user-id="{{ $user->id }}" class="user-action-btn user-action-btn--edit">
        <x-icon-edit />
    </button>

    <button type="button" title="Xóa" data-user-id="{{ $user->id }}"
        class="user-action-btn user-action-btn--delete">
        <x-icon-delete />
    </button>
</div>
