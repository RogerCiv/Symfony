<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CompraRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompraRepository::class)]
#[ApiResource]
class Compra
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $precio = null;

    #[ORM\ManyToOne(inversedBy: 'precio_compra')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'compras')]
    private ?Objetos $objeto = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getObjeto(): ?Objetos
    {
        return $this->objeto;
    }

    public function setObjeto(?Objetos $objeto): static
    {
        $this->objeto = $objeto;

        return $this;
    }
}
