<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;

class ActivityLog extends Model implements ActivityContract
{
    public $guarded = [];

    protected $casts = [
        'properties' => 'collection',
    ];

    public function __construct(array $attributes = [])
    {
        if (!isset($this->connection)) {
            $this->setConnection(config('activitylog.database_connection'));
        }

        if (!isset($this->table)) {
            $this->setTable(config('activitylog.table_name'));
        }

        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(
            function ($model) {
                // ... code here
                $model->properties = $model->properties->put('ip', request()->ip());
                // $model->properties[] = ["a"=>"a"];
                // dd($model->properties);
            }
        );
        self::saving(
            function ($model) {
                // ... code here
                $model->properties->put('ip', '127.0.0.1');
            }
        );
    }

    public function subject(): MorphTo
    {
        if (config('activitylog.subject_returns_soft_deleted_models')) {
            return $this->morphTo()->withTrashed();
        }

        return $this->morphTo();
    }

    public function causer(): MorphTo
    {
        return $this->morphTo();
    }

    public function getExtraProperty(string $propertyName, mixed $defaultValue): mixed
    {
        return Arr::get($this->properties->toArray(), $propertyName);
    }

    public function getChangesAttribute(): Collection
    {
        return $this->changes();
    }

    public function changes(): Collection
    {
        if (!$this->properties instanceof Collection) {
            return new Collection();
        }

        return $this->properties->only(['attributes', 'old']);
    }

    public function scopeInLog(Builder $query, ...$logNames): Builder
    {
        if (is_array($logNames[0])) {
            $logNames = $logNames[0];
        }

        return $query->whereIn('log_name', $logNames);
    }

    public function scopeCausedBy(Builder $query, Model $causer): Builder
    {
        return $query->where('causer_type', $causer->getMorphClass())->where('causer_id', $causer->getKey());
    }

    public function scopeForSubject(Builder $query, Model $subject): Builder
    {
        return $query->where('subject_type', $subject->getMorphClass())->where('subject_id', $subject->getKey());
    }

    public function scopeForEvent(Builder $query, string $event): Builder
    {
        return $event;
    }
}
