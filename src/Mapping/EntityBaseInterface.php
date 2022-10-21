<?php

namespace App\Mapping;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * EntityBase Interface
 */
interface EntityBaseInterface
{
    /**
     * Get createdAt
     *
     * @return null|DateTime
     */
    public function getCreatedAt(): ?DateTime;

    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     * @return void
     */
    public function setCreatedAt(DateTime $createdAt): void;
}