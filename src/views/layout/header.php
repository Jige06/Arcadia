<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arcadia - Le zoo éco-responsable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Barre visible uniquement sur mobile, avec le bouton menu (masquée à partir de la taille "md") -->
    <div class="d-md-none bg-success text-white p-2 d-flex justify-content-between align-items-center">
        <a href="/" class="text-white text-decoration-none fs-5 fw-bold">Arcadia</a>
        <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
            <i class="bi bi-list"></i> Menu
        </button>
    </div>

    <div class="d-flex">

        <!--
        offcanvas-md : sur mobile (< md), agit comme un panneau caché qui glisse au clic sur "Menu".
        À partir de la taille "md" (tablette/desktop), redevient un simple bloc toujours visible.
    -->
        <nav class="offcanvas-md offcanvas-start bg-success text-white"
            tabindex="-1" id="sidebarMenu" style="width: 260px;">
            <div class="d-flex justify-content-between align-items-center p-3">
                <a href="/" class="text-white text-decoration-none fs-3 fw-bold">ARCADIA</a>
                <button type="button" class="btn-close btn-close-white d-md-none"
                    data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
            </div>
            <div class="d-md-flex flex-column px-3">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="/" class="nav-link text-white">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="/habitats" class="nav-link text-white">Habitats</a>
                    </li>
                    <li class="nav-item">
                        <a href="/services" class="nav-link text-white">Services</a>
                    </li>
                    <li class="nav-item">
                        <a href="/connexion" class="nav-link text-white">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a href="/contact" class="nav-link text-white">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contenu principal, prend tout l'espace restant -->
        <main class="flex-grow-1 p-4">