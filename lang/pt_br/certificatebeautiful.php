<?php
// This file is part of the mod_certificatebeautiful plugin for Moodle - http://moodle.org/
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

defined('MOODLE_INTERNAL') || die();

$string['modulename'] = 'Beautiful certificate';
$string['pluginname'] = 'Beautiful certificate';
$string['modulenameplural'] = 'Certificados bonitos';
$string['pluginadministration'] = 'Administração de certificados de curso';

$string['select_a_model'] = 'Selecionar um modelo';
$string['select_the_model'] = 'Selecionar o modelo';
$string['certificate_description'] = 'Descreva o certificado';
$string['manage_models'] = 'Gerenciar modelos de certificado';
$string['list_model'] = 'Lista de modelos';
$string['add_new_model'] = 'Adicionar novo modelo';
$string['save_model'] = 'Salvar modelo';
$string['create_model'] = 'Criar modelo';
$string['new_model'] = 'Novo Modelo';
$string['model_name'] = 'Nome do modelo';
$string['model_name_missing'] = 'O nome do modelo é obrigatório';
$string['model_page_name'] = 'Página: {$a}';
$string['edit_this_page'] = 'Editar esta página de certificado';
$string['edit_page'] = 'Editar página de certificado';
$string['using_this_page'] = 'Usar esta página';
$string['add_new_page'] = 'Adicionar uma nova página ao certificado';
$string['pages_certificate'] = 'Páginas de certificado';
$string['create_after_model'] = 'Primeiro, salve o modelo antes de adicionar páginas ao certificado';
$string['select_model'] = 'Selecionar Modelo';
$string['select_model_preview'] = 'Selecionar um modelo pré-existente';
$string['report'] = 'Ver certificados gerados';
$string['download_my_certificate'] = 'Baixar meu certificado';
$string['view_my_certificate'] = 'Ver meu certificado em uma nova aba';
$string['preview_certificate'] = 'Prévia do certificado';
$string['create_at_certificate'] = 'Certificado para {$a}';

$string['course_certificates'] = 'Certificados de Curso';
$string['my_certificates'] = 'Meus Certificados';
$string['from_certificates'] = 'Certificados do estudante {$a}';

// Validação de certificado.
$string['validate_certificate_title'] = 'Verificar Autenticidade do Certificado';
$string['validate_certificate_notfound'] = 'Código de autenticidade não encontrado!';
$string['validate_certificate_code'] = 'Código de autenticidade';
$string['validate_certificate_submit'] = 'Validar Código';
$string['validate_certificate_date'] = 'Emitido na data de';
$string['validate_certificate_user'] = 'Emitido para';
$string['validate_certificate_name'] = 'Nome do Certificado';
$string['validate_certificate_course'] = 'Curso do Certificado';

// Relatório.
$string['report_filename'] = 'Certificados gerados pelos estudantes';
$string['report_usernome'] = 'Nome do estudante';
$string['report_useremail'] = 'E-mail do estudante';
$string['report_code'] = 'Código do certificado';
$string['report_timecreated'] = 'Criado em';
$string['report_view_certificate'] = 'Ver';
$string['report_delete_certificate'] = 'Excluir';
$string['report_confirm_delete_certificate'] = 'Tem certeza de que deseja excluir este certificado?';
$string['report_deleted_certificate'] = 'Certificado excluído com sucesso!';

// Instalação.
$string['certificate-appreciation'] = 'Certificado de Apreciação';
$string['certificate-elegant'] = 'Certificado Elegante';
$string['certificate-golden'] = 'Certificado Dourado';
$string['certificate-kids-animals'] = 'Para crianças com animais';
$string['certificate-kids-child-medical'] = 'Certificado médico infantil';
$string['certificate-kids-gradient-modern'] = 'Modelo de certificado moderno com gradiente';
$string['certificate-kids-hand-drawn'] = 'Certificado pré-escolar desenhado à mão';
$string['certificate-kids-pastel'] = 'Certificado de educação fofo em tons pastel';
$string['certificate-modern'] = 'Certificado Moderno';
$string['certificate-simple'] = 'Certificado Simples';
$string['certificate-vintage'] = 'Certificado Vintage';
$string['sumary-secound-page'] = 'Certificado de Resumo';

