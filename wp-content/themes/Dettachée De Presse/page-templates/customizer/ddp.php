<main class="dashboard">
  <h1 class="dashboard__h1">Dettachée de Presse is powerful</h1>

  <article class="dashboard__header">
    <h3 class="dashboard__h3">Header du site</h3>
    <form class="dashboard__logo" method="POST">
        <label for="logo_url">Logo DDP</label>
        <input type="text" name="logo_url" id="logo_url" class="dashboard__logo--input" placeholder="<?php echo $logo_url; ?>">
        <input id="upload-button" type="button" class="upload-button button dashboard__logo--uploader" value="Chercher une image" />
        <input type="submit" value="Enregistrer" class="dashboard__logo--submit button button-primary button-large">
        <img src="<?php echo $logo_url; ?>" alt="" class="dashboard__logo--img"/>
    </form>

    <form class="dashboard__logo" method="POST">
        <label for="logo_url_store">Logo du Store</label>
        <input type="text" name="logo_url_store" id="logo_url_store" class="dashboard__logo--input" placeholder="<?php echo $logo_url_store; ?>">
        <input id="upload-button" type="button" class="upload-button button dashboard__logo--uploader" value="Chercher une image" />
        <input type="submit" value="Enregistrer" class="dashboard__logo--submit button button-primary button-large">
        <img src="<?php echo $logo_url_store; ?>" alt="" class="dashboard__logo--img"/>
    </form>
  </article>
</main>
