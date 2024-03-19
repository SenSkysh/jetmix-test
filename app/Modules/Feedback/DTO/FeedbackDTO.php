<?php

namespace App\Modules\Feedback\DTO;

use App\Modules\Base\DTO\BaseDTO;

use App\Modules\User\DTO\UserClientDTO;
use Carbon\Carbon;


/**
 * @OA\Schema(
 *      title="FeedbackDTO",
 *      type="object",
 * )
 * @OA\Property(property="id", type="integer"),
 * @OA\Property(property="subject", type="string"),
 * @OA\Property(property="message", type="string"),
 * @OA\Property(property="attachment", type="string"),
 * @OA\Property(property="created_at", type="string"),
 * @OA\Property(property="updated_at", type="string"),
 * @OA\Property(property="client", type="object", ref="#/components/schemas/UserClientDTO"),
 */
class FeedbackDTO extends BaseDto
{    
    public int $id;
    public UserClientDTO $client;
    public string $subject;
    public string $message;
    public ?string $attachment;
    public Carbon $created_at;
    public Carbon $updated_at;
}