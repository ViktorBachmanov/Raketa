<?php

namespace App\Enums;


enum Category: string 
{
    case Tables = 'tables';
    case Chairs = 'chairs';
    case Banquettes = 'banquettes';
    case Commodes = 'commodes';
    case Stacks = 'stacks';
}