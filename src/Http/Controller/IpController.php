<?php
namespace Geolocation\Http\Controller;

use Silex\Application;
use Geolocation\Domain\Repository\GeolocationRepository;

/**
 * @author Rafael Queiroz <rafaelfqf@gmail.com>
 */
class IpController
{

    protected $repository;

    public function __construct(GeolocationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Application $app
     * @return mixed
     */
    public function indexAction(Application $app)
    {
        return $app['twig']->render('index.twig', [
            'ip' => $app['request_stack']->getCurrentRequest()->getClientIp()
        ]);
    }

    /**
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function ipAction(Application $app)
    {
        $ip = $app['repository']->findByIp($app['request_stack']->getCurrentRequest()->getClientIp());
        if (!$ip) {
            $ip = $this->getInfo();
            $app['repository']->storage($ip);
        }

        return $app->json($ip);
    }

    /**
     * @return array
     */
    protected function getInfo()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://ipinfo.io'
        ));
        $request = json_decode(curl_exec($curl));

        return [
            'ip' => $request->ip,
            'country' => $request->country,
            'city' => $request->city
        ];
    }

}