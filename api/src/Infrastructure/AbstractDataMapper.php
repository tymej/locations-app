<?php

namespace Localization\Infrastructure;

use Localization\Infrastructure\Exception\CannotCreateStatementException;
use PDO;
use PDOStatement;

abstract class AbstractDataMapper
{
    public function __construct(protected PDO $pdo)
    {
    }

    public function find(string $id): ?object
    {
        $this->findStatement()->execute([$id]);
        $raw = $this->findStatement()->fetch();
        $this->findStatement()->closeCursor();

        return $raw ? $this->fromRaw($raw) : null;
    }

    /**
     * @return array|object[]
     */
    public function findAll(): array
    {
        $this->findAllStatement()->execute();
        $rawValues = $this->findAllStatement()->fetchAll();
        $this->findAllStatement()->closeCursor();

        return $rawValues ? array_map(fn (array $raw) => $this->fromRaw($raw), $rawValues) : [];
    }

    public function insert(object $object): void
    {
        $this->insertStatement()->execute($this->toRaw($object));
    }

    public function update(object $object): void
    {
        $this->updateStatement()->execute($this->toRaw($object));
    }

    public function remove(string|int $id): void
    {
        $this->removeStatement()->execute([$id]);
    }


    protected function createStatement(string $sql, array $options = []): PDOStatement
    {
        $statement = $this->pdo->prepare($sql, $options);

        if (!$statement) {
            throw new CannotCreateStatementException(sprintf('Cannot create statement for %s', self::class));
        }

        return $statement;
    }

    abstract protected function findStatement(): PDOStatement;
    abstract protected function findAllStatement(): PDOStatement;
    abstract protected function insertStatement(): PDOStatement;
    abstract protected function updateStatement(): PDOStatement;
    abstract protected function removeStatement(): PDOStatement;
    abstract protected function toRaw(object $object): array;
    abstract protected function fromRaw(array $raw): object;
}