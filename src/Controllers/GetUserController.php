<?php

namespace CaterpillarOS\Controllers;

use CaterpillarOS\Models\UserModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use function PHPUnit\Framework\throwException;


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

    public function __invoke(RequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $userId = $args['userId'];
        $statusCode = 500;
        $responseBody = [
            'success' => false,
            'message' => "Unexpected error",
            'data' => 500,
        ];
        try {
            if (!ctype_digit($userId)) {
                $responseBody = [
                    'success' => false,
                    'message' => "User Id must be numeric",
                    'status' => 400,
                    'data' => []
                ];
                $statusCode = 400;
            }
            else {
                $user = $this->userModel->getUserById($userId);
                if(!$user){
                    $responseBody = [
                        'success' => false,
                        'message' => "User not found",
                        'status' => 400,
                        'data' => []
                    ];
                    $statusCode = 400;
                } else {
                    $responseBody = [
                        'success' => true,
                        'message' => "User successfully retrieved from db",
                        'status' => 200,
                        'data' => $user
                    ];
                    $statusCode = 200;
                }

            }
        } catch (\Exception $exception) {
        }

       return $response->withJson($responseBody, $statusCode);
    }
}