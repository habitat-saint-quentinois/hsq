<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Calculator
{
    /**
     * @var bool|null
     * @Assert\NotBlank
     */
    private $french;

    /**
     * @var int|null
     * @Assert\NotBlank
     */
    private $adult;

    /**
     * @var int|null
     */
    private $child;

    /**
     * @var int|null
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="integer",
     *     message="La valeur {{ value }} n'est pas un revenu valide"
     * )
     */
    private $revenue;

    /**
     * @return bool|null
     */
    public function getFrench(): ?bool
    {
        return $this->french;
    }

    /**
     * @param bool|null $french
     * @return Calculator
     */
    public function setFrench(?bool $french): Calculator
    {
        $this->french = $french;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAdult(): ?int
    {
        return $this->adult;
    }

    /**
     * @param int|null $adult
     * @return Calculator
     */
    public function setAdult(?int $adult): Calculator
    {
        $this->adult = $adult;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getChild(): ?int
    {
        return $this->child;
    }

    /**
     * @param int|null $child
     * @return Calculator
     */
    public function setChild(?int $child): Calculator
    {
        $this->child = $child;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRevenue(): ?int
    {
        return $this->revenue;
    }

    /**
     * @param int|null $revenue
     * @return Calculator
     */
    public function setRevenue(?int $revenue): Calculator
    {
        $this->revenue = $revenue;
        return $this;
    }


}