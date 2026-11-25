<?php
/**
 * Admin Settings: Pengaturan Maklon Herbal
 */
if (!defined('ABSPATH')) exit;

function alafiat_add_admin_menu() {
    add_menu_page(
        'Pengaturan Maklon Herbal',
        'Pengaturan Maklon',
        'manage_options',
        'alafiat-maklon-settings',
        'alafiat_render_settings_page',
        'dashicons-admin-generic',
        25
    );
}
add_action('admin_menu', 'alafiat_add_admin_menu');

function alafiat_register_settings() {
    register_setting('alafiat_settings_group', 'alafiat_whatsapp_number');
    register_setting('alafiat_settings_group', 'alafiat_company_name');
    register_setting('alafiat_settings_group', 'alafiat_factory_address');
    register_setting('alafiat_settings_group', 'alafiat_cpotb_cert');
    register_setting('alafiat_settings_group', 'alafiat_moq_starter');
}
add_action('admin_init', 'alafiat_register_settings');

function alafiat_render_settings_page() {
    ?>
    <div class="wrap" style="max-width: 800px; margin-top: 24px;">
        <h1 style="font-weight: 700; margin-bottom: 20px;">Pengaturan Maklon Herbal (CV Al Afiat)</h1>
        
        <?php if (isset($_GET['settings-updated'])) : ?>
            <div class="notice notice-success is-dismissible">
                <p><strong>Pengaturan berhasil disimpan!</strong></p>
            </div>
        <?php endif; ?>

        <form method="post" action="options.php" style="background: #fff; padding: 24px; border-radius: 12px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <?php settings_fields('alafiat_settings_group'); ?>
            
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="alafiat_whatsapp_number">Nomor WhatsApp CS Maklon</label></th>
                    <td>
                        <input name="alafiat_whatsapp_number" type="text" id="alafiat_whatsapp_number" value="<?php echo esc_attr(get_option('alafiat_whatsapp_number', '6281234567890')); ?>" class="regular-text" placeholder="Contoh: 6281234567890" />
                        <p class="description">Gunakan format internasional tanpa tanda plus atau spasi (contoh: <code>6281234567890</code>). Nomor ini otomatis terpasang pada semua tombol CTA konsultasi dan simulasi.</p>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="alafiat_company_name">Nama Perusahaan / Pabrik</label></th>
                    <td>
                        <input name="alafiat_company_name" type="text" id="alafiat_company_name" value="<?php echo esc_attr(get_option('alafiat_company_name', 'CV Al Afiat Sehat Alami')); ?>" class="regular-text" />
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="alafiat_factory_address">Lokasi Fasilitas Pabrik</label></th>
                    <td>
                        <input name="alafiat_factory_address" type="text" id="alafiat_factory_address" value="<?php echo esc_attr(get_option('alafiat_factory_address', 'Magelang, Jawa Tengah, Indonesia')); ?>" class="regular-text" />
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="alafiat_cpotb_cert">Keterangan Sertifikasi Mutu</label></th>
                    <td>
                        <input name="alafiat_cpotb_cert" type="text" id="alafiat_cpotb_cert" value="<?php echo esc_attr(get_option('alafiat_cpotb_cert', 'Sertifikasi CPOTB BPOM RI & Halal Indonesia')); ?>" class="regular-text" />
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="alafiat_moq_starter">Ketentuan MOQ Starter</label></th>
                    <td>
                        <input name="alafiat_moq_starter" type="text" id="alafiat_moq_starter" value="<?php echo esc_attr(get_option('alafiat_moq_starter', '')); ?>" class="regular-text" placeholder="Menyesuaikan sediaan & jalur" />
                    </td>
                </tr>
            </table>

            <?php submit_button('Simpan Pengaturan Maklon'); ?>
        </form>
    </div>
    <?php
}
