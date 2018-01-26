<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="/libs_v2/js/jquery-ui-1.10.3.js"></script>
<script type="text/javascript" src="/libs_v2/js/selectToUISlider.jQuery.js"></script>

<link rel="stylesheet" href="/libs_v2/css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" />
<link rel="Stylesheet" href="/libs_v2/css/ui.slider.extras.css" type="text/css" />

<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "includes/conf.php");
require_once($main_root . "_libs/main.php");

if (in_array($ID_SITE, array(109, 130, 134, 136, 145))) {
    $slider_color = "#DE6013";
    $price_cadre_color = "#f9e5d8";
} else {
    $slider_color = "#05478d";
    $price_cadre_color = "#d5e2fa";
}

if (in_array($ID_SITE, array(109, 130, 134, 136, 145))) {
    $background_color = "#F3C4A8";
    $border = "none";
} else {
    $background_color = "#FFFFFF";
    $border = "2px solid #05478d";
}
?>

<style type="text/css">
    #modele #tarif {
        height: auto;
    }

    #leasing_form {
        clear: both;
        margin: 10px 0 0 20px;
        width: 360px;
        float: left;
    }

    #leasing_form fieldset {
        border: 0 none;
    }

    #leasing_form fieldset.slider_fieldset {
        height: 80px;
        margin-left: 0;
        padding-left: 20px;
        width: 320px;
    }

    #leasing_form label {
        color: #5A5E61;
        font-size: 14px;
        font-weight: 700;
        line-height: 18px;
        margin-left: -20px;
    }

    #leasing_form .ui-slider li span.ui-slider-label-show, .ui-slider dd span.ui-slider-label-show {
        font-size: 12px;
    }

    #leasing_form select {margin-right: 1em; float: left;}

    #leasing_form .ui-slider {
        clear: both;
        top: 10px;
    }

    #leasing_form .ui-state-default, .ui-widget-content .ui-state-default {
        background: url("/images_local/slider-bouton.png") no-repeat scroll 50% 50% rgba(0, 0, 0, 0);
        border: medium none;
    }

    #leasing_form .ui-slider-horizontal .ui-slider-handle {
        margin-left: -15px;
        top: -2px;
    }

    #leasing_form .ui-slider .ui-slider-handle {
        cursor: pointer;
        height: 30px;
        position: absolute;
        width: 30px;
        z-index: 2;
    }

    #leasing_form .ui-slider-horizontal {
        height: 1.8em;
    }

    #leasing_form .ui-slider ol, .ui-slider dl {
        position: relative;
        top: 15px;
        width: 100%;
    }

    #leasing_form .ui-widget-content {
        border: none;
        background: url("/images_local/slider-background.png") no-repeat scroll 50% 50% rgba(0, 0, 0, 0);
    }

    #leasing_form .ui-slider-horizontal {
        height: 26px;
    }

    #leasing_form .ui-widget-header {
        background-color: #de6013;
    }

    #leasing_form .ui-slider li span.ui-widget-content, .ui-slider dd span.ui-widget-content {
        border-color: <?php echo $slider_color; ?>;
        border-left: 2px solid <?php echo $slider_color; ?>;
        border-right: 0 none <?php echo $slider_color; ?>;
        border-style: none none none solid;
        border-width: 0 0 0 2px;
    }

    #leasing_form .ui-slider span.ui-slider-tic {
        height: 8px;
        left: 0;
        position: absolute;
        top: -9px;
    }

    #leasing_form .ui-helper-reset {
        font-size: 100%;
        line-height: 18px;
        list-style: none outside none;
    }

    #leasing_form fieldset input#apport_prix_input {
        border: 1px solid #000000;
        /*float: right;*/
        padding: 2px;
        text-align: right;
        width: 70px;
        margin-left: 20px;
    }

    #leasing_form fieldset .slider_apport_input {

    }

    #leasing_infos {
        color: #5A5E61;
        font-size: 14px;
        padding: 0px 20px;
        width: 525px;
        float: left;
    }

    #leasing_infos table.popup_financement_1 table td {
        padding: 5px 10px 5px 10px;
    }

    #leasing_infos .price_cadre {
        padding: 2px 10px 2px 10px;
        background-color: <?php echo $price_cadre_color; ?>;
        border: 1px solid #76655b;
    }

    .promo_speciale {
        color: #5a5e61;
        font-size: 14px;
        font-weight: bold;
        line-height: 18px;
        text-align: center;
    }
    #apport_prix_input{
        font-size: 13px;
        color: #5a5e61;
        text-align: right;
        margin-left:30px;
    }
    #sigle_apport_input{
        color: #5A5E61;
        font-size: 14px;
        font-weight: 700;
        line-height: 18px;
    }
