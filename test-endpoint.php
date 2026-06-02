<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Test Page</title>
</head>
<body>
<h1>TEST ENDPOINT IS WORKING</h1>
<p>Konsultacija: <?php echo isset($_GET['konsultacija']) ? $_GET['konsultacija'] : 'NONE'; ?></p>
</body>
</html>
