<?php

/**
* Implements hook_drush_command().
*/
function general_config_drush_command() {
  // Comando para poner a 0 los goles de los jugadores.
  $commands['reiniciar-goles-jugadores'] = array(
    'description' => 'Reinicia los goles de todos los jugadores.',
    'aliases' => array('rgj'),
  );
  // Comando para asignar porteros.
  $commands['asignar-porteros'] = array(
    'description' => 'Asigna porteros ya que devel solo genera jugadores con el primer término (delantero).',
    'aliases' => array('ap'),
  );
  // Comando para poner a 0 los goles de los jugadores.
  $commands['reiniciar-equipos'] = array(
    'description' => 'Reinicia las victorias y derrotas de todos los equipos.',
    'aliases' => array('re'),
  );
  // Comando para crear equipos aleatorios a partir de los jugadores.
  $commands['crear-equipos'] = array(
    'description' => 'Asigna los jugadores a nuevos equipos aleatorios.',
    'aliases' => array('ce'),
  );
  // Comando para crear todos los partidos de los grupos 1 y 2.
  $commands['crear-partidos-grupos'] = array(
    'description' => 'Crea los partidos de todas las jornadas de los grupos 1 y 2',
    'aliases' => array('cpg'),
  );
  // Comando para crear todos los partidos de la Fase Final.
  $commands['crear-partidos-fase-final'] = array(
    'description' => 'Crea los partidos de todas las jornadas de la fase final.',
    'aliases' => array('cpff'),
  );
  // Comando para crear todos los partidos de la primera ronda de la Copa.
  $commands['crear-partidos-copa-primera-ronda'] = array(
    'description' => 'Crea los partidos de la primera ronda de la copa.',
    'aliases' => array('cpcpr'),
  );
  // Comando para crear todos los partidos de la siguiente ronda de la Copa.
  $commands['crear-partidos-copa-siguiente-ronda'] = array(
    'description' => 'Crea los partidos de la siguiente ronda de la copa.',
    'aliases' => array('cpcsr'),
  );
  // Comando para crear todos los partidos de la primera ronda de la Fase Final de liga.
  $commands['crear-partidos-liga-fase-final-primera-ronda'] = array(
    'description' => 'Crea los partidos de la primera ronda de la Fase Final de Liga.',
    'aliases' => array('cplffpr'),
  );
  // Comando para crear todos los partidos de la siguiente ronda de la Copa.
  $commands['crear-partidos-liga-fase-final-siguiente-ronda'] = array(
    'description' => 'Crea los partidos de la siguiente ronda de la Fase Final de Liga.',
    'aliases' => array('cplffsr'),
  );
  // Comando para rellenar los resultados de todos los partidos
  $commands['generar-resultados'] = array(
    'description' => 'Genera resultados para todos los partidos existentes (testing).',
    'aliases' => array('gr'),
  );

  return $commands;
}

/** INICIO FUNCIONES DE JUGADORES */

/**
 * Reinicia los goles de todos los jugadores.
 */
function drush_general_config_reiniciar_goles_jugadores() {
  // Cargar los jugadores con db_query porque no funciona node_load_multiple.
  $query = db_query('SELECT nid FROM {node} WHERE type = :type', [':type' => 'jugador']);
  $result = $query->fetchAll();
  foreach ($result as $jugador) {
    $jugador = node_load($jugador->nid);
    $jugador->field_goles_anotados_liga[LANGUAGE_NONE][0]['value'] = 0;
    $jugador->field_goles_encajados_liga[LANGUAGE_NONE][0]['value'] = 0;
    $jugador->field_goles_anotados_copa[LANGUAGE_NONE][0]['value'] = 0;
    $jugador->field_goles_encajados_copa[LANGUAGE_NONE][0]['value'] = 0;
    node_save($jugador);
  }
}

/**
 * Asigna porteros ya que devel solo genera jugadores con el primer término (delantero).
 */
function drush_general_config_asignar_porteros() {
  // Carga la taxonomía de posición.
  $posicion = taxonomy_term_load(1);
  // Cargar los jugadores con db_query porque no funciona node_load_multiple.
  $query = db_query('SELECT nid FROM {node} WHERE type = :type', [':type' => 'jugador']);
  $result = $query->fetchAll();
  foreach ($result as $key => $jugador) {
    if ($key % 2 == 0) {
      $jugador = node_load($jugador->nid);
      $jugador->field_posicion[LANGUAGE_NONE][0]['tid'] = $posicion->tid;
      $jugador->field_posicion[LANGUAGE_NONE][0]['taxonomy_term'] = $posicion;
      node_save($jugador);
    }
  }
}

