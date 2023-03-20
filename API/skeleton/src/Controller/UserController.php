<?php

namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/users")]
#[AsController]
class UserController extends AbstractController
{


    #[Route('/', name: 'getUsers', methods: ['GET'])]
    public function getCollection(EntityManagerInterface $entityManager): JsonResponse
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->json($users);
    }

    #[Route('/', name: 'postUsers', methods: ['POST'])]
    public function post(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user);
    }


    #[Route('/{id}', name: 'getUser', methods: ['GET'])]
    public function getItem(User $user): JsonResponse
    {
        return $this->json($user);
    }


    #[Route('/{id}', name: 'putUsers', methods: ['PUT'])]
    public function put(Request $request, EntityManagerInterface $entityManager, User $user): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $user->setName($data['name']);
        $user->setEmail($data['email']);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user);
    }


    #[Route('/{id}', name: 'patchUser', methods: ['PATCH'])]
    public function patchUser(User $user, Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) {
            $user->setName($data['name']);
        }

        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user);
    }


    #[Route('/{id}', name: 'deleteUser', methods: ['DELETE'])]
    public function deleteUser(User $user, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($user);
        $entityManager->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}