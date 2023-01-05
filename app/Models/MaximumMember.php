<?php

namespace App\Models;

use Attribute;

#[Attribute]
final class MaximumMember
{
    public function __construct(public int $value)
    {
    }
}
