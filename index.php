<?php session_start();
require_once 'vendor/autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\GraphUser;

const id = "1468256266797643";
const mdp = "5598726dd2d32c30ca7e11b7eeb68016";
FacebookSession::setDefaultApplication(id, mdp);
?>

<!DOCTYPE html>
<html>

<head>
<meta charst="uth-8">
  <title>Application ESGI facebook</title>
  <meta name="description" content="">
  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1468256266797643',
      xfbml      : true,
      version    : 'v2.3'
    });
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/fr_FR/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</head>

<body>

<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>
<?php  
$redirectUrl = "https://appesgifacebook.herokuapp.com/";
$helper = new FacebookRedirectLoginHelper($redirectUrl);
// Checking Session
if(isset($_session) && isset($_session['fb_token']))
{
  $session = new FacebookSession($_session['fb_token']);
}
else
{
  $session = $helper->getSessionFromRedirect();
  // Login URL if session not found
  $loginURL = $helper->getLoginUrl(['email,user_brithday']);
}

if($session){

$user = (new FacebookRequest($session,'GET','/me'))->execute()->getGraphObject(GraphUser::className());

echo "bonjour ". $user->getName();

}else{
    echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
}


/*$loginUrl = $helper->getLoginUrl(['email,user_birthday']);
echo $loginUrl;*/
?>
<form method="post">
  
</form>


</body>
</html>

