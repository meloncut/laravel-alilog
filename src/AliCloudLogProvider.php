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
use Illuminate\Support\Facades\Config;
use Monolog\Logger;

class AliCloudLogProvider extends ServiceProvider
{
    /**
     * The Log levels.
     *
     * @var array
     */
    protected $levels = [
        'debug'     => Logger::DEBUG,
        'info'      => Logger::INFO,
        'notice'    => Logger::NOTICE,
        'warning'   => Logger::WARNING,
        'error'     => Logger::ERROR,
        'critical'  => Logger::CRITICAL,
        'alert'     => Logger::ALERT,
        'emergency' => Logger::EMERGENCY,
    ];

    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    /**
     * register
     *
     * @author <meloncut@outlook.com>
     */
    public function register()
    {
        if (!Config::get('logging.alilog.enable'))
            return ;
        $this->AliLogInit();
        $this->app->configureMonologUsing(function (Logger $monolog) {
            $monolog->pushHandler(
                new AliCloudLogHandler($this->app->get(ALiCloudLogInvoker::class),$this->logLevelTransfer(Config::get('app.log_level','debug')))
            );
        });
    }

    /**
     * register a Ali Cloud Client Invoker
     *
     * @author <meloncut@outlook.com>
     */
    protected function AliLogInit()
    {
        $this->app->singleton(ALiCloudLogInvoker::class, static function () {
            return new ALiCloudLogInvoker();
        });

    }

    /**
     * transfer laravel log level to monolog level
     *
     * @param $level
     * @return int|mixed
     * @author <meloncut@outlook.com>
     */
    protected function logLevelTransfer($level)
    {
        return $this->levels[$level] ?? Logger::INFO;
    }
}