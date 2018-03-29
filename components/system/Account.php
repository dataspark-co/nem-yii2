<?php

namespace app\components\system;

use Yii;
use yii\base\BaseObject;
use NEM\Core\KeyPair;
use NEM\Models\Address;
use app\components\helpers\CryptHelper;

/**
 * Class Account
 * @package app\components\system
 */
class Account extends BaseObject
{
    protected $address;
    protected $privateKey;
    protected $publicKey;
    protected $model;

    /**
     * Account address
     * @return string|null
     */
    public function getAddress()
    {
        $address = preg_replace('/-/', '', $this->address);
        return strtolower($address);
    }

    /**
     * Account encrypted private key
     * @return string|null
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * Account public key
     * @return string|null
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        if(empty($this->model)){
            $this->generate();
        }

        return $this->model;
    }

    /**
     * Generate new account
     */
    public function generate()
    {
        $keypair = new KeyPair();
        $nisSdk = Yii::$app->nem->nis->sdk;

        $this->publicKey = $keypair->getPublicKey('hex');
        $this->privateKey = CryptHelper::encrypt($keypair->getPrivateKey('hex'));
        $this->address = $keypair->getAddress(Network::getNetworkId(Yii::$app->nemSystem->network));

        $service = $nisSdk->account();
        $this->model = $service->createAccountModel([
            'privateKey' => $this->privateKey,
            'address' => $this->address,
            'publicKey' => $this->publicKey
        ]);
    }

    /**
     * Format address
     * @param $address
     * @return string
     */
    public static function formatAddress($address)
    {
        $address = strtoupper($address);
        return wordwrap($address, 6, '-', true);
    }

    /**
     * Normalize address string
     * @param $address
     * @return string
     */
    public static function normalizeAddress($address)
    {
        $address = preg_replace('/-/', '', $address);
        return strtolower($address);
    }
}