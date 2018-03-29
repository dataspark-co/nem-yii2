<?php

namespace app\components\system;

use yii\base\BaseObject;
use yii\base\InvalidValueException;

/**
 * Class BaseSystem
 * @package app\components\system
 */
abstract class BaseSystem extends BaseObject
{
    public $network;

    /**
     * Initialize
     */
    public function init()
    {
        if (!Network::validateNetName($this->network)) {
            throw new InvalidValueException("Param 'network' has invalid value.");
        }

        parent::init();
    }
}