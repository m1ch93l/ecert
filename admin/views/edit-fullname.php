<form hx-post="crud.php?action=updateFullname">
    <div class="mb-3">
        <input class="form-control" type="hidden" name="id" value="<?= $participant['id'] ?>">
        <input name="fullname" value="<?= $participant['fullname'] ?>" type="text" class="form-control text-capitalize"
            id="formGroupExampleInput" placeholder="Example input placeholder">
    </div>
    <button class="btn btn-sm btn-danger mt-2" data-bs-dismiss="modal">Close</button>
</form>