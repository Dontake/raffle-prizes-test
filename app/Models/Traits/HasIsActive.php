<?php

namespace App\Models\Traits;

trait HasIsActive
{
    /**
     * @return bool
     */
    public function isIsActive(): bool
    {
        return $this->is_active;
    }

    /**
     * @param bool $isActive
     * @return self
     */
    public function setIsActive(bool $isActive): static
    {
        $this->is_active = $isActive;
        return $this;
    }
}
