<?php




// echo "<script>alert();</script>";





define('BASEURL','My Docx');

$result1 = scandir( __DIR__ . '/documentation');

$rootFolder = array_filter($result1,
    function ($data){
        return $data != '.' && $data != '..';
    }
);

function redirect(string $page){
    $status_code = ['code'=>301];
    $queryString = http_build_query($status_code);
    header("location:$page?$queryString");
    exit();
}


$tutorals = 'php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && !empty($_POST['tacnolajy'])){

    $tutorals = $_POST['tacnolajy'];
}


$folderPath = __DIR__ . '/documentation/' . $tutorals;
   
function scanDirectory($folderPath) {
    try{

        if(is_dir($folderPath)){
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
        }else{
            redirect('./errorpage.php');
        }

    }catch(Exception $error){
        redirect('./errorpage.php'); 
    }   
}

 
$directoryStructure = scanDirectory($folderPath);
// echo '<pre>';
// var_dump($directoryStructure);
// echo '</pre>';
// die();
function convertPath(string $path,int $sliceIndex) {
    $slicingLink = substr($path,$sliceIndex);
    $mainLink = str_replace('\\', '/', $slicingLink);
    return '.'.$mainLink;
}

function initalPdfLink(array $directoryStructure){
    $initalPdfLink = '';
    foreach($directoryStructure as $key=>$singale_directory){
        foreach($singale_directory as $menu){
            $initalPdfLink = $menu['path'];
            break;
        }
        break;
    }
   
   return convertPath($initalPdfLink,20); 
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pdfPath']) && isset($_POST['pdfName'])) {
    $cruentPage = convertPath($_POST['pdfPath'],20);
    //setcookie('currentPage', $_POST['pdfName'], time() + 3600, '/');
    header("Location: ".$_SERVER['PHP_SELF'].'?pdfpage='.$_POST['pdfName']);
    exit();
}else{
    $cruentPage = initalPdfLink($directoryStructure);
}











