<?php
function SendInfoMail($t,$f,$b) {
    switch($b['location']) {
        case 'AJI1CON':
            $loc = "青島";
            break;
        case 'HSK1CON':
            $loc = "星鹿";
            break;
        default:
            $loc = "不明";
    }
    switch($b['bodytype']) {
        case 'PF':
            $title = "電源情報";
            $msg   = "電源が喪失しました。";
            $subject = sprintf("%s:電源喪失",$loc);
            break;
        case 'PR':
            $title = "電源情報";
            $msg   = "電源が復旧しました。";
            $subject = sprintf("%s:電源復旧",$loc);
            break;
        case 'DO':
            $title = "ドア情報";
            $msg   = "ドアが開きました。";
            $subject = sprintf("%s:扉開放",$loc);
            break;
        case 'DC':
            $title = "ドア情報";
            $msg   = "ドアが閉じました。";
            $subject = sprintf("%s:扉閉鎖",$loc);
            break;
        default:
            break;
    }
    $txt = sprintf("<html><body><h1>%s</h1>\n<h2>%sの%s</h2>\n</body>\n</html>\n",
                   $title,$loc,$msg);
    mb_language("japanese");
    mb_internal_encoding("UTF-8");
    $s = mb_encode_mimeheader(mb_convert_encoding($subject,"JIS","UTF-8"));
    $f2 = sprintf("From: %s",$f);
    $f2 .= "\r\n";
    $f2 .= "Content-type: text/html; charset=UTF-8";
    $a = "-f root@patrol.chun2.ne.jp";
    mail($t,$s,$txt,$f2,$a);
}


?>
