<?php

   $utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : '';
   $utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : '';
   $utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : '';
   $utm_content = isset($_GET['utm_content']) ? $_GET['utm_content'] : '';
   $utm_term = isset($_GET['utm_term']) ? $_GET['utm_term'] : '';

   $pageTitle = "TenTrade YPF";
   $pageContent = __DIR__ . '/content.php';

   include __DIR__ . '/../layout.php';

?>

