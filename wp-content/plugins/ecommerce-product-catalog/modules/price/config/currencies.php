<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Manages plugin currencies
 *
 * Here plugin currencies are defined and managed.
 *
 * @version		1.0.0
 * @package		ecommerce-product-catalog/functions
 * @author 		impleCode
 */
function available_currencies() {
	$currencies = array(
		'USD',
		'EUR',
		'AUD',
		'CAD',
		'GBP',
		'JPY',
		'NZD',
		'CHF',
		'HKD',
		'SGD',
		'SEK',
		'DKK',
		'PLN',
		'NOK',
		'HUF',
		'CZK',
		'ILS',
		'MXN',
		'BRL',
		'MYR',
		'PHP',
		'TWD',
		'THB',
		'TRY',
		'RUB',
		'AFN',
		'ALL',
		'DZD',
		'AOA',
		'XCD',
		'ARS',
		'AMD',
		'AWG',
		'AZN',
		'BSD',
		'BHD',
		'BDT',
		'BBD',
		'BYR',
		'BZD',
		'XOF',
		'BMD',
		'BTN',
		'INR',
		'BOB',
		'BOV',
		'BAM',
		'BWP',
		'BND',
		'BGN',
		'BIF',
		'CVE',
		'KHR',
		'XAF',
		'KYD',
		'CLF',
		'CLP',
		'CNY',
		'COP',
		'COU',
		'KMF',
		'CDF',
		'CRC',
		'HRK',
		'CUC',
		'CUP',
		'ANG',
		'DJF',
		'DOP',
		'EGP',
		'SVC',
		'ERN',
		'ETB',
		'FKP',
		'FJD',
		'XPF',
		'GMD',
		'GEL',
		'GHS',
		'GIP',
		'GTQ',
		'GNF',
		'GYD',
		'HTG',
		'HNL',
		'ISK',
		'IDR',
		'XDR',
		'IRR',
		'IQD',
		'JMD',
		'JOD',
		'KZT',
		'KES',
		'KPW',
		'KRW',
		'KWD',
		'KGS',
		'LAK',
		'LBP',
		'LSL',
		'ZAR',
		'LRD',
		'LYD',
		'MOP',
		'MKD',
		'MGA',
		'MWK',
		'MVR',
		'MRO',
		'MUR',
		'XUA',
		'MXV',
		'MDL',
		'MNT',
		'MAD',
		'MZN',
		'MMK',
		'NAD',
		'NPR',
		'NIO',
		'NGN',
		'OMR',
		'PKR',
		'PAB',
		'PGK',
		'PYG',
		'PEN',
		'QAR',
		'RON',
		'RWF',
		'SHP',
		'WST',
		'STD',
		'SAR',
		'RSD',
		'SCR',
		'SLL',
		'XSU',
		'SBD',
		'SOS',
		'SSP',
		'LKR',
		'SDG',
		'SRD',
		'SZL',
		'CHE',
		'CHW',
		'SYP',
		'TJS',
		'TZS',
		'TOP',
		'TTD',
		'TND',
		'TMT',
		'UGX',
		'UAH',
		'AED',
		'USN',
		'UYI',
		'UYU',
		'UZS',
		'VUV',
		'VEF',
		'VND',
		'YER',
		'ZMW',
		'ZWL'
	);
	return $currencies;
}

