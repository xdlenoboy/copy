<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/core/database.php');
if(isset($_REQUEST['ID'])){
$id = (int)filter_var($_REQUEST["ID"], FILTER_SANITIZE_NUMBER_INT, FILTER_NULL_ON_FAILURE);
} else {
require_once($_SERVER['DOCUMENT_ROOT'].'/My/Home.php');exit;
}
if(
    $id === 3 ||
    $id === 68
) {
    // echo "<img style='position: fixed;z-index: -999;width: 100%;height: 100%;margin: -8;' src='https://media.discordapp.net/attachments/1131541893419900939/1203673218901213244/attachment.png?ex=65d1f30a&is=65bf7e0a&hm=6f793d3d9115010d666df9809f75b41450f50355277f56ed25eb7ea871a29e54&=&format=webp&quality=lossless'><h1>This page (user $id) has been eaten by EAT SLEEP MADBLOX fatass.</h1>";exit;
}


$banned = false;
$q = $db->prepare("SELECT * FROM bans WHERE userid = :id");
$q->bindParam(':id', $id, PDO::PARAM_INT);
$q->execute();
$ban = $q->fetch();
if($ban && $ban["typeBan"] !== "None") {
    header('location: /Error.aspx?code=404');exit;
}
if ("1"=="2") {
    require_once($_SERVER['DOCUMENT_ROOT'].'/My/Home.php');
} else {
    $searchuser = $db->prepare("SELECT * FROM users WHERE id=?");
    $searchuser->execute([$id]);
    $search = $searchuser->rowCount();
    require_once($_SERVER['DOCUMENT_ROOT'].'/core/head.php');
    if($search < 1){
        header("location: /Browse.aspx");
        exit;
    } else {
        $user = $searchuser->fetch(PDO::FETCH_ASSOC);
        $blurb = filterText(htmlspecialchars($user['blurb']));
	$blurb = str_replace('{tix}', $user["tickets"], $blurb);
	$blurb = str_replace('{madbux}', $user["mlgbux"], $blurb);
        if($loggedin == "yes"){ $findifyouviewedq = $db->prepare("SELECT * FROM profileviews WHERE user_from = ? AND user_to = ?");
        $findifyouviewedq->execute([$_USER['id'], $user['id']]);
        $findifyouviewed = $findifyouviewedq->rowCount();

        if ($findifyouviewed < 1) {
            $viewq = $db->prepare("INSERT IGNORE INTO profileviews (id, user_from, user_to, timeViewed) VALUES (NULL, :me, :him, NOW())");
            $viewq->execute(array(":me" => $_USER['id'], ":him" => $user['id']));
        } }

        $profileviewsq = $db->prepare("SELECT * FROM profileviews WHERE user_to = ?");
        $profileviewsq->execute([$id]);
        $profileviews = $profileviewsq->rowCount();

        $profileviewslastweekq = $db->prepare("SELECT * FROM profileviews WHERE timeViewed >= NOW() - INTERVAL 1 WEEK AND timeViewed < NOW() AND user_to = ?");
        $profileviewslastweekq->execute([$id]);
        $profileviewslastweek = $profileviewslastweekq->rowCount();

        $wipeoutslastweekq = $db->prepare("SELECT * FROM wipeouts WHERE date >= NOW() - INTERVAL 1 WEEK AND date < NOW() AND userid = ?");
        $wipeoutslastweekq->execute([$id]);
        $wipeoutslastweek = $wipeoutslastweekq->rowCount();

        $wipeoutsq = $db->prepare("SELECT * FROM wipeouts WHERE userid = ?");
        $wipeoutsq->execute([$id]);
        $wipeouts = $wipeoutsq->rowCount();

        $knockoutslastweekq = $db->prepare("SELECT * FROM knockouts WHERE date >= NOW() - INTERVAL 1 WEEK AND date < NOW() AND userid = ?");
        $knockoutslastweekq->execute([$id]);
        $knockoutslastweek = $knockoutslastweekq->rowCount();

        $knockoutsq = $db->prepare("SELECT * FROM knockouts WHERE userid = ?");
        $knockoutsq->execute([$id]);
        $knockouts = $knockoutsq->rowCount();

        $placevisitsq = $db->prepare("SELECT gv.* FROM gamevisits gv JOIN games g ON gv.gameid = g.id WHERE g.creatorid = ?;");
        $placevisitsq->execute([$id]);
        $placevisits = $placevisitsq->rowCount();   
        
        $placevisitsq2 = $db->prepare("SELECT gv.* FROM gamevisits gv JOIN games g ON gv.gameid = g.id WHERE g.creatorid = ? AND whenjoined >= NOW() - INTERVAL 1 WEEK AND whenjoined < NOW();");
        $placevisitsq2->execute([$id]);
        $placevisits2 = $placevisitsq2->rowCount();
        
        $forumpostsq = $db->prepare("SELECT * FROM forum WHERE author=?");
        $forumpostsq->execute([$id]);
        $forumposts = $forumpostsq->rowCount();

        $oneWeekAgo = time() - 604800;
        $currentTimestamp = time();

        $forumpostsq2 = $db->prepare("
        SELECT * 
        FROM forum 
        WHERE author = ? 
        AND time_posted >= ? 
        AND time_posted < ?
        ");

        $forumpostsq2->execute([$id, $oneWeekAgo, $currentTimestamp]);
        $forumposts2 = $forumpostsq2->rowCount();

        $frs = $db->prepare("SELECT * FROM friends WHERE user_to=:id AND areFriends=1 OR user_from=:id AND areFriends=1");
        $frs->execute([':id' => $id]);
        $friends = $frs->rowCount();

        $frs2 = $db->prepare("SELECT * FROM friends WHERE user_to=:id AND areFriends=1 OR user_from=:id AND areFriends=1 AND timeAdded >= NOW() - INTERVAL 1 WEEK AND timeAdded < NOW()");
        $frs2->execute([':id' => $id]);
        $friends2 = $frs2->rowCount();

    }
?>


<style>
#ProfilePane {
    background: <?php if($_USER["theme"] === "dark") { echo "transparent"; } else { echo "lightsteelblue"; } ?>;
}
#UserPlaces h4 {
    background-color: #6e99c9;
    color: #fff;
    font-family: Verdana,Sans-Serif;
    font-size: 1.4em;
    font-weight: 400;
    letter-spacing: .1em;
    line-height: 1.5em;
    margin: 0;
}
#UserAssetsPane #UserAssets h4, #UserBadgesPane #UserBadges h4, #UserStatisticsPane #UserStatistics h4, #FavoritesPane #Favorites h4 {
    background-color: #ccc;
    border-bottom: solid 1px #000;
    color: #333;
    font-family: Comic Sans MS,Verdana,Sans-Serif;
    margin: 0;
    text-align: center;
}
#FriendsPane, #FavoritesPane {
    clear: right;
    margin: 10px 0 0;
    background: #fff;
}
#FavoritesPane{
    color: #000;
	border: solid 1px #000;
}
#FavoritesContent {
    background: #eee;
}
#UserPlaces .PanelFooter, #Favorites .PanelFooter {
    background-color: #fff;
    border-top: solid 1px #000;
    color: #333;
    font-family: Verdana,Sans-Serif;
    margin: 0;
    padding: 3px;
    text-align: center;
}
</style>
<div id="Body">
<div id="UserContainer">
	<div id="LeftBank">
		<div id="ProfilePane">
			<table width="442" cellspacing="0" cellpadding="6">
				<tbody>
					<tr>
						<td>
														<span class="Title"><?=htmlspecialchars($user['username'])?></span><br>
								 
							<?php
							 $onlinetext = ($user['lastseen'] + 300 >= time()) ? "<span class='UserOnlineMessage'>[ Online: Website ]</span>" : "<span class='UserOfflineMessage'>[ Offline ]</span>";
                            echo 
    $onlinetext;
							?></td>
					</tr>
					<tr>
						<td>
														<span><?=htmlspecialchars($user['username'])?>'s <?=$sitename?>:</span><br>
							<a href="/User.aspx?ID=<?=$user['id']?>">https://<?=$sitedomain?>/User.aspx?ID=<?=$user['id']?></a><br>
							<br>
							<div style="left: 0px; float: left; position: relative; top: 0px">
								<a disabled="disabled" title="<?=$user['username']?>" onclick="return false" style="display:inline-block;"><img src="/img/user/<?=$user['id']?>.png?rand=<?php echo random_int(1,999999999999999999); ?>" style="height:225px;width:190px;" id="img" alt="<?=htmlspecialchars($user['username'])?>" border="0"></a><br>
								<div class="ReportAbusePanel">
									<a href="/report/?id=25&amp;type=3"><span class="AbuseIcon"><img src="/images/abuse.gif" alt="Report Abuse" border="0"></span>
									<span class="AbuseButton">Report Abuse</span></a>
								</div>
							</div>
							<p><a href="/My/PrivateMessage.aspx?RecipientID=<?=$user['id']?>">Send Message</a></p>
							<p><a href="/api/user/addFriend?userto=<?=$user['id']?>">Send Friend Request</a></p>	
							<?php if($loggedin == "yes") if($_USER["USER_PERMISSIONS"] === "Administrator") { ?><p><a href="/api/renderid?id=<?=$user['id']?>&noplus">Render The User</a></p><?php } ?>
							<p style="width:430px;"><span style="white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-wrap:break-word;"><?php echo $blurb; ?></span></p>
													</td>
					</tr>
				</tbody>
			</table>
					</div>
				<div id="UserPageLargeRectangleAd">
			<div id="RobloxLargeRectangleAd">
							</div>
		</div>
				<div id="UserBadgesPane">
		<div id="UserBadges">
				<h4><a href="/Badges.aspx">Badges</a></h4>
                <table cellspacing="0" border="0" align="Center">
					<tbody>
					<tr>
                    <?php
                    $badges = 0;
                    if($user["USER_PERMISSIONS"] === "Administrator") {
                    $badges++;
                    ?><td>
                    <div class="Badge">
                        <div class="BadgeImage">
                            <img src="/images/madbloxadmin.png" width="75" height="75" title="This badge is given to administrators on the site." alt="Administrator"><br>
                            <div class="BadgeLabel">
                                <a href="/Badges.aspx">Administrator</a>
                            </div>
                        </div>
                    </div></td>
                    <?php }
                    if((int)$user["discord_verified"] === 1) {
                    $badges++;
                    ?>
                    <td><div class="Badge">
                        <div class="BadgeImage">
                            <img src="/images/discordverified.png" width="75" height="75" title="This badge is given to people who verified using Discord." alt="Discord Verified"><br>
                            <div class="BadgeLabel">
                                <a href="/Badges.aspx">Discord Verified<br><?php echo (int)$user["discord_id"]; ?></a>
                            </div>
                        </div>
                    </div></td>
                    <?php }
                    if($badges <= 0) { ?>
					This user doesn't have any <?=$sitename?> badges
                    <?php } ?>
                    </tr>
                    </tbody>
				</table>
			</div>
		</div>
		<div id="UserStatisticsPane">
			<div id="UserStatistics">
				<div id="StatisticsPanel" style="transition: height 0.5s ease-out; overflow: hidden; height: 200px;">
					<h4>Statistics</h4>			
					<div style="margin: 10px 10px 150px 10px;" id="Results">
                         <div class="Statistic">
							<div class="Label"><acronym title="The number of this user's friends.">Friends</acronym>:</div>
							<div class="Value"><span><?=$friends?> (<?=$friends2?> last week)</span></div>
						</div>
												<div class="Statistic">
							<div class="Label"><acronym title="The number of posts this user has made to the <?=$sitename?> forum.">Forum Posts</acronym>:</div>
							<div class="Value"><span><?=$forumposts?> (<?=$forumposts2?> last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's profile has been viewed.">Profile Views</acronym>:</div>
							<div class="Value"><span><?=$profileviews?> (<?=$profileviewslastweek?> last week)</span></div>
						</div>
						<div class="Statistic">
                        <div class="Label"><acronym title="The number of times this user's place has been visited.">Place Visits</acronym>:</div>
                        <div class="Value"><span><?=$placevisits?> (<?=$placevisits2?> last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's models have been viewed - unfinished.">Model Views</acronym>:</div>
							<div class="Value"><span>?</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's character has destroyed another user's character in-game.">Knockouts</acronym>:</div>
							<div class="Value"><span><?=$knockouts?> (<?=$knockoutslastweek?> last week)</span></div>
						</div>
						<div class="Statistic">
							<div class="Label"><acronym title="The number of times this user's character has been destroyed in-game.">Wipeouts</acronym>:</div>
							<div class="Value"><span><?=$wipeoutslastweek?> (<?=$wipeoutslastweek?> last week)</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="RightBank">
	
    <div id="UserPlacesPane">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="/ajax.js" type="text/javascript"></script>
<script src="/ajaxcommon.js" type="text/javascript"></script>
<script src="/ajaxtimer.js" type="text/javascript"></script>
<script src="/ajaxanimations.js" type="text/javascript"></script>
<script src="/ajaxextenderbase.js" type="text/javascript"></script>
<script src="/accordian.js" type="text/javascript"></script>

<script>
Sys.Application.add_init(function() {
$create(Sys.Extended.UI.AccordionBehavior, {"ClientStateFieldID":"AccordionExtender_ClientState","FramesPerSecond":40,"HeaderCssClass":"AccordionHeader","id":"ShowcasePlacesAccordion_AccordionExtender"}, null, null, $get("ShowcasePlacesAccordion")); 
}); 
</script>
    <div id="UserPlaces">

                <h4 class="thingg">Showcase</h4>
                <div id="ShowcasePlacesAccordion" style="height: auto; overflow: auto;">
                    <input type="hidden" name="AccordionExtender_ClientState" id="AccordionExtender_ClientState" value="0">

                    <?php
                    $stmte = $db->prepare("SELECT * FROM games WHERE creatorid = ? ORDER BY id DESC LIMIT 10");
                    $stmte->execute([$user['id']]);
                    $usersResult = $stmte->fetchAll();
                    $thejlol = count($usersResult);
                    if ($thejlol == 0) {
                        ?>
                        <style>.thingg{display:none!important;}</style>
                        <div id="UserPlacesPane" style="border: 0px!important;">
                            <p style="padding:10px">You don't have any <?=$sitename;?> places.</p>     
                        </div>
                    <?php }
                    foreach ($usersResult as $rowUser) { ?>
<div class="AccordionHeader"><?=htmlentities($rowUser['name']);?></div>
<div style="height: 0px; overflow: hidden; display: none;"><div style="display: block; height: auto; overflow: hidden;">
<div class="Place" style="background:white;">
<div class="PlayStatus">
                <span id="BetaTestersOnly" style="display:none;"><img src="/web/20210220003229im_/https://goodblox.xyz/resources/tinybeta.png" style="border-width:0px;">&nbsp;Beta testers only</span>
                <span id="FriendsOnlyLocked" style="display:none;"><img src="/web/20210220003229im_/https://goodblox.xyz/resources/unlocked.png" style="border-width:0px;">&nbsp;Friends-only: You have access</span>
                <span id="FriendsOnlyUnlocked" style="display:none;"><img src="/web/20210220003229im_/https://goodblox.xyz/resources/locked.png" style="border-width:0px;">&nbsp;Friends-only</span>
                <span id="Public" style="display:inline;"><img src="/images/public.png" style="border-width:0px;">&nbsp;Public</span>
</div>
<br>
<div class="PlayOptions">
                                <a href="/play.aspx?id=<?php echo (int)$rowUser["id"]; ?>"><img id="MultiplayerVisitButton" class="ImageButton" src="/images/Play.png" alt="Visit Online"></a>
                                    </div>
<div class="Statistics">
<span>Visited 0 times (0 last week)</span>
</div>
<div class="Thumbnail">
<a disabled="disabled" title="<?=htmlentities($rowUser['name']);?>" href="/PlaceItem.aspx?ID=<?=$rowUser['id'];?>" style="display:inline-block;">
<img src="/img/games/<?=$rowUser['id']?>.png?rand=<?=rand(0, getrandmax())?>" id="img" alt="<?=htmlentities($rowUser['name']);?>" border="0" style="height: 230px; width: 421px;">
</a>
                    </div>
                    <div>
                      <div class="Description">
                        <span><?= htmlentities($rowUser['description']); ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
<?php $lolcount++; }?>      
</div>
    
</div></div>
    
    <div id="FriendsPane">
			<div id="Friends">
			<?php
$frs = $db->prepare("SELECT * FROM friends WHERE user_to=:id AND areFriends=1 OR user_from=:id AND areFriends=1");
$frs->execute([':id' => $user['id']]);
$frrr = $frs->rowCount();

$maxRows = 6;
$rowCount = 0;
$roww = 0;
?>

<h4><?=htmlspecialchars($user['username'])?>'s friends <a href="/Friends.aspx?UserID=<?=$user['id']?>">See all <?= $frrr ?></a></h4>
<table cellspacing="0" align="center" border="0" style="border-collapse:collapse;">
    <tbody>
        <tr>
        <?php
if ($frs->rowCount() < 1) {
    echo ("<p style='padding: 10px 10px 10px 10px;'>This person does not have any $sitename friends.</p>");
} else {
    $rowLimit = 6;
    $rowCounter = 0;

    while ($b = $frs->fetch(PDO::FETCH_ASSOC)) {
        if ($b['user_from'] == $user['id']) {
            $friendid = $b['user_to'];
        } else {
            $friendid = $b['user_from'];
        }
        $userq = $db->prepare("SELECT * FROM users WHERE id=:id");
        $userq->execute([":id" => $friendid]);
        $row = $userq->fetch(PDO::FETCH_ASSOC);

        echo "<td><div class=\"Friend\">
                <div class=\"Avatar\">
                    <a title=\"{$row['username']}\" href=\"/User.aspx?ID=$friendid\" style=\"display:inline-block;max-height:100px;max-width:100px;cursor:pointer;\">
                        <img src=\"/img/user/" . $row['id'] . ".png?rand=" . random_int(1, 999999999999999999) . "\" width=\"95\" height=\"111\" border=\"0\" alt=\"".addslashes($row['username'])."\" blankurl=\"http://t6.roblox.com:80/blank-100x100.gif\">
                    </a>
                </div>
                <div class=\"Summary\">
                    <span class=\"OnlineStatus\">";
                    
        $onlinetest = ($row['lastseen'] + 300 <= time()) ? "<img src=\"/images/Offline.gif\" style=\"border-width:0px;\">" : "<img src=\"/images/Online.gif\" style=\"border-width:0px;\">";
        echo "$onlinetest</span>

                    <span class=\"Name\"><a href=\"/User.aspx?ID=$friendid\">".htmlspecialchars($row['username'])."</a></span>
                </div>
            </div></td>";

        $total++;
        $rowCounter++;

        if ($rowCounter >= $rowLimit) {
            break; 
        }

        if ($rowCounter % 3 == 0) {
            echo "</tr><tr>"; 
        }
    }
}
?>



        </tr>
    </tbody>
</table>

            </h4>          
<div class="columns"></div>
											</div>
		</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div id="FavoritesPane">
    <div id="Favorites">
        <h4>Favorites</h4>
        <div id="FavoritesContent">
            <div class="HeaderPager"></div>
            <table cellspacing="0" border="0" style="margin:auto;">
                <tbody>
                </tbody>
            </table>
            <div class="FooterPager"></div>
        </div>
        <div class="PanelFooter">
            Category:&nbsp;
            <select id="FavCategories">
                <option value="7">Heads</option>
                <option value="8">Faces</option>
                <option value="2">T-Shirts</option>
                <option value="5">Shirts</option>
                <option value="6">Pants</option>
                <option value="1">Hats</option>
                <option value="4">Decals</option>
                <option value="3">Models</option>
                <option selected="selected" value="0">Places</option>
            </select>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        function loadContent(wtype) {

            var id = getParameterByName('ID');

            switch (wtype) {
                case '7':
                    console.log('Heads selected');
                    wtype = "head";
                    break;
                case '8':
                    console.log('Faces selected');
		    wtype = "face";
                    break;
                case '2':
                    console.log('T-Shirts selected'); 
                    wtype = "tshirt";
                    break;
                case '5':
                    console.log('Shirts selected');
                    break;
                case '6':
                    console.log('Pants selected');
                    wtype = "pants";
                    break;
                case '1':
                    console.log('Hats selected');
                    wtype = "hat";
                    break;
                case '4':
                    console.log('Decals selected');
                    break;
                case '3':
                    console.log('Models selected');
                    break;
                case '0':
                    console.log('Places selected');
                    wtype = "games";
                    break;
                default:
                    console.log('Default action');
                    wtype = "games";
                    break;
            }

            $.ajax({
                url: '/api/user/getfavorites.php',
                type: 'GET',
                data: { id: id, wtype: wtype },
                success: function (responseData) {
                    $('#FavoritesContent table tbody').html(responseData);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        $('#FavCategories').change(function () {
            var selectedWtype = $(this).val();
            loadContent(selectedWtype);
        });

        loadContent('0');
    });
</script>



<script>
function getInventory(type, page, event) 
{
  if(page == undefined){ page = 1; }
  if(event != undefined){ event.preventDefault(); }
  $.post("/api/user/getInventory.php", {uid:<?=$user['id'];?>,type:type,page:page}, function(data) 
  {
    $("#AssetsContent").empty();
    $("#AssetsContent").html(data);
  })
  .fail(function() 
  {
    $("#AssetsContent").text("An error occurred while fetching this user's inventory");
  });

  $('*[data-id]').removeClass().addClass("AssetsMenuItem");
  $('*[data-id]').children().removeClass().addClass("AssetsMenuButton");

  $('*[data-id="'+type+'"]').removeClass().addClass("AssetsMenuItem_Selected");
  $('*[data-id="'+type+'"]').children().removeClass().addClass("AssetsMenuButton_Selected");
}

$(function() 
{
  $('.AssetsMenuItem').on('click', this, function(){ getInventory($(this).attr("data-id")); });

  getInventory(1); 
});
    </script>
</div>
<br>
<div id="UserAssetsPane">
    <div id="UserAssets" style="background-color:white;">
      <h4>Stuff</h4>
      <div id="AssetsMenu">
            <div class="AssetsMenuItem" data-id="7" onclick="getInventory(7)">
              <a class="AssetsMenuButton">Heads</a>
            </div>
            <div class="AssetsMenuItem" data-id="8" onclick="getInventory(8)">
              <a class="AssetsMenuButton">Faces</a>
            </div>
            <div class="AssetsMenuItem_Selected" data-id="1" onclick="getInventory(1)">
              <a class="AssetsMenuButton_Selected">Hats</a>
            </div>
            <div class="AssetsMenuItem" data-id="2" onclick="getInventory(2)">
              <a class="AssetsMenuButton">T-Shirts</a>
            </div>
            <div class="AssetsMenuItem" data-id="5" onclick="getInventory(5)">
              <a class="AssetsMenuButton">Shirts</a>
            </div>
            <div class="AssetsMenuItem" data-id="6" onclick="getInventory(6)">
              <a class="AssetsMenuButton">Pants</a>
            </div>
            <div class="AssetsMenuItem" data-id="4" onclick="getInventory(4)">
              <a class="AssetsMenuButton">Decals</a>
            </div>
            <div class="AssetsMenuItem" data-id="3" onclick="getInventory(3)">
              <a class="AssetsMenuButton">Models</a>
            </div>
            <div class="AssetsMenuItem" data-id="0" onclick="getInventory(0)">
               <a class="AssetsMenuButton">Places</a>
             </div>
      </div>
      <div id="AssetsContent"></div>
      <div style="clear:both;"></div>
    </div>
  </div>
</div>
<div style="clear:both"></div>
<?php require("core/footer.php"); }
?>
