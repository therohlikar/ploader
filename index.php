<?php
    $loadedFiles = glob('files/*')
?>


<html>
    <head>
        <title>Ploader</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/67f8f2b923.js" crossorigin="anonymous" type="text/javascript"></script>
    </head>

    <body>
    
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#"><i class="fas fa-cloud"></i> Ploader</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#uploadfile">Upload new file</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php 
            
        ?>
        
        <div class="modal fade" id="uploadfile" tabindex="-1" role="dialog" aria-labelledby="uploadfileLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadfileLabel">Upload new file</h5>
                    <button type="button" id='uploadfileclosebtn' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="fileToUpload" id="fileToUpload">
                            <label class="custom-file-label" id="fileToUploadLabel" for="fileToUpload">Choose file</label>
                        </div>
                        
                    </div>
                    <div class="card" id="fileToUpload_props" style="display:none;">
                        <div class="card-header">
                            File properties
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p id="fileToUpload_name">~</p>
                                <p id="fileToUpload_size">~</p>
                            </blockquote>
                        </div>
                    </div>
                    <script>    
                        var fileToUpload = null;
                        $("#fileToUpload").change(function(e){
                            fileToUpload = e.target.files[0];
                            $('#fileToUploadLabel').text(e.target.files[0].name);
                            $('#fileToUpload_props').show();
                            $('#fileToUpload_name').html("<strong>Name:</strong> " + e.target.files[0].name);
                            $('#fileToUpload_size').html("<strong>Size:</strong> " + e.target.files[0].size + " bytes");
                        }); 

                        function uploadfile(){
                            var fd = new FormData();
                            fd.append('file', fileToUpload)
                            if(fileToUpload != null){
                                $.ajax({
                                    url: "upload.php",
                                    type: "post",
                                    dataType: "json",
                                    data: fd,
                                    contentType: false,
                                    processData: false,
                                    success:function(result){
                                        if(result.msg == "error"){
                                            alert("There was an error while uploading file.");
                                        }else if(result.msg == "exists"){
                                            alert("File you wanted to upload already exists.");
                                        }else{
                                            alert("File has been uploaded");
                                            location.reload();
                                        }
                                    }
                                });
                            }else alert("Select your file first. :)");
                        }
                    </script>

                    
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <button type="button" onclick="uploadfile()" class="btn btn-primary btn-dark" name="btn_upload" id="btn_upload">Upload</button>
                    </form>
                </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">File name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($loadedFiles as $filePath){
                        $filePath = str_replace("files/", "", $filePath);
                        echo "<tr><td>".$filePath."</td><td>
                                <a href='download.php?path=".$filePath."'>
                                    <input type='button' value='Download' class='btn btn-dark'>
                                </a>
                                <a href='delete.php?file=".$filePath."'>
                                    <input type='button' value='Remove' class='btn btn-dark'>
                                </a>
                                </td>";
                    }
                ?>
                
            </tbody>
        </table>
    </body>

    <footer>
    </footer>
</html>