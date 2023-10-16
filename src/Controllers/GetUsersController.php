<?php

namespace CaterpillarOS\Controllers;

use CaterpillarOS\Models\UserModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GetUsersController
{
    private UserModel $userModel;

    /**
     * @param UserModel $model
     */
    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $users = $this->userModel->getAllUsers();
        $responseBody = [
            'message' => 'Users successfully retrieved from db ',
            'status' => 200,
            'data' => $users
        ];
        return $response->withJson($responseBody);
    }

}