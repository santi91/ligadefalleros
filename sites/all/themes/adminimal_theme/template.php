<?php

/**
 * @file
 * This file contains the main theme functions hooks and overrides.
 */

/**
 * Override or insert variables into the maintenance page template.
 */
function adminimal_preprocess_maintenance_page(&$vars) {
  // While markup for normal pages is split into page.tpl.php and html.tpl.php,
  // the markup for the maintenance page is all in the single
  // maintenance-page.tpl.php template. So, to have what's done in
  // adminimal_preprocess_html() also happen on the maintenance page, it has to be
  // called here.
  adminimal_preprocess_html($vars);
}

/**
 * Override or insert variables into the html template.
 */
function adminimal_preprocess_html(&$vars) {

  // watchdog('Emergency', 'This is a test emergency watchdog mesage' , NULL , WATCHDOG_EMERGENCY);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Debug', 'This is a test debug watchdog mesage' , NULL , WATCHDOG_DEBUG);
  // watchdog('Notice', 'This is a test notice watchdog mesage' , NULL , WATCHDOG_NOTICE);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Warning', 'This is a test warning watchdog mesage' , NULL , WATCHDOG_WARNING);
  // watchdog('Debug', 'This is a test debug watchdog mesage' , NULL , WATCHDOG_DEBUG);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Error', 'This is a test error watchdog mesage' , NULL , WATCHDOG_ERROR);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Notice', 'This is a test notice watchdog mesage' , NULL , WATCHDOG_NOTICE);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Debug', 'This is a test debug watchdog mesage' , NULL , WATCHDOG_DEBUG);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Notice', 'This is a test notice watchdog mesage' , NULL , WATCHDOG_NOTICE);
  // watchdog('Critical', 'This is a test critical watchdog mesage' , NULL , WATCHDOG_CRITICAL);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Alert', 'This is a test alert watchdog mesage' , NULL , WATCHDOG_ALERT);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Debug', 'This is a test debug watchdog mesage' , NULL , WATCHDOG_DEBUG);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);
  // watchdog('Notice', 'This is a test notice watchdog mesage' , NULL , WATCHDOG_NOTICE);
  // watchdog('Debug', 'This is a test debug watchdog mesage' , NULL , WATCHDOG_DEBUG);
  // watchdog('Info', 'This is a test info watchdog mesage' , NULL , WATCHDOG_INFO);


  // Get adminimal folder path.
  $adminimal_path = drupal_get_path('theme', 'adminimal');

  // Add default styles.
  drupal_add_css($adminimal_path . '/css/reset.css', array('group' => CSS_THEME, 'media' => 'all', 'weight' => -999));
  drupal_add_css($adminimal_path . '/css/style.css', array('group' => CSS_THEME, 'media' => 'all', 'weight' => 1));

  // Add conditional CSS for IE8 and below.
  drupal_add_css($adminimal_path . '/css/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 8', '!IE' => FALSE), 'weight' => 999, 'preprocess' => TRUE));

  // Add conditional CSS for IE7 and below.
  drupal_add_css($adminimal_path . '/css/ie7.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'weight' => 999, 'preprocess' => TRUE));

  // Add conditional CSS for IE6.
  drupal_add_css($adminimal_path . '/css/ie6.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 6', '!IE' => FALSE), 'weight' => 999, 'preprocess' => TRUE));

  //Add Homebox module support
  if (module_exists('homebox')) {
    drupal_add_css($adminimal_path . '/css/homebox_custom.css', array('group' => CSS_THEME, 'media' => 'all', 'weight' => 1));
  }

  // Add theme name to body class.
  $vars['classes_array'][] = 'adminimal-theme';

  // Style checkbox and radio buttons in Webkit Browsers.
  if (theme_get_setting('style_checkboxes')) {
    $vars['classes_array'][] = 'style-checkboxes';
  }

  // Disable rounded buttons setting.
  if (!theme_get_setting('rounded_buttons')) {
    $vars['classes_array'][] = 'no-rounded-buttons';
  }

  // Enable sticky action buttons.
  if (theme_get_setting('sticky_actions')) {
    $vars['classes_array'][] = 'sticky-actions';
  }

  // Add icons to the admin configuration page.
  if (theme_get_setting('display_icons_config')) {
    drupal_add_css($adminimal_path . '/css/icons-config.css', array('group' => CSS_THEME, 'weight' => 10, 'preprocess' => TRUE));
  }

  // Add icons to the admin configuration page.
  if (theme_get_setting('avoid_custom_font')) {
    drupal_add_css($adminimal_path . '/css/avoid_custom_font.css', array('group' => CSS_THEME, 'weight' => 9000, 'preprocess' => TRUE));
  }

  // Load CKEditor styles if enabled in settings.
  if (theme_get_setting('adminimal_ckeditor') and theme_get_setting('adminimal_theme_skin') != 'dark') {
    drupal_add_css($adminimal_path . '/css/ckeditor-adminimal.css', array('group' => CSS_THEME, 'media' => 'all', 'weight' => 2));
  }

  // Define Default media queries.
  $media_query_mobile = 'only screen and (max-width: 480px)';
  $media_query_tablet = 'only screen and (min-width : 481px) and (max-width : 1024px)';

  // Get custom media queries if set.
  if (theme_get_setting('use_custom_media_queries')) {
    $media_query_mobile = theme_get_setting('media_query_mobile');
    $media_query_tablet = theme_get_setting('media_query_tablet');
  }

  // Use Bootstrap Gids.
  if (theme_get_setting('use_bootstrap_grids')) {
    drupal_add_css($adminimal_path . '/css/bootstrap-grids.css', array('group' => CSS_THEME, 'weight' => 1000, 'preprocess' => TRUE));
  }

  // Load custom Adminimal skin.
  $adminimal_skin = theme_get_setting('adminimal_theme_skin');
  if ((!is_null($adminimal_skin))) {
    drupal_add_css($adminimal_path . '/skins/' . $adminimal_skin . '/' . $adminimal_skin . '.css', array('group' => CSS_THEME, 'weight' => 900, 'preprocess' => TRUE));
    // Add conditional CSS for Mac OS X.
    drupal_add_css($adminimal_path . '/skins/' . $adminimal_skin . '/mac_os_x.css', array('group' => CSS_THEME, 'weight' => 950, 'preprocess' => TRUE));
    drupal_add_js($adminimal_path . '/skins/' . $adminimal_skin . '/' . $adminimal_skin . '.js');
    $vars['classes_array'][] = 'adminimal-skin-' . $adminimal_skin ;
  }
  else {
    drupal_add_css($adminimal_path . '/skins/default/default.css', array('group' => CSS_THEME, 'weight' => 900, 'preprocess' => TRUE));
    // Add conditional CSS for Mac OS X.
    drupal_add_css($adminimal_path . '/skins/default/mac_os_x.css', array('group' => CSS_THEME, 'weight' => 950, 'preprocess' => TRUE));
    drupal_add_js($adminimal_path . '/skins/default/default.js');
    $vars['classes_array'][] = 'adminimal-skin-default' ;
  }

  // Add responsive styles.
  drupal_add_css($adminimal_path . '/css/mobile.css', array('group' => CSS_THEME, 'media' => $media_query_mobile, 'weight' => 1000));
  drupal_add_css($adminimal_path . '/css/tablet.css', array('group' => CSS_THEME, 'media' => $media_query_tablet, 'weight' => 1000));

  // Add custom CSS.
  $custom_css_path = 'public://adminimal-custom.css';
  if (theme_get_setting('custom_css') && file_exists($custom_css_path)) {
    drupal_add_css($custom_css_path, array('group' => CSS_THEME, 'weight' => 9999, 'preprocess' => TRUE));
  }

  // Fix the viewport and zooming in mobile devices.
  $viewport = array(
   '#tag' => 'meta',
   '#attributes' => array(
     'name' => 'viewport',
     'content' => 'width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no, initial-scale=1',
   ),
  );
  drupal_add_html_head($viewport, 'viewport');

  // Remove the no-sidebars class which is always added by core. Core assumes
  // the sidebar regions are called sidebar_first and sidebar_second, which
  // is not the case in this theme.
  $key = array_search('no-sidebars', $vars['classes_array']);
  if ($key !== FALSE) {
    unset($vars['classes_array'][$key]);
  }
  // Add information about the number of sidebars.
  if (!empty($vars['page']['sidebar_left']) && !empty($vars['page']['sidebar_right'])) {
    $vars['classes_array'][] = 'two-sidebars';
  }
  elseif (!empty($vars['page']['sidebar_left'])) {
    $vars['classes_array'][] = 'one-sidebar sidebar-left';
  }
  elseif (!empty($vars['page']['sidebar_right'])) {
    $vars['classes_array'][] = 'one-sidebar sidebar-right';
  }
  else {
    $vars['classes_array'][] = 'no-sidebars';
  }

  // Display warning message on certain pages if theme is disabled.
  if (in_array('page-admin-appearance', $vars['classes_array']) || in_array('page-admin-modules', $vars['classes_array']) || in_array('page-admin-reports-status', $vars['classes_array'])) {
    $active_themes = list_themes();
    if ($active_themes['adminimal']->status == 0) {
      global $base_url;
      drupal_set_message(t('Adminimal Theme must be enabled to work properly. Please enable it from the <a href="@link">Appearance page</a>.', array('@link' => $base_url . '/admin/appearance')), 'warning');
    }
  }
}

