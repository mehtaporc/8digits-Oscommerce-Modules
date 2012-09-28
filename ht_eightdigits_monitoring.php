<?php
/*
  $Id$

  Module: 8digits Monitoring Platform For Joomla
  Author: 8digits <http://www.8digits.com/web/>


  Released under the GNU General Public License
*/

  define(MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_TITLE, '8digits Monitoring');
  define(MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_DESCRIPTION, '8digits Monitoring Tracking Code');
  define(MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_JS_PLACEMENT, 'Footer');

  class ht_eightdigits_monitoring {
    var $code = 'ht_eightdigits_monitoring';
    var $group = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function ht_eightdigits_monitoring() {
      $this->title = MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_TITLE;
      $this->description = MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_DESCRIPTION;

      if ( defined('MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_STATUS') ) {
        $this->sort_order = MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_SORT_ORDER;
        $this->enabled = (MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_STATUS == 'True');
      }
    }

    function execute() {
      global $PHP_SELF, $oscTemplate, $customer_id;

      if (tep_not_null(MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_TC)) {
        

        $header = '<script type="text/javascript">
  var _trackingCode = \''. tep_output_string(MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_TC) .'\';
  (function() {
    var wa = document.createElement("script"); wa.type = "text/javascript"; wa.async = true;
    wa.src = ("https:" == document.location.protocol ? "https:// " : "http://") + "tr2-static.8digits.com/js/wm.js?"+ Math.random();
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(wa, s);
  })();
</script>' ;


        $oscTemplate->addBlock($header, $this->group);
      }
    }


    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable 8Digits Monitoring Module', 'MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_STATUS', 'True', 'Do you want to add 8Digits Monitoring to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('8Digits Tracking Code', 'MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_TC', '', 'The 8digits Monitoring profile Tracking Code.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_STATUS', 'MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_TC', 'MODULE_HEADER_TAGS_EIGHTDIGITS_MONITORING_SORT_ORDER');
    }
  }
?>
