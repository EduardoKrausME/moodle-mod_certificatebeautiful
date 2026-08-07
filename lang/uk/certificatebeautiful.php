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
 * Lang uk file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['add_new_model'] = 'Додати нову модель';
$string['add_new_page'] = 'Додати нову сторінку до сертифіката';
$string['autogenerate'] = 'Створювати сертифікати автоматично';
$string['autogenerate_help'] = 'Якщо ввімкнено, заплановане завдання автоматично створюватиме записи про видачу сертифікатів і PDF-файли.';
$string['autogenerate_task_name'] = 'Автоматичне створення Beautiful Certificate';
$string['autotrigger'] = 'Тригер автоматичного створення';
$string['autotrigger_activity'] = 'Діяльність, потрібна для тригера завершення';
$string['autotrigger_activitycompletion'] = 'Завершення діяльності';
$string['autotrigger_coursecompletion'] = 'Завершення курсу';
$string['autotrigger_gradethreshold'] = 'Мінімальна підсумкова оцінка за курс';
$string['autotrigger_required'] = 'Потрібно вибрати тригер автоматичного створення.';
$string['best'] = 'Найкращий';
$string['certdate'] = 'Дата';
$string['certificate-appreciation'] = 'Сертифікат визнання';
$string['certificate-details'] = 'Відомості про сертифікат';
$string['certificate-elegant'] = 'Елегантний сертифікат';
$string['certificate-flat-modern'] = 'Сучасний плаский сертифікат';
$string['certificate-golden'] = 'Золотий сертифікат';
$string['certificate-gradient-golden-luxury'] = 'Розкішний золотий сертифікат із градієнтом';
$string['certificate-kids-animals'] = 'Для дітей із тваринами';
$string['certificate-kids-child-medical'] = 'Дитячий медичний сертифікат';
$string['certificate-kids-gradient-modern'] = 'Сучасний градієнтний шаблон для дітей';
$string['certificate-kids-hand-drawn'] = 'Намальований від руки дошкільний сертифікат';
$string['certificate-kids-pastel'] = 'Милий освітній сертифікат у пастельних тонах';
$string['certificate-modern'] = 'Сучасний сертифікат';
$string['certificate-modern-2'] = 'Сучасний сертифікат 2';
$string['certificate-simple'] = 'Простий сертифікат';
$string['certificate-vintage'] = 'Вінтажний сертифікат';
$string['certificate_description'] = 'Опишіть сертифікат';
$string['certificate_description_help'] = 'Текст опису сертифіката. Він може містити простий HTML, наприклад &lt;b&gt;, &lt;i&gt;, &lt;u&gt;, а також стилі кольору, але врахуйте, що <a href="https://mpdf.github.io/" target="_blank">конвертер PDF має обмеження</a>.';
$string['certificate_not_issued'] = 'Ваш сертифікат ще не видано.';
$string['certificatebeautiful-page_empty'] = 'Порожньо';
$string['certificatebeautiful:addinstance'] = 'Додати екземпляр';
$string['certificatebeautiful:delete'] = 'Видалити екземпляр сертифіката';
$string['certificatebeautiful:view'] = 'Дозволити користувачу переглядати Beautiful Certificate';
$string['certificatebeautiful:viewreport'] = 'Переглядати звіти Beautiful Certificate';
$string['certpresented'] = 'Цей сертифікат із гордістю вручається';
$string['certsignature'] = 'Директор';
$string['certtitle'] = 'Сертифікат';
$string['config_data_protect'] = 'Захист персональних даних';
$string['config_data_protect_admins_only'] = 'Видно лише адміністраторам';
$string['config_data_protect_desc'] = 'Позначте, щоб анонімізувати персональні дані у валідаторі сертифікатів';
$string['config_data_protect_email_anonimized'] = 'Ім\'я видно, електронну адресу анонімізовано';
$string['config_data_protect_hidden'] = 'Приховано для всіх';
$string['config_data_protect_name_visible'] = 'Видно лише ім\'я';
$string['config_signature_color'] = 'Колір лінії підпису';
$string['config_signature_color_desc'] = 'Виберіть колір лінії для підпису.';
$string['config_signature_enable'] = 'Увімкнути динамічний підпис';
$string['config_signature_enable_desc'] = 'Якщо ввімкнено, Beautiful Certificate створить персоналізований підпис на основі вибраного почерку, заданого тексту та кольору.';
$string['config_signature_heading'] = 'Налаштування підпису';
$string['config_signature_heading_desc'] = 'На цьому етапі потрібно вирішити, чи хочете ви створити персоналізований підпис на основі {$a} попередньо завантажених варіантів каліграфії. Доступні варіанти:';
$string['config_signature_text'] = 'Текст підпису';
$string['config_signature_text_desc'] = 'Щоб увімкнути автоматичне створення підписів у Beautiful Certificate, потрібно вказати послідовність до 10 символів. Переконайтеся, що вона не містить пробілів, цифр або діакритичних знаків. Послідовність із 5–7 символів зазвичай дає візуально привабливий підпис.';
$string['config_signature_typography'] = 'Стиль тексту підпису';
$string['config_signature_typography_desc'] = 'За замовчуванням Beautiful Certificate створить підпис із використанням наведеного нижче тексту та застосує цю каліграфію для персоналізації вмісту.';
$string['course'] = 'Курс';
$string['course_certificates'] = 'Сертифікати курсу';
$string['create_after_model'] = 'Спочатку збережіть модель, перш ніж додавати сторінки до сертифіката';
$string['create_at_certificate'] = 'Сертифікат для {$a}';
$string['create_model'] = 'Створити модель';
$string['default-description'] = 'Цей сертифікат засвідчує успішне завершення курсу <b>{\\$COURSE->fullname}</b> з відзнакою та підтверджує комплексний набір знань і важливих навичок, потрібних для успіху в динамічному середовищі.';
$string['delete-page'] = 'Видалити цю сторінку із сертифіката';
$string['deletedmodel'] = 'Модель "{$a}" успішно видалено.';
$string['deletemodelconfirm'] = 'Ви справді хочете видалити модель <strong>{$a}</strong>?';
$string['download_my_certificate'] = 'Завантажити мій сертифікат';
$string['edit_page'] = 'Редагувати сторінку сертифіката';
$string['edit_page_instruction'] = '<p>Сертифікат створюється за допомогою редактора <a target="_blank" href="https://github.com/GrapesJS/grapesjs">GrapesJS</a>. Редактор налаштовано з параметром <a target="_blank" href="https://github.com/GrapesJS/grapesjs/issues/1936">dragMode:\'absolute\'</a>, що дає змогу перетягувати компоненти в межах редактора. Після редагування натисніть "<strong>Перевірити PDF</strong>", щоб переглянути результат, а після завершення скористайтеся кнопкою "<strong>Зберегти сторінку сертифіката</strong>", щоб зберегти створений сертифікат.</p><p>Через обмеження <a target="_blank" href="https://mpdf.github.io/">mPDF</a> абсолютне позиціонування підтримують лише елементи в корені сертифіката. Тому переміщення інших компонентів усередині кореневого DIV обмежено, щоб уникнути невідповідностей у підсумковому PDF. mPDF підтримує абсолютне позиціонування лише для елементів <code>&lt;div&gt;</code>, тому під час використання Користувацького коду для вставлення нових компонентів завжди починайте з <code>&lt;div&gt;</code>.</p><p>Після редактора ви знайдете ключі, які можна додавати до сертифіката для персоналізації. Для QRCode зверніть увагу, що зображення <code>qr-code.svg</code> замінюється QRCode, створеним плагіном. Якщо змінити це зображення, функціональність може бути порушена. Підпис, створений системою, замінить зображення <code>signature.png</code> у проєкті. Якщо ви виберете власне зображення для сертифіката, плагін не виконає цю заміну автоматично.</p>';
$string['edit_signature_certificate'] = 'Налаштуйте підпис сертифіката тут';
$string['edit_this_page'] = 'Редагувати цю сторінку сертифіката';
$string['from_certificates'] = 'Сертифікати учасника {$a}';
$string['gradepass'] = 'Мінімальна підсумкова оцінка за курс';
$string['gradepass_required'] = 'Потрібно вказати числову мінімальну підсумкову оцінку за курс.';
$string['help_base_title'] = 'Доступні ключі для заміни в сертифікаті:';
$string['list_model'] = 'Список моделей';
$string['manage_models'] = 'Керування моделями сертифікатів';
$string['model_name'] = 'Назва моделі';
$string['model_name_missing'] = 'Назва моделі є обов\'язковою';
$string['model_orientation'] = 'Орієнтація';
$string['model_orientation_l'] = 'Альбомна';
$string['model_orientation_p'] = 'Книжкова';
$string['model_page_name'] = 'Сторінка: {$a}';
$string['modulename'] = 'Beautiful Certificate';
$string['modulenameplural'] = 'Beautiful Certificates';
$string['my_certificates'] = 'Мої сертифікати';
$string['new_model'] = 'Нова модель';
$string['notification_body'] = 'Вітаємо, {$a->fullname}!<br><br>Ваш сертифікат <strong>{$a->certificatename}</strong> за курс <strong>{$a->coursename}</strong> уже доступний.<br><br>Відкрити: <a href="{$a->url}">{$a->url}</a>';
$string['notification_subject'] = 'Ваш сертифікат доступний: {$a->certificatename}';
$string['notifyuser'] = 'Надсилати сповіщення електронною поштою під час видачі сертифіката';
$string['only_format'] = 'Показувати лише формат {$a}';
$string['pages_certificate'] = 'Сторінки сертифіката';
$string['pluginadministration'] = 'Керування сертифікатами курсу';
$string['pluginname'] = 'Beautiful Certificate';
$string['preview_certificate'] = 'Попередній перегляд сертифіката';
$string['privacy:metadata:certificatebeautiful_issue'] = 'Інформація про сертифікати, видані користувачам.';
$string['privacy:metadata:certificatebeautiful_issue:userid'] = 'Зберігає ID користувача, який отримав сертифікат.';
$string['report'] = 'Переглянути створені сертифікати';
$string['report_code'] = 'Код сертифіката';
$string['report_confirm_delete_certificate'] = 'Ви впевнені, що хочете видалити цей сертифікат?';
$string['report_create_certificate'] = 'Створити сертифікат';
$string['report_delete_certificate'] = 'Видалити';
$string['report_deleted_certificate'] = 'Сертифікат успішно видалено!';
$string['report_filename'] = 'Сертифікати, створені учасниками';
$string['report_finalgrade'] = 'Підсумкова оцінка за курс';
$string['report_timecreated'] = 'Створено';
$string['report_title'] = 'Звіт';
$string['report_useremail'] = 'Електронна пошта учасника';
$string['report_usernome'] = 'Ім\'я учасника';
$string['report_view_certificate'] = 'Переглянути';
$string['save_model'] = 'Зберегти модель';
$string['select_a_model'] = 'Виберіть модель';
$string['select_background_image'] = 'Виберіть нове фонове зображення для сертифіката';
$string['select_background_image_info2'] = '<div class="alert alert-warning">
<p>Завантажте нове зображення, щоб замінити фон сертифіката.</p>
<p>Сертифікат має формат <strong>{$a->orientation}</strong>, а зображення повинно мати розмір <strong>{$a->size} пікселів</strong>, що відповідає <strong>{$a->sizecm} см</strong>. Зберігайте ці пропорції, щоб уникнути спотворення або пікселізації.</p>
</div>';
$string['select_background_preview'] = 'Змінити фонове зображення сертифіката';
$string['select_model'] = 'Переглянути цю модель';
$string['select_model_preview'] = 'Виберіть наявний шаблон, щоб оновити дизайн цієї сторінки';
$string['select_the_model'] = 'Виберіть модель';
$string['subplugintype_certificatebeautifuldatainfo'] = 'Підплагін Beautiful Certificate';
$string['subplugintype_certificatebeautifuldatainfo_plural'] = 'Підплагін даних Beautiful Certificate';
$string['subtititle'] = 'Про завершення';
$string['sumary'] = 'Підсумок';
$string['sumary-secound-page'] = 'Підсумковий сертифікат';
$string['sumary-secound-page2'] = 'Список розділів і модулів курсу';
$string['triggercmid_required'] = 'Потрібно вибрати діяльність для тригера завершення діяльності.';
$string['using_this_page'] = 'Використати цей шаблон';
$string['validate_certificate_code'] = 'Код автентичності';
$string['validate_certificate_course'] = 'Курс сертифіката';
$string['validate_certificate_date'] = 'Дата видачі';
$string['validate_certificate_name'] = 'Назва сертифіката';
$string['validate_certificate_notfound'] = 'Код автентичності не знайдено!';
$string['validate_certificate_submit'] = 'Перевірити код';
$string['validate_certificate_title'] = 'Перевірити автентичність сертифіката';
$string['validate_certificate_user'] = 'Видано';
$string['validate_certificate_validate'] = 'Перевірити';
$string['view_my_certificate'] = 'Відкрити мій сертифікат у новій вкладці';
