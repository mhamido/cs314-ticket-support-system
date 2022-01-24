<?php
require_once 'filter.php';

class filterticket
{
    private $AttachmentFilter;
    private $AuthorFilter; 
    private $CustomerFilter;
    private $DepartmentHeadFilter;
    private $DispatcherFilter;
    private $FilterDecorator;
    private $ServiceFilter;

    public function __construct()
    {
       $this->AttachmentFilter = new AttachmentFilter();
       $this->AuthorFilter = new AuthorFilter(); 
       $this->CustomerFilter = new CustomerFilter();
       $this->DepartmentHeadFilter = new DepartmentHeadFilter();
       $this->DispatcherFilter = new DispatcherFilter();
       $this->FilterDecorator = new FilterDecorator();
       $this->ServiceFilter = new ServiceFilter();
    }
    public function CustomerFilter()
    {
        $this->CustomerFilter->generate();
        $this->FilterDecorator->generate();
        $this->ServiceFilter->generate();
        $this->AttachmentFilter->generate();
        $this->AuthorFilter->generate();
    }
    public function DepartmentHeadFilter()
    {
        $this->DepartmentHeadFilter->generate();
        $this->FilterDecorator->generate();
        $this->ServiceFilter->generate();
        $this->AttachmentFilter->generate();
        $this->AuthorFilter->generate();
    }
    public function DispatcherFilter()
    {
        $this->DispatcherFilter->generate();
        $this->FilterDecorator->generate();
        $this->ServiceFilter->generate();
        $this->AttachmentFilter->generate();
        $this->AuthorFilter->generate();
    }
}
class FacadePattern{
    public static function main() 
    {
       $filterticket = new filterticket();
       $filterticket->CustomerFilter();
       $filterticket->DepartmentHeadFilter();
       $filterticket->DispatcherFilter();		
    }
}
FacadePattern::main();
?>