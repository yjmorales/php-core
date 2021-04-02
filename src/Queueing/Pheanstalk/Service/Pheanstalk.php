<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace Common\Queueing\Pheanstalk\Service;

use Pheanstalk\Pheanstalk as BasePheanstalk;

/**
 *  Service holding the PHP pheanstalk client
 *
 * @package Common\Queueing\Pheanstalk\Service
 */
class Pheanstalk
{
    /**
     * @var BasePheanstalk
     */
    private $_connection;

    /**
     * Pheanstalk constructor.
     *
     * @param string $host
     */
    public function __construct(string $host)
    {
        $this->_connection = BasePheanstalk::create($host);
    }

    /**
     * @return BasePheanstalk
     */
    public function connection(): BasePheanstalk
    {
        return $this->_connection;
    }
}