function ic_cat_get_currencies() {
	$currencies = array_unique( apply_filters( 'ic_cat_currencies', array(
		'AED'	 => __( 'United Arab Emirates dirham', 'ecommerce-product-catalog' ),
		'AFN'	 => __( 'Afghan afghani', 'ecommerce-product-catalog' ),
		'ALL'	 => __( 'Albanian lek', 'ecommerce-product-catalog' ),
		'AMD'	 => __( 'Armenian dram', 'ecommerce-product-catalog' ),
		'ANG'	 => __( 'Netherlands Antillean guilder', 'ecommerce-product-catalog' ),
		'AOA'	 => __( 'Angolan kwanza', 'ecommerce-product-catalog' ),
		'ARS'	 => __( 'Argentine peso', 'ecommerce-product-catalog' ),
		'AUD'	 => __( 'Australian dollar', 'ecommerce-product-catalog' ),
		'AWG'	 => __( 'Aruban florin', 'ecommerce-product-catalog' ),
		'AZN'	 => __( 'Azerbaijani manat', 'ecommerce-product-catalog' ),
		'BAM'	 => __( 'Bosnia and Herzegovina convertible mark', 'ecommerce-product-catalog' ),
		'BBD'	 => __( 'Barbadian dollar', 'ecommerce-product-catalog' ),
		'BDT'	 => __( 'Bangladeshi taka', 'ecommerce-product-catalog' ),
		'BGN'	 => __( 'Bulgarian lev', 'ecommerce-product-catalog' ),
		'BHD'	 => __( 'Bahraini dinar', 'ecommerce-product-catalog' ),
		'BIF'	 => __( 'Burundian franc', 'ecommerce-product-catalog' ),
		'BMD'	 => __( 'Bermudian dollar', 'ecommerce-product-catalog' ),
		'BND'	 => __( 'Brunei dollar', 'ecommerce-product-catalog' ),
		'BOB'	 => __( 'Bolivian boliviano', 'ecommerce-product-catalog' ),
		'BRL'	 => __( 'Brazilian real', 'ecommerce-product-catalog' ),
		'BSD'	 => __( 'Bahamian dollar', 'ecommerce-product-catalog' ),
		'BTC'	 => __( 'Bitcoin', 'ecommerce-product-catalog' ),
		'BTN'	 => __( 'Bhutanese ngultrum', 'ecommerce-product-catalog' ),
		'BWP'	 => __( 'Botswana pula', 'ecommerce-product-catalog' ),
		'BYR'	 => __( 'Belarusian ruble (old)', 'ecommerce-product-catalog' ),
		'BYN'	 => __( 'Belarusian ruble', 'ecommerce-product-catalog' ),
		'BZD'	 => __( 'Belize dollar', 'ecommerce-product-catalog' ),
		'CAD'	 => __( 'Canadian dollar', 'ecommerce-product-catalog' ),
		'CDF'	 => __( 'Congolese franc', 'ecommerce-product-catalog' ),
		'CHF'	 => __( 'Swiss franc', 'ecommerce-product-catalog' ),
		'CLP'	 => __( 'Chilean peso', 'ecommerce-product-catalog' ),
		'CNY'	 => __( 'Chinese yuan', 'ecommerce-product-catalog' ),
		'COP'	 => __( 'Colombian peso', 'ecommerce-product-catalog' ),
		'CRC'	 => __( 'Costa Rican col&oacute;n', 'ecommerce-product-catalog' ),
		'CUC'	 => __( 'Cuban convertible peso', 'ecommerce-product-catalog' ),
		'CUP'	 => __( 'Cuban peso', 'ecommerce-product-catalog' ),
		'CVE'	 => __( 'Cape Verdean escudo', 'ecommerce-product-catalog' ),
		'CZK'	 => __( 'Czech koruna', 'ecommerce-product-catalog' ),
		'DJF'	 => __( 'Djiboutian franc', 'ecommerce-product-catalog' ),
		'DKK'	 => __( 'Danish krone', 'ecommerce-product-catalog' ),
		'DOP'	 => __( 'Dominican peso', 'ecommerce-product-catalog' ),
		'DZD'	 => __( 'Algerian dinar', 'ecommerce-product-catalog' ),
		'EGP'	 => __( 'Egyptian pound', 'ecommerce-product-catalog' ),
		'ERN'	 => __( 'Eritrean nakfa', 'ecommerce-product-catalog' ),
		'ETB'	 => __( 'Ethiopian birr', 'ecommerce-product-catalog' ),
		'EUR'	 => __( 'Euro', 'ecommerce-product-catalog' ),
		'FJD'	 => __( 'Fijian dollar', 'ecommerce-product-catalog' ),
		'FKP'	 => __( 'Falkland Islands pound', 'ecommerce-product-catalog' ),
		'GBP'	 => __( 'Pound sterling', 'ecommerce-product-catalog' ),
		'GEL'	 => __( 'Georgian lari', 'ecommerce-product-catalog' ),
		'GGP'	 => __( 'Guernsey pound', 'ecommerce-product-catalog' ),
		'GHS'	 => __( 'Ghana cedi', 'ecommerce-product-catalog' ),
		'GIP'	 => __( 'Gibraltar pound', 'ecommerce-product-catalog' ),
		'GMD'	 => __( 'Gambian dalasi', 'ecommerce-product-catalog' ),
		'GNF'	 => __( 'Guinean franc', 'ecommerce-product-catalog' ),
		'GTQ'	 => __( 'Guatemalan quetzal', 'ecommerce-product-catalog' ),
		'GYD'	 => __( 'Guyanese dollar', 'ecommerce-product-catalog' ),
		'HKD'	 => __( 'Hong Kong dollar', 'ecommerce-product-catalog' ),
		'HNL'	 => __( 'Honduran lempira', 'ecommerce-product-catalog' ),
		'HRK'	 => __( 'Croatian kuna', 'ecommerce-product-catalog' ),
		'HTG'	 => __( 'Haitian gourde', 'ecommerce-product-catalog' ),
		'HUF'	 => __( 'Hungarian forint', 'ecommerce-product-catalog' ),
		'IDR'	 => __( 'Indonesian rupiah', 'ecommerce-product-catalog' ),
		'ILS'	 => __( 'Israeli new shekel', 'ecommerce-product-catalog' ),
		'IMP'	 => __( 'Manx pound', 'ecommerce-product-catalog' ),
		'INR'	 => __( 'Indian rupee', 'ecommerce-product-catalog' ),
		'IQD'	 => __( 'Iraqi dinar', 'ecommerce-product-catalog' ),
		'IRR'	 => __( 'Iranian rial', 'ecommerce-product-catalog' ),
		'IRT'	 => __( 'Iranian toman', 'ecommerce-product-catalog' ),
		'ISK'	 => __( 'Icelandic kr&oacute;na', 'ecommerce-product-catalog' ),
		'JEP'	 => __( 'Jersey pound', 'ecommerce-product-catalog' ),
		'JMD'	 => __( 'Jamaican dollar', 'ecommerce-product-catalog' ),
		'JOD'	 => __( 'Jordanian dinar', 'ecommerce-product-catalog' ),
		'JPY'	 => __( 'Japanese yen', 'ecommerce-product-catalog' ),
		'KES'	 => __( 'Kenyan shilling', 'ecommerce-product-catalog' ),
		'KGS'	 => __( 'Kyrgyzstani som', 'ecommerce-product-catalog' ),
		'KHR'	 => __( 'Cambodian riel', 'ecommerce-product-catalog' ),
		'KMF'	 => __( 'Comorian franc', 'ecommerce-product-catalog' ),
		'KPW'	 => __( 'North Korean won', 'ecommerce-product-catalog' ),
		'KRW'	 => __( 'South Korean won', 'ecommerce-product-catalog' ),
		'KWD'	 => __( 'Kuwaiti dinar', 'ecommerce-product-catalog' ),
		'KYD'	 => __( 'Cayman Islands dollar', 'ecommerce-product-catalog' ),
		'KZT'	 => __( 'Kazakhstani tenge', 'ecommerce-product-catalog' ),
		'LAK'	 => __( 'Lao kip', 'ecommerce-product-catalog' ),
		'LBP'	 => __( 'Lebanese pound', 'ecommerce-product-catalog' ),
		'LKR'	 => __( 'Sri Lankan rupee', 'ecommerce-product-catalog' ),
		'LRD'	 => __( 'Liberian dollar', 'ecommerce-product-catalog' ),
		'LSL'	 => __( 'Lesotho loti', 'ecommerce-product-catalog' ),
		'LYD'	 => __( 'Libyan dinar', 'ecommerce-product-catalog' ),
		'MAD'	 => __( 'Moroccan dirham', 'ecommerce-product-catalog' ),
		'MDL'	 => __( 'Moldovan leu', 'ecommerce-product-catalog' ),
		'MGA'	 => __( 'Malagasy ariary', 'ecommerce-product-catalog' ),
		'MKD'	 => __( 'Macedonian denar', 'ecommerce-product-catalog' ),
		'MMK'	 => __( 'Burmese kyat', 'ecommerce-product-catalog' ),
		'MNT'	 => __( 'Mongolian t&ouml;gr&ouml;g', 'ecommerce-product-catalog' ),
		'MOP'	 => __( 'Macanese pataca', 'ecommerce-product-catalog' ),
		'MRO'	 => __( 'Mauritanian ouguiya', 'ecommerce-product-catalog' ),
		'MUR'	 => __( 'Mauritian rupee', 'ecommerce-product-catalog' ),
		'MVR'	 => __( 'Maldivian rufiyaa', 'ecommerce-product-catalog' ),
		'MWK'	 => __( 'Malawian kwacha', 'ecommerce-product-catalog' ),
		'MXN'	 => __( 'Mexican peso', 'ecommerce-product-catalog' ),
		'MYR'	 => __( 'Malaysian ringgit', 'ecommerce-product-catalog' ),
		'MZN'	 => __( 'Mozambican metical', 'ecommerce-product-catalog' ),
		'NAD'	 => __( 'Namibian dollar', 'ecommerce-product-catalog' ),
		'NGN'	 => __( 'Nigerian naira', 'ecommerce-product-catalog' ),
		'NIO'	 => __( 'Nicaraguan c&oacute;rdoba', 'ecommerce-product-catalog' ),
		'NOK'	 => __( 'Norwegian krone', 'ecommerce-product-catalog' ),
		'NPR'	 => __( 'Nepalese rupee', 'ecommerce-product-catalog' ),
		'NZD'	 => __( 'New Zealand dollar', 'ecommerce-product-catalog' ),
		'OMR'	 => __( 'Omani rial', 'ecommerce-product-catalog' ),
		'PAB'	 => __( 'Panamanian balboa', 'ecommerce-product-catalog' ),
		'PEN'	 => __( 'Peruvian nuevo sol', 'ecommerce-product-catalog' ),
		'PGK'	 => __( 'Papua New Guinean kina', 'ecommerce-product-catalog' ),
		'PHP'	 => __( 'Philippine peso', 'ecommerce-product-catalog' ),
		'PKR'	 => __( 'Pakistani rupee', 'ecommerce-product-catalog' ),
		'PLN'	 => __( 'Polish z&#x142;oty', 'ecommerce-product-catalog' ),
		'PRB'	 => __( 'Transnistrian ruble', 'ecommerce-product-catalog' ),
		'PYG'	 => __( 'Paraguayan guaran&iacute;', 'ecommerce-product-catalog' ),
		'QAR'	 => __( 'Qatari riyal', 'ecommerce-product-catalog' ),
		'RON'	 => __( 'Romanian leu', 'ecommerce-product-catalog' ),
		'RSD'	 => __( 'Serbian dinar', 'ecommerce-product-catalog' ),
		'RUB'	 => __( 'Russian ruble', 'ecommerce-product-catalog' ),
		'RWF'	 => __( 'Rwandan franc', 'ecommerce-product-catalog' ),
		'SAR'	 => __( 'Saudi riyal', 'ecommerce-product-catalog' ),
		'SBD'	 => __( 'Solomon Islands dollar', 'ecommerce-product-catalog' ),
		'SCR'	 => __( 'Seychellois rupee', 'ecommerce-product-catalog' ),
		'SDG'	 => __( 'Sudanese pound', 'ecommerce-product-catalog' ),
		'SEK'	 => __( 'Swedish krona', 'ecommerce-product-catalog' ),
		'SGD'	 => __( 'Singapore dollar', 'ecommerce-product-catalog' ),
		'SHP'	 => __( 'Saint Helena pound', 'ecommerce-product-catalog' ),
		'SLL'	 => __( 'Sierra Leonean leone', 'ecommerce-product-catalog' ),
		'SOS'	 => __( 'Somali shilling', 'ecommerce-product-catalog' ),
		'SRD'	 => __( 'Surinamese dollar', 'ecommerce-product-catalog' ),
		'SSP'	 => __( 'South Sudanese pound', 'ecommerce-product-catalog' ),
		'STD'	 => __( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe dobra', 'ecommerce-product-catalog' ),
		'SYP'	 => __( 'Syrian pound', 'ecommerce-product-catalog' ),
		'SZL'	 => __( 'Swazi lilangeni', 'ecommerce-product-catalog' ),
		'THB'	 => __( 'Thai baht', 'ecommerce-product-catalog' ),
		'TJS'	 => __( 'Tajikistani somoni', 'ecommerce-product-catalog' ),
		'TMT'	 => __( 'Turkmenistan manat', 'ecommerce-product-catalog' ),
		'TND'	 => __( 'Tunisian dinar', 'ecommerce-product-catalog' ),
		'TOP'	 => __( 'Tongan pa&#x2bb;anga', 'ecommerce-product-catalog' ),
		'TRY'	 => __( 'Turkish lira', 'ecommerce-product-catalog' ),
		'TTD'	 => __( 'Trinidad and Tobago dollar', 'ecommerce-product-catalog' ),
		'TWD'	 => __( 'New Taiwan dollar', 'ecommerce-product-catalog' ),
		'TZS'	 => __( 'Tanzanian shilling', 'ecommerce-product-catalog' ),
		'UAH'	 => __( 'Ukrainian hryvnia', 'ecommerce-product-catalog' ),
		'UGX'	 => __( 'Ugandan shilling', 'ecommerce-product-catalog' ),
		'USD'	 => __( 'United States dollar', 'ecommerce-product-catalog' ),
		'UYU'	 => __( 'Uruguayan peso', 'ecommerce-product-catalog' ),
		'UZS'	 => __( 'Uzbekistani som', 'ecommerce-product-catalog' ),
		'VEF'	 => __( 'Venezuelan bol&iacute;var', 'ecommerce-product-catalog' ),
		'VND'	 => __( 'Vietnamese &#x111;&#x1ed3;ng', 'ecommerce-product-catalog' ),
		'VUV'	 => __( 'Vanuatu vatu', 'ecommerce-product-catalog' ),
		'WST'	 => __( 'Samoan t&#x101;l&#x101;', 'ecommerce-product-catalog' ),
		'XAF'	 => __( 'Central African CFA franc', 'ecommerce-product-catalog' ),
		'XCD'	 => __( 'East Caribbean dollar', 'ecommerce-product-catalog' ),
		'XOF'	 => __( 'West African CFA franc', 'ecommerce-product-catalog' ),
		'XPF'	 => __( 'CFP franc', 'ecommerce-product-catalog' ),
		'YER'	 => __( 'Yemeni rial', 'ecommerce-product-catalog' ),
		'ZAR'	 => __( 'South African rand', 'ecommerce-product-catalog' ),
		'ZMW'	 => __( 'Zambian kwacha', 'ecommerce-product-catalog' ),
	)
	)
	);


	return $currencies;
}

function ic_cat_get_currency_symbol( $currency = '' ) {
	if ( empty( $currency ) ) {
		$currency = get_product_currency_code();
	}

	$symbols		 = apply_filters( 'ic_cat_currency_symbols', array(
		'AED'	 => '&#x62f;.&#x625;',
		'AFN'	 => '&#x60b;',
		'ALL'	 => 'L',
		'AMD'	 => 'AMD',
		'ANG'	 => '&fnof;',
		'AOA'	 => 'Kz',
		'ARS'	 => '&#36;',
		'AUD'	 => '&#36;',
		'AWG'	 => 'Afl.',
		'AZN'	 => 'AZN',
		'BAM'	 => 'KM',
		'BBD'	 => '&#36;',
		'BDT'	 => '&#2547;&nbsp;',
		'BGN'	 => '&#1083;&#1074;.',
		'BHD'	 => '.&#x62f;.&#x628;',
		'BIF'	 => 'Fr',
		'BMD'	 => '&#36;',
		'BND'	 => '&#36;',
		'BOB'	 => 'Bs.',
		'BRL'	 => '&#82;&#36;',
		'BSD'	 => '&#36;',
		'BTC'	 => '&#3647;',
		'BTN'	 => 'Nu.',
		'BWP'	 => 'P',
		'BYR'	 => 'Br',
		'BYN'	 => 'Br',
		'BZD'	 => '&#36;',
		'CAD'	 => '&#36;',
		'CDF'	 => 'Fr',
		'CHF'	 => '&#67;&#72;&#70;',
		'CLP'	 => '&#36;',
		'CNY'	 => '&yen;',
		'COP'	 => '&#36;',
		'CRC'	 => '&#x20a1;',
		'CUC'	 => '&#36;',
		'CUP'	 => '&#36;',
		'CVE'	 => '&#36;',
		'CZK'	 => '&#75;&#269;',
		'DJF'	 => 'Fr',
		'DKK'	 => 'DKK',
		'DOP'	 => 'RD&#36;',
		'DZD'	 => '&#x62f;.&#x62c;',
		'EGP'	 => 'EGP',
		'ERN'	 => 'Nfk',
		'ETB'	 => 'Br',
		'EUR'	 => '&euro;',
		'FJD'	 => '&#36;',
		'FKP'	 => '&pound;',
		'GBP'	 => '&pound;',
		'GEL'	 => '&#x10da;',
		'GGP'	 => '&pound;',
		'GHS'	 => '&#x20b5;',
		'GIP'	 => '&pound;',
		'GMD'	 => 'D',
		'GNF'	 => 'Fr',
		'GTQ'	 => 'Q',
		'GYD'	 => '&#36;',
		'HKD'	 => '&#36;',
		'HNL'	 => 'L',
		'HRK'	 => 'Kn',
		'HTG'	 => 'G',
		'HUF'	 => '&#70;&#116;',
		'IDR'	 => 'Rp',
		'ILS'	 => '&#8362;',
		'IMP'	 => '&pound;',
		'INR'	 => '&#8377;',
		'IQD'	 => '&#x639;.&#x62f;',
		'IRR'	 => '&#xfdfc;',
		'IRT'	 => '&#x062A;&#x0648;&#x0645;&#x0627;&#x0646;',
		'ISK'	 => 'kr.',
		'JEP'	 => '&pound;',
		'JMD'	 => '&#36;',
		'JOD'	 => '&#x62f;.&#x627;',
		'JPY'	 => '&yen;',
		'KES'	 => 'KSh',
		'KGS'	 => '&#x441;&#x43e;&#x43c;',
		'KHR'	 => '&#x17db;',
		'KMF'	 => 'Fr',
		'KPW'	 => '&#x20a9;',
		'KRW'	 => '&#8361;',
		'KWD'	 => '&#x62f;.&#x643;',
		'KYD'	 => '&#36;',
		'KZT'	 => 'KZT',
		'LAK'	 => '&#8365;',
		'LBP'	 => '&#x644;.&#x644;',
		'LKR'	 => '&#xdbb;&#xdd4;',
		'LRD'	 => '&#36;',
		'LSL'	 => 'L',
		'LYD'	 => '&#x644;.&#x62f;',
		'MAD'	 => '&#x62f;.&#x645;.',
		'MDL'	 => 'MDL',
		'MGA'	 => 'Ar',
		'MKD'	 => '&#x434;&#x435;&#x43d;',
		'MMK'	 => 'Ks',
		'MNT'	 => '&#x20ae;',
		'MOP'	 => 'P',
		'MRO'	 => 'UM',
		'MUR'	 => '&#x20a8;',
		'MVR'	 => '.&#x783;',
		'MWK'	 => 'MK',
		'MXN'	 => '&#36;',
		'MYR'	 => '&#82;&#77;',
		'MZN'	 => 'MT',
		'NAD'	 => '&#36;',
		'NGN'	 => '&#8358;',
		'NIO'	 => 'C&#36;',
		'NOK'	 => '&#107;&#114;',
		'NPR'	 => '&#8360;',
		'NZD'	 => '&#36;',
		'OMR'	 => '&#x631;.&#x639;.',
		'PAB'	 => 'B/.',
		'PEN'	 => 'S/.',
		'PGK'	 => 'K',
		'PHP'	 => '&#8369;',
		'PKR'	 => '&#8360;',
		'PLN'	 => '&#122;&#322;',
		'PRB'	 => '&#x440;.',
		'PYG'	 => '&#8370;',
		'QAR'	 => '&#x631;.&#x642;',
		'RMB'	 => '&yen;',
		'RON'	 => 'lei',
		'RSD'	 => '&#x434;&#x438;&#x43d;.',
		'RUB'	 => '&#8381;',
		'RWF'	 => 'Fr',
		'SAR'	 => '&#x631;.&#x633;',
		'SBD'	 => '&#36;',
		'SCR'	 => '&#x20a8;',
		'SDG'	 => '&#x62c;.&#x633;.',
		'SEK'	 => '&#107;&#114;',
		'SGD'	 => '&#36;',
		'SHP'	 => '&pound;',
		'SLL'	 => 'Le',
		'SOS'	 => 'Sh',
		'SRD'	 => '&#36;',
		'SSP'	 => '&pound;',
		'STD'	 => 'Db',
		'SYP'	 => '&#x644;.&#x633;',
		'SZL'	 => 'L',
		'THB'	 => '&#3647;',
		'TJS'	 => '&#x405;&#x41c;',
		'TMT'	 => 'm',
		'TND'	 => '&#x62f;.&#x62a;',
		'TOP'	 => 'T&#36;',
		'TRY'	 => '&#8378;',
		'TTD'	 => '&#36;',
		'TWD'	 => '&#78;&#84;&#36;',
		'TZS'	 => 'Sh',
		'UAH'	 => '&#8372;',
		'UGX'	 => 'UGX',
		'USD'	 => '&#36;',
		'UYU'	 => '&#36;',
		'UZS'	 => 'UZS',
		'VEF'	 => 'Bs F',
		'VND'	 => '&#8363;',
		'VUV'	 => 'Vt',
		'WST'	 => 'T',
		'XAF'	 => 'CFA',
		'XCD'	 => '&#36;',
		'XOF'	 => 'CFA',
		'XPF'	 => 'Fr',
		'YER'	 => '&#xfdfc;',
		'ZAR'	 => '&#82;',
		'ZMW'	 => 'ZK',
	) );
	$currency_symbol = isset( $symbols[ $currency ] ) ? $symbols[ $currency ] : '';

	return apply_filters( 'ic_cat_currency_symbol', $currency_symbol, $currency );
}