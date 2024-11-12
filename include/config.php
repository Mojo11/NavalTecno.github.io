<?php
class Database {
    private $host;
    private $user;
    private $pass;
    private $db;
    public $mysqli;

    public function __construct() {
        $this->db_connect();
    }

    private function db_connect() {
        $this->host = 'localhost';
        $this->user = 'u127478721_navaltecno';
        $this->pass = "&F6aZO]b5]";
        $this->db = 'u127478721_navaltecno';

        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);

        mysqli_set_charset($this->mysqli, 'utf8'); //for hindi font
        // Check connection
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
        return $this->mysqli;
    }

    public function saveRecords($tbName, $dataArr) {
        $fields = array_keys($dataArr);
        $val = $this->mysqli->query("insert into $tbName (`" . implode('`,`', $fields) . "`) values('" . implode("','", $dataArr) . "')");
        //echo "insert into $tbName (`".implode('`,`', $fields)."`) values('".implode("','", $dataArr)."')"; 
        return $val;
    }

    public function saveRecordsReturnId($tbName, $dataArr) {
        $fields = array_keys($dataArr);
        $val = $this->mysqli->query("insert into $tbName (`" . implode('`,`', $fields) . "`) values('" . implode("','", $dataArr) . "')");
        //echo "insert into $tbName (`".implode('`,`', $fields)."`) values('".implode("','", $dataArr)."')"; 
        return $this->mysqli->insert_id;
    }

    public function singleRead($tbName, $fieldArr, $col, $colval) {
        if ($fieldArr)
            $field = implode(',', $fieldArr);
        else
            $field = '*';
        $result = $this->mysqli->query("SELECT $field FROM $tbName WHERE $col= '" . $colval . "'");
        //echo "SELECT $field FROM $tbName WHERE $col= '".$colval."'";
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    
    public function singleReadWithoutId($tbName, $fieldArr) {
        if ($fieldArr)
            $field = implode(',', $fieldArr);
        else
            $field = '*';
        $result = $this->mysqli->query("SELECT $field FROM $tbName");
        //echo "SELECT $field FROM $tbName WHERE $col= '".$colval."'";
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    public function fetechRecord($tbName, $fieldArr, $condiArr) {
        if ($fieldArr)
            $field = implode(',', $fieldArr);
        else
            $field = '*';
        $columns = array();
        foreach ($condiArr as $name => $value) {
            $columns[] = "$name = '$value'";
        }
        if ($columns)
            $whereCond = implode(" and ", $columns);
        else
            $whereCond = '1';
        $result = $this->mysqli->query("SELECT $field FROM $tbName WHERE $whereCond");
        //echo "SELECT $field FROM $tbName WHERE $whereCond";
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function dbRowUpdate($table_name, $form_data, $col, $value) {
        $updates = array();
        foreach ($form_data as $key => $val) {
            $updates[] = "$key = '$val'";
        }
        $implodeArray = implode(',', $updates);
        $sql = $this->mysqli->query("update $table_name set " . implode(',', $updates) . " where $col='$value'");
        //echo "update $table_name set " . implode(',', $updates) . " where $col='$value'";
        return $a = 1;
    }
    function updateUsingQuery($query) {
        if($this->mysqli->query($query)){
            return $a = 1;
        } else {
            return $a = 0;
        }
    }

    public function read($table, $fieldArr, $condiArr, $orderby, $limit) {
        if ($fieldArr)
            $field = implode(',', $fieldArr);
        else
            $field = '*';
        $columns = array();
        foreach ($condiArr as $name => $value) {
            $columns[] = "$name = '$value'";
        }
        if ($limit)
            $limit = "limit $limit";
        else
            $limit = '';

        if ($columns)
            $whereCond = implode(" and ", $columns);
        else
            $whereCond = '1';

        if ($orderby)
            $order = $orderby;
        else
            $order = '';
        $result = $this->mysqli->query("SELECT $field FROM $table WHERE $whereCond $order $limit");
        //echo "SELECT $field FROM $table WHERE $whereCond $order $limit";
        $userArr = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $userArr[] = $row;
        }
        return $userArr;
    }

    function runQuery($query) {
        $result = $this->mysqli->query($query);
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset;
    }
    
    function runSingleQuery($query) {
        $result = $this->mysqli->query($query);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function numRows($query) {
        $result = $this->mysqli->query($query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

    public function escape_string($var) {
        $return = mysqli_real_escape_string($this->mysqli, $var);
        return $return;
    }

//if(isset($_POST) & !empty($_POST)){
    //	$fname = $database->escape_string($_POST['fname']);
    //	$lname = $database->escape_string($_POST['lname']);
    //	$email = $database->escape_string($_POST['email']);
    //}
    public function delete($id, $table) {
        $query = "DELETE FROM $table WHERE id = $id";
        //echo "DELETE FROM $table WHERE id = $id";
        $result = $this->mysqli->query($query);
        if ($result == false) {
            $error = 'Error: cannot delete';
            return false;
        } else {
            return true;
        }
    }
    public function delete_query($query) {
        $result = $this->mysqli->query($query);
        if ($result == false) {
            $error = 'Error: cannot delete';
            return $error;
        } else {
            return true;
        }
    }

    public function getLastInsertId() {
        return $last_id = $this->mysqli->insert_id;
    }

    public function textShort($str, $type, $postId) {
        if ($type == 'description') {
            $string = strip_tags($str);
            if (strlen($string) > 200) {
                $stringCut = substr($string, 0, 200);
                $endPoint = strrpos($stringCut, ' ');

                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $string .= '... <a href="#details" class="scroll-to">More info</a>';
            }
        } else {
            $string = strip_tags($str);
            if (strlen($string) > 30) {
                $stringCut = substr($string, 0, 30);
                $endPoint = strrpos($stringCut, ' ');
                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            }
        }
        return $string;
    }

    public function postDate($pdate) {
        $seconds = time() - strtotime($pdate);
        $minutes = $seconds / 60;
        $hours = $seconds / 3600;
        $days = $seconds / 86400;
        $weeks = $seconds / 604800;

        if (floor($seconds) <= 60) {
            $time = floor($seconds) . " Sec";
        } else if (floor($minutes) <= 60) {
            $time = floor($minutes) . " Min";
        } else if (floor($hours) <= 24) {
            $time = floor($hours) . " Hours";
        } else if (floor($days) <= 7) {
            $time = floor($days) . " Days";
        } else {
            $time = floor($weeks) . " Weeks";
        }
        return $time;
    }
    
    public function createFolder($path) {
        if (!file_exists($path)) {
            mkdir($path, 0755, TRUE);
        }
    }

    public function createThumbnail($sourcePath, $targetPath, $file_type, $thumbWidth, $thumbHeight) {
        $source = imagecreatefromjpeg($sourcePath);
        $width = imagesx($source);
        $height = imagesy($source);
        $tnumbImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresampled($tnumbImage, $source, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
        if (imagejpeg($tnumbImage, $targetPath, 90)) {
            imagedestroy($tnumbImage);
            imagedestroy($source);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function noreplymail($to,$subject,$message){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Do Not Reply<noreply@highendfree.com>' . "\r\n";
        //$headers .= 'Cc: mkbkit@gmail.com' . "\r\n";
        mail($to,$subject,$message,$headers);
    } 
    public function setProfilePicture($picture){
        if($picture != ''){
            $picture = 'upload/'.$picture;
        } else {
            $picture = 'assets/img/Blank-profile.png';
        }
        return $picture;
    }
    public function getYouTubeVideoId($pageVideUrl) {
        $link = $pageVideUrl;
        $video_id = explode("?v=", $link);
        if (!isset($video_id[1])) {
            $video_id = explode("youtu.be/", $link);
        }
        $youtubeID = $video_id[1];
        if (empty($video_id[1])) $video_id = explode("/v/", $link);
        $video_id = explode("&", $video_id[1]);
        $youtubeVideoID = $video_id[0];
        if ($youtubeVideoID) {
            return $youtubeVideoID;
        } else {
            return false;
        }
    }
    public function getYouTubeId($url) {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        $youtube_id = $match[1];
        return $youtube_id;
    }
    public function createYoutubeVideoLowResThumbnail($youtubeID){
        return 'https://img.youtube.com/vi/' . $youtubeID . '/sddefault.jpg';
    }
    public function createYoutubeVideoMediumResThumbnail($youtubeID){
        return 'https://img.youtube.com/vi/' . $youtubeID . '/mqdefault.jpg';
    }
    public function createYoutubeVideoMaxResThumbnail($youtubeID){
        return 'https://img.youtube.com/vi/' . $youtubeID . '/maxresdefault.jpg';
    }
    public function createYoutubeVideoHqDefaultThumbnail($youtubeID){
        return 'https://img.youtube.com/vi/' . $youtubeID . '/hqdefault.jpg';
    }
    public function checkYoutubeUrl($url){
        $url_parsed_arr = parse_url($url);
        if ($url_parsed_arr['host'] == "www.youtube.com" && $url_parsed_arr['path'] == "/watch" && substr($url_parsed_arr['query'], 0, 2) == "v=" && substr($url_parsed_arr['query'], 2) != "") {
            return 1;
        }  else {
            return 0;
        }
    }
    public function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';
        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }
        return $base_url;
    }
    public function webUri(){
       return "https://".$_SERVER['SERVER_NAME'];
    }
    public function dirUri(){
       return "https://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/';
    }
}

?>