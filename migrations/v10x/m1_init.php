<?php
/**
 *
 * @package prefixed
 * @copyright (c) 2013 David King (imkingdavid)
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace imkingdavid\push\migrations\v10x;

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * Initial schema changes needed for Extension installation
 */
class m1_init extends \phpbb\db\migration\migration
{
	/**
	 * @inheritdoc
	 */
	public function update_data()
	{
		return [
			['config.add', ['push_firebase_api_key', '']],
			['config.add', ['push_firebase_server_key', '']],
			['config.add', ['push_firebase_messaging_sender_id', '']],
			['config.add', ['push_firebase_manifest_short_name', '']],
			['config.add', ['push_firebase_manifest_name', '']],
			['config.add', ['push_firebase_manifest_orientation', 'portrait']],
			['config.add', ['push_firebase_manifest_theme_color', '#CADCEB']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function update_schema()
	{
		return [
			'add_tables'	=> [
				$this->table_prefix . 'push_user_tokens'	=> [
					'COLUMNS'	=> [
						'id'			=> ['UINT', NULL, 'auto_increment'],
						'user_id'		=> ['VCHAR_UNI', ''],
						'token'			=> ['VCHAR_UNI', ''],
						'created'		=> ['VCHAR_UNI', ''],
					],
					'PRIMARY_KEY'	=> 'id',
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function revert_schema()
	{
		return [
			'drop_tables'	=> [
				$this->table_prefix . 'push_user_tokens',
			],
		];
	}
}