/** FIN FUNCIONES DE JUGADORES */

/** INICIO FUNCIONES DE GENERACIÓN DE EQUIPOS */

/**
 * Reinicia las victorias y derrotas de todos los equipos.
 */
function drush_general_config_reiniciar_equipos() {
  // Cargar los jugadores con db_query porque no funciona node_load_multiple.
  $query = db_query('SELECT nid FROM {node} WHERE type = :type', [':type' => 'equipo']);
  $result = $query->fetchAll();
  foreach ($result as $equipo) {
    $equipo = node_load($equipo->nid);
    $equipo->field_victorias[LANGUAGE_NONE][0]['value'] = 0;
    $equipo->field_derrotas[LANGUAGE_NONE][0]['value'] = 0;
    node_save($equipo);
  }
}

/**
* Carga los jugadores y crea los equipos.
*/
function drush_general_config_crear_equipos() {
  // Primero borramos todas las jornadas y partidos existentes de grupos.
  // Borrar partidos.
  $query = db_query("SELECT nid FROM {node} WHERE type = :type", [':type' => 'partido']);
  $result = $query->fetchAll();
  if (!empty($result)) {
    foreach ($result as $partido) {
      node_delete($partido->nid);
    }
  }
  // Borrar jornadas.
  $jornadas_grupo1 = taxonomy_get_tree(6);
  $jornadas_grupo2 = taxonomy_get_tree(7);
  if (!empty($jornadas_grupo1) && !empty($jornadas_grupo2)) {
    foreach ($jornadas_grupo1 as $jornada) {
      taxonomy_term_delete($jornada->tid);
    }
    foreach ($jornadas_grupo2 as $jornada) {
      taxonomy_term_delete($jornada->tid);
    }
  }
  // Luego borramos todos los equipos.
  // Borrar partidos.
  $query = db_query('SELECT nid FROM {node} WHERE type = :type', [':type' => 'equipo']);
  $result = $query->fetchAll();
  foreach ($result as $equipo) {
    if ($equipo->nid != 3495) {
      node_delete($equipo->nid);
    }
  }

  $jugadores = [];
  $contador = 0;
  // Cargar los jugadores con db_query porque no funciona node_load_multiple.
  $query = db_query('SELECT nid FROM {node} WHERE type = :type', [':type' => 'jugador']);
  $result = $query->fetchAll();
  foreach ($result as $jugador) {
    $jugador = node_load($jugador->nid);
    // Comprobar si es auxiliar.
    if ($jugador->status == 1) {
      $jugadores[$contador] = $jugador;
      $contador++;
    }
  }
  $mitad = count($jugadores) / 2;
  $contador = 1;
  $grupo1 = taxonomy_term_load(354);
  $grupo2 = taxonomy_term_load(355);
  for ($i = 1; $i < count($jugadores); $i = $i + 2) {
    if ($i < $mitad) {
      _general_config_crear_equipo($contador, [$jugadores[$i - 1], $jugadores[$i]], $grupo1);
    }
    else {
      _general_config_crear_equipo($contador, [$jugadores[$i - 1], $jugadores[$i]], $grupo2);
    }
    $contador++;
  }
}

/**
 * Crea el nodo de equipo.
 */
