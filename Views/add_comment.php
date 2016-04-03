<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

<a class="btn btn-info btn-xs" href="../">Back</a>

<div class="well" style="width: 750px; margin: 0 auto; margin-top: 20px;">
    <form class="form-horizontal" method="POST">
        <div class="form-group ">
            <div class="col-sm-offset-4 col-sm-8">
                <strong>Add a comment</strong>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="content">Content:</label>
            <input type="text" size="255" class="form-control" id="content" name="content"
                   placeholder="Your thoughts...">
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button class="btn btn-info btn-xs" type="submit" name="post">Add</button>
            </div>
        </div>
    </form>
</div>

<h1>If you can see this - good job! You made my server cry...</h1>
</body>
</html>