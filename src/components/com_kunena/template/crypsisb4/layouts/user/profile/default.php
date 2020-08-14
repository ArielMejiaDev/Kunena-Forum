<?php
/**
 * Kunena Component
 *
 * @package         Kunena.Template.Crypsisb4
 * @subpackage      Layout.User
 *
 * @copyright       Copyright (C) 2008 - 2020 Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$user            = $this->user;
$this->ktemplate = KunenaFactory::getTemplate();
$avatar          = $user->getAvatarImage($this->ktemplate->params->get('avatarType'), 'post');
$config          = KunenaConfig::getInstance();
$show            = $config->showuserstats;

$activityIntegration = KunenaFactory::getActivityIntegration();
$points              = $activityIntegration->getUserPoints($user->userid);
$medals              = $activityIntegration->getUserMedals($user->userid);
$optional_username   = KunenaFactory::getTemplate()->params->get('optional_username');

if ($show)
{
	if ($config->showkarma)
	{
		$canseekarma = $user->canSeeKarma();
	}

	$rankImage    = $user->getRank($this->category_id, 'image');
	$rankTitle    = $user->getRank($this->category_id, 'title');
	$personalText = $user->getPersonalText();
}
?>
	<ul class="unstyled center profilebox">
		<li>
			<strong><?php echo $user->getLink(null, null, '', '', null, $this->category_id); ?></strong>
		</li>
		<?php if ($optional_username)
		:
			?>
			<li>
				[<?php echo $user->getLinkNoStyle('', '', 'kpost-username-optional') ?>]
			</li>
		<?php endif; ?>
		<?php
		if ($avatar)
		:
			?>
			<li>
				<?php echo $user->getLink($avatar, null, '', '', null, 0, KunenaConfig::getInstance()->avataredit); ?>
				<?php
				if (isset($this->topic_starter) && $this->topic_starter)
				:
					?>
					<span class="hidden-sm hidden-md topic-starter"><?php echo Text::_('COM_KUNENA_TOPIC_AUTHOR') ?></span>
				<?php endif;
				?>
				<?php /*if (!$this->topic_starter && $user->isModerator()) : */ ?><!--
			<span class="topic-moderator"><?php /*echo Text::_('COM_KUNENA_MODERATOR') */ ?></span>
		--><?php /*endif;*/ ?>
			</li>
		<?php endif; ?>

		<?php if ($user->exists() && $config->user_status)
		:
			?>
			<li>
				<?php echo $this->subLayout('User/Item/Status')->set('user', $user); ?>
			</li>
		<?php endif; ?>

		<?php if (!empty($rankTitle))
		:
			?>
			<li>
				<?php echo $this->escape($rankTitle); ?>
			</li>
		<?php endif; ?>

		<?php if (!empty($rankImage))
		:
			?>
			<li>
				<?php echo $rankImage; ?>
			</li>
		<?php endif; ?>

		<?php if (!empty($personalText))
		:
			?>
			<li>
				<?php echo $personalText; ?>
			</li>
		<?php endif; ?>
	</ul>
<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_profile_default'); ?>
<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_profile_default_' . $user->userid); ?>
<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_profile_default_' . $user->rank); ?>
<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_topicprofile'); ?>
<?php
if ($user->userid > 1)
:
	?>
	<div class="profile-expand center">
		<span class="heading btn btn-outline-primary border btn-xs heading-less hasTooltip"
			  style="display:none;" data-original-title="<?php echo Text::_('COM_KUNENA_USER_PROFILE_TOOLTIP_LABEL_LESS') ?>"><?php echo KunenaIcons::arrowup(); ?><?php echo Text::_('COM_KUNENA_USER_PROFILE_BUTTON_LABEL_LESS') ?></span>
		<span class="heading btn btn-outline-primary border btn-xs hasTooltip" data-original-title="<?php echo Text::_('COM_KUNENA_USER_PROFILE_TOOLTIP_LABEL_MORE') ?>"><?php echo KunenaIcons::arrowdown(); ?><?php echo Text::_('COM_KUNENA_USER_PROFILE_BUTTON_LABEL_MORE') ?></span>
		<div class="content" style="display:none;">
			<ul>
				<?php if ($user->posts >= 1)
				:
					?>
					<li>
						<?php echo Text::_('COM_KUNENA_POSTS') . ' ' . (int) $user->posts; ?>
					</li>
				<?php endif; ?>

				<?php if ($canseekarma && $config->showkarma)
				:
					?>
					<li>
						<?php echo Text::_('COM_KUNENA_KARMA') . ': ' . $this->subLayout('Widget/Karma')->set('topicicontype', $this->ktemplate->params->get('topicicontype'))->set('userid', $user->userid)->set('karmatype', 'karmadown').$this->subLayout('Widget/Karma')->set('topicicontype', $this->ktemplate->params->get('topicicontype'))->set('userid', $user->userid)->set('karmatype', 'karmaup'); ?>
					</li>
				<?php endif; ?>

				<?php if ($show && isset($user->thankyou) && $config->showthankyou)
				:
					?>
					<li>
						<?php echo Text::_('COM_KUNENA_MYPROFILE_THANKYOU_RECEIVED') . ' ' . (int) $user->thankyou; ?>
					</li>
				<?php endif; ?>

				<?php if ($show && !empty($points))
				:
					?>
					<li>
						<?php echo Text::_('COM_KUNENA_AUP_POINTS') . ' ' . $points; ?>
					</li>
				<?php endif; ?>

				<?php if ($show && !empty($medals))
				:
					?>
					<li>
						<?php echo implode(' ', $medals); ?>
					</li>
				<?php endif; ?>

				<?php if ($user->gender)
				:
					?>
					<li>
						<?php echo $user->profileIcon('gender'); ?>
					</li>
				<?php endif; ?>

				<?php if ($user->birthdate)
				:
					?>
					<li>
						<?php echo $user->profileIcon('birthdate'); ?>
					</li>
				<?php endif; ?>

				<?php if ($user->location)
				:
					?>
					<li>
						<?php echo $user->profileIcon('location'); ?>
					</li>
				<?php endif; ?>

				<?php if ($user->websiteurl)
				:
					?>
					<li>
						<?php echo $user->profileIcon('website'); ?>
					</li>
				<?php endif; ?>

				<?php if (KunenaFactory::getPrivateMessaging())
				:
					?>
					<li>
						<?php echo $user->profileIcon('private'); ?>
					</li>
				<?php endif; ?>

				<?php if ($user->email && !$user->hideEmail && $config->showemail)
				:
					?>
					<li>
						<?php echo $user->profileIcon('email'); ?>
					</li>
				<?php endif; ?>

				<?php echo $this->subLayout('Widget/Module')->set('position', 'kunena_topicprofilemore'); ?>
			</ul>
		</div>
	</div>
<?php endif;
