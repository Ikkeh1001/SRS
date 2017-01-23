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

    case "NEW_GROUP":
        $group = new Group();
        $obj = new stdClass();
        $obj->status = "OK";
        $obj->data = $group->get_new_group();
        echo json_encode($obj);
        die();
        break;

    case "NEW_GUID":
        $group = new Group();
        $obj = new stdClass();
        $obj->status = "OK";
        $obj->data = $group->get_new_guid();
        echo json_encode($obj);
        die();
        break;

    case "UPDATE_LOCATION":
        $database = new Database();
        $user = isset($_POST["user"]) ? $_POST["user"] : "";
        $userPass = isset($_POST["userPass"]) ? $_POST["userPass"] : "";
        $group = isset($_POST["group"]) ? $_POST["group"] : "";
        $latlng = isset($_POST["latlng"]) ? $_POST["latlng"] : "";
        $name = isset($_POST["name"]) ? $_POST["name"] : "";
        $message = isset($_POST["message"]) ? $_POST["message"] : "";
        if($database->valid_user($user, $userPass)) {
            $database->update_location($user, $group, $latlng, $name, $message);
            echo json_encode($database->get_locations($user, $group, false));
        } else {
            $obj = new stdClass();
            $obj->data = "auth_error";
            echo json_encode($obj);
        }
        $database->delete_old_locations();
        die();
        break;

    case "GET_LOCATION":
    $database = new Database();
    $group = isset($_POST["group"]) ? $_POST["group"] : "";
    $user = isset($_POST["user"]) ? $_POST["user"] : "";
    $userPass = isset($_POST["userPass"]) ? $_POST["userPass"] : "";
    if($database->valid_user($user, $userPass)){
      echo json_encode($database->get_locations($user, $group, true));
    }
    else {
        $obj = new stdClass();
        $obj->data = "auth_error";
        echo json_encode($obj);
    }
    die();
    break;

    case "UPDATE_NAVIGATION":
    $database = new Database();
    $room  = isset($_POST["room"]) ? $_POST["room"] : "";
    $latlng = isset($_POST["latlng"]) ? $_POST["latlng"] : "";
    $user = isset($_POST["user"]) ? $_POST["user"] : "";
    $userPass = isset($_POST["userPass"]) ? $_POST["userPass"] : "";
    if($database->valid_user($user, $userPass)){
      $database->set_navigation($room,$latlng);
    }
    else {
        $obj = new stdClass();
        $obj->data = "auth_error";
        echo json_encode($obj);
    }
    die();
    break;

    case "GET_NAVIGATION":
    $database = new Database();
    $room  = isset($_POST["room"]) ? $_POST["room"] : "";
    $user = isset($_POST["user"]) ? $_POST["user"] : "";
    $userPass = isset($_POST["userPass"]) ? $_POST["userPass"] : "";
    if($database->valid_user($user, $userPass)){
      echo $database->get_navigation($room);
    }
    else {
        $obj = new stdClass();
        $obj->data = "auth_error";
        echo json_encode($obj);
    }
    die();
    break;
}
