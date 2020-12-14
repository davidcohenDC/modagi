<?php

class Paginator{
    private $page;
    private $elementForPage;
    private $offset;
    private $records;
    private $totalPages;
    private $table;
    private $query;
    private $resultQuery;

    public function __construct($table)
    {
        $this->table = $table;
    }
    
    private function retrivePage() {

        if(isset($_GET["pag"])) {
            return $this->page = $_GET["pag"];
        } else {
            return $this->page = 1;
        }
    }

    public function setNewSelection($query) {
        $this->query = $query;
        $this->resultQuery = $this->table->Select($query);
    }

    public function setNextUrlPage() {
        $this->page = $this->retrivePage()+1;
        return addURLParameter($_SERVER['REQUEST_URI'],"pag",$this->page);

    }

    public function setPrevUrlPage() {
        $this->page = $this->retrivePage()-1;
        return addURLParameter($_SERVER['REQUEST_URI'],"pag",$this->page);

    }

    public function setLastUrlPage() {
            return change_url_parameter($_SERVER['REQUEST_URI'],"pag",$this->totalPages);
    }

    public function setFirstUrlPage() {
        $this->page = 1;
            return change_url_parameter($_SERVER['REQUEST_URI'],"pag",$this->page);
    }

    public function paging() {

        $this->retrivePage();

        $this->offset = ($this->page-1) * $this->elementForPage;
        $this->records = count($this->resultQuery);
        $this->totalPages = ceil($this->records / $this->elementForPage);

        if($this->offset > 1) {
            $this->query = $this->query. " LIMIT ". $this->elementForPage. " OFFSET ". $this->offset;
        } else {
            $this->query = $this->query. " LIMIT ". $this->elementForPage;
        }

        $this->resultQuery = $this->table->Select($this->query);
        return $this->resultQuery;
    }

    /*
    // Getter and Setter
    */
    public function getQuery() {
        return $this->query;
    }

    public function getOffset() {
        return $this->offset;
    }

    public function getTotalPages() {
        return $this->totalPages;
    }

    public function getRecords() {
        return $this->records;
    }

    public function setElementForPage($elemForPage) {
        $this->elementForPage = $elemForPage;
    }

    public function getPage() {
        return $this->page;
    }

}
?>