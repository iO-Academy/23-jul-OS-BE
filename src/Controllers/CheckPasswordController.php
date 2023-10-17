<?php

namespace CaterpillarOS\Controllers;

use CaterpillarOS\Models\UserModel;
use CaterpillarOS\Validators\PasswordValidator;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CheckPasswordController
{
    private  UserModel $userModel;

    public function __invoke(RequestInterface $request, ResponseInterface $response) {
        $user = $this->userModel->getUserById($request['userId']);
        $responseBody = [
            'passwordMatch' => PasswordValidator::checkPassword($request['enteredPassword'], $user['password'])
            ];
        return $response->withJson($responseBody);
        }
}