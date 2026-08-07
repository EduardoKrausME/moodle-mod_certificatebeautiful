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
 * Lang ru file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['add_new_model'] = 'Добавить новую модель';
$string['add_new_page'] = 'Добавить новую страницу в сертификат';
$string['autogenerate'] = 'Создавать сертификаты автоматически';
$string['autogenerate_help'] = 'Если включено, плановая задача будет автоматически создавать записи о выдаче сертификатов и PDF-файлы.';
$string['autogenerate_task_name'] = 'Автоматическое создание Beautiful Certificate';
$string['autotrigger'] = 'Триггер автоматического создания';
$string['autotrigger_activity'] = 'Активность, необходимая для триггера завершения';
$string['autotrigger_activitycompletion'] = 'Завершение активности';
$string['autotrigger_coursecompletion'] = 'Завершение курса';
$string['autotrigger_gradethreshold'] = 'Минимальная итоговая оценка за курс';
$string['autotrigger_required'] = 'Необходимо выбрать триггер автоматического создания.';
$string['best'] = 'Лучший';
$string['certdate'] = 'Дата';
$string['certificate-appreciation'] = 'Сертификат признательности';
$string['certificate-details'] = 'Сведения о сертификате';
$string['certificate-elegant'] = 'Элегантный сертификат';
$string['certificate-flat-modern'] = 'Современный плоский сертификат';
$string['certificate-golden'] = 'Золотой сертификат';
$string['certificate-gradient-golden-luxury'] = 'Роскошный золотой сертификат с градиентом';
$string['certificate-kids-animals'] = 'Для детей с животными';
$string['certificate-kids-child-medical'] = 'Детский медицинский сертификат';
$string['certificate-kids-gradient-modern'] = 'Современный градиентный шаблон для детей';
$string['certificate-kids-hand-drawn'] = 'Нарисованный от руки дошкольный сертификат';
$string['certificate-kids-pastel'] = 'Милый образовательный сертификат в пастельных тонах';
$string['certificate-modern'] = 'Современный сертификат';
$string['certificate-modern-2'] = 'Современный сертификат 2';
$string['certificate-simple'] = 'Простой сертификат';
$string['certificate-vintage'] = 'Винтажный сертификат';
$string['certificate_description'] = 'Описание сертификата';
$string['certificate_description_help'] = 'Текст описания сертификата. Он может содержать простой HTML, например &lt;b&gt;, &lt;i&gt;, &lt;u&gt;, а также стили цвета, однако учитывайте, что <a href="https://mpdf.github.io/" target="_blank">конвертер PDF имеет ограничения</a>.';
$string['certificate_not_issued'] = 'Ваш сертификат еще не выдан.';
$string['certificatebeautiful-page_empty'] = 'Пусто';
$string['certificatebeautiful:addinstance'] = 'Добавить экземпляр';
$string['certificatebeautiful:delete'] = 'Удалить экземпляр сертификата';
$string['certificatebeautiful:view'] = 'Разрешить пользователю просматривать Beautiful Certificate';
$string['certificatebeautiful:viewreport'] = 'Просматривать отчеты Beautiful Certificate';
$string['certpresented'] = 'Настоящий сертификат с гордостью вручается';
$string['certsignature'] = 'Директор';
$string['certtitle'] = 'Сертификат';
$string['config_data_protect'] = 'Защита персональных данных';
$string['config_data_protect_admins_only'] = 'Видно только администраторам';
$string['config_data_protect_desc'] = 'Установите флажок, чтобы анонимизировать персональные данные в валидаторе сертификатов';
$string['config_data_protect_email_anonimized'] = 'Имя видно, адрес электронной почты анонимизирован';
$string['config_data_protect_hidden'] = 'Скрыто для всех';
$string['config_data_protect_name_visible'] = 'Видно только имя';
$string['config_signature_color'] = 'Цвет линии подписи';
$string['config_signature_color_desc'] = 'Выберите цвет линии для подписи.';
$string['config_signature_enable'] = 'Включить динамическую подпись';
$string['config_signature_enable_desc'] = 'Если включено, Beautiful Certificate создаст персонализированную подпись на основе выбранного почерка, указанного текста и цвета.';
$string['config_signature_heading'] = 'Настройки подписи';
$string['config_signature_heading_desc'] = 'На этом этапе необходимо решить, хотите ли вы создать персонализированную подпись на основе {$a} предварительно загруженных вариантов каллиграфии. Доступные варианты:';
$string['config_signature_text'] = 'Текст подписи';
$string['config_signature_text_desc'] = 'Чтобы включить автоматическое создание подписей в Beautiful Certificate, необходимо указать последовательность длиной до 10 символов. Убедитесь, что она не содержит пробелов, цифр или диакритических знаков. Последовательность из 5–7 символов обычно дает визуально привлекательную подпись.';
$string['config_signature_typography'] = 'Стиль текста подписи';
$string['config_signature_typography_desc'] = 'По умолчанию Beautiful Certificate создаст подпись с использованием следующего текста и применит эту каллиграфию для персонализации содержимого.';
$string['course'] = 'Курс';
$string['course_certificates'] = 'Сертификаты курса';
$string['create_after_model'] = 'Сначала сохраните модель, прежде чем добавлять страницы в сертификат';
$string['create_at_certificate'] = 'Сертификат для {$a}';
$string['create_model'] = 'Создать модель';
$string['default-description'] = 'Настоящий сертификат подтверждает успешное завершение курса <b>{\\$COURSE->fullname}</b> с отличием и свидетельствует о комплексном наборе знаний и важнейших навыков, необходимых для успешной работы в динамичной среде.';
$string['delete-page'] = 'Удалить эту страницу из сертификата';
$string['deletedmodel'] = 'Модель "{$a}" успешно удалена.';
$string['deletemodelconfirm'] = 'Вы действительно хотите удалить модель <strong>{$a}</strong>?';
$string['download_my_certificate'] = 'Скачать мой сертификат';
$string['edit_page'] = 'Редактировать страницу сертификата';
$string['edit_page_instruction'] = '<p>Сертификат создается с помощью редактора <a target="_blank" href="https://github.com/GrapesJS/grapesjs">GrapesJS</a>. Редактор настроен с параметром <a target="_blank" href="https://github.com/GrapesJS/grapesjs/issues/1936">dragMode:\'absolute\'</a>, что позволяет перетаскивать компоненты внутри редактора. После редактирования нажмите "<strong>Проверить PDF</strong>", чтобы просмотреть результат, а затем используйте кнопку "<strong>Сохранить страницу сертификата</strong>", чтобы сохранить созданный сертификат.</p><p>Из-за ограничений <a target="_blank" href="https://mpdf.github.io/">mPDF</a> абсолютное позиционирование поддерживают только элементы в корне сертификата. Поэтому перемещение других компонентов внутри корневого DIV ограничено, чтобы избежать несоответствий в итоговом PDF. mPDF поддерживает абсолютное позиционирование только для элементов <code>&lt;div&gt;</code>, поэтому при использовании Пользовательского кода для добавления новых компонентов всегда начинайте с <code>&lt;div&gt;</code>.</p><p>После редактора вы найдете ключи, которые можно добавить в сертификат для персонализации. Обратите внимание, что для QRCode изображение <code>qr-code.svg</code> заменяется QRCode, созданным плагином. Если изменить это изображение, функциональность может быть нарушена. Системная подпись заменит изображение <code>signature.png</code> в проекте. Если для сертификата выбрано собственное изображение, плагин не выполнит эту замену автоматически.</p>';
$string['edit_signature_certificate'] = 'Настройте подпись сертификата здесь';
$string['edit_this_page'] = 'Редактировать эту страницу сертификата';
$string['from_certificates'] = 'Сертификаты участника {$a}';
$string['gradepass'] = 'Минимальная итоговая оценка за курс';
$string['gradepass_required'] = 'Необходимо указать числовую минимальную итоговую оценку за курс.';
$string['help_base_title'] = 'Доступные ключи для замены в сертификате:';
$string['list_model'] = 'Список моделей';
$string['manage_models'] = 'Управление моделями сертификатов';
$string['model_name'] = 'Название модели';
$string['model_name_missing'] = 'Необходимо указать название модели';
$string['model_orientation'] = 'Ориентация';
$string['model_orientation_l'] = 'Альбомная';
$string['model_orientation_p'] = 'Книжная';
$string['model_page_name'] = 'Страница: {$a}';
$string['modulename'] = 'Beautiful Certificate';
$string['modulenameplural'] = 'Beautiful Certificates';
$string['my_certificates'] = 'Мои сертификаты';
$string['new_model'] = 'Новая модель';
$string['notification_body'] = 'Здравствуйте, {$a->fullname}!<br><br>Ваш сертификат <strong>{$a->certificatename}</strong> по курсу <strong>{$a->coursename}</strong> теперь доступен.<br><br>Открыть: <a href="{$a->url}">{$a->url}</a>';
$string['notification_subject'] = 'Ваш сертификат доступен: {$a->certificatename}';
$string['notifyuser'] = 'Отправлять уведомление по электронной почте при выдаче сертификата';
$string['only_format'] = 'Показывать только формат {$a}';
$string['pages_certificate'] = 'Страницы сертификата';
$string['pluginadministration'] = 'Управление сертификатами курса';
$string['pluginname'] = 'Beautiful Certificate';
$string['preview_certificate'] = 'Предварительный просмотр сертификата';
$string['privacy:metadata:certificatebeautiful_issue'] = 'Информация о сертификатах, выданных пользователям.';
$string['privacy:metadata:certificatebeautiful_issue:userid'] = 'Хранит ID пользователя, получившего сертификат.';
$string['report'] = 'Просмотреть созданные сертификаты';
$string['report_code'] = 'Код сертификата';
$string['report_confirm_delete_certificate'] = 'Вы уверены, что хотите удалить этот сертификат?';
$string['report_create_certificate'] = 'Создать сертификат';
$string['report_delete_certificate'] = 'Удалить';
$string['report_deleted_certificate'] = 'Сертификат успешно удален!';
$string['report_filename'] = 'Сертификаты, созданные участниками';
$string['report_finalgrade'] = 'Итоговая оценка за курс';
$string['report_timecreated'] = 'Создано';
$string['report_title'] = 'Отчет';
$string['report_useremail'] = 'Электронная почта участника';
$string['report_usernome'] = 'Имя участника';
$string['report_view_certificate'] = 'Просмотр';
$string['save_model'] = 'Сохранить модель';
$string['select_a_model'] = 'Выберите модель';
$string['select_background_image'] = 'Выберите новое фоновое изображение для сертификата';
$string['select_background_image_info2'] = '<div class="alert alert-warning">
<p>Загрузите новое изображение, чтобы заменить фон сертификата.</p>
<p>Сертификат имеет формат <strong>{$a->orientation}</strong>, а изображение должно иметь размер <strong>{$a->size} пикселей</strong>, что соответствует <strong>{$a->sizecm} см</strong>. Сохраняйте эти пропорции, чтобы избежать искажений или пикселизации.</p>
</div>';
$string['select_background_preview'] = 'Изменить фоновое изображение сертификата';
$string['select_model'] = 'Просмотреть эту модель';
$string['select_model_preview'] = 'Выберите существующий шаблон, чтобы обновить дизайн этой страницы';
$string['select_the_model'] = 'Выберите модель';
$string['subplugintype_certificatebeautifuldatainfo'] = 'Подплагин Beautiful Certificate';
$string['subplugintype_certificatebeautifuldatainfo_plural'] = 'Подплагин данных Beautiful Certificate';
$string['subtititle'] = 'О завершении';
$string['sumary'] = 'Сводка';
$string['sumary-secound-page'] = 'Итоговый сертификат';
$string['sumary-secound-page2'] = 'Список разделов и модулей курса';
$string['triggercmid_required'] = 'Необходимо выбрать активность для триггера завершения активности.';
$string['using_this_page'] = 'Использовать этот шаблон';
$string['validate_certificate_code'] = 'Код подлинности';
$string['validate_certificate_course'] = 'Курс сертификата';
$string['validate_certificate_date'] = 'Дата выдачи';
$string['validate_certificate_name'] = 'Название сертификата';
$string['validate_certificate_notfound'] = 'Код подлинности не найден!';
$string['validate_certificate_submit'] = 'Проверить код';
$string['validate_certificate_title'] = 'Проверить подлинность сертификата';
$string['validate_certificate_user'] = 'Выдан';
$string['validate_certificate_validate'] = 'Проверить';
$string['view_my_certificate'] = 'Открыть мой сертификат в новой вкладке';
