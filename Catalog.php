<?php 

require_once 'core/database.php';

$title = "Catalog - " . $sitename;

include 'core/head.php';

$type = $_GET['type'] ?? 'hat';

if ($type == "hat") {
  $sname = "Hats";
}

if ($type == "pants") {
  $sname = "Pants";
}

if ($type == "tshirt") {
  $sname = "T-Shirts";
}

if ($type == "shirt") {
  $sname = "Shirts";
}

if ($type == "face") {
  $sname = "Faces";
}
if ($type == "head") {
  $sname = "Heads";
}

$m = $_GET['m'] ?? 'RecentlyUpdated';

if($m == "TopFavorites"){
	$mname = "Top Favorites";
}

if($m == "RecentlyUpdated"){
	$mname = "Recently Updated";
}

if($m == "ForSale"){
	$mname = "On Sale";
}

if($m == "BestSelling"){
	$mname = "Best Selling";
}

?>

<div id="CatalogContainer" style="margin-top: 5px">
  <div id="SearchBar" class="SearchBar">
    <span class="SearchBox"><input name="ctl00$cphRoblox$rbxCatalog$SearchTextBox" type="text" maxlength="100" id="ctl00_cphRoblox_rbxCatalog_SearchTextBox" class="TextBox" /></span>
    <span class="SearchButton"><input type="submit" name="ctl00$cphRoblox$rbxCatalog$SearchButton" value="Search" id="ctl00_cphRoblox_rbxCatalog_SearchButton" /></span>
  </div>
  <div class="DisplayFilters">
    <h2>Catalog</h2>
    <div id="BrowseMode">
	        <h4><a href="/Upgrades/Robux.aspx">Buy MADBUX!</a></h4>
			<h4><a href="/my/accountbalance/trade">Trade Currency!</a></h4>
      <h4>Browse</h4>
      <ul>
         <li><?php if ($m == "TopFavorites") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0" /> <?php } ?><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeFeaturedSelector" href="/Catalog.aspx?m=TopFavorites&type=<?=$type?>">Top Favorites</a></li>

       <li> <?php if ($m == "BestSelling") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0" /> <?php } ?><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeBestSellingSelector" href="/Catalog.aspx?m=BestSelling&type=<?=$type?>">Best Selling</a></li>

        <li><?php if ($m == "RecentlyUpdated") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0" /> <?php } ?><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeRecentlyUpdatedSelector" href="/Catalog.aspx?m=RecentlyUpdated&type=<?=$type?>">Recently Updated</a></li>

        <li><?php if ($m == "ForSale") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0" /> <?php } ?><a id="ctl00_cphRoblox_rbxCatalog_BrowseModeForSaleSelector" href="/Catalog.aspx?m=ForSale&type=<?=$type?>">For Sale</a></li>
      </ul>
    </div>
    <div id="Category">
      <h4>Category</h4>

      <ul>

        <li>
          <?php if ($type == "head") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0" /> <?php } ?>
          <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="/Catalog.aspx?type=head&m=<?=$m?>">Heads</a>
        </li>
		
		<li>
          <?php if ($type == "face") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0" /> <?php } ?>
          <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="/Catalog.aspx?type=face&m=<?=$m?>">Faces</a>
        </li>


        <li>
          <?php if ($type == "hat") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0" /> <?php } ?>
          <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_AssetCategorySelector" href="/Catalog.aspx?type=hat&m=<?=$m?>">Hats</a>
        </li>

        <li>
          <?php if ($type == "shirt") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0" /> <?php } ?>
          <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="/Catalog.aspx?type=shirt&m=<?=$m?>">Shirts</a>
        </li>

        <li>
          <?php if ($type == "pants") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0" /> <?php } ?>
          <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="/Catalog.aspx?type=pants&m=<?=$m?>">Pants</a>
        </li>
        
        <li>
          <?php if ($type == "tshirt") { ?> <img id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl01_SelectedCategoryBullet" class="GamesBullet" src="https://web.archive.org/web/20070914235314im_/http://www.roblox.com/images/games_bullet.png" border="0" /> <?php } ?>
          <a id="ctl00_cphRoblox_rbxCatalog_AssetCategoryRepeater_ctl02_AssetCategorySelector" href="/Catalog.aspx?type=tshirt&m=<?=$m?>">T-Shirts</a>
        </li>

      </ul>

    </div>
    <?php

    $resultsperpage = 20;

    if (!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] && (9223372036854775807 <= $_GET['page'] || $_GET['page'] <= 0))) {
      $page = 1;
    } else {
      $page = (int)addslashes($_GET['page']);
    }
    $previous = $page - 1;
    $next = $page + 1;

    $stmt = $db->prepare("SELECT * FROM catalog WHERE type=:type AND status='Accepted' ORDER BY id DESC");
    $stmt->bindValue(':type', $type, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $resultCheck = count($result);

    $numberofpages = ceil($resultCheck / $resultsperpage);

    ?>

  </div>
  <div class="Assets">
    <span id="ctl00_cphRoblox_rbxCatalog_AssetsDisplaySetLabel" class="AssetsDisplaySet"><?php echo $mname; ?> <?php echo $sname ?></span>
    <div id="ctl00_cphRoblox_rbxCatalog_FooterPagerPanel" class="HeaderPager">

      <?php if($page > 1){ ?><a id="ctl00_cphRoblox_rbxCatalog_FooterPagerHyperLink_Next" href="Catalog.aspx?m=<?=$m?>&type=<?= $type; ?>&page=<?= $previous; ?>"><span class="NavigationIndicators">
          << Previous</a> <?php } ?>

      <span id="ctl00_cphRoblox_rbxCatalog_FooterPagerLabel">Page <?= $page; ?> of <?= $numberofpages; ?>:</span>

      <a id="ctl00_cphRoblox_rbxCatalog_FooterPagerHyperLink_Next" href="Catalog.aspx?m=<?=$m?>&type=<?= $type; ?>&page=<?= $next; ?>">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
    </div>
    <table id="ctl00_cphRoblox_rbxCatalog_AssetsDataList" cellspacing="0" align="Center" border="0" width="735">

      <?php

      $thispagefirstresult = ($page - 1) * $resultsperpage;
      $thispagefirstresult = ($page - 1) * $resultsperpage;
      if($m == "RecentlyUpdated"){
      $stmt = $db->prepare("SELECT * FROM catalog WHERE type=:type AND status='Accepted' ORDER BY id DESC LIMIT " . $thispagefirstresult . "," . $resultsperpage);
      }
      if($m == "TopFavorites"){
      $stmt = $db->prepare("
    SELECT catalog.*, COUNT(favorites.itemid) AS favorites_count
    FROM catalog
    LEFT JOIN favorites ON catalog.id = favorites.itemid
    WHERE catalog.type = :type AND catalog.status = 'Accepted'
    GROUP BY catalog.id
    ORDER BY favorites_count DESC, catalog.id DESC
    LIMIT " . $thispagefirstresult . "," . $resultsperpage
);

}

     if($m == "BestSelling"){
      $stmt = $db->prepare("
    SELECT catalog.*, COUNT(owneditems.itemid) AS owns_count
    FROM catalog
    LEFT JOIN owneditems ON catalog.id = owneditems.itemid
    WHERE catalog.type = :type AND catalog.status = 'Accepted'
    GROUP BY catalog.id
    ORDER BY owns_count DESC, catalog.id DESC
    LIMIT " . $thispagefirstresult . "," . $resultsperpage
);

}

if($m == "ForSale"){
      $stmt = $db->prepare("SELECT * FROM catalog WHERE type=:type AND status='Accepted' AND offsale=0 ORDER BY id DESC LIMIT " . $thispagefirstresult . "," . $resultsperpage);
      }


      $stmt->bindValue(':type', $type, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetchAll();
      $resultCheck = count($result);

      if ($resultCheck > 0) {
        foreach ($result as $row) {
          $creatorq = $db->prepare("SELECT * FROM users WHERE id=:creatorid");
          $creatorq->bindValue(':creatorid', $row['creatorid'], PDO::PARAM_INT);
          $creatorq->execute();
          $creator = $creatorq->fetch(PDO::FETCH_ASSOC);

$fqr = $db->prepare("SELECT * FROM favorites WHERE itemid=?");
$fqr->execute([$row['id']]);
$ftimes = $fqr->rowCount();

          if($row['type'] == "hat"){ $typea = "hats"; } elseif($row['type'] == "pants"){ $typea = "pants"; } elseif($row['type'] == "shirt"){ $typea = "shirts"; } elseif($row['type'] == "pants"){ $typea = "pants"; } elseif($row['type'] == "head"){ $typea = "heads"; }
      ?>


          <a href="/Item.aspx?id=<?php echo $row['id']; ?>">
            <td valign="top" style="display:inline-block;  padding: 11px;cursor:pointer;">
              <div class="Asset">
                <div style="display:inline-block;cursor:pointer;">
                  <div class="AssetThumbnail">
                    <a id="ctl00_cphRoblox_rbxCatalog_AssetsDataList_ctl00_AssetThumbnailHyperLink" title="" href="/Item.aspx?id=<?php echo (int)$row['id']; ?>" style="display:inline-block;cursor:pointer; <?php if($type == "tshirt"){?>background-image: url(/images/tshirt.png); background-size: 120px 120px; height: 120px; width: 120px;<?php } ?>"><img src="<?php if ($row['type'] == 'tshirt') {
                                                                                                                                                                                                                      echo $row['filename'];
                                                                                                                                                                                                                    }elseif ($row['status'] == 'Pending') {
                                                                                                                                                                                                                      echo 'images/reviewpending.png';
                                                                                                                                                                                                                    }elseif ($row['status'] == 'Declined') {
                                                                                                                                                                                                                      echo 'images/declined.png';
                                                                                                                                                                                                                    }elseif ($row['status'] == 'Accepted') {
                                                                                                                                                                                                                      if ($row['type'] !== "face"){ echo "http://".$sitedomain."/img/catalog/".$typea."/".$row['id'].".png?rand=".random_int(1,999999999999999999); } else { echo $row['thumbnail']; }
                                                                                                                                                                                                                    } ?>" width="<?php if($row['type'] == "hat"){ echo "100"; } elseif($row['type'] == "head"){ echo "100"; } elseif($row['type'] == "shirt") { echo "100"; } elseif($row['type'] == "pants" ) { echo "100"; } else { echo "120"; } ?>" height="120" border="0" id="imga" alt="" blankurl="http://t6.roblox.com:80/blank-120x120.gif" <?php if($type == "tshirt"){?>style="height: 70px; width: 70px; margin-top: 27px;"<?php } ?> /></a>
                  </div>
                  
                  <div class="AssetDetails">

                    <strong><a id="ctl00_cphRoblox_rbxUserAssetsPane_UserAssetsDataList_ctl06_AssetNameHyperLink" href="/Item.aspx?id=<?php echo $row['id']; ?>"><?php echo filterText(htmlspecialchars($row['name'])); ?></a></strong>
                    <div class="AssetLastUpdate"><span class="Label">Updated:</span> <span class="Detail">
                                <?php
                                $timestamp = strtotime($row['updated']);
                                $currentTimestamp = time();
                                $timeDifference = $currentTimestamp - $timestamp;

                                // Calculate the time difference for each row individually
                                if ($timeDifference >= 31536000) {
                                    // More than a year
                                    $timeAgo = floor($timeDifference / 31536000);
                                    echo $timeAgo . ' year' . ($timeAgo > 1 ? 's' : '') . ' ago';
                                } elseif ($timeDifference >= 2419200) {
                                    // More than a month
                                    $timeAgo = floor($timeDifference / 2419200);
                                    echo $timeAgo . ' month' . ($timeAgo > 1 ? 's' : '') . ' ago';
                                } elseif ($timeDifference >= 604800) {
                                    // More than a week
                                    $timeAgo = floor($timeDifference / 604800);
                                    echo $timeAgo . ' week' . ($timeAgo > 1 ? 's' : '') . ' ago';
                                } elseif ($timeDifference >= 86400) {
                                    // More than a day
                                    $timeAgo = floor($timeDifference / 86400);
                                    echo $timeAgo . ' day' . ($timeAgo > 1 ? 's' : '') . ' ago';
                                } elseif ($timeDifference >= 3600) {
                                    // More than an hour
                                    $timeAgo = floor($timeDifference / 3600);
                                    echo $timeAgo . ' hour' . ($timeAgo > 1 ? 's' : '') . ' ago';
                                } elseif ($timeDifference >= 60) {
                                    // More than a minute
                                    $timeAgo = floor($timeDifference / 60);
                                    echo $timeAgo . ' minute' . ($timeAgo > 1 ? 's' : '') . ' ago';
                                } else {
                                    // Less than a minute
                                    echo $timeDifference . ' second' . ($timeDifference > 1 ? 's' : '') . ' ago';
                                }
                                ?>

    
                        
                    </span></div>
                    <div class="AssetCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxCatalog_AssetsDataList_ctl00_GameCreatorHyperLink" href="/User.aspx?id=<?php echo (int)$creator['id']; ?>"><?php echo htmlspecialchars($creator['username']); ?></a></span></div>
                    <div class="AssetsSold"><span class="Label">Number Sold:</span> <span class="Detail">
                    
                    <?php 
                    $stmt2 = $db->prepare("SELECT * FROM owneditems WHERE itemid=:itemid");
                    $stmt2->bindValue(':itemid', $row['id'], PDO::PARAM_STR);
                    $stmt2->execute();
                    $result2 = $stmt2->rowCount();
                    
                    echo $result2;
                    
                    ?>
                    
                    </span></div>
                    <div class="AssetFavorites"><span class="Label">Favorited:</span> <span class="Detail"><?=$ftimes?> times</span></div>
                    


                    <?php if ($row['offsale'] == '0') { ?><div id="ctl00_cphRoblox_rbxCatalog_AssetsDataList_ctl00_Div3" class="AssetPrice"><span class="PriceIn<?php if ($row['buywith'] == 'tix') {
                                                                                                                                                                  echo 'Tickets';
                                                                                                                                                                } else {
                                                                                                                                                                  echo 'Robux';
                                                                                                                                                                } ?>"><?php if ($row['buywith'] == 'tix') {
                                                                                                                                                                        echo 'Tx';
                                                                                                                                                                      } else {
                                                                                                                                                                        echo 'G$';
                                                                                                                                                                      } ?>: <?php echo number_format($row['price']); ?></span></div> <?php } ?>
                  </div>
                </div>
            </td>
          </a>
      <?php }
      } ?>
    </table>
    <div id="ctl00_cphRoblox_rbxCatalog_FooterPagerPanel" class="HeaderPager">

      <a id="ctl00_cphRoblox_rbxCatalog_FooterPagerHyperLink_Next" href="Catalog.aspx?type=<?= $type; ?>&page=<?= $previous; ?>"><span class="NavigationIndicators">
          << Previous</a>

      <span id="ctl00_cphRoblox_rbxCatalog_FooterPagerLabel">Page <?= $page; ?> of <?= $numberofpages; ?>:</span>

      <a id="ctl00_cphRoblox_rbxCatalog_FooterPagerHyperLink_Next" href="Catalog.aspx?type=<?= $type; ?>&page=<?= $next; ?>">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
    </div>
  </div>
  <div style="clear: both;" />
</div>

</div>