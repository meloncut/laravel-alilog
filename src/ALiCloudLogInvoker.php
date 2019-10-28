<?php
/**
 * Created by PhpStorm.
 * User: dizzylee
 * Date: 2019/10/18
 * Time: 4:23 PM
 */

namespace Meloncut\AliLog;

use Illuminate\Support\Facades\Config;

require_once(__DIR__ . '/../packages/aliyun-log-php-sdk/Log_Autoload.php');

class ALiCloudLogInvoker
{
    protected $ali_log_client;

    protected $put_log_request;

    public function __construct()
    {
        $this->ali_log_client = new \Aliyun_Log_Client(
            Config::get('logging.alilog.endpoint'),
            Config::get('logging.alilog.access_key_id'),
            Config::get('logging.alilog.access_key'),
            Config::get('logging.alilog.token','')
        );

        $this->put_log_request = new \Aliyun_Log_Models_PutLogsRequest(
            Config::get('logging.alilog.project'),
            Config::get('logging.alilog.log_store'),
            Config::get('logging.alilog.topic', null),
            Config::get('logging.alilog.resource', null)
        );
    }

    public function sendLog(array $record)
    {
        try{
            $this->put_log_request->setLogItems([new \Aliyun_Log_Models_LogItem(null,$record)]);
            $this->ali_log_client->putLogs($this->put_log_request);
        } catch (\Aliyun_Log_Exception $e) {
            #TODO DO NOTHING NOW
        }
    }
}