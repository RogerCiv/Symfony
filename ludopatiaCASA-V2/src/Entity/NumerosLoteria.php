<?php

namespace App\Entity;

use App\Repository\NumerosLoteriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NumerosLoteriaRepository::class)]
class NumerosLoteria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\OneToMany(mappedBy: 'numeroLoteria', targetEntity: Apuesta::class)]
    private Collection $apuestas;

    #[ORM\ManyToMany(targetEntity: Sorteo::class, mappedBy: 'numerosLoteria')]
    private Collection $sorteos;

    public function __construct()
    {
        $this->apuestas = new ArrayCollection();
        $this->sorteos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection<int, Apuesta>
     */
    public function getApuestas(): Collection
    {
        return $this->apuestas;
    }

    public function addApuesta(Apuesta $apuesta): static
    {
        if (!$this->apuestas->contains($apuesta)) {
            $this->apuestas->add($apuesta);
            $apuesta->setNumeroLoteria($this);
        }

        return $this;
    }

    public function removeApuesta(Apuesta $apuesta): static
    {
        if ($this->apuestas->removeElement($apuesta)) {
            // set the owning side to null (unless already changed)
            if ($apuesta->getNumeroLoteria() === $this) {
                $apuesta->setNumeroLoteria(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sorteo>
     */
    public function getSorteos(): Collection
    {
        return $this->sorteos;
    }

    public function addSorteo(Sorteo $sorteo): static
    {
        if (!$this->sorteos->contains($sorteo)) {
            $this->sorteos->add($sorteo);
            $sorteo->addNumerosLoterium($this);
        }

        return $this;
    }

    public function removeSorteo(Sorteo $sorteo): static
    {
        if ($this->sorteos->removeElement($sorteo)) {
            $sorteo->removeNumerosLoterium($this);
        }

        return $this;
    }

    // En la entidad NumerosLoteria
    public function isCompradoByUser(Sorteo $sorteo, User $user): bool
    {
        foreach ($this->apuestas as $apuesta) {
            if ($apuesta->getSorteo() === $sorteo && $apuesta->getUser() === $user) {
                return true;
            }
        }

        return false;
    }
}
