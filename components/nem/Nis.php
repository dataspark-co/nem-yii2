<?php

namespace app\components\nem;

use yii\base\BaseObject;
use NEM\SDK;

/**
 * Class Nis
 * @package app\components\nem
 */
class Nis extends BaseObject
{
    public $nisProtocol;
    public $nisUseSSL;
    public $nisHost;
    public $nisPort;
    public $nisEndpoint;

    protected $_api;
    protected $_sdk;

    /**
     * Get Nem Nis API object
     * @return \NEM\API
     */
    public function getApi()
    {
        if($this->_api === null) {
            $this->_api = new Api([
                'protocol' => $this->nisProtocol,
                'use_ssl'  => $this->nisUseSSL,
                'host' 	   => $this->nisHost,
                'port'     => $this->nisPort,
                'endpoint' => $this->nisEndpoint,
            ]);
        }

        return $this->_api;
    }

    /**
     * Get Nem Nis SDK object
     * @return \NEM\SDK
     */
    public function getSdk()
    {
        if($this->_sdk == null) {
            $this->_sdk = new SDK([], $this->getApi());
        }

        return $this->_sdk;
    }
}
