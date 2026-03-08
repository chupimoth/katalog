<?php
declare(strict_types=1);

namespace App\Model;

use Nette;
use Nette\Database\Explorer;

final class EbookModel
{
    use Nette\SmartObject;

    public function __construct(private Explorer $db)
    {
    }

    public function getAll(int $limit, int $offset): array
    {
        return $this->db->table('ebooks')
            ->limit($limit, $offset)
            ->order('id ASC')
            ->fetchAll();
    }

    public function countAll(): int
    {
        return $this->db->table('ebooks')->count('*');
    }

    public function getById(int $id): ?Nette\Database\Table\ActiveRow
    {
        return $this->db->table('ebooks')->get($id) ?: null;
    }

    public function insert(array $data): int
    {
        $row = $this->db->table('ebooks')->insert($data);
        return (int)$row->id;
    }

    public function update(int $id, array $data): void
    {
        $this->db->table('ebooks')->where('id', $id)->update($data);
    }

    public function delete(int $id): void
    {
        $this->db->table('ebooks')->where('id', $id)->delete();
    }
}