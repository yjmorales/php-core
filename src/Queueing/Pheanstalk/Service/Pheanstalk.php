<?php
/**
 * @author Yenier Jimenez <yjmorales86@gmail.com>
 */

namespace App\Queueing\Pheanstalk\Service;

use Pheanstalk\Pheanstalk as BasePheanstalk;

/**
 *  Service holding the PHP pheanstalk client
 *
 * @package App\Queueing\Pheanstalk\Service
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