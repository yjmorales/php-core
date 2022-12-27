<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\DataStorage\Redis;

use Predis\Client as Redis;
use Exception;
use InvalidArgumentException;

/**
 * Manages redis io
 */
class RedisCacheRegistry
{
    /**
     * Redis connection.
     *
     * @var Redis|null
     */
    private ?Redis $conn = null;

    /**
     * Key prefix of the cache.
     *
     * @var string
     */
    private string $keyPrefix;

    /**
     * Redis server host.
     *
     * @var string
     */
    private string $host;

    /**
     * Redis server port.
     *
     * @var int
     */
    private int $port;

    /**
     * Redis server password.
     *
     * @var string|null
     */
    private ?string $password;

    /**
     * RedisCacheRegistry constructor.
     *
     * @param string      $host
     * @param int         $port
     * @param string      $keyPrefix
     * @param string|null $password
     */
    public function __construct(string $host, string $keyPrefix, ?string $password, int $port)
    {
        if (!$host) {
            throw new InvalidArgumentException('Redis Host cannot be empty.');
        }
        $this->host      = $host;
        $this->port      = $port;
        $this->keyPrefix = $keyPrefix;
        $this->password  = $password;
    }

    /**
     * Creates the Redis connection.
     *
     * @throws Exception
     */
    private function _connect()
    {
        if (!$this->conn) {
            try {
                $redis = new Redis([
                    "scheme"   => "tcp",
                    "host"     => $this->host,
                    "port"     => $this->port,
                    "password" => $this->password
                ]);
                $redis->connect();
                $this->conn = $redis;
            } catch (Exception $e) {
                throw new Exception('Unable to connect Redis server');
            }
        }
    }

    /**
     * Gets the value from cache.
     *
     * @param string $key
     * @param null   $found
     *
     * @return mixed|false
     *
     * @throws Exception
     */
    public function get(string $key, &$found = null)
    {
        $this->_connect();

        try {
            $value = $this->conn->get($this->_buildKey($key));
        } catch (Exception $e) {
            return ($found = false);
        }

        $found = false !== $value;

        return unserialize($value);
    }

    /**
     * Remove all items from cache based on its key.
     *
     * @param string $key
     *
     * @return bool
     * @throws Exception
     */
    public function purge(string $key): bool
    {
        $this->_connect();

        try {
            $this->conn->del($this->_buildKey($key));

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Sets the value on the cache.
     *
     * @param string $key
     * @param        $value
     * @param int    $ttl
     *
     * @return bool
     * @throws Exception
     */
    public function set(string $key, $value, int $ttl): bool
    {
        $this->_connect();

        try {
            return (bool)$this->conn->setex($this->_buildKey($key), $ttl, serialize($value));
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Helper function to build the key under the data are stored.
     *
     * @param string $key
     *
     * @return string
     */
    private function _buildKey(string $key): string
    {
        return $this->keyPrefix . $key;
    }
}
