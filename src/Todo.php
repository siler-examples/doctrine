<?php declare(strict_types=1);

namespace App;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Siler\Prelude\FromArray;
use Siler\Prelude\Patch;

/**
 * @ORM\Entity
 * @ORM\Table(name="todos")
 */
class Todo
{
    use FromArray;
    use Patch;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    public ?int $id;
    /**
     * @ORM\Column(type="string")
     */
    public string $text;
    /**
     * @ORM\Column(type="boolean")
     */
    public bool $done = false;
    /**
     * @ORM\Column(type="datetime", options={"default": "current_timestamp"})
     */
    public DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }
}