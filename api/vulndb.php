<?php
include_once 'database.php';
include_once 'vuln.php';
session_start();
$database = new Database();
$db = $database->getConnection();
$vuln = new Vuln($db);
$more = "";

if(isset($_POST['insert'])){ 
    if(($_POST['cve'])!=""){ 
        $vuln->cve = $_POST['cve'];
        $vuln->prod = $_POST['product'];
        $vuln->ver = $_POST['version'];
        $vuln->port = $_POST['port'];
        $vuln->author = $_POST['author'];
        $vuln->type = $_POST['type'];
        $vuln->date = $_POST['date'];
        $vuln->desc = $_POST['desc'];
        if($vuln->insertVuln()){
            $vuln_arr=array(
                "status" => true,
                "message" => "vulnerability added",
            );
        }
        else{
            $vuln_arr=array(
                "status" => false,
                "message" => "an exception was encountered"
            );
        }
    }
    else{
        $vuln_arr=array(
            "status" => false,
            "message" => "cve required"
        );
    }
}

if(isset($_POST['update'])){
    if(($_POST['cve'])!=""){ 
        $vuln->cve = $_POST['cve'];
        $vuln->prod = $_POST['product'];
        $vuln->ver = $_POST['version'];
        $vuln->port = $_POST['port'];
        $vuln->author = $_POST['author'];
        $vuln->type = $_POST['type'];
        $vuln->date = $_POST['date'];
        $vuln->desc = $_POST['desc'];
        if($vuln->updateVuln()){
            $vuln_arr=array(
                "status" => true,
                "message" => "vulnerability updated",
            );
        }
        else{
            $vuln_arr=array(
                "status" => false,
                "message" => "an exception was encountered"
            );
        }
    }
    else{
        $vuln_arr=array(
            "status" => false,
            "message" => "cve required"
        );
    }
}
if(isset($_POST['delete'])){ 
    if(($_POST['cve'])!=""){
        $vuln->cve = $_POST['cve'];
        if($vuln->deleteVuln()){
            $vuln_arr=array(
                "status" => true,
                "message" => "vulnerability deleted",
            );
        }
        else{
            $vuln_arr=array(
                "status" => false,
                "message" => "an exception was encountered"
            );
        }
    }
    else{
        $vuln_arr=array(
            "status" => false,
            "message" => "cve required"
        );
    }
}
if(isset($_POST['find'])){ 
    if(($_POST['cve'])!=""){
        $vuln->cve = $_POST['cve'];
        $res = $vuln->findVuln();
        if(count($res)>1){
            $vuln_arr=array(
                "status" => true,
                "message" => "vulnerability found"
            );
            $more = $more."&cve=".$res['cve']
                    ."&product=".$res['product']
                    ."&version=".$res['version']
                    ."&port=".$res['port']
                    ."&author=".$res['author']
                    ."&type=".$res['type']
                    ."&date=".$res['date']
                    ."&desc=".$res['description'];
        }
        else{
            $vuln_arr=array(
                "status" => false,
                "message" => "vulnerability not found"
            );
        }
    }
    else{
        $vuln_arr=array(
            "status" => false,
            "message" => "cve required"
        );
    }
    
}
if(isset($_POST['first'])){ 
    $res = $vuln->firstVuln();
    if(count($res)>1){
        $vuln_arr=array(
            "status" => true,
            "message" => "vulnerability found"
        );
        $more = $more."&cve=".$res['cve']
                ."&product=".$res['product']
                ."&version=".$res['version']
                ."&port=".$res['port']
                ."&author=".$res['author']
                ."&type=".$res['type']
                ."&date=".$res['date']
                ."&desc=".$res['description'];
    }
    else{
        $vuln_arr=array(
            "status" => false,
            "message" => "vulnerability not found"
        );
    }
    
}
if(isset($_POST['last'])){ 
    $res = $vuln->lastVuln();
    if(count($res)>1){
        $vuln_arr=array(
            "status" => true,
            "message" => "vulnerability found"
        );
        $more = $more."&cve=".$res['cve']
                ."&product=".$res['product']
                ."&version=".$res['version']
                ."&port=".$res['port']
                ."&author=".$res['author']
                ."&type=".$res['type']
                ."&date=".$res['date']
                ."&desc=".$res['description'];
    }
    else{
        $vuln_arr=array(
            "status" => false,
            "message" => "vulnerability not found"
        );
    }
    
}
if(isset($_POST['next'])){ 
    if(($_POST['cve'])!=""){
        $vuln->cve = $_POST['cve'];
        $res = $vuln->nextVuln();
        if(count($res)>1){
            $vuln_arr=array(
                "status" => true,
                "message" => "vulnerability found"
            );
            $more = $more."&cve=".$res['cve']
                    ."&product=".$res['product']
                    ."&version=".$res['version']
                    ."&port=".$res['port']
                    ."&author=".$res['author']
                    ."&type=".$res['type']
                    ."&date=".$res['date']
                    ."&desc=".$res['description'];
        }
        else{
            $vuln_arr=array(
                "status" => false,
                "message" => "vulnerability not found"
            );
        }
    }
    else{
        $vuln_arr=array(
            "status" => false,
            "message" => "cve required"
        );
    }
}
if(isset($_POST['prev'])){ 
    if(($_POST['cve'])!=""){
        $vuln->cve = $_POST['cve'];
        $res = $vuln->preVuln();
        if(count($res)>1){
            $vuln_arr=array(
                "status" => true,
                "message" => "vulnerability found"
            );
            $more = $more."&cve=".$res['cve']
                    ."&product=".$res['product']
                    ."&version=".$res['version']
                    ."&port=".$res['port']
                    ."&author=".$res['author']
                    ."&type=".$res['type']
                    ."&date=".$res['date']
                    ."&desc=".$res['description'];
        }
        else{
            $vuln_arr=array(
                "status" => false,
                "message" => "vulnerability not found"
            );
        }
    }
    else{
        $vuln_arr=array(
            "status" => false,
            "message" => "cve required"
        );
    }
}
header("Location: ../index.php?response=".$vuln_arr['message'].$more); 
?>