<?php
include_once('../check_joomla');

function test($actual, $expected)
{
    if ($actual != $expected) {
        echo "Error: ";
        print_r($actual);
        echo " is different from ";
        print_r($expected);
        return 1;
    }
    return 0;
}

$release = getPrev38Version('./libraries/cms/version/version.php', true);

$expected = [
    'MAJOR' => 3,
    'MINOR' => 7,
    'PATCH' => 1,
];

$result = test($release, $expected);
if ($result) {
    exit($result);
}

$release = getPost38Version('./libraries/src/Version.php', true);
$expected = [
    'MAJOR' => 3,
    'MINOR' => 9,
    'PATCH' => 25,
];

$result = test($release, $expected);
if ($result) {
    exit($result);
}

$updatefileContent = '<extensionset name="Joomla Core" description="Joomla! Core">
<extension name="Joomla" element="joomla" type="file" version="3.1.3" targetplatformversion="3.1.2" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.5.1" targetplatformversion="2.5" detailsurl="https://update.joomla.org/core/sts/extension_sts.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.2.7" targetplatformversion="3.0" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.2.7" targetplatformversion="3.1" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.2.7" targetplatformversion="3.2" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.6.5" targetplatformversion="3.2.7" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.6.5" targetplatformversion="3.3" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.6.5" targetplatformversion="3.4" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.6.5" targetplatformversion="3.5" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.10.0" targetplatformversion="3.6.5" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.6.5" targetplatformversion="3.6" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.10.0" targetplatformversion="3.7" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.10.0" targetplatformversion="3.8" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="3.10.0" targetplatformversion="3.9" detailsurl="https://update.joomla.org/core/extension.xml"/>
<extension name="Joomla" element="joomla" type="file" version="4.0.0" targetplatformversion="3.10" detailsurl="https://update.joomla.org/core/sts/extension_sts.xml"/>
<extension name="Joomla" element="joomla" type="file" version="4.0.0" targetplatformversion="4.0" detailsurl="https://update.joomla.org/core/sts/extension_sts.xml"/>
</extensionset>';

$result = [
    'MAJOR' => 3,
    'MINOR' => 2,
    'PATCH' => 0
];

$calculated = calculateUpdate($result, true, $updatefileContent);

$result = test($calculated, 1); // Should update
if ($result) {
    exit($result);
}

$result = [
    'MAJOR' => 3,
    'MINOR' => 10,
    'PATCH' => 1
];

$calculated = calculateUpdate($result, true, $updatefileContent);

$result = test($calculated, 1); // Should update
if ($result) {
    exit($result);
}

$result = [
    'MAJOR' => 4,
    'MINOR' => 0,
    'PATCH' => 0
];

$calculated = calculateUpdate($result, true, $updatefileContent);

$result = test($calculated, 0); // Should not update
if ($result) {
    exit($result);
}
