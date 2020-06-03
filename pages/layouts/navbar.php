<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace HEADER;

use Languages\Lang_database as lang;
use PROCESS\prs as prs;

class Page_Banner
{

    var $banner = '';
    var $content = '';
    var $sectors = '';
    var $branches = '';

    public function __construct()
    {
        $delete = false;
        if (isset($_SESSION['AdminLogin']) && isset($_SESSION['AdminId'])) {
            $delete = true;
        }
        $lang = new lang();
        $trans = $lang->Translations();
        $l = $lang->GetLanguage();
        prs::unSetData();
        prs::$table = SECTORS_TABLE;
        foreach (prs::select__record() as $t => $s) {
            $url_name = str_replace(' ', '_', trim($s['title_' . $l]));
            $this->sectors .= '
             <li style="text-align:' . $trans['ALIGN'][$l] . ';">
           
             <a  style="display:inline-block;max-width:70%" href="Sectors/' . $s['id'] . '/' . $url_name . '">' . $s['title_' . $l] . '</a>
           
               ' . (($delete) ? '
              <a href="javascript:;" onclick="DeleteData(\'sectors\',' . $s['id'] . ')" style="float:' . $trans['ALIGN_NATIVE'][$l] . ';"><i class="fa fa-trash"></i></a>
              ' : '') . '
             </li>
        <li class="divider"></li>
            ';
        }
//        prs::unSetData();
//        prs::$table = BRAN_TABLE;
//        foreach (prs::select__record() as $t=>$b){
//            $this->branches = '<li><a href="#" class="drop-text">'.$b['name'].'</a></li>';
//        }
        echo $this->navbar();
    }

    function navbar()
    {
        $delete = false;
        if (isset($_SESSION['AdminLogin']) && isset($_SESSION['AdminId'])) {
            $delete = true;
        }
        $lang = new lang();
        $trans = $lang->Translations();
        $l = $lang->GetLanguage();
        prs::unSetData();
        prs::$table = PAGES_TABLE;
        prs::$select_cond = array('related_to' => 'about');
        $ul_about = $ul_contact = '';
        if (!empty(prs::select__record())) {
            foreach (prs::select__record() as $t => $about) {
                $url_name = str_replace(' ', '_', trim($about['title_' . $l]));
                $ul_about .= '
              <li><a href="Page/' . $about['id'] . '/' . $url_name . '">' . $about['title_' . $l] . '</a>
              ' . (($delete) ? '
              <a href="javascript:;" onclick="DeleteData(\'pages\',' . $about['id'] . ')" style="float:right;"><i class="fa fa-trash"></i></a>
              ' : '') . '
              </li>
            ';

            }
            $ul_about .= ' <li class="divider"></li>';
        }
        $drop_down = false;
        prs::$select_cond = array('related_to' => 'contact');
        if (!empty(prs::select__record())) {
            $drop_down = true;
            foreach (prs::select__record() as $t => $contact) {
                $url_name = str_replace(' ', '_', trim($contact['title_' . $l]));
                $ul_contact .= '
             <li><a href="Page/' . $about['id'] . '/' . $url_name . '">' . $contact['title_' . $l] . '</a>
              ' . (($delete) ? '
              <a href="javascript:;" onclick="DeleteData(\'pages\',' . $contact['id'] . ')" style="float:right;"><i class="fa fa-trash"></i></a>
              ' : '') . '
              </li>
            ';
            }
            $ul_contact .= ' <li class="divider"></li>';
        }

        $this->banner = '

<!-- banner -->
      <div class="header">
    <div class="container">
        <!--logo-->
      
        <!--//logo-->
<nav class="navbar " >   
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar" ></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand logo" href="#"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav" >
                <li class="active" style="float:' . $trans['ALIGN'][$l] . '"><a href="#">' . $trans['HOME'][$l] . '</a></li>
              <li class="dropdown" style="float:' . $trans['ALIGN'][$l] . '">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $trans['ABOUT'][$l] . ' <b class="caret"></b></a>
      <ul class="dropdown-menu" role="menu">
     
      ' . $ul_about . '
        <li style="float:' . $trans['ALIGN'][$l] . '"><a href="Company/Profile/">Company Profile</a></li>
        <li style="float:' . $trans['ALIGN'][$l] . '"><a href="#">' . $trans['TERMS'][$l] . '</a></li>
        <li style="float:' . $trans['ALIGN'][$l] . '"><a href="#">' . $trans['PRIVACY'][$l] . '</a></li>
      </ul>
    </li>
                   <li class="dropdown" style="float:' . $trans['ALIGN'][$l] . ';">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $trans['SECTORS'][$l] . ' <b class="caret"></b></a>
      <ul class="dropdown-menu" role="menu" style="min-width:260px">
    ' . $this->sectors . '
      </ul>
    </li>
     <li style="float:' . $trans['ALIGN'][$l] . '"><a href="Company/BusinessSuppliers/">' . $trans['SUPP_BUSI'][$l] . '</a></li>
    ' . (($drop_down) ? '
    <li class="dropdown" style="float:' . $trans['ALIGN'][$l] . '">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $trans['CONTACT'][$l] . ' <b class="caret"></b></a>
      <ul class="dropdown-menu" role="menu">
    ' . $ul_contact . '
      </ul>
    </li>
    ' : '
    <li style="float:' . $trans['ALIGN'][$l] . '"><a href="Company/Contact/">' . $trans['CONTACT'][$l] . '</a></li>
    ') . '
     
                  
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li style="float:' . $trans['ALIGN'][$l] . '"><a href="javascript:;" class="change_lang"><span class="fa fa-language fa-lg"></span> ' . $trans['CHANGE_LANG'][$l] . '</a></li>
              <!--  <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Search</a></li> -->
            </ul>
        </div>
    </div>
</nav>

        <div class="clearfix"> </div>
    </div>
</div>
 
';
        return $this->banner;
    }

}