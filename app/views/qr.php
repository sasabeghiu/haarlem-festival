<!DOCTYPE html>
<html>

<head>
    <title>Scan QR Code</title>
</head>

<body>
    <?php
    // Check if user agent is a mobile device
    $isMobile = strpos($_SERVER['HTTP_USER_AGENT'], "Mobile") !== false;
    if ($isMobile) {
        // Display button to scan QR code
        echo "<button onclick='openCamera()'>Scan QR Code</button>";
    } else {
        // Display message that QR code scanning is not supported
        echo "QR code scanning is not supported on this device.";
    }
    ?>

    <script>
        function openCamera() {
            // Check if browser supports getUserMedia
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // Open device's camera
                navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode: "environment"
                        }
                    })
                    .then(function(stream) {
                        // Create video element to display camera output
                        var video = document.createElement('video');
                        video.setAttribute('autoplay', '');
                        video.setAttribute('muted', '');
                        video.setAttribute('playsinline', '');
                        video.srcObject = stream;
                        document.body.appendChild(video);
                    })
                    .catch(function(error) {
                        // Handle error
                        console.error(error);
                    });
            } else {
                // Display message that camera access is not supported
                alert('Camera access is not supported on this device.');
            }
        }
    </script>
</body>

</html>