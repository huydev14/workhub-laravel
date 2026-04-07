<div id="logDetailModal"
    class="tw-fixed tw-inset-0 tw-z-50 tw-hidden tw-items-center tw-justify-center tw-bg-gray-900/40 tw-backdrop-blur-sm tw-transition-opacity tw-p-4">

    <div
        class="tw-relative tw-w-full tw-max-w-3xl tw-rounded-sm tw-bg-gray-50/95 tw-shadow-[0_16px_48px_rgba(0,0,0,0.12)] tw-border tw-border-gray-200 tw-overflow-hidden tw-flex tw-flex-col tw-max-h-[90vh]">

        <div
            class="tw-flex tw-items-center tw-justify-between tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 tw-bg-white tw-shrink-0 tw-shadow-sm tw-z-10">
            <div class="tw-flex tw-items-center tw-gap-3">
                <div
                    class="tw-flex tw-h-8 tw-w-8 tw-items-center tw-justify-center tw-rounded-full tw-bg-blue-50 tw-text-blue-600">
                    <i class="fas fa-info-circle"></i>
                </div>
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900">Chi tiết truy cập</h3>
            </div>
            <button onclick="ModalHelper.close('logDetailModal')"
                class="tw-flex tw-h-8 tw-w-8 tw-items-center tw-justify-center tw-rounded-md tw-text-gray-400 hover:tw-text-gray-900 hover:tw-bg-gray-100 tw-transition-colors">
                <i class="fas fa-times tw-text-lg"></i>
            </button>
        </div>

        <div class="tw-p-6 tw-space-y-3 tw-flex-1">
            <div class="tw-bg-white tw-rounded-sm tw-p-5 tw-border tw-border-gray-200 tw-shadow-sm">
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-gap-5">
                    <div>
                        <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Hành
                            động</span>
                        <p id="logDescription" class="tw-text-sm tw-font-bold tw-text-blue-800 tw-mt-1 tw-capitalize">
                            Đang tải...</p>
                    </div>
                    <div>
                        <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Phân hệ
                            (Log Name)</span>
                        <p id="logNameLabel" class="tw-text-sm tw-font-medium tw-text-gray-900 tw-mt-1 tw-capitalize">
                            Đang tải...</p>
                    </div>
                    <div>
                        <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Thời
                            gian</span>
                        <div class="tw-flex tw-items-center tw-gap-1.5 tw-mt-1">
                            <i class="far fa-clock tw-text-gray-400 tw-text-xs"></i>
                            <p id="logTime" class="tw-text-sm tw-text-gray-900">Đang tải...</p>
                        </div>
                    </div>
                    <div>
                        <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Người
                            thực hiện</span>
                        <div class="tw-flex tw-items-center tw-gap-1.5 tw-mt-1">
                            <i class="far fa-user tw-text-gray-400 tw-text-xs"></i>
                            <p id="logCauser" class="tw-text-sm tw-text-gray-900 tw-font-medium">Đang tải...</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="card-data-changes"
                class="tw-bg-white tw-rounded-sm tw-p-5 tw-border tw-border-gray-200 tw-shadow-sm">
                <h4 class="tw-text-sm tw-font-bold tw-text-gray-800 tw-mb-4 tw-flex tw-items-center tw-gap-2">
                    <i class="fas fa-exchange-alt tw-text-blue-800"></i> Lịch sử thay đổi dữ liệu
                </h4>

                <div id="logChangesContainer" class="tw-space-y-3">
                    <p class="tw-text-sm tw-text-gray-500 tw-italic">Không có thay đổi</p>
                </div>
            </div>

            <div class="tw-bg-white tw-rounded-sm tw-p-5 tw-border tw-border-gray-200 tw-shadow-sm">
                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2">
                    <div class="md:tw-col-span-1 tw-space-y-1">
                        <span
                            class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Endpoint</span>
                        <div class="tw-flex tw-items-start tw-gap-2 tw-mt-1.5">
                            <span id="logMethod"
                                class="tw-inline-flex tw-items-center tw-rounded tw-bg-gray-100 tw-px-2 tw-py-1 tw-text-xs tw-font-bold tw-text-gray-600">...</span>
                            <span id="logUrl"
                                class="tw-text-sm tw-text-gray-900 tw-font-medium tw-break-all tw-mt-0.5">
                                Đang tải...</span>
                        </div>
                    </div>

                    <div class="tw-space-y-1">
                        <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Địa chỉ
                            IP</span>
                        <div class="tw-flex tw-items-center tw-gap-2 tw-mt-1.5">
                            <i class="fas fa-globe tw-text-gray-400"></i>
                            <span id="logIp" class="tw-text-sm tw-text-gray-900 tw-font-medium">Đang tải...</span>
                        </div>
                    </div>

                    <div class="md:tw-col-span-1 tw-space-y-1">
                        <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Loại
                            Request</span>
                        <div class="tw-mt-1.5">
                            <span id="logAjax" class="tw-text-sm tw-text-gray-500">Đang tải...</span>
                        </div>
                    </div>

                    <div>
                        <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">
                            Phiên đăng nhập (Session ID)
                        </span>
                        <p id="logSessionId"
                            class="tw-text-sm tw-text-gray-600 tw-font-mono tw-break-all tw-select-all">Đang tải...</p>

                    </div>
                </div>
            </div>

            <div class="tw-bg-white tw-rounded-sm tw-p-5 tw-border tw-border-gray-200 tw-shadow-sm tw-space-y-5">
                <div>
                    <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Thiết bị &
                        Trình duyệt (User Agent)</span>
                    <div class="tw-mt-2 tw-rounded-md tw-bg-gray-50 tw-p-3 tw-border tw-border-gray-100">
                        <p id="logUserAgent"
                            class="tw-text-sm tw-text-gray-600 tw-font-mono tw-break-words tw-leading-relaxed">\
                            Đang tải...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
