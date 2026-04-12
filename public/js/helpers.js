const loadingHtml = `
    <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-h-full tw-min-h-[300px] tw-text-gray-500">
        <i class="fas fa-spinner fa-spin tw-text-4xl tw-text-[#0063B1] tw-mb-4"></i>
        <p class="tw-text-sm">Đang tải dữ liệu...</p>
    </div>
`;

function renderOptions(selector, items) {
    let $selector = $(selector);
    if (!items) items = [];

    // Reset select
    $selector.find('option:not([value=""])').remove();
    $selector.val('');

    let html = '';
    items.forEach((item) => {
        html += `<option value="${item.id}">${item.text}</option>`;
    });
    $selector.append(html);
}

$('#f_status, #f_department, #f_employment_type, #f_role').select2({
    theme: 'bootstrap4',
    minimumResultsForSearch: 10,
    width: '100%',
});

$('#f_logName, #f_causer').select2({
    theme: 'bootstrap4',
    minimumResultsForSearch: 10,
    width: '100%',
});
