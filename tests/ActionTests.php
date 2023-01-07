<?php

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithConsole;
use Tests\CreatesApplication;

/**
 * @property \Illuminate\Contracts\Container\Container $app
 */
class ActionTests extends TestCase
{
    use CreatesApplication, InteractsWithConsole;

    protected $app;

    public function setUp(): void
    {
        parent::setUp();
        $this->app = require __DIR__ . '/../../bootstrap/app.php';
    }

    /**
     * @return void
     */
    public function test_make_action_command(): void
    {
        $this->artisan('make:action TestAction')->assertSuccessful();
    }

    /**
     * @return void
     */
    public function test_action_stub_exist(): void
    {
        $this->assertFileExists(__DIR__ . '/../src/Stubs/action.stub');
    }

}