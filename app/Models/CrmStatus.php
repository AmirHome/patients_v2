<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class CrmStatus extends Model
{
    use SoftDeletes, HasFactory;


    public $table = 'crm_statuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'color',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function statusCrmDocuments()
    {
        return $this->hasMany(CrmDocument::class, 'status_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($crmStatus) {
            // Check for foreign key constraints
            $relatedCustomersCount = DB::table('crm_customers')
                ->where('status_id', $crmStatus->id)
                ->count();

            if ($relatedCustomersCount > 0) {
                // Throw an exception or return an error message
                throw new \Exception('Cannot delete this status because it is referenced by other records.');
            }
        });
    }
}
