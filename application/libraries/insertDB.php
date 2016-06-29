<?php
$nickname = htmlentities(strip_tags($_POST['nickname']), ENT_QUOTES);
$message = htmlentities(strip_tags($_POST['message']), ENT_QUOTES);
$quitclaimID = $_POST['quitclaimID'];
$plainmessage = $message;

            $ci =& get_instance();
$now = time();
$timeposted = unix_to_human($now);
$data = array('qc_sender_id'=>$nickname,
             'qc_user_quitclaim_id'=>$quitclaimID,
             'qc_comment'=>$plainmessage,
             'qc_timestamp'=>$timeposted);

$this->Model_user->post_quitclaim_comment($data);
console.log('pota');
?>
