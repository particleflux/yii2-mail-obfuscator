<?php
/**
 * @copyright Copyright (c) 2015 Stefan Linke
 * @license https://github.com/particleflux/yii2-mail-obfuscator/blob/master/LICENSE
 * @link https://github.com/particleflux/yii2-mail-obfuscator#readme
 */

namespace particleflux\MailObfuscator;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Class MailObfuscator
 * @package particleflux\MailObfuscator
 * @author Stefan Linke <mail@particleflux.de>
 */
class MailObfuscator extends Widget
{
    /** @var string email to obfuscate */
    public $email;

    /** @var text to display as link, defaults to email */
    public $text;

    /**
     * @var array html options for the anchor tag
     */
    public $options = [];


    public function run()
    {
        if ($this->text === null) {
            $this->text = $this->email;
        }

        $encodedMail = base64_encode('mailto:' . $this->email);
        $encodedText = base64_encode($this->text);

        $this->view->registerJs(<<<JS
function d(s) {
    var e={},i,b=0,c,x,l=0,a,r='',w=String.fromCharCode,L=s.length;
    var A="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
    for(i=0;i<64;i++){e[A.charAt(i)]=i;}
    for(x=0;x<L;x++){
        c=e[s.charAt(x)];b=(b<<6)+c;l+=6;
        while(l>=8){((a=(b>>>(l-=8))&0xff)||(x<(L-2)))&&(r+=w(a));}
    }
    return r;
};

var a = document.getElementById('{$this->id}');
var m = d('{$encodedMail}');
a.href = m;
a.innerHTML = d('{$encodedText}');

JS
);

        $this->options = array_merge(['id' => $this->id], $this->options);
        echo Html::a('', null, $this->options);
    }

}