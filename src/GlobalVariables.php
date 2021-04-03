<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Mimey\MimeTypes;

class GlobalVariables {
    public static FilesystemLoader $loader;
    public static Environment $twig;
    public static MimeTypes $mimes;
}