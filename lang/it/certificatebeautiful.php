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
 * Lang it file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['add_new_model'] = 'Aggiungi nuovo modello';
$string['add_new_page'] = 'Aggiungi una nuova pagina al certificato';
$string['autogenerate'] = 'Genera certificati automaticamente';
$string['autogenerate_help'] = 'Quando è abilitata, l\'attività pianificata creerà automaticamente le emissioni dei certificati e i file PDF.';
$string['autogenerate_task_name'] = 'Generazione automatica di Beautiful Certificate';
$string['autotrigger'] = 'Trigger di generazione automatica';
$string['autotrigger_activity'] = 'Attività richiesta per il trigger di completamento';
$string['autotrigger_activitycompletion'] = 'Completamento attività';
$string['autotrigger_coursecompletion'] = 'Completamento corso';
$string['autotrigger_gradethreshold'] = 'Valutazione finale minima del corso';
$string['autotrigger_required'] = 'Devi scegliere un trigger di generazione automatica.';
$string['best'] = 'Migliore';
$string['certdate'] = 'Data';
$string['certificate-appreciation'] = 'Certificato di Riconoscimento';
$string['certificate-details'] = 'Dettagli del Certificato';
$string['certificate-elegant'] = 'Certificato Elegante';
$string['certificate-flat-modern'] = 'Certificato Moderno Flat';
$string['certificate-golden'] = 'Certificato Dorato';
$string['certificate-gradient-golden-luxury'] = 'Certificato Dorato di Lusso con Gradiente';
$string['certificate-kids-animals'] = 'Per bambini con animali';
$string['certificate-kids-child-medical'] = 'Certificato medico per bambini';
$string['certificate-kids-gradient-modern'] = 'Modello moderno sfumato per bambini';
$string['certificate-kids-hand-drawn'] = 'Certificato prescolare disegnato a mano';
$string['certificate-kids-pastel'] = 'Grazioso certificato educativo dai colori pastello';
$string['certificate-modern'] = 'Certificato Moderno';
$string['certificate-modern-2'] = 'Certificato Moderno 2';
$string['certificate-simple'] = 'Certificato Semplice';
$string['certificate-vintage'] = 'Certificato Vintage';
$string['certificate_description'] = 'Descrivi il certificato';
$string['certificate_description_help'] = 'Testo descrittivo del certificato. Può contenere HTML semplice come &lt;b&gt;, &lt;i&gt;, &lt;u&gt; e stili di colore, ma fai attenzione perché il <a href="https://mpdf.github.io/" target="_blank">convertitore PDF presenta delle limitazioni</a>.';
$string['certificate_not_issued'] = 'Il tuo certificato non è ancora stato emesso.';
$string['certificatebeautiful-page_empty'] = 'Vuoto';
$string['certificatebeautiful:addinstance'] = 'Aggiungi istanza';
$string['certificatebeautiful:delete'] = 'Elimina istanza del certificato';
$string['certificatebeautiful:view'] = 'Consenti all\'utente di visualizzare Beautiful Certificate';
$string['certificatebeautiful:viewreport'] = 'Visualizza i report di Beautiful Certificate';
$string['certpresented'] = 'Questo certificato viene orgogliosamente conferito a';
$string['certsignature'] = 'Direttore';
$string['certtitle'] = 'Certificato';
$string['config_data_protect'] = 'Protezione dei Dati Personali';
$string['config_data_protect_admins_only'] = 'Visibile solo agli amministratori';
$string['config_data_protect_desc'] = 'Seleziona per anonimizzare i dati personali nel validatore dei certificati';
$string['config_data_protect_email_anonimized'] = 'Nome visibile ed e-mail anonimizzata';
$string['config_data_protect_hidden'] = 'Nascosto a tutti';
$string['config_data_protect_name_visible'] = 'Solo nome visibile';
$string['config_signature_color'] = 'Colore della linea della firma';
$string['config_signature_color_desc'] = 'Seleziona il colore della linea di scrittura della firma.';
$string['config_signature_enable'] = 'Abilita firma dinamica';
$string['config_signature_enable_desc'] = 'Quando selezionato, Beautiful Certificate creerà una firma personalizzata in base alla grafia scelta, al testo specificato e al colore.';
$string['config_signature_heading'] = 'Impostazioni Firma';
$string['config_signature_heading_desc'] = 'A questo punto devi decidere se creare una firma personalizzata usando una delle {$a} calligrafie precaricate. Le opzioni disponibili includono:';
$string['config_signature_text'] = 'Testo della Firma';
$string['config_signature_text_desc'] = 'Per abilitare la generazione automatica delle firme tramite Beautiful Certificate, è necessario fornire una sequenza di massimo 10 caratteri. Assicurati che non contenga spazi, numeri o accenti. Una sequenza composta da 5 a 7 caratteri produrrà generalmente una firma visivamente gradevole.';
$string['config_signature_typography'] = 'Stile del Testo della Firma';
$string['config_signature_typography_desc'] = 'Per impostazione predefinita, Beautiful Certificate genererà una firma utilizzando il testo seguente e userà questa calligrafia per personalizzare il contenuto.';
$string['course'] = 'Corso';
$string['course_certificates'] = 'Certificati del corso';
$string['create_after_model'] = 'Salva prima il modello prima di aggiungere pagine al certificato';
$string['create_at_certificate'] = 'Certificato per {$a}';
$string['create_model'] = 'Crea modello';
$string['default-description'] = 'Questo certificato, in riconoscimento del completamento con successo del corso <b>{\\$COURSE->fullname}</b> con distinzione, consolida un insieme completo di conoscenze e competenze essenziali per eccellere in ambienti dinamici.';
$string['delete-page'] = 'Elimina questa pagina dal certificato';
$string['deletedmodel'] = 'Il modello "{$a}" è stato eliminato correttamente.';
$string['deletemodelconfirm'] = 'Vuoi davvero eliminare il modello <strong>{$a}</strong>?';
$string['download_my_certificate'] = 'Scarica il mio certificato';
$string['edit_page'] = 'Modifica pagina del certificato';
$string['edit_page_instruction'] = '<p>Il certificato viene creato utilizzando <a target="_blank" href="https://github.com/GrapesJS/grapesjs">GrapesJS</a> come editor. L\'editor è configurato con <a target="_blank" href="https://github.com/GrapesJS/grapesjs/issues/1936">dragMode:\'absolute\'</a>, consentendo di trascinare e rilasciare i componenti all\'interno dell\'editor. Dopo la modifica, fai clic su "<strong>Prova PDF</strong>" per visualizzare l\'anteprima del risultato e, al termine, utilizza il pulsante "<strong>Salva Pagina del Certificato</strong>" per salvare il certificato generato.</p><p>A causa delle limitazioni di <a target="_blank" href="https://mpdf.github.io/">mPDF</a>, solo gli elementi alla radice del certificato supportano il posizionamento assoluto. Pertanto, lo spostamento degli altri componenti all\'interno del DIV radice è limitato per evitare incongruenze nel PDF finale. mPDF supporta il posizionamento assoluto solo per gli elementi <code>&lt;div&gt;</code>; quando utilizzi Codice Personalizzato per inserire nuovi componenti, inizia sempre con <code>&lt;div&gt;</code>.</p><p>Dopo l\'editor troverai le chiavi che possono essere aggiunte al certificato per personalizzarlo. Per il QRCode, tieni presente che l\'immagine <code>qr-code.svg</code> viene sostituita dal QRCode generato dal plugin. Se modifichi l\'immagine, la funzionalità potrebbe essere compromessa. La firma generata dal sistema sostituirà invece l\'immagine <code>signature.png</code> nel progetto. Se scegli un\'immagine personalizzata per il certificato, il plugin non effettuerà automaticamente la sostituzione.</p>';
$string['edit_signature_certificate'] = 'Personalizza qui la firma del tuo certificato';
$string['edit_this_page'] = 'Modifica questa pagina del certificato';
$string['from_certificates'] = 'Certificati dello studente {$a}';
$string['gradepass'] = 'Valutazione finale minima del corso';
$string['gradepass_required'] = 'Devi definire una valutazione finale minima numerica per il corso.';
$string['help_base_title'] = 'Chiavi disponibili da sostituire nel certificato:';
$string['list_model'] = 'Elenco dei modelli';
$string['manage_models'] = 'Gestisci modelli di certificato';
$string['model_name'] = 'Nome del modello';
$string['model_name_missing'] = 'Il nome del modello è obbligatorio';
$string['model_orientation'] = 'Orientamento';
$string['model_orientation_l'] = 'Orizzontale';
$string['model_orientation_p'] = 'Verticale';
$string['model_page_name'] = 'Pagina: {$a}';
$string['modulename'] = 'Beautiful Certificate';
$string['modulenameplural'] = 'Beautiful Certificates';
$string['my_certificates'] = 'I miei certificati';
$string['new_model'] = 'Nuovo Modello';
$string['notification_body'] = 'Ciao {$a->fullname},<br><br>Il tuo certificato <strong>{$a->certificatename}</strong> per il corso <strong>{$a->coursename}</strong> è ora disponibile.<br><br>Accedi qui: <a href="{$a->url}">{$a->url}</a>';
$string['notification_subject'] = 'Il tuo certificato è disponibile: {$a->certificatename}';
$string['notifyuser'] = 'Invia una notifica e-mail quando il certificato viene emesso';
$string['only_format'] = 'Mostra solo il formato {$a}';
$string['pages_certificate'] = 'Pagine del certificato';
$string['pluginadministration'] = 'Amministrazione dei certificati del corso';
$string['pluginname'] = 'Beautiful Certificate';
$string['preview_certificate'] = 'Anteprima del certificato';
$string['privacy:metadata:certificatebeautiful_issue'] = 'Informazioni sui certificati emessi agli utenti.';
$string['privacy:metadata:certificatebeautiful_issue:userid'] = 'Memorizza l\'ID dell\'utente che ha ricevuto il certificato.';
$string['report'] = 'Visualizza certificati generati';
$string['report_code'] = 'Codice del certificato';
$string['report_confirm_delete_certificate'] = 'Sei sicuro di voler eliminare questo certificato?';
$string['report_create_certificate'] = 'Crea certificato';
$string['report_delete_certificate'] = 'Elimina';
$string['report_deleted_certificate'] = 'Certificato eliminato correttamente!';
$string['report_filename'] = 'Certificati generati dagli studenti';
$string['report_finalgrade'] = 'Valutazione finale del corso';
$string['report_timecreated'] = 'Creato il';
$string['report_title'] = 'Report';
$string['report_useremail'] = 'E-mail dello studente';
$string['report_usernome'] = 'Nome dello studente';
$string['report_view_certificate'] = 'Visualizza';
$string['save_model'] = 'Salva modello';
$string['select_a_model'] = 'Seleziona un modello';
$string['select_background_image'] = 'Seleziona la nuova immagine di sfondo del certificato';
$string['select_background_image_info2'] = '<div class="alert alert-warning">
<p>Carica una nuova immagine per sostituire lo sfondo del certificato.</p>
<p>Il certificato è in formato <strong>{$a->orientation}</strong> e l\'immagine deve avere dimensioni di <strong>{$a->size} pixel</strong>, corrispondenti a <strong>{$a->sizecm} cm</strong>. Mantieni queste proporzioni per evitare distorsioni o pixelatura.</p>
</div>';
$string['select_background_preview'] = 'Cambia l\'immagine di sfondo del certificato';
$string['select_model'] = 'Visualizza questo modello';
$string['select_model_preview'] = 'Seleziona un modello esistente per aggiornare il design di questa pagina';
$string['select_the_model'] = 'Seleziona il modello';
$string['subplugintype_certificatebeautifuldatainfo'] = 'Sottoplugin di Beautiful Certificate';
$string['subplugintype_certificatebeautifuldatainfo_plural'] = 'Sottoplugin dati di Beautiful Certificate';
$string['subtititle'] = 'Di completamento';
$string['sumary'] = 'Riepilogo';
$string['sumary-secound-page'] = 'Certificato Riepilogativo';
$string['sumary-secound-page2'] = 'Elenco delle sezioni e dei moduli del corso';
$string['triggercmid_required'] = 'Devi scegliere un\'attività per il trigger di completamento dell\'attività.';
$string['using_this_page'] = 'Usa questo modello';
$string['validate_certificate_code'] = 'Codice di autenticità';
$string['validate_certificate_course'] = 'Corso del certificato';
$string['validate_certificate_date'] = 'Emesso in data';
$string['validate_certificate_name'] = 'Nome del certificato';
$string['validate_certificate_notfound'] = 'Codice di autenticità non trovato!';
$string['validate_certificate_submit'] = 'Valida codice';
$string['validate_certificate_title'] = 'Verifica autenticità del certificato';
$string['validate_certificate_user'] = 'Emesso a';
$string['validate_certificate_validate'] = 'Valida';
$string['view_my_certificate'] = 'Visualizza il mio certificato in una nuova scheda';
