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
$string['modulenameplural'] = 'Beautiful certificates';
$string['pluginadministration'] = 'Administração de certificado de curso';

$string['select_a_model'] = 'Selecione um modelo';
$string['select_the_model'] = 'Selecione o modelo';
$string['manage_models'] = 'Gerenciar modelos de certificado';
$string['list_model'] = 'Lista de modelos';
$string['add_new_model'] = 'Adicionar novo modelo';
$string['save_model'] = 'Salvar modelo';
$string['create_model'] = 'Criar modelo';
$string['new_model'] = 'Novo Modelo';
$string['model_name'] = 'Nome do modelo';
$string['model_name_missing'] = 'Nome do modelo é obrigatório';
$string['model_page_name'] = 'Página: {$a}';
$string['edit_this_page'] = 'Editar esta página do certificado';
$string['edit_page'] = 'Editar página do certificado';
$string['using_this_page'] = 'Usar esta página';
$string['add_new_page'] = 'Adicionar uma nova página ao certificado';
$string['pages_certificate'] = 'Páginas do certificado';
$string['create_after_model'] = 'Primeiro salve o modelo antes de adicionar páginas ao certificado';
$string['select_model'] = 'Selecionar Modelo';
$string['select_model_preview'] = 'Selecionar um modelo pré-existente';
$string['report'] = 'Ver certificados gerados';
$string['download_my_certificate'] = 'Baixar meu certificado';
$string['view_my_certificate'] = 'Ver meu certificado em nova aba';
$string['preview_certificate'] = 'Pré-visualização do certificado';
$string['create_at_certificate'] = 'Certificado para {$a}';

$string['course_certificates'] = 'Certificados do curso';
$string['my_certificates'] = 'Meus Certificados';
$string['from_certificates'] = 'Certificados do aluno {$a}';

// Validate certificate.
$string['validate_certificate_title'] = 'Verifique a autenticidade do certificado';
$string['validate_certificate_notfound'] = 'Código de autenticidade não localizado!';
$string['validate_certificate_code'] = 'Código de autenticidade';
$string['validate_certificate_submit'] = 'Validar código';
$string['validate_certificate_date'] = 'Emitido na data de';
$string['validate_certificate_user'] = 'Emitido para';
$string['validate_certificate_name'] = 'Nome do Certificado';
$string['validate_certificate_course'] = 'Curso do Certificado';

// Report.
$string['report_filename'] = 'Certificados gerados pelos alunos';
$string['report_usernome'] = 'Nome do aluno';
$string['report_useremail'] = 'E-mail do aluno';
$string['report_code'] = 'Código do certificado';
$string['report_timecreated'] = 'Criado em';
$string['report_view_certificate'] = 'Visualizar';
$string['report_delete_certificate'] = 'Excluir';
$string['report_confirm_delete_certificate'] = 'Tem certeza que deseja excluir este certificado?';
$string['report_deleted_certificate'] = 'Certificado excluído com sucesso!';

// Install.
$string['certificate-appreciation'] = 'Certificado de Apreciação';
$string['certificate-elegant'] = 'Certificado Elegante';
$string['certificate-modern'] = 'Certificado Moderno';
$string['certificate-simple'] = 'Certificado Simples';
$string['certificate-vintage'] = 'Certificado Vintage';
$string['certificate-golden'] = 'Certificado Dourado';
$string['sumary-secound-page'] = 'Certificado Sumário';

// Modelo de certificado.
$string['certtitle'] = 'Certificado';
$string['certificado-subtitulo'] = 'DE CONCLUSÃO';
$string['certpresented'] = 'Este certificado é orgulhosamente apresentado a';
$string['certdate'] = 'Data';
$string['certsignature'] = 'Diretor';
$string['certificado-melhor'] = 'Melhor';
$string['certificado-curso'] = 'Curso';
$string['certificado-descricao'] = 'Este certificado atesta que o aluno <strong>{$USER->fullname}</strong> completou o <strong>{$course->fullname}</strong> com distinção, consolidando um conjunto abrangente de conhecimentos e habilidades essenciais para sobressair-se em ambientes dinâmicos.';
$string['certificado-sumary'] = 'Sumário';
$string['certificate_page_empty'] = 'Vazio';

