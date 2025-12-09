<?php session_start();
#insert incomes
$incomeCategory = $_POST["incomeCategory"] ?? null;
$incomeAmount = $_POST["incomeAmount"] ?? null;
$incomeDesc = $_POST["incomeDesc"] ?? null; 
$incomeDate = $_POST["incomeDate"] ?? null; 

#insert expenses
$expenseCategory = $_POST["expenseCategory"] ?? null;
$expenseAmount = $_POST["expenseAmount"] ?? null;
$expenseDesc = $_POST["expenseDesc"] ?? null;
$expenseDate = $_POST["expenseDate"] ?? null;

#modification incomes
$incomeUpdateid = $_POST['incomeUpdateid'] ?? null;
$incomeUpdateCategory = $_POST['incomeUpdateCategory'] ?? null;
$incomeUpdateAmount = $_POST['incomeUpdateAmount'] ?? null;
$incomeUpdateDesc = $_POST['incomeUpdateDesc'] ?? null;
$incomeUpdateDate = $_POST['incomeUpdateDate'] ?? null;

#modification expenses
$expenseUpdateid = $_POST['expenseUpdateid'] ?? null;
$expenseUpdateCategory = $_POST['expenseUpdateCategory'] ?? null;
$expenseUpdateAmount = $_POST['expenseUpdateAmount'] ?? null;
$expenseUpdateDesc = $_POST['expenseUpdateDesc'] ?? null;
$expenseUpdateDate = $_POST['expenseUpdateDate'] ?? null;

#id delete incomes
$incomeDelete = $_POST['incomeDelete'] ?? null;

#id delete expenses
$expenseDelete=$_POST['expenseDelete'] ?? null;

// if (!isset($_SESSION["icomses"]) ) {
//     $_SESSION["icomses"]=[];
// }

// if (!isset($_SESSION["expense"]) ) {
// $_SESSION["expense"]=[];
// }

$pdo = new PDO("mysql:host=localhost;dbname=smart_wallet","root","");

#insert incomes
if (!empty($incomeCategory) && !empty($incomeAmount) && !empty($incomeDesc)) {
    if (!empty($incomeDate)) {
        // $_SESSION['incomes'][]=[$incomeCategory,$incomeAmount,$incomeDesc];
        // print_r($_SESSION['incomes']);
        $stmt=$pdo->prepare("INSERT INTO incomes (categorie,montants,description,date) VALUES (?,?,?,?)");
        $stmt->execute([$incomeCategory,$incomeAmount,$incomeDesc,$incomeDate]);
    }

    else {
        $stmt=$pdo->prepare("INSERT INTO incomes (categorie,montants,description) VALUES (?,?,?)");
        $stmt->execute([$incomeCategory,$incomeAmount,$incomeDesc]);
    }
}
#insert expenses
if (!empty($expenseCategory) && !empty($expenseAmount) && !empty($expenseDesc)) {
    if (!empty($expenseDate)) {
        $_SESSION['expenses'][]=[$expenseCategory,$expenseAmount,$expenseDesc];
        print_r($_SESSION['expenses']);
        $stmt=$pdo->prepare("INSERT INTO expenses (categorie,montants,description,date) VALUES (?,?,?,?)");
        $stmt->execute([$expenseCategory,$expenseAmount,$expenseDesc,$expenseDate]);
    }

    else {
        $stmt=$pdo->prepare("INSERT INTO expenses (categorie,montants,description) VALUES (?,?,?)");
        $stmt->execute([$expenseCategory,$expenseAmount,$expenseDesc]);
    }
}

#modifie incomes
if (!empty($incomeUpdateid) && !empty($incomeUpdateCategory) && !empty($incomeUpdateAmount) && !empty($incomeUpdateDesc)) {
    // $_SESSION['incomes'][]=[$incomeUpdateCategory,$incomeUpdateAmount,$incomeUpdateDesc];
    // print_r($_SESSION['incomes']);
    $stmt=$pdo->prepare("UPDATE incomes SET categorie = ? , montants = ? , description = ? , date = ? WHERE id = ? ");
    $stmt->execute([$incomeUpdateCategory,$incomeUpdateAmount,$incomeUpdateDesc,$incomeUpdateDate,$incomeUpdateid]);
    }
    else if (!empty($incomeUpdateCategory) && !empty($incomeUpdateAmount) && !empty($incomeUpdateDesc)) {
    // $_SESSION['incomes'][]=[$incomeUpdateCategory,$incomeUpdateAmount,$incomeUpdateDesc];
    // print_r($_SESSION['incomes']);
    $stmt=$pdo->prepare("UPDATE incomes SET categorie = ? , montants = ? , description = ? WHERE id = ? ");
    $stmt->execute([$incomeUpdateCategory,$incomeUpdateAmount,$incomeUpdateDesc,$incomeUpdateid]);
    }


