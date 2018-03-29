<?php

namespace NEM\Mosaics\Yii;

use NEM\Models\MosaicDefinition;
use NEM\Models\MosaicProperties;
use NEM\Models\MosaicProperty;
use NEM\Models\MosaicLevy;
use NEM\Models\Mosaic;

/**
 * Class Registration
 * @package NEM\Mosaics\Yii
 */
class Registration extends MosaicDefinition
{
    /**
     * The `yii:registration` Total Coins Supply
     * 
     * @var integer
     */
    const TOTAL_SUPPLY = 10000000;

    /**
     * The `yii:registration` mosaics creator public key
     * in hexadecimal format.
     * 
     * @var string
     */
    public $creator = "2c1deda9ba6cfef0f994f076dc0f963db87df43057aad4855b66016bc2d5eee2";

    public $description = "Registration bonus";

    /**
     * Overload of the getTotalSupply() method for fast
     * tracking with preconfigured mosaics.
     * 
     * @return integer
     */
    public function getTotalSupply()
    {
        return self::TOTAL_SUPPLY;
    }

    /**
     * Mutator for `mosaic` relation.
     *
     * This will return a NIS compliant [MosaicId](https://bob.nem.ninja/docs/#mosaicId) object. 
     *
     * @param   array   $mosaidId       Array should contain offsets `namespaceId` and `name`.
     * @return  \NEM\Models\Mosaic
     */
    public function id(array $mosaicId = null)
    {
        return new Mosaic($mosaicId ?: ["namespaceId" => "yii", "name" => "registration"]);
    }

    /**
     * Mutator for `levy` relation.
     *
     * This will return a NIS compliant [MosaicLevy](https://bob.nem.ninja/docs/#mosaicLevy) object. 
     *
     * @param   array   $mosaidId       Array should contain offsets `type`, `recipient`, `mosaicId` and `fee`.
     * @return  \NEM\Models\MosaicLevy
     */
    public function levy(array $levy = null)
    {
        $data = $levy ?: [];
        return new MosaicLevy($data);
    }

    /**
     * Mutator for `properties` relation.
     *
     * This will return a NIS compliant collection of [MosaicProperties](https://bob.nem.ninja/docs/#mosaicProperties) object. 
     *
     * @param   array   $properties       Array of MosaicProperty instances
     * @return  \NEM\Models\MosaicProperties
     */
    public function properties(array $properties = null)
    {
        $data = $properties ?: [
            new MosaicProperty(["name" => "divisibility", "value" => 0]),
            new MosaicProperty(["name" => "initialSupply", "value" => 1]),
            new MosaicProperty(["name" => "supplyMutable", "value" => false]),
            new MosaicProperty(["name" => "transferable", "value" => true]),
        ];

        return new MosaicProperties($data);
    }
}
