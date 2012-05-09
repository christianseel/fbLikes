<?php
/**
 * fbLikes
 *
 * Returns the number of fans for a facebook fanpage (via the graph api)
 *
 * @author Christian Seel
 * @version 1.0.2 - 2012-05-10
 *
 * OPTIONS
 * pageid - the facebook id of your fanpage
 * expiretime - lifetime of the cache in seconds (default: "10800", 3 hours)
 *
 * EXAMPLE
 * [[!fbLikes? &pageid=`19110642979` &expiretime=`10800`]]
 *
 * fbLikes is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * fbLikes is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 */

$pageid = $modx->getOption('pageid',$scriptProperties,"");
$expiretime = $modx->getOption('expiretime',$scriptProperties,"10800");
$cacheKey = 'fblikes/' . $pageid;

if (empty($pageid)) return "You need to specify the fanpage id (pageid parameter)!";

// get data from cache
$cached_data = $modx->cacheManager->get($cacheKey);

if (!$cached_data) {

	// if there's no cached data create it and save it...

	// get page information from facebooks graph api (returns json data)
	$graphdata = file_get_contents("http://graph.facebook.com/".$pageid);
	// decode json response
	$response = $modx->fromJSON($graphdata);
	if (!$response || !is_array($response) || !isset($response['likes'])) {
		return 'Data currently not available.';
	}
	// get like number
	$data = $response['likes'];

	// save data to the cache
	$modx->cacheManager->set($cacheKey,$data,$expiretime);
	$cached_data = $data;
	
}

// return data
return $cached_data;