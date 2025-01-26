<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/core/head.php";

try {
    $vaildbullshit = ["MostPopular", "RecentlyUpdated", "TopFavorites"];
    $m = $_GET['m'] ?? "MostPopular";
    if (!in_array($m, $vaildbullshit)) {
        $m = "MostPopular";
    }

    $resultsperpage = 15;
    $stmt = $db->query("SELECT COUNT(*) FROM games");
    $usercount = $stmt->fetchColumn();
    $numberofpages = ceil($usercount / $resultsperpage);

    $page = (isset($_GET['p']) && is_numeric($_GET['p'])) ? (int)$_GET['p'] : 1;
    $thispagefirstresult = ($page - 1) * $resultsperpage;
   
    switch ($m) {
        case "TopFavorites":
            $sql = "
    SELECT games.*, COUNT(favorites.id) AS total_favorites
    FROM games
    LEFT JOIN favorites ON games.id = favorites.itemid AND favorites.type = 'games'
    GROUP BY games.id
    ORDER BY total_favorites DESC
    LIMIT :firstResult, :resultsPerPage";

            break;
        case "RecentlyUpdated":
            $sql = "SELECT * FROM games
                    ORDER BY updated DESC
                    LIMIT :firstResult, :resultsPerPage";
            break;
        case "MostPopular":
        default:
            $sql = "SELECT games.*, COALESCE(COUNT(gamevisits.gameid), 0) AS total_visits
            FROM games
            LEFT JOIN gamevisits ON games.id = gamevisits.gameid
            GROUP BY games.id
            ORDER BY games.players DESC, total_visits DESC
            LIMIT :firstResult, :resultsPerPage";
            break;
    }

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':firstResult', $thispagefirstresult, PDO::PARAM_INT);
    $stmt->bindParam(':resultsPerPage', $resultsperpage, PDO::PARAM_INT);
    $stmt->execute();

    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<style>#GamesContainer {
  font-family:Verdana,Sans-Serif;
}
#GamesContainer h2 {
  font-family:Verdana,Sans-Serif;
  font-size:2.5em;
  font-weight:normal;
  line-height:1em;
  margin:0;
  padding:0;
}
#GamesContainer h4 {
  font-family:Verdana,Sans-Serif;
  font-size:1.3em;
  font-weight:normal;
  letter-spacing:.1em;
  line-height:1em;
  margin:15px 0;
  padding:0;
}
#GamesContainer ul {
  font-family:Verdana,Sans-Serif;
  list-style:none;
  margin:10px 0 30px 0;
  padding-left:0;
}
#GamesContainer ul li {
  font-family:Verdana,Sans-Serif;
  margin-bottom:.5em;
}
#GamesContainer ul a {
  font-size:1.1em;
}
#GamesContainer .DisplayFilters {
  width:175px;
}
#GamesContainer #Games {
  float:left;
  padding-bottom:10px;
  padding-left:0;
  padding-right:0;
  width:560px;
}
#GamesContainer .Ads_WideSkyscraper {
  border:solid 1px #000;
  float:right;
  text-align:right;
  width:160px;
}
#GamesContainer #Games .HeaderPager,
#GamesContainer #Games .FooterPager {
  margin:0 24px 0 0;
  padding:2px 0;
  text-align:right;
}
#GamesContainer #Games .HeaderPager {
  margin-bottom:10px;
}
#GamesContainer #Games .HeaderPager .Label,
#GamesContainer #Games .FooterPager .Label {
  font-size:1em;
  vertical-align:middle;
}
#GamesContainer .Game {
  margin:0 10px 15px 10px;
  vertical-align:top;
  width:162px;
}
#GamesContainer .Game .GameThumbnail {
  border:solid 1px #000;
  width:160px;
  height:100px;
  text-align:center;
}
#GamesContainer .Game .GameDetails {
  font-family:Verdana,Sans-Serif;
  overflow:hidden;
  padding:2px 0 6px 0;
  width:152px;
}
#GamesContainer .GameName a {
  font-size:.9em;
  font-weight:bold;
  line-height:1.5em;
  vertical-align:top;
}
.GamesBullet {
  padding-right:3px;
}
#GamesContainer .Label,
#GamesContainer .Detail,
#GamesContainer .DetailHighlighted {
  font-size:.8em;
}
#GamesContainer .DetailHighlighted {
  color:Red;
  font-weight:bold;
}
#GamesContainer .GamesDisplaySet {
  float:left;
  font-family:Comic Sans MS,Arial,Sans-Serif;
  font-size:1.5em;
}</style>
<div id="Body">
    <div id="GamesContainer">
        <div id="ctl00_cphRoblox_rbxGames_GamesContainerPanel">
            <div class="DisplayFilters">
                <h2>Games&nbsp;<a id="ctl00_cphRoblox_rbxGames_hlNewsFeed" href="/Games.aspx?feed=rss"><img src="/images/feed-icon-14x14.png" alt="RSS" border="0"></a></h2>
                <div id="BrowseMode">
                    <h4>Browse</h4>
                    <ul>
                        <li>
                            <?php if ($m == "MostPopular") { ?>
                                <img id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesBullet" class="GamesBullet" src="/images/games_bullet.png" border="0"/>
                                <a id="ctl00_cphRoblox_rbxGames_hlMostPopular" href="Games.aspx?m=MostPopular"><b>Most Popular</b></a>
                            <?php } else { ?>
                                <a id="ctl00_cphRoblox_rbxGames_hlMostPopular" href="Games.aspx?m=MostPopular">Most Popular</a>
                            <?php } ?>
                            <title><?php echo "MADBLOX Games - " . ($m == "MostPopular" ? "Most Popular" : ($m == "TopFavorites" ? "Top Favorites" : "Recently Updated")) . ""; ?></title>
                        </li>
                        <li>
                            <?php if ($m == "TopFavorites") { ?>
                                <img id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesBullet" class="GamesBullet" src="/images/games_bullet.png" border="0"/>
                                <a id="ctl00_cphRoblox_rbxGames_hlTopFavorites" href="Games.aspx?m=TopFavorites"><b>Top Favorites</b></a>
                            <?php } else { ?>
                                <a id="ctl00_cphRoblox_rbxGames_hlTopFavorites" href="Games.aspx?m=TopFavorites">Top Favorites</a>
                            <?php } ?>
                        </li>
                        <li>
                            <?php if ($m == "RecentlyUpdated") { ?>
                                <img id="ctl00_cphRoblox_rbxCatalog_BrowseModeTopFavoritesBullet" class="GamesBullet" src="/images/games_bullet.png" border="0"/>
                                <a id="ctl00_cphRoblox_rbxGames_hlRecentlyUpdated" href="Games.aspx?m=RecentlyUpdated"><b>Recently Updated</b></a>
                            <?php } else { ?>
                                <a id="ctl00_cphRoblox_rbxGames_hlRecentlyUpdated" href="Games.aspx?m=RecentlyUpdated">Recently Updated</a>
                            <?php } ?>
                        </li>
                        <li>
                            <a id="ctl00_cphRoblox_rbxGames_hlFeatured" href="/User.aspx?ID=1">Featured Games</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="Games">
                <span id="ctl00_cphRoblox_rbxGames_lGamesDisplaySet" class="GamesDisplaySet"><?php echo $m == "TopFavorites" ? "Top Favorites" : ($m == "RecentlyUpdated" ? "Recently Updated" : "Most Popular"); ?> Games</span>
                <div id="ctl00_cphRoblox_rbxGames_HeaderPagerPanel" class="HeaderPager">
                    <span id="ctl00_cphRoblox_rbxCatalog_HeaderPagerLabel">
                        <?php if ($page > 1) {
                            if ($numberofpages > 0) { ?>
                                <a id="ctl00_cphRoblox_rbxGames_hlHeaderPager_Next" href="Games.aspx?m=<?= ($m); ?>&p=<?= $page - 1; ?>"><span class="NavigationIndicators"><<</span> Previous</a>
                            <?php }
                        } ?>
                    </span>
                    <span id="ctl00_cphRoblox_rbxGames_HeaderPagerLabel">Page <?= $page; ?> of <?= $numberofpages; ?>:</span>
                    <span id="ctl00_cphRoblox_rbxCatalog_HeaderPagerLabel">
                        <?php if ($page < $numberofpages) { ?>
                            <a id="ctl00_cphRoblox_rbxGames_hlHeaderPager_Next" href="Games.aspx?m=<?= ($m); ?>&p=<?= $page + 1; ?>">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
                        <?php } ?>
                    </span>
                </div>

                <table id="ctl00_cphRoblox_rbxGames_dlGames" cellspacing="0" align="Center" border="0" width="550">
                    <tbody>
                      <?php if (count($games) > 0) {
                          $counter = 0;
                          foreach ($games as $row) {
                              if ($counter % 3 == 0) {
                                  echo '<tr>';
                              }

                              $creatorshit = $db->prepare("SELECT * FROM users WHERE id = :creatorid");
                              $creatorshit->bindParam(':creatorid', $row['creatorid'], PDO::PARAM_INT);
                              $creatorshit->execute();
                              $creator = $creatorshit->fetch(PDO::FETCH_ASSOC);

                              $favorites = $db->prepare("SELECT COUNT(*) FROM favorites WHERE itemid = :itemid AND type = 'games'");
                              $favorites->bindParam(':itemid', $row['id'], PDO::PARAM_INT);
                              $favorites->execute();
                              $totalfavorite = $favorites->fetchColumn();
                              $gamevisitq = $db->prepare("SELECT * FROM gamevisits WHERE gameid=?");
                              $gamevisitq->execute([$row['id']]);
                              $visits = $gamevisitq->rowCount();
                              $updated = context::updated($row['updated']);
                              ?>
                             
                             <td class="Game" valign="top">
                                    <div style="padding-bottom:5px">
                                        <div class="GameThumbnail">
                                            <a id="ctl00_cphRoblox_rbxGames_dlGames_ctl00_ciGame" title="<?=htmlspecialchars($row['name']) ?>" href="/PlaceItem.aspx?ID=<?= ($row['id']) ?>" style="display:inline-block;cursor:pointer;"><img src="/img/games/<?php echo $row['id'].'.png?rand='.rand(0, getrandmax()) ?>" border="0"  width="160" height="100" alt="<?=htmlspecialchars($row['name']) ?>"></a>
                                        </div>
                                        <div class="GameDetails">
                                            <div class="GameName"><a id="ctl00_cphRoblox_rbxGames_dlGames_ctl00_hlGameName" href="/PlaceItem.aspx?ID=<?= ($row['id']) ?>"><?=htmlspecialchars($row['name']) ?></a></div>
                                            <div class="GameLastUpdate"><span class="Label">Updated:</span> <span class="Detail"><?= ($updated) ?></span></div>
                                            <div class="GameCreator"><span class="Label">Creator:</span> <span class="Detail"><a id="ctl00_cphRoblox_rbxGames_dlGames_ctl00_hlCreator" href="/User.aspx?ID=<?= ($creator['id']) ?>"><?= ($creator['username']) ?></a></span></div>
                                            <div class="GameFavorites"><span class="Label">Favorited:</span> <span class="Detail"><?= ($totalfavorite) ?> times</span></div>
                                            <div class="GamePlays"><span class="Label">Played:</span> <span class="Detail"><?= ($visits) ?> times</span></div>
                                            <?php if($row['players'] > 0){ ?>
                                                <div class="GameCurrentPlayers"><span class="DetailHighlighted"><?=number_format($row['players'])?> players online</span></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </td>
                              <?php
                              $counter++;
                              if ($counter % 3 == 0) {
                                  echo '</tr>';
                              }
                          }

                          if ($counter % 3 != 0) {
                              echo '</tr>';
                          }
                      } else { ?>
                          <p>No results found.</p>
                      <?php } ?>
                    </tbody>
                </table>
                <div id="ctl00_cphRoblox_rbxGames_FooterPagerPanel" class="HeaderPager">
                    <span id="ctl00_cphRoblox_rbxCatalog_HeaderPagerLabel">
                        <?php if ($page > 1) {
                            if ($numberofpages > 0) { ?>
                                <a id="ctl00_cphRoblox_rbxGames_hlHeaderPager_Next" href="Games.aspx?m=<?= ($m); ?>&p=<?= $page - 1; ?>"><span class="NavigationIndicators"><<</span> Previous</a>
                            <?php }
                        } ?>
                    </span>
                    <span id="ctl00_cphRoblox_rbxGames_HeaderPagerLabel">Page <?= $page; ?> of <?= $numberofpages; ?>:</span>
                    <span id="ctl00_cphRoblox_rbxCatalog_HeaderPagerLabel">
                        <?php if ($page < $numberofpages) { ?>
                            <a id="ctl00_cphRoblox_rbxGames_hlHeaderPager_Next" href="Games.aspx?m=<?= ($m); ?>&p=<?= $page + 1; ?>">Next <span class="NavigationIndicators">&gt;&gt;</span></a>
                        <?php } ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="Ads_WideSkyscraper">
            <!--script type="text/javascript">
                atOptions = {
                    'key' : 'e8c68e95f06c2274be36f64edfc4ca60',
                    'format' : 'iframe',
                    'height' : 600,
                    'width' : 160,
                    'params' : {}
                };
            </script>
            <script type="text/javascript" src="//www.topcreativeformat.com/e8c68e95f06c2274be36f64edfc4ca60/invoke.js"></script-->
            <!--iframe data-aa='2340784' src='//ad.a-ads.com/2340784?size=160x600' style='width:160px; height:600px; border:0px; padding:0; overflow:hidden; background-color: transparent;'></iframe-->
            <img src="/max-design-pro-max-the-monkey.gif" style='width:160px; height:600px;'>
        </div>
      </div>

    <div style="clear: both;"></div>
</div>

<?php require_once $_SERVER["DOCUMENT_ROOT"]."/core/footer.php"; ?>
