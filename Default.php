<?php
require($_SERVER["DOCUMENT_ROOT"]."/core/head.php");
?>
<?php if($loggedin == "no"){ ?>
<style>
.FrontPagePanel {
 float:left;
 border:solid 1px black;
 margin:5px;
 background-color:White;
}
#SignInPane {
 border:none;
 margin-left:0;
 width:152px;
 height:250px;
}
#Movie {
 width:424px;
 height:250px;
}
#FrontPageRectangleAd {
 margin:5px 0 5px 5px;
 width:300px;
 height:250px;
 background-color:Transparent;
}
#SalesPitch {
 margin-left:0;
 width:586px;
 height:90px;
}
#WhatsNew {
 margin-left:0;
 width:586px;
 height:280px;
}
#RandomFacts {
 float:right;
 margin-right:0;
 width:300px;
 height:150px;
}
.RandomFactoid {
 text-align:center;
 height:32px;
 width:290px;
 padding:2px;
 overflow:hidden;
}
#marqueecontainer {
 position:relative;
 width:300px;
 height:100px;
 background-color:white;
 overflow:hidden;
}
.RandomFactoid img {
 float:left;
}
#ParentsCorner {
 margin-right:0;
 width:300px;
 height:220px;
 _height:240px;
}
#ParentsCorner #Inside {
 padding:10px;
}
.ShieldImage {
 float:left;
 padding:5px;
}
.TrusteeSeal {
 float:left;
 width:140px;
 padding:5px;
}
#NewsFeeder {
 margin-right:0;
 width:158px;
 height:90px;
}
#FrontPageBannerAd {
 margin-left:0;
 width:728px;
 height:90px;
 background-color:Transparent;
}
.BadAdButton {
 background-color:Transparent;
 border:0;
 font-size:.8em;
 font-family:Verdana;
 padding:0;
 position:relative;
 text-align:center;
 height:8px;
 top:-2px;
 right:0;
}
.BadAdButton:hover {
 background-color:#fff;
 border:solid 1px #000;
 text-decoration:none;
}
#InviteAFriendContainer {
 padding:10px 10px 10px 10px;
}
#InviteAFriendContainer h3 {
 margin:0 auto;
 padding:0 0 10px 0;
 text-align:left;
 width:700px;
}
#InviteAFriendContainer #Exposition {
 margin:0 auto;
 padding:0 0 10px 0;
 width:700px;
}
#InviteAFriendContainer .Buttons {
 margin:0 auto;
 padding:10px 0 0 0;
 width:700px;
}
#InviteAFriendContainer .Button {
 border:solid 1px #000;
 color:#000;
 float:right;
 font-family:Verdana,Sans-Serif;
 margin:0 0 0 10px;
 padding:3px 10px 3px 10px;
 text-decoration:none;
}
#InviteAFriendContainer .MultilineTextBox {
 border-color:Gray;
 border-style:dashed;
 font-family:Arial,Sans-Serif;
 line-height:1.5em;
 padding:5px 5px 5px 5px;
 width:92%;
}
#InviteAFriendContainer .TextBox {
 border-color:Gray;
 border-style:dashed;
 font-family:Arial,Sans-Serif;
 padding:5px 5px 5px 5px;
 width:92%;
}
#InviteAFriendContainer .Label {
 font-weight:bold;
}
#InviteAFriendContainer #InvitationElements {
 border:solid 1px #000;
 margin:0 auto;
 padding:5px 5px 5px 5px;
 width:688px;
}
#InviteAFriendContainer #Name,
#InviteAFriendContainer #Recipients,
#InviteAFriendContainer #Message {
 margin:15px 0 0 0;
}
#InviteAFriendContainer .FormLabel {
 float:left;
 width:94px;
}
#InviteAFriendContainer .FormField {
 float:left;
 width:317px;
}
#InviteAFriendContainer .FormNotes {
 float:right;
 font-family:Verdana;
 font-size:xx-small;
 width:277px;
}
#InviteAFriendContainer #Confirmation h3 {
 margin:0 auto;
 text-align:left;
 width:400px;
}
#InviteAFriendContainer #Confirmation #Message {
 border:solid 1px #000;
 margin:0 auto;
 padding:10px 10px 10px 10px;
 width:380px;
}
#InviteAFriendContainer #Confirmation .Buttons {
 margin:0 auto;
 width:400px;
}
#SplashContainer h2 {
 color:#333;
 font-size:x-large;
 margin:0 0 5px 0;
}
#SplashContainer h3 {
 color:#333;
 letter-spacing:normal;
 margin:0 0 15px 0;
}
#SplashContainer #SignInPane {
 float:left;
 width:150px;
}
#RobloxNews {
 float:left;
 width:158px;
 height:90px;
 background-color:#eee;
 overflow:hidden;
}
#SplashContainer #Figure {
 margin-top:60px;
}
#SplashContainer #RobloxAtAGlance {
 background-color:#eee;
 border:solid 1px #000;
 float:right;
 margin:0 0 10px 0;
 padding:10px;
 position:relative;
 text-align:left;
 width:715px;
}
#SplashContainer #RobloxAtAGlance #ThingsToDo {
 color:#666;
 float:left;
 list-style:none;
 margin:0;
 padding:0;
 width:292px;
}
#SplashContainer #RobloxAtAGlance #ThingsToDo li {
 background-position:0 0;
 background-repeat:no-repeat;
 margin:0 0 25px 0;
 padding:0 0 0 56px;
}
#SplashContainer #RobloxAtAGlance #ThingsToDo h3 {
 line-height:1em;
 margin:0 0 5px 0;
 padding:0;
}
#SplashContainer #RobloxAtAGlance #ThingsToDo #Point1 {
 background-image:url(/web/20090604133500im_/http://www.roblox.com/images/BuildIcon.png);
}
#SplashContainer #RobloxAtAGlance #ThingsToDo #Point2 {
 background-image:url(/web/20090604133500im_/http://www.roblox.com/images/FriendsIcon.png);
}
#SplashContainer #RobloxAtAGlance #ThingsToDo #Point3 {
 background-image:url(/web/20090604133500im_/http://www.roblox.com/images/BattleIcon.png);
}
#SplashContainer #RobloxAtAGlance #Showcase {
 float:right;
 margin:0;
 width:400px;
}
#SplashContainer #RobloxAtAGlance #Install {
 clear:both;
 margin:5px 0 0 0;
 width:715px;
}
#SplashContainer #RobloxAtAGlance #ForParents {
 border:solid 1px #000;
 bottom:10px;
 height:125px;
 left:10px;
 position:absolute;
 width:125px;
}
#SplashContainer #RobloxAtAGlance #PrivPolicy {
 bottom:10px;
 height:125px;
 left:140px;
 position:absolute;
 width:140px;
}
#SplashContainer #ForParents_SignedIn {
 height:125px;
 padding-top:20px;
 width:125px;
}
#SplashContainer #RobloxAtAGlance #Install #CompatibilityNote {
 color:#666;
 float:left;
 font:normal 9px/normal Verdana,Arial,Helvetica,sans-serif;
 text-align:right;
 width:310px;
}
#SplashContainer #RobloxAtAGlance #Install #DownloadAndPlay {
 float:right;
 width:400px;
}
#SplashContainer #UserPlacesPane {
 border:solid 1px #000;
 clear:both;
 margin:0;
}
#SplashContainer #UserPlacesPane #UserPlaces_Header {
 background-color:#bbb;
 border-right:solid 1px #000;
 padding:10px;
 width:142px;
}
.AspNet-Login .AspNet-Login-UserPanel,.AspNet-Login .AspNet-Login-PasswordPanel,.AspNet-Login .AspNet-Login-RememberMePanel,.AspNet-Login .AspNet-Login-SubmitPanel {
    padding: .25em .1em 0 0;
}

