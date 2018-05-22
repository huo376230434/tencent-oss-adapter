
# Use tencent-oss-adapter as Laravel Storage

模仿 [aliyun-oss-adapter](https://github.com/aobozhang/aliyun-oss-adapter)阿里云的oss包写了腾讯云的oss



### 腾讯云的OSS sdk: [qcloud/cos-sdk-v5](https://github.com/tencentyun/cos-php-sdk-v5)  


## Usage

```php

use Storage;

//...


## Installation

This package can be installed through Composer.
```bash
composer require aobozhang/aliyun-oss-adapter
```

## Configuration

This service provider must be registered.

```bash
// config/app.php

'providers' => [
    ...,
        Huojunhao\OSS\TencentyunOssFilesystemServiceProvider::class
];
```


add config:

```bash
// config/filesystem.php.

        'tencent_oss' => [
            'driver'     => 'tencent_oss',
            'credentials'=>[
                'appId' => env('QCLOUD_APPID'),//开发者访问 COS 服务时拥有的用户维度唯一资源标识，用以标识资源
                'secretId'    => env('QCLOUD_SECRETID'),//开发者拥有的项目身份识别 ID，用以身份认证
                'secretKey' => env('QCLOUD_SECRETKEY')//开发者拥有的项目身份密钥
            ],
            'region' => env('QCLOUD_REGION'),//地区
            'bucket' => env('QCLOUD_BUCKET'),//COS 中用于存储数据的容器
        ],

```

change default to oss
```bash
'default' => 'tencent_oss';
```





###demo

//   添加

     Storage::put('marss.jpg', file_get_contents(__DIR__."/mars.jpg"));

// 下载

     $contents = Storage::get('marss.jpg');
     file_put_contents(__DIR__ . "/testtencent.jpg", $contents);
     
//    是否存在
     
      $exists   = Storage::exists('marss.jpg');
              dump($exists);

//    大小(单位为B)      
    
        $size     = Storage::size('marss.jpg');
                dump($size);

//     最新更新时间
      
        $time     = Storage::lastModified('marss.jpg');
        dump(date("Y-m-d H:i:s",$time));


//       复制

        Storage::copy('test/marss.jpg', 'new/marss.jpg');
        
 //       移动
 
         Storage::move('marss.jpg', 'new/test/marss.jpg');



目前只实现了这几个功能，其他的比如列表显示等还没有实现















