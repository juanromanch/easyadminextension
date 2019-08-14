<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RepresenRepository")
 */
class Represen extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Clientes", mappedBy="Codrep")
     */
    private $clientes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cabepedv", mappedBy="Codrep")
     */
    private $cabepedvs;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Nomrep;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $Codrep;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        parent::__construct();
        $this->clientes = new ArrayCollection();
        $this->cabepedvs = new ArrayCollection();
        // your own logic
        // Establecemos Activo a true y damos valor 0 a Codrep
        $this->enabled = true;
        $this->Codrep = 0;
    }

    /**
     * @return Collection|Clientes[]
     */
    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Clientes $cliente): self
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes[] = $cliente;
            $cliente->setCodrep($this);
        }

        return $this;
    }

    public function removeCliente(Clientes $cliente): self
    {
        if ($this->clientes->contains($cliente)) {
            $this->clientes->removeElement($cliente);
            // set the owning side to null (unless already changed)
            if ($cliente->getCodrep() === $this) {
                $cliente->setCodrep(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cabepedv[]
     */
    public function getCabepedvs(): Collection
    {
        return $this->cabepedvs;
    }

    public function addCabepedv(Cabepedv $cabepedv): self
    {
        if (!$this->cabepedvs->contains($cabepedv)) {
            $this->cabepedvs[] = $cabepedv;
            $cabepedv->setCodrep($this);
        }

        return $this;
    }

    public function removeCabepedv(Cabepedv $cabepedv): self
    {
        if ($this->cabepedvs->contains($cabepedv)) {
            $this->cabepedvs->removeElement($cabepedv);
            // set the owning side to null (unless already changed)
            if ($cabepedv->getCodrep() === $this) {
                $cabepedv->setCodrep(null);
            }
        }

        return $this;
    }

    public function getNomrep(): ?string
    {
        return $this->Nomrep;
    }

    public function setNomrep(?string $Nomrep): self
    {
        $this->Nomrep = $Nomrep;

        return $this;
    }

    public function getCodrep(): ?string
    {
        return $this->Codrep;
    }

    public function setCodrep(string $Codrep): self
    {
        $this->Codrep = $Codrep;

        return $this;
    }

    public function __toString()
    {
        return $this->Nomrep;
    }
}
