<?php
/**
 *
 * @package push
 * @copyright (c) 2017 David King (imkingdavid)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace imkingdavid\push;

 /**
* Extension class for custom enable/disable/purge actions
*/
class ext extends \phpbb\extension\base
{
	public function is_enableable()
	{
		$config = $this->container->get('config');
		return (version_compare($config['version'], '3.2.0', '>=') && (version_compare(PHP_VERSION, '5.4.*', '>')));
	}
}
