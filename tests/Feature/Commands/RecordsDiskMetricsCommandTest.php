<?php

use Illuminate\Support\Facades\Storage;
use Tefabi\DiskMonitor\Commands\RecordDiskMetricsCommand;
use Tefabi\DiskMonitor\Models\DiskMonitorEntry;

it("will record the file count for a single disk", function () {
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

it("will record the file count for multiple disks", function () {
    config()->set('disk-monitor.disk_names', ['local', 'anotherDisk']);
    Storage::disk('anotherDisk')->put('test.txt', 'test');

    /** @var \Tefabi\DiskMonitor\Tests\TestCase $this */
    $this->artisan(RecordDiskMetricsCommand::class)->assertExitCode(0);

    $entries = DiskMonitorEntry::get();
    $this->assertCount(2, $entries);

    expect($entries[0]->disk_name)->toEqual('local');
    expect($entries[0]->file_count)->toEqual(0);

    expect($entries[1]->disk_name)->toEqual('anotherDisk');
    expect($entries[1]->file_count)->toEqual(1);
});
