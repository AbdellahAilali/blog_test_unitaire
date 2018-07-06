<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/user/{id}", name="user")
     */

    public function userAction($id)
    {
        /** @var User $user */

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $id]);
        $result['pseudo'] = $user->getPseudo();
        $result['registration'] = $user->getRegistrationDate();
        $tabcomments = [];

        foreach ($user->getComments() as $comment) {
            $tabcomments [] = [
                "title"=>$comment->getTitle(),
                "description"=>$comment->getDescription()
            ];
        }

        $result["comments"] = $tabcomments;

        return new JsonResponse($result);

    }

}