$string['help_certificate__name'] = 'Dados do usuário';
$string['help_certificate_name'] = 'Nome do certificado';
$string['help_certificate_issue_timecreated'] = 'Data da criação do certificado.';
$string['help_certificate_issue_code'] = 'Código único do certificado.';
$string['help_certificate_issue_url'] = 'URL de validação do certificado';

$string['help_user__name'] = 'Dados do usuário';
$string['help_user_id'] = 'Identificador único para cada usuário.';
$string['help_user_username'] = 'Nome de usuário do usuário.';
$string['help_user_idnumber'] = 'Número de identificação do usuário.';
$string['help_user_firstname'] = 'Primeiro nome do usuário.';
$string['help_user_lastname'] = 'Sobrenome do usuário.';
$string['help_user_middlename'] = 'Nome do meio do usuário.';
$string['help_user_alternatename'] = 'Nome alternativo do usuário.';
$string['help_user_fullname'] = 'Nome completo do usuário, formado pela função fullname().';
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
$string['help_user_firstaccess'] = 'Carimbo de data/hora do primeiro acesso do usuário.';
$string['help_user_lastaccess'] = 'Carimbo de data/hora do último acesso do usuário.';
$string['help_user_lastlogin'] = 'Carimbo de data/hora do último login do usuário.';
$string['help_user_currentlogin'] = 'Carimbo de data/hora do login atual do usuário.';
$string['help_user_lastip'] = 'Endereço IP do último acesso do usuário.';
$string['help_user_description'] = 'Descrição do usuário.';
$string['help_user_timecreated'] = 'Carimbo de data/hora da criação da conta do usuário.';
$string['help_user_timemodified'] = 'Carimbo de data/hora da última modificação na conta do usuário.';

$string['help_user_profile__name'] = 'Dados do perfil do usuário';

$string['help_course__name'] = 'Dados do curso que está sendo gerado o certificado';
$string['help_course_id'] = 'Um identificador exclusivo para cada curso.';
$string['help_course_category'] = 'O identificador da categoria à qual o curso pertence.';
$string['help_course_fullname'] = 'O nome completo do curso.';
$string['help_course_shortname'] = 'Um nome curto ou código exclusivo para o curso.';
$string['help_course_summary'] = 'Um resumo ou descrição breve do curso.';
$string['help_course_startdate'] = 'A data de início do curso.';
$string['help_course_enddate'] = 'A data de término do curso.';
$string['help_course_lang'] = 'O idioma do curso.';

$string['help_site__name'] = 'Dados do Moodle que está sendo gerado o certificado';
$string['help_site_fullname'] = 'O nome completo do Moodle.';
$string['help_site_shortname'] = 'Um nome curto do Moodle.';
$string['help_site_summary'] = 'Um resumo ou descrição breve do Moodle.';

$string['help_course_categories__name'] = 'Dados da categoria do curso que está sendo gerado o certificado';
$string['help_course_categories_id'] = 'Identificador único da categoria de curso.';
$string['help_course_categories_name'] = 'Nome da categoria de curso.';
$string['help_course_categories_idnumber'] = 'Número de identificação único da categoria de curso.';
$string['help_course_categories_description'] = 'Descrição da categoria de curso.';
$string['help_course_categories_timemodified'] = 'Timestamp da última modificação na categoria de curso.';

$string['help_grade__name'] = 'Nota do aluno no curso';
$string['help_grade_finalgrade'] = 'Nota final do aluno';
$string['help_grade_table'] = 'Tabela com as notas do aluno';

$string['help_teachers__name'] = 'Professores do curso';
$string['help_teachers_teacher1'] = 'Somente o primeiro professor';
$string['help_teachers_teacher2'] = 'Somente os dois primeiros professores';
$string['help_teachers_teacherall'] = 'Todos os professores';

$string['help_enrolments__name'] = 'Dados da matrícula do aluno no curso';
$string['help_enrolments_timestart'] = 'Data da matrícula do usuário';

$string['help_functions__name'] = 'Executa funções as seguintes funções nativas do Moodle e do PHP';
$string['help_functions_date'] = 'Função <a href="https://php.net/date" target="_blank">date()</a> do PHP';
$string['help_functions_userdate'] = 'Função <a href="https://moodledev.io/docs/apis/subsystems/time" target="_blank">userdate()</a> do Moodle';
$string['help_functions_time'] = 'Função <a href="https://php.net/time" target="_blank">time()</a> do PHP';

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
