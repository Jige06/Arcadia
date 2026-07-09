<h1>Nos habitats</h1>
<p class="text-muted">Cliquez sur un habitat pour découvrir les animaux qui y vivent.</p>

<div class="row g-4 mt-2">
    <?php foreach ($habitats as $habitat): ?>
        <div class="col-md-4">
            <div class="card habitat-card h-100" style="cursor: pointer;" data-habitat-id="<?= $habitat->getHabitatId() ?>">
                <?php if (!empty($habitat->getImages())): ?>
                    <img src="<?= htmlspecialchars($habitat->getImages()[0]) ?>" class="card-img-top" alt="<?= htmlspecialchars($habitat->getNom()) ?>">
                <?php endif; ?>
                <div class="card-body">
                    <h2 class="h5 card-title"><?= htmlspecialchars($habitat->getNom()) ?></h2>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Modale Bootstrap, remplie dynamiquement en JS au clic sur un habitat -->
<div class="modal fade" id="habitatModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="habitatModalTitre"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="habitatModalDescription"></p>
                <h6>Animaux présents :</h6>
                <ul id="habitatModalAnimaux" class="list-group"></ul>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/habitats.js"></script>