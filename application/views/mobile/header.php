<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->config->item('company'); ?></title>
        <link rel="stylesheet" rev="stylesheet" href="<?php echo base_url();?>css/jqmobile.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>css/jquery.mobile.structure-1.2.0.min.css" />
        <script src="<?php echo base_url();?>js/jquery-1.8.2.min.js"></script>
        <script src="<?php echo base_url();?>js/jquery.mobile-1.2.0.min.js"></script>
        <script src="<?php echo base_url();?>js/mustache.js"></script>
    </head>
    <body>
        <div data-role="page" data-theme="c">
            <div data-role="header" data-position="inline">
                <h1><?php echo $this->config->item('company'); ?></h1>
               
            </div>
           <div data-role="content" data-theme="b">