.AspNet-Login .AspNet-Login-UserPanel,.AspNet-Login .AspNet-Login-PasswordPanel,.AspNet-Login .AspNet-Login-SubmitPanel {
    text-align: right;
}

.AspNet-Login .AspNet-Login-UserPanel label,.AspNet-Login .AspNet-Login-PasswordPanel label,#PaneLogin .TextboxLabel {
    white-space: nowrap;
}

.AspNet-Login .AspNet-Login-UserPanel input,.AspNet-Login .AspNet-Login-PasswordPanel input {
    width: 9em;
}

.AspNet-Login .AspNet-Login-SubmitPanel input {
    height: 1.7em;
}

#PaneNewUser {
    float: right;
    width: 170px;
    background-color: #dcdcdc;
    padding: 0 22px 22px;
}

#PaneLogin {
    width: 18em;
    padding: 0;
}

#PaneLogin .AspNet-Login div {
    margin: 10px;
}
#LoginView {
    border: solid 1px Black;
    width: 150px;
    height: 250px;
}

#LoginView h5 {
    background-color: #ccc;
    border-bottom: solid 1px #000;
    margin: 0;
}

#LoginView #AlreadySignedIn {
    background-color: #eee;
}

#LoginView .Label {
    font-weight: bold;
}

#LoginView .Text {
    width: 133px;
}

#LoginView .AspNet-Login {
    height: 225px;
    background-color: #eee;
}

#LoginView .AspNet-Login .AspNet-Login-InstructionPanel,#LoginView .AspNet-Login .AspNet-Login-HelpPanel,#LoginView .AspNet-Login .AspNet-Login-UserPanel,#LoginView .AspNet-Login .AspNet-Login-PasswordPanel,#LoginView .AspNet-Login .AspNet-Login-RememberMePanel {
    padding: 3px 5px 3px 5px;
    text-align: left;
}

