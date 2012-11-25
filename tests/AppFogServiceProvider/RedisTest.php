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
        $services = '{"redis-2.2":[{"name":"itvp-redis","label":"redis-2.2","plan":"free","tags":["redis","redis-2.2","key-value","nosql","redis-2.2","redis"],"credentials":{"hostname":"10.0.24.83","host":"10.0.24.83","port":5078,"password":"7d0dfe25-3b48-4d73-96a5-c712b7eed871","name":"272d9385-326a-4a4e-9bd6-52740a8b2d85"}}],"mysql-5.1":[{"name":"itvp-db","label":"mysql-5.1","plan":"free","tags":["mysql","mysql-5.1","relational","mysql-5.1","mysql"],"credentials":{"name":"d5a78e1e5cc9142bf865208d1b1158060","hostname":"eu01-user01.cbxizyg0fwcn.eu-west-1.rds.amazonaws.com","host":"eu01-user01.cbxizyg0fwcn.eu-west-1.rds.amazonaws.com","port":3306,"user":"uZPHdaVC1Th9n","username":"uZPHdaVC1Th9n","password":"pP8yA2GGDhVdX"}}]}';
        putenv("VCAP_SERVICES=$services");
        
        $app->register(new AppFogServiceProvider());
        
//         $app['appfog']->get()
        

    }
}
