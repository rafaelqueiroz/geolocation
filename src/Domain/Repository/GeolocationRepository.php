<?php
namespace Geolocation\Domain\Repository;

/**
 * @author Rafael Queiroz <rafaelfqf@gmail.com>
 */
interface GeolocationRepository
{

    /**
     * @param $ip
     * @return mixed
     */
    public function findByIp($ip);

    /**
     * @param $data
     * @return mixed
     */
    public function storage($data);

}