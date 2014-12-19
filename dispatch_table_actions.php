<?php
/**
 * Originally part of the apollolms system as a controller for navigation
 * since then a seperate controller has been built which allows more flexible access to the functions
 * still included since not all functions have been remapped yet and the gq section might stay in permanent use.
 *
 * @TODO remap all these ASAP
 * @author Stephan
 * @package ApolloLMS
 */

$dispatch_gq = array(
	'report_item'=>function(){log_report_item($_POST); goToLastPage();},
	'report_form'=>function(){include(TEMPLATE_PATH . "form_reportitem.php");},
);

$dispatch_aq = array(
'rm_page'=>function(){removeItem('pages', $_GET['pid']); verifyXML('articles',$_GET['aid']);},
'newPage'=>function(){include(TEMPLATE_PATH . 'form_edit_page.php');},
'add_page'=>function(){a_page_AddNewData($_GET['aid'],$_POST); goToLastPage("add_success");},
'upd_page'=>function(){a_update_page($_GET['pid'],$_POST); goToLastPage("update_success");},
'rm_article'=>function(){removeItem('articles', $_GET['aid']); verifyXML('courses',$_GET['cid']);},
'mv_page'=>function(){moveNode('articles', $_GET['aid'], 'PAGES', $_GET['pid'], $_GET['dir']); goToLastPage();},
'upd_group'=>function(){update_group_item($_GET['gid'], $_POST); goToLastPage();},
'rnmeFile'=>function(){renameFile(($_GET['dir'] . $_GET['file']), ($_GET['dir'] . $_POST['newFileName'])); goToLastPage();},

'mve_file'=>function(){renameFile(($_POST['dir'] . makeSafe($_POST['file'])), ($_POST['rootDirPath'] . $_POST['file'])); goToLastPage();},
'newgroupadmin'=>function(){assign_group_admin($_GET['uid'],$_GET['gid']);goToLastPage();},
'reg_course_pendact'=>function(){activate_user_to_course($_GET['cid'],$_GET['uid']); goToLastPage();},

'mv_tstQ'=>function(){moveNode('tests', $_GET['id'], 'QUESTIONS', $_GET['qid'], $_GET['dir']);},
'mod_test'=>function(){markLastPage($_GET); include(TEMPLATE_PATH . "form_editTestItem.php");},
'mod_test_permissions'=>function(){include(TEMPLATE_PATH . "form_editTestItem_permissions.php");},
'mod_test_questions'=>function(){include(TEMPLATE_PATH . "form_editTestItem_questions.php");},
'mod_test_prereq'=>function(){include(TEMPLATE_PATH . 'form_editTestItem_prereqs.php');},
'mod_test_prerequisites'=>function(){mod_test_prerequisites($_GET['tid']);},
'rem_test'=>function(){removeItem('tests', $_GET['id']); goToLastPage();},
'rem_media'=>function(){removeFile($_GET['media']); goToLastPage();},
'updateUserItem'=>function(){updateUserItem($_GET['uid'], $_POST);},
'module_settings_update'=>function(){module_update_settings($_GET['mid'],$_POST); goToLastPage();},
'frm_installModule'=>function(){include(TEMPLATE_PATH . 'form_select_installModule.php');},
'uploadModule'=>function(){installModule($_FILES);goToLastPage();},
'disp_course'=>function(){displayCourse($_GET['id'],-1);},
'mail_allgroupmembers'=>function(){include(TEMPLATE_PATH . 'form_sendemail.php');},

);

$dispatch_uq = array(
'upload_profilePicture'=>function(){upload_profilePicture($_FILES);},
'viewPage'=>function(){displayPage($_GET['pnm'], $_GET['aid']);},
'msg'=>function(){displayMsg($_GET['mid']);},
'viewGroups'=>function(){markLastPage($_GET); viewGroups();},
'group_lv'=>function(){leave_group($_GET['gid']); goToLastPage();},
'requestform'=>function(){include(TEMPLATE_PATH . 'form_request.php');},
'submitRequest'=>function(){submitContentRequest($_POST);},
'help'=>function(){helpPage();},
//'reg_course'=>function(){include(TEMPLATE_PATH. "form_registerForCourse.php");},
'reg_course_pend'=>function(){if(register_user_to_course($_GET['cid'],$_SESSION['userID'],$_POST)){ goHome('register_success');}},
'lastpage'=>function(){goToLastPage();},
);

