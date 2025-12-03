<div class="accordion-item mt-4 py-3">
    <h2 class="accordion-header" id="heading<?= $num ?>">
        <button class="accordion-button collapsed" type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#section<?= $num ?>" 
                aria-expanded="false" 
                aria-controls="section<?= $num ?>">
            Section <?= $num ?>
        </button>
    </h2>
    <div id="section<?= $num ?>" class="accordion-collapse collapse" 
         aria-labelledby="heading<?= $num ?>" 
         data-bs-parent="#myAccordion">
        <div class="accordion-body">
            Content for section <?= $num ?>
        </div>
    </div>
</div>
