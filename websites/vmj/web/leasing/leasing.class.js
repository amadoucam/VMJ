/**
 * Created by taylor on 21/09/16.
 */
var Leasing = function (prix_catalogue, prix_remise, duree, km, vr, apport, prix_options) {
    this.prix_catalogue = prix_catalogue;
    this.prix_remise = prix_remise;
    this.prix = 0;
    this.fraisFormalite = 248;
    this.fraisLeasing = 150;
    this.duree = duree;
    this.km = km;
    this.vr = vr;
    this.apport = apport;
    this.tauxLoa = 0.089;
    this.taeg = 0.079;
    this.frais_livraison = 195;

    this.loyer = 0;
    this.loyerMajore = 0;
    this.loyerJournalier = 0;
    this.apportMax = 0;
    this.loyerWithAssurance = 0;
    this.optionAchat = 0;
    this.coutTotal = 0;
    this.coutTotalWithAssurance = 0;
    this.prixFinContrat = 0;
    this.assurance_deces = 0.07;
    this.assurance_perte = 0.15;
    this.perte_financiere = 0;

    //this.prix = this.prix_catalogue + this.frais_livraison - this.apport;
    this.prix = this.prix_remise + this.fraisFormalite + this.fraisLeasing - this.apport + prix_options;
    this.apportMax = (0.30 * (this.prix_catalogue + this.frais_livraison));
    this.perte_financiere = Math.round10(0.0010 * this.prix, -1);
    this.prixFinContrat = Math.round10((this.prix  * (this.vr / 100)), -1);
    //this.prixFinContrat = Math.round10((this.vr / this.prix), -1);
    var tauxMensuel = this.tauxLoa / 12;
    this.loyer = Math.round10((( tauxMensuel * - (this.prixFinContrat - Math.pow((1+tauxMensuel), this.duree) * this.prix) / (-1 + Math.pow((1+tauxMensuel), this.duree)) * 100) / 100 ) / (1 + tauxMensuel), -1);
    this.loyerMajore = this.apport;
    this.loyerJournalier = Math.round10(this.loyer / 30, -1);
    this.coutTotal = Math.round10((this.loyer * this.duree) + this.prixFinContrat + this.apport, -1);
    this.optionAchat = Math.round10(this.loyer * this.duree, -1);


};

/**
 * Ajustement d??cimal d'un nombre
 *
 * @param {String}  type : Le type d'ajustement souhait??.
 * @param {Number}  value : le nombre ?  trait?? The number.
 * @param {Integer} exp  : l'exposant (le logarithme en base 10 de l'ajustement).
 * @returns {Number} la valeur ajust??e.
 */
function decimalAdjust(type, value, exp) {
    // Si la valeur de exp n'est pas d??finie ou vaut z??ro...
    if (typeof exp === 'undefined' || +exp === 0) {
        return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // Si la valeur n'est pas un nombre
    // ou si exp n'est pas un entier...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
        return NaN;
    }
    // D??calage
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // D??calage invers??
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
}

// Arrondi d??cimal
if (!Math.round10) {
    Math.round10 = function(value, exp) {
        return decimalAdjust('round', value, exp);
    };
}