/**
 * Override or insert variables into the page template.
 */
function adminimal_preprocess_page(&$vars) {
  $vars['primary_local_tasks'] = $vars['tabs'];
  unset($vars['primary_local_tasks']['#secondary']);
  // Remove primary tasks if editor role.
  if (isset($vars['primary_local_tasks']) && isset($vars['user']->roles[4])) {
    unset($vars['primary_local_tasks']['#primary']);
  }
  $vars['secondary_local_tasks'] = array(
    '#theme' => 'menu_local_tasks',
    '#secondary' => $vars['tabs']['#secondary'],
  );
  unset($vars['page']['hidden']);

  // Código para la gestión.
  $current_path = current_path();
  // Cargar menú para los editores.
  if (isset($vars['user']->roles[4])) {
    if ($current_path == 'gestion-jugadores') {
      $vars['add_link'] = '<a href="/node/add/jugador?destination=' . $current_path . '" class="add-link">Añadir Jugador</a>';
    }
    elseif ($current_path == 'gestion-equipos') {
      $vars['add_link'] = '<a href="/node/add/equipo?destination=' . $current_path . '" class="add-link">Añadir Equipo</a>';
    }
    $vars['gestion_menu'] = menu_navigation_links('menu-gestion');
    // Logout link.
    $vars['logout_link'] = '<a href="/user/logout" class="logout-link">Desconectarse</a>';
  }
}

