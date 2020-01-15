<?php
/**
 * Kunena Component
 *
 * @package         Kunena.Administrator
 * @subpackage      Models
 *
 * @copyright       Copyright (C) 2008 - 2020 Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/

namespace Kunena\Forum\Administrator\Model;

defined('_JEXEC') or die();

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Uri\Uri;

/**
 * Config Model for Kunena
 *
 * @since 2.0
 */
class ConfigModel extends AdminModel
{
	/**
	 * @inheritDoc
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// TODO: Implement getForm() method.
	}

	/**
	 * @return  array
	 *
	 * @since   Kunena 6.0
	 *
	 * @throws  \Exception
	 */
	public function getConfiglists()
	{
		$lists = [];
		$this->config = ComponentHelper::getParams('com_config');

		// RSS
		{
			// Options to be used later
			$rss_yesno    = [];
			$rss_yesno [] = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_A_NO'));
			$rss_yesno [] = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_A_YES'));

			// ------

			$rss_type    = [];
			$rss_type [] = HTMLHelper::_('select.option', 'post', Text::_('COM_KUNENA_A_RSS_TYPE_POST'));
			$rss_type [] = HTMLHelper::_('select.option', 'topic', Text::_('COM_KUNENA_A_RSS_TYPE_TOPIC'));
			$rss_type [] = HTMLHelper::_('select.option', 'recent', Text::_('COM_KUNENA_A_RSS_TYPE_RECENT'));

			// Build the html select list
			$lists ['rss_type'] = HTMLHelper::_('select.genericlist', $rss_type, 'cfg_rss_type', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->rss_type);

			// ------

			$rss_timelimit    = [];
			$rss_timelimit [] = HTMLHelper::_('select.option', 'week', Text::_('COM_KUNENA_A_RSS_TIMELIMIT_WEEK'));
			$rss_timelimit [] = HTMLHelper::_('select.option', 'month', Text::_('COM_KUNENA_A_RSS_TIMELIMIT_MONTH'));
			$rss_timelimit [] = HTMLHelper::_('select.option', 'year', Text::_('COM_KUNENA_A_RSS_TIMELIMIT_YEAR'));

			// Build the html select list
			$lists ['rss_timelimit'] = HTMLHelper::_('select.genericlist', $rss_timelimit, 'cfg_rss_timelimit', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->rss_timelimit);

			// ------

			$rss_specification = [];

			$rss_specification [] = HTMLHelper::_('select.option', 'rss0.91', 'RSS 0.91');
			$rss_specification [] = HTMLHelper::_('select.option', 'rss1.0', 'RSS 1.0');
			$rss_specification [] = HTMLHelper::_('select.option', 'rss2.0', 'RSS 2.0');
			$rss_specification [] = HTMLHelper::_('select.option', 'atom1.0', 'Atom 1.0');

			// Build the html select list
			$lists ['rss_specification'] = HTMLHelper::_('select.genericlist', $rss_specification, 'cfg_rss_specification', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->rss_specification);

			// ------

			$rss_author_format    = [];
			$rss_author_format [] = HTMLHelper::_('select.option', 'name', Text::_('COM_KUNENA_A_RSS_AUTHOR_FORMAT_NAME'));
			$rss_author_format [] = HTMLHelper::_('select.option', 'email', Text::_('COM_KUNENA_A_RSS_AUTHOR_FORMAT_EMAIL'));
			$rss_author_format [] = HTMLHelper::_('select.option', 'both', Text::_('COM_KUNENA_A_RSS_AUTHOR_FORMAT_BOTH'));

			// Build the html select list
			$lists ['rss_author_format'] = HTMLHelper::_('select.genericlist', $rss_author_format, 'cfg_rss_author_format', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->rss_author_format);

			// ------

			// Build the html select list
			$lists ['rss_author_in_title'] = HTMLHelper::_('select.genericlist', $rss_yesno, 'cfg_rss_author_in_title', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->rss_author_in_title);

			// ------

			$rss_word_count    = [];
			$rss_word_count [] = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_A_RSS_WORD_COUNT_ALL'));
			$rss_word_count [] = HTMLHelper::_('select.option', '-1', Text::_('JNONE'));
			$rss_word_count [] = HTMLHelper::_('select.option', '50', '50');
			$rss_word_count [] = HTMLHelper::_('select.option', '100', '100');
			$rss_word_count [] = HTMLHelper::_('select.option', '250', '250');
			$rss_word_count [] = HTMLHelper::_('select.option', '500', '500');
			$rss_word_count [] = HTMLHelper::_('select.option', '750', '750');
			$rss_word_count [] = HTMLHelper::_('select.option', '1000', '1000');

			// Build the html select list
			$lists ['rss_word_count'] = HTMLHelper::_('select.genericlist', $rss_word_count, 'cfg_rss_word_count', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->rss_word_count);

			// ------

			// Build the html select list
			$lists ['rss_allow_html'] = HTMLHelper::_('select.genericlist', $rss_yesno, 'cfg_rss_allow_html', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->rss_allow_html);

			// ------

			// Build the html select list
			$lists ['rss_old_titles'] = HTMLHelper::_('select.genericlist', $rss_yesno, 'cfg_rss_old_titles', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->rss_old_titles);

			// ------

			$rss_cache = [];

			$rss_cache [] = HTMLHelper::_('select.option', '0', '0');        // Disable
			$rss_cache [] = HTMLHelper::_('select.option', '60', '1');
			$rss_cache [] = HTMLHelper::_('select.option', '300', '5');
			$rss_cache [] = HTMLHelper::_('select.option', '900', '15');
			$rss_cache [] = HTMLHelper::_('select.option', '1800', '30');
			$rss_cache [] = HTMLHelper::_('select.option', '3600', '60');

			$lists ['rss_cache'] = HTMLHelper::_('select.genericlist', $rss_cache, 'cfg_rss_cache', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->rss_cache);

			// ------

			// Build the html select list - (moved enablerss here, to keep all rss-related features together)
			$lists ['enablerss'] = HTMLHelper::_('select.genericlist', $rss_yesno, 'cfg_enablerss', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->enablerss);
		}

		// Build the html select list
		// make a standard yes/no list
		$yesno    = [];
		$yesno [] = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_A_NO'));
		$yesno [] = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_A_YES'));

		$lists ['disemoticons']           = HTMLHelper::_('select.genericlist', $yesno, 'cfg_disemoticons', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->disemoticons);
		$lists ['regonly']                = HTMLHelper::_('select.genericlist', $yesno, 'cfg_regonly', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->regonly);
		$lists ['board_offline']          = HTMLHelper::_('select.genericlist', $yesno, 'cfg_board_offline', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->board_offline);
		$lists ['pubwrite']               = HTMLHelper::_('select.genericlist', $yesno, 'cfg_pubwrite', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->pubwrite);
		$lists ['showhistory']            = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showhistory', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showhistory);
		$lists ['showannouncement']       = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showannouncement', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showannouncement);
		$lists ['avataroncat']            = HTMLHelper::_('select.genericlist', $yesno, 'cfg_avataroncat', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->avataroncat);
		$lists ['showchildcaticon']       = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showchildcaticon', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showchildcaticon);
		$lists ['showuserstats']          = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showuserstats', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showuserstats);
		$lists ['showwhoisonline']        = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showwhoisonline', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showwhoisonline);
		$lists ['showpopsubjectstats']    = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showpopsubjectstats', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showpopsubjectstats);
		$lists ['showgenstats']           = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showgenstats', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showgenstats);
		$lists ['showpopuserstats']       = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showpopuserstats', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showpopuserstats);
		$lists ['allowsubscriptions']     = HTMLHelper::_('select.genericlist', $yesno, 'cfg_allowsubscriptions', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->allowsubscriptions);
		$lists ['subscriptionschecked']   = HTMLHelper::_('select.genericlist', $yesno, 'cfg_subscriptionschecked', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->subscriptionschecked);
		$lists ['allowfavorites']         = HTMLHelper::_('select.genericlist', $yesno, 'cfg_allowfavorites', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->allowfavorites);
		$lists ['showemail']              = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showemail', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showemail);
		$lists ['askemail']               = HTMLHelper::_('select.genericlist', $yesno, 'cfg_askemail', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->askemail);
		$lists ['allowavatarupload']      = HTMLHelper::_('select.genericlist', $yesno, 'cfg_allowavatarupload', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->allowavatarupload);
		$lists ['allowavatargallery']     = HTMLHelper::_('select.genericlist', $yesno, 'cfg_allowavatargallery', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->allowavatargallery);
		$lists ['showstats']              = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showstats', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showstats);
		$lists ['showranking']            = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showranking', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showranking);
		$lists ['username']               = HTMLHelper::_('select.genericlist', $yesno, 'cfg_username', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->username);
		$lists ['shownew']                = HTMLHelper::_('select.genericlist', $yesno, 'cfg_shownew', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->shownew);
		$lists ['editmarkup']             = HTMLHelper::_('select.genericlist', $yesno, 'cfg_editmarkup', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->editmarkup);
		$lists ['showkarma']              = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showkarma', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showkarma);
		$lists ['enableforumjump']        = HTMLHelper::_('select.genericlist', $yesno, 'cfg_enableforumjump', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->enableforumjump);
		$lists ['userlist_online']        = HTMLHelper::_('select.genericlist', $yesno, 'cfg_userlist_online', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->userlist_online);
		$lists ['userlist_avatar']        = HTMLHelper::_('select.genericlist', $yesno, 'cfg_userlist_avatar', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->userlist_avatar);
		$lists ['userlist_posts']         = HTMLHelper::_('select.genericlist', $yesno, 'cfg_userlist_posts', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->userlist_posts);
		$lists ['userlist_karma']         = HTMLHelper::_('select.genericlist', $yesno, 'cfg_userlist_karma', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->userlist_karma);
		$lists ['userlist_email']         = HTMLHelper::_('select.genericlist', $yesno, 'cfg_userlist_email', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->userlist_email);
		$lists ['userlist_joindate']      = HTMLHelper::_('select.genericlist', $yesno, 'cfg_userlist_joindate', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->userlist_joindate);
		$lists ['userlist_lastvisitdate'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_userlist_lastvisitdate', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->userlist_lastvisitdate);
		$lists ['userlist_userhits']      = HTMLHelper::_('select.genericlist', $yesno, 'cfg_userlist_userhits', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->userlist_userhits);
		$lists ['reportmsg']              = HTMLHelper::_('select.genericlist', $yesno, 'cfg_reportmsg', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->reportmsg);

		$captcha   = [];
		$captcha[] = HTMLHelper::_('select.option', '-1', Text::_('COM_KUNENA_CONFIGURATION_OPTION_CAPTCHA_NOBODY'));
		$captcha[] = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_CONFIGURATION_OPTION_CAPTCHA_REGISTERED_USERS'));
		$captcha[] = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_CONFIGURATION_OPTION_CAPTCHA_GUESTS_REGISTERED_USERS'));

		$lists ['captcha']  = HTMLHelper::_('select.genericlist', $captcha, 'cfg_captcha', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->captcha);
		$lists ['mailfull'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_mailfull', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->mailfull);

		// New for 1.0.5
		$lists ['showspoilertag']   = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showspoilertag', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showspoilertag);
		$lists ['showvideotag']     = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showvideotag', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showvideotag);
		$lists ['showebaytag']      = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showebaytag', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showebaytag);
		$lists ['trimlongurls']     = HTMLHelper::_('select.genericlist', $yesno, 'cfg_trimlongurls', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->trimlongurls);
		$lists ['autoembedyoutube'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_autoembedyoutube', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->autoembedyoutube);
		$lists ['autoembedebay']    = HTMLHelper::_('select.genericlist', $yesno, 'cfg_autoembedebay', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->autoembedebay);
		$lists ['highlightcode']    = HTMLHelper::_('select.genericlist', $yesno, 'cfg_highlightcode', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->highlightcode);

		// New for 1.5.8 -> SEF
		$lists ['sef'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_sef', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->sef);

		// New for 1.6 -> Hide images and files for guests
		$lists['showimgforguest']  = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showimgforguest', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showimgforguest);
		$lists['showfileforguest'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showfileforguest', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showfileforguest);

		// New for 1.6 -> Check Image MIME types
		$lists['checkmimetypes'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_checkmimetypes', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->checkmimetypes);

		// New for 1.6 -> Poll
		$lists['pollallowvoteone']     = HTMLHelper::_('select.genericlist', $yesno, 'cfg_pollallowvoteone', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->pollallowvoteone);
		$lists['pollenabled']          = HTMLHelper::_('select.genericlist', $yesno, 'cfg_pollenabled', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->pollenabled);
		$lists['showpoppollstats']     = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showpoppollstats', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showpoppollstats);
		$lists['pollresultsuserslist'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_pollresultsuserslist', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->pollresultsuserslist);

		// New for 1.6 -> Choose ordering system
		$ordering_system_list     = [];
		$ordering_system_list[]   = HTMLHelper::_('select.option', 'mesid', Text::_('COM_KUNENA_COM_A_ORDERING_SYSTEM_NEW'));
		$ordering_system_list[]   = HTMLHelper::_('select.option', 'replyid', Text::_('COM_KUNENA_COM_A_ORDERING_SYSTEM_OLD'));
		$lists['ordering_system'] = HTMLHelper::_('select.genericlist', $ordering_system_list, 'cfg_ordering_system', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->ordering_system);

		// New for 1.6: datetime
		$dateformatlist                 = [];
		$time                           = \KunenaDate::getInstance(time() - 80000);
		$dateformatlist[]               = HTMLHelper::_('select.option', 'none', Text::_('COM_KUNENA_OPTION_DATEFORMAT_NONE'));
		$dateformatlist[]               = HTMLHelper::_('select.option', 'ago', $time->toKunena('ago'));
		$dateformatlist[]               = HTMLHelper::_('select.option', 'datetime_today', $time->toKunena('datetime_today'));
		$dateformatlist[]               = HTMLHelper::_('select.option', 'datetime', $time->toKunena('datetime'));
		$lists['post_dateformat']       = HTMLHelper::_('select.genericlist', $dateformatlist, 'cfg_post_dateformat', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->post_dateformat);
		$lists['post_dateformat_hover'] = HTMLHelper::_('select.genericlist', $dateformatlist, 'cfg_post_dateformat_hover', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->post_dateformat_hover);

		// New for 1.6: hide ip
		$lists['hide_ip'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_hide_ip', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->hide_ip);

		// New for 1.6: choose if you want that ghost message box checked by default
		$lists['boxghostmessage'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_boxghostmessage', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->boxghostmessage);

		// New for 1.6 -> Thank you button
		$lists ['showthankyou'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showthankyou', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showthankyou);

		$listUserDeleteMessage       = [];
		$listUserDeleteMessage[]     = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_A_DELETEMESSAGE_NOT_ALLOWED'));
		$listUserDeleteMessage[]     = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_A_DELETEMESSAGE_ALLOWED_IF_REPLIES'));
		$listUserDeleteMessage[]     = HTMLHelper::_('select.option', '2', Text::_('COM_KUNENA_A_DELETEMESSAGE_ALWAYS_ALLOWED'));
		$listUserDeleteMessage[]     = HTMLHelper::_('select.option', '3', Text::_('COM_KUNENA_CONFIG_DELETEMESSAGE_NOT_FIRST_MESSAGE'));
		$listUserDeleteMessage[]     = HTMLHelper::_('select.option', '4', Text::_('COM_KUNENA_CONFIG_DELETEMESSAGE_ONLY_LAST_MESSAGE'));
		$lists['userdeletetmessage'] = HTMLHelper::_('select.genericlist', $listUserDeleteMessage, 'cfg_userdeletetmessage', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->userdeletetmessage);

		$latestCategoryIn           = [];
		$latestCategoryIn[]         = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_A_LATESTCATEGORY_IN_HIDE'));
		$latestCategoryIn[]         = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_A_LATESTCATEGORY_IN_SHOW'));
		$lists['latestcategory_in'] = HTMLHelper::_('select.genericlist', $latestCategoryIn, 'cfg_latestcategory_in', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->latestcategory_in);

		$optionsShowHide         = [HTMLHelper::_('select.option', 0, Text::_('COM_KUNENA_COM_A_LATESTCATEGORY_SHOWALL'))];
		$params                  = ['sections' => false, 'action' => 'read'];
		$lists['latestcategory'] = HTMLHelper::_('kunenaforum.categorylist', 'cfg_latestcategory[]', 0, $optionsShowHide, $params, 'class="inputbox form-control"multiple="multiple"', 'value', 'text', explode(',', $this->config->latestcategory), 'latestcategory');

		$lists['topicicons'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_topicicons', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->topicicons);

		$lists['debug'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_debug', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->debug);

		$lists['showbannedreason'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showbannedreason', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showbannedreason);

		$lists['time_to_create_page'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_time_to_create_page', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->time_to_create_page);

		$lists['showpopthankyoustats'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_showpopthankyoustats', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->showpopthankyoustats);

		$seerestoredeleted         = [];
		$seerestoredeleted[]       = HTMLHelper::_('select.option', 2, Text::_('COM_KUNENA_A_SEE_RESTORE_DELETED_NOBODY'));
		$seerestoredeleted[]       = HTMLHelper::_('select.option', 1, Text::_('COM_KUNENA_A_SEE_RESTORE_DELETED_ADMINSMODS'));
		$seerestoredeleted[]       = HTMLHelper::_('select.option', 0, Text::_('COM_KUNENA_A_SEE_RESTORE_DELETED_ADMINS'));
		$lists ['mod_see_deleted'] = HTMLHelper::_('select.genericlist', $seerestoredeleted, 'cfg_mod_see_deleted', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->mod_see_deleted);

		$listBbcodeImgSecure               = [];
		$listBbcodeImgSecure[]             = HTMLHelper::_('select.option', 'text', Text::_('COM_KUNENA_COM_A_BBCODE_IMG_SECURE_OPTION_TEXT'));
		$listBbcodeImgSecure[]             = HTMLHelper::_('select.option', 'link', Text::_('COM_KUNENA_COM_A_BBCODE_IMG_SECURE_OPTION_LINK'));
		$listBbcodeImgSecure[]             = HTMLHelper::_('select.option', 'image', Text::_('COM_KUNENA_COM_A_BBCODE_IMG_SECURE_OPTION_IMAGE'));
		$lists ['bbcode_img_secure']       = HTMLHelper::_('select.genericlist', $listBbcodeImgSecure, 'cfg_bbcode_img_secure', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->bbcode_img_secure);
		$lists ['listcat_show_moderators'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_listcat_show_moderators', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->listcat_show_moderators);
		$showlightbox                      = $yesno;
		$showlightbox[]                    = HTMLHelper::_('select.option', 2, Text::_('COM_KUNENA_A_LIGHTBOX_NO_JS'));
		$lists ['lightbox']                = HTMLHelper::_('select.genericlist', $showlightbox, 'cfg_lightbox', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->lightbox);

		$timesel[] = HTMLHelper::_('select.option', -1, Text::_('COM_KUNENA_SHOW_SELECT_ALL'));
		$timesel[] = HTMLHelper::_('select.option', 0, Text::_('COM_KUNENA_SHOW_LASTVISIT'));
		$timesel[] = HTMLHelper::_('select.option', 4, Text::_('COM_KUNENA_SHOW_4_HOURS'));
		$timesel[] = HTMLHelper::_('select.option', 8, Text::_('COM_KUNENA_SHOW_8_HOURS'));
		$timesel[] = HTMLHelper::_('select.option', 12, Text::_('COM_KUNENA_SHOW_12_HOURS'));
		$timesel[] = HTMLHelper::_('select.option', 24, Text::_('COM_KUNENA_SHOW_24_HOURS'));
		$timesel[] = HTMLHelper::_('select.option', 48, Text::_('COM_KUNENA_SHOW_48_HOURS'));
		$timesel[] = HTMLHelper::_('select.option', 168, Text::_('COM_KUNENA_SHOW_WEEK'));
		$timesel[] = HTMLHelper::_('select.option', 720, Text::_('COM_KUNENA_SHOW_MONTH'));
		$timesel[] = HTMLHelper::_('select.option', 8760, Text::_('COM_KUNENA_SHOW_YEAR'));

		// Build the html select list
		$lists ['show_list_time'] = HTMLHelper::_('select.genericlist', $timesel, 'cfg_show_list_time', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->show_list_time);

		$sessiontimetype[] = HTMLHelper::_('select.option', 0, Text::_('COM_KUNENA_SHOW_SESSION_TYPE_ALL'));
		$sessiontimetype[] = HTMLHelper::_('select.option', 1, Text::_('COM_KUNENA_SHOW_SESSION_TYPE_VALID'));
		$sessiontimetype[] = HTMLHelper::_('select.option', 2, Text::_('COM_KUNENA_SHOW_SESSION_TYPE_TIME'));

		$lists ['show_session_type'] = HTMLHelper::_('select.genericlist', $sessiontimetype, 'cfg_show_session_type', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->show_session_type);

		$userlist_allowed           = [];
		$userlist_allowed []        = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_A_NO'));
		$userlist_allowed []        = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_A_YES'));
		$lists ['userlist_allowed'] = HTMLHelper::_('select.genericlist', $userlist_allowed, 'cfg_userlist_allowed', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->userlist_allowed);
		$lists ['pubprofile']       = HTMLHelper::_('select.genericlist', $yesno, 'cfg_pubprofile', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->pubprofile);

		$userlist_count_users[]         = HTMLHelper::_('select.option', 0, Text::_('COM_KUNENA_SHOW_USERLIST_COUNTUNSERS_ALL'));
		$userlist_count_users[]         = HTMLHelper::_('select.option', 1, Text::_('COM_KUNENA_SHOW_USERLIST_COUNTUNSERS_ACTIVATED_ACCOUNT'));
		$userlist_count_users[]         = HTMLHelper::_('select.option', 2, Text::_('COM_KUNENA_SHOW_USERLIST_COUNTUNSERS_ACTIVE'));
		$userlist_count_users[]         = HTMLHelper::_('select.option', 3, Text::_('COM_KUNENA_SHOW_USERLIST_COUNTUNSERS_NON_BLOCKED_USERS'));
		$lists ['userlist_count_users'] = HTMLHelper::_('select.genericlist', $userlist_count_users, 'cfg_userlist_count_users', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->userlist_count_users);

		// Added new options into K1.6.4
		$lists ['allowsubscriptions'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_allowsubscriptions', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->allowsubscriptions);

		$category_subscriptions           = [];
		$category_subscriptions[]         = HTMLHelper::_('select.option', 'disabled', Text::_('COM_KUNENA_OPTION_CATEGORY_SUBSCRIPTIONS_DISABLED'));
		$category_subscriptions[]         = HTMLHelper::_('select.option', 'topic', Text::_('COM_KUNENA_OPTION_CATEGORY_SUBSCRIPTIONS_TOPIC'));
		$category_subscriptions[]         = HTMLHelper::_('select.option', 'post', Text::_('COM_KUNENA_OPTION_CATEGORY_SUBSCRIPTIONS_POST'));
		$lists ['category_subscriptions'] = HTMLHelper::_('select.genericlist', $category_subscriptions, 'cfg_category_subscriptions', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->category_subscriptions);

		$topic_subscriptions           = [];
		$topic_subscriptions[]         = HTMLHelper::_('select.option', 'disabled', Text::_('COM_KUNENA_OPTION_TOPIC_SUBSCRIPTIONS_DISABLED'));
		$topic_subscriptions[]         = HTMLHelper::_('select.option', 'first', Text::_('COM_KUNENA_OPTION_TOPIC_SUBSCRIPTIONS_FIRST'));
		$topic_subscriptions[]         = HTMLHelper::_('select.option', 'every', Text::_('COM_KUNENA_OPTION_TOPIC_SUBSCRIPTIONS_EVERY'));
		$lists ['topic_subscriptions'] = HTMLHelper::_('select.genericlist', $topic_subscriptions, 'cfg_topic_subscriptions', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->topic_subscriptions);

		// Added new options into K1.6.6
		$email_recipient_privacy           = [];
		$email_recipient_privacy[]         = HTMLHelper::_('select.option', 'to', Text::_('COM_KUNENA_A_SUBSCRIPTIONS_EMAIL_RECIPIENT_PRIVACY_OPTION_TO'));
		$email_recipient_privacy[]         = HTMLHelper::_('select.option', 'cc', Text::_('COM_KUNENA_A_SUBSCRIPTIONS_EMAIL_RECIPIENT_PRIVACY_OPTION_CC'));
		$email_recipient_privacy[]         = HTMLHelper::_('select.option', 'bcc', Text::_('COM_KUNENA_A_SUBSCRIPTIONS_EMAIL_RECIPIENT_PRIVACY_OPTION_BCC'));
		$lists ['email_recipient_privacy'] = HTMLHelper::_('select.genericlist', $email_recipient_privacy, 'cfg_email_recipient_privacy', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->email_recipient_privacy);

		$uploads                = [];
		$uploads[]              = HTMLHelper::_('select.option', 'everybody', Text::_('COM_KUNENA_EVERYBODY'));
		$uploads[]              = HTMLHelper::_('select.option', 'registered', Text::_('COM_KUNENA_REGISTERED_USERS'));
		$uploads[]              = HTMLHelper::_('select.option', 'moderator', Text::_('COM_KUNENA_MODERATORS'));
		$uploads[]              = HTMLHelper::_('select.option', 'admin', Text::_('COM_KUNENA_ADMINS'));
		$uploads[]              = HTMLHelper::_('select.option', '', Text::_('COM_KUNENA_NOBODY'));
		$lists ['image_upload'] = HTMLHelper::_('select.genericlist', $uploads, 'cfg_image_upload', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->image_upload);
		$lists ['file_upload']  = HTMLHelper::_('select.genericlist', $uploads, 'cfg_file_upload', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->file_upload);

		$topic_layout[]         = HTMLHelper::_('select.option', 'flat', Text::_('COM_KUNENA_COM_A_TOPIC_LAYOUT_FLAT'));
		$topic_layout[]         = HTMLHelper::_('select.option', 'threaded', Text::_('COM_KUNENA_COM_A_TOPIC_LAYOUT_THREADED'));
		$topic_layout[]         = HTMLHelper::_('select.option', 'indented', Text::_('COM_KUNENA_COM_A_TOPIC_LAYOUT_INDENTED'));
		$lists ['topic_layout'] = HTMLHelper::_('select.genericlist', $topic_layout, 'cfg_topic_layout', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->topic_layout);

		$lists ['show_imgfiles_manage_profile'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_show_imgfiles_manage_profile', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->show_imgfiles_manage_profile);

		$lists ['show_imgfiles_manage_profile'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_show_imgfiles_manage_profile', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->show_imgfiles_manage_profile);

		$lists ['hold_guest_posts'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_hold_guest_posts', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->hold_guest_posts);

		$lists ['pickup_category'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_pickup_category', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->pickup_category);

		$article_display[]         = HTMLHelper::_('select.option', 'full', Text::_('COM_KUNENA_COM_A_FULL_ARTICLE'));
		$article_display[]         = HTMLHelper::_('select.option', 'intro', Text::_('COM_KUNENA_COM_A_INTRO_ARTICLE'));
		$article_display[]         = HTMLHelper::_('select.option', 'link', Text::_('COM_KUNENA_COM_A_ARTICLE_LINK'));
		$lists ['article_display'] = HTMLHelper::_('select.genericlist', $article_display, 'cfg_article_display', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->article_display);

		$lists ['send_emails']             = HTMLHelper::_('select.genericlist', $yesno, 'cfg_send_emails', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->send_emails);
		$lists ['enable_threaded_layouts'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_enable_threaded_layouts', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->enable_threaded_layouts);

		$default_sort           = [];
		$default_sort[]         = HTMLHelper::_('select.option', 'asc', Text::_('COM_KUNENA_OPTION_DEFAULT_SORT_FIRST'));
		$default_sort[]         = HTMLHelper::_('select.option', 'desc', Text::_('COM_KUNENA_OPTION_DEFAULT_SORT_LAST'));
		$lists ['default_sort'] = HTMLHelper::_('select.genericlist', $default_sort, 'cfg_default_sort', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->default_sort);

		$lists ['fallback_english'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_fallback_english', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->fallback_english);

		$cache   = [];
		$cache[] = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_CFG_OPTION_USE_GLOBAL'));
		$cache[] = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_CFG_OPTION_NO_CACHING'));

		$cachetime            = [];
		$cachetime[]          = HTMLHelper::_('select.option', '60', Text::_('COM_KUNENA_CFG_OPTION_1_MINUTE'));
		$cachetime[]          = HTMLHelper::_('select.option', '120', Text::_('COM_KUNENA_CFG_OPTION_2_MINUTES'));
		$cachetime[]          = HTMLHelper::_('select.option', '180', Text::_('COM_KUNENA_CFG_OPTION_3_MINUTES'));
		$cachetime[]          = HTMLHelper::_('select.option', '300', Text::_('COM_KUNENA_CFG_OPTION_5_MINUTES'));
		$cachetime[]          = HTMLHelper::_('select.option', '600', Text::_('COM_KUNENA_CFG_OPTION_10_MINUTES'));
		$cachetime[]          = HTMLHelper::_('select.option', '900', Text::_('COM_KUNENA_CFG_OPTION_15_MINUTES'));
		$cachetime[]          = HTMLHelper::_('select.option', '1800', Text::_('COM_KUNENA_CFG_OPTION_30_MINUTES'));
		$cachetime[]          = HTMLHelper::_('select.option', '3600', Text::_('COM_KUNENA_CFG_OPTION_60_MINUTES'));
		$lists ['cache']      = HTMLHelper::_('select.genericlist', $yesno, 'cfg_cache', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->cache);
		$lists ['cache_time'] = HTMLHelper::_('select.genericlist', $cachetime, 'cfg_cache_time', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->cache_time);

		// Added new options into Kunena 2.0.1
		$mailoptions   = [];
		$mailoptions[] = HTMLHelper::_('select.option', '-1', Text::_('COM_KUNENA_NO'));
		$mailoptions[] = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_CFG_OPTION_UNAPPROVED_POSTS'));
		$mailoptions[] = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_CFG_OPTION_ALL_NEW_POSTS'));

		$lists ['mailmod']   = HTMLHelper::_('select.genericlist', $mailoptions, 'cfg_mailmod', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->mailmod);
		$lists ['mailadmin'] = HTMLHelper::_('select.genericlist', $mailoptions, 'cfg_mailadmin', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->mailadmin);

		$lists ['iptracking'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_iptracking', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->iptracking);

		// Added new options into Kunena 3.0.0
		$lists ['autolink']         = HTMLHelper::_('select.genericlist', $yesno, 'cfg_autolink', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->autolink);
		$lists ['access_component'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_access_component', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->access_component);
		$lists ['componentUrl']     = preg_replace('|/+|', '/', Uri::root() . ($this->config->get('sef_rewrite') ? '' : 'index.php') . ($this->config->get('sef') ? '/component/kunena' : '?option=com_kunena'));

		// Added new options into Kunena 4.0.0
		$db    = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select('version')->from('#__kunena_version')->order('id');
		$query->setLimit(1);
		$db->setQuery($query);
		$lists['legacy_urls_version'] = $db->loadResult();

		$options                        = [];
		$options[]                      = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_NO'));
		$options[]                      = HTMLHelper::_('select.option', '1', 'Kunena 1.x');
		$lists['legacy_urls_desc']      = version_compare($lists['legacy_urls_version'], '2.0', '<') ? Text::_('COM_KUNENA_CFG_LEGACY_URLS_DESC_YES') : Text::_('COM_KUNENA_CFG_LEGACY_URLS_DESC_NO');
		$lists['legacy_urls']           = HTMLHelper::_('select.genericlist', $options, 'cfg_legacy_urls', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->legacy_urls);
		$lists['attachment_protection'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_attachment_protection', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->attachment_protection);

		// Option to select if the stats link need to be showed for all users or only for registred users
		$lists ['statslink_allowed']   = HTMLHelper::_('select.genericlist', $yesno, 'cfg_statslink_allowed', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->statslink_allowed);
		$lists ['superadmin_userlist'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_superadmin_userlist', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->superadmin_userlist);
		$resizeoptions                 = [];
		$resizeoptions[]               = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_RESIZE_RESIZE'));
		$resizeoptions[]               = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_RESIZE_INTERPOLATION'));
		$resizeoptions[]               = HTMLHelper::_('select.option', '2', Text::_('COM_KUNENA_RESIZE_BICUBIC'));
		$lists ['avatarcrop']          = HTMLHelper::_('select.genericlist', $yesno, 'cfg_avatarcrop', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->avatarcrop);
		$lists ['user_report']         = HTMLHelper::_('select.genericlist', $yesno, 'cfg_user_report', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->user_report);

		$searchtime           = [];
		$searchtime[]         = HTMLHelper::_('select.option', 1, Text::_('COM_KUNENA_CFG_SEARCH_DATE_YESTERDAY'));
		$searchtime[]         = HTMLHelper::_('select.option', 7, Text::_('COM_KUNENA_CFG_SEARCH_DATE_WEEK'));
		$searchtime[]         = HTMLHelper::_('select.option', 14, Text::_('COM_KUNENA_CFG_SEARCH_DATE_2WEEKS'));
		$searchtime[]         = HTMLHelper::_('select.option', 30, Text::_('COM_KUNENA_CFG_SEARCH_DATE_MONTH'));
		$searchtime[]         = HTMLHelper::_('select.option', 90, Text::_('COM_KUNENA_CFG_SEARCH_DATE_3MONTHS'));
		$searchtime[]         = HTMLHelper::_('select.option', 180, Text::_('COM_KUNENA_CFG_SEARCH_DATE_6MONTHS'));
		$searchtime[]         = HTMLHelper::_('select.option', 365, Text::_('COM_KUNENA_CFG_SEARCH_DATE_YEAR'));
		$searchtime[]         = HTMLHelper::_('select.option', 'all', Text::_('COM_KUNENA_CFG_SEARCH_DATE_ANY'));
		$lists ['searchtime'] = HTMLHelper::_('select.genericlist', $searchtime, 'cfg_searchtime', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->searchtime);

		$lists ['teaser'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_teaser', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->teaser);

		// List of eBay language code
		$ebay_language   = [];
		$ebay_language[] = HTMLHelper::_('select.option', '0', 'en-US');
		$ebay_language[] = HTMLHelper::_('select.option', '2', 'en-CA');
		$ebay_language[] = HTMLHelper::_('select.option', '3', 'en-GB');
		$ebay_language[] = HTMLHelper::_('select.option', '15', 'en-AU');
		$ebay_language[] = HTMLHelper::_('select.option', '16', 'de-AT');
		$ebay_language[] = HTMLHelper::_('select.option', '23', 'fr-BE');
		$ebay_language[] = HTMLHelper::_('select.option', '71', 'fr-FR');
		$ebay_language[] = HTMLHelper::_('select.option', '77', 'de-DE');
		$ebay_language[] = HTMLHelper::_('select.option', '101', 'it-IT');
		$ebay_language[] = HTMLHelper::_('select.option', '123', 'nl-BE');
		$ebay_language[] = HTMLHelper::_('select.option', '146', 'nl-NL');
		$ebay_language[] = HTMLHelper::_('select.option', '186', 'es-ES');
		$ebay_language[] = HTMLHelper::_('select.option', '193', 'ch-CH');
		$ebay_language[] = HTMLHelper::_('select.option', '201', 'hk-HK');
		$ebay_language[] = HTMLHelper::_('select.option', '203', 'in-IN');
		$ebay_language[] = HTMLHelper::_('select.option', '205', 'ie-IE');
		$ebay_language[] = HTMLHelper::_('select.option', '207', 'my-MY');
		$ebay_language[] = HTMLHelper::_('select.option', '210', 'fr-CA');
		$ebay_language[] = HTMLHelper::_('select.option', '211', 'ph-PH');
		$ebay_language[] = HTMLHelper::_('select.option', '212', 'pl-PL');
		$ebay_language[] = HTMLHelper::_('select.option', '216', 'sg-SG');

		$lists['ebay_language'] = HTMLHelper::_('select.genericlist', $ebay_language, 'cfg_ebay_language', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->ebay_language);

		$useredit          = [];
		$useredit[]        = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_EDIT_ALLOWED_NEVER'));
		$useredit[]        = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_EDIT_ALLOWED_ALWAYS'));
		$useredit[]        = HTMLHelper::_('select.option', '2', Text::_('COM_KUNENA_A_EDIT_ALLOWED_IF_REPLIES'));
		$useredit[]        = HTMLHelper::_('select.option', '3', Text::_('COM_KUNENA_EDIT_ALLOWED_ONLY_LAST_MESSAGE'));
		$useredit[]        = HTMLHelper::_('select.option', '4', Text::_('COM_KUNENA_EDIT_ALLOWED_ONLY_FIRST_MESSAGE'));
		$lists['useredit'] = HTMLHelper::_('select.genericlist', $useredit, 'cfg_useredit', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->useredit);

		$lists ['allow_change_subject'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_allow_change_subject', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->allow_change_subject);

		// K5.0
		$lists ['read_only'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_read_only', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->read_only);

		$lists['ratingenabled'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_ratingenabled', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->ratingenabled);

		$lists ['url_subject_topic'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_url_subject_topic', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->url_subject_topic);

		$lists ['log_moderation'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_log_moderation', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->log_moderation);

		$lists ['attachment_utf8'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_attachment_utf8', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->attachment_utf8);

		$lists ['autoembedsoundcloud'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_autoembedsoundcloud', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->autoembedsoundcloud);

		$lists ['user_status'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_user_status', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->user_status);

		// K5.1
		$lists ['signature'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_signature', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->signature);
		$lists ['personal']  = HTMLHelper::_('select.genericlist', $yesno, 'cfg_personal', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->personal);
		$lists ['social']    = HTMLHelper::_('select.genericlist', $yesno, 'cfg_social', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->social);

		$lists ['plain_email']  = HTMLHelper::_('select.genericlist', $yesno, 'cfg_plain_email', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->plain_email);
		$lists ['smartlinking'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_smartlinking', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->smartlinking);

		$rankimages           = [];
		$rankimages[]         = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_RANK_TEXT'));
		$rankimages[]         = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_RANK_IMAGE'));
		$rankimages[]         = HTMLHelper::_('select.option', '2', Text::_('COM_KUNENA_RANK_USERGROUP'));
		$rankimages[]         = HTMLHelper::_('select.option', '3', Text::_('COM_KUNENA_RANK_BOTH'));
		$rankimages[]         = HTMLHelper::_('select.option', '4', Text::_('COM_KUNENA_RANK_CSS'));
		$lists ['rankimages'] = HTMLHelper::_('select.genericlist', $rankimages, 'cfg_rankimages', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->rankimages);

		$lists['defaultavatar']      = HTMLHelper::_('select.genericlist', $yesno, 'cfg_defaultavatar', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->defaultavatar);
		$lists['defaultavatarsmall'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_defaultavatarsmall', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->defaultavatarsmall);
		$lists ['quickreply']        = HTMLHelper::_('select.genericlist', $yesno, 'cfg_quickreply', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->quickreply);
		$lists ['avataredit']        = HTMLHelper::_('select.genericlist', $yesno, 'cfg_avataredit', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->avataredit);

		$lists ['moderator_permdelete'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_moderator_permdelete', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->moderator_permdelete);

		$avatar_type           = [];
		$avatar_type[]         = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_AVATAR_IMAGE'));
		$avatar_type[]         = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_AVATAR_ICONTYPE'));
		$lists ['avatar_type'] = HTMLHelper::_('select.genericlist', $avatar_type, 'cfg_avatar_type', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->avatar_type);

		$lists ['sef_redirect'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_sef_redirect', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->sef_redirect);

		$user_edit_poll   = [];
		$user_edit_poll[] = HTMLHelper::_('select.option', '1', Text::_('COM_KUNENA_CONFIG_POLL_ALLOW_USER_EDIT_POLL_ALLOW'));
		$user_edit_poll[] = HTMLHelper::_('select.option', '0', Text::_('COM_KUNENA_CONFIG_POLL_ALLOW_USER_EDIT_POLL_DISALLOW'));

		$lists ['allow_user_edit_poll'] = HTMLHelper::_('select.genericlist', $user_edit_poll, 'cfg_allow_edit_poll', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->allow_edit_poll);

		// K 5.1.2
		$lists ['use_system_emails']  = HTMLHelper::_('select.genericlist', $yesno, 'cfg_use_system_emails', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->use_system_emails);
		$lists ['autoembedinstagram'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_autoembedinstagram', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->autoembedinstagram);

		// K6.0
		$lists ['utm_source'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_utm_source', 'class="inputbox form-control"size="1"', 'value', 'text', $this->config->utm_source);

		$lists ['disable_re'] = HTMLHelper::_('select.genericlist', $yesno, 'cfg_disable_re', 'class="inputbox" size="1"', 'value', 'text', $this->config->disable_re);

		return $lists;
	}
}