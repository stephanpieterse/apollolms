<?php
/**
 * Originally part of the apollolms system as a controller for navigation
 * since then a seperate controller has been built which allows more flexible access to the functions
 * still included since not all functions have been remapped yet and the gq section might stay in permanent use.
 *
 * @TODO remap all these ASAP
 * @author Stephan Pieterse
 * @package ApolloLMS
 */

//$dispatch_gq = array(
	//'report_item'=>function(){log_report_item($_POST); goToLastPage();},
	//'report_form'=>function(){include(TEMPLATE_PATH . "form_reportitem.php");},
//);

$dispatch_aq = array(
//DEL	'add_page'=>function(){a_page_AddNewData($_GET['aid'],$_POST); goToLastPage("add_success");},
	'upd_page'=>function(){a_update_page($_GET['pid'],$_POST); goToLastPage("update_success");},
	//'rm_article'=>function(){removeItem('articles', $_GET['aid']); verifyXML('courses',$_GET['cid']);},
	'mv_page'=>function(){moveNode('articles', $_GET['aid'], 'PAGES', $_GET['pid'], $_GET['dir']); goToLastPage();},
	//'mve_file'=>function(){renameFile(($_POST['dir'] . makeSafe($_POST['file'])), ($_POST['rootDirPath'] . $_POST['file'])); goToLastPage();},
	'mv_tstQ'=>function(){moveNode('tests', $_GET['id'], 'QUESTIONS', $_GET['qid'], $_GET['dir']);},
	'mod_test_prerequisites'=>function(){mod_test_prerequisites($_GET['tid']);},
	'rem_test'=>function(){removeItem('tests', $_GET['id']); goToLastPage();},
	//'module_settings_update'=>function(){module_update_settings($_GET['mid'],$_POST); goToLastPage();},
);

$dispatch_action = array(
	'rem_course'=>function(){removeItem('courses', $_GET['course']); findOrphans();}, //removeCourse($_GET['course']);
	'rem_group'=>function(){removeItem('groupslist', $_GET['group']);},//removeGroupData($_GET['group']);},
	'setInitTest'=>function(){initTestData(); echo '<META HTTP-EQUIV="Refresh" Content="0; URL=tests.php?q=test&tid='. $_SESSION['currentTestName'] . ' ">';},
	'addResult'=>function(){$_SESSION['currentQuestion'] = $_SESSION['currentQuestion'] + 1;addResultData($_GET['qid'],$_GET['tid'],$_POST);echo '<META HTTP-EQUIV="Refresh" Content="0; URL=tests.php?q=test&tid='. $_SESSION['currentTestName'] . ' ">';},
	'insertTestQuestion'=>function(){loadInsertForm($_GET['questionType']);},		
	'newTestItem'=>function(){insertNewTestItem($_POST['testname'],$_POST['description'],$_POST['code']); goToLastPage();},
	'set_test_permissions'=>function(){set_test_permissions($_GET['id'], $_POST);},
	'mod_test_rmQuestion'=>function(){rm_question($_GET['tid'],$_GET['qid']);},
	'addQuestion'=>function(){mod_test_addQuestion($_GET['id'], $_POST['question_type']);},
	'insertQuestion'=>function(){mod_test_insertQuestion($_GET['id'], $_POST); goToLastPage();},
);
