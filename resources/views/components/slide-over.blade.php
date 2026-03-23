@props(['id', 'title'])

<div id="{{ $id }}" class="slideover-container tw-fixed tw-inset-0 tw-z-50 tw-hidden">

    <div
        class="slideover-backdrop close-slideover tw-absolute tw-inset-0 tw-bg-black/30 tw-opacity-0 tw-transition-opacity tw-duration-300">
    </div>

    <div
        class="slideover-panel tw-absolute tw-inset-y-0 tw-right-0 tw-w-full tw-max-w-md tw-bg-white tw-shadow-2xl tw-flex tw-flex-col tw-transform tw-transition-transform tw-duration-300 tw-translate-x-full">

        <div class="tw-flex tw-items-center tw-justify-between tw-px-6 tw-py-4 tw-border-b tw-border-gray-200">
            <h2 class="tw-text-lg tw-font-semibold tw-text-gray-900">{{ $title }}</h2>
            <button type="button" class="close-slideover tw-text-gray-400 hover:tw-text-gray-700 tw-transition-colors">
                <i class="fas fa-times tw-text-lg"></i>
            </button>
        </div>

        {{ $slot }}

    </div>
</div>

@once
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.openSlideover = function(id) {
                const container = document.getElementById(id);
                if (!container) return;
                const panel = container.querySelector('.slideover-panel');
                const backdrop = container.querySelector('.slideover-backdrop');

                container.classList.remove('tw-hidden');
                setTimeout(() => {
                    panel.classList.remove('tw-translate-x-full');
                    panel.classList.add('tw-translate-x-0');
                    backdrop.classList.remove('tw-opacity-0');
                    backdrop.classList.add('tw-opacity-100');
                }, 10);
            }

            window.closeSlideover = function(container) {
                const panel = container.querySelector('.slideover-panel');
                const backdrop = container.querySelector('.slideover-backdrop');

                panel.classList.remove('tw-translate-x-0');
                panel.classList.add('tw-translate-x-full');
                backdrop.classList.remove('tw-opacity-100');
                backdrop.classList.add('tw-opacity-0');

                setTimeout(() => {
                    container.classList.add('tw-hidden');
                }, 300);
            }

            document.addEventListener('click', function(e) {
                const openBtn = e.target.closest('[data-slideover-target]');
                if (openBtn) {
                    e.preventDefault();
                    openSlideover(openBtn.getAttribute('data-slideover-target'));
                }

                if (e.target.closest('.close-slideover')) {
                    e.preventDefault();
                    const container = e.target.closest('.slideover-container');
                    if (container) closeSlideover(container);
                }
            });
        });
    </script>
@endonce