/**
 * Implements template_preprocess_views_view_table.
 */
function adminimal_preprocess_views_view_table(&$vars) {
  if ($vars['view']->name == 'gestion_de_partidos') {
    foreach ($vars['rows'] as $key => $row) {
      if (isset($vars['result'][$key]->field_field_goles_jugador_1_equipo_1) && isset($vars['result'][$key]->field_field_goles_jugador_2_equipo_1[0]['raw']['value'])) {
        $vars['rows'][$key]['nothing'] = $vars['result'][$key]->field_field_goles_jugador_1_equipo_1[0]['raw']['value'] + $vars['result'][$key]->field_field_goles_jugador_2_equipo_1[0]['raw']['value'];
      }
      if (isset($vars['result'][$key]->field_field_goles_jugador_1_equipo_2) && isset($vars['result'][$key]->field_field_goles_jugador_2_equipo_2[0]['raw']['value'])) {
        $vars['rows'][$key]['nothing_1'] = $vars['result'][$key]->field_field_goles_jugador_1_equipo_2[0]['raw']['value'] + $vars['result'][$key]->field_field_goles_jugador_2_equipo_2[0]['raw']['value'];
      }
    }
  }
  if ($vars['view']->name == 'clasificacion') {
    foreach ($vars['rows'] as $key => $row) {
      $equipo = node_load($row['nid']);
      $jugador1 = node_load($equipo->field_jugador_1[LANGUAGE_NONE][0]['target_id']);
      $jugador2 = node_load($equipo->field_jugador_2[LANGUAGE_NONE][0]['target_id']);
      $goles_anotados = $goles_encajados = 0;
      if (!empty($jugador1->field_goles_anotados_liga) && !empty($jugador2->field_goles_anotados_liga)) {
        $goles_anotados = $jugador1->field_goles_anotados_liga[LANGUAGE_NONE][0]['value'] + $jugador2->field_goles_anotados_liga[LANGUAGE_NONE][0]['value'];
      }
      if (!empty($jugador1->field_goles_encajados_liga) && !empty($jugador2->field_goles_encajados_liga)) {
        $goles_encajados = $jugador1->field_goles_encajados_liga[LANGUAGE_NONE][0]['value'] + $jugador2->field_goles_encajados_liga[LANGUAGE_NONE][0]['value'];
      }
      $vars['rows'][$key]['nothing'] = $goles_anotados;
      $vars['rows'][$key]['nothing_1'] = $goles_encajados;
      $vars['rows'][$key]['nid'] = '';
    }
  }
}

