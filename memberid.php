<?php

require_once 'memberid.civix.php';

/*Implementation of hook_civicrm_alterContent*/

function memberid_civicrm_alterContent(  &$content, $context, $tplName, &$object){
  if ($context=='page'){
    if ($tplName=='CRM/Contact/Page/View/Summary.tpl'){
	$marker1 = strpos($content, '<div class="crm-content crm-contact_type_label">');
	$marker = strpos($content, '<div class="crm-summary-row', $marker1);

	$content1 = substr($content, 0, $marker);
	$content3 = substr($content, $marker);
	$id = $_GET['cid'];

	$get_memberships = civicrm_api("Membership","get", array('version' =>'3', 'membership_contact_id' => $id, 'debug' => 1));
	$memberships = $get_memberships['values'];
	foreach ($memberships as $membership){
	  $content2 = '<div class="crm-summary-row">
                            <div class="crm-label">
                              '.$membership['membership_name']." ". ts('ID').': 
                            </div>
                            <div class="crm-content">
                              <span class="crm-contact-contact_id">'.$membership['id'].'</span>
                              </div>
                          </div>';
	$content = $content1.$content2.$content3;   
      }
    }
  if ($tplName == 'CRM/Member/Page/Tab.tpl'){
        if ($_GET['action']=='view'){
	  $marker1 = strpos($content, '<table class="crm-info-panel');
	  $marker2 = strpos($content, '<tr', $marker1);
	  $marker = strpos($content, '<tr', $marker2+1);     
	  $content1 = substr($content, 0, $marker);
	  $content3 = substr($content, $marker);
	  $id = $_GET['id'];
	  $content2 = '<tr><td class="label">'.ts('Membership ID').'</td><td>'.$id.'</td></tr>';
	  $content = $content1.$content2.$content3;  
        }
        elseif ($_GET['action']=='update'){
	  $marker1 = strpos($content, 'crm-membership-form-block-membership_type_id');    
	  $marker = strrpos(substr($content, 0, $marker1), '<tr'); 
	  $content1 = substr($content, 0, $marker);
	  $content3 = substr($content, $marker);
	  $id = $_GET['id'];
	  $content2 = '<tr><td class="font-size12pt label"><strong>'.ts('Membership ID').'</strong></td><td class="font-size12pt"><strong>   '.$id.'</strong></td></tr>';
	  $content = $content1.$content2.$content3;           
        } 	
    }
  }
}

/**
 * Implementation of hook_civicrm_config
 */
function memberid_civicrm_config(&$config) {
  _memberid_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 */
function memberid_civicrm_xmlMenu(&$files) {
  _memberid_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 */
function memberid_civicrm_install() {
  return _memberid_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function memberid_civicrm_uninstall() {
  return _memberid_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 */
function memberid_civicrm_enable() {
  return _memberid_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 */
function memberid_civicrm_disable() {
  return _memberid_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 */
function memberid_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _memberid_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function memberid_civicrm_managed(&$entities) {
  return _memberid_civix_civicrm_managed($entities);
}
