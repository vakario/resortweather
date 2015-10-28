<?php
/*
 *
 * @author Florent Glauda <skeul73@live.fr>
 * 
 */

class resortWeather extends Module
{
	private $_html = '';
	
	public function __construct()
	{
		$this->name 			= 'resortweather';
		$this->tab 				= 'front_office_features';
		$this->version			= '1.0';
		$this->author			= 'Vakario';
		$this->displayName		= $this->l('Resort Weather');
		$this->description		= $this->l('Module d\'affichage de la météo de votre station sur votre site');
		$this->confirmUninstall = $this->l('Etes-vous sur de vouloir désinstaller ce module?');
		$this->context 			= Context::getContext();
		$this->bootstrap 		= true;
		$this->resort_list		= array(	'courchevel' 	=> 'uac=DprppZJZ7N&uref=e0db3d97-8b58-44c2-a8d1-29f6cacc0a65',
											'megeve'	 	=> 'uac=vez0gqVQdo&uref=f3fc5b71-28d0-49ec-81c9-86b86c3c82da',
											'laplagne'   	=> 'uac=Z0as8Fisih&uref=1b5ed45e-237b-42c3-9b02-065acb54832a',
											'serrechevalier'=> 'uac=t7F3QxUCHm&uref=6ac38d9c-68be-4f6b-94bd-fa3b3a29a2fb',
											'meribel' 		=> 'uac=vOfnd1keXR&uref=6a3be2f9-c56b-4fa9-b368-913ce494d4e9',
											'valthorens' 	=> 'uac=87pCXsmTJU&uref=b744c427-18f9-4217-b760-05173aab737f',
											'lesmenuires' 	=> 'uac=jfLCbi1ZBR&uref=e3fef172-6359-4345-b343-0c75ecd27ff7',
											'laclusaz'		=> 'uac=wwraIciCRk&uref=1e248f5a-11b2-4024-a8ee-8654d72eed70',
											'lesorres'		=> 'uac=a8AtLFx1w0&uref=b96c9bef-b874-41e2-bad8-e5482167569d',
											'tourmalet'		=> 'uac=W1kQYLTgBh&uref=ecdad9ed-0c74-443f-b414-d8c08f227f59',
											'vars'			=> 'uac=QavxeddK-.&uref=3ec03192-1177-48c6-9abd-a93e56e8b453',
											'deuxalpes'		=> 'uac=rTd7BtP2fz&uref=79fc134b-340d-4928-a9d3-fce6a3559c64',
											
										);
											
		$this->month_list		= array(	$this->l('Janvier'),
											$this->l('Fevrier'),
											$this->l('Mars'),
											$this->l('Avril'),
											$this->l('Mai'),
											$this->l('Juin'),
											$this->l('Juillet'),
											$this->l('Août'),
											$this->l('Septembre'),
											$this->l('Octobre'),
											$this->l('Novembre'),
											$this->l('Decembre'));
		$this->day_list		= array(		$this->l('Lundi'),
											$this->l('Mardi'),
											$this->l('Mercredi'),
											$this->l('Jeudi'),
											$this->l('Vendredi'),
											$this->l('Samedi'),
											$this->l('Dimanche'));
											
		/* $this->context->smarty->assign('module_name', $this->name); */
		
		parent::__construct();

	}

	/**
	 *   module install
	 */
	public function install()
	{
		/* Adds Module */
			return parent :: install() &&
			$this->registerHook('displayHeader') &&
			$this->registerHook('displayHome') && 
			Configuration::updateValue('RW_RESORT_CONFIG', '') &&
			Configuration::updateValue('RW_RESORT_CONFIG_VALUE', '');
	}
	
	/**
	*	module hook Header
	*
	*/
	public function hookdisplayHeader($params)
	{
		$this->context->controller->addCSS($this->_path.'css/resortweather.css', 'all');
		$this->context->controller->addJS($this->_path.'js/resortweather.js', 'all');
	}
	
