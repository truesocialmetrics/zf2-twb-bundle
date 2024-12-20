<?php

namespace TwbBundle\View\Helper;


use Laminas\View\Helper\Navigation as LaminasNavigationHelper;

class Navigation extends LaminasNavigationHelper
{
    /**
     * Retrieve plugin loader for navigation helpers
     *
     * Lazy-loads an instance of Navigation\HelperLoader if none currently
     * registered.
     *
     * @return Navigation\PluginManager
     */
    public function getPluginManager()
    {
        if (null === $this->plugins) {
            $this->setPluginManager(new Navigation\PluginManager($this->getServiceLocator()));
        }

        return $this->plugins;
    }
}
