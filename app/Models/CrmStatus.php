<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrmStatus extends Model
{
    use SoftDeletes, Auditable, HasFactory;

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

    // GUIDE delete related #1
    public static function boot()
    {
        parent::boot();
        $relatedCount = 0;
        static::deleting(function ($crmStatus) use (&$relatedCount){

            $relatedCount += CrmCustomer::where('status_id', $crmStatus->id)->count();

            if ($relatedCount > 0) {
                throw new \Exception('Cannot delete this status because it is referenced by other records.');
            }
        });
    }
}
