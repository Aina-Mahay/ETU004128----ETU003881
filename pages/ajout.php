<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un objet</title>
</head>
<body>
  <h2>Ajouter un objet</h2>
  <form action="traitement-upload.php" method="post" enctype="multipart/form-data">
    <label>Nom de l'objet :</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Catégorie ID :</label><br>
    <input type="number" name="categorie" required><br><br>
    <input type="hidden" name="membre" value="<?=$_SESSION['user_id']?>">

    <label>Images de l'objet :</label><br>
    <input type="file" name="images[]" multiple accept="image/*"><br><br>

    <button type="submit" name="submit">Ajouter</button>
  </form>
</body>
</html>
