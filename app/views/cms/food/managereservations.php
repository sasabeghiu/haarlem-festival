<?php
include(__DIR__ . "/../../header.php");

?>
<br />
<div class="card">
    <!-- <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="/food/addreservation" role="button">Add reservation</a>
    </div> -->
    <div class=" card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Reservation name</th>
                        <th scope="col">Restaurant</th>
                        <th scope="col">Seats</th>
                        <th scope="col">Time</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($reservations as $reservation) {
                        ?>    
                        <tr class="">
                            <td scope="row"><?php echo $reservation->getName(); ?></td>
                            <td><?php echo $reservation->getRestaurantName(); ?></td>
                            <td><?php echo $reservation->getSeats(); ?></td>
                            <td><?php echo $reservation->getDate(); ?></td>
                            <td><?php 
                            if ( $reservation->getStatus() )
                                echo "Active";
                            else
                                echo "Inactive" ;
                            ?></td>
                            <td>
                                <input name="deactivatebtn" id="deactivatebtn" class="btn btn-danger" type="button" value="Deactivate" onclick="location='/food/deactivatereservation?reservationid=<?php echo $reservation->getId(); ?>'">
                            </td>
                        </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>


<?php include(__DIR__ . "/../../footer.php"); ?>