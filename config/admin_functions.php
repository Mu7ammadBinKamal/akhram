<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace Admins;

use PROCESS\prs as prs;

class AdminFunctions
{

    var $inputData = array();
    var $additionalData = array();
    var $inputCont = array();
    var $inputID = 0;

    function AddContactInfo()
    {
        prs::unSetData();
        prs::$table = CONTACT_INFO_TABLE;
        prs::$data_in = $this->inputData;
        prs::add__record();
    }

    function AddCompanyInfo()
    {
        prs::unSetData();
        prs::$table = COMPANY_TABLE;
        prs::$select_cond = array('data_type' => $this->inputData['data_type']);
        if (!empty(prs::select__record())) {
            prs::$cond = array('data_type' => $this->inputData['data_type']);
            prs::delete__record();
        }
        prs::$data_in = $this->inputData;
        prs::add__record();
    }

    function AddMedia()
    {
        $folders = array(
            'projects' => 'project_media',
            'slides' => 'slides',
            'items' => 'equipments',
            'clients' => 'clients',
        );
        $file = $this->inputData['photo'];
        $name = $file['name'];
        $tmp = $file['tmp_name'];
        $type = $file['type'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $new_name = time() . uniqid() . '-ALAKHRAM.' . $ext;
        if ($this->inputData['media_type'] == 'projects') {
            $dir = DIR . DS . 'public' . DS . 'images' . DS . $folders[$this->inputData['media_type']] . DS . $this->inputData['media_id'];
        } else {
            $dir = DIR . DS . 'public' . DS . 'images' . DS . $folders[$this->inputData['media_type']];
        }
        if (!is_dir($dir)) {
            mkdir($dir, 777);
        }
        if (in_array($type, prs::$accepted_files)) {
            if (move_uploaded_file($tmp, $dir . DS . $new_name)) {
                prs::unSetData();
                prs::$table = MEDIA_TABLE;
                prs::$data_in = array(
                    'type' => $this->inputData['media_type'],
                    'name_ar' => $this->inputData['name_ar'],
                    'name_en' => $this->inputData['name_en'],
                    'url' => $new_name,
                    'media_id' => $this->inputData['media_id'],
                );
                prs::add__record();
            }
        }
    }

    function AddClients()
    {
        prs::unSetData();
        prs::$table = CLIENTS_TABLE;
        prs::$data_in = $this->inputData;
        prs::add__record();
    }
}

class Services extends AdminFunctions
{
    function AddServices()
    {
        prs::unSetData();
        prs::$table = SERVICES_TABLE;
        prs::$data_in = $this->inputData;
        prs::add__record();
    }

    function UpdateServices()
    {

    }

    function DeleteServices()
    {
        prs::unSetData();
        prs::$table = SERVICES_STR_TABLE;
        prs::$cond = array('sid' => $this->inputID);
        prs::delete__record();
        prs::unSetData();;
        prs::$table = SERVICES_TABLE;
        prs::$cond = array('id' => $this->inputID);
        prs::delete__record();
    }
}

class ProjectsItems extends AdminFunctions
{
    function AddProjectsItems($project_type = 'projects')
    {
        if ($project_type == 'projects') {
            prs::unSetData();
            prs::$table = PROJECTS_TABLE;
            prs::$data_in = $this->inputData;
            prs::add__record();
        } else {
            $file = $this->inputData['photo'];
            $name = $file['name'];
            $tmp = $file['tmp_name'];
            $type = $file['type'];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $new_name = time() . uniqid() . '-ALAKHRAM.' . $ext;
            $dir = DIR . DS . 'public' . DS . 'images' . DS . 'equipments' . DS . $new_name;
            if (in_array($type, prs::$accepted_files)) {
                if (move_uploaded_file($tmp, $dir)) {
                    prs::unSetData();
                    prs::$table = EQUI_TABLE;
                    prs::$data_in = array(
                        'name_ar' => $this->inputData['name_ar'],
                        'name_en' => $this->inputData['name_en'],
                        'service_id' => $this->inputData['service_id'],
                        'photo' => $new_name,
                    );
                    prs::add__record();
                }
            }
        }
    }

    function UpdateProjectItems()
    {

    }

    function DeleteProjectItems()
    {

    }

}