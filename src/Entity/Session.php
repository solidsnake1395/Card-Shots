<?php
// src/Entity/Session.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'sessions')]
class Session
{
#[ORM\Id]
#[ORM\Column(type: 'string', length: 128)]
public string $sess_id;

#[ORM\Column(type: 'binary')]
public string $sess_data;

#[ORM\Column(type: 'integer')]
public int $sess_time;

#[ORM\Column(type: 'integer')]
public int $sess_lifetime;
}
