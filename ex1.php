<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

$arrayNemodificat = [
  ["nume" => "Cosmin", "varsta" => 30, "genul" => "masculin"],
  ["nume" => "Mihaela", "varsta" => 24, "genul" => "feminin"],
  ["nume" => "Claudiu", "varsta" => 45, "genul" => "masculin"],
  ["nume" => "Costel", "varsta" => 60, "genul" => "masculin"],
  ["nume" => "Maria", "varsta" => 17, "genul" => "feminin"],
];

$array = $arrayNemodificat;

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  if (isset($_GET["nume"]) && !empty($_GET["nume"])) {
    echo $_GET["nume"];
    echo "<br/>";

    $rezultate = array_filter($array, function ($arr) {
      if (strtolower($arr["nume"]) === strtolower($_GET["nume"])) {
        return true;
      }
      return false;
    });

    $array = $rezultate;
  } else {
    $array = $arrayNemodificat;
  }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (
    isset($_POST["nume"]) &&
    isset($_POST["varsta"]) &&
    isset($_POST["genul"])
  ) {
    $exista = false;

    foreach ($array as $ar) {
      if (strtolower($ar["nume"]) === strtolower($_POST["nume"])) {
        $exista = true;
      }
    }

    if (!$exista) {
      // daca in lista sunt mai mult de 2 barbati sa nu mai acceptam barbati
      // $counter = 0;
      // foreach ($array as $arr) {
      //     if ($arr['genul'] === 'masculin') {
      //         $counter++;
      //     }
      // }

      $barbatiInscrisi = array_filter($array, function ($arr) {
        if ($arr["genul"] === "masculin") {
          return true;
        }
        return false;
      });

      if (count($barbatiInscrisi) > 2 && $_POST["genul"] !== "feminin") {
        echo "Din pacate nu va puteti inscrie, sunteti trist.";
        echo "<br>";
      } else {
        if ($_POST["varsta"] < 16) {
          echo "Din pacate sunteti sub varsta limita.";
          echo "<br>";
        } else {
          $participant = [
            "nume" => $_POST["nume"],
            "varsta" => $_POST["varsta"],
            "genul" => $_POST["genul"],
          ];

          array_push($array, $participant);
        }
      }
    } else {
      echo "Participantul exista deja!";
      echo "<br>";
    }
  } else {
    echo "Nu ati introdus datele corect!";
    echo "<br>";
  }
}
?>

<html>
<a href="/despre.php">Despre Noi</a>
<br />
<a href="/produse.php">Produse</a>
<br />
<a href="/contact.php">Contact</a>
<br />
<h3>Formular inscriere</h3>

<form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
    <label>Nume Participant</label>
    <input type="text" placeholder="numele participantului" name="nume" />
    <br />
    <label>Varsta</label>
    <input type="number" placeholder="varsta" name="varsta" />
    <br />
    <label>Genul:</label>
    <br />
    <label>Masculin</label>
    <input type="radio" value="masculin" name="genul" />
    <label>Feminin</label>
    <input type="radio" value="feminin" name="genul" />
    <br />
    <button>Trimite</button>
</form>

<form method="GET" action="<?php $_SERVER["PHP_SELF"]; ?>">
    <label>Nume Participant</label>
    <input type="text" placeholder="numele participantului" name="nume" />
    <input type="submit" value="cauta" />
</form>

<table>
    <tr>
        <th>Nume</th>
        <th>Varsta</th>
        <th>Genul</th>
    </tr>
    <?php foreach ($array as $ar): ?>
        <tr>
            <td>
                <?php echo $ar["nume"]; ?>
            </td>
            <td>
                <?php echo $ar["varsta"]; ?>
            </td>
            <td>
                <?php echo $ar["genul"]; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</html>
