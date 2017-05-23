/*
 * Default text - jQuery plugin for html5 dragging files from desktop to browser
 *
 * Author: Weixi Yen
 *
 * Email: [Firstname][Lastname]@gmail.com
 * 
 * Copyright (c) 2010 Resopollution
 * 
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   http://www.github.com/weixiyen/jquery-filedrop
 *
 * Version:  0.1.0
 *
 * Features:
 *      Allows sending of extra parameters with file.
 *      Works with Firefox 3.6+
 *      Future-compliant with HTML5 spec (will work with Webkit browsers and IE9)
 * Usage:
 *     See README at project homepage
 *
 */

var uploaderEnabled = (!!window.FileReader || typeof window.FileReader !=='undefined') && Modernizr.draganddrop;
if(uploaderEnabled) {
  
    var template = '<div class="preview"><span class="imageHolder"><img /><span class="uploaded"></span></span><div class="progressHolder"><div class="progress"></div></div></div>', dropbox, message, maxFilesCount;
  
    (function($) {
    
        $.event.props.push("dataTransfer");
        var referer = window.location.pathname.replace(/[^a-zA-Z]+/g,'');
        var opts = {}, default_opts = {
            url: baseUrl + '/submissions/upload/referer/'+referer,
            refresh: 1000,
            paramname: 'file',
            maxfiles: 4,
            maxfilesize: 8, // MBs
            data: {},
            drop: function(e) {
                $(e.target).removeClass('filedrop-dragover');
            },
            dragEnter: function(e) {
                $(e.target).removeClass('filedrop-dragover');
            },
            dragOver: function(e) {
                $(e.target).addClass('filedrop-dragover');
            },
            dragLeave: function(e) {
                $(e.target).removeClass('filedrop-dragover');
            },
            docEnter: empty,
            docOver: empty,
            docLeave: empty,
            beforeEach: empty,
            afterAll: empty,
            rename: empty,
            error: function(err, file) {
                switch (err) {
                    case 'BrowserNotSupported':
                        showMessage('Your browser does not support HTML5 file uploads!');
                        break;
                    case 'TooManyFiles':
                        alert('Too many files! Please select '+maxFilesCount+' at most!');
                        break;
                    case 'FileTooLarge':
                        alert(file.name + ' is too large! Please upload files up to 8mb.');
                        break;
                    default:
                        break;
                }
            },
            uploadStarted: function(i, file, len) {
                createImage(file);
            },
            uploadFinished: function(i, file, response) {
                    
                // check if error
                if (typeof response.error !== "undefined") {
                    alert(response.error);
                    $.data(file).remove();
                    return false;
                }
            
                if (typeof response.file_id !== "undefined") {
                    $.data(file).addClass('done');
                    $.data(file).attr('file_id', response.file_id);
                }
            // response is a JSON object
            },
            progressUpdated: function(i, file, progress) {
                $.data(file).find('.progress').width(progress);
            },
            speedUpdated: empty
        },
        errors = ["BrowserNotSupported", "TooManyFiles", "FileTooLarge"],
        doc_leave_timer, stop_loop = false,
        files_count = 0,
        files;
      
        $.fn.filedrop = function(options) {
            opts = $.extend({}, default_opts, options);
            this.bind('drop', drop).bind('dragenter', dragEnter).bind('dragover', dragOver).bind('dragleave', dragLeave);
            $(document).bind('drop', docDrop).bind('dragenter', docEnter).bind('dragover', docOver).bind('dragleave', docLeave);
        };

        function drop(e) {
           
            opts.drop(e);
            files = e.dataTransfer.files;
            if (files === null || files === undefined) {
                opts.error(errors[0]);
                return false;
            }
            files_count = files.length;
            // check maximun 4 photos
            if ($(".preview, .done", "#dropbox").length + files_count > opts.maxfiles) {
                alert('You have already uploaded the maximum number of photos!');
                $(e.target).removeClass('filedrop-dragover');
                return false;
            }
            
            upload();
            e.preventDefault();
            return false;
        }

        function getBuilder(filename, filedata, boundary) {
            var dashdash = '--',
            nl = "\r\n",
            builder = '';
            $.each(opts.data, function(i, val) {
                if (typeof val === 'function') val = val();
                builder += dashdash + boundary + nl;
                builder += 'Content-Disposition: form-data; name="' + i + '"';
                builder += nl + nl + val + nl;
            });
            builder += dashdash + boundary + nl;
            builder += 'Content-Disposition: form-data; name="' + opts.paramname + '"';
            builder += '; filename="' + filename + '"';
            builder += nl + 'Content-Type: application/octet-stream';
            builder += nl + nl + filedata + nl + dashdash + boundary + dashdash + nl;
            return builder;
        }

        function progress(e) {
            if (e.lengthComputable) {
                var percentage = Math.round((e.loaded * 100) / e.total);
                if (this.currentProgress != percentage) {
                    this.currentProgress = percentage;
                    opts.progressUpdated(this.index, this.file, this.currentProgress);
                    var elapsed = new Date().getTime();
                    var diffTime = elapsed - this.currentStart;
                    if (diffTime >= opts.refresh) {
                        var diffData = e.loaded - this.startData;
                        var speed = diffData / diffTime; // KB per second
                        opts.speedUpdated(this.index, this.file, speed);
                        this.startData = e.loaded;
                        this.currentStart = elapsed;
                    }
                }
            }
        }

        function upload() {
            stop_loop = false;
            if (!files) {
                opts.error(errors[0]);
                return false;
            }
            var filesDone = 0,
            filesRejected = 0;
            if (files_count > opts.maxfiles) {
                opts.error(errors[1]);
                return false;
            }
            for (var i = 0; i < files_count; i++) {
                if (stop_loop) return false;
                try {
                    if (beforeEach(files[i]) != false) {
                        if (i === files_count) return;
                        var reader = new FileReader(),
                        max_file_size = 1048576 * opts.maxfilesize;
                        reader.index = i;
                        if (files[i].size > max_file_size) {
                            opts.error(errors[2], files[i], i);
                            filesRejected++;
                            continue;
                        }
                        reader.onloadend = send;
                        reader.readAsBinaryString(files[i]);
                    } else {
                        filesRejected++;
                    }
                } catch (err) {
                    opts.error(errors[0]);
                    return false;
                }
            }

            function send(e) {
                // Sometimes the index is not attached to the
                // event object. Find it by size. Hack for sure.
                if (e.target.index == undefined) {
                    e.target.index = getIndexBySize(e.total);
                }
                var xhr = new XMLHttpRequest(),
                upload = xhr.upload,
                file = files[e.target.index],
                index = e.target.index,
                start_time = new Date().getTime(),
                boundary = '------multipartformboundary' + (new Date).getTime(),
                builder;
                newName = rename(file.name);
                if (typeof newName === "string") {
                    builder = getBuilder(newName, e.target.result, boundary);
                } else {
                    builder = getBuilder(file.name, e.target.result, boundary);
                }
                upload.index = index;
                upload.file = file;
                upload.downloadStartTime = start_time;
                upload.currentStart = start_time;
                upload.currentProgress = 0;
                upload.startData = 0;
                upload.addEventListener("progress", progress, false);
                xhr.open("POST", opts.url, true);
                xhr.setRequestHeader('content-type', 'multipart/form-data; boundary=' + boundary);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.sendAsBinary(builder);
                opts.uploadStarted(index, file, files_count);
        
                xhr.onload = function() {
                    if (xhr.responseText) {
                        var now = new Date().getTime(),
                        timeDiff = now - start_time,
                        result = opts.uploadFinished(index, file, jQuery.parseJSON(xhr.responseText), timeDiff);
                        filesDone++;
                        if (filesDone == files_count - filesRejected) {
                            afterAll();
                        }
                        if (result === false) stop_loop = true;
                    }
                };
            }
        }

        function getIndexBySize(size) {
            for (var i = 0; i < files_count; i++) {
                if (files[i].size == size) {
                    return i;
                }
            }
            return undefined;
        }

        /* This shouldn't be needed because the function is part of the opts object, right??? */
        /*function uploadFinished(i, file, response, time) {
            return opts.uploadFinished(i, file, response, time);
        }*/
        
        function rename(name) {
            return opts.rename(name);
        }

        function beforeEach(file) {
            return opts.beforeEach(file);
        }

        function afterAll() {
            return opts.afterAll();
        }

        function dragEnter(e, file) {
            clearTimeout(doc_leave_timer);
            e.preventDefault();
            opts.dragEnter(e);
            $(e.target).attr('style', '');
        }

        function dragOver(e) {
            clearTimeout(doc_leave_timer);
            e.preventDefault();
            opts.docOver(e);
            opts.dragOver(e);
        }
         

        function dragLeave(e) {
            clearTimeout(doc_leave_timer);
            opts.dragLeave(e);
            e.stopPropagation();
        }

        function docDrop(e) {
            e.preventDefault();
            opts.docLeave(e);
            return false;
        }

        function docEnter(e) {
            clearTimeout(doc_leave_timer);
            e.preventDefault();
            opts.docEnter(e);
            return false;
        }

        function docOver(e) {
            clearTimeout(doc_leave_timer);
            e.preventDefault();
            opts.docOver(e);
            return false;
        }

        function docLeave(e) {
            doc_leave_timer = setTimeout(function() {
                opts.docLeave(e);
            }, 200);
        }
    
        function createImage(file) {
          
            // check if we should create the image
      
      
            var preview = $(template),
            image = $('img', preview);
            var reader = new FileReader();
            image.width = 100;
            image.height = 100;
            reader.onload = function(e) {
                // e.target.result holds the DataURL which
                // can be used as a source of the image:
                image.attr('src', e.target.result);
            };
            // Reading the file as a DataURL. When finished,
            // this will trigger the onload function above:
            reader.readAsDataURL(file);
            message.hide();
            preview.appendTo(dropbox);
            // Associating a preview container
            // with the file, using jQuery's $.data():
            $.data(file, preview);
        }
    
        function showMessage(msg) {
            message.html(msg);
        }
      
        function empty() {}
        try {
            if (XMLHttpRequest.prototype.sendAsBinary) return;
            XMLHttpRequest.prototype.sendAsBinary = function(datastr) {
                function byteValue(x) {
                    return x.charCodeAt(0) & 0xff;
                }
                var ords = Array.prototype.map.call(datastr, byteValue);
                var ui8a = new Uint8Array(ords);
                this.send(ui8a.buffer);
            }
        } catch (e) {}
    })(jQuery);
  
}

