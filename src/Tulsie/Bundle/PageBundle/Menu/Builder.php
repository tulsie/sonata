<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
///Rsh/Bundle/PageBundle/Menu/

namespace Tulsie\Bundle\PageBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAware;



/**
 * Class Builder
 *
 * @package Sonata\Bundle\TulsiePageBundle\Menu
 *
 * @author Hugo Briand <briand@ekino.com>
 */
class Builder extends ContainerAware
{
    private $sharedMenuItems = [];

    public function __construct() {
        $this->sharedMenuItems = [
            'werkgevers' => '/werkgevers',
            'issues' => '/issues',
            'oplossingen' => '/oplossingen',
            'over tulsie' => '/over-tulsie',
            'contact' => '/contact'
        ];
    }
    /**
     * Creates the header menu
     *
     * @param FactoryInterface $factory
     * @param array            $options
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menuOptions = array_merge($options, [
            'childrenAttributes' => ['class' => 'nav navbar-nav navbar-right'],
        ]);

        $menu = $factory->createItem('main', $menuOptions);
        $this->addSharedItemsToMenu($menu, $this->sharedMenuItems);

        return $menu;
    }

    public function footerMenu(FactoryInterface $factory, array $options)
    {
        $menuOptions = array_merge($options, [
            'childrenAttributes' => ['class' => 'dark-main-color  nav navbar-nav navbar-center', 'id' => 'footer-nav'],
        ]);

        $menu = $factory->createItem('footer', $menuOptions);
        $this->addSharedItemsToMenu($menu, $this->sharedMenuItems);
        $this->addSharedItemsToMenu($menu, [
            'disclaimer' => '/disclaimer',
            'algemene voorwaarden' => '/algemene-voorwaarden'
        ]);
        return $menu;
    }

    /**
     * @param ItemInterface $menu
     * @param array $items
     */
    private function addSharedItemsToMenu(ItemInterface &$menu, array $items)
    {
        foreach ($items as $title => $url) {
            $menu->addChild($title, ['uri' => $url]);
        }
    }

}
