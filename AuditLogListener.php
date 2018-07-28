<?php

namespace Statamic\Addons\AuditLog;

use Statamic\API\Nav;
use Statamic\API\Str;
use Statamic\Extend\Listener;

use Statamic\Events\Data\AddonSettingsSaved;
use Statamic\Events\Data\AssetContainerDeleted;
use Statamic\Events\Data\AssetContainerSaved;
use Statamic\Events\Data\AssetDeleted;
use Statamic\Events\Data\AssetFolderDeleted;
use Statamic\Events\Data\AssetFolderSaved;
use Statamic\Events\Data\AssetMoved;
use Statamic\Events\Data\AssetReplaced;
use Statamic\Events\Data\AssetUploaded;
use Statamic\Events\Data\CollectionDeleted;
use Statamic\Events\Data\CollectionSaved;
use Statamic\Events\Data\EntryDeleted;
use Statamic\Events\Data\EntrySaved;
use Statamic\Events\Data\FieldsetDeleted;
use Statamic\Events\Data\FieldsetSaved;
use Statamic\Events\Data\FileUploaded;
use Statamic\Events\Data\GlobalsDeleted;
use Statamic\Events\Data\GlobalsSaved;
use Statamic\Events\Data\PageDeleted;
use Statamic\Events\Data\PageMoved;
use Statamic\Events\Data\PageSaved;
use Statamic\Events\Data\PagesMoved;
use Statamic\Events\Data\RoleDeleted;
use Statamic\Events\Data\RoleSaved;
use Statamic\Events\Data\SettingsSaved;
use Statamic\Events\Data\SubmissionDeleted;
use Statamic\Events\Data\SubmissionSaved;
use Statamic\Events\Data\TaxonomyDeleted;
use Statamic\Events\Data\TaxonomySaved;
use Statamic\Events\Data\TermDeleted;
use Statamic\Events\Data\TermSaved;
use Statamic\Events\Data\UserDeleted;
use Statamic\Events\Data\UserGroupDeleted;
use Statamic\Events\Data\UserGroupSaved;
use Statamic\Events\Data\UserSaved;

class AuditLogListener extends Listener
{
    public $events = [
        'cp.add_to_head' => 'addToHead',
        'cp.nav.created' => 'addNavItem',

        // Record Statamic Data Events
        AddonSettingsSaved::class => 'record',
        AssetContainerDeleted::class => 'record',
        AssetContainerSaved::class => 'record',
        AssetDeleted::class => 'record',
        AssetFolderDeleted::class => 'record',
        AssetFolderSaved::class => 'record',
        AssetMoved::class => 'record',
        AssetReplaced::class => 'record',
        AssetUploaded::class => 'record',
        CollectionDeleted::class => 'record',
        CollectionSaved::class => 'record',
        EntryDeleted::class => 'record',
        EntrySaved::class => 'record',
        FieldsetDeleted::class => 'record',
        FieldsetSaved::class => 'record',
        FileUploaded::class => 'record',
        GlobalsDeleted::class => 'record',
        GlobalsSaved::class => 'record',
        PageDeleted::class => 'record',
        PageMoved::class => 'record',
        PageSaved::class => 'record',
        PagesMoved::class => 'record',
        RoleDeleted::class => 'record',
        RoleSaved::class => 'record',
        SettingsSaved::class => 'record',
        SubmissionDeleted::class => 'record',
        SubmissionSaved::class => 'record',
        TaxonomyDeleted::class => 'record',
        TaxonomySaved::class => 'record',
        TermDeleted::class => 'record',
        TermSaved::class => 'record',
        UserDeleted::class => 'record',
        UserGroupDeleted::class => 'record',
        UserGroupSaved::class => 'record',
        UserSaved::class => 'record',

        // Record 3rd-Party Addon Events
        'auditlog.record' => 'record',
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
        Event::record($event);
    }
}
