 <?php
 ini_set("display_errors", 1);
 ini_set("display_setup_errors", 1);
 error_reporting(E_ALL);

 $array = [];

 if ($_SERVER["REQUEST_METHOD"] === "POST") {
   if (
     isset($_POST["nume"]) &&
     (isset($_POST["telefon"]) && isset($_POST["email"]))
   ) {
     if (strlen($_POST["nume"] < 3)) {
       echo "Campul nume trebuie sa aiba cel putin 3 caractere.";
       echo "<br/><br/>";
     } elseif (strlen($_POST["telefon"]) < 3) {
       echo "Campul telefon trebuie sa aiba cel putin 3 caractere.";
       echo "<br/><br/>";
     } elseif (strlen($_POST["email"]) < 3) {
       echo "Campul email trebuie sa aiba cel putin 3 caractere.";
       echo "<br/><br/>";
     } else {
       $exista = false;
       foreach ($array as $ar) {
         if (strtolower($ar["nume"]) === strtolower($_POST["nume"])) {
           $exista = true;
         }
       }
       if (!$exista) {
         $participant = [
           "nume" => $_POST["nume"],
           "telefon" => $_POST["telefon"],
           "email" => $_POST["email"],
         ];
         array_push($array, $participant);
       }
     }
   }
 }
 ?>


<html>
<form method="POST" action="./ex2.contact.php">
      <label>Nume participant: </label>
      <input type="text" placeholder="Nume si prenume" name="nume" required />
      <br />
      <br />
      <label>Numar de telefon: </label>
      <input
        type="number"
        placeholder="Numar de telefon"
        name="telefon"
        required
      />
      <br />
      <br />
      <label>Adresa de e-mail:</label>
      <input
        type="email"
        placeholder="Adresa de e-mail"
        name="email"
        required
      />
      <br />
      <br />
      <br />
      <button>Trimite datele</button>
    </form>


      
        <?php foreach ($array as $ar): ?>
            <ul><?php echo "<b>Numele participantului: </b>" .
              $ar["nume"] .
              ", <b>telefon: </b> " .
              $ar["telefon"] .
              ", <b>adresa de e-mail: </b>" .
              $ar["email"] .
              "."; ?></ul>

        <?php endforeach; ?>
</html>