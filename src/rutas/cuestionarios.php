<?php
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    // INICO GET
$app->get('/api/cuestionarios', function(REQUEST $request, RESPONSE $response){

    $query = "SELECT * FROM cuestionario";

    try {

        // instanciar bd
        $db = new db();
        // conectar
        $db = $db->conectar();
        // mandar el query
        $consulta = $db->query($query);

        if ($consulta->rowCount() > 0) {
            // guardamos los datos para mostrar
            $emociones = $consulta->fetchAll(PDO::FETCH_OBJ);
            // mostrar la consulta
            echo json_encode($emociones);
        } else {
            echo json_encode ('No existe ningun cuestionario');
        }

        $consulta = null;
        $db = null;
    } catch(PDOException $e) {
        '{"error": {"text":'.$e->getMessage().'}';
    }
});
// FINAL GET

// *** INICIO POST
$app->post('/api/cuestionarios/post', function(Request $request, Response $response) {

    // crear varibles a incertar
    $usuario_idUsuario = $request->getParam('usuario_idUsuario');
    $cuestionarioPParte = $request->getParam('cuestionarioPParte');
    $cuestionarioFecha = $request->getParam('cuestionarioFecha');

    $query = "INSERT INTO cuestionario (usuario_idUsuario, cuestionarioPParte,cuestionarioFecha) VALUES (:usuario_idUsuario, :cuestionarioPParte, :cuestionarioFecha)";


    try {
        // intanciar la bd
        $db = new db();

        // conectamos 
        $db = $db->conectar();
        // mandamos el query
        $consulta = $db->prepare($query);

        // preparamos los datos
        $consulta->bindParam(':usuario_idUsuario', $usuario_idUsuario);
        $consulta->bindParam(':cuestionarioPParte', $cuestionarioPParte);
        $consulta->bindParam(':cuestionarioFecha', $cuestionarioFecha);

        // ejecutamos la consulta
        $consulta->execute();

        echo json_encode('cuestionario Guardado');

        // seteamos a null para cerrar conexion
        $ejecutar = null; 
        $db = null;

    } catch (PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// *** INICIO POST

// *** INICIO PUT
$app->put('/api/cuestionarios/post/{id}/{cuestionarioFecha}', function(Request $request, Response $response) {

    $usuario_idUsuario = $request->getAttribute('id');
    $cuestionarioFecha = $request->getAttribute('cuestionarioFecha');
    // crear varibles a incertar
    $cuestionarioSPartel = $request->getParam('cuestionarioSPartel');

    $query = "UPDATE cuestionario SET
              cuestionarioSPartel = :cuestionarioSPartel
              WHERE usuario_idUsuario = $usuario_idUsuario
              and cuestionarioFecha = $cuestionarioFecha";

    try {
        // intanciar la bd
        $db = new db();

        // conectamos 
        $db = $db->conectar();
        // mandamos el query
        $consulta = $db->prepare($query);

        // preparamos los datos
        $consulta->bindParam(':cuestionarioSPartel', $cuestionarioSPartel);

        // ejecutamos la consulta
        $consulta->execute();

        echo json_encode('cuestionario Modificado');

        // seteamos a null para cerrar conexion
        $ejecutar = null; 
        $db = null;

    } catch (PDOException $e) {
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
// *** FINAL PUT


?>