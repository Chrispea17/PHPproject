<?php
//SECTION A - CONNECT TO DATABASE
/*this code was rewritten from the sql section of the tutorial it is not as familiar to me as the rest of the code below as many of the DBs I work in have already been created*/
$pdo = new
PDO("mysql:host=localhost;dbname=pawzone","pz_admin","ABCD");
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//SECTION B - CREATE TABLE 
//this is more familiar
$sql = "CREATE TABLE IF NOT EXISTS pets (owner VARCHAR(255) NOT NULL, petname VARCHAR(255)NOT NULL, breed VARCHAR(255)NOT NULL, microchip VARCHAR(20), PRIMARY KEY(owner,petname))";

$stmt = $pdo->prepare($sql);

$stmt->execute();

//SECTION C - INSERT DATA
//this is familiar
$sql = "INSERT INTO pets (owner, petname, breed)
VALUES(:owner,:petname,:breed)";

$stmt = $pdo->prepare($sql);

$owner = array('Ted','Jamie','En','En');
$pname = array('Angel','Max','Boots','Dora');
$breed = array('Labradoodle','Domestic Shorthair','Domestic Shorthair','Munchkin)');


for ($i = 0; $i <4 ;++$i)
{
    $stmt->bindValue(':owner',$owner[$i]);
    $stmt->bindValue(':petname',$pname[$i]);
    $stmt->bindValue(':breed',$breed[$i]);
    
    $stmt->execute();
}
//SECTION -D UPDATE DATA
//this is familiar
$sql = "UPDATE pets SET microchip = :micro WHERE owner =:owner AND petname = :petname";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':micro','121342345');
$stmt->bindValue(':owner','Jamie');
$stmt->bindValue(':petname','Max');

$stmt->execute();

//SECTION E - DELETE DATA

$sql = "DELETE FROM pets WHERE owner = :owner AND petname = :petname";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':owner', 'Ted');
$stmt->bindValue(':petname','Angel');

$stmt->execute();