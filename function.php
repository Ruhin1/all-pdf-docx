<?php

// Define application constants
define('APPNAME', 'My Docx');
define('BASEURL', 'http://127.0.0.1/');

// Scan the root documentation directory
$result1 = scandir(__DIR__ . '/documentation');

// Filter out '.' and '..' from the scanned results
$rootFolder = array_filter($result1, function ($data) {
    return $data != '.' && $data != '..';
});

// Function to handle redirection with status code
function redirect(string $page) {
    $status_code = ['code' => 301];
    $queryString = http_build_query($status_code);
    header("location:$page?$queryString");
    exit();
}

// Check if 'tutorals' cookie is set, otherwise default to 'php'
if (isset($_COOKIE['tutorals'])) {
    $tutorals = $_COOKIE['tutorals'];
} else {
    $tutorals = 'php';
}

// Handle form submission and set 'tutorals' cookie
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && !empty($_POST['tacnolajy'])) {
    $tutorals = $_POST['tacnolajy'];
    setcookie('tutorals', $tutorals, time() + 3600, '/');
}

// Define the folder path based on the selected 'tutorals'
$folderPath = __DIR__ . '/documentation/' . $tutorals;

// Function to recursively scan a directory and return its structure
function scanDirectory($folderPath) {
    try {
        if (is_dir($folderPath)) {
            $result = [];
            $files = scandir($folderPath);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $fullPath = $folderPath . '/' . $file;
                    if (is_dir($fullPath)) {
                        // Recursively scan subdirectories
                        $result[$file] = scanDirectory($fullPath);
                    } elseif (is_file($fullPath)) {
                        // Add files to the array
                        $result[] = [
                            'name' => $file,
                            'path' => realpath($fullPath)
                        ];
                    }
                }
            }
            return $result;
        } else {
            // Redirect if the folder path is not valid
            redirect('./errorpage.php');
        }
    } catch (Exception $error) {
        // Redirect in case of an exception
        redirect('./errorpage.php');
    }
}

// Get the directory structure of the specified folder
$directoryStructure = scanDirectory($folderPath);

// Function to convert file paths to a URL format
function convertPath(string $path, int $sliceIndex) {
    $slicingLink = substr($path, $sliceIndex);
    $mainLink = str_replace('\\', '/', $slicingLink);
    return BASEURL . basename(__DIR__) . $mainLink;
}

// Function to get the initial PDF link from the directory structure
function initalPdfLink(array $directoryStructure) {
    $initalPdfLink = '';
    foreach ($directoryStructure as $key => $singale_directory) {
        foreach ($singale_directory as $menu) {
            $initalPdfLink = $menu['path'];
            break;
        }
        break;
    }
    return convertPath($initalPdfLink, 22);
}

// Handle form submission for PDF path and name, and set the 'currentPage' cookie
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pdfPath']) && isset($_POST['pdfName'])) {
    $cruentPage = convertPath($_POST['pdfPath'], 22);
    setcookie('currentPage', $_POST['pdfName'], time() + 3600, '/');
} else {
    // Set the initial PDF link if no form submission
    $cruentPage = initalPdfLink($directoryStructure);
}
?>
