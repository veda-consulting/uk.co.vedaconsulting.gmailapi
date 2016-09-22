<?php

function civicrm_api3_civi_gmail_wrapper($params) {

  $validUser = FALSE;
  $appParams ='';
  $result['validuser'] = $validUser;

  if (!empty($params['appParams'])) {
    $appParams = unserialize($params['appParams']);
  }

  if ( !isset($appParams['token']) || empty($appParams['token'])) {
    CRM_Core_Error::debug_var('token empty', $appParams['action']);
    return civicrm_api3_create_success($result, $params, 'CiviGmail', 'wrapper');
  }

  $token  = json_decode($appParams['token'], true);

  // code to authenticate goes here
  /*

  */
  // temporary
  $validUser = TRUE;


  if ($validUser) {
    unset($appParams['token']);
    $contactDetails = _civicrm_api3_civi_gmailapi_civicrm_api_wrapper('CiviGmail', 'getcontact', $appParams);
    $result = $contactDetails['values'];
  }

  return civicrm_api3_create_success($result, $params, 'CiviGmail', 'wrapper');

}

function civicrm_api3_civi_gmail_getcontact($params) {

  if (empty($params['id'])) {
    return;
  }
  $contactId = $params['id'];
  $contactDetails = array();
  if ($contactId) {
    $contactDetails = _civicrm_api3_civi_gmailapi_civicrm_api_wrapper('Contact', 'getsingle', array('id' => $contactId));
  }

  return civicrm_api3_create_success($contactDetails, $params, 'CiviGmail', 'getcontact');
}
