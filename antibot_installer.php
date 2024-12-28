<?php
set_time_limit(900);
ignore_user_abort(true);
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('html_errors', 1);
header('Content-Type: text/html; charset=UTF-8');
header('X-Robots-Tag: noindex');
header('Expires: Thu, 18 Aug 1994 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');

$time = time();
$dt = 1735175541;
$email = 'victorspencer173@gmail.com';
$pass = 'tOMSitSkGTWn5KEfjbXLegZ6k';

$start_time = microtime(true);
clearstatcache();

function abRandword($length=4){
return substr(str_shuffle("qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM"),0,$length);
}

$dirname = dirname($_SERVER['REQUEST_URI']); // текущая директория
if ($dirname != DIRECTORY_SEPARATOR) {$dirname = $dirname.'/';} else {$dirname = '/';}

// 2 символьный код языка из языка браузера:
$lang_code = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? mb_substr(mb_strtolower(trim(preg_replace("/[^a-zA-Z]/","",$_SERVER['HTTP_ACCEPT_LANGUAGE'])), 'UTF-8'), 0, 2, 'utf-8') : 'en'; // 2 первых символа

if ($time - $dt > 604800) {
echo '<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>'.(($lang_code == 'ru') ? 'Инсталлятор устарел' : 'The installer is outdated').'</title>
<meta name="robots" content="noindex" />
</head>
<body>
<center><h2>'.(($lang_code == 'ru') ? 'Инсталлятор устарел, скачайте новый скрипт в личном кабинете на сайте <a href="https://antibot.cloud/" target="_blank" rel="noopener">AntiBot.Cloud</a>.' : 'The installer is outdated, download the new script in your personal account on the <a href="https://antibot.cloud/" target="_blank" rel="noopener">AntiBot.Cloud</a> website.').'</h2></center>
</body>
</html>';
die();
}


$ok = 1;
$post_result = '';
$result = '<p> </p>';

@unlink('antibot9.zip');

if ($dirname != '/') {
$result .= '<div class="alert alert-danger" role="alert">'.(($lang_code == 'ru') ? 'Файл <strong>antibot_installer.php</strong> нужно загрузить в корневую директорию домена, а не в поддиректорию.' : 'You need to upload the <strong>antibot_installer.php</strong> file to the root directory of the domain, not to a subdirectory.').'</div>';
$ok = 0;
}

if (!is_writable(__DIR__)) {
$result .= '<div class="alert alert-danger" role="alert">'.(($lang_code == 'ru') ? 'Установите права на запись для директории:' : 'Set write permissions for the directory:').' <strong>'.dirname($_SERVER['SCRIPT_FILENAME']).'</strong></div>';
$ok = 0;
}

if (!is_writable($_SERVER['SCRIPT_FILENAME'])) {
$result .= '<div class="alert alert-danger" role="alert">'.(($lang_code == 'ru') ? 'Установите права на запись (777) для файла:' : 'Set write permissions (777) for the file:').' <strong>'.basename($_SERVER['SCRIPT_FILENAME']).'</strong></div>';
$ok = 0;
}

if (extension_loaded('curl')) {
$result .= '<div class="alert alert-success" role="alert">CURL - '.(($lang_code == 'ru') ? 'установлен' : 'installed').'</div>';
} else {
$result .= '<div class="alert alert-danger" role="alert">CURL - '.(($lang_code == 'ru') ? 'не установлен' : 'not installed').' (<a href="https://www.php.net/manual/en/book.curl.php" target="_blank" rel="noopener">'.(($lang_code == 'ru') ? 'подробнее' : 'more').'</a>)</div>';
$ok = 0;
}

if (extension_loaded('zip')) {
$result .= '<div class="alert alert-success" role="alert">ZIP - '.(($lang_code == 'ru') ? 'установлен' : 'installed').'</div>';
} else {
$result .= '<div class="alert alert-danger" role="alert">ZIP - '.(($lang_code == 'ru') ? 'не установлен' : 'not installed').' (<a href="https://www.php.net/manual/en/book.zip.php" target="_blank" rel="noopener">'.(($lang_code == 'ru') ? 'подробнее' : 'more').'</a>)</div>';
$ok = 0;
}

if (extension_loaded('gmp')) {
$result .= '<div class="alert alert-success" role="alert">GMP - '.(($lang_code == 'ru') ? 'установлен' : 'installed').'</div>';
} else {
$result .= '<div class="alert alert-danger" role="alert">GMP - '.(($lang_code == 'ru') ? 'не установлен' : 'not installed').' (<a href="https://www.php.net/manual/en/book.gmp.php" target="_blank" rel="noopener">'.(($lang_code == 'ru') ? 'подробнее' : 'more').'</a>), '.(($lang_code == 'ru') ? 'требуется для поддержки IPv6' : 'needed for IPv6 support').'</div>';
$ok = 0;
}

