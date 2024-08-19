<?php

namespace App\Models;

use App\Notifications\VerifyUserNotification;
use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use SoftDeletes, Notifiable, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'users';

    protected $appends = [
        'picture',
    ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    public const IS_SUPER_RADIO = [
        '0' => 'No',
        '1' => 'Yes',
    ];

    public const CAN_SEE_PRICES_RADIO = [
        '0' => 'No',
        '1' => 'Yes',
    ];

    public const CAN_SET_PRICES_RADIO = [
        '0' => 'No',
        '1' => 'Yes',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const JOB_TYPE_SELECT = [
        '0' => 'Yönetici',
        '1' => 'Çevirmen',
        '2' => 'Karşılayıcı',
        '3' => 'Standart Kullanıcı',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'office_id',
        'phone',
        'job_type',
        'can_see_prices',
        'can_set_prices',
        'is_super',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (self $user) {
            $registrationRole = config('panel.registration_default_role');
            if (! $user->roles()->get()->contains($registrationRole)) {
                $user->roles()->attach($registrationRole);
            }
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function userPatients()
    {
        return $this->hasMany(Patient::class, 'user_id', 'id');
    }

    public function userTravelTreatmentActivities()
    {
        return $this->hasMany(TravelTreatmentActivity::class, 'user_id', 'id');
    }

    public function userActivities()
    {
        return $this->hasMany(Activity::class, 'user_id', 'id');
    }

    public function userCrmCustomers()
    {
        return $this->hasMany(CrmCustomer::class, 'user_id', 'id');
    }

    public function userCrmDocuments()
    {
        return $this->hasMany(CrmDocument::class, 'user_id', 'id');
    }

    public function userTasks()
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }

    public function userUserAlerts()
    {
        return $this->belongsToMany(UserAlert::class);
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getPictureAttribute()
    {
        // return $this->getMedia('picture')->last();
        $file = $this->getMedia('picture')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