// Modelo de certificado.
$string['certtitle'] = 'Certificado';
$string['subtititle'] = 'DE CONCLUSÃO';
$string['certpresented'] = 'Este certificado é orgulhosamente apresentado a';
$string['certdate'] = 'Data';
$string['certsignature'] = 'Diretor';
$string['best'] = 'Melhor';
$string['course'] = 'Curso';
$string['default-description'] = 'Este certificado atesta que o estudante <b>{$USER->fullname}</b> concluiu com sucesso o <b>{$course->fullname}</b> com distinção, consolidando um conjunto abrangente de conhecimentos e habilidades essenciais para se destacar em ambientes dinâmicos.';
$string['certificate_description_help'] = 'Texto de descrição do Certificado. Pode conter HTML simples como &lt;b&gt;, &lt;i&gt;, &lt;u&gt; e estilos de cores, mais cuidado, pois o <a href="https://mpdf.github.io/" taret="_blank">conversor de PDF tem limitações</a>.';
$string['sumary'] = 'Resumo';
$string['certificatebeautiful-page_empty'] = 'Vazio';

$string['help_base_title'] = 'Chaves disponíveis para substituir no certificado:';

$string['help_certificate__name'] = 'Dados do usuário';
$string['help_certificate_name'] = 'Nome do certificado';
$string['help_certificate_description'] = 'Descrição do certificado';
$string['help_certificate_issue_timecreated'] = 'Data de criação do certificado.';
$string['help_certificate_issue_code'] = 'Código único do certificado.';
$string['help_certificate_issue_url'] = 'URL de validação do certificado';

// Dados do usuário.
$string['help_user__name'] = 'Dados do usuário';
$string['help_user_id'] = 'Identificador único para cada usuário.';
$string['help_user_username'] = 'Nome de usuário do usuário.';
$string['help_user_idnumber'] = 'Número de identificação do usuário.';
$string['help_user_firstname'] = 'Primeiro nome do usuário.';
$string['help_user_lastname'] = 'Sobrenome do usuário.';
$string['help_user_middlename'] = 'Nome do meio do usuário.';
$string['help_user_alternatename'] = 'Nome alternativo do usuário.';
$string['help_user_fullname'] = 'Nome completo do usuário, gerado pela função fullname().';
$string['help_user_email'] = 'Endereço de e-mail do usuário.';
$string['help_user_phone1'] = 'Número de telefone principal do usuário.';
$string['help_user_phone2'] = 'Número de telefone secundário do usuário.';
$string['help_user_institution'] = 'Instituição do usuário.';
$string['help_user_department'] = 'Departamento do usuário.';
$string['help_user_address'] = 'Endereço do usuário.';
$string['help_user_city'] = 'Cidade do usuário.';
$string['help_user_country'] = 'Código do país do usuário.';
$string['help_user_lang'] = 'Idioma preferido do usuário.';
$string['help_user_calendartype'] = 'Tipo de calendário preferido do usuário.';
$string['help_user_timezone'] = 'Fuso horário preferido do usuário.';
$string['help_user_firstaccess'] = 'Timestamp do primeiro acesso do usuário.';
$string['help_user_lastaccess'] = 'Timestamp do último acesso do usuário.';
$string['help_user_lastlogin'] = 'Timestamp do último login do usuário.';
$string['help_user_currentlogin'] = 'Timestamp do login atual do usuário.';
$string['help_user_lastip'] = 'Endereço IP do último acesso do usuário.';
$string['help_user_description'] = 'Descrição do usuário.';
$string['help_user_timecreated'] = 'Timestamp da criação da conta do usuário.';
$string['help_user_timemodified'] = 'Timestamp da última modificação na conta do usuário.';

$string['help_user_profile__name'] = 'Dados do perfil do usuário';