</style>

<div style="width:950px">
    <form id="leasing_form" action="#">
        <h2>Location</h2>
        <fieldset class="slider_fieldset">
            <label for="duree_input">Duree (mois)</label>
            <select name="duree_input" id="duree_input"></select>
        </fieldset>
        <fieldset class="slider_fieldset">
            <label for="kilometrage_input">Kilom&eacute;trage total *</label>
            <select name="kilometrage_input" id="kilometrage_input"></select>
        </fieldset>
        <fieldset class="slider_fieldset">
            <label for="apport_input">Apport</label>
            <input type="text" name="apport_prix_input" id="apport_prix_input" value="0" size="6"><span id="sigle_apport_input"> &euro;</span>
            <br /><span id="sigle_apport_input_max" style="font-size:10px;margin-left: -20px;"></span>
        </fieldset>
    </form>
    <div id="leasing_infos">
        <div style='float: left; width: 60px; margin-top: 105px;'><img src='../images_local/fleche_droite.png' /></div>
        <div style='float: left; width: 450px;'>
            <center>
                <h2>Votre simulation de location</h2>
            </center>
            <center>
                <h4><span class="leasing_month"></span> mois pour <span class="leasing_km"></span> km max</h4>
            </center>
            <table border='0' width='100%' cellpadding='0' cellspacing='0' class='popup_financement_1'>
                <tr>
                    <td valign='top'>
                        <table cellpadding='2' cellspacing='0' style='width:100%; border:"<?php echo $border; ?>"; background-color:"<?php echo $background_color; ?>";border-collapse:separate;'>
                            <tr><td></td></tr>
                            <tr>
                                <td>&nbsp;<b id="first_loyer_hors_assu">1er loyer major&eacute; (hors assurance) :</b></td>
                                <td align='right' id="first_loyer_valeur"><span class='price_cadre' ><b id="leasing_loyer_majore"></b></span></td>
                            </tr>


                            <tr>
                                <td>&nbsp;<b><span class="leasing_month"></span> loyers (hors assurance) :</b></td>
                                <td align='right'><span class='price_cadre'><b id="leasing_loyers"></b></span></td>
                            </tr>


                            <tr>
                                <td>&nbsp;Soit &agrave; partir de moins de :</b></td>
                                <td align='right'><span class='price_cadre'><b id="leasing_loyer_journalier"></b></span></td>
                            </tr>


                            <tr>
                                <td>&nbsp;Option d'achat finale :&nbsp;&nbsp;&nbsp;</td>
                                <td align='right'><span class='price_cadre' id="leasing_option_achat"></span></td>
                            </tr>
                            <tr>
                                <td>&nbsp;Cout total hors assurance :</td>
                                <td align='right'><span class='price_cadre' id="leasing_cout_total"></span></td>
                            </tr>
                            <tr>
                                <td>&nbsp;Perte Financi&egrave;re (facultative) :</td>
                                <td align='right'><span class='price_cadre' id="leasing_perte_financiere"></span></td>
                            </tr>
                            <tr><td></td></tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <?php
        echo "<table style='clear:both;text-align:justify;color:#3c3c3c; background-color:" . (isset($background_color) ? $background_color : '') . "; border:" . (isset($border) ? $border : '') . "' cellpadding='0' cellspacing='0' class='popup_financement_3'>
                    <tr>
                        <td style='padding:5px;'>
                            <h1>Un cr&eacute;dit vous engage et doit etre rembours&eacute;.<br /> Verifiez vos capacit&eacute;s de remboursement avant de vous engager. </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style='padding:5px;'>
                             Exemple pour une location avec option d'achat de <span class='prix_avec_remise'></span>&euro; d'une dur&eacute;e de <span class='leasing_month'></span> mois avec apport de <span class='apport_prix_input'></span>, soit <span class='leasing_month'></span> loyers mensuels de <span class='leasing_loyers'>Loyer Mensuel</span> TTC hors assurance facultative, option d'achat finale TTC de <span class='leasing_option_achat'>Opt achat final</span>&euro; soit un montant total d&ucirc; sans option d'achat finale de <span class='leasing_cout_total'></span> &euro; hors assurance facultative. Montant total d&ucirc; avec option d'achat finale de <span class='leasing_cout_total'>Cout total hors assurance</span>&euro; hors assurance facultative. </br>
