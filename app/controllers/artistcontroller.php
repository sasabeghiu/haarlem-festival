<?php
require __DIR__ . '/../services/artistservice.php';
require __DIR__ . '/../services/albumservice.php';
require __DIR__ . '/../services/eventService.php';

include_once __DIR__ . '/../views/getURL.php';

class ArtistController
{
    private $artistService;
    private $albumService;
    private $eventService;

    function __construct()
    {
        $this->artistService = new ArtistService();
        $this->albumService = new AlbumService();
        $this->eventService = new EventService();
    }

    public function danceartists()
    {
        $model = $this->artistService->getAllDanceArtists();

        require __DIR__ . '/../views/dance/artistsoverview.php';
    }

    public function jazzartists()
    {
        ini_set('memory_limit', '1024M');
        $model = $this->artistService->getAllJazzArtists();

        require __DIR__ . '/../views/jazz/artistsoverview.php';
    }


    public function danceartistdetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->artistService->getOne($params['id']);
        $albums = $this->albumService->getAllAlbumsByArtist($params['id']);
        $events = $this->eventService->getEventsByArtistName('%' . $model->getName() . '%');

        require __DIR__ . '/../views/dance/artistdetails.php';
    }

    public function jazzartistdetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->artistService->getOne($params['id']);
        $albums = $this->albumService->getAllAlbumsByArtist($params['id']);
        $events = $this->eventService->getEventsByArtistName('%' . $model->getName() . '%');

        require __DIR__ . '/../views/jazz/artistdetails.php';
    }

    public function artistcms()
    {
        //delete
        if (isset($_POST["delete"])) {
            $id = htmlspecialchars($_GET["deleteID"]);
            $this->artistService->deleteArtist($id);

            if ($this->artistService) {
                echo "<script>alert('Artist deleted successfully. ')</script>";
            } else {
                echo "<script>alert('Failed to delete Artist. ')</script>";
            }
        }
        //add
        if (isset($_POST["add"])) {
            $name = htmlspecialchars($_POST["name"]);
            $description = htmlspecialchars($_POST["description"]);
            $type = htmlspecialchars($_POST["type"]);
            $spotify = htmlspecialchars($_POST["spotify"]);

            $artist = new Artist();

            $artist->setName($name);
            $artist->setDescription($description);
            $artist->setType($type);
            $artist->setSpotify($spotify);

            if (count($_FILES) > 0) {
                if (is_uploaded_file($_FILES['headerImg']['tmp_name'])) {
                    $headerImage = file_get_contents($_FILES['headerImg']['tmp_name']);
                    $artist->setHeaderImg($this->artistService->saveImage($headerImage));
                }
                if (is_uploaded_file($_FILES['thumbnailImg']['tmp_name'])) {
                    $thumbnailImage = file_get_contents($_FILES['thumbnailImg']['tmp_name']);
                    $artist->setThumbnailImg($this->artistService->saveImage($thumbnailImage));
                }
                if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
                    $logo = file_get_contents($_FILES['logo']['tmp_name']);
                    $artist->setLogo($this->artistService->saveImage($logo));
                }
                if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                    $image = file_get_contents($_FILES['image']['tmp_name']);
                    $artist->setImage($this->artistService->saveImage($image));
                }
            } else {
                echo "problem";
            }

            $this->artistService->addArtist($artist);

            if ($this->artistService) {
                echo "<script>alert('Artist addedd successfully. ')</script>";
            } else {
                echo "<script>alert('Failed to add Artist. ')</script>";
            }
        }
        //edit
        if (isset($_POST["edit"])) {
            $id = htmlspecialchars($_GET["updateID"]);
            $updateArtist = $this->artistService->getOne($id);
        }
        //update
        if (isset($_POST["update"])) {
            $name = htmlspecialchars($_POST["changedName"]);
            $description = htmlspecialchars($_POST["changedDescription"]);
            $type = htmlspecialchars($_POST["changedType"]);
            $headerImg = htmlspecialchars($_POST["changedHeaderImg"]);
            $thumbnailImg = htmlspecialchars($_POST["changedThumbnailImg"]);
            $logo = htmlspecialchars($_POST["changedLogo"]);
            $spotify = htmlspecialchars($_POST["changedSpotify"]);
            $image = htmlspecialchars($_POST["changedImage"]);

            $artist = new Artist();

            $artist->setName($name);
            $artist->setDescription($description);
            $artist->setType($type);
            $artist->setHeaderImg($headerImg);
            $artist->setThumbnailImg($thumbnailImg);
            $artist->setLogo($logo);
            $artist->setSpotify($spotify);
            $artist->setImage($image);

            $this->artistService->updateArtist($artist, $_GET["updateID"]);

            if ($this->artistService) {
                echo "<script>alert('Artist updated successfully. ')</script>";
            } else {
                echo "<script>alert('Failed to update Artist. ')</script>";
            }
        }

        //sort artists by type
        if (isset($_POST["dance"])) {
            $model = $this->artistService->getAllDanceArtists();
        } else if (isset($_POST["jazz"])) {
            $model = $this->artistService->getAllJazzArtists();
        } else {
            $model = $this->artistService->getAll();
        }


        require __DIR__ . '/../views/cms/music/artist-cms.php';
    }
}
