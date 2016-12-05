<?php
/**
 * Plugin Name: HTML Editor Syntax Highlighter
 * Plugin URI: http://wordpress.org/extend/plugins/html-editor-syntax-highlighter/
 * Description: Syntax Highlighting in WordPress HTML Editor
 * Author: Peter Mukhortov
 * Author URI: http://mukhortov.com/
 * Version: 1.1
 * Requires at least: 3.3
 * Tested up to: 3.3
 * Stable tag: 1.1
 **/

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

define('HESH_LIBS',plugins_url('/lib/',__FILE__));

class wp_html_editor_syntax {
	public function __construct(){
		add_action('admin_init',array(&$this,'admin_init'));
		add_action('admin_head',array(&$this,'admin_head'));
		add_action('admin_footer',array(&$this,'admin_footer'));
	}
	public function admin_footer(){
		if (!$this->is_editor())
			return;
		?>

		<script type="text/javascript">
			


			function runEditorHighlighter(el) {
				fullscreen.switchmode('html');
				switchEditors.switchto(document.getElementById("content-html"));

				//fix
				var visualEditorEnabled;

				if (document.getElementById("content-tmce") != null) {
					visualEditorEnabled = true;
				} else {
					visualEditorEnabled = false;
				}

				if (visualEditorEnabled) {
					switchEditors.switchto(document.getElementById("content-html"));
				}
				// end fix

				//コード閉じる
				var foldFunc_html = CodeMirror.newFoldFunction(CodeMirror.tagRangeFinder);
			
				var editor = CodeMirror.fromTextArea(document.getElementById(el), {
					mode: "text/html",
					/*tabMode: "indent",*/
					lineNumbers: true,
					matchBrackets: true,
					/*indentUnit: 4,	//インデントサイズ */
					indentWithTabs: true,
					enterMode: "keep",
					lineWrapping: true,
					onCursorActivity: function() {
						editor.setLineClass(hlLine, null, null);
						hlLine = editor.setLineClass(editor.getCursor().line, null, "activeline");
					},
					onChange: function(){
						editor.save();
					},
					//ショートカットキー
					extraKeys: {
						//タグ自動閉じる
						"'>'": function(cm) { cm.closeTag(cm, '>'); },
						"'/'": function(cm) { cm.closeTag(cm, '/'); },
						"Alt-Q": function(instance) {
							//テキストエリアに文字列挿入
							console.log('keypress Alt-Q');
							instance.replaceSelection('<div class="section">\n\t<h3></h3>\n\t<p></p>\n</div>')
						}
					},
					//コード閉じる
					onGutterClick: foldFunc_html,
					//テーマ
					theme: 'colorforth',
					//zen coding
					onKeyEvent: function() {
						return zen_editor.handleKeyEvent.apply(zen_editor, arguments);
					}
				});
				var hlLine = editor.setLineClass(0, "activeline");
				
				if (visualEditorEnabled) {
					document.getElementById("content-tmce").onclick = function(e){
						editor.toTextArea();
						switchEditors.switchto(document.getElementById("content-tmce"));
						document.getElementById("content-html").onclick = function(e){
							runEditorHighlighter("content");
						}
					}
				}
				
				document.getElementById("qt_content_fullscreen").onclick = function(e){
					editor.toTextArea();
					fullscreen.switchmode('html');
					setTimeout('runEditorHighlighter("wp_mce_fullscreen")', 2000);
					document.getElementById("wp-fullscreen-close").onclick = function(e){
						fullscreen.off();
						runEditorHighlighter("content");
						return false;
					}
				}
			}

			window.onload = function() {
				runEditorHighlighter("content");
			}


		</script>

		<?php
	}
	public function admin_init(){
		wp_enqueue_script('jquery');	// For AJAX code submissions
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('jquery-ui-mouse');
		wp_enqueue_script('jquery-ui-resizable');
	}
	public function admin_head(){
		if (!$this->is_editor())
			return;

		?>
				<link rel="stylesheet" href="<?php echo HESH_LIBS; ?>codemirror.css">
				<script src="<?php echo HESH_LIBS; ?>codemirror.js"></script>
				<script src="<?php echo HESH_LIBS; ?>xml.js"></script>
				<script src="<?php echo HESH_LIBS; ?>javascript.js"></script>
				<script src="<?php echo HESH_LIBS; ?>css.js"></script>
				<script src="<?php echo HESH_LIBS; ?>htmlmixed.js"></script>
				<!-- タグ自動閉じる-->
				<script src="<?php echo HESH_LIBS; ?>util/closetag.js"></script>
				<!-- コード閉じる-->
				<script src="<?php echo HESH_LIBS; ?>util/foldcode.js"></script>
				<!-- 検索 -->
				<script src="<?php echo HESH_LIBS; ?>util/dialog.js"></script>
				<link rel="stylesheet" href="<?php echo HESH_LIBS; ?>util/dialog.css">
				<script src="<?php echo HESH_LIBS; ?>util/searchcursor.js"></script>
				<script src="<?php echo HESH_LIBS; ?>util/search.js"></script>
				<!-- テーマの読み込み -->
				<link rel="stylesheet" href="<?php echo HESH_LIBS; ?>theme/ambiance.css">
				<!-- ZenCoding -->
				<script type="text/javascript" src="<?php echo HESH_LIBS; ?>util/zen_codemirror.min.js"></script>
				<style>
				/* インデントスタイル */
				.cm-tab:after {
					   content: "\21e5";
					   display: -moz-inline-block;
					   display: -webkit-inline-block;
					   display: inline-block;
					   width: 0px;
					   position: relative;
					   overflow: visible;
					   left: -1.4em;
					   color: #aaa;
				}
				/* 選択された行の色 */
				div.CodeMirror .activeline {background: #3E3E3E !important;}
				</style>
		<?php

	}
	
	private function is_editor(){
		if (!strstr($_SERVER['SCRIPT_NAME'],'post.php'))
			return false;
		return true;
	}
}

if (is_admin())
	$hesh = new wp_html_editor_syntax();
?>