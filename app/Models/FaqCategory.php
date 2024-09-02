<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqCategory extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'faq_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'category',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // Boot
    public static function boot()
    {
        parent::boot();
        $relatedCount = 0;
        static ::deleting(function ($model) use (&$relatedCount) {
            $relatedCount = FaqQuestion::where('category_id', $model->id)->count();
            if ($relatedCount > 0) {
                throw new \Exception('Cannot delete this value because it is referenced by other records.');
            }
        });
    }
}
