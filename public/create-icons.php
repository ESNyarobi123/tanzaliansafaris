<?php
/**
 * PWA Icon Generator for Tanzalian Safaris
 * This script generates placeholder app icons in all required sizes
 * Visit: http://your-domain.com/create-icons.php
 */

// Check if image was uploaded
if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
    $uploadedFile = $_FILES['icon']['tmp_name'];
    $imageInfo = getimagesize($uploadedFile);
    
    if ($imageInfo === false) {
        die('Invalid image file.');
    }
    
    $sourceImage = null;
    switch ($imageInfo[2]) {
        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($uploadedFile);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($uploadedFile);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = imagecreatefromgif($uploadedFile);
            break;
        default:
            die('Unsupported image format. Please use JPEG, PNG, or GIF.');
    }
    
    if (!$sourceImage) {
        die('Failed to process image.');
    }
    
    $sizes = [72, 96, 128, 144, 152, 192, 384, 512];
    $iconsDir = __DIR__ . '/assets/icons';
    
    if (!is_dir($iconsDir)) {
        mkdir($iconsDir, 0755, true);
    }
    
    foreach ($sizes as $size) {
        $resized = imagecreatetruecolor($size, $size);
        imagecopyresampled($resized, $sourceImage, 0, 0, 0, 0, $size, $size, imagesx($sourceImage), imagesy($sourceImage));
        imagepng($resized, $iconsDir . "/icon-{$size}x{$size}.png");
        imagedestroy($resized);
    }
    
    imagedestroy($sourceImage);
    
    echo '<h2 style="color: green;">Icons generated successfully!</h2>';
    echo '<p>Icons have been saved to: <code>public/assets/icons/</code></p>';
    echo '<p><a href="/">← Back to Home</a></p>';
    exit;
}

// If no upload, show form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create PWA Icons - Tanzalian Safaris</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c5530;
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
        }
        .instructions {
            background: linear-gradient(135deg, #fff7ed, #fef3c7);
            border-left: 4px solid #d4a373;
            padding: 20px;
            margin: 25px 0;
            border-radius: 8px;
            line-height: 1.8;
        }
        .instructions h3 {
            color: #2c5530;
            margin-bottom: 15px;
        }
        .instructions ol {
            margin-left: 20px;
        }
        .instructions li {
            margin-bottom: 10px;
        }
        .form-group {
            margin: 25px 0;
        }
        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #333;
        }
        input[type="file"] {
            width: 100%;
            padding: 15px;
            border: 2px dashed #d4a373;
            border-radius: 10px;
            background: #fff7ed;
            cursor: pointer;
            font-size: 14px;
        }
        button {
            background: linear-gradient(135deg, #2c5530, #1a331d);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(44,85,48,0.3);
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(44,85,48,0.4);
        }
        .tip {
            background: #e0f2fe;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🦁 Create PWA Icons</h1>
        <p style="color: #666; margin-bottom: 25px;">Generate all required app icons from a single image</p>
        
        <div class="instructions">
            <h3>📋 Instructions:</h3>
            <ol>
                <li>Prepare a square image (minimum 512x512px recommended)</li>
                <li>Image should be clear and high-quality (PNG or JPEG)</li>
                <li>Upload your image below</li>
                <li>Icons will be automatically generated in all required sizes</li>
                <li>Icons will be saved to: <code>public/assets/icons/</code></li>
            </ol>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="icon">Upload Icon Image:</label>
                <input type="file" id="icon" name="icon" accept="image/jpeg,image/png,image/gif" required>
            </div>
            
            <button type="submit">Generate All Icons</button>
        </form>

        <div class="tip">
            <strong>💡 Tip:</strong> For best results, use a square image (1:1 ratio) with your logo centered. 
            The script will automatically resize it to all required sizes (72x72, 96x96, 128x128, 144x144, 152x152, 192x192, 384x384, 512x512).
        </div>

        <p style="margin-top: 30px; text-align: center;">
            <a href="/" style="color: #2c5530; text-decoration: none;">← Back to Home</a>
        </p>
    </div>
</body>
</html>
