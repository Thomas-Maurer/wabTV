<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$this->set('title', 'We are bob');
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>

  </title>

  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <meta name="description" content="WAB TV">

  <?= $this->Html->meta('icon') ?>
  <?= $this->Html->css('reset.css') ?> <!-- Reset style -->
  <?= $this->Html->css('colorpicker.min.css') ?>
  <?= $this->Html->css('admin.css') ?>

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>
  <?= $this->Html->script('bower_components/angular/angular'); ?>
  <?= $this->Html->script('bower_components/angular-route/angular-route.min'); ?>
  <?= $this->Html->script('bower_components/jquery/dist/jquery.min'); ?>
  <?= $this->Html->script('bower_components/jquery-ui/jquery-ui.min'); ?>
  <?= $this->Html->script('node_modules/socket.io/node_modules/socket.io-client/socket.io.js'); ?>
  <?= $this->Html->script('node_modules/underscore/underscore.js'); ?>
  <?= $this->Html->script('bower_components/angular-socket-io/socket.js'); ?>
  <?= $this->Html->script('bootstrap-colorpicker-module.min'); ?>
  <?= $this->Html->script('awesomplete/jquery.a-tools-1.4.1'); ?>
  <?= $this->Html->script('awesomplete/jquery.asuggest'); ?>
  <?= $this->Html->script('app'); ?>
  <?= $this->Html->script('services/services'); ?>
  <?= $this->Html->script('services/serverUrl'); ?>
  <?= $this->Html->script('controllers/adminController'); ?>

  <!--[if lt IE 9]>
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>
<body ng-app="wabTV">
  <?= $this->Flash->render('auth') ;?>
  <div ng-controller="adminWabTV" class="content">
    <span class='bckg'></span>
    <header>
      <h1>
        Admin WabTV
      </h1>
      <nav>
        <ul>
          <li>
            <a data-title='Projects'>Streaming</a>
          </li>
          <li>
            <a data-title='Team'>Utilisateurs</a>
          </li>
          <li>
            <a data-title='Diary'>Timeline</a>
          </li>
          <li>
           <?php echo $this->Html->link(
            'Smileys',
            ['controller' => 'Smileys', 'action' => 'controlPanel']
            ); ?>
          </li>
          <li>
            <a data-title='Search'>Unidad 6</a>
          </li>
        </ul>
      </nav>
    </header>
      <div class='title'>
        <h2>Projects</h2>
        <a href='#' title='Profil'>
          <?= $username ?>
        </a>
      </div>
    <div id="contentAdmin">
        <?= $this->fetch('content') ?>
    </div>
</div>
</body>
</html>
