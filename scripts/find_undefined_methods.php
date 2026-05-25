<?php
$root = __DIR__ . '/../';
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
$used = [];
foreach ($it as $f) {
    if ($f->isFile() && substr($f->getFilename(), -4) === '.php') {
        $s = file_get_contents($f->getPathname());
        if (preg_match_all('/->\s*([a-zA-Z_][a-zA-Z0-9_]*)\s*\(/', $s, $m)) {
            foreach ($m[1] as $n) $used[$n] = true;
        }
    }
}
ksort($used);
$undefined = [];
foreach (array_keys($used) as $method) {
    $found = false;
    $it2 = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root));
    foreach ($it2 as $f) {
        if ($f->isFile() && substr($f->getFilename(), -4) === '.php') {
            $s = file_get_contents($f->getPathname());
            if (preg_match('/function\s+' . preg_quote($method, '/') . '\s*\(/', $s)) {
                $found = true;
                break;
            }
        }
    }
    if (!$found) $undefined[$method] = true;
}
$whitelist = array(
    'execute','prepare','query','fetch','fetchAll','closeCursor','setAttribute','start','header','redirect','value','verifyPlain','toArray','jsonSerialize','count','rowCount','bindValue','bindParam','executeQuery','executeStatement','getMessage','setMessage','success','errors','old','setOld','setErrors','setSuccess','message','email','name','password','getByEmail','getById','getAll','delete','save','update','fromModelToResponse','fromModelsToResponses','fromModelToDto','fromRowToModel','getFilename','getPathname','isFile'
);
$undefined = array_diff(array_keys($undefined), $whitelist);
if (empty($undefined)) {
    echo "No potentially undefined methods found (after whitelist).\n";
} else {
    echo "Potentially undefined methods:\n";
    foreach ($undefined as $m) echo " - $m\n";
}
