<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelTreatmentStatus extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'travel_treatment_statuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function statusTravelTreatmentActivities()
    {
        return $this->hasMany(TravelTreatmentActivity::class, 'status_id', 'id');
    }

    public function statusActivities()
    {
        return $this->hasMany(Activity::class, 'status_id', 'id');
    }
}
