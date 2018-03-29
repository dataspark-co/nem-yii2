<?php

namespace app\components;

use app\components\system\MosaicTransaction;
use yii\base\InvalidValueException;
use app\components\system\BaseSystem;

/**
 * Class NemSystem
 * @package app\components
 */
class NemSystem extends BaseSystem
{
    public $encryptionKey;
    public $network = 'testnet';
    public $privateKey;

    /**
     * Initialize
     */
    public function init()
    {
        parent::init();

        if(empty($this->encryptionKey)){
            throw new InvalidValueException("Encryption key must be set.");
        }

        if(empty($this->privateKey)){
            throw new InvalidValueException("Private key must be set.");
        }
    }

    /**
     * Send mosaic
     * @param $address
     * @return bool
     */
    public function sendMosaicToAddress($address)
    {
        if(empty($address)){
            return false;
        }

        $transaction = new MosaicTransaction([
            'recipientAddress' => $address
        ]);

        $transaction->sendTransaction();

        return true;
    }
}