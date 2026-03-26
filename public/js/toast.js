window.fluentToast = function ({
    type = 'success',
    title,
    description = '',
    subtitle = '',
    actionType = 'close',
    actionText = '',
    onAction = null,
}) {
    const icons = {
        success: 'fas fa-check-circle',
        error: 'fas fa-times-circle',
        info: 'fas fa-arrow-down',
        warning: 'fas fa-exclamation-triangle',
    };

    let actionHtml = '';
    if (actionType === 'link') {
        actionHtml = `<button class="action-btn link-btn">${actionText}</button>`;
    } else {
        actionHtml = `<button class="action-btn close-btn"><i class="fas fa-times"></i></button>`;
    }

    let extraTextHtml = '';
    if (description) {
        extraTextHtml += `<div class="toast-description">${description}</div>`;
    }

    if (subtitle) {
        extraTextHtml += `<div class="toast-subtitle">${subtitle}</div>`;
    }

    const toastHtml = $(`
        <div class="fluent-toast-card">
            <div class="toast-left">
                <i class="${icons[type]} toast-icon ${type}"></i>
                <div class="toast-text-container">
                    <span class="toast-title">${title}</span>
                    ${extraTextHtml}
                </div>
            </div>
            <div class="toast-action">
                ${actionHtml}
            </div>
        </div>
    `);

    $('#fluent-toast-container').append(toastHtml);
    setTimeout(() => toastHtml.addClass('show'), 10);

    let displayTime = description ? 7000 : 4000;

    let autoClose = setTimeout(() => {
        removeToast(toastHtml);
    }, displayTime);

    toastHtml.find('.action-btn').on('click', function () {
        if (actionType === 'link' && typeof onAction === 'function') {
            onAction();
        }
        clearTimeout(autoClose);
        removeToast(toastHtml);
    });

    function removeToast($el) {
        $el.removeClass('show');
        setTimeout(() => $el.remove(), 300);
    }
};