#LoginView .AspNet-Login .AspNet-Login-SubmitPanel,#LoginView .AspNet-Login .AspNet-Create-Account {
    padding: 10px 5px 5px 10px;
    text-align: center;
}

#LoginView .AspNet-Login .AspNet-Login-PasswordRecoveryPanel {
    padding: 5px 5px 5px 5px;
    text-align: center;
}

#LoginView .AspNet-Login .AspNet-Login-PasswordRecoveryPanel a {
    color: #999;
    font: normal 9px/normal Verdana,sans-serif;
    padding: 5px 5px 5px 5px;
    text-align: center;
}

#LoginView .AspNet-Login .AspNet-Login-PasswordRecoveryPanel a:hover {
    color: Blue;
}

#Footer {
    font: normal 8px/normal Verdana,sans-serif;
    margin-top: 10px;
    width: 900px;
    text-align: center;
}

#Footer .FooterNav {
    font-size: 10px;
}

#Footer .Legalese {
    margin: 0;
}
#SplashContainer #SignInPane {
 float:left;
 width:157px !important;
}
</style>
<?php } else { ?>
<style>
.FrontPagePanel {
 float:left;
 border:solid 1px black;
 margin:5px;
 background-color:White;
}
#SignInPane {
 border:none;
 margin-left:0;
 width:152px;
 height:250px;
}
#Movie {
 width:424px;
 height:250px;
}
#FrontPageRectangleAd {
 margin:5px 0 5px 5px;
 width:300px;
 height:250px;
 background-color:Transparent;
}
#SalesPitch {
 margin-left:0;
 width:586px;
 height:90px;
}
#WhatsNew {
 margin-left:0;
 width:586px;
 height:280px;
}
#RandomFacts {
 float:right;
 margin-right:0;
 width:300px;
 height:150px;
}
.RandomFactoid {
 text-align:center;
 height:32px;
 width:290px;
 padding:2px;
 overflow:hidden;
}
#marqueecontainer {
 position:relative;
 width:300px;
 height:100px;
 background-color:white;
 overflow:hidden;
}
.RandomFactoid img {
 float:left;
}
#ParentsCorner {
 margin-right:0;
 width:300px;
 height:220px;
 _height:240px;
}
#ParentsCorner #Inside {
 padding:10px;
}
.ShieldImage {
 float:left;
 padding:5px;
}
.TrusteeSeal {
 float:left;
 width:140px;
 padding:5px;
}
#NewsFeeder {
 margin-right:0;
 width:158px;
 height:90px;
}
#FrontPageBannerAd {
 margin-left:0;
 width:728px;
 height:90px;
 background-color:Transparent;
}
.BadAdButton {
 background-color:Transparent;
 border:0;
 font-size:.8em;
 font-family:Verdana;
 padding:0;
 position:relative;
 text-align:center;
 height:8px;
 top:-2px;
 right:0;
}
.BadAdButton:hover {
 background-color:#fff;
 border:solid 1px #000;
 text-decoration:none;
}
#InviteAFriendContainer {
 padding:10px 10px 10px 10px;
}
#InviteAFriendContainer h3 {
 margin:0 auto;
 padding:0 0 10px 0;
 text-align:left;
 width:700px;
}
#InviteAFriendContainer #Exposition {
 margin:0 auto;
 padding:0 0 10px 0;
 width:700px;
}
#InviteAFriendContainer .Buttons {
 margin:0 auto;
 padding:10px 0 0 0;
 width:700px;
}
#InviteAFriendContainer .Button {
 border:solid 1px #000;
 color:#000;
 float:right;
 font-family:Verdana,Sans-Serif;
 margin:0 0 0 10px;
 padding:3px 10px 3px 10px;
 text-decoration:none;
}
#InviteAFriendContainer .MultilineTextBox {
 border-color:Gray;
 border-style:dashed;
 font-family:Arial,Sans-Serif;
 line-height:1.5em;
 padding:5px 5px 5px 5px;
 width:92%;
}
#InviteAFriendContainer .TextBox {
 border-color:Gray;
 border-style:dashed;
 font-family:Arial,Sans-Serif;
 padding:5px 5px 5px 5px;
 width:92%;
}
#InviteAFriendContainer .Label {
 font-weight:bold;
}
#InviteAFriendContainer #InvitationElements {
 border:solid 1px #000;
 margin:0 auto;
 padding:5px 5px 5px 5px;
 width:688px;
}
#InviteAFriendContainer #Name,
#InviteAFriendContainer #Recipients,
#InviteAFriendContainer #Message {
 margin:15px 0 0 0;
}
#InviteAFriendContainer .FormLabel {
 float:left;
 width:94px;
}
#InviteAFriendContainer .FormField {
 float:left;
 width:317px;
}
#InviteAFriendContainer .FormNotes {
 float:right;
 font-family:Verdana;
 font-size:xx-small;
 width:277px;
}
#InviteAFriendContainer #Confirmation h3 {
 margin:0 auto;
 text-align:left;
 width:400px;
}
#InviteAFriendContainer #Confirmation #Message {
 border:solid 1px #000;
 margin:0 auto;
 padding:10px 10px 10px 10px;
 width:380px;
}
#InviteAFriendContainer #Confirmation .Buttons {
 margin:0 auto;
 width:400px;
}
#SplashContainer h2 {
 color:#333;
 font-size:x-large;
 margin:0 0 5px 0;
}
#SplashContainer h3 {
 color:#333;
 letter-spacing:normal;
 margin:0 0 15px 0;
}
#SplashContainer #SignInPane {
 float:left;
 width:150px;
}
#RobloxNews {
 float:left;
 width:158px;
 height:90px;
 background-color:#eee;
 overflow:hidden;
}
#SplashContainer #Figure {
 margin-top:60px;
}
#SplashContainer #RobloxAtAGlance {
 background-color:#eee;
 border:solid 1px #000;
 float:right;
 margin:0 0 10px 0;
 padding:10px;
 position:relative;
 text-align:left;
 width:715px;
}
#SplashContainer #RobloxAtAGlance #ThingsToDo {
 color:#666;
 float:left;
 list-style:none;
 margin:0;
 padding:0;
 width:292px;
}
#SplashContainer #RobloxAtAGlance #ThingsToDo li {
 background-position:0 0;
 background-repeat:no-repeat;
 margin:0 0 25px 0;
 padding:0 0 0 56px;
}
#SplashContainer #RobloxAtAGlance #ThingsToDo h3 {
 line-height:1em;
 margin:0 0 5px 0;
 padding:0;
}
#SplashContainer #RobloxAtAGlance #ThingsToDo #Point1 {
 background-image:url(/web/20090604133500im_/http://www.roblox.com/images/BuildIcon.png);
}
#SplashContainer #RobloxAtAGlance #ThingsToDo #Point2 {
 background-image:url(/web/20090604133500im_/http://www.roblox.com/images/FriendsIcon.png);
}
#SplashContainer #RobloxAtAGlance #ThingsToDo #Point3 {
 background-image:url(/web/20090604133500im_/http://www.roblox.com/images/BattleIcon.png);
}
#SplashContainer #RobloxAtAGlance #Showcase {
 float:right;
 margin:0;
 width:400px;
}
#SplashContainer #RobloxAtAGlance #Install {
 clear:both;
 margin:5px 0 0 0;
 width:715px;
}
#SplashContainer #RobloxAtAGlance #ForParents {
 border:solid 1px #000;
 bottom:10px;
 height:125px;
 left:10px;
 position:absolute;
 width:125px;
}
#SplashContainer #RobloxAtAGlance #PrivPolicy {
 bottom:10px;
 height:125px;
 left:140px;
 position:absolute;
 width:140px;
}
#SplashContainer #ForParents_SignedIn {
 height:125px;
 padding-top:20px;
 width:125px;
}
#SplashContainer #RobloxAtAGlance #Install #CompatibilityNote {
 color:#666;
 float:left;
 font:normal 9px/normal Verdana,Arial,Helvetica,sans-serif;
 text-align:right;
 width:310px;
}
#SplashContainer #RobloxAtAGlance #Install #DownloadAndPlay {
 float:right;
 width:400px;
}
#SplashContainer #UserPlacesPane {
 border:solid 1px #000;
 clear:both;
 margin:0;
}
#SplashContainer #UserPlacesPane #UserPlaces_Header {
 background-color:#bbb;
 border-right:solid 1px #000;
 padding:10px;
 width:142px;
}
.AspNet-Login .AspNet-Login-UserPanel,.AspNet-Login .AspNet-Login-PasswordPanel,.AspNet-Login .AspNet-Login-RememberMePanel,.AspNet-Login .AspNet-Login-SubmitPanel {
    padding: .25em .1em 0 0;
}