if (extension_loaded('sqlite3')) {
$result .= '<div class="alert alert-success" role="alert">SQLite3 v. '.SQLite3::version()['versionString'].' - '.(($lang_code == 'ru') ? 'установлен' : 'installed').'</div>';
} else {
$result .= '<div class="alert alert-danger" role="alert">SQLite3 - '.(($lang_code == 'ru') ? 'не установлен' : 'not installed').' (<a href="https://www.php.net/manual/en/book.sqlite3.php" target="_blank" rel="noopener">'.(($lang_code == 'ru') ? 'подробнее' : 'more').'</a>)</div>';
$ok = 0;
}

if (extension_loaded('mbstring')) {
$result .= '<div class="alert alert-success" role="alert">Mbstring - '.(($lang_code == 'ru') ? 'установлен' : 'installed').'</div>';
} else {
$result .= '<div class="alert alert-danger" role="alert">Mbstring - '.(($lang_code == 'ru') ? 'не установлен' : 'not installed').' (<a href="https://www.php.net/manual/en/book.mbstring.php" target="_blank" rel="noopener">'.(($lang_code == 'ru') ? 'подробнее' : 'more').'</a>)</div>';
$ok = 0;
}

if(function_exists('imagecreatetruecolor')) {
$result .= '<div class="alert alert-success" role="alert">GD library - '.(($lang_code == 'ru') ? 'установлен' : 'installed').'</div>';
} else {
$result .= '<div class="alert alert-danger" role="alert">GD library - '.(($lang_code == 'ru') ? 'не установлен' : 'not installed').' (<a href="https://www.php.net/manual/en/book.image.php" target="_blank" rel="noopener">'.(($lang_code == 'ru') ? 'подробнее' : 'more').'</a>)</div>';
$ok = 0;
}

if (defined('AF_INET6')) {
$result .=  '<div class="alert alert-success" role="alert">PHP '.(($lang_code == 'ru') ? 'скомпилирован без' : 'was compiled without').' --disable-ipv6 option</div>';
} else {
$result .=  '<div class="alert alert-danger" role="alert">PHP '.(($lang_code == 'ru') ? 'скомпилирован с' : 'was compiled with').' --disable-ipv6 option</div>';
}

if (version_compare(PHP_VERSION, '5.6.0', '>=')) {
$result .= '<div class="alert alert-success" role="alert">'.(($lang_code == 'ru') ? 'Версия PHP:' : 'PHP version:').' '.PHP_VERSION.'</div>';
} else {
$result .= '<div class="alert alert-danger" role="alert">'.(($lang_code == 'ru') ? 'Версия PHP:' : 'PHP version:').' '.PHP_VERSION.' ('.(($lang_code == 'ru') ? 'Минимальная версия:' : 'Minimum version:').' 5.6)</div>';
$ok = 0;
}

$result .=  '<span id="headresult"></span>';

