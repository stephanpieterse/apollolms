<?php
/**
 * @package ApolloLMS
  @author Stephan Pieterse
 * */
?>
<div class="wrapper" id="admin_floating_nav">
<div id="admin_floating_nav_buttons">
<ul id="nav">
<?php
if(check_user_permission(array('user_view','user_modify','user_add','user_remove'),true)){
	$subs = '<li><a href="users.php?f=admin_UserManage"><img src="' . ICONS_PATH . 'user.png"/>Users</a><ul>';
//users.php?f=admin_UserManage
		if(check_user_permission("user_add")){
		$subs .= '<li><a href="index.php?action=addUser">Add New User</a></li>';
		}
		if(check_user_permission("user_add")){
			$subs .= '<li><a href="users.php?f=admin_viewPending">View Pending Requests</a></li>';
			}
		if(check_user_permission("user_add")){
			$subs .= '<li><a href="index.php?aq=impCSVform">Import from CSV</a></li>';
			}
	$subs .= '<li><a href="mail.php?f=compose&to=allmembers">Mail Everyone</a></li>';
	$subs .= '</ul></li>';
	echo $subs;
}
if(check_user_permission(array('roles_add','roles_modify','roles_remove'),true)){
	echo '<li><a href="roles.php?f=admin_viewAll"><img src="' . ICONS_PATH . 'report_user.png"/>Roles</a></li>';
}
if(check_user_permission(array('content_view','content_add','content_modify','content_remove'),true)){
	$link = '<li><a href="courses.php?f=admin_CourseManage"><img src="' . ICONS_PATH . 'page_copy.png"/>Courses</a><ul>';
	if(check_user_permission("content_modify")){
        }
        if(check_user_permission("content_add")){
        $link .= '<li><a href="courses.php?f=editCourse">New Course</a></li>';
        }
        if(check_user_permission("content_add")){
        $link .= '<li><a href="courses.php?f=editCoursePackage">New Course Package</a></li>';
        }
        $link .= '<li><a href="courses.php?f=admin_pendingRegister">View Pending Registration Requests</a></li>';
	$link .= '</ul></li>';
        echo $link;
}
if(check_user_permission(array('events_add','events_modify','events_remove'),true)){
	echo '<li><a href="events.php?f=admin_home"><img src="' . ICONS_PATH . 'calendar.png"/>Events</a></li>';
}
if(check_user_permission(array('test_view','test_add','test_modify','test_remove'),true)){
	echo '<li><a href="tests.php?f=admin_viewAll"><img src="' . ICONS_PATH . 'report.png"/>Tests</a></li>';

}if(check_user_permission('calender_view',true)){
	echo '<li><a href="calender.php?f=admin_home"><img src="' . ICONS_PATH . 'calendar_view_day.png"/>Calender</a></li>';
}
if(check_user_permission(array('media_view','media_modify'),true)){
	$link = '<li><a href="media.php?f=admin_viewAllMedia&dir=uploads"><img src="' . ICONS_PATH . 'attach.png"/>Media</a><ul>';
	
	if(check_user_permission("media_modify")){
	if(isset($_GET['dir'])){
		$link .= '<li><a href="media.php?f=uploadFile&dir=' . $_GET['dir'] . '">Upload a File</a></li>';
	}else{
		$link .= '<li><a href="media.php?f=uploadFile' . '">Upload a File</a></li>';	
	}
	$link .= '<li><a href="media.php?f=newFolder">Create New Folder</a></li>';
	
	}
	$link .= '</ul></li>';
	echo $link;
}
if(check_user_permission(array('groups_add','groups_remove','groups_view','groups_modify'),true)){
	$link = '<li><a href="groups.php?f=admin_GroupManage"><img src="' . ICONS_PATH . 'group.png"/>Groups</a><ul>';
	
	if(check_user_permission("groups_add")){
		$link .= '<li><a href="groups.php?f=editGroup">Add New Group</a></li>';
		}
		if(check_user_permission("groups_add")){
		$link .= '<li><a href="groups.php?f=editGroupType">Add New Group Type</a></li>';
	}
	$link .= '</ul></li>';
	echo $link;
}
if(check_user_permission('help_view',true)){
	echo '<li><a href="help.php?f=admin_HelpManage"><img src="' . ICONS_PATH . 'email_error.png"/>Help Messages</a></li>';
}
if(check_user_permission('results_view',true)){
	echo '<li><a href="tests.php?f=admin_viewAllResults"><img src="' . ICONS_PATH . 'medal_gold_2.png"/>Results</a></li>';
}
if(check_user_permission(array('module_enable','module_move','module_install'),true)){
	$link = '<li><a href="modules.php?f=admin_ModuleManage"><img src="' . ICONS_PATH . 'server.png"/>Modules</a><ul>';
	if(check_user_permission("module_install")){
	$link .= '<li><a href="index.php?aq=frm_installModule">Install a module</a></li>';
	}
	$link .= '</ul></li>';
	echo $link;
	
}
if(check_user_permission('test_mark',true)){
	echo '<li><a href="tests.php?f=viewAllResultsMarkable"><img src="' . ICONS_PATH . 'report_edit.png"/>Mark Tests</a></li>';
}
if(check_user_permission('billing_view',true)){
	echo '<li><a href="billing.php?f=admin_BillingManage"><img src="' . ICONS_PATH . 'money.png"/>Billing</a></li>';
}
if(check_user_permission('flagged_items_view',true)){
	echo '<li><a href="flagged_items.php?f=admin_viewAll"><img src="' . ICONS_PATH . 'flag_red.png"/>Flagged Items</a></li>';
}
if(check_user_permission('site_settings_view',true)){
	echo '<li><a href="sitesettings.php?f=admin_SiteSettings"><img src="' . ICONS_PATH . 'cog.png"/>Site Settings</a></li>';
}
if(check_user_permission('site_stats_view',true)){
	echo '<li><a href="stats.php?f=sitestatistics"><img src="' . ICONS_PATH . 'chart_pie.png"/>Site Statistics</a></li>';
}
if(check_user_permission('backup_view',true)){
	echo '<li><a href="backup.php?f=admin_showAll"><img src="' . ICONS_PATH . 'database_table.png"/>Backup Management</a></li>';
//<li><a href="index.php?action=admin_ContentManage&sn=a_artmng">Article Management</a></li>
}
if(check_user_permission(array('modules_view','modules_edit'),true)){
	loadPageModules('adminnav');
}
?>
</ul>
</div>
</div>
