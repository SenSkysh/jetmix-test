<?php

namespace App\Modules\User\DTO;

use App\Modules\Base\DTO\BaseDTO;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *      title="UserRegisterDTO",
 *      type="object",
 * )
 * @OA\Property(property="email", type="string"),
 * @OA\Property(property="name", type="string"),
 * @OA\Property(property="password", type="string"),
 */
class UserRegisterDTO extends BaseDTO
{
    public string $name;
    #[Email]
    public string $email;
    #[Min(8)]
    public string $password;
}