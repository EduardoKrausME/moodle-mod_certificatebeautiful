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
 * Lang sk file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['add_new_model'] = 'Pridať nový model';
$string['add_new_page'] = 'Pridať novú stránku do certifikátu';
$string['autogenerate'] = 'Generovať certifikáty automaticky';
$string['autogenerate_help'] = 'Ak je táto možnosť zapnutá, naplánovaná úloha automaticky vytvorí záznamy o vydaní certifikátov a súbory PDF.';
$string['autogenerate_task_name'] = 'Automatické generovanie Beautiful Certificate';
$string['autotrigger'] = 'Spúšťač automatického generovania';
$string['autotrigger_activity'] = 'Aktivita požadovaná pre spúšťač dokončenia';
$string['autotrigger_activitycompletion'] = 'Dokončenie aktivity';
$string['autotrigger_coursecompletion'] = 'Dokončenie kurzu';
$string['autotrigger_gradethreshold'] = 'Minimálna záverečná známka kurzu';
$string['autotrigger_required'] = 'Musíte vybrať spúšťač automatického generovania.';
$string['best'] = 'Najlepší';
$string['certdate'] = 'Dátum';
$string['certificate-appreciation'] = 'Certifikát uznania';
$string['certificate-details'] = 'Podrobnosti certifikátu';
$string['certificate-elegant'] = 'Elegantný certifikát';
$string['certificate-flat-modern'] = 'Moderný plochý certifikát';
$string['certificate-golden'] = 'Zlatý certifikát';
$string['certificate-gradient-golden-luxury'] = 'Luxusný zlatý certifikát s prechodom';
$string['certificate-kids-animals'] = 'Pre deti so zvieratami';
$string['certificate-kids-child-medical'] = 'Detský zdravotnícky certifikát';
$string['certificate-kids-gradient-modern'] = 'Moderná prechodová šablóna pre deti';
$string['certificate-kids-hand-drawn'] = 'Ručne kreslený predškolský certifikát';
$string['certificate-kids-pastel'] = 'Milý vzdelávací certifikát v pastelových farbách';
$string['certificate-modern'] = 'Moderný certifikát';
$string['certificate-modern-2'] = 'Moderný certifikát 2';
$string['certificate-simple'] = 'Jednoduchý certifikát';
$string['certificate-vintage'] = 'Vintage certifikát';
$string['certificate_description'] = 'Opíšte certifikát';
$string['certificate_description_help'] = 'Text opisu certifikátu. Môže obsahovať jednoduché HTML, napríklad &lt;b&gt;, &lt;i&gt;, &lt;u&gt; a farebné štýly, ale berte do úvahy, že <a href="https://mpdf.github.io/" target="_blank">PDF konvertor má obmedzenia</a>.';
$string['certificate_not_issued'] = 'Váš certifikát ešte nebol vydaný.';
$string['certificatebeautiful-page_empty'] = 'Prázdne';
$string['certificatebeautiful:addinstance'] = 'Pridať inštanciu';
$string['certificatebeautiful:delete'] = 'Odstrániť inštanciu certifikátu';
$string['certificatebeautiful:view'] = 'Povoliť používateľovi zobraziť Beautiful Certificate';
$string['certificatebeautiful:viewreport'] = 'Zobraziť reporty Beautiful Certificate';
$string['certpresented'] = 'Tento certifikát sa s hrdosťou udeľuje';
$string['certsignature'] = 'Riaditeľ';
$string['certtitle'] = 'Certifikát';
$string['config_data_protect'] = 'Ochrana osobných údajov';
$string['config_data_protect_admins_only'] = 'Viditeľné iba pre administrátorov';
$string['config_data_protect_desc'] = 'Zaškrtnite, ak chcete anonymizovať osobné údaje vo validátore certifikátov';
$string['config_data_protect_email_anonimized'] = 'Meno je viditeľné a e-mail je anonymizovaný';
$string['config_data_protect_hidden'] = 'Skryté pre všetkých';
$string['config_data_protect_name_visible'] = 'Viditeľné iba meno';
$string['config_signature_color'] = 'Farba čiary podpisu';
$string['config_signature_color_desc'] = 'Vyberte farbu čiary pre podpis.';
$string['config_signature_enable'] = 'Povoliť dynamický podpis';
$string['config_signature_enable_desc'] = 'Ak je táto možnosť zapnutá, Beautiful Certificate vytvorí prispôsobený podpis podľa zvoleného rukopisu, zadaného textu a farby.';
$string['config_signature_heading'] = 'Nastavenia podpisu';
$string['config_signature_heading_desc'] = 'V tejto chvíli sa musíte rozhodnúť, či chcete vytvoriť vlastný podpis z {$a} predinštalovaných kaligrafií. Dostupné možnosti zahŕňajú:';
$string['config_signature_text'] = 'Text podpisu';
$string['config_signature_text_desc'] = 'Ak chcete povoliť automatické generovanie podpisov pomocou Beautiful Certificate, je potrebné zadať reťazec s maximálne 10 znakmi. Uistite sa, že neobsahuje medzery, čísla ani diakritiku. Reťazec s 5 až 7 znakmi zvyčajne vytvorí vizuálne príjemný podpis.';
$string['config_signature_typography'] = 'Štýl textu podpisu';
$string['config_signature_typography_desc'] = 'Beautiful Certificate štandardne vygeneruje podpis pomocou nasledujúceho textu a použije túto kaligrafiu na prispôsobenie obsahu.';
$string['course'] = 'Kurz';
$string['course_certificates'] = 'Certifikáty kurzu';
$string['create_after_model'] = 'Pred pridaním stránok do certifikátu najprv uložte model';
$string['create_at_certificate'] = 'Certifikát pre {$a}';
$string['create_model'] = 'Vytvoriť model';
$string['default-description'] = 'Tento certifikát oceňuje úspešné absolvovanie kurzu <b>{\\$COURSE->fullname}</b> s vyznamenaním a potvrdzuje komplexný súbor vedomostí a základných zručností potrebných na úspech v dynamickom prostredí.';
$string['delete-page'] = 'Odstrániť túto stránku z certifikátu';
$string['deletedmodel'] = 'Model "{$a}" bol úspešne odstránený.';
$string['deletemodelconfirm'] = 'Naozaj chcete odstrániť model <strong>{$a}</strong>?';
$string['download_my_certificate'] = 'Stiahnuť môj certifikát';
$string['edit_page'] = 'Upraviť stránku certifikátu';
$string['edit_page_instruction'] = '<p>Certifikát sa vytvára pomocou editora <a target="_blank" href="https://github.com/GrapesJS/grapesjs">GrapesJS</a>. Editor je nakonfigurovaný s nastavením <a target="_blank" href="https://github.com/GrapesJS/grapesjs/issues/1936">dragMode:\'absolute\'</a>, ktoré umožňuje presúvať komponenty v editore pomocou drag-and-drop. Po úprave kliknite na "<strong>Otestovať PDF</strong>", aby ste zobrazili náhľad výsledku, a po dokončení použite tlačidlo "<strong>Uložiť stránku certifikátu</strong>" na uloženie vytvoreného certifikátu.</p><p>Vzhľadom na obmedzenia <a target="_blank" href="https://mpdf.github.io/">mPDF</a> podporujú absolútne umiestnenie iba prvky v koreňovej úrovni certifikátu. Pohyb ostatných komponentov v koreňovom DIV je preto obmedzený, aby sa predišlo nezrovnalostiam vo výslednom PDF. mPDF podporuje absolútne umiestnenie iba pre prvky <code>&lt;div&gt;</code>, preto pri používaní Vlastného kódu na vloženie nových komponentov vždy začnite s <code>&lt;div&gt;</code>.</p><p>Pod editorom nájdete kľúče, ktoré možno pridať do certifikátu na jeho prispôsobenie. Pri QRCode si všimnite, že obrázok <code>qr-code.svg</code> je nahradený QRCode vygenerovaným pluginom. Ak obrázok upravíte, funkčnosť môže byť narušená. Podpis vytvorený systémom nahradí obrázok <code>signature.png</code> v projekte. Ak pre certifikát vyberiete vlastný obrázok, plugin túto náhradu nevykoná automaticky.</p>';
$string['edit_signature_certificate'] = 'Prispôsobte podpis certifikátu tu';
$string['edit_this_page'] = 'Upraviť túto stránku certifikátu';
$string['from_certificates'] = 'Certifikáty účastníka {$a}';
$string['gradepass'] = 'Minimálna záverečná známka kurzu';
$string['gradepass_required'] = 'Musíte zadať číselnú minimálnu záverečnú známku kurzu.';
$string['help_base_title'] = 'Dostupné kľúče na nahradenie v certifikáte:';
$string['list_model'] = 'Zoznam modelov';
$string['manage_models'] = 'Spravovať modely certifikátov';
$string['model_name'] = 'Názov modelu';
$string['model_name_missing'] = 'Názov modelu je povinný';
$string['model_orientation'] = 'Orientácia';
$string['model_orientation_l'] = 'Na šírku';
$string['model_orientation_p'] = 'Na výšku';
$string['model_page_name'] = 'Stránka: {$a}';
$string['modulename'] = 'Beautiful Certificate';
$string['modulenameplural'] = 'Beautiful Certificates';
$string['my_certificates'] = 'Moje certifikáty';
$string['new_model'] = 'Nový model';
$string['notification_body'] = 'Dobrý deň, {$a->fullname},<br><br>váš certifikát <strong>{$a->certificatename}</strong> ku kurzu <strong>{$a->coursename}</strong> je teraz k dispozícii.<br><br>Otvoriť: <a href="{$a->url}">{$a->url}</a>';
$string['notification_subject'] = 'Váš certifikát je k dispozícii: {$a->certificatename}';
$string['notifyuser'] = 'Odoslať e-mailové upozornenie pri vydaní certifikátu';
$string['only_format'] = 'Zobraziť iba formát {$a}';
$string['pages_certificate'] = 'Stránky certifikátu';
$string['pluginadministration'] = 'Správa certifikátov kurzu';
$string['pluginname'] = 'Beautiful Certificate';
$string['preview_certificate'] = 'Náhľad certifikátu';
$string['privacy:metadata:certificatebeautiful_issue'] = 'Informácie o certifikátoch vydaných používateľom.';
$string['privacy:metadata:certificatebeautiful_issue:userid'] = 'Ukladá ID používateľa, ktorý dostal certifikát.';
$string['report'] = 'Zobraziť vygenerované certifikáty';
$string['report_code'] = 'Kód certifikátu';
$string['report_confirm_delete_certificate'] = 'Naozaj chcete odstrániť tento certifikát?';
$string['report_create_certificate'] = 'Vytvoriť certifikát';
$string['report_delete_certificate'] = 'Odstrániť';
$string['report_deleted_certificate'] = 'Certifikát bol úspešne odstránený!';
$string['report_filename'] = 'Certifikáty vygenerované účastníkmi';
$string['report_finalgrade'] = 'Záverečná známka kurzu';
$string['report_timecreated'] = 'Vytvorené';
$string['report_title'] = 'Report';
$string['report_useremail'] = 'E-mail účastníka';
$string['report_usernome'] = 'Meno účastníka';
$string['report_view_certificate'] = 'Zobraziť';
$string['save_model'] = 'Uložiť model';
$string['select_a_model'] = 'Vyberte model';
$string['select_background_image'] = 'Vyberte nový obrázok pozadia certifikátu';
$string['select_background_image_info2'] = '<div class="alert alert-warning">
<p>Nahrajte nový obrázok, ktorý nahradí pozadie certifikátu.</p>
<p>Certifikát je vo formáte <strong>{$a->orientation}</strong> a obrázok musí mať rozmery <strong>{$a->size} pixelov</strong>, čo zodpovedá <strong>{$a->sizecm} cm</strong>. Zachovajte tieto proporcie, aby ste predišli deformácii alebo pixelizácii.</p>
</div>';
$string['select_background_preview'] = 'Zmeniť obrázok pozadia certifikátu';
$string['select_model'] = 'Zobraziť tento model';
$string['select_model_preview'] = 'Vyberte existujúcu šablónu na aktualizáciu dizajnu tejto stránky';
$string['select_the_model'] = 'Vyberte model';
$string['subplugintype_certificatebeautifuldatainfo'] = 'Subplugin Beautiful Certificate';
$string['subplugintype_certificatebeautifuldatainfo_plural'] = 'Dátový subplugin Beautiful Certificate';
$string['subtititle'] = 'O dokončení';
$string['sumary'] = 'Súhrn';
$string['sumary-secound-page'] = 'Súhrnný certifikát';
$string['sumary-secound-page2'] = 'Zoznam sekcií a modulov kurzu';
$string['triggercmid_required'] = 'Musíte vybrať aktivitu pre spúšťač dokončenia aktivity.';
$string['using_this_page'] = 'Použiť túto šablónu';
$string['validate_certificate_code'] = 'Kód pravosti';
$string['validate_certificate_course'] = 'Kurz certifikátu';
$string['validate_certificate_date'] = 'Vydané dňa';
$string['validate_certificate_name'] = 'Názov certifikátu';
$string['validate_certificate_notfound'] = 'Kód pravosti sa nenašiel!';
$string['validate_certificate_submit'] = 'Overiť kód';
$string['validate_certificate_title'] = 'Overiť pravosť certifikátu';
$string['validate_certificate_user'] = 'Vydané pre';
$string['validate_certificate_validate'] = 'Overiť';
$string['view_my_certificate'] = 'Zobraziť môj certifikát na novej karte';
