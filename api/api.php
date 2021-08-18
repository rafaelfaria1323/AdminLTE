<?php
session_start();

include './bd.php';
include './functions.php';

if (isset($_POST['action']) && $_POST['action'] == 'showRequiUser') {

    $column = array('descricao_materiais', 'descricao_categoria', 'data', 'descricao_estado', 'descricao_ano_letivo');

    $query = 'SELECT tipo_materiais.descricao_materiais, categorias_materiais.descricao_categoria, req_materiais.data, estados_req_materiais.descricao_estado, ano_letivo.descricao_ano_letivo
                FROM req_materiais 
                    JOIN materiais ON materiais.id = req_materiais.id_material
                    JOIN estados_req_materiais ON estados_req_materiais.id = req_materiais.id_estado_req
                    JOIN ano_letivo ON ano_letivo.id = req_materiais.id_ano_letivo 
                    JOIN tipo_materiais ON tipo_materiais.id = materiais.id_tipo
                    JOIN categorias_materiais ON categorias_materiais.id = tipo_materiais.id_categoria_material
                        WHERE req_materiais.id_requisitante = "' . $_POST['userId'] . '"';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (tipo_materiais.descricao_materiais LIKE "%' . $_POST['search']['value'] . '%" OR categorias_materiais.descricao_categoria LIKE "%' . $_POST['search']['value'] . '%" OR req_materiais.data LIKE "%' . $_POST['search']['value'] . '%" OR estados_req_materiais.descricao_estado LIKE "%' . $_POST['search']['value'] . '%" OR ano_letivo.descricao_ano_letivo LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->query($query);

    $output = array(
        'draw' => intval($_POST['draw']),
        'recordsTotal' => $result->rowCount(),
        'recordsFiltered' => count_all_data_user($connect, $_POST['userId']),
        'data' => $result->fetchAll(PDO::FETCH_ASSOC)
    );

    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'showRequiAdminMat') {
    $column = array('id', "nome_user", "user_departamento", "id_requisitante", 'descricao_materiais', 'id_tipo', 'id_proprio', 'data', 'descricao_estado',  'descricao_ano_letivo');

    $query = 'SELECT users.nome_user, users.user_departamento, req_materiais.id_requisitante, req_materiais.id, req_materiais.id_material, tipo_materiais.descricao_materiais, materiais.id_proprio, materiais.id_tipo,req_materiais.data, estados_req_materiais.descricao_estado, ano_letivo.descricao_ano_letivo 
                FROM req_materiais 
                    JOIN materiais ON materiais.id = req_materiais.id_material  
                    JOIN estados_req_materiais ON estados_req_materiais.id = req_materiais.id_estado_req 
                    JOIN ano_letivo ON ano_letivo.id = req_materiais.id_ano_letivo 
                    JOIN tipo_materiais ON tipo_materiais.id = materiais.id_tipo 
                    JOIN categorias_materiais ON categorias_materiais.id = tipo_materiais.id_categoria_material
                    JOIN users ON users.id = req_materiais.id_requisitante
                    JOIN responsaveis_area ON responsaveis_area.id_area_material = categorias_materiais.id
                            WHERE responsaveis_area.id_responsavel_area = "' . $_POST['userId'] . '"';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (users.nome_user LIKE "%' . $_POST['search']['value'] . '%" OR users.user_departamento LIKE "%' . $_POST['search']['value'] . '%" OR req_materiais.id_requisitante LIKE "%' . $_POST['search']['value'] . '%" OR req_materiais.id LIKE "%' . $_POST['search']['value'] . '%" OR tipo_materiais.descricao_materiais LIKE "%' . $_POST['search']['value'] . '%" OR materiais.id_proprio LIKE "%' . $_POST['search']['value'] . '%" OR estados_req_materiais.descricao_estado LIKE "%' . $_POST['search']['value'] . '%" OR req_materiais.data  LIKE "%' . $_POST['search']['value'] . '%" OR ano_letivo.descricao_ano_letivo   LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->query($query);

    $output = array(
        'draw' => intval($_POST["draw"]),
        'recordsTotal' => $result->rowCount(),
        'recordsFiltered' => count_all_data_admin_req($connect, $_POST['userId']),
        'data' => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == "showMatAdminMat") {

    $column = array('id_proprio', 'descricao_materiais', 'descricao', 'id');

    $query = 'SELECT materiais.id, materiais.id_tipo, materiais.id_proprio, tipo_materiais.descricao_materiais, estados_materiais.descricao 
                    FROM materiais 
                            JOIN tipo_materiais ON materiais.id_tipo = tipo_materiais.id 
                            JOIN categorias_materiais ON categorias_materiais.id = tipo_materiais.id_categoria_material 
                            JOIN estados_materiais ON estados_materiais.id = materiais.id_estado 
                            JOIN responsaveis_area ON responsaveis_area.id_area_material = categorias_materiais.id
                                    WHERE responsaveis_area.id_responsavel_area = "' . $_POST['userId'] . '" AND materiais.id_status = 1';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (materiais.id_proprio LIKE "%' . $_POST['search']['value'] . '%" OR tipo_materiais.descricao_materiais LIKE "%' . $_POST['search']['value'] . '%" OR estados_materiais.descricao LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->query($query);

    $output = array(
        'draw' => intval($_POST['draw']),
        'recordsTotal' => $result->rowCount(),
        'recordsFiltered' => count_all_mat_admin_req($connect, $_POST['userId']),
        'data' => $result->fetchAll(PDO::FETCH_ASSOC)
    );

    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'showMatTypeAdminMat') {

    $column = array('id', 'descricao_materiais');

    $query = 'SELECT tipo_materiais.id, tipo_materiais.descricao_materiais
                    FROM tipo_materiais 
                            JOIN categorias_materiais ON categorias_materiais.id = tipo_materiais.id_categoria_material 
                            JOIN responsaveis_area ON responsaveis_area.id_area_material = categorias_materiais.id
                                    WHERE responsaveis_area.id_responsavel_area = "' . $_POST['userId'] . '"';


    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (tipo_materiais.descricao_materiais LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->query($query);

    $output = array(
        'draw' => intval($_POST['draw']),
        'recordsTotal' => $result->rowCount(),
        'recordsFiltered' => count_all_matType_admin_req($connect, $_POST['userId']),
        'data' => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'showCategory') {
    echo json_encode($data = $connect->query('SELECT * FROM categorias_materiais ORDER BY descricao_categoria')->fetchAll());
} elseif (isset($_POST['action']) && $_POST['action'] == 'showItensPerCategory') {
    echo json_encode($data = $connect->query('SELECT * FROM tipo_materiais WHERE id_categoria_material = ' . $_POST['id_categoria'] . ' ORDER BY descricao_materiais')->fetchAll());
} elseif (isset($_POST['action']) && $_POST['action'] == 'addReqMat') {
    if ($_POST['date'] <= date('Y-m-d')) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'A requisição deve ser feita com pelo menos 24h de antecedência'
        ));
    } else {
        $infog_id = $connect->query('SELECT * FROM materiais WHERE materiais.id_tipo = ' . $_POST['tM'] . ' AND materiais.id_estado = 1 AND materiais.id_status = 1 AND id not in (SELECT req_materiais.id_material FROM req_materiais JOIN materiais ON materiais.id = req_materiais.id_material WHERE materiais.id_tipo = ' . $_POST['tM'] . ' AND req_materiais.data = "' . $_POST['date'] . '") ORDER BY materiais.id LIMIT 1')->fetchColumn();

        if ($infog_id || $infog_id > 0) {
            try {
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $d = $connect->query('SELECT id from ano_letivo WHERE id_estado_ano_letivo = 2')->fetchColumn();

                $connect->exec('INSERT INTO req_materiais (data, id_requisitante, id_material, id_ano_letivo) VALUES ("' . $_POST['date'] . '","' . $_POST['userId'] . '",' . $infog_id . ',' . $d . ')');

                echo json_encode($return_arr[] = array(
                    "status" => '1',
                    "userId" => $_POST['userId'],
                    "tM" => $_POST['tM'],
                    "info_id" => $infog_id,
                    "date" => $_POST['date'],
                    "message" => 'Requisição realizada com sucesso'
                ));
            } catch (PDOException $e) {
                echo json_encode($return_arr[] = array(
                    "status" => '2',
                    "message" => $e->getMessage()
                ));
            }
        } else echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'Nenhum material disponível'
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'showTypeMat') {
    echo json_encode($data = $connect->query('SELECT tipo_materiais.id , tipo_materiais.descricao_materiais FROM tipo_materiais JOIN categorias_materiais ON categorias_materiais.id = tipo_materiais.id_categoria_material  JOIN responsaveis_area ON responsaveis_area.id_area_material = categorias_materiais.id WHERE responsaveis_area.id_responsavel_area = "' . $_POST['userId'] . '" ORDER BY tipo_materiais.descricao_materiais')->fetchAll());
} elseif (isset($_POST['action']) && $_POST['action'] == 'addMat') {
    try {
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        for ($i = 0; $i < $_POST['input_mat_quant']; $i++) {
            $a = $connect->query('SELECT MAX(id_proprio) FROM materiais WHERE materiais.id_tipo = ' . $_POST['tM2'] . ' AND materiais.id_status = 1')->fetchColumn();

            $connect->query('INSERT INTO materiais (id_proprio, id_tipo) VALUES (' . ++$a . ', ' . $_POST['tM2'] . ')');
        }

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Material inserido com sucesso'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'showCaciUser') {
    $column = array('id_proprio', 'descricao_cacifo_piso', 'id_parceiro', 'data', 'descricao_estado_req_cacifos', 'descricao_estado_req_cacifos_', 'descricao_ano_letivo');

    $query = 'SELECT cacifos.id_proprio, cacifo_piso.descricao_cacifo_piso, req_cacifos.data , req_cacifos.id_parceiro, estados_liq_req_cacifos.descricao_estado_req_cacifos, estados_req_cacifos.descricao_estado_req_cacifos_, ano_letivo.descricao_ano_letivo
                FROM req_cacifos
                    JOIN cacifos ON cacifos.id = req_cacifos.id_cacifo
                    JOIN cacifo_piso ON cacifo_piso.id = cacifos.id_piso
                    JOIN estados_liq_req_cacifos ON estados_liq_req_cacifos.id = req_cacifos.id_estado_req
                    JOIN estados_req_cacifos ON estados_req_cacifos.id = req_cacifos.id_estado_req_cacifo
                    JOIN ano_letivo ON ano_letivo.id = req_cacifos.id_ano_letivo
                        WHERE (req_cacifos.id_requisitante = "' . $_POST['userId'] . '" OR req_cacifos.id_parceiro = "' . $_POST['userId'] . '")';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND cacifos.id_proprio LIKE "%' . $_POST['search']['value'] . '%" OR cacifo_piso.descricao_cacifo_piso LIKE "%' . $_POST['search']['value'] . '%" OR req_cacifos.data LIKE "%' . $_POST['search']['value'] . '%" OR req_cacifos.id_parceiro LIKE "%' . $_POST['search']['value'] . '%" OR estados_liq_req_cacifos.descricao_estado_req_cacifos LIKE "%' . $_POST['search']['value'] . '%" OR estados_req_cacifos.descricao_estado_req_cacifos_ LIKE "%' . $_POST['search']['value'] . '%" OR ano_letivo.descricao_ano_letivo LIKE "%' . $_POST['search']['value'] . '%"';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->query($query);

    $output = array(
        'draw' => intval($_POST['draw']),
        'recordsTotal' => $result->rowCount(),
        'recordsFiltered' => count_all_data_user_caci($connect, $_POST['userId']),
        'data' => $result->fetchAll(PDO::FETCH_ASSOC)
    );

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == "showFloorOptions") {
    $array = preg_split('/(\d+)/', $_POST['userDepart'], -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

    $classAcess = $connect->query('SELECT id, descricao_nome_turma FROM turmas_acesso WHERE descricao_nome_turma = "' . $array[0] . '" ORDER BY descricao_nome_turma');

    if ($classAcess->rowCount() > 0) {
        $data = $connect->query('SELECT * FROM cacifo_piso WHERE descricao_cacifo_piso = "0"')->fetchAll();
    } else {
        $data = $connect->query('SELECT * FROM cacifo_piso WHERE descricao_cacifo_piso != "0"')->fetchAll();
    }

    echo json_encode($data);
} elseif (isset($_POST['action']) && $_POST['action'] == "showCaciPerFloor") {
    echo json_encode($data = $connect->query("SELECT * FROM cacifos WHERE id_piso = " . $_POST['id_piso'] . " AND id_estado_cacifo = 1 AND id_status = 1")->fetchAll());
} elseif (isset($_POST['action']) && $_POST['action'] == "showMateCaci") {
    echo json_encode($data = $connect->query("SELECT id, nome_user FROM users WHERE id != '" . $_POST['userId'] . "' AND id REGEXP '[0-9]'")->fetchAll());
} elseif (isset($_POST['action']) && $_POST['action'] == "addReqCaci") {

    if ($_POST['date'] <= date("Y-m-d")) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'A requisição deve ser feita com pelo menos 24h de antecedência'
        ));
    } else {

        $sql = (isset($_POST['pC']) && !empty($_POST['pC'])) ? 'SELECT COUNT(*) FROM req_cacifos WHERE (req_cacifos.id_requisitante = "' . $_POST['userId'] . '" OR req_cacifos.id_parceiro = "' . $_POST['userId'] . '" OR req_cacifos.id_requisitante = "' . $_POST['pC'] . '" OR req_cacifos.id_parceiro = "' . $_POST['pC'] . '") AND req_cacifos.id_estado_req_cacifo = 1' : 'SELECT COUNT(*) FROM req_cacifos WHERE (req_cacifos.id_requisitante = "' . $_POST['userId'] . '" OR req_cacifos.id_parceiro = "' . $_POST['userId'] . '") AND req_cacifos.id_estado_req_cacifo = 1';

        $b = $connect->query($sql);

        if ($b->fetchColumn() == 0) {
            try {
                $d = $connect->query('SELECT id from ano_letivo WHERE id_estado_ano_letivo = 2')->fetchColumn();

                $sql = (isset($_POST['pC']) && !empty($_POST['pC'])) ? 'INSERT INTO req_cacifos (data, id_requisitante, id_parceiro, id_cacifo, id_ano_letivo) VALUES ("' . $_POST['date'] . '","' . $_POST['userId'] . '","' . $_POST['pC'] . '",' . $_POST['nC'] . ',' . $d . ' )' : 'INSERT INTO req_cacifos (data, id_requisitante, id_cacifo, id_ano_letivo) VALUES ("' . $_POST['date'] . '","' . $_POST['userId'] . '",' . $_POST['nC'] . ',' . $d . ' )';

                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $connect->exec($sql);

                $connect->query("UPDATE cacifos set id_estado_cacifo = 2 WHERE id = " . $_POST['nC'])->execute();

                echo json_encode($return_arr[] = array(
                    "status" => '1',
                    "userId" => $_POST['userId'],
                    "pC" => $_POST['pC'],
                    "nC" => $_POST['nC'],
                    "date" => $_POST['date'],
                    "message" => 'Requisição realizada com sucesso'
                ));
            } catch (PDOException $e) {
                echo json_encode($return_arr[] = array(
                    "status" => '2',
                    "message" => $e->getMessage()
                ));
            }
        } else {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => 'Cada aluno apenas pode possuir um cacifo!'
            ));
        }
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'showRequiAdminCaci') {

    $column = array('id', 'id_requisitante', 'nome_user', 'user_departamento', 'id_parceiro', 'id_cacifo', 'id_proprio', 'descricao_cacifo_piso', 'data', 'descricao_estado_req_cacifos', 'descricao_estado_req_cacifos_', 'descricao_estado_dinheiro_cacifo', 'descricao_ano_letivo');

    $query = 'SELECT req_cacifos.id, req_cacifos.id_requisitante, users.nome_user, users.user_departamento ,req_cacifos.id_parceiro, req_cacifos.id_cacifo, cacifos.id_proprio, cacifo_piso.descricao_cacifo_piso, req_cacifos.data, estados_liq_req_cacifos.descricao_estado_req_cacifos, estados_req_cacifos.descricao_estado_req_cacifos_, estados_dinheiro_cacifo.descricao_estado_dinheiro_cacifo, ano_letivo.descricao_ano_letivo
                FROM req_cacifos
                    JOIN users ON users.id = req_cacifos.id_requisitante
                    JOIN cacifos ON cacifos.id = req_cacifos.id_cacifo
                    JOIN cacifo_piso ON cacifo_piso.id = cacifos.id_piso
                    JOIN estados_liq_req_cacifos ON estados_liq_req_cacifos.id = req_cacifos.id_estado_req
                    JOIN estados_req_cacifos ON estados_req_cacifos.id = req_cacifos.id_estado_req_cacifo
                    JOIN estados_dinheiro_cacifo ON estados_dinheiro_cacifo.id = req_cacifos.id_estado_dinheiro_cacifo
                    JOIN ano_letivo ON ano_letivo.id = req_cacifos.id_ano_letivo
                    JOIN responsaveis_cacifos ON responsaveis_cacifos.id_piso = cacifo_piso.id
    	                WHERE responsaveis_cacifos.id_responsavel = "' . $_POST['userId'] . '"';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND ( req_cacifos.id_requisitante LIKE "%' . $_POST['search']['value'] . '%" OR req_cacifos.id LIKE "%' . $_POST['search']['value'] . '%" OR users.nome_user LIKE "%' . $_POST['search']['value'] . '%" OR users.user_departamento LIKE "%' . $_POST['search']['value'] . '%" OR req_cacifos.id_parceiro LIKE "%' . $_POST['search']['value'] . '%" OR cacifos.id_proprio LIKE "%' . $_POST['search']['value'] . '%" OR cacifo_piso.descricao_cacifo_piso LIKE "%' . $_POST['search']['value'] . '%" OR req_cacifos.data LIKE "%' . $_POST['search']['value'] . '%" OR estados_liq_req_cacifos.descricao_estado_req_cacifos LIKE "%' . $_POST['search']['value'] . '%" OR estados_req_cacifos.descricao_estado_req_cacifos_ LIKE "%' . $_POST['search']['value'] . '%" OR estados_dinheiro_cacifo.descricao_estado_dinheiro_cacifo LIKE "%' . $_POST['search']['value'] . '%" OR ano_letivo.descricao_ano_letivo LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->query($query);

    $output = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_data_admin_caci($connect, $_POST['userId']),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
} elseif (isset($_POST['action']) && $_POST['action'] == 'showCaciAdmin') {
    $column = array('id', 'id_proprio', 'descricao_cacifo_piso', 'descricao_estado_cacifo');

    $query = 'SELECT cacifos.id, cacifos.id_proprio, cacifo_piso.descricao_cacifo_piso, estados_cacifos.descricao_estado_cacifo
                    FROM cacifos
                        JOIN cacifo_piso ON cacifo_piso.id = cacifos.id_piso
                        JOIN estados_cacifos ON estados_cacifos.id = cacifos.id_estado_cacifo
                        JOIN responsaveis_cacifos ON responsaveis_cacifos.id_piso = cacifo_piso.id
    	                    WHERE (responsaveis_cacifos.id_responsavel = "' . $_POST['userId'] . '" AND id_status = 1)';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (cacifos.id_proprio LIKE "%' . $_POST['search']['value'] . '%" OR cacifo_piso.descricao_cacifo_piso LIKE "%' . $_POST['search']['value'] . '%" OR estados_cacifos.descricao_estado_cacifo LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '';
    }

    $result = $connect->query($query);


    $output = array(
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_caci_admin_caci($connect, $_POST['userId']),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'showFloorCaci') {
    echo json_encode($data = $connect->query('SELECT cacifo_piso.id, cacifo_piso.descricao_cacifo_piso FROM cacifo_piso  JOIN responsaveis_cacifos ON responsaveis_cacifos.id_piso = cacifo_piso.id WHERE responsaveis_cacifos.id_responsavel = "' . $_POST['userId'] . '" ORDER BY cacifo_piso.descricao_cacifo_piso')->fetchAll());
} elseif (isset($_POST['action']) && $_POST['action'] == 'addCaci') {
    try {
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        for ($i = 0; $i < $_POST['input_caci_quant']; $i++) {
            $a = $connect->query('SELECT MAX(id_proprio) FROM cacifos WHERE cacifos.id_piso = ' . $_POST['sM'] . ' AND id_status = 1')->fetchColumn();
            $connect->query('INSERT INTO cacifos (id_proprio, id_piso) VALUES (' . ++$a . ', ' . $_POST['sM'] . ')');
        }

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Cacifo inserido com sucesso'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'finishReqMat') {

    $infog_id = $connect->query('SELECT id_estado_req FROM req_materiais WHERE id = ' . $_POST['reqId'])->fetchColumn();

    if ($infog_id == 1) {

        try {
            $connect->query('UPDATE req_materiais SET id_estado_req = 2 WHERE id = ' . $_POST['reqId']);
            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Requisição finalizada com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2', "message" => 'Não pode tentar finalizar uma requisição já finalizada'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'finishReqCaci') {
    $infog_id = $connect->query('SELECT id_estado_req FROM req_cacifos WHERE id = ' . $_POST['reqId'])->fetchColumn();

    if ($infog_id == 1) {

        $infog_id = $connect->query('SELECT id_estado_req_cacifo FROM req_cacifos WHERE id = ' . $_POST['reqId'])->fetchColumn();

        if ($infog_id == 1) {
            try {
                $connect->query('UPDATE req_cacifos SET id_estado_req_cacifo = 2, id_estado_dinheiro_cacifo = ' . $_POST['refundId'] . ' WHERE id = ' . $_POST['reqId'] . ';
                                UPDATE cacifos SET id_estado_cacifo = 1 WHERE id = ' . $_POST['caciId']);

                echo json_encode($return_arr[] = array(
                    "status" => '1',
                    "message" => 'Estado alterado com sucesso'
                ));
            } catch (PDOException $e) {
                echo json_encode($return_arr[] = array(
                    "status" => '2',
                    "message" => $e->getMessage()
                ));
            }
        } else echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'Não pode tentar liquidar uma requisição já liquidada'
        ));
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Não pode tentar finalizar algo não liquidado'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'deleteMat') {
    $a = $connect->query('SELECT * FROM req_materiais WHERE id_estado_req = 1 AND id_material = ' . $_POST['matId']);

    if ($a->rowCount() == 0) {
        try {
            $connect->query('UPDATE materiais set id_status = 2 WHERE id = ' . $_POST['matId']);
            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Material eliminado com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Não pode tentar eliminar um material ativo numa requisição'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'deleteCaci') {
    $a = $connect->query('SELECT COUNT(*) FROM req_cacifos WHERE id_cacifo = ' . $_POST['caciId'] . ' AND id_estado_req_cacifo = 1')->fetchColumn();

    if ($a == 0) {
        try {
            // Passagem de estado da Requisição
            $connect->query('UPDATE cacifos set id_status = 2 WHERE id = ' . $_POST['caciId']);

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Cacifo eliminado com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Não pode tentar eliminar um material ativo numa requisição'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'liquiReqCaci') {

    $infog_id = $connect->query('SELECT id_estado_req FROM req_cacifos WHERE id = ' . $_POST['reqId'])->fetchColumn();

    if ($infog_id == 2) {
        try {
            $connect->query('UPDATE req_cacifos set id_estado_req = 1 WHERE id = ' . $_POST['reqId']);

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Requisição liquidada com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Não pode tentar liquidar algo já liquidado'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'addTypeMat') {
    $sth = $connect->query('SELECT * FROM tipo_materiais JOIN categorias_materiais ON categorias_materiais.id = tipo_materiais.id_categoria_material  JOIN responsaveis_area ON responsaveis_area.id_area_material = categorias_materiais.id WHERE responsaveis_area.id_responsavel_area = "' . $_POST['userId'] . '" AND tipo_materiais.descricao_materiais = "' . $_POST['input_mat_name'] . '"');

    if ($sth->rowCount() == 0) {
        $connect->query('INSERT INTO tipo_materiais (descricao_materiais, id_categoria_material) VALUES ("' . $_POST['input_mat_name'] . '",' . $_POST['tM'] . ')');
        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Material inserido com sucesso'
        ));
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Já existe um tipo de material com o nome inserido'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'showAreaResp') {
    echo json_encode($data = $connect->query('SELECT categorias_materiais.id, categorias_materiais.descricao_categoria FROM categorias_materiais JOIN responsaveis_area ON responsaveis_area.id_area_material = categorias_materiais.id WHERE responsaveis_area.id_responsavel_area = "' . $_POST['userId'] . '" ORDER BY categorias_materiais.descricao_categoria')->fetchAll());
} elseif (isset($_POST['action']) && $_POST['action'] == 'showItensPerCategoryAdmin') {
    $smt = $connect->query('SELECT categorias_materiais.id FROM categorias_materiais JOIN responsaveis_area ON responsaveis_area.id_area_material = categorias_materiais.id WHERE responsaveis_area.id_responsavel_area = "' . $_POST['userId'] . '" ORDER BY categorias_materiais.descricao_categoria LIMIT 1')->fetchColumn();
    echo json_encode($data = $connect->query('SELECT * FROM tipo_materiais WHERE id_categoria_material = ' . $smt . ' ORDER BY descricao_materiais')->fetchAll());
} elseif (isset($_POST['action']) && $_POST['action'] == 'addReqMatAdmin') {

    $resp = checkUser($_COOKIE['code'], unserialize($_COOKIE['authdata'], ["allowed_classes" => false]), $_POST['input_user_id'], $connect);

    if ($resp == '1') {

        $infog_id = $connect->query('SELECT * FROM materiais WHERE materiais.id_tipo = ' . $_POST['mT'] . ' AND materiais.id_estado = 1 AND materiais.id_status = 1 AND id not in (SELECT req_materiais.id_material FROM req_materiais JOIN materiais ON materiais.id = req_materiais.id_material WHERE materiais.id_tipo = ' . $_POST['mT'] . ' AND req_materiais.data = "' . $_POST['date'] . '") ORDER BY materiais.id LIMIT 1')->fetchColumn();

        if ($infog_id || $infog_id > 0) {
            try {
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $d = $connect->query('SELECT id from ano_letivo WHERE id_estado_ano_letivo = 2')->fetchColumn();

                $connect->query('INSERT INTO req_materiais (data, id_requisitante, id_material, id_ano_letivo) VALUES ("' . $_POST['date'] . '","' . $_POST['input_user_id'] . '",' . $infog_id . ',' . $d . ')');
                echo json_encode($return_arr[] = array(
                    "status" => '2',
                    "message" => 'Requisição realizada com sucesso'
                ));
            } catch (PDOException $e) {
                echo json_encode($return_arr[] = array(
                    "status" => '2',
                    "message" => $e->getMessage()
                ));
            }
        } else echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'Nenhum material disponível'
        ));
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => $resp
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'addReqCaciAdmin') {
    $sql = (isset($_POST['input_parceiro_id']) && !empty($_POST['input_parceiro_id'])) ? 'SELECT COUNT(*) FROM req_cacifos WHERE (req_cacifos.id_requisitante = "' . $_POST['input_user_id'] . '" OR req_cacifos.id_parceiro = "' . $_POST['input_user_id'] . '" OR req_cacifos.id_requisitante = "' . $_POST['input_parceiro_id'] . '" OR req_cacifos.id_parceiro = "' . $_POST['input_parceiro_id'] . '") AND req_cacifos.id_estado_req_cacifo = 1' : 'SELECT COUNT(*) FROM req_cacifos WHERE (req_cacifos.id_requisitante = "' . $_POST['input_user_id'] . '" OR req_cacifos.id_parceiro = "' . $_POST['input_user_id'] . '") AND req_cacifos.id_estado_req_cacifo = 1';

    $b = $connect->query($sql);

    if ($b->fetchColumn() == 0) {

        if (isset($_POST['input_parceiro_id']) && !empty($_POST['input_parceiro_id'])) {
            $resp = checkUser($_COOKIE['code'], unserialize($_COOKIE['authdata'], ["allowed_classes" => false]), $_POST['input_user_id'], $connect);

            if ($resp == '1') {

                $resp2 = checkUser($_COOKIE['code'], unserialize($_COOKIE['authdata'], ["allowed_classes" => false]), $_POST['input_parceiro_id'], $connect);

                if ($resp2 == '1') {
                    try {
                        $d = $connect->query('SELECT id from ano_letivo WHERE id_estado_ano_letivo = 2')->fetchColumn();

                        $c = $connect->query('SELECT cacifos.id FROM cacifos WHERE cacifos.id_piso = ' . $_POST['sort'] . ' AND cacifos.id_estado_cacifo = 1 AND cacifos.id_status = 1 ORDER BY cacifos.id LIMIT 1')->fetch();

                        $sql = (isset($_POST['input_parceiro_id']) && !empty($_POST['input_parceiro_id'])) ? 'INSERT INTO req_cacifos (data, id_requisitante, id_parceiro, id_cacifo, id_ano_letivo) VALUES ("' . $_POST['date'] . '","' . $_POST['input_user_id'] . '","' . $_POST['input_parceiro_id'] . '",' . $c['id'] . ',' . $d . ' )' : 'INSERT INTO req_cacifos (data, id_requisitante, id_cacifo, id_ano_letivo) VALUES ("' . $_POST['date'] . '","' . $_POST['input_user_id'] . '",' . $c['id'] . ',' . $d . ' )';

                        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $connect->exec($sql);

                        $connect->query("UPDATE cacifos set id_estado_cacifo = 2 WHERE id = " . $c['id'])->execute();

                        echo json_encode($return_arr[] = array(
                            "status" => '1',
                            "message" => 'Requisição inserida com sucesso'
                        ));
                    } catch (PDOException $e) {
                        echo json_encode($return_arr[] = array(
                            "status" => '2',
                            "message" => $e->getMessage()
                        ));
                    }
                } else echo json_encode($return_arr[] = array(
                    "status" => '2',
                    "message" => 'Utilizador ' . $_POST['input_parceiro_id'] . ' não encontrado'
                ));
            } else echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => 'Utilizador ' . $_POST['input_user_id'] . ' não encontrado'
            ));
        } else {
            $resp = checkUser($_COOKIE['code'], unserialize($_COOKIE['authdata'], ["allowed_classes" => false]), $_POST['input_user_id'], $connect);

            if ($resp == '1') {
                try {
                    $d = $connect->query('SELECT id from ano_letivo WHERE id_estado_ano_letivo = 2')->fetchColumn();

                    $c = $connect->query('SELECT cacifos.id FROM cacifos WHERE cacifos.id_piso = ' . $_POST['sort'] . ' AND cacifos.id_estado_cacifo = 1 AND cacifos.id_status = 1 ORDER BY cacifos.id LIMIT 1')->fetch();

                    $sql = (isset($_POST['input_parceiro_id']) && !empty($_POST['input_parceiro_id'])) ? 'INSERT INTO req_cacifos (data, id_requisitante, id_parceiro, id_cacifo, id_ano_letivo) VALUES ("' . $_POST['date'] . '","' . $_POST['input_user_id'] . '","' . $_POST['input_parceiro_id'] . '",' . $c['id'] . ',' . $d . ' )' : 'INSERT INTO req_cacifos (data, id_requisitante, id_cacifo, id_ano_letivo) VALUES ("' . $_POST['date'] . '","' . $_POST['input_user_id'] . '",' . $c['id'] . ',' . $d . ' )';

                    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $connect->exec($sql);

                    $connect->query("UPDATE cacifos set id_estado_cacifo = 2 WHERE id = " . $c['id'])->execute();

                    echo json_encode($return_arr[] = array(
                        "status" => '1',
                        "message" => 'Requisição inserida com sucesso'
                    ));
                } catch (PDOException $e) {
                    echo json_encode($return_arr[] = array(
                        "status" => '2',
                        "message" => $e->getMessage()
                    ));
                }
            } else echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => 'Utilizador ' . $_POST['input_user_id'] . ' não encontrado'
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Cada aluno apenas pode possuir um cacifo!'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'showRespMat') {
    $column = array('id', 'id_responsavel_area', 'nome_user', 'descricao_categoria');

    $query = 'SELECT responsaveis_area.id, responsaveis_area.id_responsavel_area, users.nome_user, categorias_materiais.descricao_categoria FROM responsaveis_area 
                    JOIN categorias_materiais ON responsaveis_area.id_area_material = categorias_materiais.id 
                    JOIN users ON users.id = responsaveis_area.id_responsavel_area';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (responsaveis_area.id_responsavel_area LIKE "%' . $_POST['search']['value'] . '%" OR users.nome_user LIKE "%' . $_POST['search']['value'] . '%" OR categorias_materiais.descricao_categoria LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->prepare($query);
    $result->execute();

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_resp_mat($connect),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'deleteResp') {
    try {
        // Passagem de estado da Requisição
        $connect->query('DELETE FROM responsaveis_area WHERE id = ' . $_POST['respId']);

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Responsável eliminado com sucesso'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'changeStatusMat') {

    $infog_id = $connect->query('SELECT * FROM req_materiais WHERE req_materiais.id_material = ' . $_POST['matId'] . ' AND req_materiais.id_estado_req = 1');

    if ($infog_id->rowCount() == 0) {
        try {
            $connect->query('UPDATE materiais set id_estado =' . $_POST['statusId'] . ' WHERE id =' . $_POST['matId']);

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Estado alterado com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Esse material encontra-se requisitado'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'changeStatusCaci') {

    $infog_id = $connect->query('SELECT id_estado_cacifo FROM cacifos where id =' . $_POST['caciId'])->fetchColumn();

    if ($infog_id != 2) {
        try {
            $connect->query('UPDATE cacifos SET id_estado_cacifo =' . $_POST['statusId'] . ' WHERE id =' . $_POST['caciId']);

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Estado alterado com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Esse material encontra-se requisitado'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'logout') {
    try {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        echo json_encode($return_arr[] = array(
            "status" => '1',
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'editTypeName') {
    try {
        $connect->query('UPDATE tipo_materiais set descricao_materiais = "' . $_POST['newName'] . '" WHERE id =' . $_POST['typeId']);

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Editado com sucesso'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'deletMatType') {

    $a = $connect->query('SELECT * FROM req_materiais JOIN materiais ON materiais.id = req_materiais.id_material JOIN tipo_materiais ON tipo_materiais.id = materiais.id_tipo WHERE materiais.id_tipo = ' . $_POST['matTyId'] . ' AND req_materiais.id_estado_req = 1');

    if ($a->rowCount() == 0) {

        $b = $connect->query('SELECT COUNT(*) FROM materiais WHERE id_tipo = ' . $_POST['matTyId'] . ' AND id_status = 1')->fetchColumn();

        if ($b == 0) {
            try {
                $connect->query('DELETE FROM tipo_materiais WHERE id =' . $_POST['matTyId']);
                echo json_encode($return_arr[] = array(
                    "status" => '1',
                    "message" => 'Tipo de material eliminado com sucesso'
                ));
            } catch (PDOException $e) {
                echo json_encode($return_arr[] = array(
                    "status" => '2',
                    "message" => $e->getMessage()
                ));
            }
        } else echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'Não pode tentar eliminar este tipo de material pois tem materiais ativos'
        ));
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Não pode tentar eliminar este tipo de material pois tem requisições ativas'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'makeStats') {
    $a = $connect->query('SELECT * FROM req_materiais JOIN materiais ON materiais.id = req_materiais.id_material JOIN tipo_materiais ON tipo_materiais.id = materiais.id_tipo WHERE req_materiais.data BETWEEN "' . $_POST['dataStart'] . '" AND "' . $_POST['dataEnd'] . '" AND tipo_materiais.id_categoria_material = ' . $_POST['aM']);

    if ($a->rowCount() > 0) {
        $descri = $count = '';

        $b = $connect->query('SELECT descricao_materiais, count(id_req) as cnt from
                                tipo_materiais left join 
                                    (SELECT req.id as id_req, req.data, req.id_requisitante, req.id_material, mat.id_tipo
                                        FROM req_materiais as req JOIN materiais as mat ON req.id_material = mat.id) AS requisicoes
                                        ON tipo_materiais.id = requisicoes.id_tipo
                                        WHERE id_categoria_material = ' . $_POST['aM'] . ' AND (`data` IS NULL OR `data` BETWEEN "' . $_POST['dataStart'] . '" AND "' . $_POST['dataEnd'] . '")
                                        GROUP BY descricao_materiais
                                        ORDER BY descricao_materiais');


        while ($row = $b->fetch(PDO::FETCH_ASSOC)) {
            $descri .= '"' . $row['descricao_materiais'] . '",';
            $count .= '"' . $row['cnt'] . '",';
        }

        $descri = substr($descri, 0, -1);
        $count = substr($count, 0, -1);

        echo ('<canvas id = "graph" width="900" height="600" data-settings = \'{
        "type": "bar",
        "data": {
            "labels": [' . $descri . '],
            "datasets": [{
                "label": "Requisitados",
                "backgroundColor": "#6c757d",
                "borderColor": "#6c757d",
                "data": [' . $count . ']
            }]
        },
        "options":{
            "responsive": true,
            "legend":{
                "display": true
            }
        }
    }\'></canvas>');
    } else echo ('<div class="alert alert-dark" role="alert">Nada para mostrar!</div>');
} elseif (isset($_POST['action']) && $_POST['action'] == 'sendEmailMat') {
    try {
        $userInfo = $connect->query('SELECT u.* FROM users as u WHERE u.id = "' . $_POST['userId'] . '"')->fetch();
        $matInfo = $connect->query('SELECT tipo_materiais.descricao_materiais, materiais.id_proprio, categorias_materiais.descricao_categoria FROM materiais JOIN tipo_materiais ON materiais.id_tipo = tipo_materiais.id JOIN categorias_materiais ON categorias_materiais.id = tipo_materiais.id_categoria_material WHERE materiais.id = ' . $_POST['info_id'])->fetch();

        $a = $connect->query('SELECT users.email_user FROM users JOIN responsaveis_area ON responsaveis_area.id_responsavel_area = users.id JOIN categorias_materiais ON categorias_materiais.id = responsaveis_area.id_area_material JOIN tipo_materiais ON tipo_materiais.id_categoria_material = categorias_materiais.id WHERE tipo_materiais.id = ' . $_POST['tM']);
        foreach ($a as $row) {
            sendEmail($row['email_user'], 'Nova Requisição realizada', 'O/A aluno/a <b>' . $userInfo['id'] . ' - ' . $userInfo['nome_user'] . '</b> da <b>Turma - ' . $userInfo['user_departamento'] . '</b> realizou uma requisição de um/a <b>' . $matInfo['descricao_materiais'] . ' - Número ' . $matInfo['id_proprio'] . '</b> pertencente há área da/o <b>' . $matInfo['descricao_categoria'] . '</b> tendo como data de requisição o dia <b>' . $_POST['date'] . '</b>.', $_POST['action'], '');
        }

        echo '1';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'sendEmailCaci') {
    try {
        $userInfo = $connect->query('SELECT u.* FROM users as u WHERE u.id = "' . $_POST['userId'] . '"')->fetch();
        $caciInfo = $connect->query('SELECT cacifo_piso.id, cacifo_piso.descricao_cacifo_piso, cacifos.id_proprio FROM cacifos JOIN cacifo_piso ON cacifo_piso.id = cacifos.id_piso WHERE cacifos.id = ' . $_POST['nC'])->fetch();

        $message = (isset($_POST['pC']) && $_POST['pC'] != 0) ? 'O/A aluno/a <b>' . $userInfo['id'] . ' - ' . $userInfo['nome_user'] . '</b> da <b>Turma - ' . $userInfo['user_departamento'] . '</b> realizou uma requisição do cacifo pertecente ao piso <b>' . $caciInfo['descricao_cacifo_piso'] . '</b> sendo o número <b>' . $caciInfo['id_proprio'] . '</b> com o parceiro de número <b>' . $_POST['pC'] . '</b> tendo como data de requisição o dia <b>' . $_POST['date'] . '</b>.' : 'O/A aluno/a <b>' . $userInfo['id'] . ' - ' . $userInfo['nome_user'] . '</b> da <b>Turma - ' . $userInfo['user_departamento'] . '</b> realizou uma requisição do cacifo pertecente ao piso <b>' . $caciInfo['descricao_cacifo_piso'] . '</b> sendo o número <b>' . $caciInfo['id_proprio'] . '</b> tendo como data de requisição o dia <b>' . $_POST['date'] . '</b>.';

        $a = $connect->query('SELECT users.email_user FROM users JOIN responsaveis_cacifos ON responsaveis_cacifos.id_responsavel = users.id WHERE responsaveis_cacifos.id_piso = ' . $caciInfo['id']);
        foreach ($a as $row) {
            sendEmail($row['email_user'], 'Nova Requisição realizada', $message, $_POST['action'], '');
        }

        echo '1';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'addResp') {
    if (!preg_match('~[0-9]+~', $_POST['input_user_id'])) {
        $resp = checkUser($_COOKIE['code'], unserialize($_COOKIE['authdata'], ["allowed_classes" => false]), $_POST['input_user_id'], $connect);
        if ($resp == 1) {
            $a = $connect->query('SELECT * FROM responsaveis_area WHERE id_responsavel_area = "' . $_POST['input_user_id'] . '" AND id_area_material = ' . $_POST['sort']);

            if ($a->rowCount() == 0) {
                try {
                    $connect->query('INSERT INTO responsaveis_area (id_responsavel_area, id_area_material) VALUES ("' . $_POST['input_user_id'] . '",' . $_POST['sort'] . ')');

                    echo json_encode($return_arr[] = array(
                        "status" => '1',
                        "message" => 'Responsável adicionado com sucesso'
                    ));
                } catch (PDOException $e) {
                    echo json_encode($return_arr[] = array(
                        "status" => '2',
                        "message" => $e->getMessage()
                    ));
                }
            } else echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => 'A pessoa em questão já é responsável pela área selecionada'
            ));
        } else echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'Utilizador não encontrado'
        ));
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Alunos não podem ser responsáveis!'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'showRespCaci') {
    $column = array('id', 'id_responsavel', 'nome_user', 'descricao_cacifo_piso');

    $query = 'SELECT responsaveis_cacifos.id, responsaveis_cacifos.id_responsavel, users.nome_user, cacifo_piso.descricao_cacifo_piso FROM responsaveis_cacifos 
                    JOIN cacifo_piso ON responsaveis_cacifos.id_piso = cacifo_piso.id 
                    JOIN users ON users.id = responsaveis_cacifos.id_responsavel';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (responsaveis_cacifos.id_responsavel LIKE "%' . $_POST['search']['value'] . '%" OR users.nome_user LIKE "%' . $_POST['search']['value'] . '%" OR cacifo_piso.descricao_cacifo_piso LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->prepare($query);
    $result->execute();

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_resp_caci($connect),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'deleteRespCaci') {
    try {
        // Passagem de estado da Requisição
        $connect->query('DELETE FROM responsaveis_cacifos WHERE id = ' . $_POST['respId']);

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Responsável eliminado com sucesso'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'addRespCaci') {
    if (!preg_match('~[0-9]+~', $_POST['input_userCaci_id'])) {
        $resp = checkUser($_COOKIE['code'], unserialize($_COOKIE['authdata'], ["allowed_classes" => false]), $_POST['input_userCaci_id'], $connect);
        if ($resp == 1) {
            $a = $connect->query('SELECT * FROM responsaveis_cacifos WHERE id_responsavel = "' . $_POST['input_userCaci_id'] . '" AND id_piso = ' . $_POST['sortP']);

            if ($a->rowCount() == 0) {
                try {
                    $connect->query('INSERT INTO responsaveis_cacifos (id_responsavel, id_piso) VALUES ("' . $_POST['input_userCaci_id'] . '",' . $_POST['sortP'] . ')');

                    echo '1';
                } catch (PDOException $e) {
                    echo json_encode($return_arr[] = array(
                        "status" => '2',
                        "message" => $e->getMessage()
                    ));
                }
            } else echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => 'A pessoa em questão já é responsável pela área selecionada'
            ));
        } else echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'Utilizador não encontrado'
        ));
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Alunos não podem ser responsáveis!'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'showAllPisos') {
    echo json_encode($data = $connect->query('SELECT * FROM `cacifo_piso` WHERE 1 ORDER BY descricao_cacifo_piso')->fetchAll());
} elseif (isset($_POST['action']) && $_POST['action'] == 'showMatAreas') {
    $column = array('id', 'descricao_categoria');

    $query = 'SELECT * FROM `categorias_materiais`';

    if (!empty($_POST['search']['value'])) {
        $query .= 'descricao_categoria LIKE "%' . $_POST['search']['value'] . '%"';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->prepare($query);
    $result->execute();

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_mat_area($connect),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'addMatArea') {
    if (!empty($_POST['areaName'])) {
        try {
            $connect->query('INSERT INTO `categorias_materiais`(`descricao_categoria`) VALUES ("' . $_POST['areaName'] . '")');

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Área criada com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Deve dar um nome para a área'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'deleteMatArea') {
    $a = $connect->query('SELECT * FROM req_materiais JOIN materiais ON materiais.id = req_materiais.id_material JOIN tipo_materiais ON tipo_materiais.id = materiais.id_tipo WHERE tipo_materiais.id_categoria_material = ' . $_POST['matAreaId'] . ' AND req_materiais.id_estado_req = 1');

    if ($a->rowCount() == 0) {
        $b = $connect->query('SELECT * FROM materiais JOIN tipo_materiais ON tipo_materiais.id = materiais.id_tipo WHERE tipo_materiais.id = ' . $_POST['matAreaId'] . ' AND materiais.id_estado = 1 AND materiais.id_status = 1');

        if ($b->rowCount() == 0) {
            $c = $connect->query('SELECT * FROM responsaveis_area WHERE id_area_material = ' . $_POST['matAreaId']);

            if ($c->rowCount() == 0) {
                try {
                    $connect->query('DELETE FROM categorias_materiais WHERE id = ' . $_POST['matAreaId']);
                    echo json_encode($return_arr[] = array(
                        "status" => '1',
                        "message" => 'Área eliminada com sucesso'
                    ));
                } catch (PDOException $e) {
                    echo json_encode($return_arr[] = array(
                        "status" => '2',
                        "message" => $e->getMessage()
                    ));
                }
            } else echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => 'Não pode eliminar uma área com responsáveis'
            ));
        } else echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'Não pode eliminar esta área pois possui materiais registados'
        ));
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Não pode eliminar esta área pois existem requisições ativas'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'editMatArea') {
    if (!empty($_POST['areaName'])) {
        try {
            $connect->query('UPDATE categorias_materiais SET descricao_categoria = "' . $_POST['areaName'] . '" WHERE id = ' . $_POST['matAreaId']);

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Área editada com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Deve dar um nome para a área'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'showPisoCaci') {
    $column = array('id', 'descricao_cacifo_piso');

    $query = 'SELECT * FROM cacifo_piso';

    if (!empty($_POST['search']['value'])) {
        $query .= ' WHERE cacifo_piso.descricao_cacifo_piso LIKE "%' . $_POST['search']['value'] . '%"';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->prepare($query);
    $result->execute();

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_caci_piso($connect),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'addPisoCaci') {
    if (!empty($_POST['pisoName'])) {
        try {
            $connect->query('INSERT INTO `cacifo_piso`(`descricao_cacifo_piso`) VALUES ("' . $_POST['pisoName'] . '")');

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Piso criado com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Deve dar um nome para o piso'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'editPisoCaci') {
    if (!empty($_POST['pisoName'])) {
        try {
            $connect->query('UPDATE cacifo_piso SET descricao_cacifo_piso = "' . $_POST['pisoName'] . '" WHERE id = ' . $_POST['pisoCaciId']);

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Piso alterado com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Deve dar um nome para o piso'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'deletePisoCaci') {

    $a = $connect->query('SELECT * FROM req_cacifos JOIN cacifos ON cacifos.id = req_cacifos.id_cacifo WHERE cacifos.id_piso = ' . $_POST['pisoCaciId'] . ' AND req_cacifos.id_estado_req_cacifo = 1');

    if ($a->rowCount() == 0) {
        $b = $connect->query('SELECT * FROM cacifos WHERE cacifos.id_piso = ' . $_POST['pisoCaciId'] . ' AND cacifos.id_estado_cacifo = 1 AND cacifos.id_status = 1');

        if ($b->rowCount() == 0) {
            $c = $connect->query('SELECT * FROM responsaveis_cacifos WHERE id_piso = ' . $_POST['pisoCaciId']);

            if ($c->rowCount() == 0) {
                try {
                    $connect->query('DELETE FROM cacifo_piso WHERE id = ' . $_POST['pisoCaciId']);

                    echo json_encode($return_arr[] = array(
                        "status" => '1',
                        "message" =>  'Piso eliminada com sucesso'
                    ));
                } catch (PDOException $e) {
                    echo json_encode($return_arr[] = array(
                        "status" => '2',
                        "message" => $e->getMessage()
                    ));
                }
            } else echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => 'Não pode eliminar uma área com responsáveis'
            ));
        } else echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'Não pode eliminar este piso pois possui cacifos registados'
        ));
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Não pode eliminar este piso pois existem requisições ativas'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'showRespSite') {
    $column = array('id', 'nome_user', 'email_user');

    $query = 'SELECT responsaveis_site.id, users.nome_user, users.email_user FROM responsaveis_site JOIN users ON users.id = responsaveis_site.id_responsavel_site';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (users.nome_user LIKE "%' . $_POST['search']['value'] . '%" OR users.email_user LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->prepare($query);
    $result->execute();

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_resp_site($connect),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'addRespSite') {
    if (!preg_match('~[0-9]+~', $_POST['respId'])) {
        $resp = checkUser($_COOKIE['code'], unserialize($_COOKIE['authdata'], ["allowed_classes" => false]), $_POST['respId'], $connect);
        if ($resp == 1) {
            $a = $connect->query('SELECT * FROM responsaveis_site WHERE id_responsavel_site = "' . $_POST['respId'] . '"');

            if ($a->rowCount() == 0) {
                try {
                    $connect->query('INSERT INTO responsaveis_site (id_responsavel_site) VALUES("' . $_POST['respId'] . '")');

                    echo json_encode($return_arr[] = array(
                        "status" => '1',
                        "message" => 'Responsável inserido com sucesso'
                    ));
                } catch (PDOException $e) {
                    echo json_encode($return_arr[] = array(
                        "status" => '2',
                        "message" => $e->getMessage()
                    ));
                }
            } else echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => 'A pessoa em questão já é responsável pela área selecionada'
            ));
        } else echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'Utilizador não encontrado'
        ));
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Alunos não podem ser responsáveis!'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'deleteRespSite') {
    try {
        $connect->query('DELETE FROM responsaveis_site WHERE id = "' . $_POST['respId'] . '"');

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Responsável eliminada com sucesso'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'showClassAcess') {
    $column = array('id', 'descricao_nome_turma');

    $query = 'SELECT `id`, `descricao_nome_turma` FROM `turmas_acesso` WHERE 1';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (id LIKE "%' . $_POST['search']['value'] . '%" OR descricao_nome_turma LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->prepare($query);
    $result->execute();

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_caci_class_acess($connect),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'deleteAcessClass') {
    try {
        $connect->query('DELETE FROM turmas_acesso WHERE id = "' . $_POST['accesspId'] . '"');

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Acesso retirado com sucesso'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'addClassAccess') {
    if (!empty($_POST['className'])) {
        try {
            $connect->query('INSERT INTO turmas_acesso (descricao_nome_turma) VALUES ("' . strtoupper($_POST['className']) . '")');

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Acesso adicionado com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Deve inserir a sigla da Turma.'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'editClassAcess') {
    if (!empty($_POST['className'])) {
        try {
            $connect->query('UPDATE turmas_acesso SET descricao_nome_turma = "' . strtoupper($_POST['className']) . '" WHERE id = ' . $_POST['accessId']);

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Acesso editado com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Deve inserir a sigla da Turma.'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'loadFullCalendar') {

    $id = $date = $cnt = '';

    /* Número total de materiais de um certo tipo que podem ser requisitadas */
    $a = $connect->query('SELECT COUNT(*) FROM materiais WHERE materiais.id_tipo = ' . $_POST['typeMatId'] . ' AND materiais.id_estado = 1 AND materiais.id_status = 1')->fetchColumn();

    /* Datas + numero de requisicoes para aquele tipo de material */
    $result  = $connect->prepare('SELECT req_materiais.data , COUNT(req_materiais.id_material) AS cnt FROM req_materiais JOIN materiais ON materiais.id = req_materiais.id_material WHERE materiais.id_tipo = ' . $_POST['typeMatId'] . ' AND req_materiais.id_estado_req = 1 GROUP BY req_materiais.data');
    $result->execute();

    $eventos = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        $date = $row['data'];
        $cnt = $row['cnt'];

        if ($row['cnt'] == $a) {
            $eventos[] = ['title' => 'Indisponível', 'start' => $date, 'backgroundColor' => '#FF0000', 'borderColor' => '#FF0000', 'textColor' => '#FFFFFF'];
        }
    }

    echo json_encode($eventos);
} elseif (isset($_POST['action']) && $_POST['action'] == 'showLetivYear') {
    $column = array('id', 'descricao_ano_letivo', 'descricao_estado_ano_letivo');

    $query = 'SELECT ano_letivo.id, ano_letivo.descricao_ano_letivo, estados_ano_letivo.descricao_estado_ano_letivo FROM ano_letivo JOIN estados_ano_letivo ON estados_ano_letivo.id = ano_letivo.id_estado_ano_letivo';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (descricao_estado_ano_letivo LIKE "%' . $_POST['search']['value'] . '%" OR descricao_ano_letivo LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->prepare($query);
    $result->execute();

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_letiv_year($connect),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'activeLetivYear') {
    try {

        $a = $connect->query('SELECT ano_letivo.id, ano_letivo.descricao_ano_letivo FROM ano_letivo WHERE ano_letivo.id_estado_ano_letivo = 2')->fetch();

        $connect->query('UPDATE ano_letivo SET id_estado_ano_letivo = 1 WHERE id =' . $a['id']);

        $years = explode('/', $a['descricao_ano_letivo']);

        $connect->query('INSERT INTO ano_letivo (descricao_ano_letivo) VALUES ("' . ++$years[0] . '/' . ++$years[1] . '")');

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Ano-Letivo iniciado com sucesso'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'getStockMat') {

    try {
        $a = $connect->query('SELECT COUNT(materiais.id) FROM materiais WHERE materiais.id_tipo = ' . $_POST['typeId'])->fetchColumn();

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Possuí disponíveis: ' . $a
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'getRespMatNumber') {

    try {
        $a = $connect->query('SELECT COUNT(*) FROM `responsaveis_area` WHERE id_area_material = ' . $_POST['matAreaId'])->fetchColumn();

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Existem ' . $a . ' representantes'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'getRespCaciNumber') {
    try {
        $a = $connect->query('SELECT COUNT(*) FROM `responsaveis_cacifos` WHERE id_piso = ' . $_POST['pisoCaciId'])->fetchColumn();

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Existem ' . $a . ' representantes'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'showBuyArea') {
    echo json_encode($data = $connect->query('SELECT * FROM `areas_compras` ORDER BY descricao_area_compra')->fetchAll());
} elseif (isset($_POST['action']) && $_POST['action'] == 'showBuySetor') {
    echo json_encode($data = $connect->query('SELECT setores_compras.id, setores_compras.descricao_setor_compra FROM area_setor JOIN setores_compras ON setores_compras.id = area_setor.id_setor_compra JOIN areas_compras ON areas_compras.id = area_setor.id_area_compra WHERE id_area_compra = ' . $_POST['id_area_compra'] . ' ORDER BY setores_compras.descricao_setor_compra')->fetchAll());
} elseif (isset($_POST['action']) && $_POST['action'] == 'addReqBuy') {

    $data1 = new DateTime('now');
    $data2 = new DateTime($_POST['date']);
    $intervalo = $data1->diff($data2);
   
    if ($intervalo->days >= 15) {
        try {
            $pedido = array();

            for ($i = 0; $i < count($_POST['name']); ++$i) {
                array_push($pedido, array(
                    'name' => $_POST['name'][$i],
                    'quant' => $_POST['quant'][$i],
                    'obser' => $_POST['obser'][$i]
                ));
            }

            $d = $connect->query('SELECT id from ano_letivo WHERE id_estado_ano_letivo = 2')->fetchColumn();
            $nameUser = $connect->query('SELECT nome_user FROM users WHERE id = "' . $_POST['userId'] . '"')->fetchColumn();

            $subName = empty($_POST['dis']) ? '' : $_POST['nMod'] . 'º ' . $_POST['mod'];


            // Objeto json dos produtos pedidos
            $data = json_encode($pedido, JSON_UNESCAPED_UNICODE);

            $sql = (isset($_POST['mod']) && !empty($_POST['mod'])) ? 'INSERT INTO req_compras (turma, pedido, data_requerido, data_requisicao, disciplina, modulo, id_requisitante, id_area, id_setor, id_ano_letivo) VALUES ("' . $_POST['class'] . '", :config, "' . $_POST['date'] . '", "' . date("Y-m-d") . '","' . $_POST['dis'] . '", "' . $subName . '" ,"' . $_POST['userId'] . '",' . $_POST['aC'] . ',' . $_POST['sC'] . ',' . $d . ')' : 'INSERT INTO req_compras (atividade, turma, pedido, data_requerido, data_requisicao, id_requisitante, id_area, id_setor, id_ano_letivo) VALUES ("' . $_POST['ati'] . '","' . $_POST['class'] . '", :config, "' . $_POST['date'] . '", "' . date("Y-m-d") . '", "' . $_POST['userId'] . '",' . $_POST['aC'] . ',' . $_POST['sC'] . ',' . $d . ')';

            $stmt = $connect->prepare($sql);
            $stmt->bindParam(':config', $data, PDO::PARAM_STR);
            $stmt->execute();

            $reqNumber = $connect->lastInsertId();

            (isset($_POST['mod']) && !empty($_POST['mod'])) ? makeXLSX($_POST['class'], $pedido, $_POST['date'], $nameUser, $_POST['sC'], $_POST['dis'], $_POST['mod'], $_POST['nMod'], '', $reqNumber) : makeXLSX($_POST['class'], $pedido, $_POST['date'], $nameUser, $_POST['sC'], '', '', '', $_POST['ati'], $reqNumber);

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Requisição realizada com sucesso',
                "fileNumber" => $reqNumber,
                "userName" => $nameUser,
                "dateRequi" => date("Y-m-d"),
                "date" => $_POST['date'],
                "areaBuy" => $_POST['aC']
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'A requisição deve ser feita com pelo menos 15 dias de antecedência!'
        )); 
} elseif (isset($_POST['action']) && $_POST['action'] == 'sendEmailBuy') {
    try {

        $token = bin2hex(openssl_random_pseudo_bytes(16));
      
        sendEmail(
            'email of who accept or decline reqs',
            'Nova Requisição realizada',
            'O/A utilizador/a ' . $_POST['userName'] . ' realizou uma requisição de compra tendo sido realizada para o dia ' . $_POST['date'] .
            '.<p>Seguindo em anexo as informações que integram a dita requisição.</p><br><table>
          <tr>
            <td  align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#292c34; text-transform:uppercase; mso-padding-alt:12px 10px 10px; padding-right:5px; ">
              <a target="_blank" style="text-decoration:none; color:#ffffff; display:block; padding:12px 20px 10px;background-color:#4CAF50;border-radius:8px;" href="http://localhost/AdminLTE/agradecimentos.php?rI=' . $_POST['fileNumber'] . '&t=' . $token . '&d=1">Aprovar</a>
            </td>
        
        
            <td align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#292c34; text-transform:uppercase; mso-padding-alt:12px 10px 10px;padding-left: 5px;">
              <a target="_blank" style="background-color:#ED2939;text-decoration:none; color:#ffffff; display:block; padding:12px 20px 10px;border-radius:8px;" href="http://localhost/AdminLTE/agradecimentos.php?rI=' . $_POST['fileNumber'] . '&t=' . $token . '&d=2">Recusar</a>
            </td>
          </tr>
        </table>',
            $_POST['action'],
            $_POST['fileNumber']
        );
        
    
        $a = $connect->query('SELECT users.email_user FROM users JOIN responsaveis_compras ON responsaveis_compras.id_responsavel = users.id WHERE responsaveis_compras.id_area_compras = ' . $_POST['areaBuy']);
        foreach ($a as $row) {
            sendEmail($row['email_user'], 'Nova Requisição realizada', 'O/A utilizador/a ' . $_POST['userName'] . ' realizou uma requisição de compra tendo sido realizada para o ' . $_POST['date'], '', '');
        }

        $connect->query('INSERT INTO tokens_req (id_requisicao,token) VALUES (' . $_POST['fileNumber'] . ',"' . $token . '")');

        echo '1';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'deciSet') {
    try {
        if ($data = $connect->query('SELECT COUNT(*) FROM tokens_req WHERE id_requisicao = ' . $_POST['reqId'] . ' AND token = "' . $_POST['token'] . '" AND usado = 1')->fetchColumn() == 0) {
            try {
                $connect->query('UPDATE tokens_req SET usado = 1 WHERE id_requisicao =' . $_POST['reqId'] . '; UPDATE `req_compras` SET `data_decisao`= "' . date("Y-m-d") . '" ,`id_decisao` = ' . $_POST['deci'] . ' WHERE id = ' . $_POST['reqId']);

                reSaveXLSX($_POST['reqId'], $_POST['action'], 'Júlia Alfaiate');

                echo json_encode($return_arr[] = array(
                    "status" => '1'
                ));
            } catch (PDOException $e) {
                echo json_encode($return_arr[] = array(
                    "status" => '2',
                    "message" => $e->getMessage()
                ));
            }
        }
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'showReqAdminBuy') {
    $column = array('id', 'nome_user', 'data_requerido', 'descricao_area_compra', 'id_decisao', 'id_estado_req', 'descricao_setor_compra', 'descricao_decisao_req', 'atividade', 'disciplina', 'modulo', 'turma', 'data_decisão', 'data_devolver', 'data_requisicao', 'id_devolvedor', 'descricao_ano_letivo');

    $query = 'SELECT req_compras.id, users.nome_user, req_compras.data_requerido, areas_compras.descricao_area_compra, req_compras.id_decisao, req_compras.id_devolvedor, req_compras.id_estado_req, setores_compras.descricao_setor_compra, decisoes_req.descricao_decisao_req, req_compras.data_requisicao, req_compras.data_decisao, req_compras.atividade, req_compras.disciplina, req_compras.modulo, req_compras.turma, req_compras.data_devolver, ano_letivo.descricao_ano_letivo FROM req_compras JOIN users ON users.id = req_compras.id_requisitante JOIN areas_compras ON areas_compras.id = req_compras.id_area JOIN setores_compras ON setores_compras.id = req_compras.id_setor JOIN decisoes_req ON decisoes_req.id = req_compras.id_decisao JOIN responsaveis_compras ON responsaveis_compras.id_area_compras = areas_compras.id JOIN ano_letivo ON ano_letivo.id = req_compras.id_ano_letivo WHERE responsaveis_compras.id_responsavel =  "' . $_POST['userId'] . '"';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (req_compras.id LIKE "%' . $_POST['search']['value'] . '%" OR nome_user LIKE "%' . $_POST['search']['value'] . '%" OR descricao_area_compra LIKE "%' . $_POST['search']['value'] . '%" OR descricao_setor_compra LIKE "%' . $_POST['search']['value'] . '%" OR descricao_decisao_req LIKE "%' . $_POST['search']['value'] . '%" OR atividade LIKE "%' . $_POST['search']['value'] . '%" OR modulo LIKE "%' . $_POST['search']['value'] . '%" OR turma LIKE "%' . $_POST['search']['value'] . '%" OR req_compras.data_decisao LIKE "%' . $_POST['search']['value'] . '%" OR data_devolver LIKE "%' . $_POST['search']['value'] . '%" OR data_requerido LIKE "%' . $_POST['search']['value'] . '%" OR id_devolvedor LIKE "%' . $_POST['search']['value'] . '%" OR descricao_ano_letivo LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->prepare($query);
    $result->execute();

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_req_buy($connect, $_POST['userId']),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'downFile') {
    if (!empty($_POST['fileId'])) {
        $filepath = '../docs/reqs/Requisicao-' . $_POST['fileId'] . '.xlsx';

        if (file_exists($filepath)) {

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Download realizado com sucesso',
                "filePath" => $filepath
            ));
        } else {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => 'Ups! Algo correu mal'
            ));
        }
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'finishReqBuy') {
    $infog_id = $connect->query('SELECT `id_decisao` FROM `req_compras` WHERE id =' . $_POST['reqId'])->fetchColumn();

    if ($infog_id != 3) {
        $infog_id = $connect->query('SELECT `id_estado_req` FROM `req_compras` WHERE id =' . $_POST['reqId'])->fetchColumn();
        if ($infog_id == 1) {
            try {
                $connect->query('UPDATE req_compras SET id_estado_req = 2, id_devolvedor = "' . $_POST['userName'] . '", data_devolver = "' . date("Y-m-d") . '" WHERE id = ' . $_POST['reqId']);

                reSaveXLSX($_POST['reqId'], $_POST['action'], $_POST['userName']);

                echo json_encode($return_arr[] = array(
                    "status" => '1',
                    "message" => 'Requisição finalizada com sucesso'
                ));
            } catch (PDOException $e) {
                echo json_encode($return_arr[] = array(
                    "status" => '2',
                    "message" => $e->getMessage()
                ));
            }
        } else echo json_encode($return_arr[] = array(
            "status" => '2', "message" => 'Não pode tentar finalizar uma requisição já finalizada'
        ));
    } else echo json_encode($return_arr[] = array(
        "status" => '2', "message" => 'Não pode tentar finalizar uma requisição pendente'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'showRespCompras') {
    $column = array('id', 'id_responsavel', 'nome_user', 'descricao_area_compra');

    $query = 'SELECT responsaveis_compras.id, responsaveis_compras.id_responsavel, users.nome_user, areas_compras.descricao_area_compra FROM responsaveis_compras JOIN users ON users.id = responsaveis_compras.id_responsavel JOIN areas_compras ON areas_compras.id = responsaveis_compras.id_area_compras';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (responsaveis_compras.id_responsavel LIKE "%' . $_POST['search']['value'] . '%" OR users.nome_user LIKE "%' . $_POST['search']['value'] . '%" OR areas_compras.descricao_area_compra LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->prepare($query);
    $result->execute();

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_resp_buy($connect),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'deleteRespBuy') {
    try {
        $connect->query('DELETE FROM responsaveis_compras WHERE id = ' . $_POST['respId']);

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Responsável eliminado com sucesso'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'addRespBuy') {
    if (!preg_match('~[0-9]+~', $_POST['input_userBuy_id'])) {
        $resp = checkUser($_COOKIE['code'], unserialize($_COOKIE['authdata'], ["allowed_classes" => false]), $_POST['input_userBuy_id'], $connect);
        if ($resp == 1) {
            $a = $connect->query('SELECT * FROM responsaveis_compras WHERE id_responsavel = "' . $_POST['input_userBuy_id'] . '" AND id_area_compras =' . $_POST['sortB']);

            if ($a->rowCount() == 0) {
                try {
                    $connect->query('INSERT INTO responsaveis_compras (id_responsavel, id_area_compras) VALUES("' . $_POST['input_userBuy_id'] . '",' . $_POST['sortB'] . ')');

                    echo json_encode($return_arr[] = array(
                        "status" => '1',
                        "message" => 'Responsável inserido com sucesso'
                    ));
                } catch (PDOException $e) {
                    echo json_encode($return_arr[] = array(
                        "status" => '2',
                        "message" => $e->getMessage()
                    ));
                }
            } else echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => 'A pessoa em questão já é responsável pela área selecionada'
            ));
        } else echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'Utilizador não encontrado'
        ));
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Alunos não podem ser responsáveis!'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'showBuySetors') {
    echo json_encode($data = $connect->query('SELECT * from setores_compras ORDER BY descricao_setor_compra')->fetchAll());
} elseif (isset($_POST['action']) && $_POST['action'] == 'addAreaSetor') {
    try {
        if ($a = $connect->query('SELECT COUNT(*) FROM area_setor WHERE id_area_compra = ' . $_POST['sortBA'] . ' AND id_setor_compra= ' . $_POST['sortBS'])->fetchColumn() == 0) {

            $connect->query('INSERT INTO area_setor(id_area_compra,id_setor_compra) VALUES (' . $_POST['sortBA'] . ',' . $_POST['sortBS'] . ')');

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'União criada com sucesso'
            ));
        } else echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'Essa união já existe.'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'showAreasBuy') {
    $column = array('id', 'descricao_area_compra', 'descricao_setor_compra');

    $query = 'SELECT area_setor.id, areas_compras.descricao_area_compra, setores_compras.descricao_setor_compra FROM area_setor JOIN setores_compras ON setores_compras.id = area_setor.id_setor_compra JOIN areas_compras ON areas_compras.id = area_setor.id_area_compra';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (areas_compras.descricao_area_compra LIKE "%' . $_POST['search']['value'] . '%" OR setores_compras.descricao_setor_compra LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->prepare($query);
    $result->execute();

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_area_setor($connect),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'deleteAreaSetor') {
    try {
        $connect->query('DELETE FROM area_setor WHERE id =' . $_POST['id_area_setor']);

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'União eliminada com sucesso'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'showBA') {
    $column = array('id', 'descricao_area_compra');

    $query = 'SELECT * FROM `areas_compras`';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (areas_compras.descricao_area_compra LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->prepare($query);
    $result->execute();

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_area_buy($connect),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
} elseif (isset($_POST['action']) && $_POST['action'] == 'addBuyArea') {
    if (!empty($_POST['areaName'])) {
        try {
            $connect->query('INSERT INTO areas_compras (`descricao_area_compra`) VALUES ("' . $_POST['areaName'] . '")');

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Área criada com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Deve dar um nome para a área'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'editAreaBuy') {
    if (!empty($_POST['areaName'])) {
        try {
            $connect->query('UPDATE areas_compras SET descricao_area_compra = "' . $_POST['areaName'] . '" WHERE id = ' . $_POST['areaId']);

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Área alterada com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'Deve dar um nome para a área'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'getRespAreaNumber') {
    try {
        $a = $connect->query('SELECT COUNT(*) FROM `responsaveis_compras` WHERE id_area_compras = ' . $_POST['areaId'])->fetchColumn();

        echo json_encode($return_arr[] = array(
            "status" => '1',
            "message" => 'Existem ' . $a . ' representantes'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'deleteAreaBuy') {
    try {
        $a = $connect->query('SELECT COUNT(*) FROM req_compras WHERE id_area =' . $_POST['areaId'] . ' AND id_estado_req = 1')->fetchColumn();

        if ($a == 0) {

            $b = $connect->query('SELECT COUNT(*) FROM responsaveis_compras WHERE id_area_compras = ' . $_POST['areaId'])->fetchColumn();
            if ($b == 0) {
                $connect->query('DELETE FROM areas_compras WHERE id =' . $_POST['areaId']);

                echo json_encode($return_arr[] = array(
                    "status" => '1',
                    "message" => 'Área eliminada com sucesso'
                ));
            } else echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => 'Não pode eliminar esta área pois tem responsáveis'
            ));
        } else echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => 'Não pode eliminar esta área pois tem requisições ativas'
        ));
    } catch (PDOException $e) {
        echo json_encode($return_arr[] = array(
            "status" => '2',
            "message" => $e->getMessage()
        ));
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'reSaveFile') {
    $filepath = '../docs/reqs/Requisicao-' . $_POST['fileId'] . '.xlsx';

    if (file_exists($filepath)) {
        try {
            $row = $connect->query('SELECT req_compras.turma, req_compras.pedido, req_compras.data_requerido, req_compras.data_requisicao, req_compras.data_decisao, req_compras.data_decisao,req_compras.data_devolver, req_compras.atividade, req_compras.id_setor, req_compras.id_devolvedor, req_compras.id_decisao, users.nome_user, req_compras.disciplina, req_compras.modulo FROM req_compras JOIN users ON users.id = req_compras.id_requisitante WHERE req_compras.id = ' . $_POST['fileId'])->fetchAll();

            $nMod = empty($row[0]['disciplina']) ? '' : explode('º ', trim($row[0]['modulo']))[0];
            $modulo = empty($row[0]['disciplina']) ? '' : explode('º ', trim($row[0]['modulo']))[1];

            reMakeXLSX($_POST['fileId'], $row[0]['turma'], json_decode($row[0]['pedido'], true), $row[0]['data_requerido'], $row[0]['data_requisicao'], $row[0]['data_decisao'], $row[0]['data_devolver'], $row[0]['atividade'], $row[0]['id_setor'], $row[0]['id_devolvedor'], $row[0]['nome_user'], $nMod, $modulo, $row[0]['disciplina'], $row[0]['id_decisao']);

            echo json_encode($return_arr[] = array(
                "status" => '1',
                "message" => 'Ficheiro salvo com sucesso'
            ));
        } catch (PDOException $e) {
            echo json_encode($return_arr[] = array(
                "status" => '2',
                "message" => $e->getMessage()
            ));
        }
    } else echo json_encode($return_arr[] = array(
        "status" => '2',
        "message" => 'O ficheiro dessa requisição não existe'
    ));
} elseif (isset($_POST['action']) && $_POST['action'] == 'showReqUserBuy') {
    $column = array('id', 'data_requerido', 'data_requisicao', 'descricao_decisao_req', 'descricao_ano_letivo', 'id_decisao');

    $query = 'SELECT req_compras.id,req_compras.data_requerido,req_compras.data_requisicao, req_compras.id_decisao,decisoes_req.descricao_decisao_req,ano_letivo.descricao_ano_letivo FROM req_compras JOIN decisoes_req ON decisoes_req.id = req_compras.id_decisao JOIN ano_letivo ON ano_letivo.id = req_compras.id_ano_letivo WHERE req_compras.id_requisitante = "' . $_POST['userId'] . '"';

    if (!empty($_POST['search']['value'])) {
        $query .= ' AND (req_compras.id LIKE "%' . $_POST['search']['value'] . '%" OR req_compras.data_requerido LIKE "%' . $_POST['search']['value'] . '%"  OR req_compras.data_requisicao LIKE "%' . $_POST['search']['value'] . '%" OR decisoes_req.descricao_decisao_req LIKE "%' . $_POST['search']['value'] . '%" OR ano_letivo.descricao_ano_letivo LIKE "%' . $_POST['search']['value'] . '%")';
    }

    if (isset($_POST['order'])) {
        $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' LIMIT ' . $_POST['start'] . ' ,' . $_POST['length'] . '  ';
    }

    $result = $connect->prepare($query);
    $result->execute();

    $output = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $result->rowCount(),
        "recordsFiltered" => count_all_req_user_buy($connect, $_POST['userId']),
        "data" => $result->fetchAll(PDO::FETCH_ASSOC)
    );
    echo json_encode($output, JSON_UNESCAPED_UNICODE);

    unset($output);
}


$connect = null;
