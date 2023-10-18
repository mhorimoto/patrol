<?php
require_once("SendInfoMail.php");
$t = "ytakao@holly-linux.com,masafumi.horimoto@gmail.com,smyrm.s8@gmail.com,seiji-s@po.chun2.ne.jp,abajyou@gmail.com,raise-the-fireworks.grandly@docomo.ne.jp,fly-n.and-i.k-9203@ezweb.ne.jp,i-chocorg_k.84g@ezweb.ne.jp";
$f = "監視通知 <patrol@patrol.chun2.ne.jp>";
$fp = fopen("/var/log/httpd/patrol/data.log","a");
$P = $_POST['P'];
$H = $_POST['H'];
$b['location'] = $H;
$b['bodytype'] = $P;
switch($P) {
    case "PF":
        sprintf($b['subject'],"%s:電源喪失",$H);
        break;
    case "PR":
        sprintf($b['subject'],"%s:電源復旧",$H);
        break;
    case "DO":
        sprintf($b['subject'],"%s:扉開放",$H);
        break;
    case "DC":
        sprintf($b['subject'],"%s:扉閉鎖",$H);
        break;
    default:
        $b['subject'] = "";
}
SendInfoMail($t,$f,$b);
if ($fp) {
    fprintf($fp,"%s - %s\n",$H,$P);
    fclose($fp);
} else {
    printf("Can not write\n");
}
?>
