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

    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $data = $request->getParsedBody();
        $user = $this->userModel->getUserById($data['user']);
        if (!$user) {
            $responseBody = [
                'success' => false,
                'message' => "User not found",
                'passwordMatch' => null
            ];
            return $response->withJson($responseBody, 400);
        } else if (empty($user->getPassword())) {
            $responseBody = [
                'success' => false,
                'message' => 'User does not have password',
                'passwordMatch' => null
            ];
            return $response->withJson($responseBody, 400);
        } else {
            $responseBody = [
                'success' => true,
                'message' => 'Entered password successfully checked against the db',
                'passwordMatch' => PasswordValidator::checkPassword($data['password'], $user->getPassword())
            ];
            return $response->withJson($responseBody, 200);
        }
    }
}