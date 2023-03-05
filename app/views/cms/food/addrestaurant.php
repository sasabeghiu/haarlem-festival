<?php
include(__DIR__ . "/../../header.php");

?>
<div class="card">
    <div class="card-header">
        Adding restaurant
    </div>
    <div class="card-body">
        <form action="/food/saveRestaurant" method="post" enctype="multipart/form-data" id="edit-form">
            <div class="mb-3">
                <label for="name" class="form-label">Name: </label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location:</label>
                <input type="text" class="form-control" name="location" id="restaurants">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <input type="text" class="form-control" name="description" id="description">
            </div>
            <div class="mb-3">
                <label for="cuisine" class="form-label">Cuisine:</label>
                <input type="text" class="form-control" name="cuisine" id="cuisine">
            </div>
            <div class="mb-3">
                <label for="stars" class="form-label">Stars:</label>
                <select name="stars" class="form-control ">
                    <option value="NULL" selected disabled hidden>Select amount of stars</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>            
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>
            <div class="mb-3">
                <label for="phonenumber" class="form-label">Phonenumber:</label>
                <input type="text" class="form-control" name="phonenumber" id="phonenumber">
            </div>
            <div class="mb-3">
                <label for="image1" class="form-label">Image 1: </label>
                <input type="file" class="" name="image1" id="image1">
            </div>
            <button type="submit" class="btn btn-success">Edit</button>
            <a name="" id="" class="btn btn-primary" href="/food/managerestaurants" role="button">Cancel</a>

        </form>
    </div>

</div>
<?php include(__DIR__ . "/../../footer.php"); ?>