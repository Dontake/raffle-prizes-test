<?php

namespace App\Models\Traits;

trait HasStandardTimestamps
{
    /**
     * @return mixed
     */
    public function getCreatedAt(): mixed
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     * @return self
     */
    public function setCreatedAt(mixed $created_at): static
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt(): mixed
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     * @return self
     */
    public function setUpdatedAt(mixed $updated_at): static
    {
        $this->updated_at = $updated_at;
        return $this;
    }
}
