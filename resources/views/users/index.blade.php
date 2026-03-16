@extends('layouts.main')

@section('content')
    <table id="users-table" class="display table table-bordered text-nowrap" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Họ tên</th>
                <th>Email</th>

                <th>Bộ phận</th>
                <th>Vị trí</th>
                <th>Đội nhóm</th>

                <th>Loại công việc</th>
                <th>Trạng thái</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>

                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Loại tài khoản</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
    </table>


    <script type="module">
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true, // Enables server-side processing,
                scrollX: true,
                autoWidth: false,
                ajax: '{!! route('users.data') !!}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        sortable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },

                    {
                        data: 'department.name',
                        name: 'department.name',
                        defaultContent: '-'
                    },
                    {
                        data: 'position.name',
                        name: 'position.name',
                        defaultContent: '-'
                    },
                    {
                        data: 'team.name',
                        name: 'team.name',
                        defaultContent: '-'
                    },

                    {
                        data: 'employment_type',
                        name: 'employment_type'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },

                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'birthday',
                        name: 'birthday'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },

                    {
                        data: 'account_type.name',
                        name: 'account_type.name',
                        defaultContent: '-'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    "processing": "{{ __('datatables.processing') }}",
                    "search": "{{ __('datatables.search') }}",
                    "lengthMenu": "{{ __('datatables.lengthMenu') }}",
                    "info": "{{ __('datatables.info') }}",
                    "infoEmpty": "{{ __('datatables.infoEmpty') }}",
                    "infoFiltered": "{{ __('datatables.infoFiltered') }}",
                    "zeroRecords": "{{ __('datatables.zeroRecords') }}",
                    "loadingRecords": "{{ __('datatables.loadingRecords') }}",
                },
                layout: {
                    topStart: 'pageLength',
                    topEnd: {
                        search: {
                            placeholder: 'Tìm kiếm nhân viên...'
                        }
                    },
                    bottomStart: 'info',
                    bottomEnd: 'paging',
                }
            });
        });
    </script>
@endsection
