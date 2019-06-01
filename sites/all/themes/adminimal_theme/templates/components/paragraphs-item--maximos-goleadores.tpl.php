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

<?php if (!empty($jugador_goles)): ?>
  <div class="<?php print $classes; ?>"<?php print $attributes; ?>>
    <div class="content"<?php print $content_attributes; ?>>
      <?php print '<h2 class="goleadores-title">' . $content['field_title'][0]['#markup'] . '</h2>'; ?>
      <div class="scrolling">
        <ul class="jugadores-goles">
          <?php $contador = 1; ?>
          <?php foreach ($jugador_goles as $key => $goles): ?>
            <li>
              <?php print '<span class="jugador-title">' . $contador . '. ' . $key . ':</span> <span class="jugador-goles"> ' . $goles . '</span> '; ?>
            </li>
            <?php $contador++; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
<?php endif; ?>