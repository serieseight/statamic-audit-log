<?php

namespace Statamic\Addons\AuditLog;

use Statamic\API\User;
use Statamic\API\YAML;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'audit_log';

    protected $guarded = [];

    protected $casts = [
        'meta' => 'array',
        'snapshot' => 'array',
    ];

    public static function record($event)
    {
        self::create([
            'user_id' => auth()->user()->id(),
            'data_id' => self::getId($event),
            'event' => self::getEvent($event),
            'meta' => self::getMeta($event),
            'snapshot' => self::getSnapshot($event),
        ]);
    }

    public function getUserAttribute()
    {
        return User::find($this->user_id) ?: null;
    }

    public function getTitle()
    {
        return array_get($this->meta, 'title')
            ?: array_get($this->snapshot, 'title')
            ?: array_get($this->snapshot, 'slug')
            ?: array_get($this->snapshot, 'id');
    }

    public function getYaml($key)
    {
        return YAML::dump($this->$key);

        return property_exists($this, $key) ? YAML::dump($this->$key) : null;
    }

    protected static function getId($event)
    {
        return array_get(self::getSnapshot($event), 'id');
    }

    protected static function getEvent($event)
    {
        return get_class($event);
    }

    protected static function getMeta($event)
    {
        $meta = [
            'ip' => request()->ip(),
        ];

        if (property_exists($event, 'meta')) {
            $meta = array_merge($meta, $event->meta);
        }

        return $meta;
    }

    protected static function getSnapshot($event)
    {
        if (method_exists($event, 'contextualData')) {
            return $event->contextualData();
        }

        return null;
    }
}
