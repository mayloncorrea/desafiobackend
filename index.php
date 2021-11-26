<!DOCTYPE html>
<html>
    <head>
        <title>Insira um arquivo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <form action="processfile.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Insira um arquivo</label>
                        <input class="form-control" id="formFile" name="file_to_precess" type="file" required>
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>

    </div>
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>