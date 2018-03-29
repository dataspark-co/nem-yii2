<?php

namespace app\components;

use yii\base\BaseObject;
use app\components\nem\Ncc;
use app\components\nem\Nis;

/**
 * Class Nem
 * @package app\components
 */
class Nem extends BaseObject
{
    public $protocol = 'http';
    public $useSSL = false;
    public $host = '127.0.0.1';

    public $nisPort = 7890;
    public $nisEndpoint = '/';

    public $nccPort = 8989;
    public $nccEndpoint = '/ncc/api/';

    protected $_nis;
    protected $_ncc;


    /**
     * @return mixed|null
     */
    public function getNis()
    {
        if($this->_nis === null) {
            $this->_nis = new Nis([
                'nisProtocol' => $this->protocol,
                'nisUseSSL' => $this->useSSL,
                'nisHost' => $this->host,
                'nisPort' => $this->nisPort,
                'nisEndpoint' => $this->nisEndpoint,
            ]);
        }

        return $this->_nis;
    }

    /**
     * @return mixed|null
     */
    public function getNcc()
    {
        if($this->_ncc === null) {
            $this->_ncc = new Ncc([
                'nccProtocol' => $this->protocol,
                'nccUseSSL' => $this->useSSL,
                'nccHost' => $this->host,
                'nccPort' => $this->nccPort,
                'nccEndpoint' => $this->nccEndpoint,
            ]);
        }

        return $this->_ncc;
    }
}
