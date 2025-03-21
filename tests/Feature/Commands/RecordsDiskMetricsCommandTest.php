<?php

use Illuminate\Support\Facades\Storage;
use Tefabi\DiskMonitor\Commands\RecordDiskMetricsCommand;
use Tefabi\DiskMonitor\Models\DiskMonitorEntry;

it('will record the file count for a disks', function () {
    /** @var \Tefabi\DiskMonitor\Tests\TestCase $this */
    $this->artisan(RecordDiskMetricsCommand::class)->assertExitCode(0);
    $entry = DiskMonitorEntry::last();
    expect($entry->file_count)->toEqual(0);

    Storage::disk('local')->put('test.txt', 'test');
    Storage::disk('local')->put('test2.txt', 'test');
    $this->artisan(RecordDiskMetricsCommand::class)->assertExitCode(0);
    $entry = DiskMonitorEntry::last();
    expect($entry->file_count)->toEqual(2);
});