.AspNet-Login .AspNet-Login-UserPanel,.AspNet-Login .AspNet-Login-PasswordPanel,.AspNet-Login .AspNet-Login-SubmitPanel {
    text-align: right;
}

.AspNet-Login .AspNet-Login-UserPanel label,.AspNet-Login .AspNet-Login-PasswordPanel label,#PaneLogin .TextboxLabel {
    white-space: nowrap;
}

.AspNet-Login .AspNet-Login-UserPanel input,.AspNet-Login .AspNet-Login-PasswordPanel input {
    width: 9em;
}

.AspNet-Login .AspNet-Login-SubmitPanel input {
    height: 1.7em;
}

#PaneNewUser {
    float: right;
    width: 170px;
    background-color: #dcdcdc;
    padding: 0 22px 22px;
}

#PaneLogin {
    width: 18em;
    padding: 0;
}

#PaneLogin .AspNet-Login div {
    margin: 10px;
}
#LoginView {
    border: solid 1px Black;
    width: 150px;
    height: 250px;
}

#LoginView h5 {
    background-color: #ccc;
    border-bottom: solid 1px #000;
    margin: 0;
}

#LoginView #AlreadySignedIn {
    background-color: #eee;
}

#LoginView .Label {
    font-weight: bold;
}

#LoginView .Text {
    width: 133px;
}