/**
 * Display the list of available node types for node creation.
 */
function adminimal_node_add_list($variables) {
  $content = $variables['content'];
  $output = '';
  if ($content) {
    $output = '<ul class="admin-list">';
    foreach ($content as $item) {
      $output .= '<li class="clearfix">';
      $output .= '<span class="label">' . l($item['title'], $item['href'], $item['localized_options']) . '</span>';
      $output .= '<div class="description">' . filter_xss_admin($item['description']) . '</div>';
      $output .= '</li>';
    }
    $output .= '</ul>';
  }
  else {
    $output = '<p>' . t('You have not created any content types yet. Go to the <a href="@create-content">content type creation page</a> to add a new content type.', array('@create-content' => url('admin/structure/types/add'))) . '</p>';
  }
  return $output;
}

/**
 * Implements theme_adminimal_block_content().
 *
 * Use unordered list markup in both compact and extended mode.
 */
function adminimal_adminimal_block_content($variables) {
  $content = $variables['content'];
  $output = '';
  if (!empty($content)) {
    $output = system_adminimal_compact_mode() ? '<ul class="admin-list compact">' : '<ul class="admin-list">';
    foreach ($content as $item) {
      $output .= '<li class="leaf">';
      $output .= l($item['title'], $item['href'], $item['localized_options']);
      if (isset($item['description']) && !system_adminimal_compact_mode()) {
        $output .= '<div class="description">' . filter_xss_admin($item['description']) . '</div>';
      }
      $output .= '</li>';
    }
    $output .= '</ul>';
  }
  return $output;
}

/**
 * Implements theme_tablesort_indicator().
 *
 * Use our own image versions, so they show up as black and not gray on gray.
 */
function adminimal_tablesort_indicator($variables) {
  $style = $variables['style'];
  $theme_path = drupal_get_path('theme', 'adminimal');
  if ($style == 'asc') {
    return theme('image', array('path' => $theme_path . '/images/arrow-asc.png', 'alt' => t('sort ascending'), 'width' => 13, 'height' => 13, 'title' => t('sort ascending')));
  }
  else {
    return theme('image', array('path' => $theme_path . '/images/arrow-desc.png', 'alt' => t('sort descending'), 'width' => 13, 'height' => 13, 'title' => t('sort descending')));
  }
}

/**
 * Implements hook_css_alter().
 */
