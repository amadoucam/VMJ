<?php

namespace Vmj\VmjBundle\Helper;

use WebChemistry\Invoice\ITranslator;

class Translator implements ITranslator {

	const FRENCH = 'fr';

	/** @var array */
	private static $translations = [
		'fr' => [
			'subscriber' => 'Informations client',
			'vat' => 'Numéro de TVA',
			'vaTin' => 'VATIN',
			'date' => 'Date',
			'invoice' => 'Facture',
			'invoiceNumber' => 'Numéro de facture',
			'taxPay' => '',
			'notTax' => 'Pas de TVA enregistré',
			'paymentData' => 'Information paiement',
			'page' => 'Page',
			'from' => '/',
			'totalPrice' => 'Prix total',
			'item' => 'Item',
			'count' => 'Quantité',
			'pricePerItem' => 'Prix par item',
			'total' => 'Total',
			'accountNumber' => 'Numéro de compte',
			'swift' => 'Swift',
			'iban' => 'IBAN',
			'varSymbol' => 'Variable symbol',
			'constSymbol' => 'Constant symbol',
			'tax' => 'TVA (20%)',
			'subtotal' => 'Total HT',
			'dueDate' => 'Date d\'échéance'
		]
	];

	/** @var string */
	private $lang;

	/**
	 * @param string $lang
	 * @throws InvoiceException
	 */
	public function __construct($lang = self::FRENCH) {
		$this->lang = $lang;
		if (!isset(self::$translations[$this->lang])) {
			throw new InvoiceException("Language $lang not exists.");
		}
	}

	/**
	 * @param string $message
	 * @return string
	 */
	public function translate($message) {
		return self::$translations[$this->lang][$message];
	}

}
