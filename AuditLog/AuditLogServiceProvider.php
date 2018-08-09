<?php

namespace Statamic\Addons\AuditLog;

use Statamic\API\Str;
use Statamic\Extend\ServiceProvider;

class AuditLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('audit_log_action_path', '/cp/addons/'.Str::studlyToSlug($this->getAddonName()));
    }
}
