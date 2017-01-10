<?php
/**
 *
 * @package push
 * @copyright (c) 2017 David King (imkingdavid)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace imkingdavid\push\event;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

use phpbb\config\config;
use phpbb\user;
use phpbb\template\template;
use phpbb\controller\helper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{	
	/**
	 * Config
	 * @var \phpbb\config\config
	 */
	protected $config;

	/**
	 * Template object
	 * @var \phpbb\template\template
	 */
	protected $template;

	/**
	 * User object
	 * @var \phpbb\user
	 */
	protected $user;

	/**
	 * Controller helper
	 * @var \phpbb\controller\helper
	 */

	/**
	 * Constructor method
	 *
	 */
	public function __construct(config $config, template $template, user $user, helper $controller_helper)
	{
		$this->config = $config;
		$this->template = $template;
		$this->user = $user;
		$this->controller_helper = $controller_helper;
	}

	/**
	 * Get subscribed events
	 *
	 * @return array
	 * @static
	 */
	static public function getSubscribedEvents()
	{
		return [
			'core.page_header_after' => 'page_header_after',
		];
	}

	public function page_header_after()
	{
		$this->template->assign_vars([
			'PUSH_FIREBASE_USER_ID' => $this->user->data['user_id'],
			'PUSH_FIREBASE_USER_URL' => $this->controller_helper->route('push.register_user'),
			'PUSH_FIREBASE_API_KEY' => $this->config['push_firebase_api_key'],
			'PUSH_FIREBASE_MESSAGING_SENDER_ID' => $this->config['push_firebase_messaging_sender_id'],
		]);
	}
}
