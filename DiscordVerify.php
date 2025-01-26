<?php
header("location: /");
exit;
die();
require_once($_SERVER["DOCUMENT_ROOT"]."/core/head.php");
if($loggedin !== "yes")
    exit(header('location: /Login/Default.aspx'));

if((int)$_USER["discord_verified"] === 1)
    exit(header('location: /Default.aspx'));
?>
<h1>Discord Verification</h1>
<h2>Your account (<?php echo htmlspecialchars($_USER["username"]); ?>) needs to be verified using Discord to play <?=$sitename?>.</h2>
<a href="https://discord.com/oauth2/authorize?client_id=<?php echo (int)$env["discord"]["clientid"]; ?>&response_type=code&redirect_uri=http%3A%2F%2Fmadblx.xyz%2Fapi%2FDiscordVerification.ashx&scope=guilds+identify"><h3>Click here to verify using your Discord account</h3></a>
<?php require_once($_SERVER["DOCUMENT_ROOT"]."/core/footer.php"); ?>