Le co&ucirc;t de l'assurance facultative perte financi&egrave;re souscrite aupr&egrave;s de Cardif Assurance Vie et Cardif Assurances Risques Divers, est de <span class='leasing_perte_financiere'></span> &euro; par mois et s'ajoute au montant du loyer ci-dessus. Le co&ucirc;t total de cette assurance facultative sera de <span class='perfi_duree'></span>&euro;.</br></br>

Sous r&eacute;serve d'&eacute;tude et d'acceptation du dossier par le bailleur Cofica Bail, soci&eacute;t&eacute; d&eacute;tenue par BNP Paribas Personal Finance dont : Cofica Bail S.A. au capital de 12 800 000 euros 399 181 924 RCS Paris, Si&egrave;ge social : 1 boulevard Haussmann 75009 Paris N&deg;ORIAS : 07 023 197 (www.orias.fr). Soci&eacute;t&eacute; de courtage d'assurances non soumise &agrave; l'exclusivit&eacute; : liste des entreprises d'assurances partenaires disponibles sur simple demande. Soci&eacute;t&eacute;s soumises &agrave; l'Autorit&eacute; de Contr&ocirc;le Prudentiel et de R&eacute;solution 61 rue Taitbout 75009 Paris conform&eacute;ment &agrave; la loi en vigueur sur la LOA. Vous disposez d'un droit de r&eacute;tractation. </br>
Publicit&eacute; diffus&eacute;e par Cofica Bail en qualit&eacute; d'interm&eacute;diaire de cr&eacute;dit &agrave; titre non exclusif de BNP Paribas Personal Finance. Cet interm&eacute;diaire apporte son concours &agrave; la r&eacute;alisation d'op&eacute;rations de cr&eacute;dit sans agir en qualit&eacute; de pr&ecirc;teur.
                        </td>
                    </tr>
     </table>";
        ?>
    </div>

     <script src="/libs_v2/leasing/leasing.class.js"></script>
    <script>
         $(document).ready(function () {

         /*$('select#duree_input').selectToUISlider({
         labels: 5,
         labelSrc: 'text',
         tooltip: false,
         sliderBackgroundColor: '<!--?php echo $slider_color; ?-->',
         sliderOptions: {
         animate: false
         }
         });
     
         $('select#kilometrage_input').selectToUISlider({
         labels: 5,
         labelSrc: 'text',
         tooltip: false,
         sliderBackgroundColor: '<!--?php echo $slider_color; ?-->',
         sliderOptions: {
         animate: false
         }
         });*/

        // RECHERCHE DU V?HICULE
        $('#form_brands').change(function () {
        var  idbrand  =  $(this).val();
                window.location.href  =  "/simulator/" +  idbrand;
        });

                $('#form_models').change(function () {
        var  idbrand  =  $('#form_brands').val();
                var  idmodel  =  $(this).val();
                window.location.href  =  "/simulator/" +  idbrand +  "/" +  idmodel;
        });

                $('#form_finitions').change(function () {
        var  idbrand  =  $('#form_brands').val();
                var  idmodel  =  $('#form_models').val();
                var  idFinition  =  $(this).val();

                window.location.href  =  "/simulator/" +  idbrand +  "/" +  idmodel +  "/" +  idFinition;
        });

                // AFFICHAGE DU SIMULATEUR
                var  model;
                var  tab_vr;

                model  =  <?php echo $_GET['gamme_id']; ?>;
                var prix_catalogue = <?php echo $_GET['prix_catalogue']; ?>;
                var prix_remise = <?php echo $_GET['prix_remise']; ?>;
                var prix_options = <?php echo $_GET['prix_options']; ?>;
                var init_leasing = function(item) {
                var apport = 0;
                        if ($('#apport_prix_input').val()){
                var apport = parseInt($('#apport_prix_input').val());
                }
                $.ajax({
                url: 'http://simulator.clubautogenerate.com/api/vrs/import_code/' + item,
                        type: "GET",
                        dataType: 'json',
                        success: function(data) {
                        tab_vr = data;
                                var cpt = 0;
                                var vr_value = 0;
                                var month_value = 0;
                                var kilometer_value = 0;
                                for (var vr in data){
                        $('#duree_input').append($('<option>', {
                        value: vr,
                                text: vr
                        }));
                                if (cpt == 0){
                        for (var a in data[vr]){
                        // console.log(data[vr][a]);
                        $('#kilometrage_input').append($('<option>', {
                        value: a,
                                text: data[vr][a].kilometer
                        }));
                                if (vr_value == 0){
                        vr_value = data[vr][a].vr;
                                month_value = vr;
                                kilometer_value = data[vr][a].kilometer;
                        }
                        }
                        cpt++;
                        }
                        }

                        var leasing = new Leasing(prix_catalogue, prix_remise, month_value, kilometer_value, vr_value, apport, prix_options);
                                refresh_content(leasing);
                        }
                });
                };
                var refresh_content = function(leasing) {
                if (leasing.apport == 0){
                $('#first_loyer_hors_assu').html('');
                        $('#first_loyer_valeur').html('');
                } else{
                $('#first_loyer_hors_assu').html('1er loyer major&eacute; (hors assurance) :');
                        $('#first_loyer_valeur').html('<span class="price_cadre" ><b id="leasing_loyer_majore"></b></span>');
                }
                $('#prix_catalogue').html(leasing.prix_catalogue);
                        $('#leasing_loyers').html(leasing.loyer);
                        $('#leasing_loyer_journalier').html(leasing.loyerJournalier);
                        $('#leasing_option_achat').html(leasing.prixFinContrat);
                        $('#leasing_cout_total').html(leasing.coutTotal);
                        $('.leasing_month').html(leasing.duree);
                        $('.leasing_km').html(leasing.km);
                        $('#leasing_perte_financiere').html(leasing.perte_financiere);
                        $('#leasing_loyer_majore').html(leasing.loyerMajore);
                        $('#leasing_apport_max').html(leasing.apportMax);
                        $('.leasing_cout_total').html(leasing.coutTotal);
                        $('.prix_avec_remise').html(leasing.prix_remise);
                        $('.apport_prix_input').html(leasing.apport);
                        $('.leasing_option_achat').html(leasing.prixFinContrat);
                        $('.leasing_loyers').html(leasing.loyer);
                        $('.leasing_perte_financiere').html(leasing.perte_financiere);
                        $('.perfi_duree').html(Math.round10(leasing.perte_financiere * leasing.duree, -1));
                };
                $('#kilometrage_input').change(function() {

        var apport = 0;
                if ($('#apport_prix_input').val()){
        var apport = parseInt($('#apport_prix_input').val());
        }

        data = tab_vr;
                var vr_value = 0;
                var month_value = 0;
                var kilometer_value = 0;
                var a = $(this).val();
                console.log(a);
                var duree_input = $('#duree_input').val();
                vr_value = data[duree_input][a].vr;
                month_value = duree_input;
                kilometer_value = data[duree_input][a].kilometer;
                var leasing = new Leasing(prix_catalogue, prix_remise, month_value, kilometer_value, vr_value, apport, prix_options);
                refresh_content(leasing);
        });
                $('#duree_input').change(function() {

        var apport = 0;
                if ($('#apport_prix_input').val()){
        var apport = parseInt($('#apport_prix_input').val());
        }

        data = tab_vr;
                var cpt = 0;
                var vr_value = 0;
                var month_value = $(this).val();
                var kilometer_value = 0;
                $('#kilometrage_input').html('');
                for (var a in data[month_value]){
        $('#kilometrage_input').append($('<option>', {
        value: a,
                text: data[month_value][a].kilometer
        }));
                if (vr_value == 0){
        vr_value = data[month_value][a].vr;
                kilometer_value = data[month_value][a].kilometer;
        }
        }


        var leasing = new Leasing(prix_catalogue, prix_remise, month_value, kilometer_value, vr_value, apport, prix_options);
                refresh_content(leasing);
        });
                $('#apport_prix_input').bind('keyup', function() {
        var data = tab_vr;
                var month_value = $('#duree_input').val();
                var a = $('#kilometrage_input').val();
                var kilometer_value = data[month_value][a].kilometer;
                var vr_value = data[month_value][a].vr;
                var apport = 0;
                var apportMax = parseInt($('#leasing_apport_max').html());
                if ($('#apport_prix_input').val()){
        apport = parseInt($('#apport_prix_input').val());
        }

        if (apport > apportMax){
        apport = apportMax;
                $('#apport_prix_input').val(apport)
                }

                var leasing = new Leasing(prix_catalogue, prix_remise, month_value, kilometer_value, vr_value, apport, prix_options);
                refresh_content(leasing);
            });

            var getApportMax = function() {
                var apport = 0;
                var apportMax = parseInt($('#leasing_apport_max').html());

                if(apport > apportMax){
                    apport = apportMax;
                    $('#apport_prix_input').val(apport)
                }

                return apport;
            };


            init_leasing(model);

        });
    </script>