function adminimal_css_alter(&$css) {
  // Use Seven's vertical tabs style instead of the default one.
  if (isset($css['misc/vertical-tabs.css'])) {
    $css['misc/vertical-tabs.css']['data'] = drupal_get_path('theme', 'adminimal') . '/css/vertical-tabs.css';
  }
  if (isset($css['misc/vertical-tabs-rtl.css'])) {
    $css['misc/vertical-tabs-rtl.css']['data'] = drupal_get_path('theme', 'adminimal') . '/css/vertical-tabs-rtl.css';
  }
  // Use Seven's jQuery UI theme style instead of the default one.
  if (isset($css['misc/ui/jquery.ui.theme.css'])) {
    $css['misc/ui/jquery.ui.theme.css']['data'] = drupal_get_path('theme', 'adminimal') . '/css/jquery.ui.theme.css';
  }
}

/**
 * Implements hook_js_alter().
 */
function adminimal_js_alter(&$javascript) {
  // Fix module filter available updates page.
  if (module_exists('module_filter') && isset($javascript[drupal_get_path('module', 'module_filter') . '/js/update_status.js'])) {
    $javascript[drupal_get_path('module','module_filter').'/js/update_status.js']['data'] = drupal_get_path('theme', 'adminimal') . '/js/update_status.js';
  }
}

/**
 * Implements theme_admin_block().
 * Adding classes to the administration blocks see issue #1869690.
 */
function adminimal_admin_block($variables) {
  $block = $variables['block'];
  $output = '';

  // Don't display the block if it has no content to display.
  if (empty($block['show'])) {
    return $output;
  }

  if (!empty($block['path'])) {
    $output .= '<div class="admin-panel ' . check_plain(str_replace("/", " ", $block['path'])) . ' ">';
  }
  elseif (!empty($block['title'])) {
    $output .= '<div class="admin-panel ' . check_plain(strtolower($block['title'])) . '">';
  }
  else {
    $output .= '<div class="admin-panel">';
  }

  if (!empty($block['title'])) {
    $output .= '<h3 class="title">' . $block['title'] . '</h3>';
  }

  if (!empty($block['content'])) {
    $output .= '<div class="body">' . $block['content'] . '</div>';
  }
  else {
    $output .= '<div class="description">' . $block['description'] . '</div>';
  }

  $output .= '</div>';

  return $output;
}

/**
 * Implements theme_admin_block_content().
 * Adding classes to the administration blocks see issue #1869690.
 */
function adminimal_admin_block_content($variables) {
  $content = $variables['content'];
  $output = '';

  if (!empty($content)) {
    $class = 'admin-list';
    if ($compact = system_admin_compact_mode()) {
      $class .= ' compact';
    }
    $output .= '<dl class="' . $class . '">';
    foreach ($content as $item) {
      if (!isset($item['path'])) {
          $item['path']='';
      }
      $output .= '<div class="admin-block-item ' . check_plain(str_replace("/", "-", $item['path'])) . '"><dt>' . l($item['title'], $item['href'], $item['localized_options']) . '</dt>';
      if (!$compact && isset($item['description'])) {
        $output .= '<dd class="description">' . filter_xss_admin($item['description']) . '</dd>';
      }
      $output .= '</div>';
    }
    $output .= '</dl>';
  }
  return $output;
}

/**
 * Implements theme_table().
 */
