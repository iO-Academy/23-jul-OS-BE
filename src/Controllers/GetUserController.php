<?php

namespace CaterpillarOS\Controllers;

use CaterpillarOS\Models\UserModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GetUserController
{
    private UserModel $userModel;

    /**
     * @param UserModel $userModel
     */
    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
       $user = $this->userModel->getUserById();
       $responseBody = [
           'message' => "User successfully retrieved from db",
           'status' => 200,
           'data' => $user
       ];
       return $response->withJson($responseBody);

    }
}