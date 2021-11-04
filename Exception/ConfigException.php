<?php

namespace Zbara\Framework\Exception;

use Exception;
use JsonSerializable;

class ConfigException extends Exception implements JsonSerializable
{
    /**
     * @var mixed|null
     */
    private $extra;

    public function __construct($code = 0, $extra = null)
    {
        parent::__construct(null, $code);
        $this->extra = $extra;
    }

    public function jsonSerialize(): array
    {
        $d = ["errorId" => $this->getCode()];

        if ($this->extra) {
            $d["full"] = $this->extra;
        }

        return $d;
    }
}