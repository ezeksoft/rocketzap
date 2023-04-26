<?php 

namespace Ezeksoft\RocketZap\Entity;

interface Entity
{
    /** @var int */
    public function setId(int $id);

    public function getId();

    /** @var string */
    public function setName(string $name);

    public function getName();
}