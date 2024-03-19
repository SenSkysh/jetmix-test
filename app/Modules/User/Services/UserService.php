<?php

namespace App\Modules\User\Services;


use App\Modules\Base\DTO\PaginateParamsDTO;
use App\Modules\User\DTO\UserPasswordResetDTO;
use App\Modules\User\DTO\UserRegisterDTO;
use App\Modules\User\DTO\UserTokenDTO;
use App\Modules\User\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function __construct(
    ) {
    }

    public function getManagers()
    {
        $managers = User::query()->where('role', 'manager')->get();
        return $managers;
    }

    public function registerUser(UserRegisterDTO $dto): User
    {
        $user = new User([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
            'role' => 'client',
        ]);
        $user->saveOrFail();
        return $user;
    }

    

    public function resetPassword(UserPasswordResetDTO $dto): void
    {
        $user = User::findOrFail($dto->userId);
        $user->password = $dto->password;
        $user->saveOrFail();
    }

    public function getToken(UserTokenDTO $dto): string
    {
      
          $user = User::where('email', $dto->email)->first();
      
          if (!$user || !Hash::check($dto->password, $user->password)) {
            throw ValidationException::withMessages([
              'email' => ['The provided credentials are incorrect.'],
            ]);
          }
      
          $token = $user->createToken($dto->device_name)->plainTextToken;
      
          return $token;
    }

}