<?php

namespace CaterpillarOS\Controllers;

use CaterpillarOS\Models\UserModel;
use CaterpillarOS\Validators\PasswordValidator;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CheckPasswordController
{
    private  UserModel $userModel;

    /**
     * @param UserModel $userModel
     */
    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response) {
        $data = $request->getParsedBody();
        $user = $this->userModel->getUserById($data['user']);
        if(!$user) {
            $responseBody = [
                'success' => false,
                'message' => "User not found",
                'data' => []
            ];
            return $response->withJson($responseBody, 400);
        }
        else if(!empty($user->getPassword())) {
            $responseBody = [
                'success' => true,
                'message' => "User has typed the correct password",
                'passwordMatch' => PasswordValidator::checkPassword($data['password'], $user->getPassword())
            ];
        }
            else {
            $responseBody = [
                'success' => false,
                'message' => 'User does not have password'
            ];
            return $response->withJson($responseBody, 400);
        }

        return $response->withJson($responseBody);
        }
}