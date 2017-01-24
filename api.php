<?php
/**
 * This is the main API interface. AJAX will communicate with this file mostly.
 */

require_once ("includes.php");

$action = isset($_POST["action"]) ? $_POST["action"] : "";

switch ($action){

    case "GET_LEFT":
        $database = new Database();
        $lang = isset($_POST["lang"]) ? $_POST["lang"] : "";
        echo json_encode($database->get_left($lang));
        die();
        break;

    case "GET_LANG":
        $database = new Database();
        echo json_encode($database->get_lang());
        die();
        break;

    case "SET_WORD":
        $database = new Database();
        $lang = isset($_POST["lang"]) ? $_POST["lang"] : "";
        $word = isset($_POST["word"]) ? $_POST["word"] : "";
        $meaning = isset($_POST["meaning"]) ? $_POST["meaning"] : "";
        $difficulty = isset($_POST["difficulty"]) ? $_POST["difficulty"] : "";
        $timestamp = isset($_POST["timestamp"]) ? $_POST["timestamp"] : "";
        $status = "00".$difficulty."0";
        $database->set_word($lang,$word,$meaning,$status,$timestamp);
        die();
        break;

    case "UPDATE_STATUS":
        $database = new Database();
        $lang = isset($_POST["lang"]) ? $_POST["lang"] : "";
        $word = isset($_POST["word"]) ? $_POST["word"] : "";
        $status = isset($_POST["newstatus"]) ? $_POST["newstatus"] : "";
        $timestamp = isset($_POST["timestamp"]) ? $_POST["timestamp"] : "";
        $database->update_status($lang,$word,$status,$timestamp);
        die();
        break;

    case "SET_LANG":
        $database = new Database();
        $lang = isset($_POST["lang"]) ? $_POST["lang"] : "";
        $database->set_lang($lang);
        die();
        break;
}
