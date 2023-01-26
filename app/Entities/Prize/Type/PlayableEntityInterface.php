<?php

namespace App\Entities\Prize\Type;

interface PlayableEntityInterface
{
    public function getId(): int;
    public function getCount(): int|float;
}
