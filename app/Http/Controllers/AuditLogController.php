<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class AuditLogController extends Controller
{
    public function index()
    {
        return view('audit-logs.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $logs = Activity::with(['causer', 'subject'])->latest();

            return DataTables::of($logs)
                ->editColumn('created_at', function ($log) {
                    return Carbon::parse($log->created_at)->format('H:i - d/m/Y');
                })
                ->addColumn('causer_name', function ($log) {
                    return $log->causer?->name;
                })
                ->editColumn('subject_id', function ($log) {
                    if (!$log->subject_type) return 'N/A';

                    $modelName = class_basename($log->subject_type);
                    return '<span class="tw-text-xs tw-font-mono tw-bg-gray-100 tw-px-1.5 tw-py-0.5 tw-rounded-sm">
                            ' . $modelName . ' #' . $log->subject_id . '
                            </span>';
                })
                ->addColumn('ip_address', function ($log) {
                    return $log->getExtraProperty('ip');
                })
                ->rawColumns(['description', 'subject_id', 'ip_address'])
                ->make(true);
        }
    }

    public function getFilterData()
    {
        // Get log names
        $logNames = Activity::select('log_name')
            ->whereNotNull('log_name')
            ->where('log_name', '!=', '')
            ->distinct()
            ->pluck('log_name');

        $logNameData = $logNames->map(function ($name) {
            return [
                'id' => $name,
                'text' => $name
            ];
        })->values();

        // Get causers
        $causerIds = Activity::whereNotNull('causer_id')->distinct()->pluck('causer_id');

        $causerData = User::whereIn('id', $causerIds)
            ->select('id', 'name')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'text' => $user->name
                ];
            })->values();

        return response()->json([
            'logNameData' => $logNameData,
            'causerData'  => $causerData,
        ]);
    }

    public function show($id)
    {
        $activity = Activity::findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $activity,
        ]);
    }
}
