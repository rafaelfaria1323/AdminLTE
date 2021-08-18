<?php
session_start();

$_SESSION['user'] =
  array(
    "id" => 'test',
    "email" => 'test@test.com',
    "nome" => 'Test User',
    "descricao_turma" => 'T1'
  );


if (isset($_SESSION['user'])) {
  header("location: ./user/materiais.php");
}
