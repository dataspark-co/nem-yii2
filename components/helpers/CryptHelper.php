<?php

namespace app\components\helpers;

use Yii;

/**
 * Class CryptHelper
 * @package app\components\helpers\
 */
class CryptHelper
{
    /**
     * Encrypt string
     * @param $string
     * @return string
     */
    public static function encrypt($string)
    {
        return utf8_encode(Yii::$app->getSecurity()->encryptByKey(
            $string,
            self::getKey()
        ));
    }

    /**
     * Decrypt string
     * @param $string
     * @return bool|string
     */
    public static function decrypt($string)
    {
        return Yii::$app->getSecurity()->decryptByKey(
            utf8_decode($string),
            self::getKey()
        );
    }

    /**
     * Return encrypt key
     * @return mixed
     */
    protected static function getKey()
    {
        return Yii::$app->nemSystem->encryptionKey;
    }

    /**
     * @param int $length
     * @return string
     */
    public static function generateRandomKey($length = 64)
    {
        $bytes = openssl_random_pseudo_bytes($length);
        return strtr(substr(base64_encode($bytes), 0, $length), '+/=', '_-.');
    }
}