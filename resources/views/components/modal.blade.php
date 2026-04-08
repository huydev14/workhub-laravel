<div id="logDetailModal"
    class="tw-fixed tw-inset-0 tw-z-50 tw-hidden tw-items-center tw-justify-center tw-bg-gray-900/40 tw-backdrop-blur-sm tw-transition-opacity tw-p-4">
    <div
        class="tw-relative tw-w-full tw-max-w-3xl tw-rounded-sm tw-bg-gray-50/95 tw-shadow-[0_16px_48px_rgba(0,0,0,0.12)] tw-border tw-border-gray-200 tw-overflow-hidden tw-flex tw-flex-col tw-max-h-[90vh]">

        {{ $slot }}

        <div class="tw-bg-gray-50/50 tw-border-t tw-border-gray-100 tw-flex tw-justify-end">
            <button onclick="ModalHelper.close('logDetailModal')"
                class="tw-bg-gray-200 tw-px-4 tw-py-2 tw-text-sm tw-font-medium tw-text-gray-700 hover:tw-bg-gray-300 tw-transition-colors">
                Đóng lại
            </button>
        </div>

    </div>
</div>

<script>
    window.ModalHelper = {
        open: function(modal_id) {
            const $modal = $('#' + modal_id);

            if (!$modal.length) {
                console.error('Không tìm thấy Modal với ID: ' + modal_id);
                return;
            }

            $modal.removeClass('tw-hidden').addClass('tw-flex');
            $('body').css('overflow', 'hidden');
        },

        close: function(modal_id) {
            const $modal = $('#' + modal_id);
            if (!$modal.length) return;

            $modal.addClass('tw-hidden').removeClass('tw-flex');
            $('body').css('overflow', '');
        },
    };

    $(function() {
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                $('.tw-fixed:not(.tw-hidden)').each(function() {
                    ModalHelper.close($(this).attr('id'));
                });
            }
        });

        $(document).on('click', function(e) {
            const $target = $(e.target);
            if ($target.hasClass('tw-fixed') && $target.hasClass('tw-bg-gray-900/40')) {
                ModalHelper.close($target.attr('id'));
            }
        });
    })
</script>
