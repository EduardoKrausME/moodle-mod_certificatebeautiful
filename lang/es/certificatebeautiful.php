<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Lang es file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['add_new_model'] = 'Añadir nuevo modelo';
$string['add_new_page'] = 'Añadir una nueva página al certificado';
$string['autogenerate'] = 'Generar certificados automáticamente';
$string['autogenerate_help'] = 'Cuando está habilitado, la tarea programada creará automáticamente emisiones de certificados y archivos PDF.';
$string['autogenerate_task_name'] = 'Generación automática de Beautiful Certificate';
$string['autotrigger'] = 'Disparador de generación automática';
$string['autotrigger_activity'] = 'Actividad requerida para el disparador de finalización';
$string['autotrigger_activitycompletion'] = 'Finalización de actividad';
$string['autotrigger_coursecompletion'] = 'Finalización del curso';
$string['autotrigger_gradethreshold'] = 'Calificación final mínima del curso';
$string['autotrigger_required'] = 'Debe elegir un disparador de generación automática.';
$string['best'] = 'Mejor';
$string['certdate'] = 'Fecha';
$string['certificate-appreciation'] = 'Certificado de Reconocimiento';
$string['certificate-details'] = 'Detalles del Certificado';
$string['certificate-elegant'] = 'Certificado Elegante';
$string['certificate-flat-modern'] = 'Certificado Plano Moderno';
$string['certificate-golden'] = 'Certificado Dorado';
$string['certificate-gradient-golden-luxury'] = 'Certificado Dorado de Lujo con Degradado';
$string['certificate-kids-animals'] = 'Para niños con animales';
$string['certificate-kids-child-medical'] = 'Certificado médico infantil';
$string['certificate-kids-gradient-modern'] = 'Plantilla moderna con degradado para niños';
$string['certificate-kids-hand-drawn'] = 'Certificado preescolar dibujado a mano';
$string['certificate-kids-pastel'] = 'Certificado educativo infantil en tonos pastel';
$string['certificate-modern'] = 'Certificado Moderno';
$string['certificate-modern-2'] = 'Certificado Moderno 2';
$string['certificate-simple'] = 'Certificado Simple';
$string['certificate-vintage'] = 'Certificado Vintage';
$string['certificate_description'] = 'Describa el certificado';
$string['certificate_description_help'] = 'Texto de descripción del certificado. Puede contener HTML simple como &lt;b&gt;, &lt;i&gt;, &lt;u&gt; y estilos de color, pero tenga cuidado porque el <a href="https://mpdf.github.io/" target="_blank">convertidor de PDF tiene limitaciones</a>.';
$string['certificate_not_issued'] = 'Su certificado aún no ha sido emitido.';
$string['certificatebeautiful-page_empty'] = 'Vacío';
$string['certificatebeautiful:addinstance'] = 'Añadir instancia';
$string['certificatebeautiful:delete'] = 'Eliminar instancia del certificado';
$string['certificatebeautiful:view'] = 'Permitir al usuario ver el Beautiful Certificate';
$string['certificatebeautiful:viewreport'] = 'Ver informes de Beautiful Certificate';
$string['certpresented'] = 'Este certificado se presenta con orgullo a';
$string['certsignature'] = 'Director';
$string['certtitle'] = 'Certificado';
$string['config_data_protect'] = 'Protección de Datos Personales';
$string['config_data_protect_admins_only'] = 'Visible solo para administradores';
$string['config_data_protect_desc'] = 'Marque para anonimizar los datos personales en el validador de certificados';
$string['config_data_protect_email_anonimized'] = 'Nombre visible y correo electrónico anonimizado';
$string['config_data_protect_hidden'] = 'Oculto para todos';
$string['config_data_protect_name_visible'] = 'Solo nombre visible';
$string['config_signature_color'] = 'Color de la línea de firma';
$string['config_signature_color_desc'] = 'Seleccione el color de la línea de escritura de la firma.';
$string['config_signature_enable'] = 'Habilitar firma dinámica';
$string['config_signature_enable_desc'] = 'Al marcar esta opción, Beautiful Certificate creará una firma personalizada según la caligrafía elegida, el texto indicado y el color.';
$string['config_signature_heading'] = 'Configuración de la Firma';
$string['config_signature_heading_desc'] = 'En este punto, debe decidir si desea crear una firma personalizada a partir de las {$a} caligrafías precargadas. Sus opciones incluyen:';
$string['config_signature_text'] = 'Texto de la Firma';
$string['config_signature_text_desc'] = 'Para habilitar la generación automática de firmas mediante Beautiful Certificate, debe proporcionar una secuencia de hasta 10 caracteres. Asegúrese de que la secuencia no contenga espacios, números ni acentos. Una secuencia de 5 a 7 caracteres producirá una firma visualmente agradable.';
$string['config_signature_typography'] = 'Estilo del Texto de la Firma';
$string['config_signature_typography_desc'] = 'De forma predeterminada, Beautiful Certificate generará una firma utilizando el siguiente texto y empleará esta caligrafía para personalizar el contenido.';
$string['course'] = 'Curso';
$string['course_certificates'] = 'Certificados del curso';
$string['create_after_model'] = 'Primero guarde el modelo antes de añadir páginas al certificado';
$string['create_at_certificate'] = 'Certificado para {$a}';
$string['create_model'] = 'Crear modelo';
$string['default-description'] = 'Este certificado, en reconocimiento a la finalización satisfactoria del curso <b>{\\$COURSE->fullname}</b> con distinción, consolida un conjunto integral de conocimientos y habilidades esenciales para destacar en entornos dinámicos.';
$string['delete-page'] = 'Eliminar esta página del certificado';
$string['deletedmodel'] = 'El modelo "{$a}" se ha eliminado correctamente.';
$string['deletemodelconfirm'] = '¿Realmente desea eliminar el modelo <strong>{$a}</strong>?';
$string['download_my_certificate'] = 'Descargar mi certificado';
$string['edit_page'] = 'Editar página del certificado';
$string['edit_page_instruction'] = '<p>El certificado se crea utilizando <a target="_blank" href="https://github.com/GrapesJS/grapesjs">GrapesJS</a> como editor. El editor está configurado con <a target="_blank" href="https://github.com/GrapesJS/grapesjs/issues/1936">dragMode:\'absolute\'</a>, lo que permite arrastrar y soltar componentes dentro del editor. Después de editar, haga clic en "<strong>Probar PDF</strong>" para obtener una vista previa del resultado y, cuando termine, utilice el botón "<strong>Guardar Página del Certificado</strong>" para guardar el certificado generado.</p><p>Debido a las limitaciones de <a target="_blank" href="https://mpdf.github.io/">mPDF</a>, solo los elementos situados en la raíz del certificado admiten posicionamiento absoluto. Por lo tanto, se restringe el movimiento de otros componentes dentro del DIV raíz para evitar inconsistencias en el PDF final. mPDF solo admite posicionamiento absoluto para elementos <code>&lt;div&gt;</code>, por lo que, al utilizar Código Personalizado para insertar nuevos componentes, comience siempre con <code>&lt;div&gt;</code>.</p><p>Después del editor encontrará claves que pueden añadirse al certificado para personalizarlo. En cuanto al QRCode, tenga en cuenta que la imagen <code>qr-code.svg</code> se sustituye por el QRCode generado por el plugin. Por lo tanto, si edita la imagen, la funcionalidad puede verse afectada. En cuanto a la firma generada por el sistema, esta sustituirá la imagen <code>signature.png</code> del proyecto. Si elige una imagen personalizada para el certificado, el plugin no realizará la sustitución automáticamente.</p>';
$string['edit_signature_certificate'] = 'Personalice aquí la firma de su certificado';
$string['edit_this_page'] = 'Editar esta página del certificado';
$string['from_certificates'] = 'Certificados del estudiante {$a}';
$string['gradepass'] = 'Calificación final mínima del curso';
$string['gradepass_required'] = 'Debe definir una calificación final mínima numérica para el curso.';
$string['help_base_title'] = 'Claves disponibles para sustituir en el certificado:';
$string['list_model'] = 'Lista de modelos';
$string['manage_models'] = 'Gestionar modelos de certificado';
$string['model_name'] = 'Nombre del modelo';
$string['model_name_missing'] = 'El nombre del modelo es obligatorio';
$string['model_orientation'] = 'Orientación';
$string['model_orientation_l'] = 'Horizontal';
$string['model_orientation_p'] = 'Vertical';
$string['model_page_name'] = 'Página: {$a}';
$string['modulename'] = 'Beautiful Certificate';
$string['modulenameplural'] = 'Beautiful Certificates';
$string['my_certificates'] = 'Mis certificados';
$string['new_model'] = 'Nuevo Modelo';
$string['notification_body'] = 'Hola {$a->fullname},<br><br>Su certificado <strong>{$a->certificatename}</strong> del curso <strong>{$a->coursename}</strong> ya está disponible.<br><br>Acceda aquí: <a href="{$a->url}">{$a->url}</a>';
$string['notification_subject'] = 'Su certificado está disponible: {$a->certificatename}';
$string['notifyuser'] = 'Enviar una notificación por correo electrónico cuando se emita el certificado';
$string['only_format'] = 'Mostrando solo el formato {$a}';
$string['pages_certificate'] = 'Páginas del certificado';
$string['pluginadministration'] = 'Administración de certificados del curso';
$string['pluginname'] = 'Beautiful Certificate';
$string['preview_certificate'] = 'Vista previa del certificado';
$string['privacy:metadata:certificatebeautiful_issue'] = 'Información sobre los certificados emitidos a los usuarios.';
$string['privacy:metadata:certificatebeautiful_issue:userid'] = 'Almacena el ID del usuario que recibió el certificado.';
$string['report'] = 'Ver certificados generados';
$string['report_code'] = 'Código del certificado';
$string['report_confirm_delete_certificate'] = '¿Está seguro de que desea eliminar este certificado?';
$string['report_create_certificate'] = 'Crear certificado';
$string['report_delete_certificate'] = 'Eliminar';
$string['report_deleted_certificate'] = '¡Certificado eliminado correctamente!';
$string['report_filename'] = 'Certificados generados por los estudiantes';
$string['report_finalgrade'] = 'Calificación final del curso';
$string['report_timecreated'] = 'Creado el';
$string['report_title'] = 'Informe';
$string['report_useremail'] = 'Correo electrónico del estudiante';
$string['report_usernome'] = 'Nombre del estudiante';
$string['report_view_certificate'] = 'Ver';
$string['save_model'] = 'Guardar modelo';
$string['select_a_model'] = 'Seleccione un modelo';
$string['select_background_image'] = 'Seleccione la nueva imagen de fondo del certificado';
$string['select_background_image_info2'] = '<div class="alert alert-warning">
<p>Suba una nueva imagen para sustituir el fondo del certificado.</p>
<p>El certificado está en formato <strong>{$a->orientation}</strong> y la imagen debe tener dimensiones de <strong>{$a->size} píxeles</strong>, correspondientes a <strong>{$a->sizecm} cm</strong>. Asegúrese de mantener estas proporciones para evitar distorsiones o pixelación.</p>
</div>';
$string['select_background_preview'] = 'Cambiar la imagen de fondo del certificado';
$string['select_model'] = 'Ver este modelo';
$string['select_model_preview'] = 'Seleccione una plantilla existente para actualizar el diseño de esta página';
$string['select_the_model'] = 'Seleccione el modelo';
$string['subplugintype_certificatebeautifuldatainfo'] = 'Subplugin de Beautiful Certificate';
$string['subplugintype_certificatebeautifuldatainfo_plural'] = 'Subplugin de datos de Beautiful Certificate';
$string['subtititle'] = 'De finalización';
$string['sumary'] = 'Resumen';
$string['sumary-secound-page'] = 'Certificado Resumen';
$string['sumary-secound-page2'] = 'Lista de secciones y módulos del curso';
$string['triggercmid_required'] = 'Debe elegir una actividad para el disparador de finalización de actividad.';
$string['using_this_page'] = 'Usar esta plantilla';
$string['validate_certificate_code'] = 'Código de autenticidad';
$string['validate_certificate_course'] = 'Curso del certificado';
$string['validate_certificate_date'] = 'Emitido en la fecha de';
$string['validate_certificate_name'] = 'Nombre del certificado';
$string['validate_certificate_notfound'] = '¡Código de autenticidad no encontrado!';
$string['validate_certificate_submit'] = 'Validar código';
$string['validate_certificate_title'] = 'Verificar la autenticidad del certificado';
$string['validate_certificate_user'] = 'Emitido a';
$string['validate_certificate_validate'] = 'Validar';
$string['view_my_certificate'] = 'Ver mi certificado en una nueva pestaña';
