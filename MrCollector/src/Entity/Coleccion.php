<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ColeccionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColeccionRepository::class)]
#[ApiResource]
class Coleccion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\OneToMany(targetEntity: Objetos::class, mappedBy: 'nombre_coleccion')]
    private Collection $objetos;

    #[ORM\ManyToOne(inversedBy: 'coleccion')]
    private ?User $user = null;





    public function __construct()
    {
        $this->objetos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Objetos>
     */
    public function getObjetos(): Collection
    {
        return $this->objetos;
    }

    public function addObjeto(Objetos $objeto): static
    {
        if (!$this->objetos->contains($objeto)) {
            $this->objetos->add($objeto);
            $objeto->setNombreColeccion($this);
        }

        return $this;
    }

    public function removeObjeto(Objetos $objeto): static
    {
        if ($this->objetos->removeElement($objeto)) {
            // set the owning side to null (unless already changed)
            if ($objeto->getNombreColeccion() === $this) {
                $objeto->setNombreColeccion(null);
            }
        }

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



   
}
