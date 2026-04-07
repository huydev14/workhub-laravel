@extends('layouts.main')

@section('content')
    <div class="fluent-card ">
        <div class="card-header tw-bg-white tw-border-b-0">
            {{-- Toolbar --}}
            <x-toolbar dataTableInstance="auditLogTable" />

            <div id="filter-panel" class="tw-hidden tw-pt-5 tw-pb-2">

                <div class="tw-flex tw-justify-between tw-items-center tw-mb-5">
                    <h4 class="tw-text-base tw-font-bold tw-text-gray-800">Filter</h4>
                    <div class="tw-flex tw-items-center tw-gap-4">
                        <button id="btn-clear-filters" class="tw-text-sm tw-font-medium">
                            Clear all
                        </button>
                        <button id="close-filter-btn" class="tw-text-gray-400 hover:tw-text-gray-700 tw-transition-colors">
                            <i class="fas fa-times tw-text-lg"></i>
                        </button>
                    </div>
                </div>

                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-x-8 tw-gap-y-6">
                    <x-filter-select id="f_logName" label="Phân hệ" />
                    <x-filter-select id="f_causer" label="Actor / Causer" />
                </div>
            </div>
        </div>

        <div class="card-body tw-pt-0">
            <table id="audit-log-table" class="display table table-hover text-nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Thời gian</th>
                        <th>Actor / Causer</th>
                        <th>Description</th>
                        <th>Target</th>
                        <th>Phân hệ</th>
                        <th>IP Address</th>
                        <th>Details</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('audit-logs.modals.audit-logs-detail')

    @push('scripts')
        <script>
            $(function() {
                // ---- RENDER TABLE --------------------------
                window.auditLogTable = new DataTable('#audit-log-table', {
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: {
                        url: '{!! route('audit-logs.data') !!}',
                    },
                    order: [],
                    columns: [{
                            data: 'created_at',
                            name: 'created_at',
                        },
                        {
                            data: 'causer_name',
                            name: 'causer_name',
                        },
                        {
                            data: 'description',
                            name: 'description',
                        },
                        {
                            data: 'subject_id',
                            name: 'subject_id',
                        },
                        {
                            data: 'log_name',
                            name: 'log_name',
                        },
                        {
                            data: 'ip_address',
                            name: 'ip_address',
                            orderable: false,
                        },
                        {
                            data: 'id',
                            orderable: false,
                            searchable: false,
                            render: function(data) {
                                let url = '{{ route('audit-logs.show', ':id') }}'.replace(':id', data);
                                return `
                                <button class="view-log-btn tw-text-blue-600 hover:tw-text-blue-800 tw-font-medium"
                                data-show-url="${url}">
                                    Xem chi tiết
                                </button>`;
                            }
                        },
                    ],
                    // createdRow: function(row, data) {
                    //     let url = '{{ route('audit-logs.show', ':id') }}'.replace(':id', data.id);

                    //     $(row).css('cursor', 'pointer').on('click', function(e) {
                    //         if ($(e.target).closest('button').length > 0) {
                    //             return;
                    //         }
                    //         window.location.href = url;
                    //     })
                    // },
                    layout: {
                        topStart: null,
                        topEnd: null,
                        bottomStart: 'pageLength',
                        bottomEnd: 'paging',
                    },
                });
                $('#custom-search-input').on('keyup', function() {
                    auditLogTable.search(this.value).draw();
                });

                // ---- FILTER PANEL TOGGLE ---------------------------
                $('#toggle-filter-btn').on('click', function() {
                    $('#filter-panel').slideToggle('fast');
                    $(this).toggleClass('tw-text-[#0f6cbd] tw-bg-blue-50 tw-rounded');

                    // Reset filter
                    $('#f_logName, #f_causer').val('').trigger(
                        'change.select2');
                    auditLogTable.ajax.reload();
                });

                // ---- RENDER OPTIONS FOR SELECT FIELDs ----------------
                $.getJSON('{!! route('audit-logs.filter_data') !!}')
                    .done(function(res) {
                        renderOptions('#f_logName', res.logNameData);
                        renderOptions('#f_causer', res.causerData)
                    })
                    .fail(function(xhr) {
                        console.error('Load error:', xhr.status)
                        console.error('Load error:', xhr.responseText)
                    });

                $(document).on('change', '#filter-panel select', function() {
                    auditLogTable.ajax.reload();
                });

                // Clear filter
                $(document).on('click', '#btn-clear-filters', function() {
                    $('#f_logName, #f_causer').val('').trigger('change.select2');
                    auditLogTable.ajax.reload();
                });

                $('#f_logName, #f_causer').select2({
                    theme: 'bootstrap4',
                    minimumResultsForSearch: 10,
                    width: '100%',
                });

                $('#audit-log-table').on('click', '.view-log-btn', function() {
                    const showUrl = $(this).data('show-url')
                    const logId = $(this).data('id');

                    ModalHelper.open('logDetailModal');

                    $.ajax({
                        url: showUrl,
                        type: 'GET',
                        success: function(res) {
                            const props = res.data.properties || {};

                            $('#logUrl').text(props.url || 'N/A');
                            $('#logIp').text(props.ip || 'Unknown');
                            $('#logSessionId').text(props.session_id || 'N/A');
                            $('#logUserAgent').text(props.user_agent || 'Unknown Device');

                            if (props.is_ajax) {
                                $('#logAjax').html(
                                    `<span class="tw-inline-flex tw-items-center tw-rounded-sm tw-bg-blue-100 tw-px-2 tw-py-1 tw-text-xs tw-font-medium tw-text-blue-700">
                                        AJAX Request
                                    </span>`
                                );
                            } else {
                                $('#logAjax').html(
                                    `<span class="tw-inline-flex tw-items-center tw-rounded-sm tw-bg-gray-100 tw-px-2 tw-py-1 tw-text-xs tw-font-medium tw-text-gray-600">
                                        Trực tiếp (Non-AJAX)
                                    </span>`
                                );
                            }

                            let methodClass = 'tw-bg-gray-100 tw-text-gray-700';
                            if (props.method === 'GET') methodClass =
                                'tw-bg-blue-100 tw-text-blue-700';
                            if (props.method === 'POST') methodClass =
                                'tw-bg-green-100 tw-text-green-700';
                            if (props.method === 'DELETE') methodClass =
                                'tw-bg-red-100 tw-text-red-700';
                            if (props.method === 'PUT' || props.method === 'PATCH') methodClass =
                                'tw-bg-orange-100 tw-text-orange-700';

                            $('#logMethod')
                                .text(props.method || 'N/A')
                                .removeClass()
                                .addClass(
                                    `tw-inline-flex tw-items-center tw-rounded tw-px-2 tw-py-1 tw-text-xs tw-font-bold ${methodClass}`
                                    );
                        }
                    })
                })
            });
        </script>
    @endpush
@endsection
