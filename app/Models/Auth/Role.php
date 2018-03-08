<?php

namespace App\Models\Auth;

use Spatie\Activitylog\Traits\LogsActivity;
use Zizaco\Entrust\EntrustRole;

/**
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Role extends EntrustRole
{
    use LogsActivity;
}
