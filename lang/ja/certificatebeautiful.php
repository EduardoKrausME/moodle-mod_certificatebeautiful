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
 * Lang ja file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['add_new_model'] = '新しいモデルを追加';
$string['add_new_page'] = '証明書に新しいページを追加';
$string['autogenerate'] = '証明書を自動生成する';
$string['autogenerate_help'] = '有効にすると、スケジュールタスクが証明書の発行記録とPDFファイルを自動的に作成します。';
$string['autogenerate_task_name'] = 'Beautiful Certificate の自動生成';
$string['autotrigger'] = '自動生成のトリガー';
$string['autotrigger_activity'] = '完了トリガーに必要な活動';
$string['autotrigger_activitycompletion'] = '活動完了';
$string['autotrigger_coursecompletion'] = 'コース完了';
$string['autotrigger_gradethreshold'] = 'コースの最低最終評点';
$string['autotrigger_required'] = '自動生成のトリガーを選択する必要があります。';
$string['best'] = '最適';
$string['certdate'] = '日付';
$string['certificate-appreciation'] = '感謝状';
$string['certificate-details'] = '証明書の詳細';
$string['certificate-elegant'] = 'エレガント証明書';
$string['certificate-flat-modern'] = 'モダンフラット証明書';
$string['certificate-golden'] = 'ゴールド証明書';
$string['certificate-gradient-golden-luxury'] = 'ラグジュアリー・ゴールドグラデーション証明書';
$string['certificate-kids-animals'] = '動物入りの子ども向け';
$string['certificate-kids-child-medical'] = '子ども向け医療証明書';
$string['certificate-kids-gradient-modern'] = '子ども向けモダングラデーション証明書テンプレート';
$string['certificate-kids-hand-drawn'] = '手描きの幼児向け証明書';
$string['certificate-kids-pastel'] = 'かわいいパステル調の教育証明書';
$string['certificate-modern'] = 'モダン証明書';
$string['certificate-modern-2'] = 'モダン証明書 2';
$string['certificate-simple'] = 'シンプル証明書';
$string['certificate-vintage'] = 'ヴィンテージ証明書';
$string['certificate_description'] = '証明書を説明する';
$string['certificate_description_help'] = '証明書の説明文です。&lt;b&gt;、&lt;i&gt;、&lt;u&gt;、色指定などの簡単なHTMLを使用できますが、<a href="https://mpdf.github.io/" target="_blank">PDFコンバーターには制限があります</a>ので注意してください。';
$string['certificate_not_issued'] = 'あなたの証明書はまだ発行されていません。';
$string['certificatebeautiful-page_empty'] = '空';
$string['certificatebeautiful:addinstance'] = 'インスタンスを追加';
$string['certificatebeautiful:delete'] = '証明書インスタンスを削除';
$string['certificatebeautiful:view'] = 'ユーザーに Beautiful Certificate の閲覧を許可する';
$string['certificatebeautiful:viewreport'] = 'Beautiful Certificate のレポートを表示する';
$string['certpresented'] = 'この証明書をここに授与します';
$string['certsignature'] = '責任者';
$string['certtitle'] = '証明書';
$string['config_data_protect'] = '個人データ保護';
$string['config_data_protect_admins_only'] = '管理者のみに表示';
$string['config_data_protect_desc'] = '証明書検証画面で個人データを匿名化する場合にチェックします';
$string['config_data_protect_email_anonimized'] = '氏名を表示し、メールアドレスを匿名化';
$string['config_data_protect_hidden'] = '全員に対して非表示';
$string['config_data_protect_name_visible'] = '氏名のみ表示';
$string['config_signature_color'] = '署名線の色';
$string['config_signature_color_desc'] = '署名用の線の色を選択します。';
$string['config_signature_enable'] = '動的署名を有効にする';
$string['config_signature_enable_desc'] = 'チェックすると、Beautiful Certificate は選択した手書き書体、指定したテキスト、色に基づいてカスタム署名を作成します。';
$string['config_signature_heading'] = '署名設定';
$string['config_signature_heading_desc'] = 'ここでは、あらかじめ読み込まれている {$a} 種類の書体からカスタム署名を作成するかどうかを選択します。利用できるオプションは次のとおりです:';
$string['config_signature_text'] = '署名テキスト';
$string['config_signature_text_desc'] = 'Beautiful Certificate による署名の自動生成を有効にするには、最大10文字の文字列を入力する必要があります。空白、数字、アクセント記号を含めないでください。5～7文字の文字列にすると、見た目の整った署名になりやすくなります。';
$string['config_signature_typography'] = '署名テキストのスタイル';
$string['config_signature_typography_desc'] = 'デフォルトでは、Beautiful Certificate は以下のテキストを使用して署名を生成し、この書体を使って内容をカスタマイズします。';
$string['course'] = 'コース';
$string['course_certificates'] = 'コース証明書';
$string['create_after_model'] = '証明書にページを追加する前に、まずモデルを保存してください';
$string['create_at_certificate'] = '{$a} の証明書';
$string['create_model'] = 'モデルを作成';
$string['default-description'] = 'この証明書は、コース <b>{\\$COURSE->fullname}</b> を優秀な成績で修了し、変化の大きい環境で活躍するために必要な幅広い知識と重要なスキルを身につけたことを証明するものです。';
$string['delete-page'] = '証明書からこのページを削除';
$string['deletedmodel'] = 'モデル「{$a}」を正常に削除しました。';
$string['deletemodelconfirm'] = 'モデル <strong>{$a}</strong> を本当に削除しますか？';
$string['download_my_certificate'] = '自分の証明書をダウンロード';
$string['edit_page'] = '証明書ページを編集';
$string['edit_page_instruction'] = '<p>証明書は <a target="_blank" href="https://github.com/GrapesJS/grapesjs">GrapesJS</a> をエディタとして使用して作成されます。エディタは <a target="_blank" href="https://github.com/GrapesJS/grapesjs/issues/1936">dragMode:\'absolute\'</a> に設定されており、エディタ内でコンポーネントをドラッグ＆ドロップできます。編集後に「<strong>PDFをテスト</strong>」をクリックして結果をプレビューし、完了したら「<strong>証明書ページを保存</strong>」ボタンを使用して生成した証明書を保存してください。</p><p><a target="_blank" href="https://mpdf.github.io/">mPDF</a> の制限により、絶対配置を利用できるのは証明書のルートにある要素だけです。そのため、最終PDFの不整合を防ぐために、ルートDIV内のその他のコンポーネントは移動を制限しています。mPDF が絶対配置をサポートするのは <code>&lt;div&gt;</code> 要素のみです。カスタムコードを使用して新しいコンポーネントを挿入する場合は、必ず <code>&lt;div&gt;</code> から始めてください。</p><p>エディタの下には、証明書をカスタマイズするために追加できるキーが表示されます。QRCodeについては、<code>qr-code.svg</code> 画像がプラグインによって生成されたQRCodeに置き換えられます。そのため、この画像を編集すると機能が損なわれる可能性があります。システムが生成する署名は、プロジェクト内の <code>signature.png</code> 画像を置き換えます。証明書に独自の画像を使用した場合、プラグインは自動的に置き換えを行いません。</p>';
$string['edit_signature_certificate'] = 'ここで証明書の署名をカスタマイズ';
$string['edit_this_page'] = 'この証明書ページを編集';
$string['from_certificates'] = '受講者 {$a} の証明書';
$string['gradepass'] = 'コースの最低最終評点';
$string['gradepass_required'] = 'コースの最低最終評点を数値で指定する必要があります。';
$string['help_base_title'] = '証明書内で置換できるキー:';
$string['list_model'] = 'モデル一覧';
$string['manage_models'] = '証明書モデルを管理';
$string['model_name'] = 'モデル名';
$string['model_name_missing'] = 'モデル名は必須です';
$string['model_orientation'] = '向き';
$string['model_orientation_l'] = '横向き';
$string['model_orientation_p'] = '縦向き';
$string['model_page_name'] = 'ページ: {$a}';
$string['modulename'] = 'Beautiful Certificate';
$string['modulenameplural'] = 'Beautiful Certificates';
$string['my_certificates'] = '自分の証明書';
$string['new_model'] = '新しいモデル';
$string['notification_body'] = 'こんにちは {$a->fullname} さん。<br><br>コース <strong>{$a->coursename}</strong> の証明書 <strong>{$a->certificatename}</strong> が利用できるようになりました。<br><br>こちらからアクセスできます: <a href="{$a->url}">{$a->url}</a>';
$string['notification_subject'] = '証明書が利用可能になりました: {$a->certificatename}';
$string['notifyuser'] = '証明書が発行されたときにメール通知を送信する';
$string['only_format'] = '{$a} 形式のみ表示';
$string['pages_certificate'] = '証明書ページ';
$string['pluginadministration'] = 'コース証明書管理';
$string['pluginname'] = 'Beautiful Certificate';
$string['preview_certificate'] = '証明書プレビュー';
$string['privacy:metadata:certificatebeautiful_issue'] = 'ユーザーに発行された証明書に関する情報。';
$string['privacy:metadata:certificatebeautiful_issue:userid'] = '証明書を受け取ったユーザーのIDを保存します。';
$string['report'] = '生成済み証明書を表示';
$string['report_code'] = '証明書コード';
$string['report_confirm_delete_certificate'] = 'この証明書を削除してもよろしいですか？';
$string['report_create_certificate'] = '証明書を作成';
$string['report_delete_certificate'] = '削除';
$string['report_deleted_certificate'] = '証明書を正常に削除しました！';
$string['report_filename'] = '受講者が生成した証明書';
$string['report_finalgrade'] = 'コース最終評点';
$string['report_timecreated'] = '作成日時';
$string['report_title'] = 'レポート';
$string['report_useremail'] = '受講者のメールアドレス';
$string['report_usernome'] = '受講者名';
$string['report_view_certificate'] = '表示';
$string['save_model'] = 'モデルを保存';
$string['select_a_model'] = 'モデルを選択';
$string['select_background_image'] = '証明書の新しい背景画像を選択';
$string['select_background_image_info2'] = '<div class="alert alert-warning">
<p>証明書の背景を置き換える新しい画像をアップロードしてください。</p>
<p>証明書は <strong>{$a->orientation}</strong> 形式です。画像サイズは <strong>{$a->size} ピクセル</strong>、実寸では <strong>{$a->sizecm} cm</strong> にしてください。変形やピクセル化を防ぐため、この比率を維持してください。</p>
</div>';
$string['select_background_preview'] = '証明書の背景画像を変更';
$string['select_model'] = 'このモデルを表示';
$string['select_model_preview'] = '既存のテンプレートを選択して、このページのデザインを更新';
$string['select_the_model'] = 'モデルを選択';
$string['subplugintype_certificatebeautifuldatainfo'] = 'Beautiful Certificate のサブプラグイン';
$string['subplugintype_certificatebeautifuldatainfo_plural'] = 'Beautiful Certificate のデータサブプラグイン';
$string['subtititle'] = '修了';
$string['sumary'] = '概要';
$string['sumary-secound-page'] = '概要証明書';
$string['sumary-secound-page2'] = 'コースセクションとモジュールの一覧';
$string['triggercmid_required'] = '活動完了トリガーに使用する活動を選択する必要があります。';
$string['using_this_page'] = 'このテンプレートを使用';
$string['validate_certificate_code'] = '真正性コード';
$string['validate_certificate_course'] = '証明書のコース';
$string['validate_certificate_date'] = '発行日';
$string['validate_certificate_name'] = '証明書名';
$string['validate_certificate_notfound'] = '真正性コードが見つかりません！';
$string['validate_certificate_submit'] = 'コードを検証';
$string['validate_certificate_title'] = '証明書の真正性を確認';
$string['validate_certificate_user'] = '発行対象';
$string['validate_certificate_validate'] = '検証';
$string['view_my_certificate'] = '自分の証明書を新しいタブで表示';
