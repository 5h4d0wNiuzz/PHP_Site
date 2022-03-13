<html>
    <head>
        <title>Reading_form_file</title>
    </head>
    <body>
        <link rel="stylesheet" type="text/css" href="style.css">
        <?php
            # Task 1
            # Gets file name from index.php
            $file_name = $_POST["file_name"];
            # Gets file name extencion
            $part = pathinfo($file_name);
            # Cheks if extencion is csv
            if($part['extension'] == "csv"){
                # Opens selected file ir read only
                $file = fopen($file_name, "r");
                # Displays it's content
                while(list($first_name,$age,$gender) = fgetcsv($file,1024,',')){
                    printf("<p>%s , %s , %s</p>",$first_name,$age,$gender);
                }
                # Closes file
                fclose($file);
            }
            #Cheks if extencion is json
            elseif ($part['extension'] == "json"){
                # Gets file content
                $file = file_get_contents($file_name);
                # Decodes file
                $decode = json_decode($file, true);
                # Displays it's content
                foreach($decode as $key => $value){
                    echo "<br>";
                    foreach($value as $v){
                        echo $v. " ";
                    }
                }
            }
            #Cheks if extencion is xml
            elseif ($part['extension'] == "xml"){
                # Lodes file
                $file = simplexml_load_file($file_name) or die("Failed to load");
                # # Displays it's content
                foreach($file->children() as $per){
                    echo $per->first_name . ", ";
                    echo $per->age . ", ";
                    echo $per->gender . "<br>";
                }
            }
            # Cheks if File name doesn't contais extension
            elseif($part['extension'] == null){
                echo "Check file name";
            }
            # Cheks if file can be found
            else{
                echo "File not found";
            }
        ?>
    </body>
</html>