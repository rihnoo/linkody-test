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
     * @return void
     */
    public function setCreatedAt(): void;
}