function _general_config_crear_equipo($numero, $jugadores, $grupo) {
  global $user;

  $node = new stdClass();
  $node->title = 'Equipo ' . ($numero);
  $node->type = 'equipo';
  // Sets some defaults. Invokes hook_prepare() and hook_node_prepare().
  node_object_prepare($node);
  $node->language = LANGUAGE_NONE;
  $node->uid = $user->uid;
  if ($numero == 'Auxiliar') {
    $node->status = 0;
  }
  else {
    $node->status = 1;
  }
  $node->promote = 0;
  $node->comment = 0;
  // Jugador 1.
  $node->field_jugador_1[$node->language][0]['target_id'] = $jugadores[0]->nid;
  $node->field_jugador_1[$node->language][0]['entity'] = $jugadores[0];
  $node->field_jugador_1[$node->language][0]['access'] = TRUE;
  // Jugador 2.
  $node->field_jugador_2[$node->language][0]['target_id'] = $jugadores[1]->nid;
  $node->field_jugador_2[$node->language][0]['entity'] = $jugadores[1];
  $node->field_jugador_2[$node->language][0]['access'] = TRUE;
  $node->field_victorias[$node->language][0]['value'] = 0;
  $node->field_derrotas[$node->language][0]['value'] = 0;
  // Grupo.
  $node->field_grupo_equipo[$node->language][0]['tid'] = $grupo->tid;
  $node->field_grupo_equipo[$node->language][0]['taxonomy_term'] = $grupo;
  // Prepare node for saving
  $node = node_submit($node);
  node_save($node);
  drush_print_r($node->title . ' creado.');
}

/** FIN FUNCIONES DE GENERACIÓN DE EQUIPOS */

/** INICIO FUNCIONES DE GENERACIÓN DE PARTIDOS DE FASE GRUPOS */

/**
 * Carga los equipos y crea los partidos de los grupos 1 y 2.
 */
function drush_general_config_crear_partidos_grupos() {
  // Primero borramos todas las jornadas y partidos existentes de grupos.
  // Borrar partidos.
  $query = db_query("SELECT nid FROM {node} WHERE type = :type AND title LIKE '%Grupo 1%' OR title LIKE '%Grupo 2%'", [':type' => 'partido']);
  $result = $query->fetchAll();
  if (!empty($result)) {
    foreach ($result as $partido) {
      node_delete($partido->nid);
    }
  }
  // Borrar jornadas.
  $jornadas_grupo1 = taxonomy_get_tree(6);
  $jornadas_grupo2 = taxonomy_get_tree(7);
  if (!empty($jornadas_grupo1) && !empty($jornadas_grupo2)) {
    foreach ($jornadas_grupo1 as $jornada) {
      taxonomy_term_delete($jornada->tid);
    }
    foreach ($jornadas_grupo2 as $jornada) {
      taxonomy_term_delete($jornada->tid);
    }
  }

  $equipos_grupo1 = $equipos_grupo2 = [];
  // Cargar los equipos con db_query porque no funciona node_load_multiple.
  $query = db_query('SELECT nid FROM {node} WHERE type = :type', [':type' => 'equipo']);
  $result = $query->fetchAll();
  foreach ($result as $equipo) {
    $equipo = node_load($equipo->nid);
    if ($equipo->status == 1) {
      if (isset($equipo->field_grupo_equipo[LANGUAGE_NONE])) {
        // Grupo 1.
        if ($equipo->field_grupo_equipo[LANGUAGE_NONE][0]['tid'] == 354) {
          $equipos_grupo1[] = $equipo;
        }
        // Grupo 2.
        elseif ($equipo->field_grupo_equipo[LANGUAGE_NONE][0]['tid'] == 355) {
          $equipos_grupo2[] = $equipo;
        }
      }
    }
  }
  unset($equipo);
  // Taxonomias necesarias.
  $competicion = taxonomy_term_load(3);
  $fase_liga_grupo1 = taxonomy_term_load(5);
  $fase_liga_grupo2 = taxonomy_term_load(6);
  // Genera las jornadas(taxonomias).
  $grupo1_vid = 6;
  $grupo2_vid = 7;
  $jornadas_grupo1 = [];
  $jornadas_grupo2 = [];
  // Si los equipos son impares, añadimos un equipo auxiliar.
  $equipo_auxiliar = node_load(3495);
  $num_equipos_grupo1 = count($equipos_grupo1);
  $num_equipos_grupo2 = count($equipos_grupo2);
  if ($num_equipos_grupo1 % 2 != 0) {
    $equipos_grupo1[] = $equipo_auxiliar;
  }
  if ($num_equipos_grupo2 % 2 != 0) {
    $equipos_grupo2[] = $equipo_auxiliar;
  }

  for ($i = 0; $i < $num_equipos_grupo1 - 1; $i++) {
    $jornadas_grupo1[$i] = _general_config_crear_jornadas_grupos($grupo1_vid, $i + 1);
  }
  for ($i = 0; $i < $num_equipos_grupo2 - 1; $i++) {
    $jornadas_grupo2[$i] = _general_config_crear_jornadas_grupos($grupo2_vid, $i + 1);
  }
  // Generar los partidos para cada jornada.
  $num_equipos_grupo1 = count($equipos_grupo1);
  $num_equipos_grupo2 = count($equipos_grupo2);
  // Grupo 1.
  foreach ($jornadas_grupo1 as $jornada) {
    // Todos los partidos de cada jornada enfrentando el primero contra el ultimo, el segundo contra el penultimo...etc.
    for ($i = 0; $i < $num_equipos_grupo1 / 2; $i++) {
      _general_config_crear_partido_grupos($i + 1, $jornada, [$equipos_grupo1[$i], $equipos_grupo1[$num_equipos_grupo1 - ($i + 1)]], $competicion, $fase_liga_grupo1);
    }
    // Reordenamos el array de equipos. El penúltimo pasa al primero.
    $temp = $equipos_grupo1[$num_equipos_grupo1 - 2];
    unset($equipos_grupo1[$num_equipos_grupo1 - 2]);
    array_unshift($equipos_grupo1, $temp);
  }
  // Grupo 2.
  foreach ($jornadas_grupo2 as $jornada) {
    // Todos los partidos de cada jornada enfrentando el primero contra el ultimo, el segundo contra el penultimo...etc.
    for ($i = 0; $i < $num_equipos_grupo2 / 2; $i++) {
      _general_config_crear_partido_grupos($i + 1, $jornada, [$equipos_grupo2[$i], $equipos_grupo2[$num_equipos_grupo2 - ($i + 1)]], $competicion, $fase_liga_grupo2);
    }
    // Reordenamos el array de equipos. El penúltimo pasa al primero.
    $temp = $equipos_grupo2[$num_equipos_grupo2 - 2];
    unset($equipos_grupo2[$num_equipos_grupo2 - 2]);
    array_unshift($equipos_grupo2, $temp);
  }
}

