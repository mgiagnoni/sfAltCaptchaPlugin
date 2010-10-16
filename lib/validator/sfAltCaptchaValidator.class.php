<?php
/*
 * This file is part of the sfAltCaptchaPlugin package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfAltCaptchaPlugin captcha validator.
 *
 * Checks if user has entered the correct captcha code/answer.
 *
 * @package     sfAltCaptchaPlugin
 * @subpackage  validator
 * @copyright   Copyright (C) 2010 Massimo Giagnoni.
 * @license     http://www.symfony-project.org/license MIT
 */
class sfAltCaptchaValidator extends sfValidatorBase
{
  protected function configure($options = array(), $messages = array())
  {
    $this->addOption('captcha', 'default');
    $this->setMessage('invalid', 'Wrong security code.');
  }
  protected function doClean($value)
  {
    $c = new sfAltCaptcha($this->getOption('captcha'));
    if(strtolower($value) != strtolower($c->retrieveAnswer()))
    {
      throw new sfValidatorError($this, 'invalid');
    }
    return $value;
  }
}
