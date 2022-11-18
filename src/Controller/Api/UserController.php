<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Security;
use Nelmio\ApiDocBundle\Annotation\Model;

class UserController extends AbstractFOSRestController
{
    /**
     * List all users
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    #[Rest\Get('/api/users', name: 'api_user_list')]
    #[OA\Response(
        response: 200,
        description: 'Returns the rewards of an user',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: User::class, groups: ['full']))
        )
    )]
    #[OA\Tag(name: 'User')]
    #[Security(name: 'Bearer')]
    public function index(UserRepository $userRepository)
    {
        /** Creating response view*/
        $view = $this->view($userRepository->findAll(), 200);
        return $this->handleView($view);
    }
}