// Dados do curso.
$string['help_course__name'] = 'Dados do curso para o qual o certificado está sendo gerado';
$string['help_course_id'] = 'Identificador único para cada curso.';
$string['help_course_category'] = 'O identificador da categoria à qual o curso pertence.';
$string['help_course_fullname'] = 'O nome completo do curso.';
$string['help_course_shortname'] = 'Um nome curto ou código único para o curso.';
$string['help_course_summary'] = 'Um breve resumo ou descrição do curso.';
$string['help_course_startdate'] = 'A data de início do curso.';
$string['help_course_enddate'] = 'A data de término do curso.';
$string['help_course_lang'] = 'O idioma do curso.';

// Dados do site Moodle.
$string['help_site__name'] = 'Dados da instância Moodle para a qual o certificado está sendo gerado';
$string['help_site_fullname'] = 'O nome completo do Moodle.';
$string['help_site_shortname'] = 'Um nome curto para o Moodle.';
$string['help_site_summary'] = 'Um breve resumo ou descrição do Moodle.';

// Dados da categoria do curso.
$string['help_course_categories__name'] = 'Dados da categoria do curso para a qual o certificado está sendo gerado';
$string['help_course_categories_id'] = 'Identificador único da categoria do curso.';
$string['help_course_categories_name'] = 'Nome da categoria do curso.';
$string['help_course_categories_idnumber'] = 'Número de identificação único da categoria do curso.';
$string['help_course_categories_description'] = 'Descrição da categoria do curso.';
$string['help_course_categories_timemodified'] = 'Timestamp da última modificação na categoria do curso.';

// Dados da nota.
$string['help_grade__name'] = 'Nota do estudante no curso';
$string['help_grade_finalgrade'] = 'Nota final do estudante';
$string['help_grade_table'] = 'Tabela com as notas do estudante';

// Dados dos professores.
$string['help_teachers__name'] = 'Professores do curso';
$string['help_teachers_teacher1'] = 'Apenas o primeiro professor';
$string['help_teachers_teacher2'] = 'Apenas os dois primeiros professores';
$string['help_teachers_teacherall'] = 'Todos os professores';

// Dados das inscrições.
$string['help_enrolments__name'] = 'Dados da inscrição do estudante no curso';
$string['help_enrolments_timestart'] = 'Data da inscrição do usuário';

// Dados das funções.
$string['help_functions__name'] = 'Executar funções das seguintes funções nativas do Moodle e do PHP';
$string['help_functions_date'] = 'Função PHP <a href="https://php.net/date" target="_blank">date()</a>';
$string['help_functions_userdate'] = 'Função Moodle <a href="https://moodledev.io/docs/apis/subsystems/time" target="_blank">userdate()</a>';
$string['help_functions_time'] = 'Função PHP <a href="https://php.net/time" target="_blank">time()</a>';

