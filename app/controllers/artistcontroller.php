<?php
require __DIR__ . '/../services/artistservice.php';
require __DIR__ . '/../services/albumservice.php';
include_once __DIR__ . '/../views/getURL.php';

class ArtistController
{
    private $artistService;
    private $albumService;

    function __construct()
    {
        $this->artistService = new ArtistService();
        $this->albumService = new AlbumService();
    }

    public function index()
    {
        $model = $this->artistService->getAll();

        require __DIR__ . '/../views/dance/artistsoverview.php';
    }

    public function artistdetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->artistService->getOne($params['id']);
        $test = $this->albumService->getAllAlbumsByArtist($params['id']);

        require __DIR__ . '/../views/dance/artistdetails.php';
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
            $headerImg = htmlspecialchars($_POST["headerImg"]);
            $thumbnailImg = htmlspecialchars($_POST["thumbnailImg"]);
            $logo = htmlspecialchars($_POST["logo"]);
            $spotify = htmlspecialchars($_POST["spotify"]);
            $image = htmlspecialchars($_POST["image"]);

            $artist = new Artist();

            $artist->setName($name);
            $artist->setDescription($description);
            $artist->setType($type);
            $artist->setHeaderImg($headerImg);
            $artist->setThumbnailImg($thumbnailImg);
            $artist->setLogo($logo);
            $artist->setSpotify($spotify);
            $artist->setImage($image);

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

        $model = $this->artistService->getAll();

        require __DIR__ . '/../views/cms/artist-cms.php';
    }
}
