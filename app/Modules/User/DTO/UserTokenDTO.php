<?php

namespace App\Modules\User\DTO;

use App\Modules\Base\DTO\BaseDTO;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;


/**
 * @OA\Schema(
 *      title="UserTokenDTO",
 *      type="object",
 *      required={"device_name", "email", "password"}
 * )
 * @OA\Property(property="email", type="string"),
 * @OA\Property(property="password", type="string"),
 * @OA\Property(property="device_name", type="string"),
 */
class UserTokenDTO extends BaseDTO
{
    public string $device_name;
    #[Email]
    public string $email;
    public string $password;
}