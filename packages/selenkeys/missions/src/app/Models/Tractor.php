<?php
/**
 * Created by PhpStorm.
 * User: mouedhen
 * Date: 19/02/18
 * Time: 00:20
 */

namespace Selenkeys\Missions\App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Tractor extends Model
{
    use LogsActivity;
    protected $table = 'tractors';
    protected $fillable = ['designation'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}