function adminimal_table($variables) {
  $header = $variables['header'];
  $rows = $variables['rows'];
  $attributes = $variables['attributes'];
  $caption = $variables['caption'];
  $colgroups = $variables['colgroups'];
  $sticky = $variables['sticky'];
  $empty = $variables['empty'];

  // Add sticky headers, if applicable.
  if (!empty($header) && $sticky) {
    drupal_add_js('misc/tableheader.js');
    // Add 'sticky-enabled' class to the table to identify it for JS.
    // This is needed to target tables constructed by this function.
    $attributes['class'][] = 'sticky-enabled';
  }

  $output = '<div class="overflow-fix">';
  $output .= '<table' . drupal_attributes($attributes) . ">\n";

  if (isset($caption)) {
    $output .= '<caption>' . $caption . "</caption>\n";
  }

  // Format the table columns:
  if (!empty($colgroups)) {
    foreach ($colgroups as $number => $colgroup) {
      $attributes = array();

      // Check if we're dealing with a simple or complex column
      if (isset($colgroup['data'])) {
        foreach ($colgroup as $key => $value) {
          if ($key == 'data') {
            $cols = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $cols = $colgroup;
      }

      // Build colgroup
      if (is_array($cols) && count($cols)) {
        $output .= ' <colgroup' . drupal_attributes($attributes) . '>';
        $i = 0;
        foreach ($cols as $col) {
          $output .= ' <col' . drupal_attributes($col) . ' />';
        }
        $output .= " </colgroup>\n";
      }
      else {
        $output .= ' <colgroup' . drupal_attributes($attributes) . " />\n";
      }
    }
  }

  // Add the 'empty' row message if available.
  if (empty($rows) && $empty) {
    $header_count = 0;
    if (!empty($header)) {
      foreach ($header as $header_cell) {
        if (is_array($header_cell)) {
          $header_count += isset($header_cell['colspan']) ? $header_cell['colspan'] : 1;
        }
        else {
          ++$header_count;
        }
      }
    }
    $rows[] = array(array(
      'data' => $empty,
      'colspan' => $header_count,
      'class' => array('empty', 'message'),
    ));
  }

  // Format the table header:
  if (!empty($header)) {
    $ts = tablesort_init($header);
    // HTML requires that the thead tag has tr tags in it followed by tbody
    // tags. Using ternary operator to check and see if we have any rows.
    $output .= (!empty($rows) ? ' <thead><tr>' : ' <tr>');
    foreach ($header as $cell) {
      $cell = tablesort_header($cell, $header, $ts);
      $output .= _theme_table_cell($cell, TRUE);
    }
    // Using ternary operator to close the tags based on whether or not there are rows
    $output .= (!empty($rows) ? " </tr></thead>\n" : "</tr>\n");
  }
  else {
    $ts = array();
  }

  // Format the table rows:
  if (!empty($rows)) {
    $output .= "<tbody>\n";
    $flip = array(
      'even' => 'odd',
      'odd' => 'even',
    );
    $class = 'even';
    foreach ($rows as $number => $row) {
      // Check if we're dealing with a simple or complex row
      if (isset($row['data'])) {
        $cells = $row['data'];
        $no_striping = isset($row['no_striping']) ? $row['no_striping'] : FALSE;

        // Set the attributes array and exclude 'data' and 'no_striping'.
        $attributes = $row;
        unset($attributes['data']);
        unset($attributes['no_striping']);
      }
      else {
        $cells = $row;
        $attributes = array();
        $no_striping = FALSE;
      }
      if (!empty($cells)) {
        // Add odd/even class
        if (!$no_striping) {
          $class = $flip[$class];
          $attributes['class'][] = $class;
        }

        // Build row
        $output .= ' <tr' . drupal_attributes($attributes) . '>';
        $i = 0;
        foreach ($cells as $cell) {
          $cell = tablesort_cell($cell, $header, $ts, $i++);
          $output .= _theme_table_cell($cell);
        }
        $output .= " </tr>\n";
      }
    }
    $output .= "</tbody>\n";
  }

  $output .= "</table>\n";
  $output .= "</div>\n";
  return $output;
}

/**
 * Set dark skin for CKEditor.
 * Implements hook_ckeditor_settings_alter().
 */
function adminimal_ckeditor_settings_alter(&$settings) {

  // Check if selected adminimal skin is dark.
  if (theme_get_setting('adminimal_theme_skin') == 'dark') {
    $adminimal_path = drupal_get_path('theme', 'adminimal');
    global $base_url;
    $settings['skin'] = 'adminimal-dark, '. $base_url .'/'. $adminimal_path . '/skins/dark/ckeditor/';
    array_push($settings['contentsCss'], $base_url .'/'. $adminimal_path . '/skins/dark/ckeditor/contents.css');
  }
}

/**
 * Implements hook_preprocess_entity().
 */
function adminimal_preprocess_entity(&$variables) {
  if ($variables['entity_type'] == 'paragraphs_item' && $variables['elements']['#bundle'] == 'jornadas') {
    if (!empty($variables['paragraphs_item']->field_jornadas)) {
      $jornadas_partidos = [];
      switch ($variables['paragraphs_item']->field_jornadas[LANGUAGE_NONE][0]['target_id']) {
        case 6:
          $jornadas_partidos = _generar_emparejamientos_grupo(6);
          break;
        case 7:
          $jornadas_partidos = _generar_emparejamientos_grupo(7);
          break;
          // COPA Y FASE FINAL.
//        case 8:
//          break;
//        case 9:
//          break;
      }
      $variables['jornadas_partidos'] = $jornadas_partidos;
      if ($variables['paragraphs_item']->field_jornadas[LANGUAGE_NONE][0]['target_id'] == 6) {
        $variables['ul_class'] = 'slideshow-container-grupo-1';
        $variables['li_class'] = 'mySlides-grupo-1';
      }
      else {
        $variables['ul_class'] = 'slideshow-container-grupo-2';
        $variables['li_class'] = 'mySlides-grupo-2';
      }
    }
  }
}

/**
 * Función para generar un array con emparejamientos por jornada y.
 */
function _generar_emparejamientos_grupo($vid) {
  $grupo = $vid == 6 ? '%Grupo 1%' : '%Grupo 2%';
  // Cargamos todos los partidos del grupo.
  $partidos = [];
  $query = db_query("SELECT nid FROM {node} WHERE type = :type AND title LIKE :grupo", [':type' => 'partido', ':grupo' => $grupo]);
  $result = $query->fetchAll();
  if (!empty($result)) {
    foreach ($result as $partido) {
      $partido = node_load($partido->nid);
      if ($partido->status == 1) {
        $partidos[] = $partido;
      }
    }
  }
  // Obtenemos todas las jornadas generadas para el grupo.
  $jornadas = taxonomy_get_tree($vid);
  // Reordenamos el array por tid.
  $jornadas_tids = [];
  foreach ($jornadas as $jornada) {
    $jornadas_tids[] = $jornada->tid;
  }
  sort($jornadas_tids, SORT_NUMERIC);
  array_multisort($jornadas, $jornadas_tids);
  $jornadas_partidos = [];
  foreach ($partidos as $partido)  {
    foreach ($jornadas as $jornada) {
      if ($vid == 6) {
        $condition1 = !empty($partido->field_jornada_grupo_1);
        $condition2 = $jornada->tid == $partido->field_jornada_grupo_1[LANGUAGE_NONE][0]['tid'];
      }
      else {
        $condition1 = !empty($partido->field_jornada_grupo_2);
        $condition2 = $jornada->tid == $partido->field_jornada_grupo_2[LANGUAGE_NONE][0]['tid'];
      }
      if ($condition1 && $condition2) {
        $equipo1 = node_load($partido->field_equipo_1[LANGUAGE_NONE][0]['target_id']);
        $equipo2 = node_load($partido->field_equipo_2[LANGUAGE_NONE][0]['target_id']);
        $goles_equipo1 = $goles_equipo2 = 0;
        if (!empty($partido->field_goles_jugador_1_equipo_1) && !empty($partido->field_goles_jugador_2_equipo_1)) {
          $goles_equipo1 = $partido->field_goles_jugador_1_equipo_1[LANGUAGE_NONE][0]['value'] + $partido->field_goles_jugador_2_equipo_1[LANGUAGE_NONE][0]['value'];
        }
        if (!empty($partido->field_goles_jugador_1_equipo_2) && !empty($partido->field_goles_jugador_2_equipo_2)) {
          $goles_equipo2 = $partido->field_goles_jugador_1_equipo_2[LANGUAGE_NONE][0]['value'] + $partido->field_goles_jugador_2_equipo_2[LANGUAGE_NONE][0]['value'];
        }
        $jornadas_partidos[$jornada->name][] = '<span class="equipo-title1">' . $equipo1->title . '</span> ' . '<span class="equipo-goles">' . $goles_equipo1 . '</span>' . ' <span class="versus">vs</span> ' . '<span class="equipo-goles">' . $goles_equipo2 . '</span>' . '   <span class="equipo-title2">' . $equipo2->title . '</span>';
      }
    }
  }

  return $jornadas_partidos;
}
