<?php
  
require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");  

$id = filter_var($_GET['ID'], FILTER_SANITIZE_NUMBER_INT);
$gameitem = $db->prepare("SELECT * FROM games WHERE id=?");
$gameitem->execute([$id]);
$game = $gameitem->fetch(PDO::FETCH_ASSOC);


if (!$game) {
  die('<script>
  alert("This game does not exist !");
  document.location = "/games";
  </script>');
  exit;
}

$creatorq = $db->prepare("SELECT * FROM users WHERE id=?");
$creatorq->execute([$game['creatorid']]);
$creator = $creatorq->fetch(PDO::FETCH_ASSOC);

$title = filterText(htmlspecialchars($game['name']))." by ".htmlspecialchars($creator['username'])." - ".$sitename." Places";

require_once($_SERVER['DOCUMENT_ROOT']."/core/head.php");  
  
  require_once $_SERVER["DOCUMENT_ROOT"]."/ReCaptcha.php";

  if($testing == 'true' && ($_USER['USER_PERMISSIONS'] !== "Administrator" && $_USER['USER_PERMISSIONS'] !== "beta_tester")) {
    die("<div style='margin: 150px auto 150px auto; width: 500px; border: black thin solid; padding: 22px;'><strong><p>Games down because site up for testing purposes</p></strong></div>"); }
    
?>


<div id="Body">
<script>
  var sid;
  var token;
  var sid2;

  
  function JoinGame(serverid = 0) 
    {
    $("#joiningGameDiag").show();
    $.post("", {placeId:1, serverId:serverid}, function(data) {
      if(isNaN(data) == false) 
            {
        sid = data;
        setTimeout(function() { checkifProgressChanged(); }, 1500);
      }
            else if (data.startsWith("")) 
            {
        $("#Requesting").html("The server is ready. Joining the game... ");
        token = data;
        location.href= "play.aspx?id=<?php echo $game['id']; ?>";
        setTimeout(function() { closeModal(); }, 2000);
      } 
            else 
            {
        $("#Spinner").hide();
        $("#Requesting").html(data);
      }
    });
  }
  function HostGame(serverid = 0) 
    {
    $("#joiningGameDiag").show();
    $.post("", {placeId:1, serverId:serverid}, function(data) {
      if(isNaN(data) == false) 
            {
        sid = data;
        setTimeout(function() { checkifProgressChanged(); }, 1500);
      }
            else if (data.startsWith("")) 
            {
        $("#Requesting").html("Redirecting you to the host page... ");
        token = data;
        <?php // header("Location: /host.aspx?id=".$game['id']); ?>
        location.href= "host.aspx?id=<?php echo $game['id']; ?>";
        setTimeout(function() { closeModal(); }, 2000);
      } 
            else 
            {
        $("#Spinner").hide();
        $("#Requesting").html(data);
      }
    });
  }
  function StopGame(serverid = 0) 
    {
    $("#joiningGameDiag").show();
    $.post("", {placeId:1, serverId:serverid}, function(data) {
      if(isNaN(data) == false) 
            {
        sid = data;
        setTimeout(function() { checkifProgressChanged(); }, 1500);
      }
            else if (data.startsWith("")) 
            {
        $("#Requesting").html("Stopping server... ");
        token = data;
        <?php // header("Location: /host.aspx?id=".$game['id']); ?>
        location.href= "stopgame.aspx?id=<?php echo $game['id']; ?>";
        setTimeout(function() { closeModal(); }, 2000);
      } 
            else 
            {
        $("#Spinner").hide();
        $("#Requesting").html(data);
      }
    });
  }
  function checkifProgressChanged() 
    {
    $.getJSON("" + sid, function(result) {
      $("#Requesting").html(result.msg);
      if(result.token == null) 
            {
        if(result.check == true) 
                {
          setTimeout(function() { checkifProgressChanged() }, 750);
        } 
                else 
                {
          $("#Spinner").hide();
        }
      } 
            else 
            {
        token = result.token;
        location.href="" + token;
        setTimeout(function() { closeModal(); }, 2000);
      }
    });
  }
  function joinServer() 
    {
    $.getJSON("" + sid2, function(result) 
        {
      $("#Requesting").html(result.msg);
      if(result.token != null) 
            {
        token = result.token;
        location.href="" + token;
        setTimeout(function() { closeModal(); }, 2000);
      }
    });
  }
  function closeModal() 
    {
    $("#joiningGameDiag").hide();
    $("#Spinner").show();
    $("#Requesting").html("Requesting a server");
  }
    </script>
<script>
      function activateTab(activeTabId, inactiveTabId) {
        var activeTab = document.getElementById(activeTabId);
        activeTab.classList.add('ajax__tab_active');
        activeTab.classList.remove('ajax__tab_hover');
  
        var inactiveTab = document.getElementById(inactiveTabId);
        inactiveTab.classList.remove('ajax__tab_active');
        inactiveTab.classList.add('ajax__tab_hover');
      }
 function getServers(page, item) 
    {
		if (page == undefined){ page = 1; }
        $.post("/api/items/getServers.php", {page:page,item:item}, function(data) 
        {
        	$("#CommentsContainer").html("");
        	$("#CommentsContainer").html(data);
        })
        .fail(function() 
        {
        	$("#CommentsContainer").html("");
        	$("#CommentsContainer").html("Failed to get gameservers");
        });
    }
	 function getComments(page, item) 
    {
		if (page == undefined){ page = 1; }
        $.post("/api/getgamecomment.php", {page:page,item:item}, function(data) 
        {
        	$("#CommentsContainer").html("");
        	$("#CommentsContainer").html(data);
        })
        .fail(function() 
        {
        	$("#CommentsContainer").html("");
        	$("#CommentsContainer").html("Failed to get comments");
        });
    }
	<?php if($loggedin == "yes") { ?>
	function Comment(item)
	{
		var content = document.getElementById("comment").value;
        $.post("/api/commentgame.php", {content:content,item:item}, function(data) 
        {
        	
			{
				getComments(1, <?=$id?>)
			}
		
        })
        .fail(function() 
        {
        	$("#CommentsContainer").html("");
        	$("#CommentsContainer").html("Failed to comment");
        });
	}
	<?php } ?>
  getServers(1, <?=$id?>);
  </script>


<style>
  #ItemContainer #Thumbnail_Place {
  height: 230px;
  width: 420px;
  }
  .PlayGames {
  background-color: #ccc;
  border: dashed 1px Green;
  clear: left;
  color: Green;
  float: left;
  margin-top: 10px;
  padding: 10px 5px;
  text-align: center;
  width: 410px;
  }
  #ItemContainer #Actions, #ItemContainer #Actions_Place {
  background-color: #fff;
  border-bottom: dashed 1px #555;
  border-left: dashed 1px #555;
  border-right: dashed 1px #555;
  clear: left;
  float: left;
  padding: 5px;
  text-align: center;
  min-width: 0;
  position: relative;
  }
  #ItemContainer .CommentsContainer,
