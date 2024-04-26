<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Travel extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'travels';

    public const REFFERING_TYPE_SELECT = [
        'Other'    => 'Diğer',
        'Doctor'   => 'Doctor',
        'Ministry' => 'Kurm',
        'Office'   => 'Ofis',
        'Phone'    => 'Fon',
    ];

    protected $dates = [
        'hospitalization_date',
        'planning_discharge_date',
        'arrival_date',
        'departure_date',
        'visa_start_date',
        'visa_end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'patient_id',
        'group_id',
        'hospital_id',
        'department_id',
        'status_id',
        'attendant_name',
        'attendant_address',
        'attendant_phone',
        'has_pestilence',
        'hospital_mail_notify',
        'reffering',
        'reffering_type',
        'notify_hospitals',
        'hospitalization_date',
        'planning_discharge_date',
        'arrival_date',
        'departure_date',
        'wants_shopping',
        'visa_status',
        'visa_start_date',
        'visa_end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function travelTravelTreatmentActivities()
    {
        return $this->hasMany(TravelTreatmentActivity::class, 'travel_id', 'id');
    }

    public function travelActivities()
    {
        return $this->hasMany(Activity::class, 'travel_id', 'id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function group()
    {
        return $this->belongsTo(TravelGroup::class, 'group_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function status()
    {
        return $this->belongsTo(TravelStatus::class, 'status_id');
    }

    public function getHospitalizationDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setHospitalizationDateAttribute($value)
    {
        $this->attributes['hospitalization_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getPlanningDischargeDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setPlanningDischargeDateAttribute($value)
    {
        $this->attributes['planning_discharge_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getArrivalDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setArrivalDateAttribute($value)
    {
        $this->attributes['arrival_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDepartureDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDepartureDateAttribute($value)
    {
        $this->attributes['departure_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getVisaStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setVisaStartDateAttribute($value)
    {
        $this->attributes['visa_start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getVisaEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setVisaEndDateAttribute($value)
    {
        $this->attributes['visa_end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
