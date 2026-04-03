<div class="tw-flex tw-items-center tw-justify-center tw-gap-2">
    <button id="edit-user-btn" type="button" title="Sửa thông tin" class="user-action-btn user-action-btn--edit"
        data-edit-url="{{ route('users.edit', $user->id) }}"
        data-slideover-target="slideover-edit-user">
        <x-icon-edit />
    </button>

    <button id="delete-user-btn" type="button" title="Xóa người dùng" class="user-action-btn user-action-btn--delete tw-text-red-500 hover:tw-text-red-700 tw-transition-colors"
        data-delete-url="{{ route('users.destroy', $user->id) }}"
        data-restore-url="{{ route('users.restore', $user->id) }}">
        <x-icon-delete />
    </button>
</div>
