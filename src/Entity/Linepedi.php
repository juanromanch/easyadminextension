<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinepediRepository")
 */
class Linepedi
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cabepedv", inversedBy="linepedis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Idpedido;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Articulo", inversedBy="linepedis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Idarticulo;

    // Esta propiedad no se guarda en la base de datos
    private $Pedido;

    /**
     * @ORM\Column(type="integer")
     */
    private $Unidades;

    // Este método establece el nombre del cliente y la fecha del pedido

    public function getPedido()
    {
        $identificadorPedido = $this->getIdpedido()->getCodcli()->getNomcli();
        $fechaCadena = $this->getIdpedido()->getFecha()->format('d-m-Y');

        $this->Pedido = $identificadorPedido . ' - ' . $fechaCadena;
        return $this->Pedido;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdpedido(): ?Cabepedv
    {
        return $this->Idpedido;
    }

    public function setIdpedido(?Cabepedv $Idpedido): self
    {
        $this->Idpedido = $Idpedido;

        return $this;
    }

    public function __toString()
    {
        return strval($this->Idarticulo->getDescart() . ' ' . strval($this->Idarticulo->getPrcventa()));
    }

    public function getIdarticulo(): ?Articulo
    {
        return $this->Idarticulo;
    }

    public function setIdarticulo(?Articulo $Idarticulo): self
    {
        $this->Idarticulo = $Idarticulo;

        return $this;
    }

    public function getUnidades(): ?int
    {
        return $this->Unidades;
    }

    public function setUnidades(int $Unidades): self
    {
        $this->Unidades = $Unidades;

        return $this;
    }

}
