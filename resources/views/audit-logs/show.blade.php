    <div class="tw-bg-white tw-rounded-sm tw-py-3 tw-px-4 tw-shadow-sm tw-space-y-3">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-2">
            <div>
                <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                    Hành động
                </span>
                <p id="logDescription" class="tw-text-sm tw-font-bold tw-text-gray-900 tw-mt-1">
                    {{ $activity->description }}
                </p>
            </div>
            <div>
                <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                    Phân hệ (Log Name)
                </span>
                <p id="logNameLabel" class="tw-text-sm tw-font-medium tw-text-gray-900 tw-mt-1 tw-capitalize">
                    {{ $activity->log_name }}
                </p>
            </div>
            <div>
                <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                    Thời gian
                </span>
                <div class="tw-flex tw-items-center tw-gap-1.5 tw-mt-1">
                    <i class="far fa-clock tw-text-gray-400 tw-text-xs"></i>
                    <p id="logTime" class="tw-text-sm tw-text-gray-900">
                        {{ $activity->created_at }}
                    </p>
                </div>
            </div>
            <div>
                <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                    Người thực hiện
                </span>
                <div class="tw-flex tw-items-center tw-gap-1.5 tw-mt-1">
                    <i class="far fa-user tw-text-gray-400 tw-text-xs"></i>
                    <p id="logCauser" class="tw-text-sm tw-text-gray-900 tw-font-medium">
                        {{ $activity->causer->name }}
                    </p>
                </div>
            </div>
        </div>

        <hr class="tw-border-gray-200">

        <h4 class="tw-text-sm tw-font-bold tw-text-gray-800 tw-mb-4 tw-flex tw-items-center tw-gap-2">
            <i class="fas fa-exchange-alt tw-text-blue-800"></i> Lịch sử thay đổi dữ liệu
        </h4>

        <div id="logChangesContainer" class="tw-space-y-3">
            <p class="tw-text-sm tw-text-gray-500 tw-italic">Không có thay đổi</p>
        </div>

        <hr class="tw-border-gray-200">

        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-space-y-2">
            <div class="md:tw-col-span-1 tw-space-y-1">
                <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                    Endpoint
                </span>
                <div class="tw-flex tw-items-start tw-gap-2 tw-mt-1.5">
                    <span id="logMethod"
                        class="tw-inline-flex tw-items-center tw-rounded tw-bg-gray-100 tw-px-2 tw-py-1 tw-text-xs tw-font-bold tw-text-gray-600">
                        {{ $activity->getExtraProperty('method') }}
                    </span>
                    <span id="logUrl" class="tw-text-sm tw-text-gray-900 tw-font-medium tw-break-all tw-mt-0.5">
                        {{ $activity->getExtraProperty('url') }}
                    </span>
                </div>
            </div>

            <div class="tw-space-y-1">
                <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                    Địa chỉ IP
                </span>
                <div class="tw-flex tw-items-center tw-gap-2 tw-mt-1.5">
                    <i class="fas fa-globe tw-text-gray-400"></i>
                    <span id="logIp" class="tw-text-sm tw-text-gray-900 tw-font-medium">
                        {{ $activity->getExtraProperty('ip') }}
                    </span>
                </div>
            </div>

            <div class="tw-col-span-2">
                <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                    Phiên đăng nhập (Session ID)
                </span>
                <div class="tw-mt-2 tw-rounded-md tw-bg-gray-50 tw-p-3 tw-border-sm tw-border-gray-100">
                    <p id="logSessionId" class="tw-text-sm tw-text-gray-600">
                        {{ $activity->getExtraProperty('session_id') }}
                    </p>
                </div>

            </div>

            <div class="tw-col-span-2">
                <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                    Thiết bị & Trình duyệt (User Agent)
                </span>
                <div class="tw-mt-2 tw-rounded-md tw-bg-gray-50 tw-p-3 tw-border-sm tw-border-gray-100">
                    <p id="logUserAgent" class="tw-text-sm tw-text-gray-600">
                        {{ $activity->getExtraProperty('user_agent') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
