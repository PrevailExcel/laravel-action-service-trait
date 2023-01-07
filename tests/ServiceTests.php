<?php

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\Concerns\InteractsWithConsole;
use Tests\CreatesApplication;

/**
 * @property \Illuminate\Contracts\Container\Container $app
 */
class ServiceTests extends TestCase
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
    public function test_make_service_command(): void
    {
        $this->artisan('make:service TestService')->assertSuccessful();
    }
    
   /**
     * @return void
     */
    public function test_service_stub_exist(): void
    {
        $this->assertFileExists(__DIR__ . '/../src/Stubs/service.stub');
    }
    
    /**
     * @return void
     */
    public function test_interface_stub_exist(): void
    {
        $this->assertFileExists(__DIR__ . '/../src/Stubs/interface.stub');
    }

    /**
     * @return void
     */
    public function test_service_interface_stub_exist(): void
    {
        $this->assertFileExists(__DIR__ . '/../src/Stubs/service.interface.stub');
    }

}
