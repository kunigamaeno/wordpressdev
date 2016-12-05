<?php
/*
Plugin Name: CodeMirror File Editor
Description: Replace default theme and plugin editor with CodeMirror
Author: Viacheslav Zavoruev
Version: 1.2.3
License: GPLv2 or later
Text Domain: codemirror-file-editor
Domain Path: /languages
*/

function cfe_load_plugin_textdomain() {
    load_plugin_textdomain( 'codemirror-file-editor', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'cfe_load_plugin_textdomain' );

function cmfe_admin_enqueue_scripts( $hook ) {
	/*
	if ( $hook != 'theme-editor.php' && $hook != 'plugin-editor.php')
	{
		return;
	}
	*/

	$orgflg=0; //old mode is 1. new add is 2. none return or 0.
	switch($hook)
	{
		case 'theme-editor.php': $orgflg=1; break;
		case 'plugin-editor.php':$orgflg=1; break;
		case 'post.php': $orgflg=2; break;
		case 'wp-admin.php': $orgflg=2; break;
		default : return;
	}
		
    if($orgflg==1)
    {
		global $file;
	
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$mode = null;
	
		wp_register_style( 'codemirror', plugins_url( 'codemirror/lib/codemirror.css', __FILE__ ), null, '5.19.0' );
		wp_register_style( 'cmfe', plugins_url( 'plugin.css', __FILE__ ), array( 'codemirror' ), '1.2.0' );
	
		wp_enqueue_style( 'cmfe' );
	
		wp_register_script( 'requirejs', plugins_url( "require$suffix.js", __FILE__ ), null, '2.3.2', true );
		wp_register_script( 'cmfe', plugins_url( 'plugin.js', __FILE__ ), array( 'requirejs' ), '1.2.0', true );
	
		$scripts = array(
			'lib/codemirror',
			'addon/dialog/dialog',
			'addon/display/fullscreen',
			'addon/search/search',
			'addon/search/searchcursor',
			'keymap/sublime',
		);
	
		if ( !empty( $file )) {
			$ext = substr( $file, strrpos( $file, '.' ) + 1 );
	
			switch ( $ext ) {
				case 'css':
					$mode = $ext;
	
					array_push( $scripts,
						'addon/edit/closebrackets',
						'addon/edit/matchbrackets',
						'addon/hint/show-hint',
						'addon/hint/css-hint'
					);
					break;
	
				case 'html':
					$mode = 'htmlmixed';
	
					array_push( $scripts,
						'addon/edit/closebrackets',
						'addon/edit/closetag',
						'addon/edit/matchbrackets',
						'addon/edit/matchtags',
						'addon/hint/show-hint',
						'addon/hint/css-hint',
						'addon/hint/html-hint',
						'addon/hint/javascript-hint'
					);
					break;
	
				case 'js':
					$mode = 'javascript';
	
					array_push( $scripts,
						'addon/edit/closetag',
						'addon/edit/matchtags',
						'addon/hint/show-hint',
						'addon/hint/javascript-hint'
					);
					break;
	
				case 'php':
					$mode = $ext;
	
					array_push( $scripts,
						'addon/edit/closebrackets',
						'addon/edit/closetag',
						'addon/edit/matchbrackets',
						'addon/edit/matchtags'
					);
					break;
				/* added 20161125 kuniga.maeno*/
				case 'markdown':
					$mode = $ext;
	
					array_push( $scripts,
						'addon/edit/closebrackets',
						'addon/edit/closetag',
						'addon/edit/matchbrackets',
						'addon/edit/matchtags'
					);
					break;
				/* ended kuniga.maeno */				
			}
		}
	
		if ( !empty( $mode ) ) {
			$scripts[] = 'mode/' . $mode . '/' . $mode;
		}
	
		wp_localize_script( 'cmfe', 'cmfe', array(
			'requireJsConfig' => array(
				'baseUrl' => plugins_url( 'codemirror', __FILE__ ),
			),
			'codeMirrorConfig' => array (
				'autoCloseBrackets' => true,
				'autoCloseTags' => true,
				'indentUnit' => 8,
				'indentWithTabs' => true,
				'lineNumbers' => true,
				'keyMap' => 'sublime',
				'matchBrackets' => true,
				'matchTags' => true,
				'mode' => $mode,
				'tabSize' => 8,
			),
			'scripts' => $scripts,
		), '1.0.0');
	
		wp_enqueue_script( 'cmfe' );
    }elseif ( $orgflg==2 ) {
    	// my custom version
		global $file;
	
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$mode = null;
	
		wp_register_style( 'codemirror', plugins_url( 'codemirror/lib/codemirror.css', __FILE__ ), null, '5.19.0' );
		wp_register_style( 'cmfe', plugins_url( 'plugin.css', __FILE__ ), array( 'codemirror' ), '1.2.0' );
	
		wp_enqueue_style( 'cmfe' );
	
		wp_register_script( 'requirejs', plugins_url( "require$suffix.js", __FILE__ ), null, '2.3.2', true );
		wp_register_script( 'cmfe', plugins_url( 'plugin.js', __FILE__ ), array( 'requirejs' ), '1.2.0', true );
	
		$scripts = array(
			'lib/codemirror',
			'addon/dialog/dialog',
			'addon/display/fullscreen',
			'addon/search/search',
			'addon/search/searchcursor',
			'keymap/sublime',
		);
	
		if ( !empty( $file )) {
					$ext="markdown";
					$mode = $ext;
					array_push( $scripts,
						'addon/edit/closebrackets',
						'addon/edit/closetag',
						'addon/edit/matchbrackets',
						'addon/edit/matchtags',
						'addon/hint/show-hint',
						'addon/hint/css-hint',
						'addon/hint/html-hint',
						'addon/hint/javascript-hint'
					);
				/* mode/markdown/markdown.js */
				/* ended kuniga.maeno */				
			
		}
	
		if ( !empty( $mode ) ) {
			$scripts[] = 'mode/' . $mode . '/' . $mode;
		}
	
		wp_localize_script( 'cmfe', 'cmfe', array(
			'requireJsConfig' => array(
				'baseUrl' => plugins_url( 'codemirror', __FILE__ ),
			),
			'codeMirrorConfig' => array (
				'autoCloseBrackets' => true,
				'autoCloseTags' => true,
				'indentUnit' => 8,
				'indentWithTabs' => true,
				'lineNumbers' => true,
				'keyMap' => 'sublime',
				'matchBrackets' => true,
				'matchTags' => true,
				'mode' => 'text/x-markdown', /* $mode,*/
				'tabSize' => 8,
				'extraKeys' => array("Ctrl-Space" => "autocomplete"),
			),
			'scripts' => $scripts,
		), '1.0.0');
	
		wp_enqueue_script( 'cmfe' );
    	
    }
}
add_action( 'admin_enqueue_scripts', 'cmfe_admin_enqueue_scripts' );