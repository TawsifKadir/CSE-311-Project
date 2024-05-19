function showSuccessModal(message, callback) {
    // Set the modal body text
    $('#successModalBody').text(message);

    // Show the modal
    $('#successModal').modal('show');

    // Optionally, set a timeout to hide the modal and reload the page
    $('#successModal').on('hidden.bs.modal', function () {
        if (typeof callback === 'function') {
            callback();
        }
    });
}