#LoginView .AspNet-Login {
    height: 225px;
    background-color: #eee;
}

#LoginView .AspNet-Login .AspNet-Login-InstructionPanel,#LoginView .AspNet-Login .AspNet-Login-HelpPanel,#LoginView .AspNet-Login .AspNet-Login-UserPanel,#LoginView .AspNet-Login .AspNet-Login-PasswordPanel,#LoginView .AspNet-Login .AspNet-Login-RememberMePanel {
    padding: 3px 5px 3px 5px;
    text-align: left;
}

#LoginView .AspNet-Login .AspNet-Login-SubmitPanel,#LoginView .AspNet-Login .AspNet-Create-Account {
    padding: 10px 5px 5px 10px;
    text-align: center;
}

#LoginView .AspNet-Login .AspNet-Login-PasswordRecoveryPanel {
    padding: 5px 5px 5px 5px;
    text-align: center;
}

#LoginView .AspNet-Login .AspNet-Login-PasswordRecoveryPanel a {
    color: #999;
    font: normal 9px/normal Verdana,sans-serif;
    padding: 5px 5px 5px 5px;
    text-align: center;
}

#LoginView .AspNet-Login .AspNet-Login-PasswordRecoveryPanel a:hover {
    color: Blue;
}

#Footer {
    font: normal 8px/normal Verdana,sans-serif;
    margin-top: 10px;
    width: 900px;
    text-align: center;
}

#Footer .FooterNav {
    font-size: 10px;
}

#Footer .Legalese {
    margin: 0;
}

