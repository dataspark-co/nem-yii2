<?php

namespace app\components\system;

use NEM\Infrastructure\Network AS NemNetwork;
use NEM\Models\Transaction;

/**
 * Class Network
 * @package app\components\system
 */
class Network extends NemNetwork
{
    /**
     * Networks names list
     * @return array
     */
    protected static function netNamesList()
    {
        return array_keys(self::$networkInfos);
    }

    /**
     * Validate network name
     * @param $networkName
     * @return bool
     */
    public static function validateNetName($networkName)
    {
        return in_array($networkName, self::netNamesList());
    }

    /**
     * Get network id
     * @param $networkName
     * @return bool|mixed
     */
    public static function getNetworkId($networkName)
    {
        if(!self::validateNetName($networkName)) {
            return false;
        }

        $valuesList = self::$networkInfos;

        return isset($valuesList[$networkName]) ?
            $valuesList[$networkName]['id'] :
            false;
    }

    /**
     * @param $networkName
     * @return bool|mixed
     */
    public static function getTransactionVersion($networkName)
    {
        if(!self::validateNetName($networkName)) {
            return Transaction::VERSION_2_TEST;
        }

        $list = [
            "mainnet" => Transaction::VERSION_2,
            "testnet" => Transaction::VERSION_2_TEST,
            "mijin"   => Transaction::VERSION_2_MIJIN,
        ];

        return isset($list[$networkName]) ?
            $list[$networkName] :
            Transaction::VERSION_2_TEST;
    }
}