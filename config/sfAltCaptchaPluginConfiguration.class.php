<?php
/*
 * This file is part of the sfAltCaptchaPlugin package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfAltCaptchaPlugin configuration.
 *
 * @package     sfAltCaptchaPlugin
 * @subpackage  config
 * @copyright   Copyright (C) 2010 Massimo Giagnoni.
 * @license     http://www.symfony-project.org/license MIT
 */
class sfAltCaptchaPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {
    if (sfConfig::get('app_sfAltCaptchaPlugin_routes_register', true) && in_array('sfAltCaptcha', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('sfAltCaptchaRouting', 'addRoutes'));
    }
  }
}
