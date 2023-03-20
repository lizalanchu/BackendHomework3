<?php

namespace App\Entity;


use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;

use App\Controller\UserController;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource(operations: [
    new Get(controller: UserController::class),
    new GetCollection(controller: UserController::class),
    new Post(controller: UserController::class),
    new Put(controller: UserController::class),
    new Patch(controller: UserController::class),
    new Delete(controller: UserController::class)
])]
class User
{
     #[ORM\Id]
     #[ORM\GeneratedValue]
     #[ORM\Column(type: "integer")]
    private int $id;

     #[ORM\Column(type: "string", length: 255)]
    private string $name;

     #[ORM\Column(type: "string", length: 255)]
    private string $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}