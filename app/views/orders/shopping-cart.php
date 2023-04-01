<?php
include __DIR__ . '/../header.php';
?>

<div class="containter-fluid py-5">
    <div class="text-center mb-5">
        <h2 class="text-center">Shopping Cart</h2>
    </div>
    <div class="row px-5">
        <div class="col-md-7 mt-4">
            <div class="shopping-cart">
                <?php
                $total = 0;
                if ($count > 0) {
                    foreach ($cartItems as $cartItem) {
                ?>
                        <div class="">
                            <div class="row border border-dark rounded mb-2">
                                <div class="col-md-6">
                                    <h5 class="pt-2">Event name: <?= $cartItem->getEvent_name() ?></h5>
                                    <h5 class="pt-2">Price per ticket: &euro; <?= $cartItem->getEvent_price() ?></h5>
                                    <h5 class="pt-2">Qty: <?= $cartItem->getQty() ?></h5>
                                    <h5 class="pt-2">Subtotal: <?= $cartItem->getSubtotal() ?></h5>
                                    <form action="/shoppingcart?action=remove&id=<?= $cartItem->getId() ?>" method="post" class="cart-items product-data mb-1">
                                        <button type="submit" class="btn btn-danger" name="remove">Remove product from cart</button>
                                    </form>
                                </div>
                                <div class="col-md-3 py-5">
                                    <div>
                                        <form class="update-quantity-form" method="post">
                                            <div class="product-id" style="display:none;"><?= $cartItem->getId() ?></div>
                                            <div class="input-group">
                                                <span class="input-group">Update quantity:</span>
                                                <input type="number" name="quantity" value="<?= $cartItem->getQty() ?>" class="form-control cart-quantity" min="1" />
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default update-quantity" type="submit" name="updatemf">Update</button>
                                                </span>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        $subtotal = $cartItem->getSubtotal();
                        $total += $subtotal;
                    }
                } else {
                    echo "<h5>Your cart is empty</h5>";
                }
                ?>
            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 h-25">
            <div class="pt-4">
                <h6 class="text-center">Order Details</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                        if ($count > 0) {
                            echo "<h6>Price ($count items)</h6>";
                        } else {
                            echo "<h6>Price (0 items)</h6>";
                        }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Total Price</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>&euro; <?php echo $total; ?></h6>
                        <h6 class="text-success"> FREE </h6>
                        <hr>
                        <h6>&euro; <?php echo $total; ?></h6>
                    </div>
                </div>
                <hr>
                <a class="btn btn-success d-flex justify-content-center mb-3" href="/orders/checkout">Proceed to checkout</a>
                <a class="btn btn-primary d-flex justify-content-center mb-3" href="">Share your shopping cart with a friend</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.update-quantity-form').on('submit', function() {
            var id = $(this).find('.product-id').text();
            var quantity = $(this).find('.cart-quantity').val();

            window.location.href = "/shoppingcart?action=update&id=" + id + "&qty=" + quantity;
            return false;
        });
    });
</script>

<?php
include __DIR__ . '/../footer.php';
?>