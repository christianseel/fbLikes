<?php
/**
 * fbLikes
 *
 * Returns the number of fans for a facebook fanpage (via the graph api)
 *
 * @author Christian Seel
 * @version 1.0.0 - 2012-04-15
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
 * You should have received a copy of the GNU General Public License along with
 * fbLikes; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 */

$pageid = $modx->getOption('pageid',$scriptProperties,"19110642979");
$expiretime = $modx->getOption('expiretime',$scriptProperties,"10800");
$cacheKey = $modx->resource->getCacheKey().'/fblikes';

// get data from cache
$cached_data = $modx->cacheManager->get($cacheKey);

if (!$cached_data) {

	// if there's no cached data create it and save it...

	// get page information from facebooks graph api (returns json data)
	$graphdata = file_get_contents("http://graph.facebook.com/".$pageid);
	// decode json response
	$response = json_decode($graphdata, true);
	// get like number
	$data = $response['likes'];

	// save data to the cache
	$modx->cacheManager->set($cacheKey,$data,$expiretime);
	$cached_data = $data;
	
}

// return data
return $cached_data;