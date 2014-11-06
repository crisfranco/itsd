<option value selected disabled style="display: none;">Equipamentos</option>
<?php foreach ($equipamentos_por_setor as $equip) : ?>

    <option value="{{ $equip->id }}">{{ $equip->cn; }}</option>

<?php endforeach;