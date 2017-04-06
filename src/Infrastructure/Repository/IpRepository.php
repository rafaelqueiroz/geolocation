<?php
namespace Geolocation\Infrastructure\Repository;

use Geolocation\Domain\Repository\GeolocationRepository;

/**
 * @author Rafael Queiroz <rafaelfqf@gmail.com>
 */
class IpRepository implements GeolocationRepository
{
    /**
     * @var Connection
     */
    protected $conn;

    /**
     * IpRepository constructor.
     * @param Connection $db
     */
    public function __construct(\Doctrine\DBAL\Connection $conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param $ip
     * @return array
     */
    public function findByIp($ip)
    {
        return $this->conn->fetchAssoc("SELECT * FROM ips WHERE ip = ?", [$ip]);
    }

    /**
     * @param $data
     * @return bool
     */
    public function storage($data)
    {
        return $this->conn->insert("ips", $data);
    }

}