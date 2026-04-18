<?php
declare(strict_types=1);

require_once __DIR__ . '/../Dto/LoginWebRequest.php';
require_once __DIR__ . '/../Dto/UserResponse.php';
require_once __DIR__ . '/../../../../../src/CarreraAcademica/Application/Services/Dto/Commands/LoginCommand.php';
require_once __DIR__ . '/../../../../../src/CarreraAcademica/Domain/Models/UserModel.php';

final class LoginWebMapper
{
    public function fromRequestToCommand(LoginWebRequest $request): LoginCommand
    {
        return new LoginCommand(
            $request->email(),
            $request->password()
        );
    }

    public function fromModelToResponse(UserModel $user): UserResponse
    {
        return new UserResponse(
            $user->id()->value(),
            $user->name()->value(),
            $user->email()->value(),
            $user->role()
        );
    }
}