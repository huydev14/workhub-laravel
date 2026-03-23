<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Department;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {

        return view('users.index',);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with(['department', 'position', 'roles'])
                ->select('users.*')
                ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
                ->leftJoin('positions', 'users.position_id', '=', 'positions.id');

            // Filters
            if ($request->filled('status')) {
                $users->where('users.status', $request->status);
            }
            if ($request->filled('department_id')) {
                $users->where('users.department_id', $request->department_id);
            }
            if ($request->filled('employment_type_id')) {
                $users->where('users.employment_type', $request->employment_type_id);
            }
            if ($request->filled('role')) {
                $users->whereHas('roles', function ($q) use ($request) {
                    $q->where('roles.id', $request->role);
                });
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
                        : '<span class="badge badge-secondary">Đã nghỉ việc</span>';
                })
                ->editColumn('employment_type', function ($user) {
                    return $user->employment_type === 0 ? 'Full-time' : 'Part-time';
                })
                ->addColumn('role', function ($user) {
                    return $user->roles->first()?->name;
                })
                ->addColumn('action', function ($user) {
                    return view('partials.action', compact('user'))->render();
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
        $employment_type_data = collect([
            ['id' => 0, 'text' => 'Full-time'],
            ['id' => 1, 'text' => 'Part-time'],
        ]);
        $department_data   = Department::select('id', 'name as text')->orderBy('name')->get();
        $role_data = Role::select('id', 'name as text')->orderBy('id')->get();

        return response()->json([
            'status_data' => $status_data,
            'department_data' => $department_data,
            'employment_type_data' => $employment_type_data,
            'role_data' => $role_data,
        ]);
    }
}
