@extends('layouts.main')


@section('content')
    <div class="container-fluid">
        <div class="show-content tw-py-4 tw-px-12">
            {{-- Header --}}
            <div class="tw-mb-4 tw-flex tw-items-center tw-justify-between">
                <div class="tw-flex tw-items-center tw-gap-3">
                    <a href="{{ route('users.index') }}"
                        class="tw-w-8 tw-h-8 tw-flex tw-items-center tw-justify-center tw-rounded-full hover:tw-bg-gray-200 tw-text-gray-600 tw-transition-colors">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="tw-text-2xl tw-font-semibold tw-text-gray-900">Hồ sơ nhân sự</h1>
                </div>

                <div class="tw-flex tw-gap-3">
                    <button type="button" class="fluent-btn-cancel edit-user-btn"
                        data-edit-url="{{ route('users.edit', $user->id) }}">
                        <i class="fas fa-pen tw-mr-2"></i> Chỉnh sửa
                    </button>
                </div>
            </div>

            <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-12 tw-gap-4">
                {{-- Left panel --}}
                <div class="lg:tw-col-span-4 tw-h-full">
                    <div class="fluent-card tw-sticky tw-top-6">
                        <div class="card-body tw-flex tw-flex-col tw-items-center tw-text-center tw-p-8">
                            {{-- Avatar  --}}
                            @php
                                $nameParts = explode(' ', trim($user->name));
                                $initials =
                                    count($nameParts) > 1
                                        ? strtoupper(substr(end($nameParts), 0, 1))
                                        : strtoupper(substr($user->name, 0, 1));
                                $colors = [
                                    'tw-bg-[#0078D4]',
                                    'tw-bg-[#D13438]',
                                    'tw-bg-[#038387]',
                                    'tw-bg-[#8764B8]',
                                    'tw-bg-[#498205]',
                                ];
                                $bgColor = $colors[$user->id % count($colors)];
                            @endphp
                            <div
                                class="tw-w-28 tw-h-28 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-text-white tw-text-4xl tw-font-semibold tw-shadow-md tw-mb-5 {{ $bgColor }}">
                                {{ $initials }}
                            </div>

                            <h2 class="tw-text-xl tw-font-bold tw-text-gray-900">{{ $user->name }}</h2>
                            <p class="tw-text-sm tw-text-gray-500 tw-mt-1">{{ $user->role->name ?? 'Nhân viên' }}</p>

                            <div class="tw-mt-4">
                                @if ($user->status === 0)
                                    <span
                                        class="tw-inline-flex tw-items-center tw-px-3 tw-py-1 tw-rounded-full tw-text-xs tw-font-medium tw-bg-green-100 tw-text-green-800">
                                        Đang làm việc
                                    </span>
                                @else
                                    <span
                                        class="tw-inline-flex tw-items-center tw-px-3 tw-py-1 tw-rounded-full tw-text-xs tw-font-medium tw-bg-gray-100 tw-text-gray-800">
                                        Đã nghỉ việc
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="tw-border-t tw-border-gray-100 tw-p-6">
                            <h3 class="tw-text-xs tw-font-semibold tw-text-gray-400 tw-uppercase tw-tracking-wider tw-mb-4">
                                Liên hệ
                            </h3>

                            <div class="tw-space-y-4">
                                <div class="tw-flex tw-items-start tw-gap-3">
                                    <i class="far fa-envelope tw-text-gray-400 tw-mt-1 tw-w-5"></i>
                                    <div>
                                        <div class="tw-text-sm tw-font-medium tw-text-gray-900 break-all">
                                            {{ $user->email }}
                                        </div>
                                        <div class="tw-text-xs tw-text-gray-500">Email công việc</div>
                                    </div>
                                </div>
                                <div class="tw-flex tw-items-start tw-gap-3">
                                    <i class="fas fa-phone-alt tw-text-gray-400 tw-mt-1 tw-w-5"></i>
                                    <div>
                                        <div class="tw-text-sm tw-font-medium tw-text-gray-900">
                                            {{ $user->phone ?? 'Chưa cập nhật' }}</div>
                                        <div class="tw-text-xs tw-text-gray-500">Số điện thoại</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tw-border-t tw-border-gray-100 tw-p-6">
                            <h3 class="tw-text-xs tw-font-semibold tw-text-gray-400 tw-uppercase tw-tracking-wider tw-mb-4">
                                Người quản lý trực tiếp
                            </h3>

                            <div
                                class="tw-flex tw-items-center tw-gap-3 tw-cursor-pointer hover:tw-bg-gray-50 tw-p-2 tw--ml-2 tw-rounded-lg tw-transition-colors">
                                <div
                                    class="tw-w-10 tw-h-10 tw-rounded-full tw-bg-blue-100 tw-text-blue-700 tw-flex tw-items-center tw-justify-center tw-font-bold tw-text-sm">
                                    H
                                </div>
                                <div>
                                    <div class="tw-text-sm tw-font-medium tw-text-gray-900">Hoàng Văn A</div>
                                    <div class="tw-text-xs tw-text-gray-500">Trưởng phòng IT</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right panel --}}
                <div class="lg:tw-col-span-8">
                    <div class="fluent-card tw-h-full">

                        {{-- Tab Navigation --}}
                        <div class="tw-border-b tw-border-gray-200 tw-px-6">
                            <nav class="tw--mb-px tw-flex tw-space-x-8" aria-label="Tabs">
                                <button
                                    class="fluent-tab tw-border-[#0063B1] tw-text-[#0063B1] tw-whitespace-nowrap tw-py-4 tw-px-1 tw-border-b-2 tw-font-medium tw-text-sm tw-transition-colors"
                                    data-target="#tab-overview">Tổng quan
                                </button>
                                <button
                                    class="fluent-tab tw-border-transparent tw-text-gray-500 hover:tw-text-gray-700 hover:tw-border-gray-300 tw-whitespace-nowrap tw-py-4 tw-px-1 tw-border-b-2 tw-font-medium tw-text-sm tw-transition-colors"
                                    data-target="#tab-work">
                                    Công tác
                                </button>

                                <button
                                    class="fluent-tab tw-border-transparent tw-text-gray-500 hover:tw-text-gray-700 hover:tw-border-gray-300 tw-whitespace-nowrap tw-py-4 tw-px-1 tw-border-b-2 tw-font-medium tw-text-sm tw-transition-colors"
                                    data-target="#tab-activity">
                                    Activity Logs
                                </button>
                            </nav>
                        </div>

                        {{-- Tab Contents --}}
                        <div class="tw-p-6">
                            {{-- TAB Overview --}}
                            <div id="tab-overview" class="tab-pane">
                                <h3
                                    class="tw-text-sm tw-font-semibold tw-text-[#0063B1] tw-mb-4 tw-uppercase tw-tracking-wide">
                                    Thông tin cá nhân</h3>
                                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6 tw-mb-8">
                                    <div>
                                        <label class="tw-block tw-text-xs tw-text-gray-500 tw-mb-1">Họ và tên</label>
                                        <div class="tw-text-sm tw-text-gray-900 tw-font-medium">{{ $user->name }}</div>
                                    </div>
                                    <div>
                                        <label class="tw-block tw-text-xs tw-text-gray-500 tw-mb-1">Giới tính</label>
                                        <div class="tw-text-sm tw-text-gray-900 tw-font-medium">
                                            {{ $user->gender == 0 ? 'Nam' : ($user->gender == 1 ? 'Nữ' : '—') }}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="tw-block tw-text-xs tw-text-gray-500 tw-mb-1">Ngày sinh</label>
                                        <div class="tw-text-sm tw-text-gray-900 tw-font-medium">
                                            {{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') : '—' }}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="tw-block tw-text-xs tw-text-gray-500 tw-mb-1">Địa chỉ thường
                                            trú</label>
                                        <div class="tw-text-sm tw-text-gray-900 tw-font-medium">{{ $user->address ?? '—' }}
                                        </div>
                                    </div>
                                </div>

                                <h3
                                    class="tw-text-sm tw-font-semibold tw-text-[#0063B1] tw-mb-4 tw-uppercase tw-tracking-wide">
                                    Thông tin công việc</h3>
                                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-6">
                                    <div>
                                        <label class="tw-block tw-text-xs tw-text-gray-500 tw-mb-1">Phòng ban</label>
                                        <div class="tw-text-sm tw-text-gray-900 tw-font-medium">
                                            {{ $user->department->name ?? '—' }}</div>
                                    </div>
                                    <div>
                                        <label class="tw-block tw-text-xs tw-text-gray-500 tw-mb-1">Đội / Nhóm</label>
                                        <div class="tw-text-sm tw-text-gray-900 tw-font-medium">
                                            {{ $user->team->name ?? '—' }}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="tw-block tw-text-xs tw-text-gray-500 tw-mb-1">Chức vụ</label>
                                        <div class="tw-text-sm tw-text-gray-900 tw-font-medium">
                                            {{ $user->position->name ?? '—' }}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="tw-block tw-text-xs tw-text-gray-500 tw-mb-1">Hình thức làm
                                            việc</label>
                                        <div class="tw-text-sm tw-text-gray-900 tw-font-medium">
                                            {{ $user->employment_type == 0 ? 'Toàn thời gian (Full-time)' : 'Bán thời gian (Part-time)' }}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="tw-block tw-text-xs tw-text-gray-500 tw-mb-1">Ngày gia nhập</label>
                                        <div class="tw-text-sm tw-text-gray-900 tw-font-medium">
                                            {{ $user->start_date ? \Carbon\Carbon::parse($user->start_date)->format('d/m/Y') : '—' }}
                                        </div>
                                    </div>

                                    <div>
                                        <label class="tw-block tw-text-xs tw-text-gray-500 tw-mb-1">Ngày nghỉ việc</label>
                                        @if ($user->status === 1)
                                            <div class="tw-text-sm tw-text-red-600 tw-font-medium">
                                                {{ $user->start_date ? \Carbon\Carbon::parse($user->start_date)->format('d/m/Y') : '—' }}
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            {{-- TAB Work --}}
                            <div id="tab-work" class="tab-pane tw-hidden">
                                <h3 class="tw-text-base tw-font-semibold tw-text-gray-900 tw-mb-5">Chi tiết tổ chức</h3>

                                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-6">
                                </div>

                                <div class="tw-mt-10">
                                    <h3 class="tw-text-base tw-font-semibold tw-text-gray-900 tw-mb-4">
                                        Quỹ nghỉ phép <span class="tw-text-sm tw-font-normal tw-text-gray-500 tw-ml-1">(Năm
                                            {{ date('Y') }})</span>
                                    </h3>

                                    <div class="tw-grid tw-grid-cols-3 tw-gap-5">
                                        <div
                                            class="tw-bg-white tw-border tw-border-gray-200 tw-p-5 tw-shadow-sm hover:tw-shadow-md tw-transition-shadow">
                                            <div class="tw-flex tw-items-center tw-gap-4">
                                                <div
                                                    class="tw-w-10 tw-h-10 tw-rounded-full tw-bg-gray-100 tw-flex tw-items-center tw-justify-center tw-text-gray-600">
                                                    <i class="far fa-calendar-alt tw-text-lg"></i>
                                                </div>
                                                <div>
                                                    <div class="tw-text-2xl tw-font-semibold tw-text-gray-900">12</div>
                                                    <div class="tw-text-xs tw-text-gray-500 tw-mt-0.5">Tổng ngày phép</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="tw-bg-white tw-border tw-border-gray-200 tw-p-5 tw-shadow-sm hover:tw-shadow-md tw-transition-shadow">
                                            <div class="tw-flex tw-items-center tw-gap-4">
                                                <div
                                                    class="tw-w-10 tw-h-10 tw-rounded-full tw-bg-blue-50 tw-flex tw-items-center tw-justify-center tw-text-[#0063B1]">
                                                    <i class="far fa-calendar-check tw-text-lg"></i>
                                                </div>
                                                <div>
                                                    <div class="tw-text-2xl tw-font-semibold tw-text-[#0063B1]">4.5</div>
                                                    <div class="tw-text-xs tw-text-gray-500 tw-mt-0.5">Đã sử dụng</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="tw-bg-white tw-border tw-border-gray-200 tw-p-5 tw-shadow-sm hover:tw-shadow-md tw-transition-shadow">
                                            <div class="tw-flex tw-items-center tw-gap-4">
                                                <div
                                                    class="tw-w-10 tw-h-10 tw-rounded-full tw-bg-green-50 tw-flex tw-items-center tw-justify-center tw-text-green-600">
                                                    <i class="far fa-calendar-plus tw-text-lg"></i>
                                                </div>
                                                <div>
                                                    <div class="tw-text-2xl tw-font-semibold tw-text-green-600">7.5</div>
                                                    <div class="tw-text-xs tw-text-gray-500 tw-mt-0.5">Còn lại</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tw-mt-10">
                                    <div class="tw-flex tw-items-center tw-justify-between tw-mb-4">
                                        <h3 class="tw-text-base tw-font-semibold tw-text-gray-900">Thiết bị đã cấp phát
                                        </h3>
                                    </div>

                                    <div class="tw-bg-white tw-border tw-border-gray-200 tw-shadow-sm tw-overflow-hidden">
                                        <table class="tw-w-full tw-text-sm tw-text-left">
                                            <thead class="tw-bg-white tw-border-b tw-border-gray-200">
                                                <tr>
                                                    <th class="tw-px-5 tw-py-3.5 tw-font-semibold tw-text-gray-500">Thiết
                                                        bị</th>
                                                    <th class="tw-px-5 tw-py-3.5 tw-font-semibold tw-text-gray-500">Mã tài
                                                        sản</th>
                                                    <th class="tw-px-5 tw-py-3.5 tw-font-semibold tw-text-gray-500">Ngày
                                                        nhận</th>
                                                    <th
                                                        class="tw-px-5 tw-py-3.5 tw-font-semibold tw-text-gray-500 tw-text-right">
                                                        Trạng thái</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tw-divide-y tw-divide-gray-100">

                                                {{-- Row 1: Laptop --}}
                                                <tr class="hover:tw-bg-gray-50 tw-transition-colors">
                                                    <td class="tw-px-5 tw-py-4 tw-flex tw-items-center tw-gap-3">
                                                        <div
                                                            class="tw-w-9 tw-h-9 tw-rounded-md tw-bg-gray-50 tw-border tw-border-gray-100 tw-flex tw-items-center tw-justify-center tw-text-gray-500">
                                                            <i class="fas fa-laptop"></i>
                                                        </div>
                                                        <div class="tw-font-medium tw-text-gray-900">MacBook Pro M2 14"
                                                        </div>
                                                    </td>
                                                    <td class="tw-px-5 tw-py-4 tw-text-gray-600">IT-MBP-2024-045</td>
                                                    <td class="tw-px-5 tw-py-4 tw-text-gray-600">15/01/2026</td>
                                                    <td class="tw-px-5 tw-py-4 tw-text-right">
                                                        <span
                                                            class="tw-inline-flex tw-items-center tw-px-2.5 tw-py-1 tw-rounded-md tw-text-xs tw-font-medium tw-bg-green-50 tw-text-green-700 tw-border tw-border-green-200">
                                                            Đang sử dụng
                                                        </span>
                                                    </td>
                                                </tr>

                                                {{-- Row 2: Màn hình --}}
                                                <tr class="hover:tw-bg-gray-50 tw-transition-colors">
                                                    <td class="tw-px-5 tw-py-4 tw-flex tw-items-center tw-gap-3">
                                                        <div
                                                            class="tw-w-9 tw-h-9 tw-rounded-md tw-bg-gray-50 tw-border tw-border-gray-100 tw-flex tw-items-center tw-justify-center tw-text-gray-500">
                                                            <i class="fas fa-desktop"></i>
                                                        </div>
                                                        <div class="tw-font-medium tw-text-gray-900">Màn hình Dell
                                                            UltraSharp 27"</div>
                                                    </td>
                                                    <td class="tw-px-5 tw-py-4 tw-text-gray-600">IT-MON-2024-112</td>
                                                    <td class="tw-px-5 tw-py-4 tw-text-gray-600">15/01/2026</td>
                                                    <td class="tw-px-5 tw-py-4 tw-text-right">
                                                        <span
                                                            class="tw-inline-flex tw-items-center tw-px-2.5 tw-py-1 tw-rounded-md tw-text-xs tw-font-medium tw-bg-green-50 tw-text-green-700 tw-border tw-border-green-200">
                                                            Đang sử dụng
                                                        </span>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- TAB Activity --}}
                            <div id="tab-activity" class="tab-pane tw-hidden">
                                {{-- TODO: Add user audit logs --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.fluent-tab').on('click', function() {
                $('.fluent-tab')
                    .removeClass('tw-border-[#0063B1] tw-text-[#0063B1]')
                    .addClass('tw-border-transparent tw-text-gray-500');
                $(this)
                    .addClass('tw-border-[#0063B1] tw-text-[#0063B1]')
                    .removeClass('tw-border-transparent tw-text-gray-500');

                $('.tab-pane').addClass('tw-hidden');
                $($(this).data('target')).removeClass('tw-hidden');
            });
        });
    </script>
@endpush
