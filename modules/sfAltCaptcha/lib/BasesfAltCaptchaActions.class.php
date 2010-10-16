<?php
/*
 * This file is part of the sfAltCaptchaPlugin package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfAltCaptchaPlugin sfAltCaptcha module base actions.
 *
 * @package     sfAltCaptchaPlugin
 * @subpackage  sfAltCaptcha module
 * @copyright   Copyright (C) 2010 Massimo Giagnoni.
 * @license     http://www.symfony-project.org/license MIT
 */
class BasesfAltCaptchaActions extends sfActions
{
  /**
   * Shows captcha image.
   *
   * @param sfWebRequest $request
   */
  public function executeShow(sfWebRequest $request)
  {
    $captcha = $request->getParameter('captcha', 'default');
    $c = new sfAltCaptcha($captcha);
    $c->show();
    return sfView::NONE;
  }
}
