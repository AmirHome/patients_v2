<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Patient extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'patients';

    protected $appends = [
        'photo',
    ];

    public const GENDER_SELECT = [
        '0' => 'women',
        '1' => 'men',
        '2' => 'N/A',
    ];

    protected $dates = [
        'birthday',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const BLOOD_GROUP_SELECT = [
        '0' => 'A RH+',
        '1' => 'A RH-',
        '2' => 'B RH+',
        '3' => 'B RH-',
        '4' => '0 RH+',
        '5' => '0 RH-',
        '6' => 'AB RH+',
        '7' => 'AB RH-',
    ];

    protected $fillable = [
        'user_id',
        'office_id',
        'campaign_org_id',
        'city_id',
        'name',
        'middle_name',
        'surname',
        'mother_name',
        'father_name',
        'citizenship',
        'passport_no',
        'passport_origin',
        'phone',
        'foriegn_phone',
        'email',
        'gender',
        'birthday',
        'birth_place',
        'address',
        'weight',
        'height',
        'blood_group',
        'treating_doctor',
        'code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function patientTravels()
    {
        return $this->hasMany(Travel::class, 'patient_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function campaign_org()
    {
        return $this->belongsTo(CampaignOrg::class, 'campaign_org_id');
    }

    public function city()
    {
        return $this->belongsTo(Province::class, 'city_id');
    }

    public function getBirthdayAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
