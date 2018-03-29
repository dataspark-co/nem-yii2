<?php

namespace app\components\system;

use Yii;
use yii\base\BaseObject;
use yii\base\InvalidValueException;
use NEM\Core\KeyPair;
use NEM\Models\Message;
use NEM\Models\Mosaic;
use NEM\Models\MosaicAttachment;
use NEM\Models\Transaction\MosaicTransfer;
use NEM\Models\TimeWindow;


/**
 * Class MosaicTransaction
 * @package app\components\system
 */
class MosaicTransaction extends BaseObject
{
    public $mosaicNamespace = 'yii';
    public $mosaicName = 'registration';
    public $mosaicQty = 1;

    public $message;
    public $recipientAddress;
    public $deadlineTime = 1000;

    /**
     * Initialize
     */
    public function init()
    {
        parent::init();

        if(empty($this->recipientAddress)) {
            throw new InvalidValueException("Recipient address must be set.");
        }
    }

    /**
     * @return \NEM\Models\Model
     */
    public function sendTransaction()
    {
        $nisSdk = Yii::$app->nem->nis->sdk;
        $instance = $nisSdk->transaction();

        return $instance->announce(
            $this->creteMosaicTransfer(),
            $this->getKeyPair()
        );
    }

    /**
     * @return KeyPair
     */
    protected function getKeyPair()
    {
        return new KeyPair(Yii::$app->nemSystem->privateKey);
    }

    /**
     * @return MosaicTransfer
     */
    protected function creteMosaicTransfer()
    {
        $transaction = new MosaicTransfer([
            'version' => Network::getTransactionVersion(Yii::$app->nemSystem->network),
            'recipient' => $this->recipientAddress,
            'deadline' => (new TimeWindow())->toDTO() + $this->deadlineTime,
            'message' => $this->getMessage()
        ]);
        $transaction->attachMosaic($this->createMosaicAttachment());

        return $transaction;
    }

    /**
     * @return mixed
     */
    protected function getMessage()
    {
        $message = new Message([
            'plain' => $this->message,
            'type' => Message::TYPE_SIMPLE
        ]);
        return $message->toDTO();
    }

    /**
     * @return MosaicAttachment
     */
    protected function createMosaicAttachment()
    {
        $mosaic = new Mosaic([
            'namespaceId' => $this->mosaicNamespace,
            'name' => $this->mosaicName
        ]);

        return new MosaicAttachment([
            'mosaicId' => $mosaic->toDTO(),
            'quantity' => $this->mosaicQty
        ]);
    }
}