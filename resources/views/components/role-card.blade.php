@props([
    'title',
    'userCount' => 0,
    'description' => 'Chưa có mô tả cho vai trò này.',
    'viewUrl' => '#',
    'editUrl' => '#',
])

<div
    class="tw-bg-white tw-border tw-border-gray-200 tw-rounded-md tw-p-6 tw-flex tw-flex-col tw-h-full hover:tw-shadow-md tw-transition-shadow tw-duration-300">

    <div class="tw-flex tw-justify-between tw-items-center tw-mb-1">
        <h3 class="tw-text-lg tw-font-bold tw-text-gray-900">{{ $title }}</h3>

    </div>

    <p class="tw-text-sm tw-text-gray-500  tw-flex-grow tw-leading-relaxed tw-mb-4 tw-line-clamp-2">
        {{ $description }}
    </p>

    <div class="tw-flex tw-justify-between tw-items-center tw-mt-auto">
        <span class="tw-bg-gray-100 tw-text-gray-700 tw-text-xs tw-font-semibold tw-px-3 tw-py-1.5 tw-rounded-full">
            {{ $userCount }} Nhân sự
        </span>
        <a href="{{ $editUrl }}"
            class="assign-role-btn tw-text-xs tw-font-semibold tw-border tw-rounded-md tw-px-3 tw-py-1.5 tw-transition-colors">
            Phân quyền
        </a>
    </div>

</div>
