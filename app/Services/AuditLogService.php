<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class AuditLogService
{
    public static function log(
        string $description,
        string $log_name = 'system',
        ?Model $caused_by = null,
        ?Model $performedOn = null
    ) {
        $activity = activity($log_name);

        if ($caused_by) {
            $activity->causedBy($caused_by);
        }
        if ($performedOn) {
            $activity->performedOn($performedOn);
        }

        $properties = [
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'url'        => request()->fullUrl(),
            'method'     => request()->method(),
            'is_ajax'    => request()->ajax(),
            'session_id' => session()->getId(),
        ];

        return $activity->withProperties($properties)->log($description);
    }
}
