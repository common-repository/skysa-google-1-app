<?php
/*
Plugin Name: Skysa Google +1 App
Plugin URI: http://wordpress.org/extend/plugins/skysa-google-1-app
Description: Google's +1 button with an optional share count, displayed on your Skysa bar.
Version: 1.4
Author: Skysa
Author URI: http://www.skysa.com
*/

/*
*************************************************************
*                 This app was made using the:              *
*                       Skysa App SDK                       *
*    http://wordpress.org/extend/plugins/skysa-app-sdk/     *
*************************************************************
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
MA  02110-1301, USA.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) exit;

// Skysa App plugins require the skysa-req subdirectory,
// and the index file in that directory to be included.
// Here is where we make sure it is included in the project.
include_once dirname( __FILE__ ) . '/skysa-required/index.php';


// Google +1 APP
$GLOBALS['SkysaApps']->RegisterApp(array( 
    'id' => '502044fd0a681',
    'label' => 'Google +1',
	'options' => array(
		'option3' => array(
            'label' => 'What URL would you like shared?',
			'info' => 'Leave this blank to share the page URL the user is currently on.',
			'type' => 'text',
			'value' => '',
			'size' => '50|1'
		),
        'option2' => array(
            'label' => 'Show Count?',
			'info' => 'Show the number count next to the +1 button?',
			'type' => 'selectbox',
			'value' => 'Yes|No',
			'size' => '10|1'
		)
	), 
    'fvars' => array(
        'count' => 'skysa_app_gplus_fvar_count'
    ),
    'html' => '<div id="$button_id" class="SKYUI-Mod-PlusOne-Button-holder"><span class="SKYUI-Mod-PlusOne-Button" style="vertical-align: middle; display: inline-block; padding-top: 5px;"><g:plusone size="medium" href="$app_option3" count="#fvar_count"></g:plusone></span></div>',
    'js' => "
        S.on('load',function(){
            S.require('js','//apis.google.com/js/plusone.js?parsetags=explicit',null,function(){gapi.plusone.go();});
        });
        S.load('cssStr','.SKYUI-Mod-PlusOne-Button-holder {width: '+('\$app_option2' != 'No' ? '82' : '35')+'px !important; text-align: center;} .SKYUI-Mod-PlusOne-Button {padding-left: '+('\$app_option2' != 'No' ? '5' : '0')+'px;} .SKYUI-Mod-PlusOne-Button a, .SKYUI-Mod-PlusOne-Button iframe {margin: 5px auto 0 auto} .SKYUI-Mod-PlusOne-Button iframe {position: static !important;}',true);
     "
));

function skysa_app_gplus_fvar_count($rec){
    if($rec['option2'] != 'No'){
        return 'true';
    }
    return 'false';
}
?>