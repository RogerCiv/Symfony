<?php

namespace App\Entity;

use App\Repository\SorteoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SorteoRepository::class)]
class Sorteo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $presupuestoRegalo = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaSorteo = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'sorteos')]
    private Collection $usuarios;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresupuestoRegalo(): ?string
    {
        return $this->presupuestoRegalo;
    }

    public function setPresupuestoRegalo(string $presupuestoRegalo): static
    {
        $this->presupuestoRegalo = $presupuestoRegalo;

        return $this;
    }

    public function getFechaSorteo(): ?\DateTimeInterface
    {
        return $this->fechaSorteo;
    }

    public function setFechaSorteo(\DateTimeInterface $fechaSorteo): static
    {
        $this->fechaSorteo = $fechaSorteo;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(?User $usuario): static
    {
        if ($usuario !== null && !$this->usuarios->contains($usuario)) {
            $this->usuarios->add($usuario);
            $usuario->addSorteo($this);
        }
    
        return $this;
    }
    
    public function removeUsuario(User $usuario): static
    {
        if($this->usuarios->removeElement($usuario)) {
            $usuario->removeSorteo($this);
        }

        return $this;
    }


}
