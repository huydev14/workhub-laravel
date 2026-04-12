@extends('layouts.main')

@section('content')
    <div class="tw-min-h-screen tw-bg-gray-50/50 tw-py-8">
        <div class="tw-max-w-5xl tw-mx-auto tw-px-4 sm:tw-px-6 lg:tw-px-8">

            <div class="tw-mb-6 tw-flex tw-items-center tw-justify-between">
                <div>
                    <h2 class="tw-text-2xl tw-font-bold tw-text-gray-900 tw-tracking-tight">Chỉnh sửa Vai trò</h2>
                    <p class="tw-text-sm tw-text-gray-500 tw-mt-1">
                        Cập nhật thông tin và quyền hạn cho vai trò: <span
                            class="tw-font-semibold tw-text-blue-600">{{ $role->name }}</span>
                    </p>
                </div>
                <a href="{{ route('roles.index') }}"
                    class="tw-text-sm tw-font-medium tw-text-gray-600 hover:tw-text-gray-900 tw-transition-colors tw-flex tw-items-center tw-gap-2 tw-bg-white tw-px-4 tw-py-2 tw-rounded-md tw-border tw-border-gray-200 tw-shadow-sm">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
            </div>

            <form action="{{ route('roles.update', $role->id) }}" method="POST" id="role-form" novalidate>
                @csrf
                @method('PUT') <div class="tw-space-y-6">
                    <div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-shadow-md tw-overflow-hidden">
                        <div class="tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 tw-bg-gray-50/50">
                            <h4 class="tw-text-base tw-font-semibold tw-text-gray-900 tw-flex tw-items-center tw-gap-2">
                                Thông tin vai trò
                            </h4>
                        </div>
                        <div class="tw-p-4">
                            <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
                                <div>
                                    <label for="name"
                                        class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1.5">Tên vai trò
                                        <span class="tw-text-red-500">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ $role->name }}"
                                        placeholder="VD: Quản trị viên, Nhân sự..." required
                                        class="tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm focus:tw-border-blue-500 focus:tw-ring-blue-500 tw-text-sm tw-py-2 tw-px-3 tw-transition-colors">
                                </div>

                                <div>
                                    <label for="description"
                                        class="tw-block tw-text-sm tw-font-medium tw-text-gray-700 tw-mb-1.5">Description</label>
                                    <input type="text" name="description" id="description"
                                        value="{{ $role->description ?? '' }}" placeholder="Nhập mô tả cho vai trò..."
                                        class="tw-w-full tw-rounded-md tw-border-gray-300 tw-shadow-sm tw-text-sm tw-py-2 tw-px-3 focus:tw-outline-none">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tw-bg-white tw-rounded-xl tw-border tw-border-gray-200 tw-shadow-md tw-overflow-hidden">
                        <div
                            class="tw-px-6 tw-py-4 tw-border-b tw-border-gray-200 tw-bg-gray-50/50 tw-flex tw-justify-between tw-items-center">
                            <h4 class="tw-text-medium tw-font-semibold tw-text-gray-800">
                                Danh sách Quyền hạn (Permissions)
                            </h4>
                            <button type="button" id="btn-check-all-global"
                                class="tw-text-sm tw-font-medium tw-text-[#0078D4] hover:tw-text-[#106ebe] tw-transition-colors">
                                Chọn tất cả
                            </button>
                        </div>

                        <div class="tw-p-0 tw-flex tw-flex-col">

                            {{-- ----- USERS --------- --}}
                            <div class="permission-group tw-bg-white">
                                <div
                                    class="accordion-header tw-flex tw-items-center tw-justify-between tw-px-6 tw-py-3 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-cursor-pointer tw-transition-colors">
                                    <div class="tw-flex tw-items-center tw-gap-4">
                                        <div class="tw-w-5 tw-flex tw-justify-center tw-shrink-0">
                                            <i
                                                class="fas fa-chevron-right tw-text-gray-500 tw-text-sm tw-transition-transform tw-duration-200 accordion-icon"></i>
                                        </div>
                                        <div>
                                            <span class="tw-font-bold tw-text-gray-900 tw-text-sm tw-block">
                                                Quản lý tài khoản
                                            </span>
                                            <span class="tw-text-xs tw-text-gray-500 tw-font-normal tw-mt-0.5 tw-block">
                                                Xem, thêm, sửa, xóa và khóa tài khoản
                                            </span>
                                        </div>
                                    </div>

                                    <div onclick="event.stopPropagation()">
                                        <x-checkbox name="check_all" label="Chọn tất cả"
                                            class="tw-px-3 tw-py-1 tw-bg-white tw-border tw-border-gray-200 tw-rounded tw-shadow-sm hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>
                                </div>

                                <div class="accordion-body tw-hidden tw-flex tw-flex-col">
                                    <div>
                                        <x-checkbox label="Xem người dùng" name="permissions[]" value="users.view"
                                            :checked="in_array('users.view', $rolePermissions)"
                                            class="tw-flex tw-items-center tw-cursor-pointer tw-w-full tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>

                                    <div>
                                        <x-checkbox label="Tạo mới người dùng" name="permissions[]" value="users.create"
                                            :checked="in_array('users.create', $rolePermissions)"
                                            class="tw-flex tw-items-center tw-cursor-pointer tw-w-full tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>

                                    <div>
                                        <x-checkbox label="Chỉnh sửa người dùng" name="permissions[]" value="users.edit"
                                            :checked="in_array('users.edit', $rolePermissions)"
                                            class="tw-flex tw-items-center tw-cursor-pointer tw-w-full tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>

                                    <div>
                                        <x-checkbox label="Xóa người dùng" name="permissions[]" value="users.remove"
                                            :checked="in_array('users.remove', $rolePermissions)"
                                            class="tw-flex tw-items-center tw-cursor-pointer tw-w-full tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>
                                </div>
                            </div>

                            {{-- ----- Roles & Permissions --------- --}}
                            <div class="permission-group tw-bg-white">
                                <div
                                    class="accordion-header tw-flex tw-items-center tw-justify-between tw-px-6 tw-py-3 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-cursor-pointer tw-transition-colors">
                                    <div class="tw-flex tw-items-center tw-gap-4">
                                        <div class="tw-w-5 tw-flex tw-justify-center tw-shrink-0">
                                            <i
                                                class="fas fa-chevron-right tw-text-gray-500 tw-text-sm tw-transition-transform tw-duration-200 accordion-icon"></i>
                                        </div>
                                        <div>
                                            <span class="tw-font-bold tw-text-gray-900 tw-text-sm tw-block">
                                                Vai trò & Phân quyền (Roles)
                                            </span>
                                            <span class="tw-text-xs tw-text-gray-500 tw-font-normal tw-mt-0.5 tw-block">
                                                Quản lý các nhóm quyền hạn trong hệ thống
                                            </span>
                                        </div>
                                    </div>

                                    <div onclick="event.stopPropagation()">
                                        <x-checkbox name="check_all" label="Chọn tất cả"
                                            class="tw-px-3 tw-py-1 tw-bg-white tw-border tw-border-gray-200 tw-rounded tw-shadow-sm hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>
                                </div>

                                <div class="accordion-body tw-hidden tw-flex tw-flex-col">
                                    <div>
                                        <x-checkbox label="Xem vai trò và phân quyền" name="permissions[]"
                                            value="roles.view" :checked="in_array('roles.view', $rolePermissions)"
                                            class="tw-flex tw-items-center tw-cursor-pointer tw-w-full tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>

                                    <div>
                                        <x-checkbox label="Tạo mới vai trò và phân quyền" name="permissions[]"
                                            value="roles.create" :checked="in_array('roles.create', $rolePermissions)"
                                            class="tw-flex tw-items-center tw-cursor-pointer tw-w-full tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>

                                    <div>
                                        <x-checkbox label="Chỉnh sửa vai trò và phân quyền" name="permissions[]"
                                            value="roles.edit" :checked="in_array('roles.edit', $rolePermissions)"
                                            class="tw-flex tw-items-center tw-cursor-pointer tw-w-full tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>

                                    <div>
                                        <x-checkbox label="Xóa vai trò và phân quyền" name="permissions[]"
                                            value="roles.remove" :checked="in_array('roles.remove', $rolePermissions)"
                                            class="tw-flex tw-items-center tw-cursor-pointer tw-w-full tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>
                                </div>
                            </div>

                            {{-- ----- AUDIT LOGS --------- --}}
                            <div class="permission-group tw-bg-white">
                                <div
                                    class="accordion-header tw-flex tw-items-center tw-justify-between tw-px-6 tw-py-3 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-cursor-pointer tw-transition-colors">
                                    <div class="tw-flex tw-items-center tw-gap-4">
                                        <div class="tw-w-5 tw-flex tw-justify-center tw-shrink-0">
                                            <i
                                                class="fas fa-chevron-right tw-text-gray-500 tw-text-sm tw-transition-transform tw-duration-200 accordion-icon"></i>
                                        </div>
                                        <div>
                                            <span class="tw-font-bold tw-text-gray-900 tw-text-sm tw-block">
                                                Lịch sử Hoạt động (Audit Logs)
                                            </span>
                                            <span class="tw-text-xs tw-text-gray-500 tw-font-normal tw-mt-0.5 tw-block">
                                                Tra cứu lịch sử truy cập và thay đổi dữ liệu
                                            </span>
                                        </div>
                                    </div>

                                    <div onclick="event.stopPropagation()">
                                        <x-checkbox name="check_all" label="Chọn tất cả"
                                            class="tw-px-3 tw-py-1 tw-bg-white tw-border tw-border-gray-200 tw-rounded tw-shadow-sm hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>
                                </div>

                                <div class="accordion-body tw-hidden tw-flex tw-flex-col">

                                    <div>
                                        <x-checkbox label="Xem danh sách logs" name="permissions[]" value="log.view"
                                            :checked="in_array('log.view', $rolePermissions)"
                                            class="tw-flex tw-items-center tw-cursor-pointer tw-w-full tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>

                                    <div>
                                        <x-checkbox label="Xem chi tiết" name="permissions[]" value="log.detail"
                                            :checked="in_array('log.detail', $rolePermissions)"
                                            class="tw-flex tw-items-center tw-cursor-pointer tw-w-full tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 hover:tw-bg-gray-50 tw-transition-colors" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div
                    class="tw-sticky tw-bottom-0 tw-z-40 tw-mt-8 tw-bg-white/80 tw-backdrop-blur-sm tw-border-t tw-border-gray-200 tw-p-4 tw-rounded-t-xl tw-shadow-[0_-8px_20px_-10px_rgba(0,0,0,0.1)] tw-flex tw-justify-end tw-items-center tw-gap-2">
                    <button type="submit"
                        class="tw-min-w-[96px] tw-px-4 tw-py-1.5 tw-text-[14px] tw-font-medium tw-text-white tw-bg-[#0078D4] tw-border tw-border-transparent tw-rounded-[4px] hover:tw-bg-[#106ebe] tw-shadow-sm tw-transition-colors tw-flex tw-items-center tw-justify-center">
                        Save
                    </button>
                    <a href="{{ route('roles.index') }}"
                        class="tw-min-w-[96px] tw-px-4 tw-py-1.5 tw-text-[14px] tw-font-medium tw-text-gray-700 tw-bg-white tw-border tw-border-gray-300 tw-rounded-[4px] hover:tw-bg-gray-50 hover:tw-text-gray-900 tw-shadow-sm tw-transition-colors tw-flex tw-items-center tw-justify-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/pages/role.js') }}"></script>
    @endpush
@endsection
