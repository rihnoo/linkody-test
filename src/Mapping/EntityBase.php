<?php

namespace App\Mapping;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\HasLifecycleCallbacks]
class EntityBase implements EntityBaseInterface
{
    #[ORM\Column(name: 'created_at', type: 'datetime', nullable: false, options: [])]
    protected $createdAt;

    public function getCreatedAt() :?DateTime
    {
        return $this->createdAt;
    }
    
    #[ORM\PrePersist]
    public function setCreatedAt(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }
}
