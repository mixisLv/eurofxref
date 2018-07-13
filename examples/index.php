<!doctype html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>Euro foreign exchange reference rates</title>
    <script type="text/javascript">
        <!--
        function toggleVisibility(id) {
            var e = document.getElementById(id);
            if (e.style.display == 'block')
                e.style.display = 'none';
            else
                e.style.display = 'block';
        }
        //-->
    </script>
</head>
<body>

<h1>Examples</h1>
<h3>
    Get rates
    <a href="#" onclick="toggleVisibility('get');">source</a> |
    <a href="get.php" target="_blank">demo</a>
</h3>

<div id="get" style="display: none;">
    <?php $file = file_get_contents('get.php');
    highlight_string($file); ?>
</div>

</body>
</html>
