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
 * Lang ar file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['add_new_model'] = 'إضافة نموذج جديد';
$string['add_new_page'] = 'إضافة صفحة جديدة إلى الشهادة';
$string['autogenerate'] = 'إنشاء الشهادات تلقائيًا';
$string['autogenerate_help'] = 'عند التفعيل، ستقوم المهمة المجدولة تلقائيًا بإنشاء سجلات إصدار الشهادات وملفات PDF.';
$string['autogenerate_task_name'] = 'الإنشاء التلقائي لـ Beautiful Certificate';
$string['autotrigger'] = 'مشغّل الإنشاء التلقائي';
$string['autotrigger_activity'] = 'النشاط المطلوب لمشغّل الإكمال';
$string['autotrigger_activitycompletion'] = 'إكمال النشاط';
$string['autotrigger_coursecompletion'] = 'إكمال المقرر';
$string['autotrigger_gradethreshold'] = 'الدرجة النهائية الدنيا للمقرر';
$string['autotrigger_required'] = 'يجب اختيار مشغّل للإنشاء التلقائي.';
$string['best'] = 'الأفضل';
$string['certdate'] = 'التاريخ';
$string['certificate-appreciation'] = 'شهادة تقدير';
$string['certificate-details'] = 'تفاصيل الشهادة';
$string['certificate-elegant'] = 'شهادة أنيقة';
$string['certificate-flat-modern'] = 'شهادة عصرية مسطحة';
$string['certificate-golden'] = 'شهادة ذهبية';
$string['certificate-gradient-golden-luxury'] = 'شهادة ذهبية فاخرة بتدرج لوني';
$string['certificate-kids-animals'] = 'للأطفال مع الحيوانات';
$string['certificate-kids-child-medical'] = 'شهادة طبية بطابع طفولي';
$string['certificate-kids-gradient-modern'] = 'قالب شهادة حديث بتدرج لوني للأطفال';
$string['certificate-kids-hand-drawn'] = 'شهادة لمرحلة ما قبل المدرسة مرسومة يدويًا';
$string['certificate-kids-pastel'] = 'شهادة تعليمية لطيفة بألوان باستيل';
$string['certificate-modern'] = 'شهادة عصرية';
$string['certificate-modern-2'] = 'شهادة عصرية 2';
$string['certificate-simple'] = 'شهادة بسيطة';
$string['certificate-vintage'] = 'شهادة كلاسيكية';
$string['certificate_description'] = 'وصف الشهادة';
$string['certificate_description_help'] = 'نص وصف الشهادة. يمكن أن يحتوي على HTML بسيط مثل &lt;b&gt; و&lt;i&gt; و&lt;u&gt; وأنماط الألوان، ولكن يرجى الانتباه لأن <a href="https://mpdf.github.io/" target="_blank">محوّل PDF لديه بعض القيود</a>.';
$string['certificate_not_issued'] = 'لم يتم إصدار شهادتك بعد.';
$string['certificatebeautiful-page_empty'] = 'فارغ';
$string['certificatebeautiful:addinstance'] = 'إضافة مثيل';
$string['certificatebeautiful:delete'] = 'حذف مثيل الشهادة';
$string['certificatebeautiful:view'] = 'السماح للمستخدم بعرض Beautiful Certificate';
$string['certificatebeautiful:viewreport'] = 'عرض تقارير Beautiful Certificate';
$string['certpresented'] = 'تُمنح هذه الشهادة بكل فخر إلى';
$string['certsignature'] = 'المدير';
$string['certtitle'] = 'الشهادة';
$string['config_data_protect'] = 'حماية البيانات الشخصية';
$string['config_data_protect_admins_only'] = 'مرئي للمسؤولين فقط';
$string['config_data_protect_desc'] = 'حدد هذا الخيار لإخفاء هوية البيانات الشخصية في أداة التحقق من الشهادة';
$string['config_data_protect_email_anonimized'] = 'الاسم ظاهر والبريد الإلكتروني مخفي الهوية';
$string['config_data_protect_hidden'] = 'مخفي عن الجميع';
$string['config_data_protect_name_visible'] = 'الاسم فقط ظاهر';
$string['config_signature_color'] = 'لون خط التوقيع';
$string['config_signature_color_desc'] = 'اختر لون خط الكتابة المستخدم للتوقيع.';
$string['config_signature_enable'] = 'تفعيل التوقيع الديناميكي';
$string['config_signature_enable_desc'] = 'عند التفعيل، سيقوم Beautiful Certificate بإنشاء توقيع مخصص بالاعتماد على نمط الكتابة المختار والنص المحدد واللون.';
$string['config_signature_heading'] = 'إعدادات التوقيع';
$string['config_signature_heading_desc'] = 'في هذه المرحلة، يجب أن تقرر ما إذا كنت تريد إنشاء توقيع مخصص باستخدام {$a} من أنماط الخط المحمّلة مسبقًا. تشمل الخيارات المتاحة:';
$string['config_signature_text'] = 'نص التوقيع';
$string['config_signature_text_desc'] = 'لتفعيل الإنشاء التلقائي للتوقيعات بواسطة Beautiful Certificate، يجب إدخال سلسلة تصل إلى 10 أحرف. تأكد من أنها لا تحتوي على مسافات أو أرقام أو علامات تشكيل. عادةً ما تنتج سلسلة من 5 إلى 7 أحرف توقيعًا متناسقًا بصريًا.';
$string['config_signature_typography'] = 'نمط نص التوقيع';
$string['config_signature_typography_desc'] = 'افتراضيًا، سيقوم Beautiful Certificate بإنشاء توقيع باستخدام النص التالي واستخدام نمط الخط هذا لتخصيص المحتوى.';
$string['course'] = 'المقرر';
$string['course_certificates'] = 'شهادات المقرر';
$string['create_after_model'] = 'احفظ النموذج أولًا قبل إضافة صفحات إلى الشهادة';
$string['create_at_certificate'] = 'شهادة لـ {$a}';
$string['create_model'] = 'إنشاء نموذج';
$string['default-description'] = 'تُمنح هذه الشهادة تقديرًا لإتمام المقرر <b>{\\$COURSE->fullname}</b> بنجاح وتميّز، بما يؤكد اكتساب مجموعة شاملة من المعارف والمهارات الأساسية اللازمة للنجاح في البيئات الديناميكية.';
$string['delete-page'] = 'حذف هذه الصفحة من الشهادة';
$string['deletedmodel'] = 'تم حذف النموذج "{$a}" بنجاح.';
$string['deletemodelconfirm'] = 'هل تريد بالفعل حذف النموذج <strong>{$a}</strong>؟';
$string['download_my_certificate'] = 'تنزيل شهادتي';
$string['edit_page'] = 'تحرير صفحة الشهادة';
$string['edit_page_instruction'] = '<p>يتم إنشاء الشهادة باستخدام <a target="_blank" href="https://github.com/GrapesJS/grapesjs">GrapesJS</a> كمحرر. تم ضبط المحرر على <a target="_blank" href="https://github.com/GrapesJS/grapesjs/issues/1936">dragMode:\'absolute\'</a>، مما يسمح لك بسحب المكونات وإفلاتها داخل المحرر. بعد الانتهاء من التعديل، انقر على "<strong>اختبار PDF</strong>" لمعاينة النتيجة، ثم استخدم زر "<strong>حفظ صفحة الشهادة</strong>" لحفظ الشهادة التي تم إنشاؤها.</p><p>نظرًا لقيود <a target="_blank" href="https://mpdf.github.io/">mPDF</a>، فإن العناصر الموجودة في جذر الشهادة فقط تدعم التموضع المطلق. لذلك يتم تقييد حركة المكونات الأخرى داخل DIV الجذر لمنع حدوث اختلافات في ملف PDF النهائي. يدعم mPDF التموضع المطلق فقط لعناصر <code>&lt;div&gt;</code>، لذلك عند استخدام كود مخصص لإدراج مكونات جديدة، ابدأ دائمًا بـ <code>&lt;div&gt;</code>.</p><p>بعد المحرر، ستجد مفاتيح يمكن إضافتها إلى الشهادة لتخصيصها. بالنسبة إلى QRCode، لاحظ أن صورة <code>qr-code.svg</code> يتم استبدالها بـ QRCode الذي ينشئه البرنامج المساعد. لذلك، إذا قمت بتعديل الصورة فقد تتأثر الوظيفة. أما التوقيع الذي ينشئه النظام فسيستبدل صورة <code>signature.png</code> في المشروع. وإذا اخترت صورة مخصصة للشهادة فلن يقوم البرنامج المساعد بإجراء هذا الاستبدال تلقائيًا.</p>';
$string['edit_signature_certificate'] = 'خصص توقيع شهادتك هنا';
$string['edit_this_page'] = 'تحرير صفحة الشهادة هذه';
$string['from_certificates'] = 'شهادات المتعلم {$a}';
$string['gradepass'] = 'الدرجة النهائية الدنيا للمقرر';
$string['gradepass_required'] = 'يجب تحديد درجة نهائية دنيا رقمية للمقرر.';
$string['help_base_title'] = 'المفاتيح المتاحة للاستبدال داخل الشهادة:';
$string['list_model'] = 'قائمة النماذج';
$string['manage_models'] = 'إدارة نماذج الشهادات';
$string['model_name'] = 'اسم النموذج';
$string['model_name_missing'] = 'اسم النموذج مطلوب';
$string['model_orientation'] = 'الاتجاه';
$string['model_orientation_l'] = 'أفقي';
$string['model_orientation_p'] = 'عمودي';
$string['model_page_name'] = 'الصفحة: {$a}';
$string['modulename'] = 'Beautiful Certificate';
$string['modulenameplural'] = 'Beautiful Certificates';
$string['my_certificates'] = 'شهاداتي';
$string['new_model'] = 'نموذج جديد';
$string['notification_body'] = 'مرحبًا {$a->fullname}،<br><br>أصبحت شهادتك <strong>{$a->certificatename}</strong> للمقرر <strong>{$a->coursename}</strong> متاحة الآن.<br><br>يمكنك الوصول إليها من هنا: <a href="{$a->url}">{$a->url}</a>';
$string['notification_subject'] = 'شهادتك متاحة الآن: {$a->certificatename}';
$string['notifyuser'] = 'إرسال إشعار عبر البريد الإلكتروني عند إصدار الشهادة';
$string['only_format'] = 'عرض تنسيق {$a} فقط';
$string['pages_certificate'] = 'صفحات الشهادة';
$string['pluginadministration'] = 'إدارة شهادات المقرر';
$string['pluginname'] = 'Beautiful Certificate';
$string['preview_certificate'] = 'معاينة الشهادة';
$string['privacy:metadata:certificatebeautiful_issue'] = 'معلومات حول الشهادات الصادرة للمستخدمين.';
$string['privacy:metadata:certificatebeautiful_issue:userid'] = 'يخزن معرّف المستخدم الذي حصل على الشهادة.';
$string['report'] = 'عرض الشهادات التي تم إنشاؤها';
$string['report_code'] = 'رمز الشهادة';
$string['report_confirm_delete_certificate'] = 'هل أنت متأكد من رغبتك في حذف هذه الشهادة؟';
$string['report_create_certificate'] = 'إنشاء شهادة';
$string['report_delete_certificate'] = 'حذف';
$string['report_deleted_certificate'] = 'تم حذف الشهادة بنجاح!';
$string['report_filename'] = 'الشهادات التي أنشأها المتعلمون';
$string['report_finalgrade'] = 'الدرجة النهائية للمقرر';
$string['report_timecreated'] = 'تاريخ الإنشاء';
$string['report_title'] = 'التقرير';
$string['report_useremail'] = 'البريد الإلكتروني للمتعلم';
$string['report_usernome'] = 'اسم المتعلم';
$string['report_view_certificate'] = 'عرض';
$string['save_model'] = 'حفظ النموذج';
$string['select_a_model'] = 'اختر نموذجًا';
$string['select_background_image'] = 'اختر صورة خلفية جديدة للشهادة';
$string['select_background_image_info2'] = '<div class="alert alert-warning">
<p>يرجى رفع صورة جديدة لاستبدال خلفية الشهادة.</p>
<p>الشهادة بتنسيق <strong>{$a->orientation}</strong>، ويجب أن تكون أبعاد الصورة <strong>{$a->size} بكسل</strong>، بما يعادل <strong>{$a->sizecm} سم</strong>. احرص على الحفاظ على هذه النسب لتجنب التشويه أو ظهور البكسلات.</p>
</div>';
$string['select_background_preview'] = 'تغيير صورة خلفية الشهادة';
$string['select_model'] = 'عرض هذا النموذج';
$string['select_model_preview'] = 'اختر قالبًا موجودًا مسبقًا لتحديث تصميم هذه الصفحة';
$string['select_the_model'] = 'اختر النموذج';
$string['subplugintype_certificatebeautifuldatainfo'] = 'برنامج فرعي لـ Beautiful Certificate';
$string['subplugintype_certificatebeautifuldatainfo_plural'] = 'برنامج فرعي للبيانات لـ Beautiful Certificate';
$string['subtititle'] = 'للإكمال';
$string['sumary'] = 'الملخص';
$string['sumary-secound-page'] = 'شهادة ملخص';
$string['sumary-secound-page2'] = 'قائمة أقسام المقرر والوحدات';
$string['triggercmid_required'] = 'يجب اختيار نشاط لمشغّل إكمال النشاط.';
$string['using_this_page'] = 'استخدام هذا القالب';
$string['validate_certificate_code'] = 'رمز الأصالة';
$string['validate_certificate_course'] = 'مقرر الشهادة';
$string['validate_certificate_date'] = 'تاريخ الإصدار';
$string['validate_certificate_name'] = 'اسم الشهادة';
$string['validate_certificate_notfound'] = 'لم يتم العثور على رمز الأصالة!';
$string['validate_certificate_submit'] = 'التحقق من الرمز';
$string['validate_certificate_title'] = 'التحقق من أصالة الشهادة';
$string['validate_certificate_user'] = 'صادرة إلى';
$string['validate_certificate_validate'] = 'تحقق';
$string['view_my_certificate'] = 'عرض شهادتي في علامة تبويب جديدة';
