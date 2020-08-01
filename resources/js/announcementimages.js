$(function(){
    // document ready !! 
    if ($('#drophere').length > 0 ) {
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        let uniqueSecret = $('input[name="uniqueSecret"]').attr('value');
        
        let myDropzone = new Dropzone('#drophere', {
            url: '/announcement/images/upload',  // temp folder where we are sending the parameters
            params: {
                _token: csrfToken,
                uniqueSecret: uniqueSecret 
            },
        
            addRemoveLinks:true,

        
            init: function() {  // init- when you load the page, this is the first thing that happens 
                $.ajax({
                    type: "GET",
                    url: '/announcement/images',
                    data: {
                        uniqueSecret: uniqueSecret
                    },

                    dataType: 'json'

                }).done(function(data){
                    $.each(data, function(key, value){
                        let file = {
                            serverId: value.id // put the id of the image to the id of the server
                        };
                        
                    // When you make a validation error, it saved the images in the dropbox
                        myDropzone.options.addedfile.call(myDropzone, file); // help the sys identify the id of the img
                        myDropzone.options.thumbnail.call(myDropzone, file, value.src); // add a preview of the image for this file
                    });
                });
            }
           
        });

        myDropzone.on("success", function(file, response) // when the upload is successful
        {
            file.serverId = response.id; //matching id of the img and the server, and uploading the img to the cloud
        });

        myDropzone.on("removedfile", function(file) 
        {
            $.ajax({
                type: 'DELETE',
                url: '/announcement/images/remove',
                data: {
                    _token: csrfToken,
                    id: file.serverId,
                    uniqueSecret: uniqueSecret
                },

                dataType: 'json'

            });
        });
    }
})