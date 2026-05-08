<?php

/**
 * Gera arquivos de tradução Moodle/IOMAD a partir de um CSV/tab separado.
 *
 * Estrutura esperada da tabela:
 *
 * file | string | en | es | zh | es_php | zh_php
 *
 * Exemplo:
 * tool_iomadmerge | choose_users | Choose users | Seleccione usuarios | 选择用户
 *
 * Uso:
 * php generate_lang.php translations.csv es
 * php generate_lang.php translations.csv zh
 *
 * Saída:
 * ./output/admin/tool/iomadmerge/lang/es/tool_iomadmerge.php
 * ./output/admin/tool/iomadmerge/lang/zh/tool_iomadmerge.php
 */

$knownFiles = [
    './admin/tool/iomadmerge/lang/en/tool_iomadmerge.php',
    './admin/tool/iomadpolicy/lang/en/tool_iomadpolicy.php',
    './admin/tool/iomadsite/lang/en/tool_iomadsite.php',
    './auth/iomadoidc/lang/en/auth_iomadoidc.php',
    './auth/iomadsaml2/lang/en/auth_iomadsaml2.php',
    './blocks/iomad_approve_access/lang/en/block_iomad_approve_access.php',
    './blocks/iomad_commerce/lang/en/block_iomad_commerce.php',
    './blocks/iomad_company_admin/lang/en/block_iomad_company_admin.php',
    './blocks/iomad_company_selector/lang/en/block_iomad_company_selector.php',
    './blocks/iomad_html/lang/en/block_iomad_html.php',
    './blocks/iomad_learningpath/lang/en/block_iomad_learningpath.php',
    './blocks/iomad_link/lang/en/block_iomad_link.php',
    './blocks/iomad_microlearning/lang/en/block_iomad_microlearning.php',
    './blocks/iomad_onlineusers/lang/en/block_iomad_onlineusers.php',
    './blocks/iomad_reports/lang/en/block_iomad_reports.php',
    './blocks/iomad_welcome/lang/en/block_iomad_welcome.php',
    './blocks/mycourses/lang/en/block_mycourses.php',
    './filter/iomad/lang/en/filter_iomad.php',
    './local/iomadcustompage/lang/en/local_iomadcustompage.php',
    './local/iomad/lang/en/local_iomad.php',
    './local/iomad_learningpath/lang/en/local_iomad_learningpath.php',
    './local/iomad_oidc_sync/lang/en/local_iomad_oidc_sync.php',
    './local/iomad_settings/lang/en/local_iomad_settings.php',
    './local/iomad_signup/lang/en/local_iomad_signup.php',
    './local/iomad_track/lang/en/local_iomad_track.php',
    './local/report_attendance/lang/en/local_report_attendance.php',
    './local/report_companies/lang/en/local_report_companies.php',
    './local/report_completion/lang/en/local_report_completion.php',
    './local/report_completion_monthly/lang/en/local_report_completion_monthly.php',
    './local/report_completion_overview/lang/en/local_report_completion_overview.php',
    './local/report_emails/lang/en/local_report_emails.php',
    './local/report_license_usage/lang/en/local_report_license_usage.php',
    './local/report_user_license_allocations/lang/en/local_report_user_license_allocations.php',
    './local/report_user_logins/lang/en/local_report_user_logins.php',
    './local/report_users/lang/en/local_report_users.php',
    './mod/iomadcertificate/lang/en/iomadcertificate.php',
    './theme/iomadboost/lang/en/theme_iomadboost.php',
    './theme/iomadbootstrap/lang/en/theme_iomadbootstrap.php',
    './theme/iomad/lang/en/theme_iomad.php',
];

if ($argc < 3) {
    die("Uso:\nphp generate_lang.php arquivo.csv es\n");
}

$csvFile = $argv[1];
$lang = $argv[2];

if (!file_exists($csvFile)) {
    die("Arquivo CSV não encontrado: {$csvFile}\n");
}

$map = [];

/**
 * Cria mapa:
 * tool_iomadmerge => ./admin/tool/iomadmerge/lang/en/tool_iomadmerge.php
 */
foreach ($knownFiles as $path) {
    $filename = basename($path, '.php');
    $map[$filename] = $path;
}

$handle = fopen($csvFile, 'r');

if (!$handle) {
    die("Erro ao abrir CSV.\n");
}

/**
 * Detecta delimitador
 */
$firstLine = fgets($handle);

$delimiter = '|';

if (substr_count($firstLine, "\t") > substr_count($firstLine, ',')) {
    $delimiter = "\t";
}

rewind($handle);

/**
 * Cabeçalho
 */
$header = fgetcsv($handle, 0, $delimiter);

$headerIndexes = array_flip($header);

if (!isset($headerIndexes['file']) ||
    !isset($headerIndexes['string']) ||
    !isset($headerIndexes[$lang])) {

    die("CSV precisa ter colunas: file, string e {$lang}\n");
}

$outputData = [];

/**
 * Lê linhas
 */
while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {

    $fileKey = trim($row[$headerIndexes['file']] ?? '');
    $stringKey = trim($row[$headerIndexes['string']] ?? '');
    $translation = $row[$headerIndexes[$lang]] ?? '';

    if ($fileKey === '' || $stringKey === '') {
        continue;
    }

    if (!isset($map[$fileKey])) {
        echo "Arquivo não encontrado no mapa: {$fileKey}\n";
        continue;
    }

    if (!isset($outputData[$fileKey])) {
        $outputData[$fileKey] = [];
    }

    $outputData[$fileKey][$stringKey] = $translation;
}

fclose($handle);

/**
 * Gera arquivos
 */
foreach ($outputData as $fileKey => $strings) {

    $sourcePath = $map[$fileKey];

    $targetPath = preg_replace(
        '#/lang/en/#',
        "/lang/{$lang}/",
        $sourcePath
    );

    $targetPath = './output/' . ltrim($targetPath, './');

    $dir = dirname($targetPath);

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $content = "<?php\n";
    $content .= "\n";
    $content .= "// Auto generated language file.\n";
    $content .= "\n";

    foreach ($strings as $key => $value) {

        /**
         * Escapes PHP
         */
        $value = str_replace("\\", "\\\\", $value);
        $value = str_replace("'", "\\'", $value);

        $content .= "\$string['{$key}'] = '{$value}';\n";
    }

    file_put_contents($targetPath, $content);

    echo "Gerado: {$targetPath}\n";
}

echo "\nConcluído.\n";