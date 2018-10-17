<div>
    <label>Naam van het spel</label>
    <input type="text" class="form-control" placeholder="Naam van het spel..." name="name" required value="<?= $name ?? null ?>">
    <br/>
    <label>Beschrijving van het spel</label>
    <textarea class='form-control' rows='3' name="description" placeholder="Korte beschrijving van het spel.." required><?= $description ?? null ?></textarea>
</div>