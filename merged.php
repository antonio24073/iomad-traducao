<?php
$strings = [];
$string = [];
require(__DIR__.'/src/admin/tool/iomadpolicy/lang/pt_br/tool_iomadpolicy.php');
$strings['tool_iomadpolicy'] = $string;
$string = [];
require(__DIR__.'/src/admin/tool/iomadsite/lang/pt_br/tool_iomadsite.php');
$strings['tool_iomadsite'] = $string;
$string = [];
require(__DIR__.'/src/admin/tool/iomadmerge/lang/pt_br/tool_iomadmerge.php');
$strings['tool_iomadmerge'] = $string;
$string = [];
require(__DIR__.'/src/local/iomad_track/lang/pt_br/local_iomad_track.php');
$strings['local_iomad_track'] = $string;
$string = [];
require(__DIR__.'/src/local/iomadcustompage/lang/pt_br/local_iomadcustompage.php');
$strings['local_iomadcustompage'] = $string;
$string = [];
require(__DIR__.'/src/local/iomad_settings/lang/pt_br/local_iomad_settings.php');
$strings['local_iomad_settings'] = $string;
$string = [];
require(__DIR__.'/src/local/iomad_learningpath/lang/pt_br/local_iomad_learningpath.php');
$strings['local_iomad_learningpath'] = $string;
$string = [];
require(__DIR__.'/src/local/iomad_signup/lang/pt_br/local_iomad_signup.php');
$strings['local_iomad_signup'] = $string;
$string = [];
require(__DIR__.'/src/local/iomad/lang/pt_br/local_iomad.php');
$strings['local_iomad'] = $string;
$string = [];
require(__DIR__.'/src/local/iomad_oidc_sync/lang/pt_br/local_iomad_oidc_sync.php');
$strings['local_iomad_oidc_sync'] = $string;
$string = [];
require(__DIR__.'/src/auth/iomadoidc/lang/pt_br/auth_iomadoidc.php');
$strings['auth_iomadoidc'] = $string;
$string = [];
require(__DIR__.'/src/auth/iomadsaml2/lang/pt_br/auth_iomadsaml2.php');
$strings['auth_iomadsaml2'] = $string;
$string = [];
require(__DIR__.'/src/mod/iomadcertificate/lang/pt_br/iomadcertificate.php');
$strings['iomadcertificate'] = $string;
$string = [];
require(__DIR__.'/src/blocks/iomad_html/lang/pt_br/block_iomad_html.php');
$strings['block_iomad_html'] = $string;
$string = [];
require(__DIR__.'/src/blocks/iomad_company_admin/lang/pt_br/block_iomad_company_admin.php');
$strings['block_iomad_company_admin'] = $string;
$string = [];
require(__DIR__.'/src/blocks/iomad_link/lang/pt_br/block_iomad_link.php');
$strings['block_iomad_link'] = $string;
$string = [];
require(__DIR__.'/src/blocks/iomad_microlearning/lang/pt_br/block_iomad_microlearning.php');
$strings['block_iomad_microlearning'] = $string;
$string = [];
require(__DIR__.'/src/blocks/iomad_approve_access/lang/pt_br/block_iomad_approve_access.php');
$strings['block_iomad_approve_access'] = $string;
$string = [];
require(__DIR__.'/src/blocks/iomad_onlineusers/lang/pt_br/block_iomad_onlineusers.php');
$strings['block_iomad_onlineusers'] = $string;
$string = [];
require(__DIR__.'/src/blocks/iomad_learningpath/lang/pt_br/block_iomad_learningpath.php');
$strings['block_iomad_learningpath'] = $string;
$string = [];
require(__DIR__.'/src/blocks/iomad_commerce/lang/pt_br/block_iomad_commerce.php');
$strings['block_iomad_commerce'] = $string;
$string = [];
require(__DIR__.'/src/blocks/iomad_reports/lang/pt_br/block_iomad_reports.php');
$strings['block_iomad_reports'] = $string;
$string = [];
require(__DIR__.'/src/blocks/iomad_company_selector/lang/pt_br/block_iomad_company_selector.php');
$strings['block_iomad_company_selector'] = $string;
$string = [];
require(__DIR__.'/src/blocks/iomad_welcome/lang/pt_br/block_iomad_welcome.php');
$strings['block_iomad_welcome'] = $string;
$string = [];
require(__DIR__.'/src/theme/iomadboost/lang/pt_br/theme_iomadboost.php');
$strings['theme_iomadboost'] = $string;
$string = [];
require(__DIR__.'/src/theme/iomad/lang/pt_br/theme_iomad.php');
$strings['theme_iomad'] = $string;
$string = [];
require(__DIR__.'/src/theme/iomadbootstrap/lang/pt_br/theme_iomadbootstrap.php');
$strings['theme_iomadbootstrap'] = $string;
$string = [];

foreach ($strings as $file => $string) {
    foreach($string as $key => $value) {
        if(str_contains($value,'|')){
            $value = str_replace('|', ' ', $value); // Replace pipe with space to avoid issues in CSV format.
        }
        $quotes = '';
        if(str_contains($value,'')){
            $value = str_replace('|', ' ', $value); // Replace pipe with space to avoid issues in CSV format.
        }
        echo "$file|$key|$value\n";
    }
}