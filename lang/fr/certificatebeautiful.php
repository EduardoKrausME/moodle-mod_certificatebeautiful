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
 * Lang fr file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['add_new_model'] = 'Ajouter un nouveau modèle';
$string['add_new_page'] = 'Ajouter une nouvelle page au certificat';
$string['autogenerate'] = 'Générer automatiquement les certificats';
$string['autogenerate_help'] = 'Lorsque cette option est activée, la tâche planifiée crée automatiquement les émissions de certificats et les fichiers PDF.';
$string['autogenerate_task_name'] = 'Génération automatique de Beautiful Certificate';
$string['autotrigger'] = 'Déclencheur de génération automatique';
$string['autotrigger_activity'] = 'Activité requise pour le déclencheur d\'achèvement';
$string['autotrigger_activitycompletion'] = 'Achèvement de l\'activité';
$string['autotrigger_coursecompletion'] = 'Achèvement du cours';
$string['autotrigger_gradethreshold'] = 'Note finale minimale du cours';
$string['autotrigger_required'] = 'Vous devez choisir un déclencheur de génération automatique.';
$string['best'] = 'Meilleur';
$string['certdate'] = 'Date';
$string['certificate-appreciation'] = 'Certificat de Reconnaissance';
$string['certificate-details'] = 'Détails du Certificat';
$string['certificate-elegant'] = 'Certificat Élégant';
$string['certificate-flat-modern'] = 'Certificat Moderne Plat';
$string['certificate-golden'] = 'Certificat Doré';
$string['certificate-gradient-golden-luxury'] = 'Certificat Doré de Luxe en Dégradé';
$string['certificate-kids-animals'] = 'Pour les enfants avec des animaux';
$string['certificate-kids-child-medical'] = 'Certificat médical pour enfants';
$string['certificate-kids-gradient-modern'] = 'Modèle moderne en dégradé pour enfants';
$string['certificate-kids-hand-drawn'] = 'Certificat préscolaire dessiné à la main';
$string['certificate-kids-pastel'] = 'Joli certificat éducatif aux tons pastel';
$string['certificate-modern'] = 'Certificat Moderne';
$string['certificate-modern-2'] = 'Certificat Moderne 2';
$string['certificate-simple'] = 'Certificat Simple';
$string['certificate-vintage'] = 'Certificat Vintage';
$string['certificate_description'] = 'Décrire le certificat';
$string['certificate_description_help'] = 'Texte de description du certificat. Il peut contenir du HTML simple tel que &lt;b&gt;, &lt;i&gt;, &lt;u&gt; et des styles de couleur, mais soyez prudent car le <a href="https://mpdf.github.io/" target="_blank">convertisseur PDF présente des limitations</a>.';
$string['certificate_not_issued'] = 'Votre certificat n\'a pas encore été délivré.';
$string['certificatebeautiful-page_empty'] = 'Vide';
$string['certificatebeautiful:addinstance'] = 'Ajouter une instance';
$string['certificatebeautiful:delete'] = 'Supprimer l\'instance du certificat';
$string['certificatebeautiful:view'] = 'Autoriser l\'utilisateur à consulter le Beautiful Certificate';
$string['certificatebeautiful:viewreport'] = 'Consulter les rapports de Beautiful Certificate';
$string['certpresented'] = 'Ce certificat est fièrement décerné à';
$string['certsignature'] = 'Directeur';
$string['certtitle'] = 'Certificat';
$string['config_data_protect'] = 'Protection des Données Personnelles';
$string['config_data_protect_admins_only'] = 'Visible uniquement par les administrateurs';
$string['config_data_protect_desc'] = 'Cochez cette option pour anonymiser les données personnelles dans le validateur de certificats';
$string['config_data_protect_email_anonimized'] = 'Nom visible et adresse e-mail anonymisée';
$string['config_data_protect_hidden'] = 'Masqué pour tout le monde';
$string['config_data_protect_name_visible'] = 'Nom visible uniquement';
$string['config_signature_color'] = 'Couleur de la ligne de signature';
$string['config_signature_color_desc'] = 'Sélectionnez la couleur de la ligne d\'écriture de la signature.';
$string['config_signature_enable'] = 'Activer la signature dynamique';
$string['config_signature_enable_desc'] = 'Lorsque cette option est cochée, Beautiful Certificate crée une signature personnalisée à partir de la calligraphie choisie, du texte indiqué et de la couleur.';
$string['config_signature_heading'] = 'Paramètres de Signature';
$string['config_signature_heading_desc'] = 'À ce stade, vous devez décider si vous souhaitez créer une signature personnalisée à partir des {$a} calligraphies préchargées. Les options disponibles sont les suivantes :';
$string['config_signature_text'] = 'Texte de la Signature';
$string['config_signature_text_desc'] = 'Pour activer la génération automatique de signatures par Beautiful Certificate, vous devez fournir une séquence de 10 caractères maximum. Assurez-vous qu\'elle ne contient ni espaces, ni chiffres, ni accents. Une séquence de 5 à 7 caractères donnera généralement une signature visuellement agréable.';
$string['config_signature_typography'] = 'Style du Texte de Signature';
$string['config_signature_typography_desc'] = 'Par défaut, Beautiful Certificate génère une signature à l\'aide du texte suivant et utilise cette calligraphie pour personnaliser le contenu.';
$string['course'] = 'Cours';
$string['course_certificates'] = 'Certificats du cours';
$string['create_after_model'] = 'Enregistrez d\'abord le modèle avant d\'ajouter des pages au certificat';
$string['create_at_certificate'] = 'Certificat pour {$a}';
$string['create_model'] = 'Créer un modèle';
$string['default-description'] = 'Ce certificat, en reconnaissance de la réussite du cours <b>{\\$COURSE->fullname}</b> avec distinction, atteste d\'un ensemble complet de connaissances et de compétences essentielles pour réussir dans des environnements dynamiques.';
$string['delete-page'] = 'Supprimer cette page du certificat';
$string['deletedmodel'] = 'Le modèle "{$a}" a été supprimé avec succès.';
$string['deletemodelconfirm'] = 'Voulez-vous vraiment supprimer le modèle <strong>{$a}</strong> ?';
$string['download_my_certificate'] = 'Télécharger mon certificat';
$string['edit_page'] = 'Modifier la page du certificat';
$string['edit_page_instruction'] = '<p>Le certificat est créé avec <a target="_blank" href="https://github.com/GrapesJS/grapesjs">GrapesJS</a> comme éditeur. L\'éditeur est configuré avec <a target="_blank" href="https://github.com/GrapesJS/grapesjs/issues/1936">dragMode:\'absolute\'</a>, ce qui permet de faire glisser et déposer les composants dans l\'éditeur. Après la modification, cliquez sur "<strong>Tester le PDF</strong>" pour prévisualiser le résultat puis, lorsque vous avez terminé, utilisez le bouton "<strong>Enregistrer la Page du Certificat</strong>" pour enregistrer le certificat généré.</p><p>En raison des limitations de <a target="_blank" href="https://mpdf.github.io/">mPDF</a>, seuls les éléments placés à la racine du certificat prennent en charge le positionnement absolu. Le déplacement des autres composants à l\'intérieur du DIV racine est donc limité afin d\'éviter des incohérences dans le PDF final. mPDF prend en charge le positionnement absolu uniquement pour les éléments <code>&lt;div&gt;</code>. Lorsque vous utilisez du Code Personnalisé pour insérer de nouveaux composants, commencez donc toujours par <code>&lt;div&gt;</code>.</p><p>Après l\'éditeur, vous trouverez des clés pouvant être ajoutées au certificat afin de le personnaliser. Pour le QRCode, l\'image <code>qr-code.svg</code> est remplacée par le QRCode généré par le plugin. Si vous modifiez cette image, la fonctionnalité peut être affectée. La signature générée par le système remplacera l\'image <code>signature.png</code> du projet. Si vous choisissez une image personnalisée pour le certificat, le plugin n\'effectuera pas ce remplacement automatiquement.</p>';
$string['edit_signature_certificate'] = 'Personnalisez ici la signature de votre certificat';
$string['edit_this_page'] = 'Modifier cette page du certificat';
$string['from_certificates'] = 'Certificats de l\'étudiant {$a}';
$string['gradepass'] = 'Note finale minimale du cours';
$string['gradepass_required'] = 'Vous devez définir une note finale minimale numérique pour le cours.';
$string['help_base_title'] = 'Clés disponibles à remplacer dans le certificat :';
$string['list_model'] = 'Liste des modèles';
$string['manage_models'] = 'Gérer les modèles de certificat';
$string['model_name'] = 'Nom du modèle';
$string['model_name_missing'] = 'Le nom du modèle est obligatoire';
$string['model_orientation'] = 'Orientation';
$string['model_orientation_l'] = 'Paysage';
$string['model_orientation_p'] = 'Portrait';
$string['model_page_name'] = 'Page : {$a}';
$string['modulename'] = 'Beautiful Certificate';
$string['modulenameplural'] = 'Beautiful Certificates';
$string['my_certificates'] = 'Mes certificats';
$string['new_model'] = 'Nouveau Modèle';
$string['notification_body'] = 'Bonjour {$a->fullname},<br><br>Votre certificat <strong>{$a->certificatename}</strong> pour le cours <strong>{$a->coursename}</strong> est maintenant disponible.<br><br>Accédez-y ici : <a href="{$a->url}">{$a->url}</a>';
$string['notification_subject'] = 'Votre certificat est disponible : {$a->certificatename}';
$string['notifyuser'] = 'Envoyer une notification par e-mail lorsque le certificat est délivré';
$string['only_format'] = 'Afficher uniquement le format {$a}';
$string['pages_certificate'] = 'Pages du certificat';
$string['pluginadministration'] = 'Administration des certificats du cours';
$string['pluginname'] = 'Beautiful Certificate';
$string['preview_certificate'] = 'Aperçu du certificat';
$string['privacy:metadata:certificatebeautiful_issue'] = 'Informations sur les certificats délivrés aux utilisateurs.';
$string['privacy:metadata:certificatebeautiful_issue:userid'] = 'Stocke l\'identifiant de l\'utilisateur ayant reçu le certificat.';
$string['report'] = 'Voir les certificats générés';
$string['report_code'] = 'Code du certificat';
$string['report_confirm_delete_certificate'] = 'Voulez-vous vraiment supprimer ce certificat ?';
$string['report_create_certificate'] = 'Créer un certificat';
$string['report_delete_certificate'] = 'Supprimer';
$string['report_deleted_certificate'] = 'Certificat supprimé avec succès !';
$string['report_filename'] = 'Certificats générés par les étudiants';
$string['report_finalgrade'] = 'Note finale du cours';
$string['report_timecreated'] = 'Créé le';
$string['report_title'] = 'Rapport';
$string['report_useremail'] = 'E-mail de l\'étudiant';
$string['report_usernome'] = 'Nom de l\'étudiant';
$string['report_view_certificate'] = 'Voir';
$string['save_model'] = 'Enregistrer le modèle';
$string['select_a_model'] = 'Sélectionner un modèle';
$string['select_background_image'] = 'Sélectionner la nouvelle image d\'arrière-plan du certificat';
$string['select_background_image_info2'] = '<div class="alert alert-warning">
<p>Veuillez téléverser une nouvelle image pour remplacer l\'arrière-plan du certificat.</p>
<p>Le certificat est au format <strong>{$a->orientation}</strong> et l\'image doit avoir des dimensions de <strong>{$a->size} pixels</strong>, correspondant à <strong>{$a->sizecm} cm</strong>. Veillez à conserver ces proportions pour éviter toute déformation ou pixellisation.</p>
</div>';
$string['select_background_preview'] = 'Modifier l\'image d\'arrière-plan du certificat';
$string['select_model'] = 'Voir ce modèle';
$string['select_model_preview'] = 'Sélectionner un modèle existant pour mettre à jour la conception de cette page';
$string['select_the_model'] = 'Sélectionner le modèle';
$string['subplugintype_certificatebeautifuldatainfo'] = 'Sous-plugin de Beautiful Certificate';
$string['subplugintype_certificatebeautifuldatainfo_plural'] = 'Sous-plugin de données de Beautiful Certificate';
$string['subtititle'] = 'D\'achèvement';
$string['sumary'] = 'Résumé';
$string['sumary-secound-page'] = 'Certificat Récapitulatif';
$string['sumary-secound-page2'] = 'Liste des sections et modules du cours';
$string['triggercmid_required'] = 'Vous devez choisir une activité pour le déclencheur d\'achèvement de l\'activité.';
$string['using_this_page'] = 'Utiliser ce modèle';
$string['validate_certificate_code'] = 'Code d\'authenticité';
$string['validate_certificate_course'] = 'Cours du certificat';
$string['validate_certificate_date'] = 'Délivré le';
$string['validate_certificate_name'] = 'Nom du certificat';
$string['validate_certificate_notfound'] = 'Code d\'authenticité introuvable !';
$string['validate_certificate_submit'] = 'Valider le code';
$string['validate_certificate_title'] = 'Vérifier l\'authenticité du certificat';
$string['validate_certificate_user'] = 'Délivré à';
$string['validate_certificate_validate'] = 'Valider';
$string['view_my_certificate'] = 'Voir mon certificat dans un nouvel onglet';
