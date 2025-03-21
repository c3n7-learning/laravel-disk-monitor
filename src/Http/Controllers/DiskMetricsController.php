<?php

namespace Tefabi\DiskMonitor\Http\Controllers;

use Illuminate\Support\Facades\View;
use Tefabi\DiskMonitor\Models\DiskMonitorEntry;

class DiskMetricsController
{
    public function __invoke()
    {
        $entries = DiskMonitorEntry::latest()->get();

        return View::make('disk-monitor::entries', compact('entries'));
    }
}