	/**
	*	module hook Home
	*
	*/
	public function hookdisplayHome($params) 
	{
		$callback 	= array(&$this,'smarty_function_get_month_traduction');
		$callback2 	= array(&$this,'smarty_function_get_day_traduction');
		$callback3 	= array(&$this,'smarty_function_get_img');
		
		smartyRegisterFunction($this->context->smarty, 'function', 'smarty_function_get_month_traduction', $callback);
		smartyRegisterFunction($this->context->smarty, 'function', 'smarty_function_get_day_traduction', $callback2);
		smartyRegisterFunction($this->context->smarty, 'function', 'smarty_function_get_img', $callback3);
		
		$weather = json_decode(file_get_contents('http://www.myweather2.com/developer/weather.ashx?'.Configuration::get('RW_RESORT_CONFIG_VALUE').'&output=json'));
		$this->context->smarty->assign('stat', $weather);
		
		return $this->display(__FILE__, 'resortweather.tpl');
	}
	
	/**
	*	module hook Top
	*
	*/
	public function hookdisplayTop($params) 
	{
		return $this->hookdisplayHome($params);
	}
	
	/**
	*	module hook Footer
	*
	*/
	public function hookdisplayFooter($params)
	{
		return $this->hookdisplayHome($params);
	}
	
	/**
	*	module uninstall
	*
	*/
	public function uninstall()
	{
		return parent::uninstall() &&
		Configuration::deleteByName('RW_RESORT_CONFIG') &&
		Configuration::deleteByName('RW_RESORT_CONFIG_VALUE');
	}
	
	/**
	*	module configuration
	*
	*/
	public function getContent()
	{	
		if (Tools::isSubmit('submitResort')) // si ajout d'un partenaire
		{
			
				Configuration::updateValue('RW_RESORT_CONFIG_VALUE', Tools::getValue('resort') );
				$this->_html .=  $this->displayConfirmation($this->l('Paramètres mis à jour avec succès'));
			
		}
		$this->_html .= $this->renderAddForm();
		return $this->_html;
	}
	
