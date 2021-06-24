<?php


namespace App\Twig;

use App\Service\DeviseService;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{

    public $deviseService;

    public function __construct(DeviseService $deviseService)
    {
        $this->deviseService = $deviseService;
    }

    public function currencyConvert($somme)
    {
        return $this->deviseService->convert($somme);
    }
}