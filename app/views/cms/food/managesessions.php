<?php
include(__DIR__ . "/../../header.php");

?>
<br />
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="/user/create" role="button">Create</a>
    </div>
    <div class=" card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Restaurant</th>
                        <th scope="col">Sessions</th>
                        <th scope="col">Price (€)</th>
                        <th scope="col">Reduced price (€)</th>
                        <th scope="col">First session start time</th>
                        <th scope="col">Session length (in hours)</th>
                        <th scope="col">Seats</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sessions as $session) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $session->getRestaurantname(); ?></td>
                            <td><?php echo $session->getSessions(); ?></td>
                            <td><?php echo $session->getPrice(); ?></td>
                            <td><?php echo $session->getReducedprice(); ?></td>
                            <td><?php echo $session->getFirst_session(); ?></td>
                            <td><?php echo $session->getSession_length(); ?></td>
                            <td><?php echo $session->getSeats(); ?></td>
                            <td>
                                <input name="editbtn" id="editbtn" class="btn btn-info" type="button" value="Edit" onclick="location='/food/editsession?sessionid=<?php echo $session->getId(); ?>'">
                                <input name="deletebtn" id="deletebtn" class="btn btn-danger" type="button" value="Delete" onclick="location='/food/editsession?sessionid=<?php echo $session->getId(); ?>'">
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>


<?php include(__DIR__ . "/../../footer.php"); ?>