// Editor de Certificado.
$string['grapsjs-assetmanager-addbutton'] = 'Adicionar imagem';
$string['grapsjs-assetmanager-modaltitle'] = 'Selecionar imagem';
$string['grapsjs-assetmanager-uploadtitle'] = 'Solte os arquivos aqui ou clique para enviar';
$string['grapsjs-domcomponents-names-'] = 'Box';
$string['grapsjs-domcomponents-names-wrapper'] = 'Corpo';
$string['grapsjs-domcomponents-names-text'] = 'Texto';
$string['grapsjs-domcomponents-names-comment'] = 'Comentário';
$string['grapsjs-domcomponents-names-image'] = 'Imagem';
$string['grapsjs-domcomponents-names-video'] = 'Vídeo';
$string['grapsjs-domcomponents-names-label'] = 'Label';
$string['grapsjs-domcomponents-names-link'] = 'Link';
$string['grapsjs-domcomponents-names-map'] = 'Mapa';
$string['grapsjs-domcomponents-names-tfoot'] = 'Rodapé da tabela';
$string['grapsjs-domcomponents-names-tbody'] = 'Corpo da tabela';
$string['grapsjs-domcomponents-names-thead'] = 'Cabeçalho da tabela';
$string['grapsjs-domcomponents-names-table'] = 'Tabela';
$string['grapsjs-domcomponents-names-row'] = 'Linha da tabela';
$string['grapsjs-domcomponents-names-cell'] = 'Célula da tabela';
$string['grapsjs-domcomponents-names-section'] = 'Seção';
$string['grapsjs-domcomponents-names-body'] = 'Corpo';
$string['grapsjs-devicemanager-device'] = 'Dispositivo';
$string['grapsjs-devicemanager-devices-desktop'] = 'Desktop';
$string['grapsjs-devicemanager-devices-tablet'] = 'Tablet';
$string['grapsjs-devicemanager-devices-mobilelandscape'] = 'Celular, modo panorâmico';
$string['grapsjs-devicemanager-devices-mobileportrait'] = 'Celular, modo retrato';
$string['grapsjs-panels-buttons-titles-preview'] = 'Pré-visualização';
$string['grapsjs-panels-buttons-titles-fullscreen'] = 'Tela cheia';
$string['grapsjs-panels-buttons-titles-sw-visibility'] = 'Ver componentes';
$string['grapsjs-panels-buttons-titles-export-template'] = 'Ver código';
$string['grapsjs-panels-buttons-titles-open-sm'] = 'Abrir gerenciador de estilos';
$string['grapsjs-panels-buttons-titles-open-tm'] = 'Configurações';
$string['grapsjs-panels-buttons-titles-open-layers'] = 'Abrir gerenciador de camadas';
$string['grapsjs-panels-buttons-titles-open-blocks'] = 'Abrir blocos';
$string['grapsjs-selectormanager-label'] = 'Classes';
$string['grapsjs-selectormanager-selected'] = 'Selecionado';
$string['grapsjs-selectormanager-emptystate'] = '- Estado -';
$string['grapsjs-selectormanager-states-hover'] = 'Hover';
$string['grapsjs-selectormanager-states-active'] = 'Click';
$string['grapsjs-selectormanager-states-nth-of-type-2n'] = 'Even/Odd';
$string['grapsjs-stylemanager-empty'] = 'Selecione um elemento para usar o gerenciador de estilos';
$string['grapsjs-stylemanager-layer'] = 'Camada';
$string['grapsjs-stylemanager-filebutton'] = 'Imagens';
$string['grapsjs-stylemanager-sectors-general'] = 'Geral';
$string['grapsjs-stylemanager-sectors-layout'] = 'Disposição';
$string['grapsjs-stylemanager-sectors-typography'] = 'Tipografia';
$string['grapsjs-stylemanager-sectors-decorations'] = 'Decorações';
$string['grapsjs-stylemanager-sectors-extra'] = 'Extra';
$string['grapsjs-stylemanager-sectors-flex'] = 'Flex';
$string['grapsjs-stylemanager-sectors-dimension'] = 'Dimensão';
$string['grapsjs-stylemanager-properties-float'] = 'Float';
$string['grapsjs-stylemanager-properties-display'] = 'Exibição';
$string['grapsjs-stylemanager-properties-position'] = 'Posição';
$string['grapsjs-stylemanager-properties-top'] = 'Topo';
$string['grapsjs-stylemanager-properties-right'] = 'Direita';
$string['grapsjs-stylemanager-properties-left'] = 'Esquerda';
$string['grapsjs-stylemanager-properties-bottom'] = 'Inferior';
$string['grapsjs-stylemanager-properties-width'] = 'Largura';
$string['grapsjs-stylemanager-properties-height'] = 'Altura';
$string['grapsjs-stylemanager-properties-max-width'] = 'Largura Max.';
$string['grapsjs-stylemanager-properties-max-height'] = 'Altura Max.';
$string['grapsjs-stylemanager-properties-margin'] = 'Margem';
$string['grapsjs-stylemanager-properties-margin-top'] = 'Margem Superior';
$string['grapsjs-stylemanager-properties-margin-right'] = 'Margem a Direita';
$string['grapsjs-stylemanager-properties-margin-left'] = 'Margem a Esquerda';
$string['grapsjs-stylemanager-properties-margin-bottom'] = 'Margem Inferior';
$string['grapsjs-stylemanager-properties-padding'] = 'Padding';
$string['grapsjs-stylemanager-properties-padding-top'] = 'Padding Superior';
$string['grapsjs-stylemanager-properties-padding-left'] = 'Padding a Esquerda';
$string['grapsjs-stylemanager-properties-padding-right'] = 'Padding a Direita';
$string['grapsjs-stylemanager-properties-padding-bottom'] = 'Padding Inferior';
$string['grapsjs-stylemanager-properties-font-family'] = 'Font Family';
$string['grapsjs-stylemanager-properties-font-size'] = 'Tamanho da fonte';
$string['grapsjs-stylemanager-properties-font-weight'] = 'Espessura da fonte';
$string['grapsjs-stylemanager-properties-letter-spacing'] = 'Espaço entre letras';
$string['grapsjs-stylemanager-properties-color'] = 'Cor';
$string['grapsjs-stylemanager-properties-line-height'] = 'Altura da linha';
$string['grapsjs-stylemanager-properties-text-align'] = 'Alinhamento do texto';
$string['grapsjs-stylemanager-properties-text-shadow'] = 'Sombra do texto';
$string['grapsjs-stylemanager-properties-text-shadow-h'] = 'Sombra do texto: horizontal';
$string['grapsjs-stylemanager-properties-text-shadow-v'] = 'Sombra do texto: vertical';
$string['grapsjs-stylemanager-properties-text-shadow-blur'] = 'Desfoque da sombra do texto';
$string['grapsjs-stylemanager-properties-text-shadow-color'] = 'Cor da sombra da fonte';
$string['grapsjs-stylemanager-properties-border-top-left'] = 'Borda superior a esquerda';
$string['grapsjs-stylemanager-properties-border-top-right'] = 'Borda superior a direita';
$string['grapsjs-stylemanager-properties-border-bottom-left'] = 'Borda inferior a esquerda';
$string['grapsjs-stylemanager-properties-border-bottom-right'] = 'Borda inferior a direita';
$string['grapsjs-stylemanager-properties-border-radius-top-left'] = 'Raio da borda superior esquerda';
$string['grapsjs-stylemanager-properties-border-radius-top-right'] = 'Raio da borda superior direita';
$string['grapsjs-stylemanager-properties-border-radius-bottom-left'] = 'Raio da borda inferior esquerda';
$string['grapsjs-stylemanager-properties-border-radius-bottom-right'] = 'Raio da borda inferior direita';
$string['grapsjs-stylemanager-properties-border-radius'] = 'Raio da borda';
$string['grapsjs-stylemanager-properties-border'] = 'Borda';
$string['grapsjs-stylemanager-properties-border-width'] = 'Largura da borda';
$string['grapsjs-stylemanager-properties-border-style'] = 'Estilo da borda';
$string['grapsjs-stylemanager-properties-border-color'] = 'Cor da borda';
$string['grapsjs-stylemanager-properties-box-shadow'] = 'Sombra da box';
$string['grapsjs-stylemanager-properties-box-shadow-h'] = 'Sombra da box: horizontal';
$string['grapsjs-stylemanager-properties-box-shadow-v'] = 'Sombra da box: vertical';
$string['grapsjs-stylemanager-properties-box-shadow-blur'] = 'Desfoque da sombra da box';
$string['grapsjs-stylemanager-properties-box-shadow-spread'] = 'Extensão da sombra da box';
$string['grapsjs-stylemanager-properties-box-shadow-color'] = 'Cor da sombra da box';
$string['grapsjs-stylemanager-properties-box-shadow-type'] = 'Tipo de sombra da box';
$string['grapsjs-stylemanager-properties-background'] = 'Fundo';
$string['grapsjs-stylemanager-properties-background-color'] = 'Cor de fundo';
$string['grapsjs-stylemanager-properties-background-image'] = 'Imagem de fundo';
$string['grapsjs-stylemanager-properties-background-repeat'] = 'Repetir fundo';
$string['grapsjs-stylemanager-properties-background-position'] = 'Posição do fundo';
$string['grapsjs-stylemanager-properties-background-attachment'] = 'Plugin de fundo';
$string['grapsjs-stylemanager-properties-background-size'] = 'Tamanho do fundo';
$string['grapsjs-stylemanager-properties-transition'] = 'Transição';
$string['grapsjs-stylemanager-properties-transition-property'] = 'Tipo de transição';
$string['grapsjs-stylemanager-properties-transition-duration'] = 'Tempo de transição';
$string['grapsjs-stylemanager-properties-transition-timing-function'] = 'Função do tempo da transição';
$string['grapsjs-stylemanager-properties-perspective'] = 'Perspectiva';
$string['grapsjs-stylemanager-properties-transform'] = 'Transformação';
$string['grapsjs-stylemanager-properties-transform-rotate-x'] = 'Rotacionar horizontalmente';
$string['grapsjs-stylemanager-properties-transform-rotate-y'] = 'Rotacionar verticalmente';
$string['grapsjs-stylemanager-properties-transform-rotate-z'] = 'Rotacionar profundidade';
$string['grapsjs-stylemanager-properties-transform-scale-x'] = 'Escalar horizontalmente';
$string['grapsjs-stylemanager-properties-transform-scale-y'] = 'Escalar verticalmente';
$string['grapsjs-stylemanager-properties-transform-scale-z'] = 'Escalar profundidade';
$string['grapsjs-stylemanager-properties-flex-direction'] = 'Direção Flex';
$string['grapsjs-stylemanager-properties-flex-wrap'] = 'Flex wrap';
$string['grapsjs-stylemanager-properties-justify-content'] = 'Ajustar conteúdo';
$string['grapsjs-stylemanager-properties-align-items'] = 'Alinhar elementos';
$string['grapsjs-stylemanager-properties-align-content'] = 'Alinhar conteúdo';
$string['grapsjs-stylemanager-properties-order'] = 'Ordem';
$string['grapsjs-stylemanager-properties-flex-basis'] = 'Base Flex';
$string['grapsjs-stylemanager-properties-flex-grow'] = 'Crescimento Flex';
$string['grapsjs-stylemanager-properties-flex-shrink'] = 'Contração Flex';
$string['grapsjs-stylemanager-properties-align-self'] = 'Alinhar-se';
$string['grapsjs-traitmanager-empty'] = 'Selecione um elemento para usar o gerenciador de características';
$string['grapsjs-traitmanager-label'] = 'Configurações do componente';
$string['grapsjs-traitmanager-traits-options-target-false'] = 'Esta janela';
$string['grapsjs-traitmanager-traits-options-target-_blank'] = 'Nova janela';
$string['grapsjs-general'] = 'Gerais';
$string['grapsjs-dimensions'] = 'Dimensões';
$string['grapsjs-width'] = 'Largura';
$string['grapsjs-tipografia'] = 'Tipografia';
$string['grapsjs-decoration'] = 'Decorações';
$string['grapsjs-edit_code'] = 'Editar código';
$string['grapsjs-edit_code_paste_here_html'] = 'Cole aqui seu HTML/CSS e clique em Importar';
$string['grapsjs-repeat'] = 'Repetir';
$string['grapsjs-position'] = 'Posição';
$string['grapsjs-attachment'] = 'Anexo';
$string['grapsjs-size'] = 'Tamanho';
$string['grapsjs-certificate_page_save'] = 'Salvar página do certificado';
$string['grapsjs-certificate_page_test'] = 'Test PDF';
$string['grapsjs-show_border'] = 'Mostrar Bordas';
$string['grapsjs-preview'] = 'Prévia';
$string['grapsjs-fullscreen'] = 'Tela Cheia';
$string['grapsjs-undo'] = 'Desfazer';
$string['grapsjs-redo'] = 'Refazer';
$string['grapsjs-clear'] = 'Limpar o canvas';
$string['grapsjs-certificate_confirm_clear'] = 'Tem certeza de limpar o canvas?';
$string['grapsjs-open_sm'] = 'Gerenciador de Estilos';
$string['grapsjs-open_layers'] = 'Camadas';
$string['grapsjs-open_block'] = 'Blocos';
$string['grapsjs-settings'] = 'Configurações';
