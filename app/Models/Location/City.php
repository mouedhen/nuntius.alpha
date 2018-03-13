<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Model;
use PragmaRX\Countries\Package\Countries;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property int $id
 * @property string $name_en
 * @property string $name_fr
 * @property string $name_ar
 * @property string $country_cca2
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class City extends Model
{
    use LogsActivity;

    protected $table = 'cities';
    protected $fillable = ['name', 'country_cca2'];

    public function country() {
        return Countries::where('cca2', $this->country_cca2);
    }
}
