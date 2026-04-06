<div id="logDetailModal" class="tw-fixed tw-inset-0 tw-z-50 tw-hidden tw-items-center tw-justify-center tw-bg-gray-900/40 tw-backdrop-blur-sm tw-transition-opacity">

    <div class="tw-relative tw-w-full tw-max-w-3xl tw-rounded-[8px] tw-bg-white/95 tw-shadow-[0_16px_48px_rgba(0,0,0,0.12)] tw-border tw-border-gray-200 tw-overflow-hidden">

        <div class="tw-flex tw-items-center tw-justify-between tw-px-6 tw-py-4 tw-border-b tw-border-gray-100 tw-bg-gray-50/50">
            <div class="tw-flex tw-items-center tw-gap-3">
                <div class="tw-flex tw-h-8 tw-w-8 tw-items-center tw-justify-center tw-rounded-full tw-bg-blue-100 tw-text-blue-600">
                    <i class="fas fa-info-circle"></i>
                </div>
                <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900">Chi tiết truy cập</h3>
            </div>
            <button onclick="ModalHelper.close('logDetailModal')" class="tw-text-gray-400 hover:tw-text-gray-700 tw-transition-colors">
                <i class="fas fa-times tw-text-lg"></i>
            </button>
        </div>

        <div class="tw-p-6 tw-space-y-6">

            <div class="tw-grid tw-grid-cols-2 tw-gap-6">
                <div class="tw-space-y-1">
                    <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Endpoint (Đường dẫn)</span>
                    <div class="tw-flex tw-items-start tw-gap-2 tw-mt-1">
                        <span id="logMethod" class="tw-inline-flex tw-items-center tw-rounded tw-bg-green-100 tw-px-2 tw-py-1 tw-text-xs tw-font-bold tw-text-green-700">
                            POST
                        </span>
                        <span id="logUrl" class="tw-text-sm tw-text-gray-900 tw-font-medium tw-break-all">
                            https://workhub.test/login
                        </span>
                    </div>
                </div>

                <div class="tw-space-y-1">
                    <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Địa chỉ IP</span>
                    <div class="tw-flex tw-items-center tw-gap-2 tw-mt-1">
                        <i class="fas fa-globe tw-text-gray-400"></i>
                        <span id="logIp" class="tw-text-sm tw-text-gray-900 tw-font-medium">127.0.0.1</span>
                    </div>
                </div>

                <div class="tw-space-y-1">
                    <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Loại Request</span>
                    <div class="tw-mt-1">
                        <span id="logAjax" class="tw-inline-flex tw-items-center tw-rounded tw-bg-gray-100 tw-px-2 tw-py-1 tw-text-xs tw-font-medium tw-text-gray-600">
                            <i class="fas fa-desktop tw-mr-1.5"></i> Trực tiếp (Non-AJAX)
                        </span>
                    </div>
                </div>
            </div>

            <hr class="tw-border-gray-100">

            <div class="tw-space-y-4">
                <div>
                    <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Thiết bị & Trình duyệt (User Agent)</span>
                    <div class="tw-mt-1.5 tw-rounded-md tw-bg-gray-50 tw-p-3 tw-border tw-border-gray-100">
                        <p id="logUserAgent" class="tw-text-sm tw-text-gray-600 tw-font-mono tw-break-words tw-leading-relaxed">
                            Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0
                        </p>
                    </div>
                </div>

                <div>
                    <span class="tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase tw-tracking-wider">Phiên đăng nhập (Session ID)</span>
                    <div class="tw-mt-1.5 tw-flex tw-items-center tw-rounded-md tw-bg-gray-50 tw-p-3 tw-border tw-border-gray-100 tw-group">
                        <p id="logSessionId" class="tw-text-sm tw-text-gray-600 tw-font-mono tw-break-all tw-select-all">
                            XFQneyYRE6TAUE4VSSJbVdiFpoTMEZqiQcrJKGz5
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tw-bg-gray-50/50 tw-px-6 tw-py-4 tw-border-t tw-border-gray-100 tw-flex tw-justify-end">
            <button onclick="ModalHelper.close('logDetailModal')" class="tw-rounded tw-bg-gray-200 tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-700 hover:tw-bg-gray-300 tw-transition-colors">
                Đóng lại
            </button>
        </div>
    </div>
</div>
