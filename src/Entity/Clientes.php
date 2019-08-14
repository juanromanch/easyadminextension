<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientesRepository")
 */
class Clientes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $Codcli;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Nomcli;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $Dircli;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $Pobcli;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Obsoleto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Represen", inversedBy="clientes")
     */
    private $Codrep;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cabepedv", mappedBy="Codcli")
     */
    private $cabepedvs;

    public function __construct()
    {
        $this->cabepedvs = new ArrayCollection();

        // Establecemos a true el valor obsoleto (en nuestro caso es activo)
        $this->Obsoleto = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodcli(): ?string
    {
        return $this->Codcli;
    }

    public function setCodcli(?string $Codcli): self
    {
        $this->Codcli = $Codcli;

        return $this;
    }

    public function getNomcli(): ?string
    {
        return $this->Nomcli;
    }

    public function setNomcli(?string $Nomcli): self
    {
        $this->Nomcli = $Nomcli;

        return $this;
    }

    public function getDircli(): ?string
    {
        return $this->Dircli;
    }

    public function setDircli(?string $Dircli): self
    {
        $this->Dircli = $Dircli;

        return $this;
    }

    public function getPobcli(): ?string
    {
        return $this->Pobcli;
    }

    public function setPobcli(?string $Pobcli): self
    {
        $this->Pobcli = $Pobcli;

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

    public function getCodrep(): ?Represen
    {
        return $this->Codrep;
    }

    public function setCodrep(?Represen $Codrep): self
    {
        $this->Codrep = $Codrep;

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
            $cabepedv->setCodcli($this);
        }

        return $this;
    }

    public function removeCabepedv(Cabepedv $cabepedv): self
    {
        if ($this->cabepedvs->contains($cabepedv)) {
            $this->cabepedvs->removeElement($cabepedv);
            // set the owning side to null (unless already changed)
            if ($cabepedv->getCodcli() === $this) {
                $cabepedv->setCodcli(null);
            }
        }

        return $this;
    }

	public function __toString(){
		return $this->Nomcli . ' ' . $this->Pobcli;
		}
}
