<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace HEADER;

class Page_Header
{

    var $title = '';
    var $content = '';
    var $header = '';

    public function __construct($title = '')
    {
        $this->title = $title;
        echo $this->header();
    }

    function header()
    {


        $this->header = '
<!DOCTYPE html>
<html >
<head>
<base href="' . ROOT . '" />
<title>' . $this->title . '</title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, 
minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<script src="jquery-ui/jquery-ui.min.js"></script>


<!-- Custom Theme files -->
<!--menu-->

<link href="css/all.css" rel="stylesheet">
<link href="css/fontawesome.min.css" rel="stylesheet">
<link href="jquery-ui/jquery-ui.min.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="css/jquery.fancybox.min.css" rel="stylesheet" type="text/css" media="all" />	
<!--//menu-->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
' . ((isset($_SESSION['AdminLogin']) && isset($_SESSION['AdminId'])) ? '
<link href="css/admin.css" rel="stylesheet" type="text/css" media="all" />	
<script src="js/jquery-te-1.4.0.min.js"></script>
<link href="js/jquery-te-1.4.0.css" rel="stylesheet" type="text/css" media="all" />	
' : '') . '
<!--//theme-style-->

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- slide -->
<script src="js/responsiveslides.min.js"></script>
   <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>
</head>
<body>
<div class="loading_backgrounds">
<div class="divLoader">جــاري التحميل .. يرجى الانتظار
<br>
<i class="fa fa-spin fa-spinner"></i>
</div>
</div>
' . ((isset($_SESSION['AdminLogin']) && isset($_SESSION['AdminId'])) && empty ($_GET) ? '
<div class="bottom_tools">
<ul>
<!--<li><a href="javascript:;" class="OpenDi"><i class="fa fa-pen"></i> Contact Information</a></li>-->

<li><a href="javascript:;" class="AddMethod"><i class="fa fa-plus"></i> Add Contents</a></li>
<li><a href="javascript:;" class="ShowUpdateDi"><i class="fa fa-pen"></i> Update / Delete Contents</a></li>
<li><a href="javascript:;" class="SuppliersShowAdd"><i class="fa fa-users"></i>  Suppliers</a></li>
        <li><a href="javascript:;" class="BranShowAdd"><i class="fa fa-users"></i> Branches</a></li>
        <li><a href="javascript:;" class="ClientShowAdd"><i class="fa fa-users"></i> Clients</a></li>
        <li><a href="https://dashboard.tawk.to/" target="_blank"><i class="fa fa-comments"></i> Chat Dashboard</a></li>
<li><a href="javascript:;" class="MetaUpdate"><i class="fa fa-cogs"></i> About & Settings</a></li>
<li><a href="javascript:;" onclick="Logout();"><i class="fa fa-arrow-left"></i> Logout</a></li>
</ul>
</div>
' : "") . '
';
        return $this->header;
    }

}
//akhram102030