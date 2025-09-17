<?php

namespace App\Enum;

enum UserRole: string
{
   case ADMIN = 'admin';
   case STUDENT = 'student';

   public function label(): string
   {
       return match ($this) {
           self::ADMIN => 'Administrator',
           self::STUDENT => 'Student',
       };
   }
}
