<?php
/* Smarty version 3.1.46, created on 2025-11-27 17:32:38
  from '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.46',
  'unifunc' => 'content_69287d267fe581_81576464',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd090584e63f9b76262ac5a79760470ab7e7ac4d6' => 
    array (
      0 => '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/layout.tpl',
      1 => 1764261156,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_69287d267fe581_81576464 (Smarty_Internal_Template $_smarty_tpl) {
echo smarty_function_locale(array('path'=>"../locale",'domain'=>"messages"),$_smarty_tpl);?>

<!DOCTYPE html>
<html lang="<?php if ((isset($_smarty_tpl->tpl_vars['language']->value))) {
echo $_smarty_tpl->tpl_vars['language']->value;
} else { ?>en<?php }?>">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Consultation Page<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>">
    <title><?php if ((isset($_smarty_tpl->tpl_vars['meta_title']->value))) {
echo $_smarty_tpl->tpl_vars['meta_title']->value;
} else {
$_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Consultation<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);
}?></title>
    
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />

    <link type="text/css" rel="stylesheet" href="/inc/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">

    <link type="text/css" rel="stylesheet" media="all" href="/inc/css/custom.css?<?php echo $_smarty_tpl->tpl_vars['rnd']->value;?>
"/>
   
    <!--<?php echo '<script'; ?>
 src="/inc/js/jquery-1.12.4.min.js"><?php echo '</script'; ?>
>-->
    <?php echo '<script'; ?>
 src="/inc/js/jquery-3.7.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
        var language="<?php echo $_SESSION['language'];?>
";
    <?php echo '</script'; ?>
>
    
    <?php if ((isset($_smarty_tpl->tpl_vars['additional_css']->value))) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['additional_css']->value, 'css');
$_smarty_tpl->tpl_vars['css']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['css']->value) {
$_smarty_tpl->tpl_vars['css']->do_else = false;
?><link href="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
include/css/<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
" type="text/css" rel="stylesheet" media="screen" /><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>
    <?php if ((isset($_smarty_tpl->tpl_vars['additional_js']->value))) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['additional_js']->value, 'js');
$_smarty_tpl->tpl_vars['js']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['js']->value) {
$_smarty_tpl->tpl_vars['js']->do_else = false;
echo '<script'; ?>
 src="/inc/js/<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
"><?php echo '</script'; ?>
><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>


    </head>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->

<body class="">
<?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


            <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

            <?php if ((isset($_smarty_tpl->tpl_vars['addition']->value))) {
echo $_smarty_tpl->tpl_vars['addition']->value;
}?>
       


<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


    
    <?php echo '<script'; ?>
 src="/inc/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/inc/js/custom.js?<?php echo $_smarty_tpl->tpl_vars['rnd']->value;?>
"><?php echo '</script'; ?>
>

    </head>
    <?php if ((isset($_smarty_tpl->tpl_vars['additional_js']->value))) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['additional_js']->value, 'js');
$_smarty_tpl->tpl_vars['js']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['js']->value) {
$_smarty_tpl->tpl_vars['js']->do_else = false;
echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
inc/js/<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
"><?php echo '</script'; ?>
><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?> 
	<?php if ((isset($_smarty_tpl->tpl_vars['additional_head_script']->value))) {
echo '<script'; ?>
><?php echo $_smarty_tpl->tpl_vars['additional_head_script']->value;
echo '</script'; ?>
><?php }?>
    

<?php if ((isset($_smarty_tpl->tpl_vars['additional_body_script']->value))) {
echo '<script'; ?>
><?php echo $_smarty_tpl->tpl_vars['additional_body_script']->value;
echo '</script'; ?>
><?php }?>


</body></html>
<?php }
}
