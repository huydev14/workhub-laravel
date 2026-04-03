<div id="tab-activity" class="tab-pane tw-hidden">
    <div class="tw-flex tw-items-center tw-justify-between tw-mb-6">
        <h3 class="tw-text-base tw-font-semibold tw-text-gray-900">Lịch sử hoạt động</h3>

    </div>

    <div class="tw-bg-white tw-border tw-border-gray-200 tw-rounded-sm tw-p-6 tw-shadow-sm">
        <div class="tw-relative tw-border-l-2 tw-border-gray-100 tw-ml-3">
            @forelse ($activities as $log)
                @php
                    $logType = $log->log_name === 'auth' ?: $log->event;
                    $iconClass = 'fa-history';
                    $colorBg = 'tw-bg-gray-50';
                    $colorText = 'tw-text-gray-600';
                    $title = 'Thao tác hệ thống';

                    switch ($logType) {
                        case 'auth':
                            $iconClass = 'fa-key';
                            $colorBg = 'tw-bg-gray-200';
                            $colorText = 'tw-text-gray-800';
                            $title = $log->description;
                            break;
                        case 'created':
                            $iconClass = 'fa-user-plus';
                            $colorBg = 'tw-bg-green-50';
                            $colorText = 'tw-text-green-600';
                            $title = 'Tạo mới hồ sơ nhân sự';
                            break;
                        case 'updated':
                            $iconClass = 'fa-pen';
                            $colorBg = 'tw-bg-blue-50';
                            $colorText = 'tw-text-[#0063B1]';
                            $title = 'Cập nhật thông tin hồ sơ';
                            break;
                    }
                @endphp
                <div class="tw-mb-8 tw-ml-6">
                    <span
                        class="tw-absolute tw-flex tw-items-center tw-justify-center tw-w-8 tw-h-8 tw-rounded-full tw--left-4 tw-ring-4 tw-ring-white {{ $colorBg }} {{ $colorText }}">
                        <i class="fas {{ $iconClass }} tw-text-sm"></i>
                    </span>

                    <h4 class="tw-font-semibold tw-text-gray-900 tw-text-sm">
                        {{ $title }}
                    </h4>
                    <time class="tw-block tw-mb-3 tw-text-xs tw-font-normal tw-text-gray-500 tw-mt-1">
                        {{ $log->created_at->format('H:i - d/m/Y') }}

                        @if ($log->causer)
                            <span class="tw-mx-1">•</span> Thực hiện bởi <span
                                class="tw-font-medium tw-text-gray-700">{{ $log->causer->name }}</span>
                        @endif
                    </time>

                    @if ($log->event === 'updated' && isset($log->properties['old']) && isset($log->properties['attributes']))
                        <div class="tw-bg-gray-50 tw-rounded-lg tw-border tw-border-gray-100 tw-p-4 tw-mt-2">
                            <ul class="tw-space-y-3">
                                @foreach ($log->properties['attributes'] as $key => $newValue)
                                    @php
                                        // Bỏ qua cột updated_at vì nó luôn thay đổi, không cần log ra UI
                                        if ($key === 'updated_at') {
                                            continue;
                                        }

                                        $oldValue = $log->properties['old'][$key] ?? 'Trống';

                                        if ($oldValue == $newValue) {
                                            continue;
                                        }
                                    @endphp
                                    <li class="tw-flex tw-items-start tw-gap-3 tw-text-sm">
                                        <span
                                            class="tw-text-gray-500 tw-w-28 tw-shrink-0 tw-font-medium">{{ ucfirst($key) }}:</span>
                                        <div class="tw-flex tw-items-center tw-flex-wrap tw-gap-2 tw-text-gray-900">
                                            <span
                                                class="tw-line-through tw-text-red-400 tw-text-xs tw-bg-red-50 tw-px-1.5 tw-py-0.5 tw-rounded">
                                                {{ $oldValue ?: 'Trống' }}
                                            </span>

                                            <i class="fas fa-arrow-right tw-text-gray-300 tw-text-[10px]"></i>

                                            <span
                                                class="tw-text-green-700 tw-font-medium tw-bg-green-50 tw-px-1.5 tw-py-0.5 tw-rounded">
                                                {{ $newValue ?: 'Trống' }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @empty
                <div class="tw-text-center tw-py-10">
                    <i class="fas fa-history tw-text-4xl tw-text-gray-200 tw-mb-3"></i>
                    <p class="tw-text-sm tw-text-gray-500">Chưa có lịch sử hoạt động nào được ghi nhận.</p>
                </div>
            @endforelse

        </div>
    </div>
</div>
