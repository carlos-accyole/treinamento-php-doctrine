<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Helper\EntityManagerFactory;
use Doctrine\DBAL\Logging\DebugStack;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();
$alunoRepository = $entityManager->getRepository(Aluno::class);


/**@var Aluno[] $alunos */
$alunos = $alunoRepository->buscaCursosPorAluno();

$debugStack = new DebugStack();
$entityManager->getConfiguration()->setSQLLogger($debugStack);

foreach ($alunos as $aluno) {

    $telefones = $aluno
        ->getTelefones()
        ->map(function (Telefone $telefone){
            return $telefone->getNumero();
        })
        ->toArray();

    echo "ID : {$aluno->getId()}\n";
    echo "NOme : {$aluno->getNome()}\n";
    echo "Telefone: " . implode(',', $telefones) . "\n";
    $cursos = $aluno->getCursos();

    foreach ($cursos as $curso) {
        echo "\tID Curso: {$curso->getId()}\n";
        echo "\tCurso: {$curso->getNome()}\n";
        echo "\n";
    }
    echo "\n";
}

echo "\n";
//print_r($debugStack);
foreach ($debugStack->queries as $queryInfo) {
    echo $queryInfo['sql'] . "\n";
}