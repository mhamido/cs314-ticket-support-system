<?php
require_once "../model/user.php";
require_once "../model/database.php";
require_once "../errorPage.php";
require_once "../model/filter.php";
require_once "../model/report.php";
require_once "../model/service.php";

session_start();
var_dump($_POST);

$errs = new ErrorPage();
$user = $_SESSION["user"];
$filter = $user->filter;

$reportName = $_POST["report_name"];

interface search
{
    public function runsearch($filter, $user , $post);
}

class searchservices implements search
{
    public function runsearch($filter, $user , $post)
    {
        if (!isset($post["services"])) {
            return $filter;
        }

        foreach (Service::fetch() as $service) {
            if ($service->name == $post["services"]) {
                return new ServiceFilter($filter, $service->id);
            }
        }
    }
}

class searchattachment implements search
{
    public function runsearch($filter, $user, $post)
    {
        if (isset($_POST["attachment"])) 
        {
            $name = filter_var($_POST["ticket_author_name"],FILTER_SANITIZE_STRING);
            return new AttachmentFilter($filter, $name);
        }
        return $filter;
    }
}

class searchauthor implements search
{
    public function runsearch($filter, $user , $post)
    {
        if (isset($_POST["ticket_author_name"])) 
        {
            $name = filter_var($_POST["ticket_author_name"],FILTER_SANITIZE_STRING);
            return new AuthorFilter($filter, $name);
        }
        return $filter;
    }
}

class SearchFacade
{
    private $searchattachment;
    private $searchauthor;
    private $searchservices;

    public function __construct()
    {
        $this->searchauthor = new searchauthor();
        $this->searchservices = new searchservices();
        $this->searchattachment = new searchattachment();
    }

    public function run($filter, $user, $post)
    {
        $filter = $this->searchauthor->runsearch($filter, $user, $post);
        $filter = $this->searchservices->runsearch($filter, $user, $post);
        $filter = $this->searchattachment->runsearch($filter, $user, $post);
        return $filter->generate();
    }
}

class FacadePattern
{
    public static function main($user, $post) 
    {
        $searchticket = new SearchFacade();
        $searchticket->run($user->filter, $user , $post);	
    }
}
