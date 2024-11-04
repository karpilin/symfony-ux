<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller\Icons;

use App\Service\Icon\IconSetRepository;
use App\Service\UxPackageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
final class IconsController extends AbstractController
{
    #[Route('/icons', name: 'app_icons')]
    public function index(
        UxPackageRepository $packageRepository,
        IconSetRepository $iconSetRepository,
    ): Response {
        // Homepage "Popular Icon Sets"
        // Hard-coded until we bring the IconSet's lists / views back
        $iconSets = [
            'bi',
            'bx',
            'flowbite',
            'iconoir',
            'lucide',
            'tabler',
            'octicon',
            'ph',
            'heroicons',
        ];
        $iconSets = array_map(fn ($iconSet) => $iconSetRepository->find($iconSet), $iconSets);

        return $this->render('ux_packages/icons.html.twig', [
            'package' => $packageRepository->find('icons'),
            'iconSets' => $iconSets,
        ]);
    }
}
