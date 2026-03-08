<?php

declare(strict_types=1);

namespace App\Components\MyPaginator;

use Nette;
use Nette\Application\UI\Control;

final class MyPaginator extends Control
{
    public int $totalItems = 0;       
    public int $itemsPerPage = 5;    
    public int $currentPage = 1;    
    public string $action;

    public function render(): void
    {
        $totalPages = (int) ceil($this->totalItems / $this->itemsPerPage);
        $this->template->pages = range(1, $totalPages);
        $this->template->currentPage = $this->currentPage;
        $this->template->action = 'Cds:list';
        $this->template->render(__DIR__ . '/Mypaginator.latte');
    }
}