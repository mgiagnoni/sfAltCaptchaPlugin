<?php
/*
 * This file is part of the sfAltCaptchaPlugin package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfAltCaptchaPlugin routing class.
 *
 * @package     sfAltCaptchaPlugin
 * @subpackage  lib
 * @copyright   Copyright (C) 2010 Massimo Giagnoni.
 * @license     http://www.symfony-project.org/license MIT
 */
class sfAltCaptchaRouting
{
  /**
   * Adds plugin routes.
   *
   * @param sfEvent $event
   * @see sfAltCaptchaPluginConfiguration::initialize()
   */
  public static function addRoutes(sfEvent $event)
  {
    $r = $event->getSubject();
    $r->prependRoute('sf_altcaptcha', new sfRequestRoute('/captcha/:captcha', array(
      'module' => 'sfAltCaptcha',
      'action' => 'show',
      'captcha' => 'default'
    )));
  }
}
