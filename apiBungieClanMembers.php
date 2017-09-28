<?php


// ##########################################
// ###                                    ###
// ###  CLAN MEMBERS FROM BUNGIE API      ###
// ###  v1.4                              ###
// ###  @L0r3notData                      ###
// ###                                    ###
// ##########################################


// ##### CAPTURE VIRTUAL SERVERS DOCUMENT ROOT #####
$siteRoot = $_SERVER['DOCUMENT_ROOT'];


// ##### READ API KEY AND GROUP NUMBER FROM FILE ####
require 'apiKeys.php';

// ##### PRE-SET SOME STRINGS #####
$pageCnt = 0;
$continue = 1;
$cntMembers = 0;
$memList = '';


// ##### INCREMENT CURRENT PAGE UP #####
$pageCnt++;


// ##### CURL A MEMBER PAGE FROM BUNGIE IN JSON FORMAT (IN A BUFFER) #####	
ob_start();
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://www.bungie.net/Platform/GroupV2/$bungieClan/Members/?currentPage=1");
curl_setopt($curl, CURLOPT_HTTPHEADER, array('X-API-Key: ' . $authKeyBungie, 'Accept: application/json'));
$allUsers = curl_exec($curl);
curl_close($curl);
$userList = ob_get_contents();
ob_end_clean();


// ##### GET COUNT OF MEMBERS ON PAGE  #####
$getUsers = json_decode($userList,true);
$cntUser = 0;
$cntUser = count($getUsers['Response']['results']);
$cntMembers = $cntMembers + $cntUser;


##### GET EACH MEMBERS DISPLAYNAME FROM PAGE #####
$x = 0;
while($x < $cntUser) {
	$userTag = $getUsers['Response']['results'][$x]['destinyUserInfo']['displayName'];
	$x++;
	$memList = "$memList $userTag<br>";
}



// ##### EXPLODE LIST INTO ARRAY, SORT, IMPLODE BACK TO STRING #####
$memList = explode("<br>", $memList);
sort($memList, SORT_NATURAL | SORT_FLAG_CASE);
$finalMembList = implode("<br> ", $memList);


// ##### BUILD INFO STRINGS #####
$titleURL = '<a href="https://www.bungie.net/en/ClanV2?groupid=913961">EPIC</a><br>';
$titleCount = "Members: $cntMembers<br>";


// ##### WRITE MEMBER LIST TO FILE #####
$theNow = time();
$theNowTwo = "$theNow<br>";
$myFile = "$siteRoot/members/bungie/cache/clan.htm";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, $theNowTwo);
fwrite($fh, $titleURL);
fwrite($fh, $titleCount);
fwrite($fh, $finalMembList);
fclose($fh);


// ##### PRINT TO WEB PAGE BY READING CACHE FILE #####
require "$siteRoot/members/bungie/cacheBungieClan.php";


?>












