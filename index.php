<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
    <h2>Recipe Finder</h2>
    <div class="outer-scontainer">
        <div class="row">
            <form class="form-horizontal" action="src/recipeFinder.php" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose items csv
                        File</label>
                    <input type="file" name="file" required
                        id="file" accept=".csv">
                </div>
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose recipes Json
                        File</label> 
                    <input type="file" name="jsonFile" required
                        id="file" accept=".json">
                </div>
                <div>
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>