<?php
require_once 'core/database.php';
include 'core/head.php';
?>
<div id="Body">
<div id="info" style="position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(100,100,100,0.25);">
  <div style="position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
    <div id="UserBadgesPane" style="width: 400px;">
        <div id="UserBadges">
            <h4><font face="Comic sans MS" size="3">Builders Club</font></h4>
            <p style="margin-top: 15px;">This page is just for show and is non-functional</p>
            <p>We are not actually selling any form of membership or currency</p>
            <p>We apologize for any inconvenience</p>
            <div style="margin-bottom: 20px;" id="PurchaseButton">
                <a class="Button" onclick="$('#info').hide()">OK</a>
            </div>
            <table cellspacing="0" border="0" align="Center"> 
            </table>
        </div>      
    </div>
  </div>
</div>
<font face="Verdana">
  <br/><br/>
  <div id="BuildersClubContainer" style="border:1px solid black;">
  <div id="JoinBuildersClubNow"><img src="/images/JoinBuildersClubNow.png" alt="Join Builders Club Now!" style="margin-bottom:-2px;" /></div>
  <div id="MembershipOptions">
    <div id="OneMonth">
      <div class="BuildersClubButton"><a href="#" onclick="$('#info').show()"><img src="/images/BuyBCMonthly.png" style="border-width:0px;" /></a></div>
      <div class="Label"><a href="#" onclick="$('#info').show()">Join Monthly</a></div>
    </div>
    <div id="SixMonths">
      <div class="BuildersClubButton"><a href="#" onclick="$('#info').show()"><img src="/images/BuyBC6Months.png" style="border-width:0px;" /></a></div>
      <div class="Label"><a href="#" onclick="$('#info').show()">Join for 6 Months</a></div>
    </div>
    <div id="TwelveMonths">
      <div class="BuildersClubButton"><a href="#" onclick="$('#info').show()"><img src="/images/BuyBC12Months.png" style="border-width:0px;" /></a></div>
      <div class="Label"><a href="#" onclick="$('#info').show()">Join for 12 Months</a></div>
    </div>
  </div>
  <div id="WhyJoin">
    <h3>Why Join Builders Club?</h3>
    <ul class="MembershipBenefits">
      <li class="Benefit_MultiplePlaces">Create up to 10 places on a single account</li>
      <li class="Benefit_RobuxAllowance">Earn a daily income of 15 MADBUX</li>
      <!--<li id="Benefit_SuppressAds">Never see any outside ads on GOODBLOX.XYZ</li>-->
      <li class="Benefit_ExclusiveHat">Receive the exclusive Builders Club construction hard hat</li>
    </ul>
    <p>Product is Windows-only. For more information, read our <a href="../Parents/BuildersClub.aspx">Builders Club FAQs</a>.</p>
    <h3>Not Ready Yet?</h3>
    <ul class="MembershipBenefits">
    <li class="Benefit_RobuxAllowance">You can also <a href="MADBUX.aspx">grab MADBUX</a> by donating us. We will offer you some as our way of saying thank you. </li>
    <ul>
  </div>
  <div style="clear:both;"></div>
</font>
				</div>