#modifie expenses
    // if (!empty($expenseUpdateCategory) && !empty($expenseUpdateAmount) && !empty($expenseUpdateDesc) && !empty($expenseUpdateDate)) {
    // $_SESSION['expenses'][]=[$expenseUpdateCategory,$expenseUpdateAmount,$expenseUpdateDesc];
    // print_r($_SESSION['expenses']);
    // $stmt=$pdo->prepare("UPDATE expenses SET categorie = ? , montants = ? , description = ? , date = ? WHERE id = ? ");
    // $stmt->execute([$expenseUpdateCategory,$expenseUpdateAmount,$expenseUpdateDesc,$expenseUpdateDate,$expenseUpdateid]);
    // }
    // else if (!empty($expenseUpdateCategory) && !empty($expenseUpdateAmount) && !empty($expenseUpdateDesc)) {
    // $_SESSION['expenses'][]=[$expenseUpdateCategory,$expenseUpdateAmount,$expenseUpdateDesc];
    // print_r($_SESSION['expenses']);
    // $stmt=$pdo->prepare("UPDATE expenses SET categorie = ? , montants = ? , description = ? WHERE id = ? ");
    // $stmt->execute([$expenseUpdateCategory,$expenseUpdateAmount,$expenseUpdateDesc,$expenseUpdateid]);
    // }
if (!empty($expenseUpdateid) && !empty($expenseUpdateCategory) && !empty($expenseUpdateAmount) && !empty($expenseUpdateDesc)) {
    if (!empty($expenseUpdateDate)) {
        $stmt = $pdo->prepare("UPDATE expenses SET categorie = ?, montants = ?, description = ?, date = ? WHERE id = ?");
        $stmt->execute([$expenseUpdateCategory, $expenseUpdateAmount, $expenseUpdateDesc, $expenseUpdateDate, $expenseUpdateid]);
    } else {
        $stmt = $pdo->prepare("UPDATE expenses SET categorie = ?, montants = ?, description = ? WHERE id = ?");
        $stmt->execute([$expenseUpdateCategory, $expenseUpdateAmount, $expenseUpdateDesc, $expenseUpdateid]);
    }
}

#delete income
if (!empty($incomeDelete)) {
    $stmt = $pdo->prepare("DELETE FROM incomes WHERE id = ?");
    $stmt->execute([$incomeDelete]);
}

#delete espense
if (!empty($expenseDelete)) {
    $stmt = $pdo->prepare("DELETE FROM expenses WHERE id = ?");
    $stmt->execute([$expenseDelete]);
}


#recuperation de data pour le graphique

// // إنشاء مصفوفة لكل شهر (12 شهر)
// $incomeData = array_fill(0, 12, 0);   // الإيرادات
// $expenseData = array_fill(0, 12, 0);  // المصاريف

// // جلب الإيرادات حسب الشهر
// $stmt = $pdo->query("SELECT MONTH(date) AS mois, SUM(montants) AS total FROM incomes GROUP BY MONTH(date)");
// $revenus = $stmt->fetchAll(PDO::FETCH_ASSOC);
// foreach ($revenus as $row) {
//     $incomeData[$row['mois'] - 1] = (float)$row['total'];
// }

// // جلب المصاريف حسب الشهر
// $stmt = $pdo->query("SELECT MONTH(date) AS mois, SUM(montants) AS total FROM expenses GROUP BY MONTH(date)");
// $depenses = $stmt->fetchAll(PDO::FETCH_ASSOC);
// foreach ($depenses as $row) {
//     $expenseData[$row['mois'] - 1] = (float)$row['total'];
// }


header("Location: index.php");
exit;
