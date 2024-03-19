<?php

namespace App\Modules\User\DTO;

use App\Modules\Base\DTO\BaseDTO;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *      title="UserPasswordResetDTO",
 *      type="object",
 * )
 * @OA\Property(property="userId", type="integer"),
 * @OA\Property(property="password", type="string"),
 */
class UserPasswordResetDTO extends BaseDTO
{
    public int $userId;
    #[Min(8)]
    public string $password;
}