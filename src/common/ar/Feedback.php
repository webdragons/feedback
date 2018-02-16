<?php

namespace bulldozer\feedback\common\ar;

use bulldozer\db\ActiveRecord;
use bulldozer\feedback\common\enums\FeedbackStatusEnum;
use bulldozer\feedback\common\traits\UsersRelationsTrait;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * Class Banner
 * @package bulldozer\feedback\common\ar
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $creator_id
 * @property integer $updater_id
 * @property string $name
 * @property string $email
 * @property integer $phone
 * @property string $comment
 * @property integer $status
 *
 * @property-read string $statusName
 */
class Feedback extends ActiveRecord
{
    use UsersRelationsTrait;

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'creator_id',
                'updatedByAttribute' => 'updater_id',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%feedback}}';
    }

    /**
     * @return null|string
     */
    public function getStatusName(): ?string
    {
        return FeedbackStatusEnum::getLabel($this->status);
    }
}