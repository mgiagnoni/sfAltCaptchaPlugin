<?php
/*
 * This file is part of the sfAltCaptchaPlugin package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfAltCaptchaPlugin widget.
 *
 * Displays captcha image and input box to enter code/answer.
 *
 * @package     sfAltCaptchaPlugin
 * @subpackage  widget
 * @copyright   Copyright (C) 2010 Massimo Giagnoni.
 * @license     http://www.symfony-project.org/license MIT
 */
class sfWidgetFormAltCaptcha extends sfWidgetForm
{
  protected function configure($options = array(), $attributes = array())
  {
    //Captcha definition key in plugin configuration
    $this->addOption('captcha', '');

    $this->addOption('enable_refresh', true);
    $this->addOption('enable_audio', false);
  }

  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $context = sfContext::getInstance();
    $url = $context->getRouting()->generate("sf_altcaptcha", $this->getOption('captcha') ? array('captcha' => $this->getOption('captcha')) : array());
    $refresh = $audio = '';

    if($this->getOption('enable_refresh'))
    {
      $refresh = sprintf(<<<EOF
<a href="javascript:void(0)" onclick="document.getElementById('%s-code').src='$url?'+Math.random();">%s</a>
EOF
        ,
        'altcaptcha',
        image_tag('/sfAltCaptchaPlugin/images/refresh','class=altcaptcha-refresh alt=refresh')
      );
    }
    if($this->getOption('enable_audio'))
    {
      $audio = image_tag('/sfAltCaptchaPlugin/images/audio');
    }
    return  '<div class="altcaptcha"><img id="altcaptcha-code" alt="captcha" src="' . $url . '" />' . $refresh . $audio .'</div>'.
    $this->renderTag('input', array_merge(array('type' => 'text', 'name' => $name, 'value' => null), $attributes));
  }
  public function getStylesheets()
  {
    return array('/sfAltCaptchaPlugin/css/altcaptcha' => 'screen');
  }
}
