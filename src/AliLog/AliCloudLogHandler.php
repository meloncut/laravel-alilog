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

    const ALI_LOG_HANDLE_SYNC = 'sync';

    const ALI_LOG_HANDLE_ASYNC = 'async';

    public function __construct(ALiCloudLogInvoker $invoker,\Aliyun_Log_Models_PutLogsRequest $request,\int $level = Logger::DEBUG, bool $bubble = true)
    {
        $this->invoker = $invoker;
        parent::__construct($level, $bubble);
    }

    protected function write(array $record)
    {
        if (env('ALI_LOG_DRIVE' == self::ALI_LOG_HANDLE_ASYNC)) {
            $this->syncLog($record);
        }

        $this->syncLog($record);
    }

    /**
     * send log to ali cloud server directly
     *
     * @param array $record
     * @author <meloncut@outlook.com>
     */
    protected function syncLog(array $record)
    {
        $this->invoker->sendLog($record);
    }

    /**
     * send async log to queue
     *
     * @param array $record
     * @author <meloncut@outlook.com>
     */
    protected function asyncLog(array $record)
    {

    }

    /**
     * create a ali log item
     *
     * @param array $record
     * @return \Aliyun_Log_Models_LogItem
     * @author <meloncut@outlook.com>
     */
    protected function packageItem(array $record)
    {
       return new \Aliyun_Log_Models_LogItem(null, $record);
    }


}