if (isset($_POST['antibot_install']) AND $ok == 1) {

$post_result .= '<p></p>';
$send_mail = isset($_POST['email']) ? trim(mb_strtolower($_POST['email'], 'utf-8')) : ''; // email
$send_pass = isset($_POST['pass']) ? trim($_POST['pass']) : ''; // pass
$send_webdir = isset($_POST['webdir']) ? trim(preg_replace("/[^a-zA-Z0-9]/","", $_POST['webdir'])) : '';

if ($send_mail != $email OR $send_pass != $pass) {
$post_result .= '<div class="alert alert-danger" role="alert">'.(($lang_code == 'ru') ? 'Email или пароль не совпадает.' : 'Email or password does not match.').'</div>';
$ok = 0;
}

if ($send_webdir == '') {
$post_result .= '<div class="alert alert-danger" role="alert">'.(($lang_code == 'ru') ? 'Вы не указали директорию, в которую устанавливать.' : 'You did not specify the directory in which to install.').'</div>';
$ok = 0;
}

if (is_dir(__DIR__ . DIRECTORY_SEPARATOR.$send_webdir)) {
$post_result .= '<div class="alert alert-danger" role="alert">'.(($lang_code == 'ru') ? 'Директория <strong>'.$send_webdir.'</strong> существует. Удалите ее для новой установки.' : 'The <strong>'.$send_webdir.'</strong> directory exists. Remove it for a new installation.').'</div>';
$ok = 0;
}

if ($send_webdir == '') {
$post_result .= '<div class="alert alert-danger" role="alert">'.(($lang_code == 'ru') ? 'Не задано название директории.' : 'No directory URL is given.').'</div>';
$ok = 0;
}

if ($ok == 1) {
$fp = fopen(__DIR__.'/antibot9.zip', 'w');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://antibot.cloud/static/update/antibot9.zip');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 600);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($ch, CURLOPT_TIMEOUT, 120);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_USERAGENT, 'AntiBot');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_TRY);
$outch = curl_exec($ch);
curl_close($ch);
fclose($fp);

$zip = new ZipArchive;
if ($zip->open(__DIR__.DIRECTORY_SEPARATOR.'antibot9.zip') === TRUE) {
    $zip->extractTo(__DIR__.DIRECTORY_SEPARATOR.$send_webdir.DIRECTORY_SEPARATOR);
    $zip->close();

if (file_exists(__DIR__.DIRECTORY_SEPARATOR.$send_webdir.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'conf.php')) {
$conf = file_get_contents(__DIR__.DIRECTORY_SEPARATOR.$send_webdir.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'conf.php');
$conf = str_ireplace('{webdir}', $dirname.$send_webdir.'/', $conf);
$conf = str_ireplace('{email}', $email, $conf);
$conf = str_ireplace('{pass}', $pass, $conf);
$conf = str_ireplace('{salt}', abRandword(9), $conf); // salt
$conf = str_ireplace('{cookie}', abRandword(6), $conf); // cookie name
file_put_contents(__DIR__.DIRECTORY_SEPARATOR.$send_webdir.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'conf.php', $conf, LOCK_EX);

$post_result = '<div class="alert alert-success" role="alert">
'.(($lang_code == 'ru') ? 'Установка прошла успешно.' : 'The installation was successful.').' <a href="'.$dirname.$send_webdir.'/admin.php?abp=checklist" target="_blank">'.(($lang_code == 'ru') ? 'Админ панель.' : 'Admin panel.').'</a> <small>('.(($lang_code == 'ru') ? 'Логин и пароль такой же, как на сайте antibot.cloud' : 'The login and password are the same as on the antibot.cloud website').')</small>
<script>document.location.href="'.$dirname.$send_webdir.'/admin.php?abp=checklist";</script>
</div>';
$ok = 2;
// удаление инсталятора:
if (!@unlink($_SERVER['SCRIPT_FILENAME'])) {
$result .= '<div class="alert alert-danger" role="alert">
'.(($lang_code == 'ru') ? 'Ошибка удаления файла antibot_installer.php. Удалите его самостоятельно.' : 'Error deleting antibot_installer.php file. Delete it yourself.').'
</div>';
} else {
$post_result .= '<div class="alert alert-success" role="alert">
'.(($lang_code == 'ru') ? 'Файл antibot_installer.php успешно удален, он больше не нужен.' : 'The antibot_installer.php file has been successfully removed and is no longer needed.').'
</div>';
}
} else {
$post_result .= '<div class="alert alert-danger" role="alert">
'.(($lang_code == 'ru') ? 'Ошибка установки.' : 'Installation error.').'
</div>';
}

} else {
$post_result .= '<div class="alert alert-danger" role="alert">
'.(($lang_code == 'ru') ? 'Ошибка распаковки архива.' : 'Archive unpacking error.').'
</div>';
}
@unlink('antibot9.zip');
}
$ok = 1;
}

echo '<!DOCTYPE html>
<html>
<head>
<title>'.(($lang_code == 'ru') ? 'Установка AntiBot Cloud 9' : 'Installing AntiBot Cloud 9').'</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container-md p-2">
	<div class="row">
<div class="col-lg-1"></div>
<div class="col-lg-10">
<div class="card">
  <h2 class="card-header">'.(($lang_code == 'ru') ? 'Установка AntiBot Cloud 9' : 'Installing AntiBot Cloud 9').'</h2>
<div class="container">
<div>'.$post_result.'</div>
  <div class="row">
    <div class="col-sm">
    '.(($ok == 0) ? '<div class="alert alert-danger" role="alert">'.(($lang_code == 'ru') ? 'Установка скрипта АнтиБот невозможна. Для продолжения - выполните рекомендации:' : 'AntiBot script installation is not possible. To continue, please follow these recommendations:').'</div>' : '').'
    '.$result.'
    </div>
    <div class="col-sm">
    '.(($ok == 1) ? '<form action="" method="post">

