
<?php require('function.php')?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo constant("BASEURL"); ?> - <?php echo $tutorals ?? ''; ?></title>
    <link rel="stylesheet" href="./assets/styles.css">
  </head>
  <body>
 
   <header>
   <!-- <p><?php echo $bab ?></p>    -->
     <div class="navber">
        <div class="title">
            <h3><?php echo $tutorals ?> - Tutorals</h3>
        </div>
        <div class="form">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="form-content">
                    <div class="select">
                        <select name="tacnolajy" id="">
                            <option default value="php">Select Your Tacnolajy</option>
                            <?php foreach($rootFolder as $data){ ?>
                            <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="submit">
                        <input type="submit" name="submit" id="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
     </div>
   </header>
   <main>
    <div class="main-content">
    <div class="side-nav">
      <?php foreach($directoryStructure as $key=>$singale_directory){?>
        <div class="nav-component">
            <div class="title">
                <h4><?php echo $key?></h4>
            </div>
            <div class="links">
                <ul>
                    <li>
                            <?php foreach($singale_directory as $menu) { ?>
                                <form method="post">
                                    <input type="hidden" name="pdfPath" value="<?php echo htmlspecialchars($menu['path']); ?>">
                                    <input type="hidden" name="pdfName" value="<?php echo htmlspecialchars($menu['name']); ?>">
                                    <button type="submit" class="submit <?php echo ($_GET['pdfpage'] == $menu['name']) ? 'active' : 'not-active'; ?>">
                                        <?php echo htmlspecialchars($menu['name']); ?>
                                    </button>
                                </form>
                            <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
      <?php } ?>
</div>

<div class="pdf-viwer">
        <iframe id="pdf-viwer" class="iframe" src="<?php echo $cruentPage?>" frameborder="0"></iframe>
</div>

    </div>
   </main>
   <footer>
    <div class="footer-content">
        <p>Design & Devloping By <a target="_blank" href="#">md tonmoy islam ruhin</a></p>
    </div>
   </footer> 
  </body>
</html>