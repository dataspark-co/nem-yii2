<?php

namespace app\components\nem;

use yii\base\BaseObject;

/**
 * Class Nis
 * @package app\components\nem
 */
class Ncc extends BaseObject
{
    public $nccProtocol;
    public $nccUseSSL;
    public $nccHost;
    public $nccPort;
    public $nccEndpoint;

    protected $_api;

    /**
     * Get Nem Nis API object
     * @return \NEM\API
     */
    public function getApi()
    {
        if($this->_api === null) {
            $this->_api = new Api([
                'protocol' => $this->nccProtocol,
                'use_ssl'  => $this->nccUseSSL,
                'host' 	   => $this->nccHost,
                'port'     => $this->nccPort,
                'endpoint' => $this->nccEndpoint,
            ]);
        }

        return $this->_api;
    }
}
