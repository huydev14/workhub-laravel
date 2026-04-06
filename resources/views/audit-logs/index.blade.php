@extends('layouts.main')

@section('content')
    <div class="fluent-card ">
        <div class="card-header tw-bg-white tw-border-b-0">
            {{-- Toolbar --}}
            <x-toolbar/>

            <div id="filter-panel" class="tw-hidden tw-pt-5 tw-pb-2">

                <div class="tw-flex tw-justify-between tw-items-center tw-mb-5">
                    <h4 class="tw-text-base tw-font-bold tw-text-gray-800">Filter</h4>
                    <div class="tw-flex tw-items-center tw-gap-4">
                        <button id="btn-clear-filters"
                            class="tw-text-sm tw-text-blue-600 hover:tw-text-blue-800 tw-font-medium">
                            Clear all
                        </button>
                        <button id="close-filter-btn" class="tw-text-gray-400 hover:tw-text-gray-700 tw-transition-colors">
                            <i class="fas fa-times tw-text-lg"></i>
                        </button>
                    </div>
                </div>

                <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-3 tw-gap-x-8 tw-gap-y-6">
                    <x-filter-select id="f_log_name" label="Phân hệ" />
                </div>
            </div>
        </div>

        <div class="card-body tw-pt-0">
            <table id="audit-logs-table" class="display table table-hover text-nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Thời gian</th>
                        <th>Phân hệ</th>
                        <th>Actor / Causer</th>
                        <th>Action / Event</th>
                        <th>Target</th>
                        <th>Session ID</th>
                        <th>Details</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script>
        $(function() {
            // ---- RENDER TABLE --------------------------
            window.table = new DataTable('#audit-logs-table', {
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
                        data: 'log_name',
                        name: 'log_name',
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
                        data: 'session_id',
                        name: 'session_id',
                        orderable: false,
                    },
                    {
                        data: 'details',
                        name: 'details',
                        orderable: false,
                        searchable: false,
                    },
                ],
                layout: {
                    topStart: null,
                    topEnd: null,
                    bottomStart: 'pageLength',
                    bottomEnd: 'paging',
                },
            });

            $('#custom-search-input').on('keyup', function() {
                table.search(this.value).draw();
            });

            // ---- FILTER PANEL TOGGLE ---------------------------
            $('#toggle-filter-btn').on('click', function() {
                $('#filter-panel').slideToggle('fast');
                $(this).toggleClass('tw-text-[#0f6cbd] tw-bg-blue-50 tw-rounded');

                // Reset filter
                $('#f_status, #f_department, #f_employment_type, #f_role').val('').trigger(
                    'change.select2');
                table.ajax.reload();
            });

            // ---- RENDER OPTIONS FOR SELECT FIELDs ----------------
            $.getJSON('{!! route('users.filter_data') !!}')
                .done(function(res) {
                    renderOptions('#f_log_name', res.department_data);

                    $('#create-department').on('change', function() {
                        let departmentId = $(this).val();

                        $.getJSON('{{ route('users.filter_data') }}', {
                                department_id: departmentId
                            })
                            .done(function(res) {
                                renderOptions('#create-team', res.team_data)
                            });
                    })

                })
                .fail(function(xhr) {
                    console.error('Load error:', xhr.status)
                    console.error('Load error:', xhr.responseText)
                });

            $(document).on('change', '#filter-panel select', function() {
                table.ajax.reload();
            });

            // Clear filter
            $(document).on('click', '#btn-clear-filters', function() {
                $('#f_status, #f_department, #f_employment_type, #f_role').val('').trigger(
                    'change.select2');
                table.ajax.reload();
            });

            $(document).on('click', '.edit-user-btn, #edit-user-btn', function() {
                let editUrl = $(this).data('edit-url');
                openSlideover('slideover-edit-user');
                $('#content-edit').html(loadingHtml);

                $.get(editUrl, function(html) {
                    $('#content-edit').html(html);

                }).fail(function(xhr) {
                    $('#content-edit').html(
                        '<div class="tw-text-center tw-mt-10">Đã có lỗi xả ra. Vui lòng thử lại sau.</div>'
                    );
                    console.error('Load edit form error:', xhr.status);
                    console.error('Load edit form error:', xhr.responseText);
                });
            });

            // ---- Delete user ------------------------
            $(document).on('click', '#delete-user-btn', function() {
                let $btn = $(this);
                let deleteUrl = $btn.data('delete-url');
                let restoreUrl = $btn.data('restore-url');

                if (!confirm('Confirm delete?')) {
                    return;
                }

                $btn.prop('disabled', true);

                $.ajax({
                    type: 'DELETE',
                    url: deleteUrl,
                    success: function(res) {
                        table.ajax.reload(null, false);
                        fluentToast({
                            type: 'info',
                            title: 'Đã xóa nhân viên',
                            description: 'Tài khoản nhân viên đã được chuyển vào thùng rác.',
                            subtitle: res.status,
                            actionType: 'close',
                            bottomActions: [{
                                text: 'Hoàn tác',

                                // Restore soft-deleted user
                                onClick: function() {
                                    $.ajax({
                                        type: 'POST',
                                        url: restoreUrl,
                                        success: function(res) {
                                            table.ajax.reload(
                                                null, false);

                                            fluentToast({
                                                type: 'success',
                                                title: 'Hoàn tác thành công',
                                                description: 'Tài khoản nhân viên đã được khôi phục hoạt động.',
                                                actionType: 'close',
                                            });
                                        },
                                        error: function(xhr) {
                                            fluentToast({
                                                type: 'error',
                                                title: 'Lỗi khôi phục',
                                                description: 'Không thể hoàn tác thao tác này.',
                                                subtitle: 'Mã lỗi: ' +
                                                    xhr
                                                    .status,
                                            });
                                            console.error(
                                                'Load error:',
                                                xhr.status)
                                            console.error(
                                                'Load error:',
                                                xhr
                                                .responseText
                                            )
                                        }
                                    })
                                }
                            }]
                        });
                    },
                    error: function(xhr) {
                        fluentToast({
                            type: 'error',
                            title: 'Đã xảy ra lỗi!',
                            description: 'Hãy thử lại sau',
                            subtitle: 'Mã lỗi: ' + xhr.status,
                            actionType: 'close'
                        });
                        console.error('Load error:', xhr.status)
                        console.error('Load error:', xhr.responseText)
                    },
                    complete: function() {
                        $btn.prop('disabled', false);
                    }
                });
            })
        });
    </script>
@endsection
