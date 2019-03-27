<?php
    require('../../barcodegen/class/BCGFontFile.php');
    require('../../barcodegen/class/BCGDrawing.php');
    require('../../barcodegen/class/BCGcode128.barcode.php');

    $data = $_GET['data'];

    $colorFront = new BCGColor(0, 0, 0);
    $colorBack = new BCGColor(255, 255, 255);
    $font = new BCGFontFile('../../barcodegen/font/Arial.ttf', 18);
    $code = new BCGcode128();
    $code->setScale(1);
    $code->setThickness(50);
    $code->setForegroundColor($colorFront);
    $code->setBackgroundColor($colorBack);
    $code->setFont($font);
    $code->setStart(NULL);
    $code->setTilde(true);
    $code->parse($data);

    $drawing = new BCGDrawing('', $colorBack);
    $drawing->setBarcode($code);
    $drawing->draw();

    header('Content-Type: image/png');

    $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
?>