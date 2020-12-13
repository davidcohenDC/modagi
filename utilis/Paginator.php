<?php

class Paginator{
    private $table;
    private $page;
    private $maxPages;
    private $offset;
    private $totalPages;

    public function __construct($maxPages)
    {
        $this->page = $this->getPage();
        $this->maxPages= $maxPages;
        $this->offset = 1;
    }


    public function getPage() {
        if(isset($_GET["pag"])) {
            return $this->page = $_GET["pag"];
        } else {
            return $this->page = 1;
        }
    }

    public function prevPage() {
        if($this->page > 1) {
            $this->page--;
            return $this->page;
        } 
    }

    public function nextPage() {
        if($this->page <= $this->maxPages) {
            $this->page++;
            return $this->page;
        }
    }

}
?>