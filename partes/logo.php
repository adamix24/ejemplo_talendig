<?php
/**
 * Logo de Shell.
 * Uso: echo shell_logo(48);
 */
if (!function_exists('shell_logo')) {
  function shell_logo($alto = 48, $wordmark = false) {
    $url = 'https://1000marcas.net/wp-content/uploads/2019/12/Shell-Logo-1971.png';
    return '<img class="shell-logo" src="' . $url . '" alt="Shell" height="' . (int)$alto . '" style="height:' . (int)$alto . 'px;width:auto;">';
  }
}
?>