	/**
	*   formulaire add image
	*
	*/
	public function renderAddForm()
	{
		$test = $this->resort_list;
		$options = array();
		foreach ( $test as $resort=>$value)
		{
			array_push($options, array('value' => $value,'name' => $resort));
		};
	
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Resort configuration'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					array(
						'type' => 'select',
						'label' => $this->l('Resort'),
						'name' => 'resort',
						'options' => array(
						'query' => $options,
						'id' => 'value',
						'name' => 'name'
						),
					),
				),
				'submit' => array(
					'title' => $this->l('Save'),
				)
			),
		);

		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table = $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$this->fields_form = array();
		$helper->module = $this;
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submitResort';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$language = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->tpl_vars = array(
			'base_url' => $this->context->shop->getBaseURL(),
			'language' => array(
				'id_lang' => $language->id,
				'iso_code' => $language->iso_code
			),
			'fields_value' => $this->getAddFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);

		return $helper->generateForm(array($fields_form));
	}
	
	
	/*
	*	module get config values
	*
	*/
	public function getAddFieldsValues()
	{
		return array(
		'resort' 	=> Configuration::get('RW_RESORT_CONFIG_VALUE'));
		
	}
	
	/*
	*	module get month traduction
	*
	*/
	public function smarty_function_get_month_traduction($params, &$smarty)
	{
		
		switch (strtolower($params['month'])) 
		{ 
			case "jan":
			case 1: 
			return $this->month_list[0];
			break;
			
			case "feb":
			case 2: 
			return $this->month_list[1];
			break;
			
			case "mar":
			case 3: 
			return $this->month_list[2];
			break;
			
			case "apr":
			case 4: 
			return $this->month_list[3];
			break;
			
			case "may":
			case 5:
			return $this->month_list[4];
			break;
			
			case "jun":
			case 6:
			return $this->month_list[5];
			break;
			
			case "jul":
			case 7:
			return $this->month_list[6];
			break;
			
			case "aug":
			case 8:
			return $this->month_list[7];
			break;
			
			case "sep":
			case 9:
			return $this->month_list[8];
			break;
			
			case "oct":
			case 10:
			return $this->month_list[9];
			break;
			
			case "nov":
			case 11:
			return $this->month_list[10];
			break;
			
			case "dec":
			case 12:
			return $this->month_list[11];
			break;
	
	
			default:
			return " ";
		}
	}
	
	/*
	*	module get day traduction
	*
	*/
	public function smarty_function_get_day_traduction($params, &$smarty)
	{
		
		switch (date("N", strtotime($params['date'])))
		{ 
			case 1: 
			return $this->day_list[0];
			break;
			
			case 2: 
			return $this->day_list[1];
			break;
			
			case 3: 
			return $this->day_list[2];
			break;
			
			case 4: 
			return $this->day_list[3];
			break;
			
			case 5:
			return $this->day_list[4];
			break;
			
			case 6:
			return $this->day_list[5];
			break;
			
			case 7:
			return $this->day_list[6];
			break;
			
			default:
			return " ";
		}
	}
	
	public function smarty_function_get_img($params,&$smarty)
	{
			$dataWeather = array(
			-999 => array ( "desc"=> "N/A", "img"=> "soleil.png" ),
			
			0 => array ( "desc"=> "ensoleillé", "img"=> "B" ),
			1 => array ( "desc"=> "partiellement nuageux", "img"=> "G" ),
			2 => array ( "desc"=> "nuageux", "img"=> "Y" ),
			3 => array ( "desc"=> "couvert", "img"=> "N" ),
			10 => array ( "desc"=> "brouillard", "img"=> "M" ),
			21 => array ( "desc"=> "pluie probable", "img"=> "Q" ),
			22 => array ( "desc"=> "neige probable", "img"=> "U" ),
			23 => array ( "desc"=> "neige probable", "img"=> "U" ),
			24 => array ( "desc"=> "gel probable", "img"=> "V" ),
			29 => array ( "desc"=> "orageux", "img"=> "P" ),
			38 => array ( "desc"=> "poudrerie", "img"=> "M" ),
			39 => array ( "desc"=> "blizzard", "img"=> "F" ),
			45 => array ( "desc"=> "brouillard", "img"=> "M" ),
			49 => array ( "desc"=> "brouillard givrant", "img"=> "M" ),
			50 => array ( "desc"=> "faible pluie", "img"=> "Q" ),
			51 => array ( "desc"=> "pluie fine", "img"=> "Q" ),
			56 => array ( "desc"=> "pluie verglaçante", "img"=> "Q" ),
			57 => array ( "desc"=> "pluie verglaçante", "img"=> "Q" ),
			60 => array ( "desc"=> "faible pluie", "img"=> "Q" ),
			61 => array ( "desc"=> "faible pluie", "img"=> "Q" ),
			62 => array ( "desc"=> "pluie modérée", "img"=> "Q" ),
			63 => array ( "desc"=> "pluie modérée", "img"=> "Q" ),
			64 => array ( "desc"=> "fortes précipitations", "img"=> "R" ),
			65 => array ( "desc"=> "fortes précipitations", "img"=> "R" ),
			66 => array ( "desc"=> "pluie verglaçante", "img"=> "Q" ),
			67 => array ( "desc"=> "pluie verglaçante", "img"=> "Q" ),
			68 => array ( "desc"=> "grésil", "img"=> "V" ),
			69 => array ( "desc"=> "grésil", "img"=> "V" ),
			70 => array ( "desc"=> "averses de neige", "img"=> "W" ),
			71 => array ( "desc"=> "averses de neige", "img"=> "W" ),
			72 => array ( "desc"=> "averses de neige", "img"=> "W" ),
			73 => array ( "desc"=> "averses de neige", "img"=> "W" ),
			74 => array ( "desc"=> "averses de neige", "img"=> "W" ),
			75 => array ( "desc"=> "averses de neige", "img"=> "W" ),
			79 => array ( "desc"=> "grêle", "img"=> "X" ),
			80 => array ( "desc"=> "pluie", "img"=> "R" ),
			81 => array ( "desc"=> "fortes pluies", "img"=> "R" ),
			82 => array ( "desc"=> "pluies torrentielles", "img"=> "R" ),
			83 => array ( "desc"=> "averses de neige", "img"=> "W" ),
			84 => array ( "desc"=> "averses de neige", "img"=> "W" ),
			85 => array ( "desc"=> "averses de neige", "img"=> "W" ),
			86 => array ( "desc"=> "averses de neige", "img"=> "W" ),
			87 => array ( "desc"=> "grêle", "img"=> "X" ),
			88 => array ( "desc"=> "grêle", "img"=> "X" ),
			91 => array ( "desc"=> "tempête", "img"=> "R" ),
			92 => array ( "desc"=> "tempête", "img"=> "R" ),
			93 => array ( "desc"=> "tempête", "img"=> "W" ),
			94 => array ( "desc"=> "tempête", "img"=> "W" ),) ;
			
			
			return $dataWeather[$params['codew']]['img'];
	}
	
}
