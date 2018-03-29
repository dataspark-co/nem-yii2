<?php

namespace app\components\nem;

use NEM\API AS NemAPI;
use yii\helpers\Json;

/**
 * Class Api
 * @package app\components\nem\
 */
class Api extends NemAPI
{
    /**
     * @param $uri
     * @param array $params
     * @param array $data
     * @param array $options
     * @param bool $usePromises
     * @return object
     */
    public function getData($uri, array $params = [], array $data = [], array $options = [], $usePromises = false)
    {
        if(empty($data)) {
            $data = '';
        } else {
            $data = Json::encode($data);
        }

        $uri = self::getPath($uri, $params);

        $response = $this->getJSON($uri, $data, $options, $usePromises);

        return (is_string($response)) ?
            Json::decode($response, true) :
            $response;
    }

    /**
     * @param $uri
     * @param array $params
     * @param array $data
     * @param array $options
     * @param bool $usePromises
     * @return object
     */
    public function sendData($uri, array $params = [], array $data = [], array $options = [], $usePromises = false)
    {
        if(empty($data)) {
            $data = '';
        } else {
            $data = Json::encode($data);
        }

        $uri = self::getPath($uri, $params);

        $response = $this->postJSON($uri, $data, $options, $usePromises);

        return (is_string($response)) ?
            Json::decode($response, true) :
            $response;
    }

    /**
     * @param $uri
     * @param array $data
     * @param array $options
     * @param bool $usePromises
     * @return mixed
     */
    public function post($uri, array $data = [], array $options = [], $usePromises = false)
    {
        return $this->postJSON($uri, $data, $options, $usePromises);
    }

    /**
     * @param $uri
     * @param array $data
     * @param array $options
     * @param bool $usePromises
     * @return mixed
     */
    public function get($uri, array $data = [], array $options = [], $usePromises = false)
    {
        return $this->getJSON($uri, $data, $options, $usePromises);
    }

    /**
     * @param $uri
     * @param array $params
     * @return string
     */
    protected static function getPath($uri, array $params = [])
    {
        $cleanUri = trim($uri, "/ ");

        if (empty($params)) {
            return $cleanUri;
        }

        // build HTTP query for GET request
        $query = http_build_query($params);
        return sprintf("%s?%s", $cleanUri, $query);
    }
}
