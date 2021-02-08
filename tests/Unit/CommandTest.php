<?php

namespace Tests\Unit;

use Tests\TestCase;

class CommandTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_import_posts_works()
    {
        $this->artisan('import:posts')
            ->expectsOutput('The posts have been imported successfully')
            ->doesntExpectOutput('The posts have not been imported')
            ->assertExitCode(1);
    }
}
