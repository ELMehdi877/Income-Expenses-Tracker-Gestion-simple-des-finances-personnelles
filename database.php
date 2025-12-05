<?php session_start();
#insert incomes
$incomeCategory = $_POST["incomeCategory"] ?? null;
$incomeAmount = $_POST["incomeAmount"] ?? null;
$incomeDesc = $_POST["incomeDesc"] ?? null; 
$incomeDate = $_POST["incomeDate"] ?? null; 

#id delete incomes
$incomeDelete = $_POST['incomeDelete'] ?? null;

#modification incomes
$incomeUpdateid = $_POST['incomeUpdateid'];
$incomeUpdateCategory = $_POST['incomeUpdateCategory'] ?? null;
$incomeUpdateAmount = $_POST['incomeUpdateAmount'] ?? null;
$incomeUpdateDesc = $_POST['incomeUpdateDesc'] ?? null;
$incomeUpdateDate = $_POST['incomeUpdateDate'] ?? null;

#insert expenses
$expenseCategory = $_POST["expenseCategory"] ?? null;
$expenseAmount = $_POST["expenseAmount"] ?? null;
$expenseDesc = $_POST["expenseDesc"] ?? null;


$expenseDelete=$_POST['expenseDelete'] ?? null;

// if (!isset($_SESSION["icomses"]) ) {
//     $_SESSION["icomses"]=[];
// }

// if (!isset($_SESSION["expense"]) ) {
// $_SESSION["expense"]=[];
// }

$pdo = new PDO("mysql:host=localhost;dbname=smart_wallet","root","");

#insert incomes
if (!empty($incomeCategory) && !empty($incomeAmount) && !empty($incomeDesc) && !empty($incomeDate) ) {
    $_SESSION['incomes'][]=[$incomeCategory,$incomeAmount,$incomeDesc];
    print_r($_SESSION['incomes']);
    $stmt=$pdo->prepare("INSERT INTO incomes (categorie,montants,description,date) VALUES (?,?,?,?)");
    $stmt->execute([$incomeCategory,$incomeAmount,$incomeDesc,$incomeDate]);
}
else if(!empty($incomeCategory) && !empty($incomeAmount) && !empty($incomeDesc)) {
    $stmt=$pdo->prepare("INSERT INTO incomes (categorie,montants,description) VALUES (?,?,?)");
    $stmt->execute([$incomeCategory,$incomeAmount,$incomeDesc]);
}


#modifie incomes
if (isset($incomeUpdateCategory) && isset($incomeUpdateAmount) && isset($incomeUpdateDesc) && isset($incomeUpdateDate)) {
    if (!empty($incomeUpdateCategory) && !empty($incomeUpdateAmount) && !empty($incomeUpdateDesc) && !empty($incomeUpdateDate)) {
    $_SESSION['incomes'][]=[$incomeUpdateCategory,$incomeUpdateAmount,$incomeUpdateDesc];
    print_r($_SESSION['incomes']);
    $stmt=$pdo->prepare("UPDATE incomes SET categorie = ? , montants = ? , description = ? , date = ? WHERE id = ? ");
    $stmt->execute([$incomeUpdateCategory,$incomeUpdateAmount,$incomeUpdateDesc,$incomeUpdateDate,$incomeUpdateid]);
    }
    else if (!empty($incomeUpdateCategory) && !empty($incomeUpdateAmount) && !empty($incomeUpdateDesc)) {
    $_SESSION['incomes'][]=[$incomeUpdateCategory,$incomeUpdateAmount,$incomeUpdateDesc];
    print_r($_SESSION['incomes']);
    $stmt=$pdo->prepare("UPDATE incomes SET categorie = ? , montants = ? , description = ? WHERE id = ? ");
    $stmt->execute([$incomeUpdateCategory,$incomeUpdateAmount,$incomeUpdateDesc,$incomeUpdateid]);
    }

}

#insert expenses
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
