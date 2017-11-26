$(function() {

    //Gestion des images dans formulaires
    var $collectionPhotos;

    // setup an "Ajouter une photo" link
    var $addPhotoLink = $('<a href="#" id="addPhotoLink"><i class="fa fa-plus fa-lg"></i></a>');
    var $colPhoto = $('<div class="col-xs-12" style="margin-left:30px"></div>').append($addPhotoLink);
    var $newPhotoBtn = $('<div class="form-group"></div>').append($colPhoto);

    function addPhotoForm($collectionPhotos, $newPhotoBtn) {
        // Get the data-prototype
        var prototype = $collectionPhotos.data('prototype');

        // get the new index
        var index = $collectionPhotos.data('index');

        // Replace '__name' in the prototype's HTML to
        // instead be a number based on how many items we have
        var template = prototype.replace(/__name__/g, index);

        // create a jQuery object
        var $photoForm = $(template);
        addDeleteLink($photoForm);
        // increase the index with one for the next item
        $collectionPhotos.data('index', index + 1);

        $newPhotoBtn.before($photoForm);
    }

    // get the div that holds the collection of photos
    $collectionPhotos = $('div#oc_trickbundle_trick_pictures');

    // count the current form inputs we have, use that as the new index when inserting a new item
    $collectionPhotos.data('index', $collectionPhotos.find(':input').length);

        // add the "ajouter une photo" anchor and div to the div.photos
    $collectionPhotos.append($newPhotoBtn);

    if ($collectionPhotos.data('index') == 0) {
        addPhotoForm($collectionPhotos, $newPhotoBtn);
    } else {
        $collectionPhotos.children('.rowPic').each(function() {
            addDeleteLink($(this));
        });
    }

    $('#addPhotoLink').click(function(e) {
        addPhotoForm($collectionPhotos, $newPhotoBtn);
        // prevent the link form creating a "#" on the URL
        e.preventDefault();
        return false;
    });


    // Gestion des videos
    var $collectionVideos;

    var $addVideoLink = $('<a href="#" id="addVideoLink"><i class="fa fa-plus fa-lg"></i></a>');
    var $colVideo = $('<div class="col-xs-12" style="margin-left:30px"></div>').append($addVideoLink);
    var $newVideoBtn = $('<div class="form-group"></div>').append($colVideo);

    function addVideoForm($collectionVideos, $newVideoBtn) {
        var prototype = $collectionVideos.data('prototype');
        var index = $collectionVideos.data('index');

        var template = prototype.replace(/__name__/g, index);

        var $videoForm = $(template);
        $collectionVideos.data('index', index + 1);
        addDeleteLink($videoForm);
        $newVideoBtn.before($videoForm);
    }

    $collectionVideos = $('div#oc_trickbundle_trick_videos');

    $collectionVideos.data('index', $collectionVideos.find(':input').length);

    $collectionVideos.append($newVideoBtn);

    if ($collectionVideos.data('index') == 0) {
        addVideoForm($collectionVideos, $newVideoBtn);
    } else {
        $collectionVideos.children('.rowVideo').each(function() {
            addDeleteLink($(this));
        });
    }


    $('#addVideoLink').click(function(e) {
        addVideoForm($collectionVideos, $newVideoBtn);
        e.preventDefault();
        return false;
    });


    function addDeleteLink($prototype) {
        var $deleteLink = $('<a href="#"><i class="fa fa-trash fa-lg"></i>');
        var $deleteDiv = $('<div class="col-xs-12 text-right" style="margin-top:10px"></div>').append($deleteLink);
        $prototype.append($deleteDiv);

        $deleteLink.click(function(e) {
            $prototype.remove();
            e.preventDefault();
            return false;
        });
    }

});
