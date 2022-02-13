<?php

namespace App\Models\Traits;

use App\Models\Prize\Prize;

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
     * @return Prize
     */
    public function setIsActive(bool $isActive): self
    {
        $this->is_active = $isActive;
        return $this;
    }
}
