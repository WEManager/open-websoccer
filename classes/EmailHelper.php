<?php

namespace App\Classes;

use Exception;

/**
 * Helps sending e-mails.
 * 
 * @author Ingo Hofmann
 */
class EmailHelper {
	
	/**
	 * Sends an e-mail (text format) from the system to the specified recipient. 
	 * Difference to sendSystemEmail(): Content is extracted from a template file.
	 * 
	 * @param WebSoccer $websoccer current context.
	 * @param I18n $i18n messages context
	 * @param string $recipient recipient e-mail address
	 * @param string $subject Already translated e-mail subject.
	 * @param string $templateName name of template (NOT template file name, i.e. WITHOUT file extension!) to use for the e-mail body.
	 * @param array $parameters array of parameters to use in the template (key=parameter name, value= parameter value).
	 */
	public static function sendSystemEmailFromTemplate(WebSoccer $websoccer, I18n $i18n, $recipient, $subject, $templateName, $parameters) {
		
		$emailTemplateEngine = new TemplateEngine($websoccer, $i18n, null);
		$template = $emailTemplateEngine->loadTemplate('emails/' . $templateName);
		$content = $template->render($parameters);
		
		self::sendSystemEmail($websoccer, $recipient, $subject, $content);
	}

	/**
	 * Sends an e-mail (text format) from the system to the specified recipient.
	 * 
	 * @param WebSoccer $websoccer current context.
	 * @param I18n $i18n messages context
	 * @param string $recipient recipient e-mail address
	 * @param string $subject Already translated e-mail subject.
	 * @param string $content message content.
	 */
	public static function sendSystemEmail(WebSoccer $websoccer, $recipient, $subject, $content) {
		
		$fromName = $websoccer->getConfig('projectname');
		$fromEmail = $websoccer->getConfig('systememail');
		
		$headers   = array();
		$headers[] = 'Content-type: text/plain; charset = \'UTF-8\'';
		$headers[] = 'From: '. $fromName .' <'. $fromEmail . '>';
		
		$encodedsubject = '=?UTF-8?B?'.base64_encode($subject).'?=';
		
		if (@mail($recipient, $encodedsubject, $content, implode("\r\n", $headers)) == FALSE) {
			throw new Exception('e-mail not sent.');
		}
	}	
}