/**
 * Crea las jornadas de los grupos de liga.
 */
function _general_config_crear_jornadas_grupos($vid, $numero_jornada) {
  $name = 'Jornada ' . $numero_jornada;
  $description = 'Termino para la jornada ' . $numero_jornada;
  $term = (object) [
    'name' => $name,
    'description' => $description,
    'vid' => $vid,
  ];
  taxonomy_term_save($term);

  return $term;
}

/**
 * Crea el nodo de partido de grupos.
 */
function _general_config_crear_partido_grupos($num_partido, $jornada, $equipos, $competicion, $fase_liga) {
  global $user;

  $node = new stdClass();
  $node->title = 'Partido ' . $num_partido . ' ' . $jornada->name . ' ' . $fase_liga->name . ' ' . $equipos[0]->title . ' vs ' . $equipos[1]->title;
  $node->type = 'partido';
  // Sets some defaults. Invokes hook_prepare() and hook_node_prepare().
  node_object_prepare($node);
  $node->language = LANGUAGE_NONE;
  $node->uid = $user->uid;
  // Si el partido contiene un equipo auxiliar, no publicado.
  $node->status = 1;
  foreach ($equipos as $equipo) {
    if ($equipo->status == 0) {
      $node->status = 0;
      break;
    }
  }
  $node->promote = 0;
  $node->comment = 0;
  // Jugador 1.
  $node->field_equipo_1[$node->language][0]['target_id'] = $equipos[0]->nid;
  $node->field_equipo_1[$node->language][0]['entity'] = $equipos[0];
  $node->field_equipo_1[$node->language][0]['access'] = TRUE;
  // Jugador 2.
  $node->field_equipo_2[$node->language][0]['target_id'] = $equipos[1]->nid;
  $node->field_equipo_2[$node->language][0]['entity'] = $equipos[1];
  $node->field_equipo_2[$node->language][0]['access'] = TRUE;
  // Goles.
  $node->field_goles_jugador_1_equipo_1[$node->language][0]['value'] = 0;
  $node->field_goles_jugador_2_equipo_1[$node->language][0]['value'] = 0;
  $node->field_goles_jugador_1_equipo_2[$node->language][0]['value'] = 0;
  $node->field_goles_jugador_2_equipo_2[$node->language][0]['value'] = 0;
  // Taxonomias necesarias.
  $node->field_competicion[$node->language][0]['tid'] = $competicion->tid;
  $node->field_competicion[$node->language][0]['taxonomy_term'] = $competicion;
  $node->field_fase_liga[$node->language][0]['tid'] = $fase_liga->tid;
  $node->field_fase_liga[$node->language][0]['taxonomy_term'] = $fase_liga;
  // Si Grupo 1.
  if ($fase_liga->tid == 5) {
    $node->field_jornada_grupo_1[$node->language][0]['tid'] = $jornada->tid;
    $node->field_jornada_grupo_1[$node->language][0]['taxonomy_term'] = $jornada;
  }
  // Si Grupo 2.
  elseif ($fase_liga->tid == 6) {
    $node->field_jornada_grupo_2[$node->language][0]['tid'] = $jornada->tid;
    $node->field_jornada_grupo_2[$node->language][0]['taxonomy_term'] = $jornada;
  }

  $node = node_submit($node); // Prepare node for saving
  node_save($node);
  drush_print_r($node->title . ' creado.');
}

