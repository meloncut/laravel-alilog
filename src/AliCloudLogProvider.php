<?php
/**
 * Created by PhpStorm.
 * User: dizzylee
 * Date: 2019/10/17
 * Time: 3:42 PM
 */

namespace Meloncut\AliLog;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AliCloudLogProvider extends ServiceProvider
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    public function register()
    {
        $this->app->bind('alilog',AliCloudLogHandler::class);
        $this->AliLogInit();
    }

    protected function AliLogInit()
    {
        $this->app->singleton(ALiCloudLogInvoker::class, static function () {
            return new ALiCloudLogInvoker();
        });

    }
}