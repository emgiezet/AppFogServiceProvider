<?php
namespace AppFogServiceProvider;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Silex\SilexEvents;
use Symfony\Component\ClassLoader\MapFileClassLoader;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
/**
 * 
 * @author emgiezet
 *
 */
class AppFogServiceProvider implements ServiceProviderInterface
{
    private $appFogServices = array();
    /**
     * 
     * @param Application $app
     */
    public function register(Application $app)
    {
        $services = getenv("VCAP_SERVICES");
        $app['appfog'] = $this->prepareServices($services);
    }
    /**
     * 
     * @param Application $app
     */
    public function boot(Application $app)
    {

    }
    /**
     * 
     * @param string $services
     */
    protected function prepareServices($services)
    {
        $appFogServices = json_decode($services,true);
        if(!is_array($appFogServices))
        {
            return array();
        }
        else
        {
            foreach($appFogServices as $service => $params)
            {
                $this->appFogServices[$service] = $params;
            }
        }
    }
    
    public function getCredentials($service, $name)
    {
        return $this->appFogServices[$service];
    }
}
