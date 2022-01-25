<?php
require_once "../model/user.php";
require_once "../model/database.php";
require_once "../errorPage.php";
require_once "../model/filter.php";
require_once "../model/authorFilter.php";
require_once "../model/serviceFilter.php";
require_once "../model/attachmentFilter.php";
require_once "../model/report.php";
require_once "../model/service.php";
require_once "../validation.php";
require_once "../model/report.php";
require_once "../model/Factory/optionfactory.php";
session_start();
// var_dump($_POST);

$errs = new ErrorPage();
$user = $_SESSION["user"];
$filter = $user->filter;

interface search
{
    public function runsearch($filter, $user, $post);
}

class searchservices implements search
{
    public function runsearch($filter, $user, $post)
    {
        if (!isset($post["services"])) {
            return $filter;
        }

        foreach (Service::fetch() as $service) {
            if ($service->name == $post["services"]) {
                return new ServiceFilter($filter, $service->id);
            }
        }
        return $filter;
    }
}

class searchattachment implements search
{
    public function runsearch($filter, $user, $post)
    {
        if (isset($_POST["attachment"])) {
            return new AttachmentFilter($filter);
        }
        return $filter;
    }
}

class searchauthor implements search
{
    public function runsearch($filter, $user, $post)
    {
        if (isset($_POST["ticket_author_name"]) && $_POST["ticket_author_name"]!="") {
            $name = filter_var($_POST["ticket_author_name"], FILTER_SANITIZE_STRING);
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
        $filter = $this->searchattachment->runsearch($filter, $user, $post);
        $filter = $this->searchauthor->runsearch($filter, $user, $post);
        $filter = $this->searchservices->runsearch($filter, $user, $post);
        return $filter->generate();
    }
}

if (isset($_POST["report_name"]) && Validation::isNullOrEmpty($_POST["report_name"])) {
    $now = date('Y-m-d-H-i-s');
    $reportName = "$user->displayName-$now";
} else if (isset($_POST["report_name"])) {
    $reportName = $_POST["report_name"];
}

$factory = new OptionFactory();
$sort = $factory->createsort($_POST["sort"]);

switch ($_POST["submit"]) {
    case "fetch":
        $report = new Report($_POST["report_id"]);
        $report->run($sort);
        break;
    case "create":
        $searchticket = new SearchFacade();
        $stmt = $searchticket->run($user->filter, $user, $_POST);        
        $report = Report::create($reportName, $user, $stmt);
        $report->run($sort);
        break;
}