/** FIN FUNCIONES DE GENERACIÓN DE PARTIDOS DE FASE GRUPOS */

/** INICIO FUNCIONES DE GENERACIÓN DE PARTIDOS DE COPA */

/**
 * Carga los equipos y crea los partidos de la primera ronda de la copa.
 */
function drush_general_config_crear_partidos_copa_primera_ronda() {
  // Primero borramos todas las jornadas y partidos existentes de copa.
  // Borrar partidos.
  $query = db_query("SELECT nid FROM {node} WHERE type = :type AND title LIKE '%Copa%'", [':type' => 'partido']);
  $result = $query->fetchAll();
  if (!empty($result)) {
    foreach ($result as $partido) {
      node_delete($partido->nid);
    }
  }
  // Borrar jornadas (SOLO LAS BORRAMOS AL GENERAR LA PRIMERA RONDA).
  $jornadas_copa = taxonomy_get_tree(9);
  if (!empty($jornadas_copa)) {
    foreach ($jornadas_copa as $jornada) {
      taxonomy_term_delete($jornada->tid);
    }
  }

  $equipos_copa = [];
  // Cargar los equipos con db_query porque no funciona node_load_multiple.
  $query = db_query('SELECT nid FROM {node} WHERE type = :type', [':type' => 'equipo']);
  $result = $query->fetchAll();
  foreach ($result as $equipo) {
    if ($equipo->nid != 3495) {
      $equipos_copa[] = node_load($equipo->nid);
    }
  }
  unset($equipo);
  // Taxonomias necesarias.
  $competicion = taxonomy_term_load(4);
  // Genera las jornadas(taxonomias).
  $copa_vid = 9;
  $num_equipos_copa_primera_ronda = count($equipos_copa);
  $fase_copa = _general_config_calcular_fase_copa($num_equipos_copa_primera_ronda);
  $jornada_copa = _general_config_crear_jornadas_copa($copa_vid, $fase_copa);
  // Si no hay tantos equipos como necesite la ronda, se rellena con auxiliares.
  $equipo_auxiliar = node_load(3495);
  if ($num_equipos_copa_primera_ronda % 2 != 0) {
    $equipos_copa[] = $equipo_auxiliar;
  }
  $num_equipos_necesarios = [2, 4, 8, 16, 32, 64];
  $equipos_auxiliares = [];
  $num_equipos_auxiliares = 0;
  if (!in_array($num_equipos_copa_primera_ronda, $num_equipos_necesarios)) {
    if ($num_equipos_copa_primera_ronda > 16 && $num_equipos_copa_primera_ronda < 32) {
      $num_equipos_auxiliares = 32 - $num_equipos_copa_primera_ronda;
    }
    else {
      $num_equipos_auxiliares = 64 - $num_equipos_copa_primera_ronda;
    }
    for ($i = 0; $i < $num_equipos_auxiliares; $i++) {
      $equipos_auxiliares[] = $equipo_auxiliar;
    }
  }
  // Generar los partidos de la ronda.
  for ($i = 0; $i < ($num_equipos_copa_primera_ronda / 2); $i++) {
    // Se generan partidos aleatorios.
    $random1 = $random2 = 0;
    while (TRUE) {
      $random1 = mt_rand(0, $num_equipos_copa_primera_ronda);
      $random2 = mt_rand(0, $num_equipos_copa_primera_ronda);
      if ($random1 == $random2 || (!isset($equipos_copa[$random1]) || !isset($equipos_copa[$random2]))) {
        continue;
      }
      break;
    }
    _general_config_crear_partido_copa($i + 1, $jornada_copa, [$equipos_copa[$random1], $equipos_copa[$random2]], $competicion);
    unset($equipos_copa[$random1]);
    unset($equipos_copa[$random2]);
  }
  // Ahora se rellenan los partidos que faltan con equipos auxiliares.
  if ($num_equipos_auxiliares > 0) {
    for ($j = 0; $j < $num_equipos_auxiliares / 2; $j++) {
      _general_config_crear_partido_copa($i + 1, $jornada_copa, [$equipos_auxiliares[$j], $equipos_auxiliares[$j + 1]], $competicion);
      $i++;
    }
  }
}