$(function() {
     
    if ($('.jquery-filedrop').length) { /* Vuly custom additions to override file upload if they have FileReader */
    
        /* Replace input type="file" with filedrop */
        var fileupload = $('.jquery-filedrop'),
        fuparent = fileupload.parent(),
        maxFilesCount = fileupload.length*2;
        fileupload.remove();
      
        if(uploaderEnabled) {
        
            fuparent.html('<div id="dropbox"><span class="message">Drag and drop images here to upload.</span></div>');
        
            dropbox = $('#dropbox');
            message = $('.message', dropbox);
            var referer = window.location.pathname.replace(/[^a-zA-Z]+/g,''),
            defaultSettings = {
                maxfiles: maxFilesCount,
                beforeEach: function(file) {
                    if (!file.type.match(/^image\//)) {
                        alert('Only images are allowed!');
                        // Returning false will cause the
                        // file to be rejected
                        return false;
                    }
                }
            };
          
          
            var customSettings = {
                url: baseUrl + '/submissions/upload/ext/jpg,jpeg,png,gif,tif,tiff,xbm,wbmp/referer/'+referer
            };
          
            /* if(referer.indexOf('warranty') != -1) {
            customSettings.url += '/formType/warranty';
          }*/
        
            /********* SET CUSTOM SETTINGS HERE ON A PER-USE BASIS *****/
        
            $("#warranty_div .real3d").hide();
        
            /*** end ***/
        
            // enable dragndrop
            dropbox.filedrop($.extend(customSettings, defaultSettings));
      
        } else {
        
            // Creat the link email
            email_link =  '<dt id="email_link-label"><a id="email_link" style="color: #000;">Please also email us photos of any damaged products</a></dt>';
            $("#otherparts-element").after(email_link);
            $("#email_link").click(function() {
                sendTo = 'warranty@vulytrampolines.com';
                subject = 'Warranty Claim: ' + $("#connote").val() +'; ' + $("#warranty_name").val();
                body = 'Company Name:' + $('#company_name').val()  + '.%0D%0A'
                + 'Name: ' +  $('#warranty_name').val() + '%0D%0A'
                + 'Surname: ' + $('#warranty_lastname').val() + '%0D%0A'
                + 'Mobile Phone: ' + $('#warranty_phone_mobile').val() + '%0D%0A'
                + 'Email: ' + $('#warranty_email').val() + '%0D%0A'
                + 'Connote: ' + $('#connote').val() + '%0D%0A'
                + 'Reason: ' + $('#reason').val() + '%0D%0A'
                + 'Parts of your trampoline with issues: ' + $('#otherparts').val() ;
                mailto = "mailto:"+sendTo+"?subject="+subject+"&body="+body;
                
                
                window.open(mailto);
                return false;
            });
            
        }
    }
});