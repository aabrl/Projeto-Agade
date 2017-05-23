var data = new FormData();

jQuery.each(self.new_form.find('#photo_image')[0].files, function(i, file) {

data.append('image', file);

});

$.ajax({

type: "POST",

url: 'cadastrar.php',

data: data,

contentType: false,

processData: false,

success: function(data) {

},

error: function() {

}

});