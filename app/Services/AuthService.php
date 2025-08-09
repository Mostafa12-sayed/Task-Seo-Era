<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function register(array $data): array
    {
        $user = $this->userRepository->create($data);
        $tokenResult = $user->createToken('Personal Access Token', $user->getTokenScopes());

        return [
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $tokenResult->token->expires_at->toDateTimeString()
        ];
    }

    public function login(string $identifier, string $password): ?array
    {
        $user = $this->userRepository->findByEmail($identifier)
            ?? $this->userRepository->findByMobile($identifier);

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }

        if (!$user->is_active) {
            throw new \Exception('Account is deactivated');
        }
        $user->tokens()->delete();

        $tokenResult = $user->createToken('Personal Access Token', $user->getTokenScopes());

        return [
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $tokenResult->token->expires_at->toDateTimeString()
        ];
    }

    public function logout(User $user): void
    {
        $user->token()->revoke();
    }

}
