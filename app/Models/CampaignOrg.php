<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignOrg extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'campaign_orgs';

    public const STATUS_RADIO = [
        '0' => 'Passive',
        '1' => 'Active',
    ];

    protected $dates = [
        'started_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'channel_id',
        'started_at',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function campaignOrgPatients()
    {
        return $this->hasMany(Patient::class, 'campaign_org_id', 'id');
    }

    public function channel()
    {
        return $this->belongsTo(CampaignChannel::class, 'channel_id');
    }

    public function getStartedAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartedAtAttribute($value)
    {
        $this->attributes['started_at'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
