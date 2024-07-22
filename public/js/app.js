Dropzone.autoDiscover = false;

var myDropzone = new Dropzone("#ticket-dropzone", {
    url: "/file-upload",
    autoProcessQueue: true, // Automatically upload files after dropping
    parallelUploads: 1,
    maxFiles: 5,
    acceptedFiles: "image/png,image/jpeg,application/pdf",
    maxFilesize: 5, // MB
    addRemoveLinks: true,

    init: function () {
        var myDropzone = this;

        myDropzone.on("sending", function (file, xhr, formData) {
            // Add form data here
            formData.append("_token", document.querySelector('input[name="_token"]').value);
        });

        myDropzone.on("success", function (file, response) {
            // Save the response (file path) to the hidden input field
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ticket_path';
            input.value = response.filePath;
            document.querySelector("#customer-form").appendChild(input);
        });

        myDropzone.on("removedfile", function (file) {
            // Handle file removal
            if (myDropzone.getQueuedFiles().length === 0) {
                document.querySelector("#submit-all").disabled = true;
            }
        });

        myDropzone.on("addedfile", function () {
            document.querySelector("#submit-all").disabled = false;
        });
    }
});

document.querySelector("#customer-form").addEventListener("submit", function (e) {
    e.preventDefault();
    e.stopPropagation();

    if (myDropzone.getQueuedFiles().length === 0) {
        this.submit();
    } else {
        alert("Please wait for the file to finish uploading.");
    }
});
