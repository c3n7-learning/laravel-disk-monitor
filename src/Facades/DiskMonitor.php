<?php

namespace Tefabi\DiskMonitor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tefabi\DiskMonitor\DiskMonitor
 */
class DiskMonitor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Tefabi\DiskMonitor\DiskMonitor::class;
    }
}
