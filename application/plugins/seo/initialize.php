<?php

// initialize seo
include("seo.php");

$seo = new SEO(array(
    "title" => "SwiftMarketing",
    "keywords" => "SwiftMarketing" ,
    "description" => "SwiftMarketing",
    "author" => "https://plus.google.com/u/0/+FaizanAyubi",
    "robots" => "INDEX,FOLLOW",
    "photo" => "https://avatars0.githubusercontent.com/u/4982023?v=3&s=460"
));

Framework\Registry::set("seo", $seo);