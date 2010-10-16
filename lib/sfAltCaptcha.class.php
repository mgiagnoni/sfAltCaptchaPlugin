<?php
/*
 * This file is part of the sfAltCaptchaPlugin package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfAltCaptchaPlugin captcha class.
 *
 * Overrides some MultiCaptcha methods for use with symfony.
 *
 * @package     sfAltCaptchaPlugin
 * @subpackage  lib
 * @copyright   Copyright (C) 2010 Massimo Giagnoni.
 * @license     http://www.symfony-project.org/license MIT
 */
class sfAltCaptcha extends MultiCaptcha
{
  public function __construct($captcha = 'default')
  {
    $configs = sfConfig::get('app_sfAltCaptcha_captcha', array('default'=>array()));
    if(!in_array($captcha, array_keys($configs)))
    {
      throw new sfException(sprintf('Captcha "%s" not defined in plugin configuration', $captcha));
    }
    $this->setSessionkey($captcha);
    foreach($configs[$captcha] as $k => $v)
    {
      if($k == 'type')
      {
        switch($v)
        {
          case 'math':
            $v = sfAltCaptcha::TYPE_MATH;
            break;
          default:
            $v = sfAltCaptcha::TYPE_RANDOM_CODE;
            break;
        }
        $k = 'CaptchaType';
      }
      $method = 'set'.$k;
      if(method_exists($this,$method))
      {
        $this->$method($v);
      }
    }
    $this->setAssetsPath(sfConfig::get('sf_plugins_dir') . '/sfAltCaptchaPlugin/assets');

  }
  public function retrieveAnswer()
  {
    $user = sfContext::getInstance()->getUser();
    $v = $user->getAttribute($this->session_key, null, 'sf_altcaptcha');
    $user->setAttribute($this->session_key, null, 'sf_altcaptcha');
    return $v;
  }

  protected function storeAnswer()
  {
    $user = sfContext::getInstance()->getUser();
    $user->setAttribute($this->session_key, $this->answer, 'sf_altcaptcha');
  }
}