<div class="form-group">
<p></p><p>
<small class="form-text text-muted">'.(($lang_code == 'ru') ? 'Введите email и пароль от аккаунта <a href="https://antibot.cloud/" target="_blank" rel="noopener">AntiBot.Cloud</a>, в личном кабинете которого вы скачали этот скрипт инсталлятор и укажите директорию, в которую установить (она не должна существовать, будет создана автоматически):' : 'Enter the email and password for the <a href="https://antibot.cloud/" target="_blank" rel="noopener">AntiBot.Cloud</a> account, from whose User Panel you downloaded this script installer, and specify the directory where to install (it should not exist, it will be created automatically):').'</small>
</p>
</div>
<div class="form-group">
      <label for="email">Email:</label>
      <input name="email" type="email" class="form-control" id="email">
</div>
<div class="form-group">
      <label for="password">'.(($lang_code == 'ru') ? 'Пароль' : 'Password').':</label>
      <input name="pass" type="password" class="form-control" id="password">
</div>
<div class="form-group">
      <label for="webdir">'.(($lang_code == 'ru') ? 'Директория' : 'Directory').':</label>
      <input name="webdir" type="text" class="form-control" id="webdir" value="protect'.rand(111,999).'">
</div>
<div class="form-group"><button name="antibot_install" type="submit" class="btn btn-success btn-block">'.(($lang_code == 'ru') ? 'Шаг' : 'Step').' 1: '.(($lang_code == 'ru') ? 'Установить Антибот' : 'Install AntiBot').'</button></div>

    </form>' : '').'

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">'.(($lang_code == 'ru') ? 'Шаг' : 'Step').' 2: '.(($lang_code == 'ru') ? 'Подключить Антибот' : 'Connect AntiBot').'</h4>
  <p>'.(($lang_code == 'ru') ? 'После установки - подключите Антибот в ваши скрипты, которые нужно защитить:' : 'After installation - connect AntiBot to your scripts that need to be protected:').' <a href="'.(($lang_code == 'ru') ? 'https://antibot.cloud/FAQ/cms.html' : 'https://antibot.cloud/FAQ/cms.html').'" target="_blank">'.(($lang_code == 'ru') ? 'Подключение Антибота в зависимости от CMS.' : 'AntiBot integration based on CMS.').'</a></p>
</div>

    </div>
  </div>
</div>

</div>

</div>
</div>
<div class="col-lg-1"></div>
</div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch(\'/\', {
        method: \'HEAD\',
        cache: \'no-store\'  // чтобы избежать чтения из кэша
    })
    .then(response => {
        if (response.headers.has(\'Cache-Control\')) {
            let cacheControlValue = response.headers.get(\'Cache-Control\');
            let maxAgeMatch = cacheControlValue.match(/max-age=(\d+)/i);
            
            if (maxAgeMatch && parseInt(maxAgeMatch[1], 10) > 0) {
                document.getElementById("headresult").innerHTML = `<div class="alert alert-danger" role="alert">'.(($lang_code == 'ru') ? 'Cache-Control содержит max-age=${maxAgeMatch[1]}' : 'Cache-Control has max-age=${maxAgeMatch[1]}').' (<a href="'.(($lang_code == 'ru') ? 'https://antibot.cloud/FAQ/cache-control.html' : 'https://antibot.cloud/FAQ/cache-control.html').'" target="_blank" rel="noopener">'.(($lang_code == 'ru') ? 'подробнее' : 'more').'</a>).</div>`;
            } else {
                document.getElementById("headresult").innerHTML = \'<div class="alert alert-success" role="alert">'.(($lang_code == 'ru') ? 'Заголовок Cache-Control не больше 0.' : 'Cache-Control header is not greater than 0.').'</div>\';
            }
        } else {
            document.getElementById("headresult").innerHTML = \'<div class="alert alert-success" role="alert">'.(($lang_code == 'ru') ? 'Сайт не содержит заголовок Cache-Control.' : 'Cache-Control header not found.').'</div>\';
        }
    })
    .catch(error => {
        document.getElementById("headresult").innerHTML = \'<div class="alert alert-danger" role="alert">'.(($lang_code == 'ru') ? 'Ошибка проверки Cache-Control:' : 'Cache-Control check failed:').' \' + error.message + \'</div>\';
    });
});
</script>';
$exec_time = microtime(true) - $start_time;
$exec_time = round($exec_time, 5);
echo '<center>'.(($lang_code == 'ru') ? 'Время выполнения скрипта:' : 'Execution Time:').' '.$exec_time.' '.(($lang_code == 'ru') ? 'сек.' : 'sec.').'</center>';
echo '</body>
</html>';