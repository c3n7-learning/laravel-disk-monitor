<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Tefabi\DiskMonitor\Tests\TestCase;

uses(TestCase::class)
    ->beforeEach(function () {
        Storage::fake('local');
        Storage::fake('anotherDisk');

        Route::diskMonitor('disk-monitor');
    })
    ->in(__DIR__);
