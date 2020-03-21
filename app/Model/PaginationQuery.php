<?php


namespace App\Model;


use Symfony\Component\HttpFoundation\Request;

class PaginationQuery
{
    public int $limit;
    public int $page;
    public int $offset;
    public string $orderBy = 'name';
    public string $order = 'ASC';

    public function __construct(int $limit, int $page, string $orderBy, string $order)
    {
        $this->limit = $limit;
        $this->page = $page;
        $this->offset = ($this->page - 1) * $this->limit;
        $this->orderBy = $orderBy;
        $this->order = $order;
    }

    public static function fromRequest(Request $request): PaginationQuery
    {
        return new PaginationQuery(
            $request->get('limit', 3),
            $request->get('page', 1),
            $request->get('orderBy', 'name'),
            $request->get('order', 'ASC'),
        );
    }
}
