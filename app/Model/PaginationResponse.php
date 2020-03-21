<?php


namespace App\Model;


class PaginationResponse
{
    public int $total;
    public array $results;
    public int $page;
    public int $limit;

    public function __construct(int $total, array $results, int $page, int $limit)
    {
        $this->total = $total;
        $this->results = $results;
        $this->page = $page;
        $this->limit = $limit;
    }

    public function isFirstPage(): bool
    {
        return $this->page === 1;
    }

    public function isLastPage(): bool
    {
        return $this->page === (int)ceil($this->total / $this->limit);
    }
}
