<?php

namespace Statamic\Addons\AuditLog;

use Statamic\API\Str;
use Statamic\API\Nav;
use Statamic\Extend\Listener;
use Illuminate\Support\Facades\Event as CoreEvent;

class AuditLogListener extends Listener
{
    public $events = [
        'cp.add_to_head' => 'addToHead',
        'cp.nav.created' => 'addNavItem',

        // Statamic Data Events
        \Statamic\Events\Data\AddonSettingsSaved::class => 'record',
        \Statamic\Events\Data\AssetContainerDeleted::class => 'record',
        \Statamic\Events\Data\AssetContainerSaved::class => 'record',
        \Statamic\Events\Data\AssetDeleted::class => 'record',
        \Statamic\Events\Data\AssetFolderDeleted::class => 'record',
        \Statamic\Events\Data\AssetFolderSaved::class => 'record',
        \Statamic\Events\Data\AssetMoved::class => 'record',
        \Statamic\Events\Data\AssetReplaced::class => 'record',
        \Statamic\Events\Data\AssetUploaded::class => 'record',
        \Statamic\Events\Data\CollectionDeleted::class => 'record',
        \Statamic\Events\Data\CollectionSaved::class => 'record',
        \Statamic\Events\Data\EntryDeleted::class => 'record',
        \Statamic\Events\Data\EntrySaved::class => 'record',
        \Statamic\Events\Data\FieldsetDeleted::class => 'record',
        \Statamic\Events\Data\FieldsetSaved::class => 'record',
        \Statamic\Events\Data\FileUploaded::class => 'record',
        \Statamic\Events\Data\GlobalsDeleted::class => 'record',
        \Statamic\Events\Data\GlobalsSaved::class => 'record',
        \Statamic\Events\Data\PageDeleted::class => 'record',
        \Statamic\Events\Data\PageMoved::class => 'record',
        \Statamic\Events\Data\PageSaved::class => 'record',
        \Statamic\Events\Data\PagesMoved::class => 'record',
        \Statamic\Events\Data\RoleDeleted::class => 'record',
        \Statamic\Events\Data\RoleSaved::class => 'record',
        \Statamic\Events\Data\SettingsSaved::class => 'record',
        \Statamic\Events\Data\SubmissionDeleted::class => 'record',
        \Statamic\Events\Data\SubmissionSaved::class => 'record',
        \Statamic\Events\Data\TaxonomyDeleted::class => 'record',
        \Statamic\Events\Data\TaxonomySaved::class => 'record',
        \Statamic\Events\Data\TermDeleted::class => 'record',
        \Statamic\Events\Data\TermSaved::class => 'record',
        \Statamic\Events\Data\UserDeleted::class => 'record',
        \Statamic\Events\Data\UserGroupDeleted::class => 'record',
        \Statamic\Events\Data\UserGroupSaved::class => 'record',
        \Statamic\Events\Data\UserSaved::class => 'record',

        // Laravel Events
        'auth.login' => 'record',
        'auth.logout' => 'record',

        // 3rd-Party Addon Events
        'auditlog.record' => 'record',
    ];

    protected $aliases = [
        'auth.login' => 'UserLogin',
        'auth.logout' => 'UserLogout',
    ];

    public function addToHead()
    {
        return $this->css->tag('audit-log');
    }

    public function addNavItem($nav)
    {
        $item = Nav::item('Audit Log')->route('auditlog.index')->icon('archive');

        $nav->addTo('tools', $item);
    }

    public function record($event)
    {
        $name = array_get($this->aliases, CoreEvent::firing());

        Event::record($event, $name);
    }
}
