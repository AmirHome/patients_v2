<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpensesIncome extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'expenses_incomes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CATEGORY_SELECT = [
        '1' => 'Expenses',
        '2' => 'Expenses-Commission',
        '3' => 'Income',
        '4' => 'Income-Commission',
    ];

    protected $fillable = [
        'user_id',
        'category',
        'patient_id',
        'department_id',
        'amount',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
