<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticuloRepository")
 */
class Articulo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $Codart;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $Codalt;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Descart;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Prcventa;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Obsoleto;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Linepedi", mappedBy="Idarticulo")
     */
    private $linepedis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodart(): ?string
    {
        return $this->Codart;
    }

    public function setCodart(?string $Codart): self
    {
        $this->Codart = $Codart;

        return $this;
    }

    public function getCodalt(): ?string
    {
        return $this->Codalt;
    }

    public function setCodalt(string $Codalt): self
    {
        $this->Codalt = $Codalt;

        return $this;
    }

    public function getDescart(): ?string
    {
        return $this->Descart;
    }

    public function setDescart(?string $Descart): self
    {
        $this->Descart = $Descart;

        return $this;
    }

    public function getPrcventa(): ?float
    {
        return $this->Prcventa;
    }

    public function setPrcventa(?float $Prcventa): self
    {
        $this->Prcventa = $Prcventa;

        return $this;
    }

    public function getObsoleto(): ?bool
    {
        return $this->Obsoleto;
    }

    public function setObsoleto(?bool $Obsoleto): self
    {
        $this->Obsoleto = $Obsoleto;

        return $this;
    }

    public function __toString(){
        return $this->Descart;
    }

    public function __construct()
    {
        // Inicializamos Obsoleto (activo) a true para formularios
        $this->Obsoleto = true;
        $this->linepedis = new ArrayCollection();
    }

    /**
     * @return Collection|Linepedi[]
     */
    public function getLinepedis(): Collection
    {
        return $this->linepedis;
    }

    public function addLinepedi(Linepedi $linepedi): self
    {
        if (!$this->linepedis->contains($linepedi)) {
            $this->linepedis[] = $linepedi;
            $linepedi->setIdarticulo($this);
        }

        return $this;
    }

    public function removeLinepedi(Linepedi $linepedi): self
    {
        if ($this->linepedis->contains($linepedi)) {
            $this->linepedis->removeElement($linepedi);
            // set the owning side to null (unless already changed)
            if ($linepedi->getIdarticulo() === $this) {
                $linepedi->setIdarticulo(null);
            }
        }

        return $this;
    }
}
