<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Helpers;

/** @internal */
final class ScalarValues
{
    /** @var array<string, scalar> */
    private $data;

    /** @param array<string, scalar> $data */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /** @return scalar|null */
    public function get(string $key)
    {
        return $this->data[$key] ?? null;
    }

    public function string(string $key): string
    {
        return (string) $this->get($key);
    }

    public function timestamp(string $key): int
    {
        $value = $this->string($key);
        if ('' === $value) {
            return 0;
        }
        return strtotime($value) ?: 0;
    }

    public function bool(string $key): bool
    {
        return (bool) $this->get($key);
    }

    public function int(string $key): int
    {
        return (int) $this->get($key);
    }
}
