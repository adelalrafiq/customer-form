<!DOCTYPE html>
<html>
<head>
    <title>Klantenformulier</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
       .navbar-custom {
            background-color: #72acd8; 
            color: #fff;
            margin-bottom: 20px;  
        }

        .btn-custom {
            background-color: #72acd8;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #5b8eb0;
        }
        .dropzone {
            border: 2px dashed #72acd8;
            padding: 20px;
            border-radius: 10px;
            background: #f9f9f9;
            margin-top: 20px;
            position: relative;
        }
        .dropzone.dragover {
            border-color: #0056b3;
            background: #e9e9e9;
        }
        .dropzone .dz-message {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        .dropzone .dz-message i {
            font-size: 3rem;
            color: #72acd8;
        }
        .dropzone .dz-message span {
            margin-top: 10px;
            font-size: 1.2rem;
            color: #72acd8;
        }
        .required {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <h2>Klantenformulier</h2>
           
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">                       
                        <i class="fas fa-user"></i>
                    </li>
                </ul>
           
        </div>
    </nav>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="/form" method="POST" enctype="multipart/form-data" id="customer-form">
        @csrf
        <div class="form-group">
            <label for="name">Naam<span class="required">*</span></label></label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email<span class="required">*</span></label></label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="ticket">Ticket<span class="required">*</span></label></label>
            <div class="dropzone" id="ticket-dropzone">
            <div class="dz-message">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Sleep bestanden hierheen of klik om te uploaden.</span>
                </div>
            </div>
        </div>
        <button type="submit"  class="btn btn-custom" id="submit-all">Verzenden</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
<script>
    Dropzone.autoDiscover = false;

    var myDropzone = new Dropzone("#ticket-dropzone", {
        url: "/file-upload",
        autoProcessQueue: true, // Automatically upload files after dropping
        parallelUploads: 1,
        maxFiles: 1,
        acceptedFiles: "image/png,image/jpeg,application/pdf",
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        init: function() {
            var myDropzone = this;

            myDropzone.on("sending", function(file, xhr, formData) {
                // Add form data here
                formData.append("_token", document.querySelector('input[name="_token"]').value);
            });

            myDropzone.on("success", function(file, response) {
                // Save the response (file path) to the hidden input field
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ticket_path';
                input.value = response.filePath;
                document.querySelector("#customer-form").appendChild(input);
            });

            myDropzone.on("removedfile", function(file) {
                // Handle file removal
                if (myDropzone.getQueuedFiles().length === 0) {
                    document.querySelector("#submit-all").disabled = true;
                }
            });

            myDropzone.on("addedfile", function() {
                document.querySelector("#submit-all").disabled = false;
            });
        }
    });

    document.querySelector("#customer-form").addEventListener("submit", function(e) {
        e.preventDefault();
        e.stopPropagation();

        if (myDropzone.getQueuedFiles().length === 0) {
            this.submit();
        } else {
            alert("Please wait for the file to finish uploading.");
        }
    });
</script>
</body>
</html>