<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\AccountType;
use App\Models\Department;
use App\Models\Team;

class UserController extends Controller
{
    public function index()
    {

        return view('users.index',);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with(['department', 'position', 'team', 'accountType'])
                ->select('users.*')
                ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
                ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
                ->leftJoin('teams', 'users.team_id', '=', 'teams.id')
                ->leftJoin('account_types', 'users.account_type_id', '=', 'account_types.id');

            // Filters
            if ($request->filled('status')) {
                $users->where('users.status', $request->status);
            }
            if ($request->filled('department_id')) {
                $users->where('users.department_id', $request->department_id);
            }
            if ($request->filled('team_id')) {
                $users->where('users.team_id', $request->team_id);
            }
            if ($request->filled('account_type_id')) {
                $users->where('users.account_type_id', $request->account_type_id);
            }

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

    public function getFilterData()
    {
        $status_data = collect([
            ['id'  => 1, 'text' => 'Đã nghỉ'],
            ['id' => 0, 'text' => 'Đang làm'],
        ]);
        $department_data   = Department::select('id', 'name as text')->orderBy('name')->get();
        $team_data = Team::select('id', 'name as text')->orderBy('name')->get();
        $account_type_data = AccountType::select('id', 'name as text')->orderBy('name')->get();

        return response()->json([
            'status_data'     => $status_data,
            'department_data' => $department_data,
            'team_data'       => $team_data,
            'account_type_data' => $account_type_data,
        ]);
    }
}