/**
 * Carga los equipos y crea los partidos de la siguiente ronda de la copa.
 */
function drush_general_config_crear_partidos_copa_siguiente_ronda() {
  // Comprobamos cuantas jornadas de copa hay generadas.
  $jornadas_copa = taxonomy_get_tree(9);
  $num_jornadas_copa = count($jornadas_copa);
  // IMPORTANTE QUE ESTÉN ORDENADAS. Nos quedamos con la última generada.
  $ultima_jornada = $jornadas_copa[$num_jornadas_copa - 1];
  // Cargamos los partidos de copa y nos quedamos solo con los de la última jornada.
  $partidos_ultima_ronda = [];
  $query = db_query("SELECT nid FROM {node} WHERE type = :type AND title LIKE '%Copa%'", [':type' => 'partido']);
  $result = $query->fetchAll();
  if (!empty($result)) {
    foreach ($result as $partido) {
      $partido = node_load($partido->nid);
      if (!empty($partido->field_jornada_copa) && $partido->field_jornada_copa[LANGUAGE_NONE][0]['tid'] == $ultima_jornada->tid) {
        $partidos_ultima_ronda[] = $partido;
      }
    }
  }
  // De los partidos, nos quedamos con los equipos que han pasado de ronda.
  $equipos_copa = [];
  foreach ($partidos_ultima_ronda as $partido) {
    $goles_equipo1 = $partido->field_goles_jugador_1_equipo_1[LANGUAGE_NONE][0]['value'] + $partido->field_goles_jugador_2_equipo_1[LANGUAGE_NONE][0]['value'];
    $goles_equipo2 = $partido->field_goles_jugador_1_equipo_2[LANGUAGE_NONE][0]['value'] + $partido->field_goles_jugador_2_equipo_2[LANGUAGE_NONE][0]['value'];
    $equipos_copa[] = $goles_equipo1 > $goles_equipo2 ? node_load($partido->field_equipo_1[LANGUAGE_NONE][0]['target_id']) : node_load($partido->field_equipo_2[LANGUAGE_NONE][0]['target_id']);
  }

  // Taxonomias necesarias.
  $competicion = taxonomy_term_load(4);
  // Genera las jornadas(taxonomias).
  $copa_vid = 9;
  $num_equipos_copa_siguiente_ronda = count($equipos_copa);
  if ($num_equipos_copa_siguiente_ronda % 2 != 0) {
    $equipo_auxiliar = node_load(3495);
  }
  $fase_copa = _general_config_calcular_fase_copa($num_equipos_copa_siguiente_ronda);
  $jornada_copa = _general_config_crear_jornadas_copa($copa_vid, $fase_copa);
  // Generar los partidos de la ronda.
  for ($i = 0; $i < $num_equipos_copa_siguiente_ronda; $i = $i + 2) {
    _general_config_crear_partido_copa(($i / 2) + 1, $jornada_copa, [$equipos_copa[$i], $equipos_copa[$i+1]], $competicion);
  }
}

/**
 * Crea el nodo de partido de copa.
 */
