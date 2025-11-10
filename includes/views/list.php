<?php
namespace StaticJsonGenerator;
$generator = StaticJsonGenerator::instance();
?>

<div id="sjg" class="wrap">
  <h1>Static JSON Generator</h1>

  <section class="structure-list">
    <table>
      <tbody>
        <tr>
          <th>Type</th>
          <th>Data Path</th>
          <th>Post Types</th>
          <th></th>
        </tr>
        <?php foreach($generator->getPostListStructures() as $i => $structure): ?>
        <tr class="post-list">
          <?php if($i === 0): ?>
          <td rowspan="<?php echo count($generator->getPostListStructures()); ?>">Post List</td>
          <?php endif; ?>
          <td><span><?php echo $structure->file_name; ?></span>.json</td>
          <td>
            <ul class="post-types">
              <?php foreach($structure->post_types as $post_type): ?>
                <li><?php echo $post_type; ?></li>
              <?php endforeach; ?>
            </ul>
          </td>
          <td><a href="#">JSON Sample</a></td>
        </tr>
        <?php endforeach; ?>

        <?php foreach($generator->getPostDetailStructures() as $i => $structure): ?>
        <tr class="post-detail">
          <?php if($i === 0): ?>
          <td rowspan="<?php echo count($generator->getPostDetailStructures()); ?>">Post Detail</td>
          <?php endif; ?>
          <td><span><?php echo $structure->file_name; ?></span>.json</td>
          <td>
            <ul class="post-types">
              <?php foreach($structure->post_types as $post_type): ?>
                <li><?php echo $post_type; ?></li>
              <?php endforeach; ?>
            </ul>
          </td>
          <td><a href="#">JSON Sample</a></td>
        </tr>
        <?php endforeach; ?>

        <?php foreach($generator->getPageDetailStructures() as $i => $structure): ?>
        <tr class="post-detail">
          <?php if($i === 0): ?>
          <td rowspan="<?php echo count($generator->getPageDetailStructures()); ?>">Page Detail</td>
          <?php endif; ?>
          <td><span><?php echo $structure->file_name; ?></span>.json</td>
          <td>
            <ul class="post-types">
              <li>page</li>
            </ul>
          </td>
          <td><a href="#">JSON Sample</a></td>
        </tr>
        <?php endforeach; ?>

        <?php foreach($generator->getTermListStructures() as $i => [$taxonomy, $file_name, $_]): ?>
        <tr class="term-list">
          <?php if($i === 0): ?>
          <td rowspan="<?php echo count($generator->getTermListStructures()); ?>">Post List</td>
          <?php endif; ?>
          <td>data/<span><?php echo $file_name; ?></span>.json</td>
          <td>
            <ul class="post-types">
              <?php foreach($taxonomy as $tax): ?>
                <li><?php echo $tax; ?></li>
              <?php endforeach; ?>
            </ul>
          </td>
          <td><a href="#">JSON Sample</a></td>
        </tr>
        <?php endforeach; ?>

        <?php foreach($generator->getTermDetailStructures() as $i => [$taxonomy, $file_name, $_]): ?>
        <tr class="term-detail">
          <?php if($i === 0): ?>
          <td rowspan="<?php echo count($generator->getTermDetailStructures()); ?>">Post List</td>
          <?php endif; ?>
          <td>data/<span><?php echo $file_name; ?></span>.json</td>
          <td>
            <ul class="post-types">
              <?php foreach($taxonomy as $tax): ?>
                <li><?php echo $tax; ?></li>
              <?php endforeach; ?>
            </ul>
          </td>
          <td><a href="#">JSON Sample</a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</div>
