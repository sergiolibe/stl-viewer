<?php
include __DIR__ . '/../inspect_files.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Viewstl Javascript Plugin - Simple Example</title>
</head>

<body>

<label for="filename">STL file:</label>
<select name="filename" id="filename" onchange="stl_viewer.clean();stl_viewer.add_model({filename:this.value})">
    <?php foreach ($filenames as ['filepath' => $filepath, 'shortname' => $shortname]) { ?>
        <option value="<?php echo $filepath; ?>"><?php echo $shortname; ?></option>
    <?php } ?>
</select>

<div id="stl_cont" style="width:500px;height:500px;margin:0 auto;"></div>

<script src="js/stl_viewer.min.js"></script>
<script>

    let filename_node = document.getElementById("filename");

    let stl_viewer = new StlViewer
    (
        document.getElementById("stl_cont"),
        {
            models:
                [
                    {filename: filename_node.value},
                ]
        }
    );
</script>

</body>
</html>