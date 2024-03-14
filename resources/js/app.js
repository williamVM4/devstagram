import Dropzone from "dropzone";
Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube tu imagen aquí",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Eliminar imagen",
    maxFiles: 1,
    uploadMultiple: false,
    init: function(){
        if (document.querySelector('[name="image"]').value.trim()) {
            let file = { name: document.querySelector('[name="image"]').value , size: 12345};
            this.options.addedfile.call(this, file);
            this.options.thumbnail.call(this, file, `/uploads/${file.name}`);
            file.previewElement.classList.add("dz-success");
            file.previewElement.classList.add("dz-complete");
        }
    
    }
});

dropzone.on("success", function (file, response) {
    document.querySelector('[name="image"]').value = response.image;
});

dropzone.on("removedfile", function (file) {
    // let name = file.name;
    // fetch("/uploads", {
    //     method: "DELETE",
    //     headers: {
    //         "Content-Type": "application/json",
    //     },
    //     body: JSON.stringify({ name }),
    // });
    document.querySelector('[name="image"]').value = "";
});
