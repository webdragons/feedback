<?php

namespace bulldozer\feedback\common\enums;

use yii2mod\enum\helpers\BaseEnum;

/**
 * Class FeedbackStatusEnum
 * @package bulldozer\feedback\common\enums
 */
class FeedbackStatusEnum extends BaseEnum
{
    const STATUS_NEW = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELED = 4;

    /**
     * @var array
     */
    public static $list = [
        self::STATUS_NEW => 'Новый',
        self::STATUS_IN_PROGRESS => 'В работе',
        self::STATUS_COMPLETED => 'Завершен',
        self::STATUS_CANCELED => 'Отменен',
    ];
}