# laravel-alilog
ali cloud log service for laravel framework 


## quick start

    composer require meloncut/laravel-ali-log "dev-master"

## provider register    
    add a row to config/app.php
    'providers' => [
            ... //other providers
            Meloncut\AliLog\AliCloudLogProvider::class
    ],
    
## Log config set

    add the following to config/logging.php
    
    'alilog' => [
        'endpoint' => 'xxxxxx',  //Ali Log endpoint
        'access_key_id' => 'xxxxx', //Ali AccessKeyId
        'access_key' => 'xxxxx', //Ali AccessKey
        'project' => 'xxxx', //Log project
        'log_store' => 'xxxxx', //Log store
        'topic' => 'xxxx' //not necessary
        'resource' => 'xxxx' // not necessary
    ]
    
    for details
[ Ali Cloud Log ocument]( https://help.aliyun.com/document_detail/54604.html?spm=a2c4g.11186623.6.574.217555e7Jj1PFD )    


## Log level

    use laravel Log Level
  
    for details config/app.php 'log_level'