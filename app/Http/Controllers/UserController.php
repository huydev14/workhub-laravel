<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {

        return view('users.index',);
    }

    public function data()
    {
        $users = User::with(['department', 'position', 'team', 'accountType']);

        return DataTables::of($users)
            ->addIndexColumn()

            ->editColumn('gender', function ($user) {
                return $user->gender === 0
                    ? '<span class="badge badge-info">Nam</span>'
                    : '<span class="badge badge-danger">Nữ</span>';
            })
            ->editColumn('status', function ($user) {
                return $user->status === 0
                    ? '<span class="badge badge-success">Đang làm việc</span>'
                    : '<span class="badge badge-secondary">Đang nghỉ việc</span>';
            })
            ->editColumn('employment_type', function ($user) {
                return $user->employment_type === 0 ? 'Full-time' : 'Part-time';
            })
            ->editColumn('start_date', function ($user) {
                return $user->start_date ? Carbon::parse($user->start_date)->format('d/m/Y') : '-';
            })
            ->editColumn('end_date', function ($user) {
                return $user->end_date ? Carbon::parse($user->end_date)->format('d/m/Y') : '-';
            })
            ->editColumn('birthday', function ($user) {
                return $user->birthday ? Carbon::parse($user->birthday)->format('d/m/Y') : '-';
            })
            ->addColumn('action', function ($user) {
                return '
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning" title="Sửa"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" title="Xóa"><i class="fas fa-trash"></i></button>
                    </div>
                ';
            })
            ->rawColumns(['gender', 'status', 'action'])
            ->make(true);
    }
}
