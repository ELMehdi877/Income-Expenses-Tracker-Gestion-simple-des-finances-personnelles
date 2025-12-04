<?php session_start();
$incomeCategory = $_POST["incomeCategory"] ?? null;
$incomeAmount   = $_POST["incomeAmount"] ?? null;
$incomeDesc     = $_POST["incomeDesc"] ?? null;

$expenseCategory = $_POST["expenseCategory"] ?? null;
$expenseAmount   = $_POST["expenseAmount"] ?? null;
$expenseDesc     = $_POST["expenseDesc"] ?? null;

$incomeDelete=$_POST['incomeDelete'] ?? null;
// $incomeModifie=$_POST['incomeModifie'] ?? null;

$expenseDelete=$_POST['expenseDelete'] ?? null;

// if (!isset($_SESSION["icomses"]) ) {
//     $_SESSION["icomses"]=[];
// }

// if (!isset($_SESSION["expense"]) ) {
// $_SESSION["expense"]=[];
// }

$pdo = new PDO("mysql:host=localhost;dbname=smart_wallet","root","");


if (isset($incomeCategory) && isset($incomeAmount) && isset($incomeDesc)) {
    if (!empty($incomeCategory) && !empty($incomeAmount) && !empty($incomeDesc) ) {
    $_SESSION['incomes'][]=[$incomeCategory,$incomeAmount,$incomeDesc];
    print_r($_SESSION['incomes']);
    $stmt=$pdo->prepare("INSERT INTO incomes (categorie,montants,description) VALUES (?,?,?)");
    $stmt->execute([$incomeCategory,$incomeAmount,$incomeDesc]);
    
    }
}
if (isset($expenseCategory) && isset($expenseAmount) && isset($expenseDesc)) {
    if (!empty($expenseCategory) && !empty($expenseAmount) && !empty($expenseDesc)) {
    $_SESSION['expenses'][]=[$expenseCategory,$expenseAmount,$expenseDesc];
    print_r($_SESSION['expenses']);
    $stmt=$pdo->prepare("INSERT INTO expenses (categorie,montants,description) VALUES (?,?,?)");
    $stmt->execute([$expenseCategory,$expenseAmount,$expenseDesc]);
    }
}

#delete income
if (isset($incomeDelete) && !empty($incomeDelete)) {
    $stmt = $pdo->prepare("DELETE FROM incomes WHERE id = ?");
    $stmt->execute([$incomeDelete]);
}

#delete espense
if (isset($expenseDelete) && !empty($expenseDelete)) {
    $stmt = $pdo->prepare("DELETE FROM expenses WHERE id = ?");
    $stmt->execute([$expenseDelete]);
}

header("Location: index.php");
exit;
