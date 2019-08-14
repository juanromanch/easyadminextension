<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CabepedvRepository")
 */
class Cabepedv
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clientes", inversedBy="cabepedvs")
     */
    private $Codcli;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Represen", inversedBy="cabepedvs")
     */
    private $Codrep;

    /**
     * @ORM\Column(type="date")
     */
    private $Fecha;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Observaciones;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Linepedi", mappedBy="Idpedido", orphanRemoval=true)
     */
    private $linepedis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodcli(): ?Clientes
    {
        return $this->Codcli;
    }

    public function setCodcli(?Clientes $Codcli): self
    {
        $this->Codcli = $Codcli;

        return $this;
    }

    public function getCodrep(): ?Represen
    {
        return $this->Codrep;
    }

    public function setCodrep(?Represen $Codrep): self
    {
        $this->Codrep = $Codrep;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(\DateTimeInterface $Fecha): self
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->Observaciones;
    }

    public function setObservaciones(?string $Observaciones): self
    {
        $this->Observaciones = $Observaciones;

        return $this;
    }
    // Al instanciar la clase, ponemos como fecha la actual en los formularios.
    public function __construct()
    {
        $this->Fecha = new \DateTime('now');
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
            $linepedi->setIdpedido($this);
        }

        return $this;
    }

    public function removeLinepedi(Linepedi $linepedi): self
    {
        if ($this->linepedis->contains($linepedi)) {
            $this->linepedis->removeElement($linepedi);
            // set the owning side to null (unless already changed)
            if ($linepedi->getIdpedido() === $this) {
                $linepedi->setIdpedido(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return strval($this->id);
    }
}
