<?php

/**
* @file
* Default theme implementation for a single paragraph item.
*
* Available variables:
* - $content: An array of content items. Use render($content) to print them all, or
*   print a subset such as render($content['field_example']). Use
*   hide($content['field_example']) to temporarily suppress the printing of a
*   given element.
* - $classes: String of classes that can be used to style contextually through
*   CSS. It can be manipulated through the variable $classes_array from
*   preprocess functions. By default the following classes are available, where
*   the parts enclosed by {} are replaced by the appropriate values:
*   - entity
*   - entity-paragraphs-item
*   - paragraphs-item-{bundle}
*
* Other variables:
* - $classes_array: Array of html class attribute values. It is flattened
*   into a string within the variable $classes.
*
* @see template_preprocess()
* @see template_preprocess_entity()
* @see template_process()
*/

?>

<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <?php print '<h2 class="embedded-title">' . $content['field_title'][0]['#markup'] . '</h2>'; ?>
    <div class="container-fluid">
      <div class="row">
        <ul class="<?php print $ul_class; ?>">
            <?php $contador = 1; ?>
            <?php foreach ($jornadas_partidos as $key => $jornada): ?>
              <?php if ($contador == 1 || ($contador - 1) % 3 == 0): ?>
                <?php $old_contador = $contador; ?>
                <?php if ($contador == 1): ?>
                  <li class="<?php print $li_class; ?> showing">
                <?php else: ?>
                  <li class="<?php print $li_class; ?>">
                <?php endif; ?>

              <?php endif; ?>
              <div class="col-xs-4 emparejamientos">
                <?php print '<h3 class="jornada-title">' . $key . '</h3>'; ?>
                <?php foreach ($jornada as $partido): ?>
                  <?php print '<p>' . $partido . '</p>'; ?>
                <?php endforeach; ?>
              </div>
              <?php if ($contador - 2 == $old_contador): ?>
                </li>
              <?php endif; ?>
              <?php $contador++; ?>
            <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>