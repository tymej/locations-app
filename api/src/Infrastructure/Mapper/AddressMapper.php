<?php

declare(strict_types=1);

namespace Localization\Infrastructure\Mapper;

use Localization\Application\Entity\CompanyAddress;
use Localization\Infrastructure\AbstractDataMapper;
use PDO;
use PDOStatement;

class AddressMapper extends AbstractDataMapper
{
    private const SQL_FIND = 'SELECT * FROM `addresses` where id=?';
    private const SQL_FIND_ALL = 'SELECT * FROM `addresses`';
    private const SQL_INSERT = 'INSERT INTO `addresses` (id, street, city) VALUES (:id, :street, :city)';
    private const SQL_UPDATE = 'UPDATE `addresses` SET street=:street, city=:city WHERE id = :id';
    private const SQL_REMOVE = 'DELETE FROM `addresses` WHERE id=?';

    private PDOStatement $findStatement;
    private PDOStatement $findAllStatement;
    private PDOStatement $insertStatement;
    private PDOStatement $updateStatement;
    private PDOStatement $removeStatement;

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);

        $this->findStatement = $this->createStatement(self::SQL_FIND);
        $this->findAllStatement = $this->createStatement(self::SQL_FIND_ALL);
        $this->insertStatement = $this->createStatement(self::SQL_INSERT);
        $this->updateStatement = $this->createStatement(self::SQL_UPDATE);
        $this->removeStatement = $this->createStatement(self::SQL_REMOVE);
    }

    public function findStatement(): PDOStatement
    {
        return $this->findStatement;
    }

    public function insertStatement(): PDOStatement
    {
        return $this->insertStatement;
    }

    public function updateStatement(): PDOStatement
    {
        return $this->updateStatement;
    }

    public function findAllStatement(): PDOStatement
    {
        return $this->findAllStatement;
    }

    protected function removeStatement(): PDOStatement
    {
        return $this->removeStatement;
    }

    public function fromRaw(array $raw): object
    {
        return new CompanyAddress($raw['id'], $raw['street'], $raw['city']);
    }

    /**
     * @param CompanyAddress $object
     */
    protected function toRaw(object $object): array
    {
        return [
            'id' => $object->id,
            'street' => $object->street,
            'city' => $object->city,
        ];
    }
}
