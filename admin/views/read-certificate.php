<?php
foreach ($certificates as $certificate) : ?>
    <tr>
        <td class="text-center text-capitalize"><?= htmlspecialchars($certificate['type']) ?></td>
        <td class="text-center text-capitalize"><?= htmlspecialchars($certificate['event']) ?></td>
        <td class="text-center"><!-- e-click para sa lumabas ang modal -->
            <button type="button" hx-get="crud.php?action=edit&id=<?= $certificate['id'] ?>" hx-target="#modalBody"
                hx-trigger="click" hx-swap="innerHTML" data-bs-toggle="modal" data-bs-target="#showEachCard"
                class="btn btn-sm btn-success">
                Edit
            </button>
            <button class="btn btn-sm btn-danger" hx-get="crud.php?action=delete&id=<?= $certificate['id'] ?>&inline=1">
                Delete
            </button>
        </td>
    </tr>
<?php endforeach;