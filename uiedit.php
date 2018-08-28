<!-- 
Welcome to UI Editor
Author - Shouvik Mitra (https://iamshouvikmitra.github.io)
Version - v1.0 
-->

<!-- Starting Logic -->
<?php
session_start();

// Opening File
    // Our editor should be able to open a particular file if the filename is passed as a GET Request.
    // For Example - localhost/uiedit.php?filename=index.html will open index.html within the editor
    if(isset($_GET['filename']) and !empty($_GET['filename'])){   
        $filename = $_GET['filename'];
    }
    else{
        $filename = ""; // if no filename is passed then ui editor will open with no file selected
    }

// Saving File
    $saveMessage = "A project by Shouvik Mitra"; // variable to store message after user has tried to save a file from editor
    
    // text_id - contains file content, text_filename - contains filename with which opened file should be saved
    // By default text_filename contains the name of the file opened, but you may wish to change the name of the 
    // file to be saved.
    if(isset($_POST['text_id']) and !empty($_POST['text_id']) and isset($_POST['text_filename']) and !empty($_POST['text_filename'])){
        $saveTo = $_POST['text_filename'];
        $handle = fopen($saveTo, "w") or die("Unable to open file!");
        $text  = $_POST['text_id'];
        if(fwrite($handle, $text) == FALSE){
        $saveMessage = '<span class="redtxt">There was an error</span>';
        }else{
        $t=time();
        $saveMessage = '<span class="redtxt">File edited successfully at '.gmdate('h:i:s \G\M\T').'</span>';
        }
        fclose($handle);
        $filename = $saveTo;
    }

?>

<!-- Starting View -->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Suppress browser request for favicon.ico -->
    <link rel="shortcut icon"type="image/x-icon" href="data:image/x-icon;,">
    <!-- Load Favicon and Cache it -->
    <script>
        var favIcon = "\
        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";
        var docHead = document.getElementsByTagName('head')[0];       
        var newLink = document.createElement('link');
        newLink.rel = 'shortcut icon';
        newLink.href = 'data:image/png;base64,'+favIcon;
        docHead.appendChild(newLink);
    </script>


    <!-- Ck Editor -->
    <script src="./ckeditor/ckeditor.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/4.10.0/full/ckeditor.js"></script> -->

    <title>UI Editor by Shouvik Mitra</title>
</head>

<body>
    <div>
        <center><h3>Welcome to UI Editor</h3><?php echo $saveMessage; ?></center>
        <span>
            <form action="uiedit.php" name="filenameForm">
            You are editing 
            <select name="filename" onchange="filenameForm.submit();">
                <option value=""></option>
                <?php
                $dir = "./"; 
                // Open a directory, and read its contents
                if (is_dir($dir)){
                if ($dh = opendir($dir)){
                    while (($file = readdir($dh)) !== false){
                        if($ext = pathinfo($file, PATHINFO_EXTENSION) === 'html'){ ?>
                            <option value="<?php echo "./" . $file; ?>" 
                            <?php $selectedFile = "./".$file; 
                            if($selectedFile == $filename){ ?> selected
                            <?php } ?>
                            >
                                <?php echo "./" . $file; ?>
                            </option>
                        <?php
                        }
                    }
                    closedir($dh);
                }
                }
                ?>
            </select>
            </form>
        </span>
        <!-- Editor -->
        <form action="uiedit.php" method="POST">
            <div class="content-area">
                <textarea name="text_id" id="editor1" value="<?php echo $filename ?>"  contenteditable="true">
                <?php
                    if(!empty($filename)){
                        // include $filename;
                        $data = file_get_contents($filename);
                        echo  htmlspecialchars($data);
                    }
                    else{
                        if(!isset($filename)){
                            echo "No file selected";
                        }
                    }
                    
                ?>
                </textarea>
                <center>
                Saving File as <input type="text" value="<?php echo $filename ?>" name="text_filename">
                </center>
            </div>
        </form>
    </div>
    <!-- JavaScript -->
    <script>
        CKEDITOR.replace( 'editor1', {
            fullPage: true,
            extraPlugins: 'docprops',
            allowedContent: true,
            width: '100%',
			height: 400,          
        }); 
        config.fullPage = true;
        CKEDITOR.config.allowedContent = true;     
        CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
        CKEDITOR.config.autoParagraph = false;

        CKEDITOR.config.fillEmptyBlocks = false;
        CKEDITOR.config.forcePasteAsPlainText = true;
    </script>  
</body>

</html>