function _general_config_crear_partido_copa($num_partido, $jornada, $equipos, $competicion) {
  global $user;

  $node = new stdClass();
  $node->title = 'Partido ' . $num_partido . ' de ' . $jornada->name;
  $node->type = 'partido';
  // Sets some defaults. Invokes hook_prepare() and hook_node_prepare().
  node_object_prepare($node);
  $node->language = LANGUAGE_NONE;
  $node->uid = $user->uid;
  // Si el partido contiene un equipo auxiliar, no publicado.
  $node->status = 1;
  foreach ($equipos as $equipo) {
    if ($equipo->status == 0) {
      $node->status = 0;
      break;
    }
  }
  $node->promote = 0;
  $node->comment = 0;
  // Jugador 1.
  $node->field_equipo_1[$node->language][0]['target_id'] = $equipos[0]->nid;
  $node->field_equipo_1[$node->language][0]['entity'] = $equipos[0];
  $node->field_equipo_1[$node->language][0]['access'] = TRUE;
  // Jugador 2.
  $node->field_equipo_2[$node->language][0]['target_id'] = $equipos[1]->nid;
  $node->field_equipo_2[$node->language][0]['entity'] = $equipos[1];
  $node->field_equipo_2[$node->language][0]['access'] = TRUE;
  // Goles.
  $node->field_goles_jugador_1_equipo_1[$node->language][0]['value'] = 0;
  $node->field_goles_jugador_2_equipo_1[$node->language][0]['value'] = 0;
  $node->field_goles_jugador_1_equipo_2[$node->language][0]['value'] = 0;
  $node->field_goles_jugador_2_equipo_2[$node->language][0]['value'] = 0;
  // Taxonomias necesarias.
  $node->field_competicion[$node->language][0]['tid'] = $competicion->tid;
  $node->field_competicion[$node->language][0]['taxonomy_term'] = $competicion;
  $node->field_jornada_copa[$node->language][0]['tid'] = $jornada->tid;
  $node->field_jornada_copa[$node->language][0]['taxonomy_term'] = $jornada;

  $node = node_submit($node); // Prepare node for saving
  node_save($node);
  drush_print_r($node->title . ' creado.');
}

/**
 * Crea los partidos de la fase actual de copa.
 */
function _general_config_crear_jornadas_copa($vid, $fase_copa) {
  $name = $fase_copa . ' de copa';
  $description = 'Termino para ' . $fase_copa . ' de copa';
  $term = (object) [
    'name' => $name,
    'description' => $description,
    'vid' => $vid,
  ];
  taxonomy_term_save($term);

  return $term;
}

function _general_config_calcular_fase_copa($numero_equipos) {
  if ($numero_equipos <= 2) {
    return 'Final';
  }
  elseif ($numero_equipos <= 4) {
    return 'Semifinal';
  }
  elseif ($numero_equipos <= 8) {
    return 'Cuartos de final';
  }
  elseif ($numero_equipos <= 16) {
    return 'Octavos de final';
  }
  elseif ($numero_equipos <= 32) {
    return 'Diecieseisavos de final';
  }
  else {
    return 'Treintaidosavos de final';
  }
}

/** FIN FUNCIONES DE GENERACIÓN DE PARTIDOS DE COPA */

/** INICIO FUNCIONES DE GENERACIÓN DE PARTIDOS DE FASE FINAL DE LIGA */


/** FIN FUNCIONES DE GENERACIÓN DE PARTIDOS DE FASE FINAL DE LIGA */

/** GENERADOR DE RESULTADOS */

/**
 * Genera resultados para todos los partidos existentes (testing).
 */
function drush_general_config_generar_resultados() {
  // Cargamos todos los partidos.
  $query = db_query("SELECT nid FROM {node} WHERE type = :type", [':type' => 'partido']);
  $result = $query->fetchAll();
  if (!empty($result)) {
    foreach ($result as $partido) {
      $partido = node_load($partido->nid);
      // Generamos el número de goles para el partido.
      $goles11 = 2;
      $goles21 = 2;
      $goles12 = 1;
      $goles22 = 2;
      $partido->field_goles_jugador_1_equipo_1[LANGUAGE_NONE][0]['value'] = $goles11;
      $partido->field_goles_jugador_2_equipo_1[LANGUAGE_NONE][0]['value'] = $goles21;
      $partido->field_goles_jugador_1_equipo_2[LANGUAGE_NONE][0]['value'] = $goles12;
      $partido->field_goles_jugador_2_equipo_2[LANGUAGE_NONE][0]['value'] = $goles22;
      // Ejecutamos el proceso de guardado de partido.
      node_save($partido);
    }
  }
}
