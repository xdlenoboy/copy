<?php
include($_SERVER["DOCUMENT_ROOT"]."/core/head.php");
// if($_USER["id"] !== 3) exit("Sorry, we are updating our server hoster to make it securer.");

if($testing == 'true' && ($_USER['USER_PERMISSIONS'] !== "Administrator" && $_USER['USER_PERMISSIONS'] !== "beta_tester")) {
    die("<div style='margin: 150px auto 150px auto; width: 500px; border: black thin solid; padding: 22px;'><strong><p>Games down because site up for testing purposes</p></strong></div>"); }
    

$id = (int)$_GET["id"] ?? 0;
$canJoin = false;
if($loggedin == "yes") $canJoin = true;
if($loggedin == "no" && (int)$_GLOBAL["guestEnabled"] === 1) $canJoin = true;
if($canJoin) {
$stmt = $db->prepare("SELECT * FROM games WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$game = $stmt->fetch(PDO::FETCH_ASSOC);

if($loggedin == "yes") {
$newaccountcode = bin2hex(random_bytes(11));
$stmt = $db->prepare("UPDATE users SET accountcode = :accountcode WHERE id = :id");
$stmt->bindParam(':accountcode', $newaccountcode);
$stmt->bindParam(':id', $_USER['id']);
$stmt->execute();
} else {
$newaccountcode = "guest".(int)random_int(1, 9999);
}

if($game["gameserver"] !== 0 && $game['players'] < 1){
    $q = $db->prepare("SELECT * FROM gameservers WHERE id = :id");
    $q->bindParam(':id', $game["gameserver"], PDO::PARAM_INT);
    $q->execute();
    $gameserver = $q->fetch();

    if($gameserver) {
        if($game['players'] == 1){
            $q = $db->prepare("UPDATE games SET players = 0, port = 0 WHERE id = :id");
            $q->bindParam(':id', $game["id"], PDO::PARAM_INT);
            $q->execute();
        
            $q = $db->prepare("INSERT INTO serversrq (id, action, value1, value2, gameserver) VALUES (NULL, 'stop-game', :value1, :value2, :gameserver)");
            $q->bindParam(':value1', $game["id"], PDO::PARAM_INT);
            $q->bindParam(':value2', $game["port"], PDO::PARAM_INT);
            $q->bindParam(':gameserver', $game["gameserver"], PDO::PARAM_INT);
            $q->execute();
        }
        
        sleep(5);
        
        $usedPorts = json_decode($gameserver["usedPorts"], true);
        
        if (is_array($usedPorts)) {
            $usedPorts = array_map('intval', array_values($usedPorts));
        } else {
            $usedPorts = [];
        }

        while(!$port) {
            list($start, $end) = explode('-', $gameserver["ports"]);
            $port = mt_rand($start, $end);
            if(in_array($port, $usedPorts)) {
                $port = null;
            }
        }
        
        array_push($usedPorts, $port);
        $newPorts = json_encode($usedPorts);
        
        $q = $db->prepare("UPDATE gameservers SET usedPorts = :ports WHERE id = :id");
        $q->bindParam(':ports', $newPorts, PDO::PARAM_STR);
        $q->bindParam(':id', $gameserver['id'], PDO::PARAM_INT);
        $q->execute();

        $q = $db->prepare("UPDATE games SET port = :port WHERE id = :id");
        $q->bindParam(':port', $port, PDO::PARAM_INT);
        $q->bindParam(':id', $game['id'], PDO::PARAM_INT);
        $q->execute();

        $q = $db->prepare("INSERT INTO serversrq (id, action, value1, value2, gameserver) VALUES (NULL, 'start-game', :value1, :value2, :gameserver)");
        $q->bindParam(':value1', $game['id'], PDO::PARAM_INT);
        $q->bindParam(':value2', $port, PDO::PARAM_INT);
        $q->bindParam(':gameserver', $gameserver['id'], PDO::PARAM_INT);
        $q->execute();
    }
}

sleep(3);

if($loggedin == "yes"){
    $q = $db->prepare("DELETE FROM gamevisits WHERE userid = ? AND gameid = ?");
    $q->execute([$_USER['id'], $game['id']]);

    $q = $db->prepare("INSERT INTO gamevisits (id, userid, gameid, whenjoined) VALUES (NULL, ?, ?, NOW())");
    $q->execute([$_USER['id'], $game['id']]);
}

$joinargs = '-script "wait(); dofile(\'http://madblx.xyz/join/character.php?placeid='.$game['id'].'&accountcode='.$newaccountcode.'\') dofile(\'http://madblx.xyz/join/play.php?placeid='.$game['id'].'&accountcode='.$newaccountcode.'\')"';
// if((int)$_USER["id"] === 3) exit($joinargs);
$b64joinargs = base64_encode($joinargs);
header('location: madbloxclient:'.$b64joinargs);
} else {
header('location: /Login/Default.aspx');
}
?>
<h1>Failed to join!</h1>
<p>Make sure you're logged in, or guests are enabled.</p>
<!--h1>How to play a game</h1>
<h3>Step 1: Radmin VPN</h3>
<a href="http://radmin-vpn.com/"><p>Download Radmin VPN here</p></a>
<p>Join the Radmin VPN network:</p>
<p>Name: DAYBLOX</p>
<p>Pass: lol123</p>
<h3>Step 2: Download <?=$sitename ?> Client</h3>
<a href="/download/MADBLOX-Client.zip"><p>Download <?=$sitename ?> here</p></a>
<h3>Step 3: Join the action!</h3>
<p>Go to your game, you clicked Play on <a href="/place.aspx?id=<?php echo $game['id']; ?>"><?php echo $game['name']; ?></a> before.</p>
<p>Then copy the PlaceId that you can find on the URL</p>
<img src="/images/gameid.png">
<p>Then open !Join.bat on the <?=$sitename ?> Client, paste the PlaceId and your Account Code</p>
<p><strong>Whats an Account Code?</strong> An Account Code is random characters linked to your <?=$sitename ?> account,</p>
<p>Your Account Code is: <?php echo $_USER['accountcode']; ?></p>
<p>Paste your Account Code into !Join.bat</p>
<h3>Step 4: Have fun!</h3>
<h2>Tutorial writen by nolanwhy</h2-->
<?php include($_SERVER["DOCUMENT_ROOT"]."/core/footer.php"); ?>