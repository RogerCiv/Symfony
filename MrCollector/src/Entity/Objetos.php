<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ObjetosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Serializer\Attribute\Groups as AttributeGroups;

#[ORM\Entity(repositoryClass: ObjetosRepository::class)]
#[ApiResource (
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['update']],
)]
class Objetos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read'])]
    #[SerializedName('name')]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'objetos')]
    #[Groups(['read'])]
    private ?Fabricante $fabricante = null;

    #[ORM\ManyToOne(inversedBy: 'objetos')]
    #[Groups(['read'])]
    private ?Oleada $oleada = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read'])]
    private ?string $foto = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    #[Groups(['read'])]
    private ?string $precio_salida = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    #[Groups(['read'])]
    private ?string $precio_estimado_actual = null;

    #[ORM\ManyToOne(inversedBy: 'objetos')]
    #[Groups(['read'])]
    private ?Coleccion $nombre_coleccion = null;

    #[ORM\OneToMany(targetEntity: Compra::class, mappedBy: 'objeto')]
    #[Groups(['read'])]
    private Collection $compras;



    public function __construct()
    {
        $this->compras = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }
    #[Groups(['update'])]
    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFabricante(): ?Fabricante
    {
        return $this->fabricante;
    }

    public function setFabricante(?Fabricante $fabricante): static
    {
        $this->fabricante = $fabricante;

        return $this;
    }

    public function getOleada(): ?Oleada
    {
        return $this->oleada;
    }

    public function setOleada(?Oleada $oleada): static
    {
        $this->oleada = $oleada;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): static
    {
        $this->foto = $foto;

        return $this;
    }

    public function getPrecioSalida(): ?string
    {
        return $this->precio_salida;
    }

    public function setPrecioSalida(string $precio_salida): static
    {
        $this->precio_salida = $precio_salida;

        return $this;
    }

    public function getPrecioEstimadoActual(): ?string
    {
        return $this->precio_estimado_actual;
    }

    public function setPrecioEstimadoActual(string $precio_estimado_actual): static
    {
        $this->precio_estimado_actual = $precio_estimado_actual;

        return $this;
    }

    public function getNombreColeccion(): ?Coleccion
    {
        return $this->nombre_coleccion;
    }

    public function setNombreColeccion(?Coleccion $nombre_coleccion): static
    {
        $this->nombre_coleccion = $nombre_coleccion;

        return $this;
    }

    /**
     * @return Collection<int, Compra>
     */
    public function getCompras(): Collection
    {
        return $this->compras;
    }

    public function addCompra(Compra $compra): static
    {
        if (!$this->compras->contains($compra)) {
            $this->compras->add($compra);
            $compra->setObjeto($this);
        }

        return $this;
    }

    public function removeCompra(Compra $compra): static
    {
        if ($this->compras->removeElement($compra)) {
            // set the owning side to null (unless already changed)
            if ($compra->getObjeto() === $this) {
                $compra->setObjeto(null);
            }
        }

        return $this;
    }


}
