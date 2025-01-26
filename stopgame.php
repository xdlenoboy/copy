<?php
include($_SERVER["DOCUMENT_ROOT"]."/core/head.php");

if($loggedin !== "yes") exit;

$id = (int)$_GET["id"] ?? 0;

$q = $db->prepare("SELECT * FROM games WHERE id=:id");
$q->bindParam(':id', $id);
$q->execute();
$game = $q->fetch(PDO::FETCH_ASSOC);

$q = $db->prepare("SELECT * FROM users WHERE id=:id");
$q->bindParam(':id', $game['creatorid']);
$q->execute();
$creator = $q->fetch(PDO::FETCH_ASSOC);

if($_USER["USER_PERMISSIONS"] !== "Administrator") {
	if((int)$creator['id'] !== (int)$_USER['id']) {
		exit("<h1>You do not own this place.</h1>");
	}
}

$q = $db->prepare("UPDATE games SET players = 0, port = 0 WHERE id = :id");
$q->bindParam(':id', $game["id"], PDO::PARAM_INT);
$q->execute();

$q = $db->prepare("INSERT INTO serversrq (id, action, value1, value2, gameserver) VALUES (NULL, 'stop-game', :value1, :value2, :gameserver)");
$q->bindParam(':value1', $game["id"], PDO::PARAM_INT);
$q->bindParam(':value2', $game["port"], PDO::PARAM_INT);
$q->bindParam(':gameserver', $game["gameserver"], PDO::PARAM_INT);
$q->execute();

header('location: /PlaceItem.aspx?ID='.$id);