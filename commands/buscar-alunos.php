<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$alunoRepository = $entityManager->getRepository(Aluno::class);

/** @var Aluno[] $alunoList */
$alunoList = $alunoRepository->findAll();

foreach ($alunoList as $aluno) {
    echo "ID: {$aluno->getId()}\nNome: {$aluno->getNome()}\n\n";
}

$refaela = $alunoRepository->find(3);
echo $refaela->getNome() . PHP_EOL;

$gabriela = $alunoRepository->findOneBy([
    'nome' => 'Gabriela Accyole'
]);

var_dump($gabriela);