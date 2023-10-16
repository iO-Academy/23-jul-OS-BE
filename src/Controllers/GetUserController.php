<?php

namespace CaterpillarOS\Controllers;

use CaterpillarOS\Models\UserModel;
use mysql_xdevapi\Exception;
use PHPUnit\Event\Code\Throwable;
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
        try{
            if (!ctype_digit($args['userId'])) {
                $responseBody = [
                    'message' => "User id must be numeric",
                    'status' => 400,
                    'data' => []
                ];
            } else {
                $user = $this->userModel->getUserById($args['userId']);
                if($user == []) {
                    $responseBody = [
                        'message' => "Invalid user id",
                        'status' => 400,
                        'data' => []
                    ];
                } else {
                    $responseBody = [
                        'message' => "User successfully retrieved from db",
                        'status' => 200,
                        'data' => $user
                    ];
                }
            }
        } catch (\Exception $e) {
            $responseBody = [
                'message' => "Unexpected error",
                'status' => 500,
            ];
        }

       return $response->withJson($responseBody);
    }
}