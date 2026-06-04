<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Dynamic Server-Side SEO Tags -->
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : "Evangiz Restaurant - A Taste You'll Remember"; ?></title>
    <meta name="description" content="<?php echo isset($page_desc) ? htmlspecialchars($page_desc) : "Welcome to Evangiz Restaurant along Kampala-Entebbe Road in Lubowa. We serve premium fast food, local dishes, and professional catering services."; ?>">
    
    <!-- OpenGraph Tags for Social Previews -->
    <meta property="og:title" content="<?php echo isset($page_title) ? htmlspecialchars($page_title) : "Evangiz Restaurant"; ?>">
    <meta property="og:description" content="<?php echo isset($page_desc) ? htmlspecialchars($page_desc) : "Evangiz Restaurant offers delicious locally-sourced Ugandan cuisine and premium fast foods."; ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo isset($page_image) ? htmlspecialchars($page_image) : 'image/brand/banner.jpg'; ?>">
    
    <!-- Google Fonts Preconnect and Inclusions -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons and Fonts -->
    <link rel="stylesheet" href="https://use.hugeicons.com/font/icons.css">
    
    <!-- CSS Design System and Stylesheets -->
    <link rel="stylesheet" href="<?php echo url('/css/main.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('/css/layout.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('/css/components.css'); ?>">
    <link rel="stylesheet" href="<?php echo url('/css/animations.css'); ?>">
    
    <link rel="shortcut icon" href="<?php echo url('/image/logo/favicon.png'); ?>" type="image/x-icon">
</head>
<body>
    <div id="site-wrapper">
