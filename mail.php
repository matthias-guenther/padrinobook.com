<?php
require_once './mail/vendor/autoload.php';

$helperLoader = new SplClassLoader('Helpers', './mail/vendor');
$mailLoader   = new SplClassLoader('SimpleMail', './mail/vendor');

$helperLoader->register();
$mailLoader->register();

use Helpers\Config;
use SimpleMail\SimpleMail;

$config = new Config;
$config->load('./mail/config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email   = stripslashes(trim($_POST['form-email']));
    $subject = stripslashes(trim($_POST['form-subject']));
    $message = stripslashes(trim($_POST['form-message']));
    $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';

    if (preg_match($pattern, $email) || preg_match($pattern, $subject)) {
        die("Header injection detected");
    }

    $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL);

    if ($email && $emailIsValid && $subject && $message) {
        $mail = new SimpleMail();

        $mail->setTo($config->get('emails.to'));
        $mail->setFrom($config->get('emails.from'));
        $mail->setSenderEmail($email);
        $mail->setSubject($config->get('subject.prefix') . ' ' . $subject);

        $body = "
        <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
        <html>
            <head>
                <meta charset=\"utf-8\">
            </head>
            <body>
                <h1>{$subject}</h1>
                <p><strong>{$config->get('fields.message')}:</strong> <br>{$message}</p>
            </body>
        </html>";

        $mail->setHtml($body);
        $mail->send();

        $emailSent = true;
    } else {
        $hasError = true;
    }
}
?><!DOCTYPE html>
<html lang="en" class="no-js" prefix="og: http://ogp.me/ns#" >
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PadrinoBook</title>
    <meta name="description" content="PadrinoBook - The Guide To Master The Elegant Ruby Web Framework" />
    <meta name="author" content="Matthias Günther">
    <meta content="noodp" name="robots" >

    <link rel="canonical" href="https://padrinobook.com/" />

    <meta property="og:locale" content="en_US" />
    <meta property="og:site_name" content="Padrinobook" />
    <meta property="og:title" content="PadrinoBook - The Guide To Master The Elegant Ruby Web Framework" />
    <meta property="og:description" content="PadrinoBook - The Guide To Master The Elegant Ruby Web Framework" />
    <meta property="og:url" content="https://padrinobook.com/" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://padrinobook.com/logo.png" />

    <meta content="summary_large_image" name="twitter:card" />
    <meta content="@wikimatze" name="twitter:creator" />
    <meta content="@padrinobook" name="twitter:site" />
    <meta content="PadrinoBook - The Guide To Master The Elegant Ruby Web Framework written by @wikimatze " name="twitter:title" />
    <meta content="PadrinoBook - The Guide To Master The Elegant Ruby Web Framework written by @wikimatze " name="twitter:description" />
    <meta content="https://padrinobook.com/" name="twitter:url" />
    <meta content="https://farm4.staticflickr.com/3725/33337025026_d36474c52b_b_d.jpg" name="twitter:image:src" />

    <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/favicons/manifest.json">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg">
    <link rel="shortcut icon" href="/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-TileImage" content="/favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <link href="http://www.feedio.co/@padrinobook/feed" rel="alternate" type="application/rss+xml" title="RSS feed for PadrinoBook">

    <link rel="stylesheet" href="/css/bulma.css" />
    <link rel="stylesheet" href="/css/syntax.css">
    <!-- <link rel="stylesheet" href="/css/flexslider.css"> -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar">
      <div class="container">
        <div class="navbar-brand">
          <span class="navbar-burger burger" data-target="navbarMenu">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </div>
        <div id="navbarMenu" class="navbar-menu">

          <div class="navbar-end">
            <a  class="navbar-item" href="/" title="Back to home of padrinobook">Home</a>
            <a class="navbar-item" href="/about" title="Behind the padrinobook is wikimatze">About</a>
            <a class="navbar-item is-active" href="/mail.php" title="Contact me">Contact</a>
            <a class="navbar-item" href="/news" title="Overview of latest articles">News</a>
            <a class="navbar-item" href="/imprint" title="Legal stuff from me">Imprint</a>
            <a class="navbar-item" href="/contribute" title="Learn how to help me with padrinobook">Contribute</a>
          </div>
        </div>
      </div>
    </nav>

    <div class='social share'>
      <ul>
        <li>
          <a class='fab fa-twitter-square' href='https://twitter.com/padrinobook' rel='noopener noreferrer' target='_blank' title='Follow me on Twitter'></a>
        </li>
        <li>
          <a class='fab fa-facebook-square' href='https://www.facebook.com/padrinobook' rel='noopener noreferrer' target='_blank' title='Follow me on Facebook'></a>
        </li>
        <li>
          <a class='fab fa-google-plus-square' href="https://plus.google.com/109249095952663676924" rel='noopener noreferrer' target='_blank' title='Follow me on Google+'></a>
        </li>
        <li>
          <a class='fab fa-github-square' href='https://github.com/padrinobook/padrinobook' rel='noopener noreferrer' target='_blank' title='Follow me on GitHub'></a>
        </li>
        <li>
          <a class='fab fa-medium' href='https://medium.com/@padrinobook' rel='noopener noreferrer' target='_blank' title='Follow me on Medium'></a>
        </li>
      </ul>
    </div>

    <br>

    <div class="container content">
      <a href="/index.html" title="Padrinobook - A book about the Elegant Ruby Web Framework">
        <img id="logo" src="/logo.png" alt="Logo of Padrinobook"/>
      </a>
      <div id="logo-text">
        <strong>PadrinoBook</strong>
      </div>

      <br>
      <br>

      <header>
        <h1 class="lead">Contact</h1>
      </header>

    <?php if(!empty($emailSent)): ?>
        <div class="notification is-success">
            <?php echo $config->get('messages.success'); ?>
        </div>
    <?php else: ?>
        <?php if(!empty($hasError)): ?>
        <div class="notification is-danger">
            <?php echo $config->get('messages.error'); ?>
        </div>
        <?php endif; ?>

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="application/x-www-form-urlencoded" id="contact-form" class="form-horizontal" method="post">
            <div class="field">
              <label for="form-email" class="label"><?php echo $config->get('fields.email'); ?></label>
              <div class="control has-icons-left">
                <input type="email" class="input" id="form-email" name="form-email" placeholder="<?php echo $config->get('fields.email'); ?>" required>
                <span class="icon is-small is-left">
                  <i class="fas fa-envelope"></i>
                </span>
              </div>
            </div>
            <div class="field">
              <label for="form-email" class="label"><?php echo $config->get('fields.subject'); ?></label>
              <div class="control has-icons-left">
                <input type="text" class="input" id="form-subject" name="form-subject" placeholder="<?php echo $config->get('fields.subject'); ?>" required>
                <span class="icon is-small is-left">
                  <i class="fas fa-rocket"></i>
                </span>
              </div>
            </div>
            <div class="field">
              <label class="label"><?php echo $config->get('fields.message'); ?></label>
              <div class="control">
                <textarea class="textarea" id="form-message" name="form-message" placeholder="<?php echo $config->get('fields.message'); ?>" required></textarea>
              </div>
            </div>

            <div class="field is-grouped">
              <div class="control">
                <button type="submit" class="button is-large is-link"><?php echo $config->get('fields.btn-send'); ?></button>
              </div>
            </div>
        </form>
      <?php endif; ?>
    </div>

    <footer>
      <div class="container has-text-centered ">
        <hr>
        <nav>
          <i class="far fa-copyright"></i> <span class="copyright">Matthias Günther</span>
          <span class="footer-separater">&bull;</span>
          <a class="footer-desktop" href="/about">About</a>
          <span class="footer-separater">&bull;</span>
          <a class="footer-desktop" href="/mail.php">Contact</a>
          <span class="footer-separater">&bull;</span>
          <a class="footer-desktop" href="/news">News</a>
          <span class="footer-separater">&bull;</span>
          <a class="footer-desktop" href="/imprint">Imprint</a>
          <span class="footer-separater">&bull;</span>
          <a class="footer-desktop" href="/contribute">Contribute</a>
          <a class="footer-mobile" href="https://twitter.com/padrinobook" title="Follow padrinobook on twitter"><i class="fab fa-twitter"></i></a>
          <a class="footer-mobile" href="https://www.facebook.com/padrinobook" title="Follow padrinobook on facebook"><i class="fab fa-facebook-f"></i></a>
          <a class="footer-mobile" href="https://plus.google.com/109249095952663676924" title="Follow padrinobook on google+"><i class="fab fa-google-plus-g"></i></a>
          <a class="footer-mobile" href="https://medium.com/@padrinobook" title="Follow padrinobook on medium"><i class="fab fa-medium-m"></i></a>
          <a class="footer-mobile" href="https://github.com/padrinobook" title="Follow padrinobook on GitHub"><i class="fab fa-github-alt"></i></a>
        </nav>
      </div>
    </footer>

    <script type="text/javascript" src="mail/public/js/contact-form.js"></script>
    <script type="text/javascript">
        new ContactForm('#contact-form');
    </script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        // Get all "navbar-burger" elements
        var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

          // Add a click event on each of them
          $navbarBurgers.forEach(function ($el) {
            $el.addEventListener('click', function () {

              // Get the target from the "data-target" attribute
              var target = $el.dataset.target;
              var $target = document.getElementById(target);

              // Toggle the class on both the "navbar-burger" and the "navbar-menu"
              $el.classList.toggle('is-active');
              $target.classList.toggle('is-active');

            });
          });
        }
      });
    </script>

    <script type="text/javascript" src="/js/main.js"></script>
    <!-- <script type="text/javascript" src="/js/github-commits-widget.js"></script> -->

    <!-- Hotjar Tracking Code for https://padrinobook.com -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:442173,hjsv:5};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <!-- Piwik tracking pixel -->
    <noscript><p><img src="https://padrinobook.com/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
  </body>
</html>
