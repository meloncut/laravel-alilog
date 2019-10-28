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
use Monolog\Logger;

class AliCloudLogProvider extends ServiceProvider
{
    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    public function register()
    {
        $this->app->configureMonologUsing(function (Logger $monolog) {
            $monolog->pushHandler(
                new AliCloudLogHandler($this->app->get(ALiCloudLogInvoker::class),Logger::DEBUG)
            );
        });
        $this->AliLogInit();
    }

    protected function AliLogInit()
    {
        $this->app->singleton(ALiCloudLogInvoker::class, static function () {
            return new ALiCloudLogInvoker();
        });

    }
}