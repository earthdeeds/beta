<?php
 
/*
 * generate the request URL for looking up an entity record
 * @param $entity - (string) singular form of entity name ie. organization, job, event, etc.
 * @param $masterid - (string) the 'masterid' of the object you wish to lookup.
                                 see docs for more info.
 * @param $secret - (string) your WiserEarth API secret
 * @param $key - (string) your WiserEarth API key
 */
function generateLookupUrl($entity, $masterid, $secret, $key)
{
  $sig = generateLookupSig($masterid, $secret);
  $url = 'http://www.wiserearth.org/';
  $url .= $entity . 's';
  $url .= '/' . $masterid . '?sig=' . $sig . '&key=' . $key;

  return $url;
}
 
/*
 * generate the request URL for executing a search.
 * @param $entity - (string) singular form of entity name ie. organization, job, event, etc.
 * @param $params - (array) search parameters. key = parameter, value = value.
 *                            see docs for available search parameters.
 * @param $secret - (string) your WiserEarth API secret
 * @param $key - (string) your WiserEarth API key
 */
function generateSearchUrl($entity, $params, $secret, $key)
{
  $sig = generateSearchSig($params, $secret);
  $url = 'http://www.wiserearth.org/';
  $url .= $entity . 's';
  $url .= '/api_search?' . http_build_query($params) . '&sig=' . $sig . '&key=' . $key;

  return $url;
}
 
function generateLookupSig($masterid, $secret)
{
  $params = array('masterid' => $masterid);
  return generateSig($params, $secret);
}

function generateSearchSig($params, $secret)
{
  return generateSig($params, $secret);
}

function generateSig($params, $secret)
{
  $sig_str = '';
  foreach($params as $key => $value)
  {
    $sig_str .= $key . $value;
  }
  $sig_str .= $secret;
  return md5($sig_str);
}


?>
