<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class GlobalVariables {
    public static FilesystemLoader $loader;
    public static Environment $twig;
}