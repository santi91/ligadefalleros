<?php
/**
* @file
* Main page template.
*/
?>

<?php if (isset($user->roles[4])): ?>
  <div id="branding" class="clearfix custom-header">

  <!--	--><?php //print $breadcrumb; ?>

    <?php print render($title_prefix); ?>

    <?php if ($title): ?>
      <h1 class="page-title"><?php print $title; ?></h1>
    <?php endif; ?>

    <?php print render($title_suffix); ?>

    <?php if (isset($logout_link)): ?>
      <?php print $logout_link; ?>
    <?php endif; ?>
  </div>
<?php endif; ?>

<div id="navigation" class="custom-header">

  <?php // Cargar aquí menú con view de jugadores y gestión. ?>
  <?php if (isset($gestion_menu)): ?>
    <div id="menu-gestion">
      <?php print theme('links__menu_gestion', array('links' => $gestion_menu)); ?>
    </div>
  <?php endif; ?>
  <?php if ($primary_local_tasks && current_path() != 'user/login'): ?>
    <?php print render($primary_local_tasks); ?>
  <?php endif; ?>

  <?php if ($secondary_local_tasks): ?>
    <div class="tabs-secondary clearfix"><ul class="tabs secondary"><?php print render($secondary_local_tasks); ?></ul></div>
  <?php endif; ?>

</div>

<div id="page">

	<div id="content" class="clearfix">
		<div class="element-invisible"><a id="main-content"></a></div>

	<?php if ($messages): ?>
		<div id="console" class="clearfix"><?php print $messages; ?></div>
	<?php endif; ?>

	<?php if ($page['help']): ?>
		<div id="help">
			<?php print render($page['help']); ?>
		</div>
	<?php endif; ?>

	<?php if (isset($page['content_before'])): ?>
		<div id="content-before">
			<?php print render($page['content_before']); ?>
		</div>
	<?php endif; ?>

	<?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>

  <div id="content-wrapper">

    <?php if (isset($page['sidebar_left'])): ?>
      <div id="sidebar-left">
        <?php print render($page['sidebar_left']); ?>
      </div>
    <?php endif; ?>

    <div id="main-content">
      <?php if (isset($add_link)): ?>
        <div id="add-section">
          <?php print $add_link; ?>
        </div>
      <?php endif; ?>
      <?php if (isset($show_resultados)): ?>
        <div id="resultados-partido-edit" class="partidos">
          <?php if (!empty($equipo_1) && !empty($equipo_2)): ?>
            <?php $resultado_class = 'result-shown'; ?>
          <?php else: ?>
            <?php $resultado_class = 'result-not-shown'; ?>
          <?php endif; ?>
          <?php print '<h2 class="' . $resultado_class . '">'; ?>
          <?php print '<span id="nombre-equipo-1">' . $equipo_1 . '</span> <span id="goles-equipo-1">' . $goles_equipo_1 . '</span>  -  '; ?>
          <?php print '<span id="goles-equipo-2">' . $goles_equipo_2 . '</span> <span id="nombre-equipo-2">' . $equipo_2 . '</span>'; ?>
          <?php print '</h2>'; ?>
        </div>
      <?php endif; ?>
      <?php print render($page['content']); ?>
	  </div>

    <?php if (isset($page['sidebar_right'])): ?>
      <div id="sidebar-right">
        <?php print render($page['sidebar_right']); ?>
      </div>
    <?php endif; ?>
	
	</div>

	<?php if (isset($page['content_after'])): ?>
		<div id="content-after">
			<?php print render($page['content_after']); ?>
		</div>
	<?php endif; ?>

	</div>

	<div id="footer">
		<?php print $feed_icons; ?>
	</div>

</div>
