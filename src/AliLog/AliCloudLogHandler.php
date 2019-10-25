<?php
/**
 * Created by PhpStorm.
 * User: dizzylee
 * Date: 2019/10/17
 * Time: 3:03 PM
 */

namespace Meloncut\AliLog;

use AliLog\ALiCloudLogInvoker;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class AliCloudLogHandler extends AbstractProcessingHandler
{
    protected $invoker;

    public function __construct(ALiCloudLogInvoker $invoker,\int $level = Logger::DEBUG, bool $bubble = true)
    {
        $this->invoker = $invoker;
        parent::__construct($level, $bubble);
    }

    protected function write(array $record)
    {
        $this->invoker->sendLog($record);
    }
}