#ItemContainer .TabbedInfoContainer {
 margin:10px;
 margin-top:0;
 width:665px;
}
#ItemContainer .TabbedInfoContainer h3 {
 padding:5px;
}
#ItemContainer .CommentsContainer .HeaderPager,
#ItemContainer .CommentsContainer .FooterPager {
 padding:5px 0;
 text-align:right;
}
#ItemContainer .CommentsContainer .Comments {
 border:dashed 1px #555;
 overflow:hidden;
 width:663px;
}
#ItemContainer .CommentsContainer .Comment,
#ItemContainer .CommentsContainer .AlternateComment {
 padding:7px 10px;
}
#ItemContainer .CommentsContainer .Comment {
 background-color:#fff;
}
#ItemContainer .CommentsContainer .AlternateComment {
 background-color:#eee;
}
#ItemContainer .CommentsContainer .Commenter {
 float:left;
 width:110px;
}
#ItemContainer .CommentsContainer .Avatar {
 border:solid 1px #555;
 height:100px;
 width:100px;
}
#ItemContainer .CommentsContainer .Post {
 float:left;
}
#ItemContainer .CommentsContainer .Content {
 margin:10px 0;
 overflow:hidden;
}
#ItemContainer .CommentsContainer .PostAComment {
 margin:10px 0 0 0;
}
#ItemContainer .CommentsContainer .PostAComment .Buttons {
 margin:10px 0 0 0;
}
#ItemContainer .CommentsContainer .MultilineTextBox,
#ItemContainer .CommentsContainer textarea {
 min-height:0;
 width:400px;
}
 
  .ajax__tab_xp .ajax__tab_body,.ajax__tab_xp .ajax__tab_body_bottom,.ajax__tab_xp .ajax__tab_body_verticalleft,.ajax__tab_xp .ajax__tab_body_verticalright {
    background-color: #fff;
    font-family: verdana,tahoma,helvetica
}

