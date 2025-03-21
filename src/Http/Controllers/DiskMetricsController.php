<?php

namespace Tefabi\DiskMonitor\Http\Controllers;

use Tefabi\DiskMonitor\Models\DiskMonitorEntry;

class DiskMetricsController
{
    public function __invoke()
    {
        $entries = DiskMonitorEntry::latest()->get();

        return view('disk-monitor::entries', compact('entries'));
    }
}
