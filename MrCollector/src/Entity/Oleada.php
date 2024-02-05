<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OleadaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OleadaRepository::class)]
#[ApiResource]
class Oleada
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $num_oleada = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $year_lanzamiento = null;

    #[ORM\OneToMany(targetEntity: Objetos::class, mappedBy: 'oleada')]
    private Collection $objetos;

    public function __construct()
    {
        $this->objetos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumOleada(): ?int
    {
        return $this->num_oleada;
    }

    public function setNumOleada(int $num_oleada): static
    {
        $this->num_oleada = $num_oleada;

        return $this;
    }

    public function getYearLanzamiento(): ?\DateTimeImmutable
    {
        return $this->year_lanzamiento;
    }

    public function setYearLanzamiento(\DateTimeImmutable $año_lanzamiento): static
    {
        $this->year_lanzamiento = $año_lanzamiento;

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
            $objeto->setOleada($this);
        }

        return $this;
    }

    public function removeObjeto(Objetos $objeto): static
    {
        if ($this->objetos->removeElement($objeto)) {
            // set the owning side to null (unless already changed)
            if ($objeto->getOleada() === $this) {
                $objeto->setOleada(null);
            }
        }

        return $this;
    }
}
