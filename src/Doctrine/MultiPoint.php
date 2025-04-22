<?php

namespace JonHubbard1\LaravelMysqlSpatial\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class MultiPoint extends Type
{
    const MULTIPOINT = 'multipoint';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'multipoint';
    }

    public function getName()
    {
        return self::MULTIPOINT;
    }
}
