<?php

it('can display the list of entries', function () {
    /** @var \Tefabi\DiskMonitor\Tests\TestCase $this */
    $this->get('disk-monitor')
        ->assertSee('Disk metrics')
        ->assertOk();
});
