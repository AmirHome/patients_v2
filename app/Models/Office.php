<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use Auditable, HasFactory;

    public $table = 'offices';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'phone',
        'fax',
        'address',
        'city_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function officePatients()
    {
        return $this->hasMany(Patient::class, 'office_id', 'id');
    }

    public function officeUsers()
    {
        return $this->hasMany(User::class, 'office_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(Province::class, 'city_id');
    }
}
