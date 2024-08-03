<?php require('function.php')?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php echo htmlspecialchars(constant("APPNAME")); ?> - <?php echo htmlspecialchars($tutorals ?? ''); ?></title>
      <link rel="stylesheet" href="./assets/styles.css">
   </head>
   <body>
      <header>
         <div class="navber">
            <div class="title">
               <h3><?php echo htmlspecialchars($tutorals) ?> - Tutorals</h3>
            </div>
            <div class="form">
                <!-- Form for selecting technology -->
               <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                  <div class="form-content">
                     <div class="select">
                        <select name="tacnolajy" id="">
                           <option default value="php">Select Your Tacnolajy</option>
                           <?php foreach($rootFolder as $data){ ?>
                           <option value="<?php echo htmlspecialchars($data); ?>"><?php echo htmlspecialchars($data); ?></option>
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
                <!-- Sidebar navigation with directories and files -->
               <?php foreach($directoryStructure as $key=>$singale_directory){?>
               <div class="nav-component">
                  <div class="title">
                     <h4><?php echo htmlspecialchars($key)?></h4>
                  </div>
                  <div class="links">
                     <ul>
                        <li>
                           <?php foreach($singale_directory as $menu) { ?>
                           <form method="post">
                              <!-- Hidden inputs to send PDF path and name on form submission -->
                              <input type="hidden" name="pdfPath" value="<?php echo htmlspecialchars($menu['path']); ?>">
                              <input type="hidden" name="pdfName" value="<?php echo htmlspecialchars($menu['name']); ?>">
                              <button type="submit" class="submit menus">
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
                 <!-- PDF viewer iframe -->
               <iframe id="pdf-viwer" class="iframe" src="<?php echo htmlspecialchars($cruentPage) ?>" frameborder="0"></iframe>
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