.ajax__tab_plain .ajax__tab_body,.ajax__tab_plain .ajax__tab_header,.ajax__tab_plain .ajax__tab_inner,.ajax__tab_plain .ajax__tab_outer {
    text-align: center;
    vertical-align: middle
}

.ajax__tab_default .ajax__tab {
    display: block;
    float: left;
    height: 21px;
    margin-top: 1px
}

.ajax__tab_default .ajax__tab_header {
    white-space: normal!important
}

.ajax__tab_default .ajax__tab_inner,.ajax__tab_default .ajax__tab_outer {
    display: inline-block
}

.ajax__tab_default .ajax__tab_tab {
    display: inline-block;
    overflow: hidden;
    text-align: center;
    outline: 0
}

.ajax__tab_xp .ajax__tab_disabled {
    color: #a0a0a0;
    cursor: default
}

.ajax__tab_xp .ajax__tab_header {
    background-position: bottom;
    background-repeat: repeat-x;
    font-family: verdana,tahoma,helvetica;
    font-size: 11px
}

.ajax__tab_xp .ajax__tab_header:after,.ajax__tab_xp .ajax__tab_header:before {
    content: "";
    display: table
}

.ajax__tab_xp .ajax__tab_header:after {
    clear: both
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_outer {
    background-position: right;
    background-repeat: no-repeat;
    height: 21px;
    padding-right: 4px
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_inner {
    background-repeat: no-repeat;
    padding-left: 3px
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_tab {
    background-repeat: repeat-x;
    margin: 0;
    padding: 4px
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_hover .ajax__tab_outer {
    background-position: right;
    background-repeat: no-repeat;
    cursor: pointer
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_hover .ajax__tab_inner {
    background-repeat: no-repeat;
    cursor: pointer
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_hover .ajax__tab_tab {
    /*! background-repeat: repeat-x; */
    /*! cursor: pointer */
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_active .ajax__tab_outer {
    background-position: right;
    background-repeat: no-repeat
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_active .ajax__tab_inner {
    background-repeat: no-repeat
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_active .ajax__tab_tab {
    background-repeat: repeat-x
}

.ajax__tab_xp .ajax__tab_body {
    border: 1px solid #999;
    border-top: 0;
    font-size: 10pt;
    padding: 8px
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab {
    float: none
}

.ajax__tab_xp .ajax__tab_header_verticalleft {
    background-position: right;
    background-repeat: repeat-y;
    font-family: verdana,tahoma,helvetica;
    font-size: 11px
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_outer {
    background-position: right;
    background-repeat: no-repeat;
    height: 21px;
    padding-right: 4px
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_inner {
    background-repeat: no-repeat;
    padding-left: 3px
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_tab {
    background-repeat: repeat-x;
    margin: 0;
    padding: 4px
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_hover .ajax__tab_outer {
    background-position: right;
    background-repeat: no-repeat;
    cursor: pointer
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_hover .ajax__tab_inner {
    background-repeat: no-repeat;
    cursor: pointer
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_hover .ajax__tab_tab {
    background-repeat: repeat-x;
    cursor: pointer
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_active:not(:first-child) {
    margin-top: 1px
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_active .ajax__tab_outer {
    background-position: right;
    background-repeat: no-repeat
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_active .ajax__tab_inner {
    background-repeat: no-repeat
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_active .ajax__tab_tab {
    background-repeat: repeat-x
}

.ajax__tab_xp .ajax__tab_body_verticalleft {
    border: 1px solid #999;
    border-left: 0;
    font-size: 10pt;
    padding: 8px
}

.ajax__tab_xp .ajax__tab_header_verticalright {
    background-position: left;
    background-repeat: repeat-y;
    font-family: verdana,tahoma,helvetica;
    font-size: 11px
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_outer {
    background-position: right;
    background-repeat: no-repeat;
    height: 21px;
    padding-right: 4px
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_inner {
    background-repeat: no-repeat;
    padding-left: 3px
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_tab {
    background-repeat: repeat-x;
    margin: 0;
    padding: 4px
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_hover .ajax__tab_outer {
    background-position: right;
    background-repeat: no-repeat;
    cursor: pointer
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_hover .ajax__tab_inner {
    background-repeat: no-repeat;
    cursor: pointer
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_hover .ajax__tab_tab {
    background-repeat: repeat-x;
    cursor: pointer
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_active {
    margin-top: 1px
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_active .ajax__tab_outer {
    background-position: right;
    background-repeat: no-repeat
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_active .ajax__tab_inner {
    background-repeat: no-repeat
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_active .ajax__tab_tab {
    background-repeat: repeat-x
}

.ajax__tab_xp .ajax__tab_body_verticalright {
    border: 1px solid #999;
    border-right: 0;
    font-size: 10pt;
    padding: 8px
}

.ajax__tab_xp .ajax__tab_header_bottom {
    background-position: top;
    background-repeat: repeat-x;
    font-family: verdana,tahoma,helvetica;
    font-size: 11px
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_outer {
    background-position: right;
    background-repeat: no-repeat;
    height: 21px;
    padding-right: 4px
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_inner {
    background-repeat: no-repeat;
    padding-left: 3px
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_tab {
    background-repeat: repeat-x;
    height: 17px;
    margin: 0;
    padding: 0 4px 4px
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_hover .ajax__tab_outer {
    background-position: right;
    background-repeat: no-repeat;
    cursor: pointer
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_hover .ajax__tab_inner {
    background-repeat: no-repeat;
    cursor: pointer
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_hover .ajax__tab_tab {
    background-repeat: repeat-x;
    cursor: pointer
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_active .ajax__tab_outer {
    background-position: right;
    background-repeat: no-repeat
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_active .ajax__tab_inner {
    background-repeat: no-repeat
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_active .ajax__tab_tab {
    background-repeat: repeat-x
}

.ajax__tab_xp .ajax__tab_body_bottom {
    border: 1px solid #999;
    border-bottom: 0;
    font-size: 10pt;
    padding: 8px
}

.ajax__tab_plain .ajax__tab_outer {
    border: 2px solid #999
}

.ajax__tab_plain .ajax__tab_active .ajax__tab_outer {
    background: #ffffe1
}

.ajax__tab_xp .ajax__tab_header {
    background-image: url(/images/AjaxTabsNew/Tabs.Line.gif)
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_outer {
    background-image: url(/images/AjaxTabsNew/Tabs.Right.gif)
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_inner {
    background-image: url(/images/AjaxTabsNew/Tabs.Left.gif);
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_tab {
    background-image: url(/images/AjaxTabsNew/Tabs.Background.gif);
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_hover .ajax__tab_outer {
    /*! background-image: url(/images/AjaxTabsNew/Tabs.HoverRight.gif); */
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_hover .ajax__tab_inner {
    /*! background-image: url(/images/AjaxTabsNew/Tabs.HoverLeft.gif) */
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_hover .ajax__tab_tab {
    /*! background-image: url(/images/AjaxTabsNew/Tabs.Hover.gif); */
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_active .ajax__tab_outer {
    background-image: url(/images/AjaxTabsNew/Tabs.ActiveRight.gif);
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_active .ajax__tab_inner {
    background-image: url(/images/AjaxTabsNew/Tabs.ActiveLeft.gif);
}

.ajax__tab_xp .ajax__tab_header .ajax__tab_active .ajax__tab_tab {
    background-image: url(/images/AjaxTabsNew/Tabs.Active.gif);
}

.ajax__tab_xp .ajax__tab_header_verticalleft {
    background-image: url(/images/AjaxTabsNew/Tabs.Line.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_outer {
    background-image: url(/images/AjaxTabsNew/Tabs.Right-VerticalLeft.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_inner {
    background-image: url(/images/AjaxTabsNew/Tabs.Left-VerticalLeft.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_tab {
    background-image: url(/images/AjaxTabsNew/Tabs.VerticalLeft.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_hover .ajax__tab_outer {
    background-image: url(/images/AjaxTabsNew/Tabs.HoverRight-VerticalLeft.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_hover .ajax__tab_inner {
    background-image: url(/images/AjaxTabsNew/Tabs.HoverLeft-VerticalLeft.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_hover .ajax__tab_tab {
    background-image: url(/images/AjaxTabsNew/Tabs.Hover-VerticalLeft.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_active .ajax__tab_outer {
    background-image: url(/images/AjaxTabsNew/Tabs.ActiveRight-VerticalLeft.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_active .ajax__tab_inner {
    background-image: url(/images/AjaxTabsNew/Tabs.ActiveLeft-VerticalLeft.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalleft .ajax__tab_active .ajax__tab_tab {
    background-image: url(/images/AjaxTabsNew/Tabs.Active-VerticalLeft.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalright {
    background-image: url(/images/AjaxTabsNew/Tabs.Line.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_outer {
    background-image: url(/images/AjaxTabsNew/Tabs.Right-VerticalRight.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_inner {
    background-image: url(/images/AjaxTabsNew/Tabs.Left-VerticalRight.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_tab {
    background-image: url(/images/AjaxTabsNew/Tabs.VerticalRight.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_hover .ajax__tab_outer {
    background-image: url(/images/AjaxTabsNew/Tabs.HoverRight-VerticalRight.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_hover .ajax__tab_inner {
    background-image: url(/images/AjaxTabsNew/Tabs.HoverLeft-VerticalRight.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_hover .ajax__tab_tab {
    background-image: url(/images/AjaxTabsNew/Tabs.Hover-VerticalRight.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_active .ajax__tab_outer {
    background-image: url(/images/AjaxTabsNew/Tabs.ActiveRight-VerticalRight.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_active .ajax__tab_inner {
    background-image: url(/images/AjaxTabsNew/Tabs.ActiveLeft-VerticalRight.gif)
}

.ajax__tab_xp .ajax__tab_header_verticalright .ajax__tab_active .ajax__tab_tab {
    background-image: url(/images/AjaxTabsNew/Tabs.Active-VerticalRight.gif)
}

.ajax__tab_xp .ajax__tab_header_bottom {
    background-image: url(/images/AjaxTabsNew/Tabs.Line.gif)
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_outer {
    background-image: url(/images/AjaxTabsNew/Tabs.Bottom-Right.gif)
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_inner {
    background-image: url(/images/AjaxTabsNew/Tabs.Bottom-Left.gif)
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_tab {
    background-image: url(/images/AjaxTabsNew/Tabs.Bottom.gif)
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_hover .ajax__tab_outer {
    background-image: url(/images/AjaxTabsNew/Tabs.Bottom-HoverRight.gif)
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_hover .ajax__tab_inner {
    background-image: url(/images/AjaxTabsNew/Tabs.Bottom-HoverLeft.gif)
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_hover .ajax__tab_tab {
    background-image: url(/images/AjaxTabsNew/Tabs.Bottom-Hover.gif)
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_active .ajax__tab_outer {
    background-image: url(/images/AjaxTabsNew/Tabs.Bottom-ActiveRight.gif)
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_active .ajax__tab_inner {
    background-image: url('/images/AjaxTabsNew/Tabs.Bottom-ActiveLeft.gif"')
}

.ajax__tab_xp .ajax__tab_header_bottom .ajax__tab_active .ajax__tab_tab {
    background-image: url('/images/AjaxTabsNew/Tabs.Bottom-Active.gif"')
}
.ajax__tab_tab {
    color: #555!important
}
/*
     FILE ARCHIVED ON 13:35:00 Jun 04, 2009 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 11:23:44 Jun 26, 2024.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*
playback timings (ms):
  captures_list: 0.692
  exclusion.robots: 0.075
  exclusion.robots.policy: 0.063
  esindex: 0.011
  cdx.remote: 22.425
  LoadShardBlock: 239.924 (3)
  PetaboxLoader3.resolve: 292.741 (3)
  PetaboxLoader3.datanode: 66.492 (4)
  load_resource: 145.629
*/

</style>
<div id="joiningGameDiag" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(100,100,100,0.25);">
  <div class="modalPopup" style="width: 27em; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
    <div style="margin: 1.5em">
<div id="Spinner" style="float:left;margin:0 1em 1em 0">
        <img src="/images/ProgressIndicator2.gif" style="border-width:0px;">
      </div>
      <div id="Requesting" style="display: inline">
        Requesting a server
      </div>
      <div style="text-align: center; margin-top: 1em">
        <input id="Cancel" onclick="closeModal()" type="button" class="Button" value="Cancel">
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<style>
#ItemContainer {
    background-color: #eee;
    border: solid 1px #555;
    color: #555;
    margin: 0 auto;
    width: 620px;
}
#Item {
    font-family: Verdana, Sans-Serif;
    padding: 10px;
}
</style>
<div id="ItemContainer" style="width:725px; margin:unset;float:left;">
  <h2><?php echo filterText(htmlspecialchars($game['name'], ENT_QUOTES, 'UTF-8')); ?></h2>
<div id="Item">
  <div id="Summary" style="width:251px;">
    <h3><?php echo $sitename; ?> Place</h3>
    <div id="Creator" class="Creator">
      <div class="Avatar">
                        <img src="/img/user/<?=$creator['id']?>.png?rand=<?php echo (int)random_int(1,getrandmax()); ?>" frameborder="0" scrolling="no" width="100" height="114"></img>

        <a title="<?php echo htmlspecialchars($creator['username']); ?>" href="/User.aspx?ID=<?php echo htmlspecialchars($creator['id']); ?>" style="display:inline-block;cursor:pointer;"></a>
      </div>
      Creator: <a href="/User.aspx?ID=<?php echo htmlspecialchars($creator['id']); ?>"><?php echo htmlspecialchars($creator['username']); ?></a>
    </div>
    <?php
$gamevisitq = $db->prepare("SELECT * FROM gamevisits WHERE gameid=?");
$gamevisitq->execute([$game['id']]);
$visits = $gamevisitq->rowCount();
$updated = context::updated($game['updated']);
   ?>
   	 
   <div id="LastUpdate">Updated: <?php echo $updated; ?></div>
    <div class="Visited">Visited: <?php echo htmlspecialchars($visits); ?> times</div>
    <div>
 
    
      <?php if ($game['description'] != "") { ?>     
        <div id="DescriptionLabel">Description:</div>
          <div id="Description" style="width:auto;"><?php echo filterText(htmlspecialchars(nl2br($game['description']))); ?>
          </div>
        
        <?php } ?> 
        </div>
      <div id="ReportAbuse">
        <div class="ReportAbusePanel">
        <center>
              <br>
			  <a href="/AbuseReport/AbuseSite.aspx">
              <span class="AbuseIcon"><img src="images/abuse.gif" border="0" alt="Report Abuse" border="0"></span>
              <span class="AbuseButton">Report Abuse</span>
			  </a>
			  <a href="/AbuseReport/ExploitSite.aspx">
			  <span class="AbuseIcon"><img src="images/abuse.gif" border="0" alt="Report Exploit" border="0"></span>
              <span class="AbuseButton">Report Exploit</span>
			  </a>
                      </center>
        </div>
      </div>
    </div>
    <div id="Details">
      <div id="Thumbnail_Place">
        <a title="<?php echo filterText(htmlspecialchars($game['name'])); ?>" style="display:inline-block;cursor:pointer;">
<img src="/img/games/<?php echo $game['id']; ?>.png?rand=<?php echo (int)random_int(1,getrandmax()); ?>" width="418" height="228" style="border: 1px solid black" alt="<?php echo filterText(htmlspecialchars($game['name'])); ?>">
</a><?php
$da = $db->prepare("SELECT * FROM favorites WHERE userid=? AND itemid=? AND type='games'");
$da->execute([$_USER['id'], $game['id']]);
$d = $da->rowCount();
?>
      </div><?php if($loggedin == "yes"){ ?>
      <div id="Actions_Place" style="width: 408px;">
      <a href="/api/user/<?php if($d > 0){ ?>Un<?php } ?>FavoriteItem.php?itemid=<?=$game['id']?>&isgame=1"><?php if($d < 1){ ?>Favorite<?php }else{?> Unfavorite <?php } ?> </a><?php if($loggedin === "yes") { if($_USER["USER_PERMISSIONS"] === "Administrator") { ?> - <a href="/api/renderGame.aspx?id=<?php echo (int)$game["id"]; ?>&noplus">Render the Game</a><?php }} ?>
              </div><?php } ?>
            <div class="PlayGames">
        <div style="text-align: center; margin: 1em 5px;">
                    <span style="display:inline;"><img src="images/public.png" style="border-width:0px;">&nbsp;Public</span>
                    <img src="images/CopyLocked.png" style="border-width:0px;"> Copy Protection: CopyLocked
                  </div>
        <div>
          <div style="display: inline; width: 10px; ">
            <!--a href="/uriostooold.php"><p style="color: grey;">Play button doesn't work?</p></a-->
				<input type="image" class="ImageButton" src="images/Play.png" alt="Visit Online" onclick="<?php if($loggedin == "no" && (int)$_GLOBAL["guestEnabled"] !== 1) { ?>alert('Guests are not enabled.\nLogin or wait for guests to be enabled.');<?php } else { ?>JoinGame();<?php } ?>" style="<?php if($loggedin == "no" && (int)$_GLOBAL["guestEnabled"] !== 1) { ?>filter: grayscale(1);<?php } ?>">
				<?php if((int)$creator['id'] == (int)$_USER['id'] || $_USER["USER_PERMISSIONS"] === "Administrator") { ?>
				<br><input type="image" class="ImageButton" src="images/stopbutton.png" alt="Stop Game" style="margin-top: 5px" onclick="StopGame()">
				<?php } ?>

                     </div>
        </div>
      </div>
      <div style="clear: both;"></div></div>
<br>
      <div style=" width: 703px;">
 
 <div class="ajax__tab_xp ajax__tab_container ajax__tab_default" id="TabbedInfo">
    <div id="TabbedInfo_header" class="ajax__tab_header" style="height:21px;">
        <span id="tab11" class=" jax__tab ajax__tab_active">
             <span class="ajax__tab_outer">
                <span class="ajax__tab_inner">
                    <a class="ajax__tab_tab ajax__tab" id="__tab_TabbedInfo_GamesTab" href="javascript:void(0)" onclick="activateTab('tab11', 'tab22'); getServers(1, <?=$id?>);" style="text-decoration:none;">
                        <h3>Games</h3>
                    </a>
                </span>
            </span>
        </span>
        <span id="tab22" class="ajax__tab_hover">
            <span class="ajax__tab_outer">
                <span class="ajax__tab_inner">
                    <a class="ajax__tab_tab ajax__tab" id="__tab_TabbedInfo_CommentaryTab" href="javascript:void(0)" onclick="activateTab('tab22', 'tab11'); getComments(1, <?=$id?>);" style="text-decoration:none;">
                        <h3>Commentary</h3>
                    </a>
                </span>
            </span>
        </span>
    </div>
    <div id="TabbedInfo_body" class="ajax__tab_body">
        <div id="TabbedInfo_CommentaryTab" class="ajax__tab_panel">
            <div id="TabbedInfo_CommentaryTab_CommentsPane_CommentsUpdatePanel">
                <div class="CommentsContainer" id="CommentsContainer"></div>
        </div>
      </div>
              </div>
  </div>
</div>
  </div>

<script src="https://www.google.com/recaptcha/api.js" async="" defer=""></script>

      </div></div></div></div>


</div>
</div></div></div></div></div></div></div></div></div>
<div style="clear: both;"></div>

<?php require_once($_SERVER['DOCUMENT_ROOT']."/core/footer.php");  ?>
