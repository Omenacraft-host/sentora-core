<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modulelist
 *
 * @author ballen
 */
class ui_tpl_modulelist {


    function Template() {
		global $controller;
		if (!$controller->GetControllerRequest('URL', 'module')) {
			$line = "";
			$modcats = ui_moduleloader::GetModuleCats();
			foreach ($modcats as $modcat){
				$mods = ui_moduleloader::GetModuleList($modcat['mc_id_pk'], "modadmin");
				$line .= "<table class=\"zcat\">";
				$line .= "<tr>";
				$line .= "<th align=\"left\">";
				$line .= "<a name=\"" . str_replace(" ", "_", strtolower($modcat['mc_name_vc'])) . "\"></a>";
				$line .= "" . ui_language::translate($modcat['mc_name_vc']) . "";
				$line .= "<a href=\"#\" class=\"zcat\" id=\"zcat_" . str_replace(" ", "_", strtolower($modcat['mc_name_vc'])) . "_a\"></a>";
				$line .= "</th>";
				$line .= "</tr>";
                $line .= "<tr>";
				$line .= "<td align=\"left\">";
				$line .= "<div class=\"zcat_" . str_replace(" ", "_", strtolower($modcat['mc_name_vc'])) . "\" id=\"zcat_" . str_replace(" ", "_", strtolower($modcat['mc_name_vc'])) . "\">";
				$line .= "<table class=\"zcatcontent\" align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				$line .= "<tr>";
				$line .= "<td>";
                $line .= "<table align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
				$line .= "<tr>";
				$icons_per_row = ctrl_options::GetOption('module_icons_pr');
				$num_icons = 0;						
				foreach ($mods as $mod){
					$translatename = ui_language::translate($mod['mo_name_vc']);
                    $cleanname = str_replace(" ", "<br />", $translatename);
					if ($num_icons == $icons_per_row) {
                    	$line .= "</tr><tr>";
                        $num_icons = 0;
                    }
					$line .= "<td style=\"text-align:center;\" align=\"left\">";
					$line .= "<a href=\"?module=" . $mod['mo_folder_vc'] . "\" title=\"" . ui_language::translate($mod['mo_desc_tx']) . "\">";
					$line .= "<img src=\"modules/" . $mod['mo_folder_vc'] . "/assets/icon.png\" border=\"0\" />";
					$line .= "</a>";
					$line .= "<br />";
					$line .= "<a href=\"?module=" . $mod['mo_folder_vc'] . "\">" . $cleanname . "</a>";
					$line .= "</td>";
					$num_icons++;		
				}
				 $line .= "</tr></table></td></tr></table></div></td></tr></table><br>";
			}
            return $line;
		}
    }
	
	
}

?>
