<?php
namespace AppFogServiceProvider\Tests;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\EventDispatcher\Event;
use AppFogServiceProvider\AppFogServiceProvider;

class RedisTest extends \PHPUnit_Framework_TestCase
{
    public function testRedis()
    {
        $app = new Application();
        $services = '{"redis-2.2":[{"name":"itvp-redis","label":"redis-2.2","plan":"free","tags":["redis","redis-2.2","key-value","nosql","redis-2.2","redis"],"credentials":{"hostname":"10.0.24.83","host":"10.0.24.83","port":5078,"password":"test123","name":"test123"}}],"mysql-5.1":[{"name":"itvp-db","label":"mysql-5.1","plan":"free","tags":["mysql","mysql-5.1","relational","mysql-5.1","mysql"],"credentials":{"name":"test123","hostname":"eu01-user01.test123.eu-west-1.rds.amazonaws.com","host":"eu01-test.eu-west-1.rds.amazonaws.com","port":3306,"user":"test123","username":"test123","password":"test123"}}]}';
        putenv("VCAP_SERVICES=$services");

        $app->register(new AppFogServiceProvider());

        $this->assertTrue(is_array($app['appfog']['redis-2.2']));

        foreach ($app['appfog']['redis-2.2'] as $redisInstance) {
            $this->assertEquals($redisInstance['name'],'itvp-redis');
            $this->assertEquals($redisInstance['credentials']['hostname'], '10.0.24.83');
            $this->assertEquals($redisInstance['credentials']['host'], '10.0.24.83');
            $this->assertEquals($redisInstance['credentials']['port'], '5078');
            $this->assertEquals($redisInstance['credentials']['password'], 'test123');
            $this->assertEquals($redisInstance['credentials']['name'], 'test123');
        }

    }
    public function testPredis() {
        //$this->assertEquals($redisInstance['name'],'itvp-redis');
    }
}
