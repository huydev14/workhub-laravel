<div class="" aria-label="User actions">
    <button id="edit-user-btn" type="button" title="Sửa" class="user-action-btn user-action-btn--edit"
        data-edit-url="{{ route('users.edit', $user->id) }}"
        data-slideover-target="slideover-edit-user">
        <x-icon-edit />
    </button>

    <button id="delete-user-btn" type="button" title="Xóa" class="user-action-btn user-action-btn--delete"
        data-delete-url="{{ route('users.destroy', $user->id) }}"
        data-restore-url="{{ route('users.restore', $user->id) }}">
        <x-icon-delete />
    </button>
</div>
