<?php

use Illuminate\Support\Facades\DB;

test('the application uses sqlite in memory for testing', function () {
    expect(DB::connection()->getDriverName())->toBe('sqlite');
});
