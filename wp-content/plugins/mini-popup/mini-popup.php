<?php
/*
 * Plugin Name: Mini PopUp
 * Plugin URI: http://rangecode.com/plugins/mini-popup/
 * Description: Shows a popup to share your fanpage in your blog easily.
 * Author: Iago Melanias
 * Version: 1.2.3
 * Author URI: http://imelanias.com/
 * Text Domain: mini-popup
 * Domain Path: /lang
 */

function my_plugin_init() {
  load_plugin_textdomain( 'mini-popup', false, 'mini-popup/lang' );
}
add_action('init', 'my_plugin_init');

// Criar menu para o plugin no WP
function add_minipopup_menu() {
    add_options_page('Mini PopUp', 'Mini PopUp', 'manage_options', 'mini-popup', 'admin_minipopup');
}

add_action('admin_menu', 'add_minipopup_menu');
add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('js/colorpicker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

// Adicionar opcoes no DB
function set_minipopup_options() {
    add_option('minipopup_style', 'desativado');
    add_option('minipopup_smart_mode', 'desativado');
    add_option('c1_minipopup', 'https://');
    add_option('c2_minipopup', '7');
    add_option('c3_minipopup', '#6B6B6B');
    add_option('c4_minipopup', '3');
}

// Deleta opcoes quando o plugin &eacute; desinstalado
function unset_minipopup_options() {
    delete_option('minipopup_style');
    delete_option('minipopup_smart_mode');
    delete_option('c1_minipopup');
    delete_option('c2_minipopup');
    delete_option('c3_minipopup');
    delete_option('c4_minipopup');
}

// instrucoes ao instalar ou desistalar o plugin
register_activation_hook(__FILE__, 'set_minipopup_options');
register_deactivation_hook(__FILE__, 'unset_minipopup_options');

// Pagina de opcoes
function admin_minipopup() {
    ?>
    <div class="wrap">
        <div class="icon32" id="icon-options-general"><br /></div>
        <h2><?php _e('Mini PopUp settings','mini-popup'); ?></h2>
        <?php
        if (!empty($_POST) && check_admin_referer('minipopup_nonce_action', 'minipopup_nonce_field')) {
            update_minipopup_options();
        }
        print_minipopup_form();
        ?>
    </div>
    <?php
}

// Validar op&ccedil;&otilde;es
function update_minipopup_options() {
    $correto = false;
    // Layout do plugin
    if ($_REQUEST['minipopup_style']) {
        update_option('minipopup_style', $_REQUEST['minipopup_style']);
        $correto = true;
    }
    if ($_REQUEST['minipopup_smart_mode']) {
        update_option('minipopup_smart_mode', $_REQUEST['minipopup_smart_mode']);
        $correto = true;
    }
    if ($_REQUEST['c1_minipopup']) {
        update_option('c1_minipopup', $_REQUEST['c1_minipopup']);
        $correto = true;
    }
    if ($_REQUEST['c2_minipopup']) {
        update_option('c2_minipopup', $_REQUEST['c2_minipopup']);
        $correto = true;
    }
    if ($_REQUEST['c3_minipopup']) {
        update_option('c3_minipopup', $_REQUEST['c3_minipopup']);
        $correto = true;
    }
    if ($_REQUEST['c4_minipopup']) {
        update_option('c4_minipopup', $_REQUEST['c4_minipopup']);
        $correto = true;
    }
    if ($correto) {
        ?><div id="message" class="updated fade">
            <p><?php _e('Saved settings.','mini-popup'); ?></p>
        </div> <?php
    } else {
        ?><div id="message" class="error fade">
            <p><?php _e('Error saving settings.','mini-popup'); ?></p>
        </div><?php
    }
}

// Formulario com as opcoes
function print_minipopup_form() {
    $minipopup_style = get_option('minipopup_style');
    $minipopup_smart_mode = get_option('minipopup_smart_mode');
    $minipopup_plugin_dir = plugin_dir_url(__FILE__);
    $default_c1_minipopup = get_option('c1_minipopup');
    $default_c2_minipopup = get_option('c2_minipopup');
    $default_c3_minipopup = get_option('c3_minipopup');
    $default_c4_minipopup = get_option('c4_minipopup');
    ?>
    <form action="" method="post">
        <h3 style="margin: 20px 0 -5px;"><?php _e('Basic settings','mini-popup'); ?></h3>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="minipopup_style_default"><?php _e('Working setting','mini-popup'); ?></label></th>
                <td>
                    <label><input style="margin:0 0 -15px;padding:0;display:block" type="radio" id="minipopup_style_default" name="minipopup_style" value="default" <?php if ($minipopup_style == "default") { _e('checked="checked"'); }?> />
                    <div style="margin-left: 20px;"><?php _e('Activated','mini-popup'); ?></div></label>
                    <label><input style="margin:0 0 -15px;padding:0;display:block" type="radio" id="minipopup_show_desativado" name="minipopup_style" value="desativado" <?php if ($minipopup_style == "desativado") { _e('checked="checked"'); } ?> />
                    <div style="margin-left: 20px;"><?php _e('Disabled','mini-popup'); ?></div></label>
                    <label><input style="margin:0 0 -15px;padding:0;display:block" type="radio" id="minipopup_show_maintenance" name="minipopup_style" value="maintenance" <?php if ($minipopup_style == "maintenance") { _e('checked="checked"'); } ?> />
                    <div style="margin-left: 20px;"><?php _e('Configuration mode <i>(the cookies are disabled to test the popup)</i>','mini-popup'); ?></div></label>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="c1_minipopup"><?php _e('Facebook Page URL','mini-popup'); ?></label></th>
                <td>
                    <input class="medium-text code" id="c1_minipopup" style="width: 300px;" type="url" name="c1_minipopup" value="<?php echo stripcslashes($default_c1_minipopup); ?>" required />
                    <br />
                    <span class="description"><?php _e('Enter the Facebook fanpage address','mini-popup'); ?> (https://www.facebook.com/...).</span>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="c2_minipopup"><?php _e('Cookie duration','mini-popup'); ?></label></th>
                <td>
                    <input type="text" class="regular-text" id="c2_minipopup" style="width: 300px;" name="c2_minipopup" value="<?php echo stripcslashes($default_c2_minipopup); ?>" />
                    <br />
                    <span class="description"><?php _e('The number of days that the cookie file will be saved in browser.','mini-popup'); ?><br /><?php _e('<strong>For example:</strong> if you enter 7, when closing the popup, a file will be recorded and popup only will open again in 7 days.','mini-popup'); ?></span>
                </td>
            </tr>
        </table>

        <h3 style="margin: 20px 0 -5px;"><?php _e('Design settings','mini-popup'); ?></h3>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="c3_minipopup"><?php _e('Color of the close button','mini-popup'); ?></label></th>
                <td>
                    <input type="text" value="<?php echo stripcslashes($default_c3_minipopup); ?>" class="popupcolor" data-default-color="#6B6B6B" id="c3_minipopup" name="c3_minipopup" />
                </td>
            </tr>
        </table>

        <h3 style="margin: 20px 0 -5px;"><?php _e('Smart display mode','mini-popup'); ?></h3>
        <p><?php _e('With this mode, you will display the popup only when your reader view a specific number of pages. For example: instead of the reader to see the popup the first time you access your blog, they just will see the popup on access the fourth page. So, the popup will be displayed only for interested readers in the content, increasing the quality and the conversion of their fans.','mini-popup'); ?></p>
                <p><?php _e('<strong>Note:</strong> this feature only works when the plugin is enabled mode.','mini-popup'); ?></p>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="minipopup_smart_mode"><?php _e('Working setting','mini-popup'); ?></label></th>
                <td>
                    <label><input style="margin:0 0 -15px;padding:0;display:block" type="radio" id="minipopup_smart_mode__default" name="minipopup_smart_mode" value="default" <?php if ($minipopup_smart_mode == "default") { _e('checked="checked"'); }?> />
                    <div style="margin-left: 20px;"><?php _e('Activated','mini-popup'); ?></div></label>
                    <label><input style="margin:0 0 -15px;padding:0;display:block" type="radio" id="minipopup_smart_mode_desativado" name="minipopup_smart_mode" value="desativado" <?php if ($minipopup_smart_mode == "desativado") { _e('checked="checked"'); } ?> />
                    <div style="margin-left: 20px;"><?php _e('Disabled','mini-popup'); ?></div></label>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="c4_minipopup"><?php _e('Number of pages visited','mini-popup'); ?></label></th>
                <td>
                    <input type="text" class="regular-text" id="c4_minipopup" style="width: 300px;" name="c4_minipopup" value="<?php echo stripcslashes($default_c4_minipopup); ?>" />
                    <br />
                    <span class="description"><?php _e('The number of pages from the first visit that will appear the popup.','mini-popup'); ?><br/> <?php _e('<strong>For example:</strong> if you enter 5, the reader only will see the popup after access 5 pages.','mini-popup'); ?></span>
                </td>
            </tr>
        </table>

        <p class="submit">
            <?php wp_nonce_field('minipopup_nonce_action', 'minipopup_nonce_field','mini-popup'); ?>
            <input type="submit" class="button-primary" name="submit" value="<?php _e('Save changes','mini-popup'); ?>" />
        </p>
    </form>
        <?php
    }

// Verifica se plugin esta ativo 
if (get_option('minipopup_style') == 'default') {
    
    // Carrega scripts
    function minipopup_enqueue_script() {
        $mini_dir = plugin_dir_url(__FILE__);

        wp_enqueue_script('jquery');
        wp_register_style('mini_popup_style', $mini_dir . 'css/style.css');
        wp_enqueue_style('mini_popup_style');
        wp_register_script('query_cookie', $mini_dir . 'js/jquery.cookie.js');
        wp_enqueue_script('query_cookie');
    }
    add_action('wp_enqueue_scripts', 'minipopup_enqueue_script');

    // Adicionar Box no Footer do Blog
    function minipopup_add_box() {
    ?>
    <div id="fanback">
        <div id="fan-exit"></div>
        <div id="fanbox">
            <div class="closebutton"><div id="fanclose"></div><div class="colorclose" style="background: <?php echo esc_url(get_option('c3_minipopup')); ?>;"></div></div>
            <div id="framebox"><div><iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo esc_url(get_option('c1_minipopup')); ?>&amp;width=402&amp;height=255&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23E2E2E2&amp;stream=false&amp;header=false&amp;appId=329902783740649&amp;lang=<?php _e('en_US','mini-popup'); ?>" scrolling="no" allowTransparency="true"></iframe>
        </div></div></div>
    </div>
    <?php  } function minipopup_js_add_box() { ?>
<?php if (get_option('minipopup_smart_mode') == 'default') { ?>
<script type="text/javascript">(function(b){b(document).ready(function(){var c=localStorage.getItem("pageCount");if(!c){c=1}else{c++}localStorage.setItem("pageCount",c);if(c===<?php echo (get_option('c4_minipopup')); ?>){a()}});function a(){b("#fanback").delay(100).fadeIn("medium");b("#fanclose, #fan-exit").click(function(){b("#fanback").stop().fadeOut("medium")})}}(jQuery));</script>
<?php } ?>

<?php if (get_option('minipopup_smart_mode') == 'desativado') { ?>
<script type="text/javascript">jQuery(document).ready(function($){if($.cookie('minipopup_cookies')!='yes'){$('#fanback').delay(100).fadeIn('medium');$('#fanclose, #fan-exit').click(function(){$('#fanback').stop().fadeOut('medium')})}$.cookie('minipopup_cookies','yes',{path:'/',expires:<?php echo (get_option('c2_minipopup')); ?>})});</script>
    <?php } ?>

    <?php
    }
    add_filter('wp_footer', 'minipopup_add_box');
    add_filter('wp_head', 'minipopup_js_add_box');

}

// Verifica se plugin esta em modo manutenção
if (get_option('minipopup_style') == 'maintenance') {
    
    // Carrega scripts
    function minipopup_enqueue_script() {
        $mini_dir = plugin_dir_url(__FILE__);

        wp_enqueue_script('jquery');
        wp_register_style('mini_popup_style', $mini_dir . 'css/style.css');
        wp_enqueue_style('mini_popup_style');
    }
    add_action('wp_enqueue_scripts', 'minipopup_enqueue_script');

    // Adicionar Box no Footer do Blog
    function minipopup_add_box() {
    ?>
    <div id="fanback">
        <div id="fan-exit"></div>
        <div id="fanbox">
            <div class="closebutton"><div id="fanclose"></div><div class="colorclose" style="background: <?php echo esc_url(get_option('c3_minipopup')); ?>;"></div></div>
            <div id="framebox"><div><iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo esc_url(get_option('c1_minipopup')); ?>&amp;width=402&amp;height=255&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23E2E2E2&amp;stream=false&amp;header=false&amp;locale=<?php _e('en_US','mini-popup'); ?>" scrolling="no" allowTransparency="true"></iframe>
        </div></div></div>
    </div>
    <?php
    }
        function minipopup_js_add_box() {
    ?>
<script type="text/javascript">jQuery(document).ready(function($){$('#fanback').delay(100).fadeIn('medium');$('#fanclose, #fan-exit').click(function(){$('#fanback').stop().fadeOut('medium')})});</script>
    <?php
    }
    add_filter('wp_footer', 'minipopup_add_box');
    add_filter('wp_head', 'minipopup_js_add_box');

}