$dispatch_action = array(
'clogin'=>function(){checkLogin($_POST['username'], $_POST['password']);},
 'login'=>function(){login();},
 'logout'=>function(){logout();},
'addUser'=>function(){include ( TEMPLATE_PATH . "form_adduseritem.php" );},
'addNewUser'=>function(){$retval=addUserItem($_POST);if($retval !== true){page_redirect("index.php",'',array('SITE_ERROR_MSG'=>$retval));}}, //ech o$retval;
'regNewUser'=>function(){include ( TEMPLATE_PATH . "form_adduseritem.php" );},							
'edituser'=>function(){editUser();},	
'rem_user'=>function(){removeItem('members',$_GET['uid']);},	 //removeUser($_GET['user']);
'rem_course'=>function(){removeItem('courses', $_GET['course']); findOrphans();}, //removeCourse($_GET['course']);
'new_article'=>function(){new_Article();},
'upd_article'=>function(){update_article($_GET['id'],$_POST); goToLastPage();},
'lostpassword2'=>function(){lostPassword2();},
'checkSecurityQ'=>function(){checkSecurityQ();},
'updatePasswordOnly'=>function(){updatePasswordOnly($_POST['newPass'],$_POST['nameCell']);},
'submitHelp'=>function(){submitHelpMsg();},
'rem_helpmsg'=>function(){deleteHelpMsg($_GET['msgid']); goToLastPage();},
'getGroupStats'=>function(){getGroupStats();},
'course'=>function(){displayCourse($_GET['id']);},
'article'=>function(){displayArticle($_GET['id'], $_GET['cid']);},

'linkArtData'=>function(){linkArtToCou($_GET['cid'], $_POST);},

'insertResult'=>function(){insertResult($_POST);goHome("result_add_success");},
'addNewArticle'=>function(){add_new_article(); goToLastPage();},

'newRoleItem'=>function(){newRoleItem();},
'updateRoleItem'=>function(){updateRoleItem($_GET['id'],$_POST);},
'del_role'=>function(){rm_roleItem($_GET['id']);},
'addToGroup'=>function(){addGroupData();},

'rem_group'=>function(){removeItem('groupslist', $_GET['group']);},//removeGroupData($_GET['group']);},

'insertNewGroupType'=>function(){insertNewGroupType($_POST['name'], $_POST['description']); goToLastPage();},
'rm_groupType'=>function(){rm_groupType($_GET['id']);},

'update_groupType'=>function(){update_groupType($_GET['id'], $_POST['description']);},
'setInitTest'=>function(){initTestData(); echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?action=test">';},
'test'=>function(){showTest($_SESSION['currentTestName']);},
'addResult'=>function(){$_SESSION['currentQuestion'] = $_SESSION['currentQuestion'] + 1;addResultData($_GET['qid'],$_GET['tid'],$_POST);echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php?action=test">';},
'insertTestQuestion'=>function(){loadInsertForm($_GET['questionType']);},
'newTest'=>function(){include(TEMPLATE_PATH . "form_addTestItem.php");},			
'newTestItem'=>function(){insertNewTestItem($_POST['testname'],$_POST['description'],$_POST['code']); goToLastPage();},
'set_test_permissions'=>function(){set_test_permissions($_GET['id'], $_POST);},
'mod_test_rmQuestion'=>function(){rm_question($_GET['tid'],$_GET['qid']);},
'addQuestion'=>function(){mod_test_addQuestion($_GET['id'], $_POST['question_type']);},
'insertQuestion'=>function(){mod_test_insertQuestion($_GET['id'], $_POST); goToLastPage();},
'uploadFile'=>function(){fileUpload();},
'uploadForm'=>function(){include(TEMPLATE_PATH . "/form_media_plupload.php");},
'mknewFolder'=>function(){makeNewFolder($_POST['rootDirPath'] . $_POST['newFolderName']);},
'composeMsg'=>function(){include(TEMPLATE_PATH . "form_msgCompose.php");},
'sendMsg'=>function(){sendMsg($_POST);}, 

'set_module_a'=>function(){setModuleStatus($_GET['mid'], 1);},
'set_module_i'=>function(){setModuleStatus($_GET['mid'], 0);},
'a_del_result'=>function(){if(deleteTestResult($_GET['id']) !== true){goHome("permission_denied");}else{ goToLastPage();}},
'view_role'=>function(){viewRoleItem($_GET['role']);},

'mod_course_art'=>function(){markLastPage($_GET); include(TEMPLATE_PATH . "form_linkArticles.php");},
'mod_course_artOrd'=>function(){include(TEMPLATE_PATH . "form_articlesOrder.php");},

'mv_art'=>function(){moveNode('courses', $_GET['id'], 'ARTICLES', $_GET['aid'], $_GET['dir']);goToLastPage();},
'uplcsvuser'=>function(){importCSVFileToUser($_FILES, $_POST);},
);

$dispatch_mail = array(
'allgroupmembers'=>function(){mail_informGroupUsers($_POST['gid'],$_POST['subject'],$_POST['msgbox']);},
'allmembers'=>function(){mail_informAllUsers($_POST['subject'],$_POST['msgbox']);},
'course'=>function(){mail_informCourse($_POST['cid'],$_POST['subject'],$_POST['msgbox']);},
);
?>
