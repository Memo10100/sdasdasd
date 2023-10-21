<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sobre nosotros</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3 class="title">Nosotros</h3>
    <p> <a href="home.php">home</a> / Nosotros </p>
</section>

<section class="about">
    <center>
        <div>
            <div class="content">
                <h3 class="title">¿Quienes somos?</h3>
                <h4 class="subtitle">En GGFree, nos enorgullece ser una empresa pionera en la comercialización y distribución de alimentos sin gluten. Fundada en 2023, nuestra misión es brindar opciones seguras y deliciosas a las personas que padecen enfermedad celíaca o que siguen una dieta libre de gluten.</h4>
            </div>

        <div>
         <br>
            <div class="content">
                <p class="subtitle">¡Bienvenido a la familia GGFree!</p>
                <br>
                <h3 class="title">¿Donde nos podés encontrar?</h3>
                <a href="contacto.php" class="btn">Contactanos</a>
                
            </div>
            <br>
        </div>

        <div class="content">
            <iframe style="width:60%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3350.2109215719856!2d-68.8519993109192!3d-32.89259120111864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x967e09054fbdf051%3A0x89f76fcd3dac5f2e!2sSan%20Lorenzo%20537%2C%20Mendoza!5e0!3m2!1ses!2sar!4v1697875833924!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </center>


</section>


<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>