#SplashContainer #SignInPane {
 float:left;
 width:157px !important;
}
</style>
<?php } ?>
<script>
var _____WB$wombat$assign$function_____ = function(name) {return (self._wb_wombat && self._wb_wombat.local_init && self._wb_wombat.local_init(name)) || self[name]; };
if (!self.__WB_pmw) { self.__WB_pmw = function(obj) { this.__WB_source = obj; return this; } }
{
  let window = _____WB$wombat$assign$function_____("window");
  let self = _____WB$wombat$assign$function_____("self");
  let document = _____WB$wombat$assign$function_____("document");
  let location = _____WB$wombat$assign$function_____("location");
  let top = _____WB$wombat$assign$function_____("top");
  let parent = _____WB$wombat$assign$function_____("parent");
  let frames = _____WB$wombat$assign$function_____("frames");
  let opener = _____WB$wombat$assign$function_____("opener");

/***********************************************
* Cross browser Marquee II- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

var delayb4scroll=2000 //Specify initial delay before marquee starts to scroll on page (2000=2 seconds)
var marqueespeed=1 //Specify marquee scroll speed (larger is faster 1-10)
var pauseit=1 //Pause marquee onMousever (0=no. 1=yes)?

////NO NEED TO EDIT BELOW THIS LINE////////////

var copyspeed=marqueespeed
var pausespeed=(pauseit==0)? copyspeed: 0
var actualheight=''

function scrollmarquee(){
if (parseInt(cross_marquee.style.top)>(actualheight*(-1)+8))
cross_marquee.style.top=parseInt(cross_marquee.style.top)-copyspeed+"px"
else
cross_marquee.style.top=parseInt(marqueeheight)+8+"px"
}

function initializemarquee(){
cross_marquee=document.getElementById("vmarquee")
cross_marquee.style.top=0
marqueeheight=document.getElementById("marqueecontainer").offsetHeight
actualheight=cross_marquee.offsetHeight
if (window.opera || navigator.userAgent.indexOf("Netscape/7")!=-1){ //if Opera or Netscape 7x, add scrollbars to scroll and exit
cross_marquee.style.height=marqueeheight+"px"
cross_marquee.style.overflow="scroll"
return
}
setTimeout('lefttime=setInterval("scrollmarquee()",100)', delayb4scroll)
}

if (window.addEventListener)
window.addEventListener("load", initializemarquee, false)
else if (window.attachEvent)
window.attachEvent("onload", initializemarquee)
else if (document.getElementById)
window.onload=initializemarquee




}
/*
     FILE ARCHIVED ON 13:35:21 Jun 04, 2009 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 00:51:42 Feb 08, 2024.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*
playback timings (ms):
  exclusion.robots: 0.072
  exclusion.robots.policy: 0.062
  cdx.remote: 0.091
  esindex: 0.009
  LoadShardBlock: 450.179 (6)
  PetaboxLoader3.datanode: 195.148 (7)
  load_resource: 72.285
  PetaboxLoader3.resolve: 35.807
*/
</script>
<script src="https://web.archive.org/web/20090604133254js_/http://www.<?=$sitename?>.com/UserControls/Marquee.js" type="text/javascript"></script>
<script src="https://web.archive.org/web/20090604133254js_/http://www.<?=$sitename?>.com/Thumbs/Asset.asmx/js" type="text/javascript"></script>
<div id="Body">
            
    <div id="SplashContainer">
		<div id="SignInPane">
<?php if($loggedin == "no"){ ?>
<div class="FrontPagePanel" id="SignInPane">
	    
<div id="LoginViewContainer">
	
			<div id="LoginView">
				<h5>Member Login</h5>
				
<div class="AspNet-Login">
						
					<form method="POST" action="/Login/Default.aspx">
              <div class="AspNet-Login-UserPanel">
                <label for="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_UserName" id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_UserNameLabel" class="Label">Character Name</label>
                <input name="UserName" type="text" id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_UserName" tabindex="1" class="Text">
              </div>
              <div class="AspNet-Login-PasswordPanel">
                <label for="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_Password" id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_PasswordLabel" class="Label">Password</label>
                <input name="Password" type="password" id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_Password" tabindex="2" class="Text">
              </div>
							<div class="AspNet-Login-SubmitPanel">
								<button type="submit" name="lb" tabindex="4" type="submit" class="Button">Login</button>
							</div>
<div id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_RegisterDiv" align="center">
<br>
								<a id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_Register" tabindex="5" class="Button" href="/Login/NewAge.aspx">Register</a>
							</div>
							
							<div align="center">
							    <br>
							    <a id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_ParentLogin" tabindex="6" class="Button" href="javascript:alert('You\'re more than 13 years old... Right?');">Parent Login</a>
							</div>
							                         
							<div class="AspNet-Login-PasswordRecoveryPanel">
								<a id="ctl00_cphRoblox_rbxLoginView_lvLoginView_lSignIn_hlPasswordRecovery" tabindex="6" href="Login/ResetPasswordRequest.aspx">Forgot your password?</a>
							</div>
</form>
</div>
			</div>
		
</div>

		
</div><?php } if($loggedin == "yes"){ ?>
<div class="FrontPagePanel" id="SignInPane">
	    
<div id="LoginViewContainer">
			<div id="LoginView">
								<h5>Logged in</h5>
				<div id="AlreadySignedIn">
					<a title="<?=$_USER['username']?>" href="/User.aspx" style="display:inline-block;height:190px;width:152px;cursor:pointer;"><img src="/img/user/<?=$_USER['id']?>.png?rand=<?php echo rand(0, 198391839891232); ?>" style="display:inline-block;width:145px;margin-top:15px;" border="0" id="img" alt="<?php echo addslashes($_USER["username"]); ?>"></a>
				</div>
							</div>
		</div>
</div><?php } ?>
</div>
	</div>
	<div class="FrontPagePanel" id="Movie">
	    <iframe width="424" height="250" src="https://www.youtube.com/embed/0pCofClXlfc?si=mA545eww0gsyj2Gc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div> <!-- <iframe id="embedplayer" src="https://bitview.net/embed?v=YpdA9n6dG5m" width="424" height="250" allowfullscreen scrolling="off" frameborder="0"></iframe></div>
	!--> <div class="FrontPagePanel" id="FrontPageRectangleAd">
	    

<div style="overflow: hidden;">
     
        <iframe id="ctl00_cph<?=$sitename?>_LargeRectAd_AsyncAdIFrame" scrolling="no" frameborder="0" allowtransparency="true" src="/images/Ads/IFrameAdContent.aspx?slot=<?=$sitename?>_Home_Medium_Rectangle_300x250" width="300" height="250" data-ruffle-polyfilled=""></iframe>   

            <a id="ctl00_cph<?=$sitename?>_LargeRectAd_ReportAdButton" title="click to give feedback on an ad" class="BadAdButton" href="javascript:__doPostBack('ctl00$cph<?=$sitename?>$LargeRectAd$ReportAdButton','')">[ feedback ]</a> 
              
</div>  


	</div>
	<div class="FrontPagePanel" id="SalesPitch">
	    
        <a id="ctl00_cph<?=$sitename?>_MoneyMachine_PlayNowButton" href="Games.aspx"><img src="/images/PlayNow3.png" border="0"></a>   
       
	</div>
	<div class="FrontPagePanel" id="RandomFacts">
	    


<div id="ctl00_cph<?=$sitename?>_RandomFacts_pRandomFacts">
	

        <h3 style="text-align: center;"><?=$sitename?> Facts</h3>
        
        <div id="marqueecontainer" onmouseover="copyspeed=pausespeed" onmouseout="copyspeed=marqueespeed">
        <div id="vmarquee" style="position: absolute;">

		        <?php 
											$stmt = $db->query("SHOW TABLE STATUS LIKE 'games'");
											$row = $stmt->fetch(PDO::FETCH_ASSOC);
											$lastId = (int)$row['Auto_increment'];
											$a = rand(1, $lastId);
											$stmtt = $db->prepare("SELECT * FROM games WHERE id=?");
											$stmtt->execute([(int)$a]);
											$game = $stmtt->fetch(PDO::FETCH_ASSOC);
			
			
											  $creatorshit = $db->prepare("SELECT * FROM users WHERE id = :creatorid");
											  $creatorshit->bindParam(':creatorid', $game['creatorid'], PDO::PARAM_INT);
											  $creatorshit->execute();
											  $creator = $creatorshit->fetch(PDO::FETCH_ASSOC);

											  $favorites = $db->prepare("SELECT COUNT(*) FROM favorites WHERE itemid = :itemid AND type = 'games'");
											  $favorites->bindParam(':itemid', $game['id'], PDO::PARAM_INT);
											  $favorites->execute();
											  $totalfavorite = $favorites->fetchColumn();
											  $gamevisitq = $db->prepare("SELECT * FROM gamevisits WHERE gameid=?");
											  $gamevisitq->execute([$game['id']]);
											  $visits = $gamevisitq->rowCount();
											  $updated = context::updated($game['updated']);
		?>
<?php
$placeq = $db->prepare("SELECT * FROM games");
$placeq->execute();
$itemp = $placeq->fetch(PDO::FETCH_ASSOC);

$userq = $db->prepare("SELECT * FROM users");
$userq->execute();
$users = $userq->rowCount();

$placeq = $db->prepare("SELECT * FROM games");
$placeq->execute();

$shirtq = $db->prepare("SELECT * FROM catalog WHERE type='shirt'");
$shirtq->execute();
$itemss = $shirtq->rowCount();

$pantsq = $db->prepare("SELECT * FROM catalog WHERE type='pants'");
$pantsq->execute();
$itemsp = $pantsq->rowCount();

$adminsq = $db->prepare("SELECT * FROM users WHERE USER_PERMISSIONS='Administrator'");
$adminsq->execute();
$admins = $adminsq->rowCount();
?>
         <div class="RandomFactoid"><img src="/images/House.png"><a href="Item.aspx?ID=<?=$itemp['id']?>"><b><?=$itemp['name']?></b></a> has been visited <b>0</b> times today</div>
<div class="RandomFactoid">
    <img src="/images/Admin.png">
    <b><?=$admins?></b> administrators are providing help in the <?=$sitename?> community
</div>

<div class="RandomFactoid">
    <img src="/images/Shirt.png">
    <b><?=$itemss?></b> <a href="Catalog.aspx?type=shirt">shirts are available in the shirts section of the catalog
</div>

<div class="RandomFactoid">
    <img src="/images/Pants.png">
    <b><?=$itemsp?></b> <a href="Catalog.aspx?type=pants">pants are available in the pants section of the catalog
</div>

<div class="RandomFactoid">
    <img src="/images/Shield.png">
    there are <b><?=$users?></b> <a href="Parents.aspx">users</a> keeping track of their account on <?=$sitename?>
</div>

<div class="RandomFactoid">
    <img src="/images/House.png">
    <a href="Item.aspx?ID=<?=$game['id']?>"><b><?=$game['name']?></b></a> has been favorited <b>0</b> times today
</div>

<div class="RandomFactoid">
    <img src="/images/ShoppingBag.png">
    the average bid for a user-run <b>rectangle</b> ad is <b>2761</b> tickets
</div>

<div class="RandomFactoid">
    <img src="/images/Bux.png">
    100 MADBUX buys about <b>1000</b> tickets on the <a href="Marketplace/TradeCurrency.aspx">Currency Exchange</a> right now
</div>




        <!--YOUR SCROLL CONTENT HERE-->

        </div>
        </div>
    

</div>

	</div>
	<div class="FrontPagePanel" id="WhatsNew">
<div>
    <div style="text-align: center;"><h3>Featured Free Game: <span id="ctl00_cph<?=$sitename?>_FeaturedGames_GameName"><?=$game['name']?></span></h3></div>
    <div style="float: left;">
        <div style="margin: 0px 5px 5px 5px; ">
            <a id="ctl00_cph<?=$sitename?>_FeaturedGames_AssetThumbnailImage" disabled="disabled" title="<?=$game['name']?>" href="PlaceItem.aspx?ID=<?=$game['id']?>" style="display:inline-block;"><img height="230" width="420" src="/img/games/<?php echo $game['id'].'.png?rand='.rand(0, getrandmax()) ?>" border="0" onerror="return <?=$sitename?>.Controls.Image.OnError(this)" alt="Doom Caverns - a <?=$sitename?> free game"></a>
        </div>
    </div>
    <div style="float: right;">
        <div style="margin: 0px 5px 5px 2px; text-align: center;">    
            <a id="ctl00_cph<?=$sitename?>_FeaturedGames_PlayThis" title="Play this free game!" href="PlaceItem.aspx?ID=<?=$game['id']?>"><img title="Play this free game!" src="/images/PlayThis.png" border="0"></a>
            <div id="LastUpdate">Updated: <?= ($updated) ?></div>
            <div id="Favorited">Favorited: <?=$totalfavorite?> times</div>
            <div id="ctl00_cph<?=$sitename?>_FeaturedGames_VisitedPanel" class="Visited">Visited: <?=$visits?> times</div>
            <div id="Creator" class="Creator">
                <div class="Avatar">
                    <a id="ctl00_cph<?=$sitename?>_FeaturedGames_AvatarImage" title="<?=$creator['username']?>" href="/img/user/<?=$creator['id']?>.png?rand=<?php echo rand(0, 198391839891232); ?>" style="display:inline-block;cursor:pointer;"><img src="/img/user/<?=$creator['id']?>.png?rand=<?php echo rand(0, 198391839891232); ?>" border="0" width="80" onerror="return <?=$sitename?>.Controls.Image.OnError(this)" alt="<?=$creator['username']?>"></a>
                </div>
                Creator: <a id="ctl00_cph<?=$sitename?>_FeaturedGames_CreatorHyperLink" href="User.aspx?ID=<?=$creator['id']?>"><?=$creator['username']?></a>
            </div>
        </div>
    </div>
</div>

	</div>
	<div class="FrontPagePanel" id="ParentsCorner">
	    <div id="Inside">
	        <img id="ctl00_cph<?=$sitename?>_ShieldImg" class="ShieldImage" src="/images/SuperSafe32.png" border="0">
	        <div style="float:left; font-size: x-large; height: 42px; width: 220px; text-align: center;">Gamers' Corner</div>
	        <div style="clear: left;"></div>
	        <p><?=$sitename?> is a gamer-friendly place on the internet where your gamers can have fun in a safe, <i>"moderated"</i> online environment</p>
	        <a id="ctl00_cph<?=$sitename?>_LearnMore" class="Button" href="javascript:__doPostBack('ctl00$cph<?=$sitename?>$LearnMore','')">Learn More</a>
	        <a id="ctl00_cph<?=$sitename?>_AccessParentAccount" class="Button" href="javascript:__doPostBack('ctl00$cph<?=$sitename?>$AccessParentAccount','')">Access Parent Account</a>
	        <a id="ctl00_cph<?=$sitename?>_PrivacyPolicy" href="info/Privacy.aspx"><div style="width: 120px; float: left; padding: 5px; font-size: medium;">Privacy Policy</div></a>
	        <a id="ctl00_cph<?=$sitename?>_TrusteeSeal" class="TrusteeSeal" href="https://web.archive.org/web/20090604133254/http://www.truste.org/ivalidate.php?url=www.<?=$sitename?>.com&amp;sealid=105"><img src="/images/truste_seal_kids.gif" border="0"></a>	    
	   </div>
	</div>
	<div class="FrontPagePanel" id="FrontPageBannerAd">
		

<div style="overflow: hidden;">
     
        <?php include($_SERVER["DOCUMENT_ROOT"]."/images/Ads/getrandom.php"); ?>
            <a id="ctl00_cph<?=$sitename?>_HomePageBottomBanner_ReportAdButton" title="click to give feedback on an ad" class="BadAdButton" href="javascript:__doPostBack('ctl00$cph<?=$sitename?>$HomePageBottomBanner$ReportAdButton','')">[ feedback ]</a> 
              
</div>  


	</div>
	<div class="FrontPagePanel" id="NewsFeeder">
	    <div id="ctl00_cph<?=$sitename?>_NewsFeed_p<?=$sitename?>News" class="<?=$sitename?>News">
	
    
    <div id="<?=$sitename?>News">
        <h4 style="text-align: center; height: 16px; margin: 0px 0px 2px 0px;"><a id="ctl00_cph<?=$sitename?>_NewsFeed_<?=$sitename?>NewsHyperLink" href="http://madblx.xyz/"><font color="graytext"><?=$sitename?> News</font></a></h4>
        <table id="ctl00_cph<?=$sitename?>_NewsFeed_dlNews" cellspacing="0" cellpadding="1" border="0" width="158">
		<tbody><tr>
			<td align="left">
            <li style="margin-left: 1px;">
                <a id="ctl00_cph<?=$sitename?>_NewsFeed_dlNews_ctl00_NewsItemHyperLink" href="http://madblx.xyz/Forum/ShowPost.aspx?id=134">MADBLOX 1.0 Changelog</a><br>
				
			    <li style="margin-left: 1px;">
                <a id="ctl00_cph<?=$sitename?>_NewsFeed_dlNews_ctl00_NewsItemHyperLink" href="http://madblx.xyz/Forum/ShowPost.aspx?id=213">MADBLOX 1.1 Changelog</a><br>
				
				</div>
		
			
	</tbody></table>
    </div>

</div>
	</div>

        </div><div style="clear: both;"></div>

<?php require_once($_SERVER['DOCUMENT_ROOT']."/core/footer.php");  ?>
