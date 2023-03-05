<?php
include __DIR__ . '/../../header.php';
?>

<style>
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .filterbtn {
        width: 120px;
        height: 50px;
    }
</style>

<h1 class="text-center mb-3">Manage Events</h1>

<div class="center my-3">
    <form method="POST">
        <input type="submit" name="dance" value="Dance Events" class="btn btn-primary mx-3 filterbtn"></a>
    </form>
    <form method="POST">
        <input type="submit" name="jazz" value="Jazz Events" class="btn btn-primary mx-3 filterbtn"></a>
    </form>
</div>

<div class="album px-5">
    <div>
        <button class="btn btn-success mb-2" id="show-add-form">Add event</button>
    </div>

    <!-- fix the form with images -->
    <!-- hidden form to add a new event -->
    <div id="form-add-container" style="display: none;">
        <form method="POST">
            <div class="form-group row mb-1">
                <label for="type" class="col-sm-2 col-form-label">Type (dance/jazz):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="type" name="type" placeholder="Insert Event Type" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="artistName" class="col-sm-2 col-form-label">Artist:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="artistName" name="artistName" placeholder="Insert Artist id" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="venueName" class="col-sm-2 col-form-label">Venue:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="venueName" name="venueName" placeholder="Insert Venue id" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="price" class="col-sm-2 col-form-label">Price:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="price" name="price" placeholder="Insert Ticket Price" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="stock" class="col-sm-2 col-form-label">Tickets Available:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="Insert amount of tickets available" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="datetime" class="col-sm-2 col-form-label">Date and Time:</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" id="datetime" name="datetime" placeholder="Insert datetime" required>
                </div>
            </div>
            <div class="form-group row mb-1">
                <label for="image" class="col-sm-2 col-form-label">Image:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="image" name="image" placeholder="Insert image id..." required>
                </div>
            </div>

            <input type="submit" name="add" value="Insert Event" class="form-control btn btn-success mb-1">
        </form>
    </div>

    <!-- display data -->
    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Artist</th>
                <th scope="col">Venue</th>
                <th scope="col">Ticket Price</th>
                <th scope="col">Tickets Available</th>
                <th scope="col">Date and Time</th>
                <th scope="col">Image</th>
                <th scope="col" colspan="2" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($model as $event) {
                $date_string = $event->getDatetime();
                $date = new DateTime($date_string);
                $formated = $date->format("l, j F Y h:i A");
            ?>
                <tr>
                    <td><?= $event->getId() ?></td>
                    <td style="width:30%;"><?= $event->getName() ?></td>
                    <td style="width:20%;"><?= $event->getVenue() ?></td>
                    <td>&euro; <?= $event->getTicket_price() ?></td>
                    <td><?= $event->getTickets_available() ?> st.</td>
                    <td><?php echo $formated; ?></td>
                    <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($event->getImage()) . '" height="100px"/>'; ?></td>
                    <!-- change links -->
                    <td>
                        <form action="/event/eventcms?updateID=<?= $event->getId() ?>" method="POST">
                            <input type="hidden" name="edit" value="<?= $event->getId() ?>">
                            <input type="submit" name="submit" value="Edit" class="btn btn-warning">
                        </form>
                    </td>
                    <td>
                        <form action="/event/eventcms?deleteID=<?= $event->getId() ?>" method="POST">
                            <input type="hidden" name="delete" value="<?= $event->getId() ?>">
                            <input type="submit" name="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <!-- UPDATE part -->
    <?php
    if (isset($_POST["edit"])) {
    ?>
        <h3>Edit event #<?= $updateEvent->getId() ?></h3>
        <div>
            <form method="POST">
                <div class="form-group row mb-1">
                    <label for="updatedType" class="col-sm-2 col-form-label">Type (dance/jazz):</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="updatedType" name="updatedType" value="<?= $updateEvent->getType() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="updatedArtistName" class="col-sm-2 col-form-label">Artist:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="updatedArtistName" name="updatedArtistName" value="<?= $updateEvent->getArtist() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="updatedVenueName" class="col-sm-2 col-form-label">Venue:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="updatedVenueName" name="updatedVenueName" value="<?= $updateEvent->getVenue() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="updatedPrice" class="col-sm-2 col-form-label">Price:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="updatedPrice" name="updatedPrice" value="<?= $updateEvent->getTicket_price() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="updatedStock" class="col-sm-2 col-form-label">Tickets Available:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="updatedStock" name="updatedStock" value="<?= $updateEvent->getTickets_available() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="updatedDatetime" class="col-sm-2 col-form-label">Date and Time:</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control" id="updatedDatetime" name="updatedDatetime" value="<?= $updateEvent->getDatetime() ?>" required>
                    </div>
                </div>
                <div class="form-group row mb-1">
                    <label for="updatedImage" class="col-sm-2 col-form-label">Image:</label>
                    <div class="col-sm-10">
                        <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($updateEvent->getImage()) . '"  height="100px"/>'; ?>
                        <input type="text" class="form-control" id="updatedImage" name="updatedImage" placeholder="Insert image id..." required>
                    </div>
                </div>

                <input type="submit" name="update" value="Update Event" class="form-control btn btn-success mb-1">
            </form>
        </div>
    <?php
    }
    ?>
</div>
<!-- script to display add form if add button was clicked -->
<script>
    document.getElementById('show-add-form').addEventListener('click', function() {
        document.getElementById('form-add-container').style.display = 'block';
    });
</script>

<?php
include __DIR__ . '/../../footer.php';
?>