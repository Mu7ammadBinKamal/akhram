<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

use Admins\AdminFunctions as AdminFun;
use Admins\ProjectsItems as items;
use Admins\Services as ser;
use Fun\functions as fun;

if (isset($_GET['formAction'])) {

    $type = $_GET['formAction'];
    $admin = new AdminFun();
    $ser = new ser();
    $item = new items();
    switch ($type) {
        case 'ContactInfo':
            if (isset($_POST['phone'])) {
                $phone = $_POST['phone'];
                for ($i = 0; $i < count($phone); $i++) {
                    $admin->inputData = array(
                        'data_type' => 'phone',
                        'data' => $phone[$i],
                    );
                    $admin->AddContactInfo();
                }
            }
            if (isset($_POST['facebook'])) {
                $facebook = $_POST['facebook'];
                for ($i = 0; $i < count($facebook); $i++) {
                    $admin->inputData = array(
                        'data_type' => 'facebook',
                        'data' => $facebook[$i],
                    );
                    $admin->AddContactInfo();
                }
            }
            if (isset($_POST['twitter'])) {
                $facebook = $_POST['twitter'];
                for ($i = 0; $i < count($facebook); $i++) {
                    $admin->inputData = array(
                        'data_type' => 'twitter',
                        'data' => $facebook[$i],
                    );
                    $admin->AddContactInfo();
                }
            }
            if (isset($_POST['email'])) {
                $facebook = $_POST['email'];
                for ($i = 0; $i < count($facebook); $i++) {
                    $admin->inputData = array(
                        'data_type' => 'email',
                        'data' => $facebook[$i],
                    );
                    $admin->AddContactInfo();
                }
            }
            if (isset($_POST['insta'])) {
                $facebook = $_POST['insta'];
                for ($i = 0; $i < count($facebook); $i++) {
                    $admin->inputData = array(
                        'data_type' => 'insta',
                        'data' => $facebook[$i],
                    );
                    $admin->AddContactInfo();
                }
            }
            if (isset($_POST['youtube'])) {
                $facebook = $_POST['youtube'];
                for ($i = 0; $i < count($facebook); $i++) {
                    $admin->inputData = array(
                        'data_type' => 'youtube',
                        'data' => $facebook[$i],
                    );
                    $admin->AddContactInfo();
                }
            }

            break;
        case 'metaData':
            if (isset($_POST['title_ar']) && isset($_POST['title_en'])) {
                $title_ar = $_POST['title_ar'];
                $title_en = $_POST['title_en'];
                $admin->inputData = array(
                    'data_type' => 'web_title',
                    'data_ar' => $title_ar,
                    'data_en' => $title_en
                );
                $admin->AddCompanyInfo();
            }
            if (isset($_POST['about_ar']) && isset($_POST['about_en'])) {
                if ($_POST['about_ar'] != '' && $_POST['about_en'] != '') {
                    $title_ar = $_POST['about_ar'];
                    $title_en = $_POST['about_en'];
                    $admin->inputData = array(
                        'data_type' => 'background',
                        'data_ar' => $title_ar,
                        'data_en' => $title_en
                    );
                    $admin->AddCompanyInfo();
                }
            }
            break;
        case 'services':
            if (
                isset($_POST['service_en']) && $_POST['service_en'] != ''
                && isset($_POST['service_ar']) && $_POST['service_ar'] != ''
                && isset($_POST['city'])
                && isset($_POST['about_ar']) && $_POST['about_ar'] != ''
                && isset($_POST['about_en']) && $_POST['about_en'] != ''
            ) {
                $ser->inputData = array(
                    'service_ar' => $_POST['service_ar'],
                    'service_en' => $_POST['service_en'],
                    'about_service_ar' => $_POST['about_ar'],
                    'about_service_en' => $_POST['about_en'],
                    'city_id' => $_POST['city'],
                );
                $ser->AddServices();
            }
            break;
        case 'Projects':
            print_r($_REQUEST);
            if (
                isset($_POST['title_ar'])
                && isset($_POST['title_en'])
                && isset($_POST['city'])
                && isset($_POST['service_list'])
                && isset($_POST['start_date'])
                && isset($_POST['end_date'])
                && isset($_POST['client_id'])
                && isset($_POST['con_type'])
                && isset($_POST['ads'])
            ) {
                $item->inputData = array(
                    'title_ar' => $_POST['title_ar'],
                    'title_en' => $_POST['title_en'],
                    'city_id' => $_POST['city'],
                    'service_id' => $_POST['service_list'],
                    'date_start' => $_POST['start_date'],
                    'date_end' => $_POST['end_date'],
                    'client_id' => $_POST['client_id'],
                    'ProjectType' => 1,
                    'contract_type' => $_POST['con_type'],
                    'advisor' => $_POST['ads'],
                );
                $item->AddProjectsItems();
            }
            break;
        case 'items':

            if (
                isset($_POST['title_ar'])
                && isset($_POST['title_en'])
                && isset($_POST['service_list'])
                && isset($_FILES['image'])
            ) {
                $item->inputData = array(
                    'name_ar' => $_POST['title_ar'],
                    'name_en' => $_POST['title_en'],
                    'service_id' => $_POST['service_list'],
                    'photo' => $_FILES['image'],
                );
                $item->AddProjectsItems('items');
            }
            break;
        case 'media':
            if (
                isset($_POST['MediaType'])
                && isset($_POST['name_ar'])
                && isset($_POST['name_en'])
                && isset($_FILES['image'])
            ) {
                if (isset($_POST['media_id'])) {
                    $media_id = $_POST['media_id'];
                } else {
                    $media_id = 0;
                }
                $admin->inputData = array(
                    'media_type' => $_POST['MediaType'],
                    'photo' => $_FILES['image'],
                    'name_ar' => $_POST['name_ar'],
                    'name_en' => $_POST['name_en'],
                    'media_id' => $media_id,
                );
                $admin->AddMedia();
            }

            break;
        case 'client':
            if (isset($_POST['name_ar']) && isset($_POST['name_en'])) {
                $admin->inputData = array(
                    'name_ar' => $_POST['name_ar'],
                    'name_en' => $_POST['name_en']
                );
                $admin->AddClients();
            }
            break;
    }

    exit();
} else if (isset($_GET['Load'])) {
    $type = $_GET['Load'];
    switch ($type) {
        case 'services':
            $fun = new fun();
            echo $fun->ServicesListAsOptions(false);
            break;
        case 'clients':
            $fun = new fun();
            echo $fun->ClientsListAsOptions(false);
            break;
        case 'projects':
            $fun = new fun();
            echo $fun->ProjectsListAsOptions(false);
            break;
        case 'items':
            $fun = new fun();
            echo $fun->ItemsListAsOptions(false);
            break;
    }
}