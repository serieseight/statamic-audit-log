<?php

namespace Statamic\Addons\AuditLog;

use Statamic\API\User;
use Statamic\API\YAML;
use Statamic\API\Config;
use Statamic\Events\Data\ContentSaved;
use Statamic\Events\Data\TaxonomySaved;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'audit_log';

    protected $guarded = [];

    protected $casts = [
        'meta' => 'array',
        'snapshot' => 'array',
    ];

    public static function record($event, $eventName = null)
    {
        self::create([
            'user_id' => self::getUserId(),
            'data_id' => self::getId($event),
            'locale' => self::getLocale($event),
            'event' => $eventName ?: self::getEvent($event),
            'meta' => self::getMeta($event),
            'snapshot' => self::getSnapshot($event),
        ]);
    }

    public function getUserAttribute()
    {
        return User::find($this->user_id) ?: null;
    }

    public function getLocaleAttribute()
    {
        if (! $locale = array_get($this->getAttributes(), 'locale')) {
            return;
        }

        return Config::getLocaleName($locale);
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

    protected static function getUserId()
    {
        return ($user = auth()->user()) ? $user->id() : null;
    }

    protected static function getId($event)
    {
        return array_get(self::getSnapshot($event), 'id');
    }

    protected static function getLocale($event)
    {
        return self::hasLocale($event) ? request()->get('locale') : null;
    }

    protected static function hasLocale($event)
    {
        return $event instanceof ContentSaved || $event instanceof TaxonomySaved;
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
        if (isset($event->data) && method_exists($event->data, 'in')) {
            return $event->data->in(request()->get('locale'))->toArray();
        }

        if (method_exists($event, 'contextualData')) {
            return $event->contextualData();
        }

        if (method_exists($event, 'data')) {
            return $event->data();
        }

        return null;
    }
}
