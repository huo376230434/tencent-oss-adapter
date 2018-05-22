<?php

namespace Huojunhao\OSS;

use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Qcloud\Cos\Client;
class TencentyunOssFilesystemServiceProvider extends ServiceProvider {

    public function boot()
    {
        Storage::extend('tencent_oss', function($app, $config)
        {
            dump($config);
            $client = new Client([
                'region' => $config['region'],
                'credentials'=>$config['credentials']
            ]);
            #分块上传
//            try {
//                $result = $cosClient->upload(
//                //bucket的命名规则为{name}-{appid} ，此处填写的存储桶名称必须为此格式
//                    $bucket= config('qcloud.Bucket'),
//                    $key = $this->name,
//                    $body=fopen($this->path.$this->name,'r+'));
//                echo 'upload_success';
//                info('upload_success上传成功'.serialize($result));
//            } catch (\Exception $e) {
//                echo $e->getMessage();
//                logger('upload_error上传失败'.$e->getMessage());
//            }



            $adapter = new TencentyunOssAdapter($client, $config['bucket']);

            return new Filesystem($adapter);

        });

    }

    public function register()
    {
        //
    }

}
