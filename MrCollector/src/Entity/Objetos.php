<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ObjetosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjetosRepository::class)]
#[ApiResource]
class Objetos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(inversedBy: 'objetos')]
    private ?Fabricante $fabricante = null;

    #[ORM\ManyToOne(inversedBy: 'objetos')]
    private ?Oleada $oleada = null;

    #[ORM\Column(length: 255)]
    private ?string $foto = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $precio_salida = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $precio_estimado_actual = null;

    #[ORM\ManyToOne(inversedBy: 'objetos')]
    private ?Coleccion $nombre_coleccion = null;



    public function __construct()
    {
     
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


}
