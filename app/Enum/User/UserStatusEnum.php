<?php

namespace App\Enum\User;

enum UserStatusEnum: int
{
    case ACTIVE = 1;
    case PASSIVE = 0;
}
