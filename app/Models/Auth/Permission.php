<?php

namespace App\Models\Auth;

use Spatie\Activitylog\Traits\LogsActivity;
use Zizaco\Entrust\EntrustPermission;

/**
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Permission extends EntrustPermission
{
    use LogsActivity;
}
