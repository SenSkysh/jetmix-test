<?php

namespace App\Modules\User\DTO;

use App\Modules\Base\DTO\BaseDTO;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;


/**
 * @OA\Schema(
 *      title="UserClientDTO",
 *      type="object",
 * )
 * @OA\Property(property="email", type="string"),
 * @OA\Property(property="name", type="string"),
 */
class UserClientDTO extends BaseDTO
{
    public string $email;
    public string $name;
}