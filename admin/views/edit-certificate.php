<form hx-post="crud.php?action=update">
    <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Type of Certificate</label>
        <input class="form-control" type="hidden" name="id" value="<?= $certificate['id'] ?>">
        <input name="type" value="<?= $certificate['type'] ?>" type="text" class="form-control text-capitalize" id="formGroupExampleInput"
            placeholder="Example input placeholder">
    </div>
    <div class="mb-3">
        <label for="formGroupExampleInput2" class="form-label">Event</label>
        <input name="event" value="<?= $certificate['event'] ?>" type="text" class="form-control text-capitalize"
            id="formGroupExampleInput2" placeholder="Another input placeholder">
    </div>
    <button class="btn btn-sm btn-danger mt-2" data-bs-dismiss="modal">Close</button>
</form>