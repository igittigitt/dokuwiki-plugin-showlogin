<?php
/**
 * DokuWiki Plugin showlogin (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Oliver Geisen <oliver.geisen@kreisbote.de>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'action.php';

class action_plugin_showlogin extends DokuWiki_Action_Plugin {

    /**
     * Register its handlers with the dokuwiki's event controller
     */
    public function register(Doku_Event_Handler &$controller) {

      # TPL_CONTENT_DISPLAY is called before and after content of wikipage is written to output buffer
       $controller->register_hook('TPL_CONTENT_DISPLAY', 'BEFORE', $this, 'handle_tpl_content_display');
   
    }

    /**
     * Handle the event
     */ 
    public function handle_tpl_content_display(Doku_Event &$event, $param) {
      global $ACT;

      # If user is not logged in and access to page is denied, show login form
      if (($ACT == 'denied') && (! $_SERVER['REMOTE_USER'])) {
	$event->preventDefault(); // prevent "Access denied" page from showing
	html_login(); // show login dialog instead
      }
      # .. or show regular access denied page
    }

}

// vim:ts=4:sw=4:et:
