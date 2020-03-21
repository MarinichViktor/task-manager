<?php


namespace App\Model;


use Symfony\Component\HttpFoundation\Request;

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

    public static function fromRequest(Request $request): PaginationQuery
    {
        return new PaginationQuery($request->get('limit', 3), $request->get('page', 1));
    }
}
