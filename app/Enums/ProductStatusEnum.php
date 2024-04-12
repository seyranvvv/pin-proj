<?php

namespace App\Enums;

enum ProductStatusEnum : string
{
    case AVAILABLE = "AVAILABLE";
    case UNAVAILABLE = "UNAVAILABLE";

    public function name(): string
    {
        return match($this) {
            self::AVAILABLE => "Доступен",
            self::UNAVAILABLE => "Не доступен",
        };
    }
}
