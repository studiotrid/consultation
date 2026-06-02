<?php
/* Smarty version 3.1.46, created on 2026-03-13 07:46:31
  from '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/moduli/test.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.46',
  'unifunc' => 'content_69b3b2c7526318_28718834',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f3045906a7e68d4098454b2b5d8d51dcf77c79ad' => 
    array (
      0 => '/home/admin/web/consultation.profesionalnaastrologija.com/public_html/templates/moduli/test.tpl',
      1 => 1769643935,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:moduli/tsTestGraf.tpl' => 1,
    'file:moduli/tsPostTestGraf.tpl' => 1,
  ),
),false)) {
function content_69b3b2c7526318_28718834 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php if ((isset($_smarty_tpl->tpl_vars['modultest']->value)) && is_array($_smarty_tpl->tpl_vars['modultest']->value)) {?>

<?php if (count($_smarty_tpl->tpl_vars['modultest']->value) > 0) {?>
    <!-- DEBUG: Entering foreach loop -->
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['modultest']->value, 'test');
$_smarty_tpl->tpl_vars['test']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['test']->value) {
$_smarty_tpl->tpl_vars['test']->do_else = false;
?>
        <!-- DEBUG: Test item - id=<?php echo $_smarty_tpl->tpl_vars['test']->value['id'];?>
, konsultacija=<?php echo $_smarty_tpl->tpl_vars['test']->value['konsultacija'];?>
 -->
        <div class="testModul ikona" id="testDugme<?php echo $_smarty_tpl->tpl_vars['test']->value['id'];?>
" title="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Click to take test<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><span><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>TAKE TEST<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></div>
        <div id="testPolaganjeModal<?php echo $_smarty_tpl->tpl_vars['test']->value['id'];?>
" style="display:none"></div>

    <?php echo '<script'; ?>
 type="text/javascript">
        $(document).ready(function(){ 
            $('#testDugme<?php echo $_smarty_tpl->tpl_vars['test']->value['id'];?>
').on('click', function(){
                // Use absolute path so it resolves outside @CMS routing
                // For standalone tests (konsultacija=0), pass testID parameter
                var src = '<?php echo $_smarty_tpl->tpl_vars['basepath']->value;?>
testPolaganje.php?konsultacija=<?php echo $_smarty_tpl->tpl_vars['test']->value['konsultacija'];?>
';
                <?php if ($_smarty_tpl->tpl_vars['test']->value['konsultacija'] == 0) {?>
                src += '&testID=<?php echo $_smarty_tpl->tpl_vars['test']->value['id'];?>
';
                <?php }?>
                console.log('Opening test form:', src);
                
                var $modal = $('#testPolaganjeModal<?php echo $_smarty_tpl->tpl_vars['test']->value['id'];?>
');
                $modal.html('<iframe src="'+src+'" style="border:none;width:100%;height:100%"></iframe>');
                $modal.dialog({
                    modal: true,
                    width: 700,
                    height: 800,
                    title: '<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Take Test<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>',
                    open: function() {
                        console.log('Dialog opened successfully');
                    }
                });
            });

        });
    <?php echo '</script'; ?>
>
     <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}?>


<?php if ((isset($_smarty_tpl->tpl_vars['modultestTest']->value)) && count($_smarty_tpl->tpl_vars['modultestTest']->value) > 0) {?>
<div class="testModultest ikona" title="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Click to view test results<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><span><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>TEST RESULTS<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></div>
<?php echo '<script'; ?>
 type="text/javascript">
    $(document).ready(function(){
        $('.testModultest').on('click', function(){
            $('.testGrafikoni').toggleClass('dn');
            $(this).toggleClass('active');
            
            // Scroll to the test results
            if(!$('.testGrafikoni').hasClass('dn')) {
                $('html, body').animate({
                    scrollTop: $('.testGrafikoni').offset().top - 100
                }, 500);
            }
        });
    });
<?php echo '</script'; ?>
>

<?php }?>

<?php if ((isset($_smarty_tpl->tpl_vars['modultestTS']->value)) && count($_smarty_tpl->tpl_vars['modultestTS']->value) > 0) {?>
<div class="testModultestTS ikona" title="<?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Click to view Consciousness Technology tests<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?>"><span><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>CT TESTS<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?></span></div>
<div class="tsTestGrafikoni dn">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['modultestTS']->value, 'tsTest', false, NULL, 'tsLoop', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$_smarty_tpl->tpl_vars['tsTest']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tsTest']->value) {
$_smarty_tpl->tpl_vars['tsTest']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_tsLoop']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_tsLoop']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_tsLoop']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_tsLoop']->value['total'];
?>
        <div class="ts-test-container">
            <h3 class="ts-test-title"><?php $_smarty_tpl->smarty->_cache['_tag_stack'][] = array('t', array());
$_block_repeat=true;
echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);
while ($_block_repeat) {
ob_start();?>Consciousness Technology<?php $_block_repeat=false;
echo smarty_block_t(array(), ob_get_clean(), $_smarty_tpl, $_block_repeat);
}
array_pop($_smarty_tpl->smarty->_cache['_tag_stack']);?> - <span class="ts-planeta-naziv"><?php echo $_smarty_tpl->tpl_vars['tsTest']->value['nazivPlanete'];?>
</span></h3>
            
            <div class="ts-grafikoni-wrapper">
                                <div class="ts-grafikon-item">
                    <?php $_smarty_tpl->_subTemplateRender("file:moduli/tsTestGraf.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                </div>
                
                                <?php if ((isset($_smarty_tpl->tpl_vars['tsTest']->value['post']['id'])) && $_smarty_tpl->tpl_vars['tsTest']->value['post']['id'] != '') {?>
                <div class="ts-grafikon-item">
                    <?php $_smarty_tpl->_subTemplateRender("file:moduli/tsPostTestGraf.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                </div>
                <?php }?>
            </div>
        </div>
        <?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_tsLoop']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_tsLoop']->value['last'] : null)) {?>
        <hr class="ts-test-separator" />
        <?php }?>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>

<?php echo '<script'; ?>
 type="text/javascript">
    $(document).ready(function(){
        $('.testModultestTS').on('click', function(){
            $('.tsTestGrafikoni').toggleClass('dn');
        });
    });
<?php echo '</script'; ?>
>

<style>
.ts-test-container {
    margin-bottom: 30px;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
}

.ts-test-title {
    text-align: center;
    font-size: 24px;
    margin-bottom: 30px;
    color: #333;
}

.ts-planeta-naziv {
    color: #5f95c9;
    font-weight: bold;
}

.ts-grafikoni-wrapper {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.ts-grafikon-item {
    width: 100%;
}

.ts-test-subtitle {
    font-size: 18px;
    color: #5f95c9;
    margin-bottom: 15px;
    text-align: center;
}

.ts-graph {
    width: 90%;
    height: 400px;
    margin-left: 10%;
    padding-left: 20px;
    border-left: 4px solid #5f95c9;
    border-bottom: 4px solid #5f95c9;
    position: relative;
    margin-bottom: 20px;
    box-shadow: -1px 1px 2px #DADADA;
}

.ts-stubic-holder {
    cursor: pointer;
    height: 30px;
    margin-top: 10px;
    left: -50px;
    position: relative;
}

.ts-stubic {
    height: 30px;
    position: absolute;
    left: 30px;
    top: 0;
    box-shadow: 0px 0px 2px #DADADA;
}

.ts-stubic-text {
    width: 40px;
    font-family: astroregular, serif;
    font-size: 30px;
    text-align: left;
    position: absolute;
    left: -10px;
}

.ts-stubic-procenat {
    height: 30px;
    font-size: 1.3em;
    text-align: left;
    position: absolute;
    right: -50px;
}

.ts-odmor-box {
    text-align: center;
    margin: 20px 0;
    padding: 15px;
    background: #fff;
    border-radius: 5px;
    border: 2px solid #5f95c9;
}

.ts-odmor-vrednost {
    font-size: 24px;
    color: #d9534f;
    font-weight: bold;
}

.ts-odgovori-box {
    margin-top: 30px;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    border: 1px solid #ddd;
}

.ts-odgovori-box h5 {
    color: #d9534f;
    margin-bottom: 15px;
}

.ts-odgovori-box p {
    margin-bottom: 15px;
    line-height: 1.6;
}

.ts-test-separator {
    margin: 40px 0;
    border: 0;
    border-top: 3px solid #d9534f;
}

.linija2 {
    border-left: 1px dashed #DDD;
    background: transparent;
    height: 430px;
    width: 0%;
    position: absolute;
    text-indent: -15px;
    top: -20px;
}

.linija2.linija0 { left: calc(0% - 10px); }
.linija2.linija10 { left: calc(10% - 10px); }
.linija2.linija20 { left: calc(20% - 10px); }
.linija2.linija30 { left: calc(30% - 10px); }
.linija2.linija40 { left: calc(40% - 10px); }
.linija2.linija50 { left: calc(50% - 10px); }
.linija2.linija60 { left: calc(60% - 10px); }
.linija2.linija70 { left: calc(70% - 10px); }
.linija2.linija80 { left: calc(80% - 10px); }
.linija2.linija90 { left: calc(90% - 10px); }
.linija2.linija100 { left: calc(100% - 10px); }

.posto0, .posto1, .posto2, .posto3, .posto4, .posto5, .posto6, .posto7, .posto8, .posto9, .posto10 {
    position: relative;
    top: -10px;
    cursor: pointer;
}

/* Responsive design */
@media (max-width: 768px) {
    .ts-graph {
        width: 95%;
        margin-left: 5%;
    }
    
    .ts-test-title {
        font-size: 18px;
    }
}
</style>

<?php }
}
}
