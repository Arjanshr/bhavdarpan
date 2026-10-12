<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $status
 */
class ContactMessage extends Model
{
    public const STATUS_NEW = 'new';

    public const STATUS_SEEN = 'seen';

    public const STATUS_REPLIED = 'replied';

    /**
     * @var list<string>
     */
    public const STATUSES = [
        self::STATUS_NEW,
        self::STATUS_SEEN,
        self::STATUS_REPLIED,
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'message',
        'status',
    ];
}
