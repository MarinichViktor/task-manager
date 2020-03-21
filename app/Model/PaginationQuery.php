<?php


namespace App\Model;


class PaginationQuery
{
    public int $limit;
    public int $page;
    public int $offset;

    public function __construct(int $limit, int $page)
    {
        $this->limit = $limit;
        $this->page = $page;
        $this->offset = ($this->page - 1) * $this->limit;
    }
}
