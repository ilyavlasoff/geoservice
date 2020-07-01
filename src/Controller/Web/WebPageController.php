<?php

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class WebPageController extends AbstractController
{
    /**
     * @Route("/{_locale}", defaults={"_locale"="en"}, name="app_main")
     */
    public function displayPage(string $_locale)
    {
        if ($_locale === 'ru')
        {
            $queryLocale = 'ru_RU';
        }
        else
        {
            $queryLocale = 'en_US';
        }
        return $this->render('webpage.html.twig', [
            'loc' => $queryLocale
        ]);
    }
}