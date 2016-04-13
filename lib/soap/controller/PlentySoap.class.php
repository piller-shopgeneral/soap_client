<?php

// generated Wed, 13 Apr 2016 12:44:47 +0200


/**
 * plentymarkets SOAP-API controller class
 *
 * this is auto generated code, so do not change anything
 *
 * @class PlentySoap
 */
class PlentySoap extends SoapClient
{
	/**
	 *
	 * @var LoginInformation
	 */
	private $LoginInformation;
	
	public function __construct($wsdl="", $options=array())
	{
		if (!strlen($wsdl))
		{
			$wsdl = "http://fittaste24.plentymarkets-x1.com/plenty/api/soap/version115/?xml";
		}
		
		$options["features"] = SOAP_SINGLE_ELEMENT_ARRAYS;
		$options["version"] = SOAP_1_2;
		$options["classmap"] = array (
				  'PlentySoapRequest_GetAuthentificationToken' => 'PlentySoapRequest_GetAuthentificationToken',
				  'PlentySoapResponse_GetAuthentificationToken' => 'PlentySoapResponse_GetAuthentificationToken',
				  'PlentySoapResponse_GetServerTime' => 'PlentySoapResponse_GetServerTime',
				  'PlentySoapResponse_GetPlentyMarketsVersion' => 'PlentySoapResponse_GetPlentyMarketsVersion',
				  'PlentySoapRequest_GetVATConfig' => 'PlentySoapRequest_GetVATConfig',
				  'PlentySoapResponse_GetVATConfig' => 'PlentySoapResponse_GetVATConfig',
				  'PlentySoapResponse_GetDynamicFormats' => 'PlentySoapResponse_GetDynamicFormats',
				  'PlentySoapRequest_SetDynamicImport' => 'PlentySoapRequest_SetDynamicImport',
				  'PlentySoapResponse_SetDynamicImport' => 'PlentySoapResponse_SetDynamicImport',
				  'PlentySoapRequest_GetDynamicExport' => 'PlentySoapRequest_GetDynamicExport',
				  'PlentySoapResponse_GetDynamicExport' => 'PlentySoapResponse_GetDynamicExport',
				  'PlentySoapResponse_GetDynamicImportStack' => 'PlentySoapResponse_GetDynamicImportStack',
				  'PlentySoapRequest_GetWebshopSettings' => 'PlentySoapRequest_GetWebshopSettings',
				  'PlentySoapResponse_GetWebshopSettings' => 'PlentySoapResponse_GetWebshopSettings',
				  'PlentySoapRequest_GetCustomers' => 'PlentySoapRequest_GetCustomers',
				  'PlentySoapResponse_GetCustomers' => 'PlentySoapResponse_GetCustomers',
				  'PlentySoapRequest_GetCustomersNewsletterSubscriptions' => 'PlentySoapRequest_GetCustomersNewsletterSubscriptions',
				  'PlentySoapResponse_GetCustomersNewsletterSubscriptions' => 'PlentySoapResponse_GetCustomersNewsletterSubscriptions',
				  'PlentySoapRequest_GetCustomersSchedulers' => 'PlentySoapRequest_GetCustomersSchedulers',
				  'PlentySoapResponse_GetCustomersSchedulers' => 'PlentySoapResponse_GetCustomersSchedulers',
				  'PlentySoapRequest_SetCustomers' => 'PlentySoapRequest_SetCustomers',
				  'PlentySoapResponse_SetCustomers' => 'PlentySoapResponse_SetCustomers',
				  'PlentySoapRequest_GetCustomerNotes' => 'PlentySoapRequest_GetCustomerNotes',
				  'PlentySoapResponse_GetCustomerNotes' => 'PlentySoapResponse_GetCustomerNotes',
				  'PlentySoapRequest_AddCustomerNote' => 'PlentySoapRequest_AddCustomerNote',
				  'PlentySoapResponse_AddCustomerNote' => 'PlentySoapResponse_AddCustomerNote',
				  'PlentySoapRequest_SetBankCreditCardData' => 'PlentySoapRequest_SetBankCreditCardData',
				  'PlentySoapResponse_SetBankCreditCardData' => 'PlentySoapResponse_SetBankCreditCardData',
				  'PlentySoapRequest_GetCustomerOrders' => 'PlentySoapRequest_GetCustomerOrders',
				  'PlentySoapResponse_GetCustomerOrders' => 'PlentySoapResponse_GetCustomerOrders',
				  'PlentySoapRequest_GetCustomerDeliveryAddresses' => 'PlentySoapRequest_GetCustomerDeliveryAddresses',
				  'PlentySoapResponse_GetCustomerDeliveryAddresses' => 'PlentySoapResponse_GetCustomerDeliveryAddresses',
				  'PlentySoapRequest_SetCustomerDeliveryAddresses' => 'PlentySoapRequest_SetCustomerDeliveryAddresses',
				  'PlentySoapResponse_SetCustomerDeliveryAddresses' => 'PlentySoapResponse_SetCustomerDeliveryAddresses',
				  'PlentySoapResponse_GetCustomerClasses' => 'PlentySoapResponse_GetCustomerClasses',
				  'PlentySoapRequest_GetCountriesOfDelivery' => 'PlentySoapRequest_GetCountriesOfDelivery',
				  'PlentySoapResponse_GetCountriesOfDelivery' => 'PlentySoapResponse_GetCountriesOfDelivery',
				  'PlentySoapRequest_GetDeleteLog' => 'PlentySoapRequest_GetDeleteLog',
				  'PlentySoapResponse_GetDeleteLog' => 'PlentySoapResponse_GetDeleteLog',
				  'PlentySoapRequest_SetItemsDefaultCategories' => 'PlentySoapRequest_SetItemsDefaultCategories',
				  'PlentySoapResponse_SetItemsDefaultCategories' => 'PlentySoapResponse_SetItemsDefaultCategories',
				  'PlentySoapRequest_UpdateCategoriesBranches' => 'PlentySoapRequest_UpdateCategoriesBranches',
				  'PlentySoapResponse_UpdateCategoriesBranches' => 'PlentySoapResponse_UpdateCategoriesBranches',
				  'PlentySoapResponse_GetCategoryPreview' => 'PlentySoapResponse_GetCategoryPreview',
				  'PlentySoapRequest_DeleteCategories' => 'PlentySoapRequest_DeleteCategories',
				  'PlentySoapResponse_DeleteCategories' => 'PlentySoapResponse_DeleteCategories',
				  'PlentySoapRequest_SetCategories' => 'PlentySoapRequest_SetCategories',
				  'PlentySoapResponse_SetCategories' => 'PlentySoapResponse_SetCategories',
				  'PlentySoapRequest_GetCategories' => 'PlentySoapRequest_GetCategories',
				  'PlentySoapResponse_GetCategories' => 'PlentySoapResponse_GetCategories',
				  'PlentySoapRequest_GetCategoryBranchID' => 'PlentySoapRequest_GetCategoryBranchID',
				  'PlentySoapResponse_GetCategoryBranchID' => 'PlentySoapResponse_GetCategoryBranchID',
				  'PlentySoapRequest_SetItemsSuppliers' => 'PlentySoapRequest_SetItemsSuppliers',
				  'PlentySoapResponse_SetItemsSuppliers' => 'PlentySoapResponse_SetItemsSuppliers',
				  'PlentySoapRequest_GetMeasureUnitConfig' => 'PlentySoapRequest_GetMeasureUnitConfig',
				  'PlentySoapResponse_GetMeasureUnitConfig' => 'PlentySoapResponse_GetMeasureUnitConfig',
				  'PlentySoapRequest_DeleteItemsSuppliers' => 'PlentySoapRequest_DeleteItemsSuppliers',
				  'PlentySoapResponse_DeleteItemsSuppliers' => 'PlentySoapResponse_DeleteItemsSuppliers',
				  'PlentySoapRequest_GetItemsSuppliers' => 'PlentySoapRequest_GetItemsSuppliers',
				  'PlentySoapResponse_GetItemsSuppliers' => 'PlentySoapResponse_GetItemsSuppliers',
				  'PlentySoapRequest_DeleteLinkedItems' => 'PlentySoapRequest_DeleteLinkedItems',
				  'PlentySoapResponse_DeleteLinkedItems' => 'PlentySoapResponse_DeleteLinkedItems',
				  'PlentySoapRequest_SetLinkedItems' => 'PlentySoapRequest_SetLinkedItems',
				  'PlentySoapResponse_SetLinkedItems' => 'PlentySoapResponse_SetLinkedItems',
				  'PlentySoapRequest_AddItemMediaFile' => 'PlentySoapRequest_AddItemMediaFile',
				  'PlentySoapResponse_AddItemMediaFile' => 'PlentySoapResponse_AddItemMediaFile',
				  'PlentySoapRequest_DeleteItemMediaFiles' => 'PlentySoapRequest_DeleteItemMediaFiles',
				  'PlentySoapResponse_DeleteItemMediaFiles' => 'PlentySoapResponse_DeleteItemMediaFiles',
				  'PlentySoapRequest_GetItemsBase' => 'PlentySoapRequest_GetItemsBase',
				  'PlentySoapResponse_GetItemsBase' => 'PlentySoapResponse_GetItemsBase',
				  'PlentySoapRequest_GetItemsUpdated' => 'PlentySoapRequest_GetItemsUpdated',
				  'PlentySoapResponse_GetItemsUpdated' => 'PlentySoapResponse_GetItemsUpdated',
				  'PlentySoapRequest_GetItemsByStoreID' => 'PlentySoapRequest_GetItemsByStoreID',
				  'PlentySoapResponse_GetItemsByStoreID' => 'PlentySoapResponse_GetItemsByStoreID',
				  'PlentySoapRequest_SetItemsBase' => 'PlentySoapRequest_SetItemsBase',
				  'PlentySoapResponse_SetItemsBase' => 'PlentySoapResponse_SetItemsBase',
				  'PlentySoapRequest_SetItemsPurchasePrice' => 'PlentySoapRequest_SetItemsPurchasePrice',
				  'PlentySoapResponse_SetItemsPurchasePrice' => 'PlentySoapResponse_SetItemsPurchasePrice',
				  'PlentySoapRequest_DeleteItemsImages' => 'PlentySoapRequest_DeleteItemsImages',
				  'PlentySoapResponse_DeleteItemsImages' => 'PlentySoapResponse_DeleteItemsImages',
				  'PlentySoapRequest_GetItemCategoryCatalog' => 'PlentySoapRequest_GetItemCategoryCatalog',
				  'PlentySoapResponse_GetItemCategoryCatalog' => 'PlentySoapResponse_GetItemCategoryCatalog',
				  'PlentySoapRequest_SetItemCategory' => 'PlentySoapRequest_SetItemCategory',
				  'PlentySoapResponse_SetItemCategory' => 'PlentySoapResponse_SetItemCategory',
				  'PlentySoapRequest_SetItemImages' => 'PlentySoapRequest_SetItemImages',
				  'PlentySoapResponse_SetItemImages' => 'PlentySoapResponse_SetItemImages',
				  'PlentySoapRequest_GetItemsImages' => 'PlentySoapRequest_GetItemsImages',
				  'PlentySoapResponse_GetItemsImages' => 'PlentySoapResponse_GetItemsImages',
				  'PlentySoapRequest_GetItemsVariantImages' => 'PlentySoapRequest_GetItemsVariantImages',
				  'PlentySoapResponse_GetItemsVariantImages' => 'PlentySoapResponse_GetItemsVariantImages',
				  'PlentySoapRequest_GetItemsVariantsAvailable' => 'PlentySoapRequest_GetItemsVariantsAvailable',
				  'PlentySoapResponse_GetItemsVariantsAvailable' => 'PlentySoapResponse_GetItemsVariantsAvailable',
				  'PlentySoapRequest_GetProducers' => 'PlentySoapRequest_GetProducers',
				  'PlentySoapResponse_GetProducers' => 'PlentySoapResponse_GetProducers',
				  'PlentySoapResponse_GetItemsReturnStatus' => 'PlentySoapResponse_GetItemsReturnStatus',
				  'PlentySoapRequest_DeleteItems' => 'PlentySoapRequest_DeleteItems',
				  'PlentySoapResponse_DeleteItems' => 'PlentySoapResponse_DeleteItems',
				  'PlentySoapRequest_GetLinkedItems' => 'PlentySoapRequest_GetLinkedItems',
				  'PlentySoapResponse_GetLinkedItems' => 'PlentySoapResponse_GetLinkedItems',
				  'PlentySoapRequest_GetItemsPropertiesList' => 'PlentySoapRequest_GetItemsPropertiesList',
				  'PlentySoapResponse_GetItemsPropertiesList' => 'PlentySoapResponse_GetItemsPropertiesList',
				  'PlentySoapRequest_GetItemsPriceLists' => 'PlentySoapRequest_GetItemsPriceLists',
				  'PlentySoapResponse_GetItemsPriceLists' => 'PlentySoapResponse_GetItemsPriceLists',
				  'PlentySoapRequest_GetItemsPriceUpdate' => 'PlentySoapRequest_GetItemsPriceUpdate',
				  'PlentySoapResponse_GetItemsPriceUpdate' => 'PlentySoapResponse_GetItemsPriceUpdate',
				  'PlentySoapRequest_GetAttributeValueSets' => 'PlentySoapRequest_GetAttributeValueSets',
				  'PlentySoapResponse_GetAttributeValueSets' => 'PlentySoapResponse_GetAttributeValueSets',
				  'PlentySoapRequest_SetProducers' => 'PlentySoapRequest_SetProducers',
				  'PlentySoapResponse_SetProducers' => 'PlentySoapResponse_SetProducers',
				  'PlentySoapRequest_SetItemAttributes' => 'PlentySoapRequest_SetItemAttributes',
				  'PlentySoapResponse_SetItemAttributes' => 'PlentySoapResponse_SetItemAttributes',
				  'PlentySoapRequest_SetItemAttributeLinks' => 'PlentySoapRequest_SetItemAttributeLinks',
				  'PlentySoapResponse_SetItemAttributeLinks' => 'PlentySoapResponse_SetItemAttributeLinks',
				  'PlentySoapRequest_SetItemAttributeVariants' => 'PlentySoapRequest_SetItemAttributeVariants',
				  'PlentySoapResponse_SetItemAttributeVariants' => 'PlentySoapResponse_SetItemAttributeVariants',
				  'PlentySoapRequest_SetPriceSets' => 'PlentySoapRequest_SetPriceSets',
				  'PlentySoapResponse_SetPriceSets' => 'PlentySoapResponse_SetPriceSets',
				  'PlentySoapRequest_SetItemsAvailability' => 'PlentySoapRequest_SetItemsAvailability',
				  'PlentySoapResponse_SetItemsAvailability' => 'PlentySoapResponse_SetItemsAvailability',
				  'PlentySoapRequest_GetCategoryMappingForMarket' => 'PlentySoapRequest_GetCategoryMappingForMarket',
				  'PlentySoapResponse_GetCategoryMappingForMarket' => 'PlentySoapResponse_GetCategoryMappingForMarket',
				  'PlentySoapRequest_GetPropertyGroups' => 'PlentySoapRequest_GetPropertyGroups',
				  'PlentySoapResponse_GetPropertyGroups' => 'PlentySoapResponse_GetPropertyGroups',
				  'PlentySoapRequest_GetProperties' => 'PlentySoapRequest_GetProperties',
				  'PlentySoapResponse_GetProperties' => 'PlentySoapResponse_GetProperties',
				  'PlentySoapRequest_GetPropertiesList' => 'PlentySoapRequest_GetPropertiesList',
				  'PlentySoapResponse_GetPropertiesList' => 'PlentySoapResponse_GetPropertiesList',
				  'PlentySoapRequest_GetItemBundles' => 'PlentySoapRequest_GetItemBundles',
				  'PlentySoapResponse_GetItemBundles' => 'PlentySoapResponse_GetItemBundles',
				  'PlentySoapRequest_SetItemsToBundle' => 'PlentySoapRequest_SetItemsToBundle',
				  'PlentySoapResponse_SetItemsToBundle' => 'PlentySoapResponse_SetItemsToBundle',
				  'PlentySoapRequest_RemoveItemsFromBundle' => 'PlentySoapRequest_RemoveItemsFromBundle',
				  'PlentySoapResponse_RemoveItemsFromBundle' => 'PlentySoapResponse_RemoveItemsFromBundle',
				  'PlentySoapResponse_GetLinkPriceColumnToReferrer' => 'PlentySoapResponse_GetLinkPriceColumnToReferrer',
				  'PlentySoapRequest_GetItemCategoryTree' => 'PlentySoapRequest_GetItemCategoryTree',
				  'PlentySoapResponse_GetItemCategoryTree' => 'PlentySoapResponse_GetItemCategoryTree',
				  'PlentySoapRequest_SetAttributeValueSetsDetails' => 'PlentySoapRequest_SetAttributeValueSetsDetails',
				  'PlentySoapResponse_SetAttributeValueSetsDetails' => 'PlentySoapResponse_SetAttributeValueSetsDetails',
				  'PlentySoapResponse_GetItemAvailabilityConfig' => 'PlentySoapResponse_GetItemAvailabilityConfig',
				  'PlentySoapRequest_SetProperties' => 'PlentySoapRequest_SetProperties',
				  'PlentySoapResponse_SetProperties' => 'PlentySoapResponse_SetProperties',
				  'PlentySoapRequest_DeleteProperty' => 'PlentySoapRequest_DeleteProperty',
				  'PlentySoapResponse_DeleteProperty' => 'PlentySoapResponse_DeleteProperty',
				  'PlentySoapRequest_SetPropertyGroups' => 'PlentySoapRequest_SetPropertyGroups',
				  'PlentySoapResponse_SetPropertyGroups' => 'PlentySoapResponse_SetPropertyGroups',
				  'PlentySoapRequest_DeletePropertyGroup' => 'PlentySoapRequest_DeletePropertyGroup',
				  'PlentySoapResponse_DeletePropertyGroup' => 'PlentySoapResponse_DeletePropertyGroup',
				  'PlentySoapRequest_SetPropertiesToItem' => 'PlentySoapRequest_SetPropertiesToItem',
				  'PlentySoapResponse_SetPropertiesToItem' => 'PlentySoapResponse_SetPropertiesToItem',
				  'PlentySoapRequest_RemovePropertyFromItem' => 'PlentySoapRequest_RemovePropertyFromItem',
				  'PlentySoapResponse_RemovePropertyFromItem' => 'PlentySoapResponse_RemovePropertyFromItem',
				  'PlentySoapResponse_GetDefaultAttributeTypeForMarket' => 'PlentySoapResponse_GetDefaultAttributeTypeForMarket',
				  'PlentySoapRequest_DeletePriceSets' => 'PlentySoapRequest_DeletePriceSets',
				  'PlentySoapResponse_DeletePriceSets' => 'PlentySoapResponse_DeletePriceSets',
				  'PlentySoapRequest_GetMarketItemNumbers' => 'PlentySoapRequest_GetMarketItemNumbers',
				  'PlentySoapResponse_GetMarketItemNumbers' => 'PlentySoapResponse_GetMarketItemNumbers',
				  'PlentySoapRequest_SetMarketItemNumbers' => 'PlentySoapRequest_SetMarketItemNumbers',
				  'PlentySoapResponse_SetMarketItemNumbers' => 'PlentySoapResponse_SetMarketItemNumbers',
				  'PlentySoapRequest_GetItemAttributes' => 'PlentySoapRequest_GetItemAttributes',
				  'PlentySoapResponse_GetItemAttributes' => 'PlentySoapResponse_GetItemAttributes',
				  'PlentySoapRequest_SetItemsTexts' => 'PlentySoapRequest_SetItemsTexts',
				  'PlentySoapResponse_SetItemsTexts' => 'PlentySoapResponse_SetItemsTexts',
				  'PlentySoapRequest_GetItemsTexts' => 'PlentySoapRequest_GetItemsTexts',
				  'PlentySoapResponse_GetItemsTexts' => 'PlentySoapResponse_GetItemsTexts',
				  'PlentySoapRequest_DeleteItemAttribute' => 'PlentySoapRequest_DeleteItemAttribute',
				  'PlentySoapResponse_DeleteItemAttribute' => 'PlentySoapResponse_DeleteItemAttribute',
				  'PlentySoapRequest_SearchItemsSKU' => 'PlentySoapRequest_SearchItemsSKU',
				  'PlentySoapResponse_SearchItemsSKU' => 'PlentySoapResponse_SearchItemsSKU',
				  'PlentySoapRequest_SetItemsFreeTextFields' => 'PlentySoapRequest_SetItemsFreeTextFields',
				  'PlentySoapResponse_SetItemsFreeTextFields' => 'PlentySoapResponse_SetItemsFreeTextFields',
				  'PlentySoapRequest_SetStoreCategories' => 'PlentySoapRequest_SetStoreCategories',
				  'PlentySoapResponse_SetStoreCategories' => 'PlentySoapResponse_SetStoreCategories',
				  'PlentySoapRequest_SetItemsWarehouseSettings' => 'PlentySoapRequest_SetItemsWarehouseSettings',
				  'PlentySoapResponse_SetItemsWarehouseSettings' => 'PlentySoapResponse_SetItemsWarehouseSettings',
				  'PlentySoapRequest_GetItemsWarehouseSettings' => 'PlentySoapRequest_GetItemsWarehouseSettings',
				  'PlentySoapResponse_GetItemsWarehouseSettings' => 'PlentySoapResponse_GetItemsWarehouseSettings',
				  'PlentySoapRequest_GetItemsPreviewLink' => 'PlentySoapRequest_GetItemsPreviewLink',
				  'PlentySoapResponse_GetItemsPreviewLink' => 'PlentySoapResponse_GetItemsPreviewLink',
				  'PlentySoapRequest_GetItemsSearchData' => 'PlentySoapRequest_GetItemsSearchData',
				  'PlentySoapResponse_GetItemsSearchData' => 'PlentySoapResponse_GetItemsSearchData',
				  'PlentySoapRequest_GetItemsDefaultShippingCost' => 'PlentySoapRequest_GetItemsDefaultShippingCost',
				  'PlentySoapResponse_GetItemsDefaultShippingCost' => 'PlentySoapResponse_GetItemsDefaultShippingCost',
				  'PlentySoapRequest_AddOrderNotes' => 'PlentySoapRequest_AddOrderNotes',
				  'PlentySoapResponse_AddOrderNotes' => 'PlentySoapResponse_AddOrderNotes',
				  'PlentySoapRequest_SetDeliveryOrders' => 'PlentySoapRequest_SetDeliveryOrders',
				  'PlentySoapResponse_SetDeliveryOrders' => 'PlentySoapResponse_SetDeliveryOrders',
				  'PlentySoapRequest_GetDeliveryOrders' => 'PlentySoapRequest_GetDeliveryOrders',
				  'PlentySoapResponse_GetDeliveryOrders' => 'PlentySoapResponse_GetDeliveryOrders',
				  'PlentySoapRequest_AddDocument' => 'PlentySoapRequest_AddDocument',
				  'PlentySoapResponse_AddDocument' => 'PlentySoapResponse_AddDocument',
				  'PlentySoapRequest_GetOrderDocument' => 'PlentySoapRequest_GetOrderDocument',
				  'PlentySoapResponse_GetOrderDocument' => 'PlentySoapResponse_GetOrderDocument',
				  'PlentySoapRequest_SetOrderStatus' => 'PlentySoapRequest_SetOrderStatus',
				  'PlentySoapResponse_SetOrderStatus' => 'PlentySoapResponse_SetOrderStatus',
				  'PlentySoapRequest_GetOrderStatusList' => 'PlentySoapRequest_GetOrderStatusList',
				  'PlentySoapResponse_GetOrderStatusList' => 'PlentySoapResponse_GetOrderStatusList',
				  'PlentySoapRequest_AddOrders' => 'PlentySoapRequest_AddOrders',
				  'PlentySoapResponse_AddOrders' => 'PlentySoapResponse_AddOrders',
				  'PlentySoapRequest_DeleteOrderItems' => 'PlentySoapRequest_DeleteOrderItems',
				  'PlentySoapResponse_DeleteOrderItems' => 'PlentySoapResponse_DeleteOrderItems',
				  'PlentySoapRequest_SetOrderItems' => 'PlentySoapRequest_SetOrderItems',
				  'PlentySoapResponse_SetOrderItems' => 'PlentySoapResponse_SetOrderItems',
				  'PlentySoapRequest_SetOrdersHead' => 'PlentySoapRequest_SetOrdersHead',
				  'PlentySoapResponse_SetOrdersHead' => 'PlentySoapResponse_SetOrdersHead',
				  'PlentySoapRequest_SetBookOutgoingItems' => 'PlentySoapRequest_SetBookOutgoingItems',
				  'PlentySoapResponse_SetBookOutgoingItems' => 'PlentySoapResponse_SetBookOutgoingItems',
				  'PlentySoapRequest_SetBackPostOutgoingItems' => 'PlentySoapRequest_SetBackPostOutgoingItems',
				  'PlentySoapResponse_SetBackPostOutgoingItems' => 'PlentySoapResponse_SetBackPostOutgoingItems',
				  'PlentySoapRequest_AddOrdersPackageNumber' => 'PlentySoapRequest_AddOrdersPackageNumber',
				  'PlentySoapResponse_AddOrdersPackageNumber' => 'PlentySoapResponse_AddOrdersPackageNumber',
				  'PlentySoapRequest_DeleteOrderPackageNumber' => 'PlentySoapRequest_DeleteOrderPackageNumber',
				  'PlentySoapResponse_DeleteOrderPackageNumber' => 'PlentySoapResponse_DeleteOrderPackageNumber',
				  'PlentySoapRequest_GetOrdersPaymentInformation' => 'PlentySoapRequest_GetOrdersPaymentInformation',
				  'PlentySoapResponse_GetOrdersPaymentInformation' => 'PlentySoapResponse_GetOrdersPaymentInformation',
				  'PlentySoapRequest_GetOrdersShipmentNumbers' => 'PlentySoapRequest_GetOrdersShipmentNumbers',
				  'PlentySoapResponse_GetOrdersShipmentNumbers' => 'PlentySoapResponse_GetOrdersShipmentNumbers',
				  'PlentySoapRequest_SearchOrders' => 'PlentySoapRequest_SearchOrders',
				  'PlentySoapResponse_SearchOrders' => 'PlentySoapResponse_SearchOrders',
				  'PlentySoapRequest_GetMethodOfPayments' => 'PlentySoapRequest_GetMethodOfPayments',
				  'PlentySoapResponse_GetMethodOfPayments' => 'PlentySoapResponse_GetMethodOfPayments',
				  'PlentySoapRequest_AddIncomingPayments' => 'PlentySoapRequest_AddIncomingPayments',
				  'PlentySoapResponse_AddIncomingPayments' => 'PlentySoapResponse_AddIncomingPayments',
				  'PlentySoapRequest_GetIncomingPayments' => 'PlentySoapRequest_GetIncomingPayments',
				  'PlentySoapResponse_GetIncomingPayments' => 'PlentySoapResponse_GetIncomingPayments',
				  'PlentySoapResponse_GetShippingServiceProvider' => 'PlentySoapResponse_GetShippingServiceProvider',
				  'PlentySoapRequest_GetShippingProfiles' => 'PlentySoapRequest_GetShippingProfiles',
				  'PlentySoapResponse_GetShippingProfiles' => 'PlentySoapResponse_GetShippingProfiles',
				  'PlentySoapRequest_GetShippingProfileConfigurations' => 'PlentySoapRequest_GetShippingProfileConfigurations',
				  'PlentySoapResponse_GetShippingProfileConfigurations' => 'PlentySoapResponse_GetShippingProfileConfigurations',
				  'PlentySoapRequest_AddShippingProfile' => 'PlentySoapRequest_AddShippingProfile',
				  'PlentySoapResponse_AddShippingProfile' => 'PlentySoapResponse_AddShippingProfile',
				  'PlentySoapResponse_GetSalesOrderReferrer' => 'PlentySoapResponse_GetSalesOrderReferrer',
				  'PlentySoapRequest_GetEmailTemplate' => 'PlentySoapRequest_GetEmailTemplate',
				  'PlentySoapResponse_GetEmailTemplate' => 'PlentySoapResponse_GetEmailTemplate',
				  'PlentySoapRequest_DeleteEmailTemplates' => 'PlentySoapRequest_DeleteEmailTemplates',
				  'PlentySoapResponse_DeleteEmailTemplates' => 'PlentySoapResponse_DeleteEmailTemplates',
				  'PlentySoapRequest_SetEmailTemplates' => 'PlentySoapRequest_SetEmailTemplates',
				  'PlentySoapResponse_SetEmailTemplates' => 'PlentySoapResponse_SetEmailTemplates',
				  'PlentySoapRequest_GetEmailTemplates' => 'PlentySoapRequest_GetEmailTemplates',
				  'PlentySoapResponse_GetEmailTemplates' => 'PlentySoapResponse_GetEmailTemplates',
				  'PlentySoapRequest_GetOrdersInvoiceDocumentURLs' => 'PlentySoapRequest_GetOrdersInvoiceDocumentURLs',
				  'PlentySoapResponse_GetOrdersInvoiceDocumentURLs' => 'PlentySoapResponse_GetOrdersInvoiceDocumentURLs',
				  'PlentySoapRequest_GetOrdersCreditNoteDocumentURLs' => 'PlentySoapRequest_GetOrdersCreditNoteDocumentURLs',
				  'PlentySoapResponse_GetOrdersCreditNoteDocumentURLs' => 'PlentySoapResponse_GetOrdersCreditNoteDocumentURLs',
				  'PlentySoapRequest_GetOrdersDeliveryNoteDocumentURLs' => 'PlentySoapRequest_GetOrdersDeliveryNoteDocumentURLs',
				  'PlentySoapResponse_GetOrdersDeliveryNoteDocumentURLs' => 'PlentySoapResponse_GetOrdersDeliveryNoteDocumentURLs',
				  'PlentySoapRequest_GetOrdersDunningLetterDocumentURLs' => 'PlentySoapRequest_GetOrdersDunningLetterDocumentURLs',
				  'PlentySoapResponse_GetOrdersDunningLetterDocumentURLs' => 'PlentySoapResponse_GetOrdersDunningLetterDocumentURLs',
				  'PlentySoapRequest_GetOrdersOfferDocumentURLs' => 'PlentySoapRequest_GetOrdersOfferDocumentURLs',
				  'PlentySoapResponse_GetOrdersOfferDocumentURLs' => 'PlentySoapResponse_GetOrdersOfferDocumentURLs',
				  'PlentySoapRequest_GetOrdersOrderConfirmationDocumentURLs' => 'PlentySoapRequest_GetOrdersOrderConfirmationDocumentURLs',
				  'PlentySoapResponse_GetOrdersOrderConfirmationDocumentURLs' => 'PlentySoapResponse_GetOrdersOrderConfirmationDocumentURLs',
				  'PlentySoapRequest_GetReturns' => 'PlentySoapRequest_GetReturns',
				  'PlentySoapResponse_GetReturns' => 'PlentySoapResponse_GetReturns',
				  'PlentySoapRequest_SetReturns' => 'PlentySoapRequest_SetReturns',
				  'PlentySoapResponse_SetReturns' => 'PlentySoapResponse_SetReturns',
				  'PlentySoapRequest_SetRepairs' => 'PlentySoapRequest_SetRepairs',
				  'PlentySoapResponse_SetRepairs' => 'PlentySoapResponse_SetRepairs',
				  'PlentySoapRequest_SetCreditNotes' => 'PlentySoapRequest_SetCreditNotes',
				  'PlentySoapResponse_SetCreditNotes' => 'PlentySoapResponse_SetCreditNotes',
				  'PlentySoapRequest_SetWarranties' => 'PlentySoapRequest_SetWarranties',
				  'PlentySoapResponse_SetWarranties' => 'PlentySoapResponse_SetWarranties',
				  'PlentySoapResponse_GetReasonsForReturn' => 'PlentySoapResponse_GetReasonsForReturn',
				  'PlentySoapRequest_SetReorders' => 'PlentySoapRequest_SetReorders',
				  'PlentySoapResponse_SetReorders' => 'PlentySoapResponse_SetReorders',
				  'PlentySoapRequest_GetReorder' => 'PlentySoapRequest_GetReorder',
				  'PlentySoapResponse_GetReorder' => 'PlentySoapResponse_GetReorder',
				  'PlentySoapRequest_DeleteReorder' => 'PlentySoapRequest_DeleteReorder',
				  'PlentySoapResponse_DeleteReorder' => 'PlentySoapResponse_DeleteReorder',
				  'PlentySoapRequest_GetMarketplaceTransactions' => 'PlentySoapRequest_GetMarketplaceTransactions',
				  'PlentySoapResponse_GetMarketplaceTransactions' => 'PlentySoapResponse_GetMarketplaceTransactions',
				  'PlentySoapRequest_GetOrderStatusHistory' => 'PlentySoapRequest_GetOrderStatusHistory',
				  'PlentySoapResponse_GetOrderStatusHistory' => 'PlentySoapResponse_GetOrderStatusHistory',
				  'PlentySoapRequest_AddOrderStatusHistory' => 'PlentySoapRequest_AddOrderStatusHistory',
				  'PlentySoapResponse_AddOrderStatusHistory' => 'PlentySoapResponse_AddOrderStatusHistory',
				  'PlentySoapRequest_AddDeliveryOrder' => 'PlentySoapRequest_AddDeliveryOrder',
				  'PlentySoapResponse_AddDeliveryOrder' => 'PlentySoapResponse_AddDeliveryOrder',
				  'PlentySoapRequest_GetCustomerOrderOverviewLink' => 'PlentySoapRequest_GetCustomerOrderOverviewLink',
				  'PlentySoapResponse_GetCustomerOrderOverviewLink' => 'PlentySoapResponse_GetCustomerOrderOverviewLink',
				  'PlentySoapRequest_SetShipmentRegistration' => 'PlentySoapRequest_SetShipmentRegistration',
				  'PlentySoapResponse_SetShipmentRegistration' => 'PlentySoapResponse_SetShipmentRegistration',
				  'PlentySoapRequest_GetOrderCheckout' => 'PlentySoapRequest_GetOrderCheckout',
				  'PlentySoapResponse_GetOrderCheckout' => 'PlentySoapResponse_GetOrderCheckout',
				  'PlentySoapRequest_GetDeliveryCharges' => 'PlentySoapRequest_GetDeliveryCharges',
				  'PlentySoapResponse_GetDeliveryCharges' => 'PlentySoapResponse_GetDeliveryCharges',
				  'PlentySoapRequest_GetPartsCompatibilityListings' => 'PlentySoapRequest_GetPartsCompatibilityListings',
				  'PlentySoapResponse_GetPartsCompatibilityListings' => 'PlentySoapResponse_GetPartsCompatibilityListings',
				  'PlentySoapRequest_SetPartsCompatibilityListings' => 'PlentySoapRequest_SetPartsCompatibilityListings',
				  'PlentySoapResponse_SetPartsCompatibilityListings' => 'PlentySoapResponse_SetPartsCompatibilityListings',
				  'PlentySoapRequest_GetListings' => 'PlentySoapRequest_GetListings',
				  'PlentySoapResponse_GetListings' => 'PlentySoapResponse_GetListings',
				  'PlentySoapRequest_UpdateListingsStop' => 'PlentySoapRequest_UpdateListingsStop',
				  'PlentySoapResponse_UpdateListingsStop' => 'PlentySoapResponse_UpdateListingsStop',
				  'PlentySoapRequest_UpdateListingsStart' => 'PlentySoapRequest_UpdateListingsStart',
				  'PlentySoapResponse_UpdateListingsStart' => 'PlentySoapResponse_UpdateListingsStart',
				  'PlentySoapRequest_UpdateListingsUpdate' => 'PlentySoapRequest_UpdateListingsUpdate',
				  'PlentySoapResponse_UpdateListingsUpdate' => 'PlentySoapResponse_UpdateListingsUpdate',
				  'PlentySoapRequest_UpdateListingsVerify' => 'PlentySoapRequest_UpdateListingsVerify',
				  'PlentySoapResponse_UpdateListingsVerify' => 'PlentySoapResponse_UpdateListingsVerify',
				  'PlentySoapRequest_UpdateListingsRelist' => 'PlentySoapRequest_UpdateListingsRelist',
				  'PlentySoapResponse_UpdateListingsRelist' => 'PlentySoapResponse_UpdateListingsRelist',
				  'PlentySoapRequest_GetMarketStoreCategories' => 'PlentySoapRequest_GetMarketStoreCategories',
				  'PlentySoapResponse_GetMarketStoreCategories' => 'PlentySoapResponse_GetMarketStoreCategories',
				  'PlentySoapRequest_GetMarketShippingProfiles' => 'PlentySoapRequest_GetMarketShippingProfiles',
				  'PlentySoapResponse_GetMarketShippingProfiles' => 'PlentySoapResponse_GetMarketShippingProfiles',
				  'PlentySoapRequest_GetMarketLogs' => 'PlentySoapRequest_GetMarketLogs',
				  'PlentySoapResponse_GetMarketLogs' => 'PlentySoapResponse_GetMarketLogs',
				  'PlentySoapRequest_GetMarketDirectories' => 'PlentySoapRequest_GetMarketDirectories',
				  'PlentySoapResponse_GetMarketDirectories' => 'PlentySoapResponse_GetMarketDirectories',
				  'PlentySoapRequest_GetMarketAccounts' => 'PlentySoapRequest_GetMarketAccounts',
				  'PlentySoapResponse_GetMarketAccounts' => 'PlentySoapResponse_GetMarketAccounts',
				  'PlentySoapRequest_DeleteListingsTemplates' => 'PlentySoapRequest_DeleteListingsTemplates',
				  'PlentySoapResponse_DeleteListingsTemplates' => 'PlentySoapResponse_DeleteListingsTemplates',
				  'PlentySoapRequest_GetListingsTemplates' => 'PlentySoapRequest_GetListingsTemplates',
				  'PlentySoapResponse_GetListingsTemplates' => 'PlentySoapResponse_GetListingsTemplates',
				  'PlentySoapRequest_SetListingsTemplates' => 'PlentySoapRequest_SetListingsTemplates',
				  'PlentySoapResponse_SetListingsTemplates' => 'PlentySoapResponse_SetListingsTemplates',
				  'PlentySoapRequest_GetListingsProperties' => 'PlentySoapRequest_GetListingsProperties',
				  'PlentySoapResponse_GetListingsProperties' => 'PlentySoapResponse_GetListingsProperties',
				  'PlentySoapRequest_GetListingsLayoutTemplates' => 'PlentySoapRequest_GetListingsLayoutTemplates',
				  'PlentySoapResponse_GetListingsLayoutTemplates' => 'PlentySoapResponse_GetListingsLayoutTemplates',
				  'PlentySoapRequest_DeleteListingsProperties' => 'PlentySoapRequest_DeleteListingsProperties',
				  'PlentySoapResponse_DeleteListingsProperties' => 'PlentySoapResponse_DeleteListingsProperties',
				  'PlentySoapRequest_DeleteListingsLayoutTemplates' => 'PlentySoapRequest_DeleteListingsLayoutTemplates',
				  'PlentySoapResponse_DeleteListingsLayoutTemplates' => 'PlentySoapResponse_DeleteListingsLayoutTemplates',
				  'PlentySoapRequest_SetListingsLayoutTemplates' => 'PlentySoapRequest_SetListingsLayoutTemplates',
				  'PlentySoapResponse_SetListingsLayoutTemplates' => 'PlentySoapResponse_SetListingsLayoutTemplates',
				  'PlentySoapRequest_SetListings' => 'PlentySoapRequest_SetListings',
				  'PlentySoapResponse_SetListings' => 'PlentySoapResponse_SetListings',
				  'PlentySoapRequest_SetMarketListings' => 'PlentySoapRequest_SetMarketListings',
				  'PlentySoapResponse_SetMarketListings' => 'PlentySoapResponse_SetMarketListings',
				  'PlentySoapRequest_GetMarketListingItemVariants' => 'PlentySoapRequest_GetMarketListingItemVariants',
				  'PlentySoapResponse_GetMarketListingItemVariants' => 'PlentySoapResponse_GetMarketListingItemVariants',
				  'PlentySoapRequest_GetCurrentStocks' => 'PlentySoapRequest_GetCurrentStocks',
				  'PlentySoapResponse_GetCurrentStocks' => 'PlentySoapResponse_GetCurrentStocks',
				  'PlentySoapRequest_SetCurrentStocks' => 'PlentySoapRequest_SetCurrentStocks',
				  'PlentySoapResponse_SetCurrentStocks' => 'PlentySoapResponse_SetCurrentStocks',
				  'PlentySoapRequest_SetIncomingStocks' => 'PlentySoapRequest_SetIncomingStocks',
				  'PlentySoapResponse_SetIncomingStocks' => 'PlentySoapResponse_SetIncomingStocks',
				  'PlentySoapRequest_SetStocksTransfer' => 'PlentySoapRequest_SetStocksTransfer',
				  'PlentySoapResponse_SetStocksTransfer' => 'PlentySoapResponse_SetStocksTransfer',
				  'PlentySoapRequest_GetWarehouseList' => 'PlentySoapRequest_GetWarehouseList',
				  'PlentySoapResponse_GetWarehouseList' => 'PlentySoapResponse_GetWarehouseList',
				  'PlentySoapRequest_GetRacksList' => 'PlentySoapRequest_GetRacksList',
				  'PlentySoapResponse_GetRacksList' => 'PlentySoapResponse_GetRacksList',
				  'PlentySoapRequest_GetWarehouseItem' => 'PlentySoapRequest_GetWarehouseItem',
				  'PlentySoapResponse_GetWarehouseItem' => 'PlentySoapResponse_GetWarehouseItem',
				  'PlentySoapRequest_GetCurrentStocks4Marketplace' => 'PlentySoapRequest_GetCurrentStocks4Marketplace',
				  'PlentySoapResponse_GetCurrentStocks4Marketplace' => 'PlentySoapResponse_GetCurrentStocks4Marketplace',
				  'PlentySoapResponse_GetMultiShops' => 'PlentySoapResponse_GetMultiShops',
				  'PlentySoapRequest_GetWarehouseStorageLocation' => 'PlentySoapRequest_GetWarehouseStorageLocation',
				  'PlentySoapResponse_GetWarehouseStorageLocation' => 'PlentySoapResponse_GetWarehouseStorageLocation',
				  'PlentySoapRequest_GetItemsStock' => 'PlentySoapRequest_GetItemsStock',
				  'PlentySoapResponse_GetItemsStock' => 'PlentySoapResponse_GetItemsStock',
				  'PlentySoapRequest_GetItemsStockSearch' => 'PlentySoapRequest_GetItemsStockSearch',
				  'PlentySoapResponse_GetItemsStockSearch' => 'PlentySoapResponse_GetItemsStockSearch',
				  'PlentySoapRequest_GetStockMovements' => 'PlentySoapRequest_GetStockMovements',
				  'PlentySoapResponse_GetStockMovements' => 'PlentySoapResponse_GetStockMovements',
				  'PlentySoapRequest_SetWarehouse' => 'PlentySoapRequest_SetWarehouse',
				  'PlentySoapResponse_SetWarehouse' => 'PlentySoapResponse_SetWarehouse',
				  'PlentySoapRequest_GetContentPage' => 'PlentySoapRequest_GetContentPage',
				  'PlentySoapResponse_GetContentPage' => 'PlentySoapResponse_GetContentPage',
				  'PlentySoapRequest_SetContentPages' => 'PlentySoapRequest_SetContentPages',
				  'PlentySoapResponse_SetContentPages' => 'PlentySoapResponse_SetContentPages',
				  'PlentySoapRequest_AddTicket' => 'PlentySoapRequest_AddTicket',
				  'PlentySoapResponse_AddTicket' => 'PlentySoapResponse_AddTicket',
				  'PlentySoapRequest_AddTicketLeafe' => 'PlentySoapRequest_AddTicketLeafe',
				  'PlentySoapResponse_AddTicketLeafe' => 'PlentySoapResponse_AddTicketLeafe',
				  'PlentySoapRequest_GetTermsAndCancellation' => 'PlentySoapRequest_GetTermsAndCancellation',
				  'PlentySoapResponse_GetTermsAndCancellation' => 'PlentySoapResponse_GetTermsAndCancellation',
				  'PlentySoapRequest_SetTermsAndCancellation' => 'PlentySoapRequest_SetTermsAndCancellation',
				  'PlentySoapResponse_SetTermsAndCancellation' => 'PlentySoapResponse_SetTermsAndCancellation',
				  'PlentySoapRequest_GetLegalInformation' => 'PlentySoapRequest_GetLegalInformation',
				  'PlentySoapResponse_GetLegalInformation' => 'PlentySoapResponse_GetLegalInformation',
				  'PlentySoapRequest_SetLegalInformation' => 'PlentySoapRequest_SetLegalInformation',
				  'PlentySoapResponse_SetLegalInformation' => 'PlentySoapResponse_SetLegalInformation',
				  'PlentySoapRequest_GetReportingFile' => 'PlentySoapRequest_GetReportingFile',
				  'PlentySoapResponse_GetReportingFile' => 'PlentySoapResponse_GetReportingFile',
				  'PlentySoapRequest_GetFolderEmails' => 'PlentySoapRequest_GetFolderEmails',
				  'PlentySoapResponse_GetFolderEmails' => 'PlentySoapResponse_GetFolderEmails',
				  'PlentySoapRequest_GetEmailFolderList' => 'PlentySoapRequest_GetEmailFolderList',
				  'PlentySoapResponse_GetEmailFolderList' => 'PlentySoapResponse_GetEmailFolderList',
				  'PlentySoapRequest_SetAutonomousReturns' => 'PlentySoapRequest_SetAutonomousReturns',
				  'PlentySoapResponse_SetAutonomousReturns' => 'PlentySoapResponse_SetAutonomousReturns',
				  'PlentySoapRequest_GetCampaignList' => 'PlentySoapRequest_GetCampaignList',
				  'PlentySoapResponse_GetCampaignList' => 'PlentySoapResponse_GetCampaignList',
				  'PlentySoapRequest_GetCouponListOfCampaign' => 'PlentySoapRequest_GetCouponListOfCampaign',
				  'PlentySoapResponse_GetCouponListOfCampaign' => 'PlentySoapResponse_GetCouponListOfCampaign',
				  'PlentySoapRequest_ValidateCoupons' => 'PlentySoapRequest_ValidateCoupons',
				  'PlentySoapResponse_ValidateCoupons' => 'PlentySoapResponse_ValidateCoupons',
				  'PlentySoapRequest_GetItemMediaFiles' => 'PlentySoapRequest_GetItemMediaFiles',
				  'PlentySoapResponse_GetItemMediaFiles' => 'PlentySoapResponse_GetItemMediaFiles',
				  'PlentySoapRequest_SetDynamicExport' => 'PlentySoapRequest_SetDynamicExport',
				  'PlentySoapResponse_SetDynamicExport' => 'PlentySoapResponse_SetDynamicExport',
				);
		parent::__construct($wsdl, $options);
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetAuthentificationToken GetAuthentificationToken(PlentySoapRequest_GetAuthentificationToken $oLogin)
	 *
	 * @param PlentySoapRequest_GetAuthentificationToken $oLogin
	 *
	 * @return PlentySoapResponse_GetAuthentificationToken
	 */
	public function GetAuthentificationToken(PlentySoapRequest_GetAuthentificationToken $oLogin)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetAuthentificationToken.class.php");
		return parent::__soapCall("GetAuthentificationToken",array($oLogin));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetServerTime GetServerTime()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetServerTime
	 */
	public function GetServerTime()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetServerTime.class.php");
		return parent::__soapCall("GetServerTime",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetPlentyMarketsVersion GetPlentyMarketsVersion()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetPlentyMarketsVersion
	 */
	public function GetPlentyMarketsVersion()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetPlentyMarketsVersion.class.php");
		return parent::__soapCall("GetPlentyMarketsVersion",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetVATConfig GetVATConfig(PlentySoapRequest_GetVATConfig $oVatConfig)
	 *
	 * @param PlentySoapRequest_GetVATConfig $oVatConfig
	 *
	 * @return PlentySoapResponse_GetVATConfig
	 */
	public function GetVATConfig(PlentySoapRequest_GetVATConfig $oVatConfig)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetVATConfig.class.php");
		return parent::__soapCall("GetVATConfig",array($oVatConfig));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetDynamicFormats GetDynamicFormats()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetDynamicFormats
	 */
	public function GetDynamicFormats()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetDynamicFormats.class.php");
		return parent::__soapCall("GetDynamicFormats",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetDynamicImport SetDynamicImport(PlentySoapRequest_SetDynamicImport $oPlentySoapRequest_SetDynamicImport)
	 *
	 * @param PlentySoapRequest_SetDynamicImport $oPlentySoapRequest_SetDynamicImport
	 *
	 * @return PlentySoapResponse_SetDynamicImport
	 */
	public function SetDynamicImport(PlentySoapRequest_SetDynamicImport $oPlentySoapRequest_SetDynamicImport)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetDynamicImport.class.php");
		return parent::__soapCall("SetDynamicImport",array($oPlentySoapRequest_SetDynamicImport));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetDynamicExport GetDynamicExport(PlentySoapRequest_GetDynamicExport $oPlentySoapRequest_GetDynamicExport)
	 *
	 * @param PlentySoapRequest_GetDynamicExport $oPlentySoapRequest_GetDynamicExport
	 *
	 * @return PlentySoapResponse_GetDynamicExport
	 */
	public function GetDynamicExport(PlentySoapRequest_GetDynamicExport $oPlentySoapRequest_GetDynamicExport)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetDynamicExport.class.php");
		return parent::__soapCall("GetDynamicExport",array($oPlentySoapRequest_GetDynamicExport));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetDynamicImportStack GetDynamicImportStack()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetDynamicImportStack
	 */
	public function GetDynamicImportStack()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetDynamicImportStack.class.php");
		return parent::__soapCall("GetDynamicImportStack",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetWebshopSettings GetWebshopSettings(PlentySoapRequest_GetWebshopSettings $oPlentySoapRequest_GetWebshopSettings)
	 *
	 * @param PlentySoapRequest_GetWebshopSettings $oPlentySoapRequest_GetWebshopSettings
	 *
	 * @return PlentySoapResponse_GetWebshopSettings
	 */
	public function GetWebshopSettings(PlentySoapRequest_GetWebshopSettings $oPlentySoapRequest_GetWebshopSettings)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetWebshopSettings.class.php");
		return parent::__soapCall("GetWebshopSettings",array($oPlentySoapRequest_GetWebshopSettings));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCustomers GetCustomers(PlentySoapRequest_GetCustomers $oCustomersRequest)
	 *
	 * @param PlentySoapRequest_GetCustomers $oCustomersRequest
	 *
	 * @return PlentySoapResponse_GetCustomers
	 */
	public function GetCustomers(PlentySoapRequest_GetCustomers $oCustomersRequest)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCustomers.class.php");
		return parent::__soapCall("GetCustomers",array($oCustomersRequest));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCustomersNewsletterSubscriptions GetCustomersNewsletterSubscriptions(PlentySoapRequest_GetCustomersNewsletterSubscriptions $oCustomersNewsletterSubscriptionsRequest)
	 *
	 * @param PlentySoapRequest_GetCustomersNewsletterSubscriptions $oCustomersNewsletterSubscriptionsRequest
	 *
	 * @return PlentySoapResponse_GetCustomersNewsletterSubscriptions
	 */
	public function GetCustomersNewsletterSubscriptions(PlentySoapRequest_GetCustomersNewsletterSubscriptions $oCustomersNewsletterSubscriptionsRequest)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCustomersNewsletterSubscriptions.class.php");
		return parent::__soapCall("GetCustomersNewsletterSubscriptions",array($oCustomersNewsletterSubscriptionsRequest));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCustomersSchedulers GetCustomersSchedulers(PlentySoapRequest_GetCustomersSchedulers $oCustomersSchedulersRequest)
	 *
	 * @param PlentySoapRequest_GetCustomersSchedulers $oCustomersSchedulersRequest
	 *
	 * @return PlentySoapResponse_GetCustomersSchedulers
	 */
	public function GetCustomersSchedulers(PlentySoapRequest_GetCustomersSchedulers $oCustomersSchedulersRequest)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCustomersSchedulers.class.php");
		return parent::__soapCall("GetCustomersSchedulers",array($oCustomersSchedulersRequest));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetCustomers SetCustomers(PlentySoapRequest_SetCustomers $oSetCustomerRequest)
	 *
	 * @param PlentySoapRequest_SetCustomers $oSetCustomerRequest
	 *
	 * @return PlentySoapResponse_SetCustomers
	 */
	public function SetCustomers(PlentySoapRequest_SetCustomers $oSetCustomerRequest)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetCustomers.class.php");
		return parent::__soapCall("SetCustomers",array($oSetCustomerRequest));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCustomerNotes GetCustomerNotes(PlentySoapRequest_GetCustomerNotes $oGetCustomerNotesRequest)
	 *
	 * @param PlentySoapRequest_GetCustomerNotes $oGetCustomerNotesRequest
	 *
	 * @return PlentySoapResponse_GetCustomerNotes
	 */
	public function GetCustomerNotes(PlentySoapRequest_GetCustomerNotes $oGetCustomerNotesRequest)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCustomerNotes.class.php");
		return parent::__soapCall("GetCustomerNotes",array($oGetCustomerNotesRequest));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_AddCustomerNote AddCustomerNote(PlentySoapRequest_AddCustomerNote $oAddCustomerNotesRequest)
	 *
	 * @param PlentySoapRequest_AddCustomerNote $oAddCustomerNotesRequest
	 *
	 * @return PlentySoapResponse_AddCustomerNote
	 */
	public function AddCustomerNote(PlentySoapRequest_AddCustomerNote $oAddCustomerNotesRequest)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_AddCustomerNote.class.php");
		return parent::__soapCall("AddCustomerNote",array($oAddCustomerNotesRequest));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetBankCreditCardData SetBankCreditCardData(PlentySoapRequest_SetBankCreditCardData $oPlentySoapRequest_SetBankCreditCardData)
	 *
	 * @param PlentySoapRequest_SetBankCreditCardData $oPlentySoapRequest_SetBankCreditCardData
	 *
	 * @return PlentySoapResponse_SetBankCreditCardData
	 */
	public function SetBankCreditCardData(PlentySoapRequest_SetBankCreditCardData $oPlentySoapRequest_SetBankCreditCardData)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetBankCreditCardData.class.php");
		return parent::__soapCall("SetBankCreditCardData",array($oPlentySoapRequest_SetBankCreditCardData));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCustomerOrders GetCustomerOrders(PlentySoapRequest_GetCustomerOrders $oPlentySoapRequest_GetCustomerOrders)
	 *
	 * @param PlentySoapRequest_GetCustomerOrders $oPlentySoapRequest_GetCustomerOrders
	 *
	 * @return PlentySoapResponse_GetCustomerOrders
	 */
	public function GetCustomerOrders(PlentySoapRequest_GetCustomerOrders $oPlentySoapRequest_GetCustomerOrders)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCustomerOrders.class.php");
		return parent::__soapCall("GetCustomerOrders",array($oPlentySoapRequest_GetCustomerOrders));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCustomerDeliveryAddresses GetCustomerDeliveryAddresses(PlentySoapRequest_GetCustomerDeliveryAddresses $oPlentySoapRequest_GetCustomerDeliveryAddresses)
	 *
	 * @param PlentySoapRequest_GetCustomerDeliveryAddresses $oPlentySoapRequest_GetCustomerDeliveryAddresses
	 *
	 * @return PlentySoapResponse_GetCustomerDeliveryAddresses
	 */
	public function GetCustomerDeliveryAddresses(PlentySoapRequest_GetCustomerDeliveryAddresses $oPlentySoapRequest_GetCustomerDeliveryAddresses)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCustomerDeliveryAddresses.class.php");
		return parent::__soapCall("GetCustomerDeliveryAddresses",array($oPlentySoapRequest_GetCustomerDeliveryAddresses));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetCustomerDeliveryAddresses SetCustomerDeliveryAddresses(PlentySoapRequest_SetCustomerDeliveryAddresses $oPlentySoapRequest_SetCustomerDeliveryAddresses)
	 *
	 * @param PlentySoapRequest_SetCustomerDeliveryAddresses $oPlentySoapRequest_SetCustomerDeliveryAddresses
	 *
	 * @return PlentySoapResponse_SetCustomerDeliveryAddresses
	 */
	public function SetCustomerDeliveryAddresses(PlentySoapRequest_SetCustomerDeliveryAddresses $oPlentySoapRequest_SetCustomerDeliveryAddresses)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetCustomerDeliveryAddresses.class.php");
		return parent::__soapCall("SetCustomerDeliveryAddresses",array($oPlentySoapRequest_SetCustomerDeliveryAddresses));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCustomerClasses GetCustomerClasses()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetCustomerClasses
	 */
	public function GetCustomerClasses()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCustomerClasses.class.php");
		return parent::__soapCall("GetCustomerClasses",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCountriesOfDelivery GetCountriesOfDelivery(PlentySoapRequest_GetCountriesOfDelivery $oPlentySoapRequest_GetCountriesOfDelivery)
	 *
	 * @param PlentySoapRequest_GetCountriesOfDelivery $oPlentySoapRequest_GetCountriesOfDelivery
	 *
	 * @return PlentySoapResponse_GetCountriesOfDelivery
	 */
	public function GetCountriesOfDelivery(PlentySoapRequest_GetCountriesOfDelivery $oPlentySoapRequest_GetCountriesOfDelivery)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCountriesOfDelivery.class.php");
		return parent::__soapCall("GetCountriesOfDelivery",array($oPlentySoapRequest_GetCountriesOfDelivery));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetDeleteLog GetDeleteLog(PlentySoapRequest_GetDeleteLog $oPlentySoapRequest_GetDeleteLog)
	 *
	 * @param PlentySoapRequest_GetDeleteLog $oPlentySoapRequest_GetDeleteLog
	 *
	 * @return PlentySoapResponse_GetDeleteLog
	 */
	public function GetDeleteLog(PlentySoapRequest_GetDeleteLog $oPlentySoapRequest_GetDeleteLog)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetDeleteLog.class.php");
		return parent::__soapCall("GetDeleteLog",array($oPlentySoapRequest_GetDeleteLog));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemsDefaultCategories SetItemsDefaultCategories(PlentySoapRequest_SetItemsDefaultCategories $oPlentySoapRequest_SetItemsDefaultCategories)
	 *
	 * @param PlentySoapRequest_SetItemsDefaultCategories $oPlentySoapRequest_SetItemsDefaultCategories
	 *
	 * @return PlentySoapResponse_SetItemsDefaultCategories
	 */
	public function SetItemsDefaultCategories(PlentySoapRequest_SetItemsDefaultCategories $oPlentySoapRequest_SetItemsDefaultCategories)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemsDefaultCategories.class.php");
		return parent::__soapCall("SetItemsDefaultCategories",array($oPlentySoapRequest_SetItemsDefaultCategories));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_UpdateCategoriesBranches UpdateCategoriesBranches(PlentySoapRequest_UpdateCategoriesBranches $oPlentySoapRequest_UpdateCategoriesBranches)
	 *
	 * @param PlentySoapRequest_UpdateCategoriesBranches $oPlentySoapRequest_UpdateCategoriesBranches
	 *
	 * @return PlentySoapResponse_UpdateCategoriesBranches
	 */
	public function UpdateCategoriesBranches(PlentySoapRequest_UpdateCategoriesBranches $oPlentySoapRequest_UpdateCategoriesBranches)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_UpdateCategoriesBranches.class.php");
		return parent::__soapCall("UpdateCategoriesBranches",array($oPlentySoapRequest_UpdateCategoriesBranches));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCategoryPreview GetCategoryPreview()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetCategoryPreview
	 */
	public function GetCategoryPreview()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCategoryPreview.class.php");
		return parent::__soapCall("GetCategoryPreview",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteCategories DeleteCategories(PlentySoapRequest_DeleteCategories $oPlentySoapRequest_DeleteCategories)
	 *
	 * @param PlentySoapRequest_DeleteCategories $oPlentySoapRequest_DeleteCategories
	 *
	 * @return PlentySoapResponse_DeleteCategories
	 */
	public function DeleteCategories(PlentySoapRequest_DeleteCategories $oPlentySoapRequest_DeleteCategories)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteCategories.class.php");
		return parent::__soapCall("DeleteCategories",array($oPlentySoapRequest_DeleteCategories));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetCategories SetCategories(PlentySoapRequest_SetCategories $oPlentySoapRequest_SetCategories)
	 *
	 * @param PlentySoapRequest_SetCategories $oPlentySoapRequest_SetCategories
	 *
	 * @return PlentySoapResponse_SetCategories
	 */
	public function SetCategories(PlentySoapRequest_SetCategories $oPlentySoapRequest_SetCategories)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetCategories.class.php");
		return parent::__soapCall("SetCategories",array($oPlentySoapRequest_SetCategories));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCategories GetCategories(PlentySoapRequest_GetCategories $oPlentySoapRequest_GetCategories)
	 *
	 * @param PlentySoapRequest_GetCategories $oPlentySoapRequest_GetCategories
	 *
	 * @return PlentySoapResponse_GetCategories
	 */
	public function GetCategories(PlentySoapRequest_GetCategories $oPlentySoapRequest_GetCategories)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCategories.class.php");
		return parent::__soapCall("GetCategories",array($oPlentySoapRequest_GetCategories));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCategoryBranchID GetCategoryBranchID(PlentySoapRequest_GetCategoryBranchID $oPlentySoapRequest_GetCategoryBranchID)
	 *
	 * @param PlentySoapRequest_GetCategoryBranchID $oPlentySoapRequest_GetCategoryBranchID
	 *
	 * @return PlentySoapResponse_GetCategoryBranchID
	 */
	public function GetCategoryBranchID(PlentySoapRequest_GetCategoryBranchID $oPlentySoapRequest_GetCategoryBranchID)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCategoryBranchID.class.php");
		return parent::__soapCall("GetCategoryBranchID",array($oPlentySoapRequest_GetCategoryBranchID));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemsSuppliers SetItemsSuppliers(PlentySoapRequest_SetItemsSuppliers $oPlentySoapRequest_SetItemsSuppliers)
	 *
	 * @param PlentySoapRequest_SetItemsSuppliers $oPlentySoapRequest_SetItemsSuppliers
	 *
	 * @return PlentySoapResponse_SetItemsSuppliers
	 */
	public function SetItemsSuppliers(PlentySoapRequest_SetItemsSuppliers $oPlentySoapRequest_SetItemsSuppliers)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemsSuppliers.class.php");
		return parent::__soapCall("SetItemsSuppliers",array($oPlentySoapRequest_SetItemsSuppliers));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetMeasureUnitConfig GetMeasureUnitConfig(PlentySoapRequest_GetMeasureUnitConfig $oPlentySoapRequest_GetMeasureUnitConfig)
	 *
	 * @param PlentySoapRequest_GetMeasureUnitConfig $oPlentySoapRequest_GetMeasureUnitConfig
	 *
	 * @return PlentySoapResponse_GetMeasureUnitConfig
	 */
	public function GetMeasureUnitConfig(PlentySoapRequest_GetMeasureUnitConfig $oPlentySoapRequest_GetMeasureUnitConfig)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetMeasureUnitConfig.class.php");
		return parent::__soapCall("GetMeasureUnitConfig",array($oPlentySoapRequest_GetMeasureUnitConfig));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteItemsSuppliers DeleteItemsSuppliers(PlentySoapRequest_DeleteItemsSuppliers $oPlentySoapRequest_DeleteItemsSuppliers)
	 *
	 * @param PlentySoapRequest_DeleteItemsSuppliers $oPlentySoapRequest_DeleteItemsSuppliers
	 *
	 * @return PlentySoapResponse_DeleteItemsSuppliers
	 */
	public function DeleteItemsSuppliers(PlentySoapRequest_DeleteItemsSuppliers $oPlentySoapRequest_DeleteItemsSuppliers)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteItemsSuppliers.class.php");
		return parent::__soapCall("DeleteItemsSuppliers",array($oPlentySoapRequest_DeleteItemsSuppliers));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsSuppliers GetItemsSuppliers(PlentySoapRequest_GetItemsSuppliers $oPlentySoapRequest_GetItemsSuppliers)
	 *
	 * @param PlentySoapRequest_GetItemsSuppliers $oPlentySoapRequest_GetItemsSuppliers
	 *
	 * @return PlentySoapResponse_GetItemsSuppliers
	 */
	public function GetItemsSuppliers(PlentySoapRequest_GetItemsSuppliers $oPlentySoapRequest_GetItemsSuppliers)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsSuppliers.class.php");
		return parent::__soapCall("GetItemsSuppliers",array($oPlentySoapRequest_GetItemsSuppliers));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteLinkedItems DeleteLinkedItems(PlentySoapRequest_DeleteLinkedItems $oPlentySoapRequest_DeleteLinkedItems)
	 *
	 * @param PlentySoapRequest_DeleteLinkedItems $oPlentySoapRequest_DeleteLinkedItems
	 *
	 * @return PlentySoapResponse_DeleteLinkedItems
	 */
	public function DeleteLinkedItems(PlentySoapRequest_DeleteLinkedItems $oPlentySoapRequest_DeleteLinkedItems)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteLinkedItems.class.php");
		return parent::__soapCall("DeleteLinkedItems",array($oPlentySoapRequest_DeleteLinkedItems));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetLinkedItems SetLinkedItems(PlentySoapRequest_SetLinkedItems $oPlentySoapRequest_SetLinkedItems)
	 *
	 * @param PlentySoapRequest_SetLinkedItems $oPlentySoapRequest_SetLinkedItems
	 *
	 * @return PlentySoapResponse_SetLinkedItems
	 */
	public function SetLinkedItems(PlentySoapRequest_SetLinkedItems $oPlentySoapRequest_SetLinkedItems)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetLinkedItems.class.php");
		return parent::__soapCall("SetLinkedItems",array($oPlentySoapRequest_SetLinkedItems));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_AddItemMediaFile AddItemMediaFile(PlentySoapRequest_AddItemMediaFile $oPlentySoapRequest_AddItemMediaFile)
	 *
	 * @param PlentySoapRequest_AddItemMediaFile $oPlentySoapRequest_AddItemMediaFile
	 *
	 * @return PlentySoapResponse_AddItemMediaFile
	 */
	public function AddItemMediaFile(PlentySoapRequest_AddItemMediaFile $oPlentySoapRequest_AddItemMediaFile)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_AddItemMediaFile.class.php");
		return parent::__soapCall("AddItemMediaFile",array($oPlentySoapRequest_AddItemMediaFile));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteItemMediaFiles DeleteItemMediaFiles(PlentySoapRequest_DeleteItemMediaFiles $oPlentySoapRequest_DeleteItemMediaFiles)
	 *
	 * @param PlentySoapRequest_DeleteItemMediaFiles $oPlentySoapRequest_DeleteItemMediaFiles
	 *
	 * @return PlentySoapResponse_DeleteItemMediaFiles
	 */
	public function DeleteItemMediaFiles(PlentySoapRequest_DeleteItemMediaFiles $oPlentySoapRequest_DeleteItemMediaFiles)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteItemMediaFiles.class.php");
		return parent::__soapCall("DeleteItemMediaFiles",array($oPlentySoapRequest_DeleteItemMediaFiles));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsBase GetItemsBase(PlentySoapRequest_GetItemsBase $oPlentySoapRequest_GetItemsBase)
	 *
	 * @param PlentySoapRequest_GetItemsBase $oPlentySoapRequest_GetItemsBase
	 *
	 * @return PlentySoapResponse_GetItemsBase
	 */
	public function GetItemsBase(PlentySoapRequest_GetItemsBase $oPlentySoapRequest_GetItemsBase)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsBase.class.php");
		return parent::__soapCall("GetItemsBase",array($oPlentySoapRequest_GetItemsBase));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsUpdated GetItemsUpdated(PlentySoapRequest_GetItemsUpdated $oPlentySoapRequest_GetItemsUpdated)
	 *
	 * @param PlentySoapRequest_GetItemsUpdated $oPlentySoapRequest_GetItemsUpdated
	 *
	 * @return PlentySoapResponse_GetItemsUpdated
	 */
	public function GetItemsUpdated(PlentySoapRequest_GetItemsUpdated $oPlentySoapRequest_GetItemsUpdated)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsUpdated.class.php");
		return parent::__soapCall("GetItemsUpdated",array($oPlentySoapRequest_GetItemsUpdated));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsByStoreID GetItemsByStoreID(PlentySoapRequest_GetItemsByStoreID $oPlentySoapRequest_GetItemsByStoreID)
	 *
	 * @param PlentySoapRequest_GetItemsByStoreID $oPlentySoapRequest_GetItemsByStoreID
	 *
	 * @return PlentySoapResponse_GetItemsByStoreID
	 */
	public function GetItemsByStoreID(PlentySoapRequest_GetItemsByStoreID $oPlentySoapRequest_GetItemsByStoreID)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsByStoreID.class.php");
		return parent::__soapCall("GetItemsByStoreID",array($oPlentySoapRequest_GetItemsByStoreID));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemsBase SetItemsBase(PlentySoapRequest_SetItemsBase $oPlentySoapRequest_SetItemsBase)
	 *
	 * @param PlentySoapRequest_SetItemsBase $oPlentySoapRequest_SetItemsBase
	 *
	 * @return PlentySoapResponse_SetItemsBase
	 */
	public function SetItemsBase(PlentySoapRequest_SetItemsBase $oPlentySoapRequest_SetItemsBase)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemsBase.class.php");
		return parent::__soapCall("SetItemsBase",array($oPlentySoapRequest_SetItemsBase));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemsPurchasePrice SetItemsPurchasePrice(PlentySoapRequest_SetItemsPurchasePrice $oPlentySoapRequest_SetItemsPurchasePrice)
	 *
	 * @param PlentySoapRequest_SetItemsPurchasePrice $oPlentySoapRequest_SetItemsPurchasePrice
	 *
	 * @return PlentySoapResponse_SetItemsPurchasePrice
	 */
	public function SetItemsPurchasePrice(PlentySoapRequest_SetItemsPurchasePrice $oPlentySoapRequest_SetItemsPurchasePrice)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemsPurchasePrice.class.php");
		return parent::__soapCall("SetItemsPurchasePrice",array($oPlentySoapRequest_SetItemsPurchasePrice));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteItemsImages DeleteItemsImages(PlentySoapRequest_DeleteItemsImages $oPlentySoapRequest_DeleteItemsImages)
	 *
	 * @param PlentySoapRequest_DeleteItemsImages $oPlentySoapRequest_DeleteItemsImages
	 *
	 * @return PlentySoapResponse_DeleteItemsImages
	 */
	public function DeleteItemsImages(PlentySoapRequest_DeleteItemsImages $oPlentySoapRequest_DeleteItemsImages)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteItemsImages.class.php");
		return parent::__soapCall("DeleteItemsImages",array($oPlentySoapRequest_DeleteItemsImages));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemCategoryCatalog GetItemCategoryCatalog(PlentySoapRequest_GetItemCategoryCatalog $oPlentySoapRequest_GetItemCategoryCatalog)
	 *
	 * @param PlentySoapRequest_GetItemCategoryCatalog $oPlentySoapRequest_GetItemCategoryCatalog
	 *
	 * @return PlentySoapResponse_GetItemCategoryCatalog
	 */
	public function GetItemCategoryCatalog(PlentySoapRequest_GetItemCategoryCatalog $oPlentySoapRequest_GetItemCategoryCatalog)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemCategoryCatalog.class.php");
		return parent::__soapCall("GetItemCategoryCatalog",array($oPlentySoapRequest_GetItemCategoryCatalog));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemCategory SetItemCategory(PlentySoapRequest_SetItemCategory $oPlentySoapRequest_SetItemCategory)
	 *
	 * @param PlentySoapRequest_SetItemCategory $oPlentySoapRequest_SetItemCategory
	 *
	 * @return PlentySoapResponse_SetItemCategory
	 */
	public function SetItemCategory(PlentySoapRequest_SetItemCategory $oPlentySoapRequest_SetItemCategory)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemCategory.class.php");
		return parent::__soapCall("SetItemCategory",array($oPlentySoapRequest_SetItemCategory));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemImages SetItemImages(PlentySoapRequest_SetItemImages $oPlentySoapRequest_SetItemImages)
	 *
	 * @param PlentySoapRequest_SetItemImages $oPlentySoapRequest_SetItemImages
	 *
	 * @return PlentySoapResponse_SetItemImages
	 */
	public function SetItemImages(PlentySoapRequest_SetItemImages $oPlentySoapRequest_SetItemImages)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemImages.class.php");
		return parent::__soapCall("SetItemImages",array($oPlentySoapRequest_SetItemImages));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsImages GetItemsImages(PlentySoapRequest_GetItemsImages $oPlentySoapRequest_GetItemsImages)
	 *
	 * @param PlentySoapRequest_GetItemsImages $oPlentySoapRequest_GetItemsImages
	 *
	 * @return PlentySoapResponse_GetItemsImages
	 */
	public function GetItemsImages(PlentySoapRequest_GetItemsImages $oPlentySoapRequest_GetItemsImages)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsImages.class.php");
		return parent::__soapCall("GetItemsImages",array($oPlentySoapRequest_GetItemsImages));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsVariantImages GetItemsVariantImages(PlentySoapRequest_GetItemsVariantImages $oPlentySoapRequest_GetItemsVariantImages)
	 *
	 * @param PlentySoapRequest_GetItemsVariantImages $oPlentySoapRequest_GetItemsVariantImages
	 *
	 * @return PlentySoapResponse_GetItemsVariantImages
	 */
	public function GetItemsVariantImages(PlentySoapRequest_GetItemsVariantImages $oPlentySoapRequest_GetItemsVariantImages)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsVariantImages.class.php");
		return parent::__soapCall("GetItemsVariantImages",array($oPlentySoapRequest_GetItemsVariantImages));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsVariantsAvailable GetItemsVariantsAvailable(PlentySoapRequest_GetItemsVariantsAvailable $oPlentySoapRequest_GetItemsVariantsAvailable)
	 *
	 * @param PlentySoapRequest_GetItemsVariantsAvailable $oPlentySoapRequest_GetItemsVariantsAvailable
	 *
	 * @return PlentySoapResponse_GetItemsVariantsAvailable
	 */
	public function GetItemsVariantsAvailable(PlentySoapRequest_GetItemsVariantsAvailable $oPlentySoapRequest_GetItemsVariantsAvailable)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsVariantsAvailable.class.php");
		return parent::__soapCall("GetItemsVariantsAvailable",array($oPlentySoapRequest_GetItemsVariantsAvailable));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetProducers GetProducers(PlentySoapRequest_GetProducers $oPlentySoapRequest_GetProducers)
	 *
	 * @param PlentySoapRequest_GetProducers $oPlentySoapRequest_GetProducers
	 *
	 * @return PlentySoapResponse_GetProducers
	 */
	public function GetProducers(PlentySoapRequest_GetProducers $oPlentySoapRequest_GetProducers)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetProducers.class.php");
		return parent::__soapCall("GetProducers",array($oPlentySoapRequest_GetProducers));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsReturnStatus GetItemsReturnStatus()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetItemsReturnStatus
	 */
	public function GetItemsReturnStatus()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsReturnStatus.class.php");
		return parent::__soapCall("GetItemsReturnStatus",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteItems DeleteItems(PlentySoapRequest_DeleteItems $oPlentySoapRequest_DeleteItems)
	 *
	 * @param PlentySoapRequest_DeleteItems $oPlentySoapRequest_DeleteItems
	 *
	 * @return PlentySoapResponse_DeleteItems
	 */
	public function DeleteItems(PlentySoapRequest_DeleteItems $oPlentySoapRequest_DeleteItems)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteItems.class.php");
		return parent::__soapCall("DeleteItems",array($oPlentySoapRequest_DeleteItems));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetLinkedItems GetLinkedItems(PlentySoapRequest_GetLinkedItems $oPlentySoapRequest_GetLinkedItems)
	 *
	 * @param PlentySoapRequest_GetLinkedItems $oPlentySoapRequest_GetLinkedItems
	 *
	 * @return PlentySoapResponse_GetLinkedItems
	 */
	public function GetLinkedItems(PlentySoapRequest_GetLinkedItems $oPlentySoapRequest_GetLinkedItems)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetLinkedItems.class.php");
		return parent::__soapCall("GetLinkedItems",array($oPlentySoapRequest_GetLinkedItems));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsPropertiesList GetItemsPropertiesList(PlentySoapRequest_GetItemsPropertiesList $oPlentySoapRequest_GetItemsPropertiesList)
	 *
	 * @param PlentySoapRequest_GetItemsPropertiesList $oPlentySoapRequest_GetItemsPropertiesList
	 *
	 * @return PlentySoapResponse_GetItemsPropertiesList
	 */
	public function GetItemsPropertiesList(PlentySoapRequest_GetItemsPropertiesList $oPlentySoapRequest_GetItemsPropertiesList)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsPropertiesList.class.php");
		return parent::__soapCall("GetItemsPropertiesList",array($oPlentySoapRequest_GetItemsPropertiesList));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsPriceLists GetItemsPriceLists(PlentySoapRequest_GetItemsPriceLists $oPlentySoapRequest_GetItemsPriceLists)
	 *
	 * @param PlentySoapRequest_GetItemsPriceLists $oPlentySoapRequest_GetItemsPriceLists
	 *
	 * @return PlentySoapResponse_GetItemsPriceLists
	 */
	public function GetItemsPriceLists(PlentySoapRequest_GetItemsPriceLists $oPlentySoapRequest_GetItemsPriceLists)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsPriceLists.class.php");
		return parent::__soapCall("GetItemsPriceLists",array($oPlentySoapRequest_GetItemsPriceLists));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsPriceUpdate GetItemsPriceUpdate(PlentySoapRequest_GetItemsPriceUpdate $oPlentySoapRequest_GetItemsPriceUpdate)
	 *
	 * @param PlentySoapRequest_GetItemsPriceUpdate $oPlentySoapRequest_GetItemsPriceUpdate
	 *
	 * @return PlentySoapResponse_GetItemsPriceUpdate
	 */
	public function GetItemsPriceUpdate(PlentySoapRequest_GetItemsPriceUpdate $oPlentySoapRequest_GetItemsPriceUpdate)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsPriceUpdate.class.php");
		return parent::__soapCall("GetItemsPriceUpdate",array($oPlentySoapRequest_GetItemsPriceUpdate));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetAttributeValueSets GetAttributeValueSets(PlentySoapRequest_GetAttributeValueSets $oPlentySoapRequest_GetAttributeValueSets)
	 *
	 * @param PlentySoapRequest_GetAttributeValueSets $oPlentySoapRequest_GetAttributeValueSets
	 *
	 * @return PlentySoapResponse_GetAttributeValueSets
	 */
	public function GetAttributeValueSets(PlentySoapRequest_GetAttributeValueSets $oPlentySoapRequest_GetAttributeValueSets)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetAttributeValueSets.class.php");
		return parent::__soapCall("GetAttributeValueSets",array($oPlentySoapRequest_GetAttributeValueSets));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetProducers SetProducers(PlentySoapRequest_SetProducers $oPlentySoapRequest_SetProducers)
	 *
	 * @param PlentySoapRequest_SetProducers $oPlentySoapRequest_SetProducers
	 *
	 * @return PlentySoapResponse_SetProducers
	 */
	public function SetProducers(PlentySoapRequest_SetProducers $oPlentySoapRequest_SetProducers)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetProducers.class.php");
		return parent::__soapCall("SetProducers",array($oPlentySoapRequest_SetProducers));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemAttributes SetItemAttributes(PlentySoapRequest_SetItemAttributes $oPlentySoapRequest_SetItemAttributes)
	 *
	 * @param PlentySoapRequest_SetItemAttributes $oPlentySoapRequest_SetItemAttributes
	 *
	 * @return PlentySoapResponse_SetItemAttributes
	 */
	public function SetItemAttributes(PlentySoapRequest_SetItemAttributes $oPlentySoapRequest_SetItemAttributes)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemAttributes.class.php");
		return parent::__soapCall("SetItemAttributes",array($oPlentySoapRequest_SetItemAttributes));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemAttributeLinks SetItemAttributeLinks(PlentySoapRequest_SetItemAttributeLinks $oPlentySoapRequest_SetItemAttributeLinks)
	 *
	 * @param PlentySoapRequest_SetItemAttributeLinks $oPlentySoapRequest_SetItemAttributeLinks
	 *
	 * @return PlentySoapResponse_SetItemAttributeLinks
	 */
	public function SetItemAttributeLinks(PlentySoapRequest_SetItemAttributeLinks $oPlentySoapRequest_SetItemAttributeLinks)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemAttributeLinks.class.php");
		return parent::__soapCall("SetItemAttributeLinks",array($oPlentySoapRequest_SetItemAttributeLinks));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemAttributeVariants SetItemAttributeVariants(PlentySoapRequest_SetItemAttributeVariants $oPlentySoapRequest_SetItemAttributeVariants)
	 *
	 * @param PlentySoapRequest_SetItemAttributeVariants $oPlentySoapRequest_SetItemAttributeVariants
	 *
	 * @return PlentySoapResponse_SetItemAttributeVariants
	 */
	public function SetItemAttributeVariants(PlentySoapRequest_SetItemAttributeVariants $oPlentySoapRequest_SetItemAttributeVariants)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemAttributeVariants.class.php");
		return parent::__soapCall("SetItemAttributeVariants",array($oPlentySoapRequest_SetItemAttributeVariants));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetPriceSets SetPriceSets(PlentySoapRequest_SetPriceSets $oPlentySoapRequest_SetPriceSets)
	 *
	 * @param PlentySoapRequest_SetPriceSets $oPlentySoapRequest_SetPriceSets
	 *
	 * @return PlentySoapResponse_SetPriceSets
	 */
	public function SetPriceSets(PlentySoapRequest_SetPriceSets $oPlentySoapRequest_SetPriceSets)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetPriceSets.class.php");
		return parent::__soapCall("SetPriceSets",array($oPlentySoapRequest_SetPriceSets));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemsAvailability SetItemsAvailability(PlentySoapRequest_SetItemsAvailability $oPlentySoapRequest_SetItemsAvailability)
	 *
	 * @param PlentySoapRequest_SetItemsAvailability $oPlentySoapRequest_SetItemsAvailability
	 *
	 * @return PlentySoapResponse_SetItemsAvailability
	 */
	public function SetItemsAvailability(PlentySoapRequest_SetItemsAvailability $oPlentySoapRequest_SetItemsAvailability)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemsAvailability.class.php");
		return parent::__soapCall("SetItemsAvailability",array($oPlentySoapRequest_SetItemsAvailability));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCategoryMappingForMarket GetCategoryMappingForMarket(PlentySoapRequest_GetCategoryMappingForMarket $oPlentySoapRequest_GetCategoryMappingForMarket)
	 *
	 * @param PlentySoapRequest_GetCategoryMappingForMarket $oPlentySoapRequest_GetCategoryMappingForMarket
	 *
	 * @return PlentySoapResponse_GetCategoryMappingForMarket
	 */
	public function GetCategoryMappingForMarket(PlentySoapRequest_GetCategoryMappingForMarket $oPlentySoapRequest_GetCategoryMappingForMarket)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCategoryMappingForMarket.class.php");
		return parent::__soapCall("GetCategoryMappingForMarket",array($oPlentySoapRequest_GetCategoryMappingForMarket));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetPropertyGroups GetPropertyGroups(PlentySoapRequest_GetPropertyGroups $oPlentySoapRequest_GetPropertyGroups)
	 *
	 * @param PlentySoapRequest_GetPropertyGroups $oPlentySoapRequest_GetPropertyGroups
	 *
	 * @return PlentySoapResponse_GetPropertyGroups
	 */
	public function GetPropertyGroups(PlentySoapRequest_GetPropertyGroups $oPlentySoapRequest_GetPropertyGroups)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetPropertyGroups.class.php");
		return parent::__soapCall("GetPropertyGroups",array($oPlentySoapRequest_GetPropertyGroups));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetProperties GetProperties(PlentySoapRequest_GetProperties $oPlentySoapRequest_GetProperties)
	 *
	 * @param PlentySoapRequest_GetProperties $oPlentySoapRequest_GetProperties
	 *
	 * @return PlentySoapResponse_GetProperties
	 */
	public function GetProperties(PlentySoapRequest_GetProperties $oPlentySoapRequest_GetProperties)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetProperties.class.php");
		return parent::__soapCall("GetProperties",array($oPlentySoapRequest_GetProperties));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetPropertiesList GetPropertiesList(PlentySoapRequest_GetPropertiesList $oPlentySoapRequest_GetPropertiesList)
	 *
	 * @param PlentySoapRequest_GetPropertiesList $oPlentySoapRequest_GetPropertiesList
	 *
	 * @return PlentySoapResponse_GetPropertiesList
	 */
	public function GetPropertiesList(PlentySoapRequest_GetPropertiesList $oPlentySoapRequest_GetPropertiesList)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetPropertiesList.class.php");
		return parent::__soapCall("GetPropertiesList",array($oPlentySoapRequest_GetPropertiesList));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemBundles GetItemBundles(PlentySoapRequest_GetItemBundles $oPlentySoapRequest_GetItemBundles)
	 *
	 * @param PlentySoapRequest_GetItemBundles $oPlentySoapRequest_GetItemBundles
	 *
	 * @return PlentySoapResponse_GetItemBundles
	 */
	public function GetItemBundles(PlentySoapRequest_GetItemBundles $oPlentySoapRequest_GetItemBundles)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemBundles.class.php");
		return parent::__soapCall("GetItemBundles",array($oPlentySoapRequest_GetItemBundles));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemsToBundle SetItemsToBundle(PlentySoapRequest_SetItemsToBundle $oPlentySoapRequest_SetItemsToBundle)
	 *
	 * @param PlentySoapRequest_SetItemsToBundle $oPlentySoapRequest_SetItemsToBundle
	 *
	 * @return PlentySoapResponse_SetItemsToBundle
	 */
	public function SetItemsToBundle(PlentySoapRequest_SetItemsToBundle $oPlentySoapRequest_SetItemsToBundle)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemsToBundle.class.php");
		return parent::__soapCall("SetItemsToBundle",array($oPlentySoapRequest_SetItemsToBundle));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_RemoveItemsFromBundle RemoveItemsFromBundle(PlentySoapRequest_RemoveItemsFromBundle $oPlentySoapRequest_RemoveItemsFromBundle)
	 *
	 * @param PlentySoapRequest_RemoveItemsFromBundle $oPlentySoapRequest_RemoveItemsFromBundle
	 *
	 * @return PlentySoapResponse_RemoveItemsFromBundle
	 */
	public function RemoveItemsFromBundle(PlentySoapRequest_RemoveItemsFromBundle $oPlentySoapRequest_RemoveItemsFromBundle)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_RemoveItemsFromBundle.class.php");
		return parent::__soapCall("RemoveItemsFromBundle",array($oPlentySoapRequest_RemoveItemsFromBundle));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetLinkPriceColumnToReferrer GetLinkPriceColumnToReferrer()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetLinkPriceColumnToReferrer
	 */
	public function GetLinkPriceColumnToReferrer()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetLinkPriceColumnToReferrer.class.php");
		return parent::__soapCall("GetLinkPriceColumnToReferrer",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemCategoryTree GetItemCategoryTree(PlentySoapRequest_GetItemCategoryTree $oPlentySoapRequest_GetItemCategoryTree)
	 *
	 * @param PlentySoapRequest_GetItemCategoryTree $oPlentySoapRequest_GetItemCategoryTree
	 *
	 * @return PlentySoapResponse_GetItemCategoryTree
	 */
	public function GetItemCategoryTree(PlentySoapRequest_GetItemCategoryTree $oPlentySoapRequest_GetItemCategoryTree)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemCategoryTree.class.php");
		return parent::__soapCall("GetItemCategoryTree",array($oPlentySoapRequest_GetItemCategoryTree));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetAttributeValueSetsDetails SetAttributeValueSetsDetails(PlentySoapRequest_SetAttributeValueSetsDetails $oPlentySoapRequest_SetAttributeValueSetsDetails)
	 *
	 * @param PlentySoapRequest_SetAttributeValueSetsDetails $oPlentySoapRequest_SetAttributeValueSetsDetails
	 *
	 * @return PlentySoapResponse_SetAttributeValueSetsDetails
	 */
	public function SetAttributeValueSetsDetails(PlentySoapRequest_SetAttributeValueSetsDetails $oPlentySoapRequest_SetAttributeValueSetsDetails)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetAttributeValueSetsDetails.class.php");
		return parent::__soapCall("SetAttributeValueSetsDetails",array($oPlentySoapRequest_SetAttributeValueSetsDetails));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemAvailabilityConfig GetItemAvailabilityConfig()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetItemAvailabilityConfig
	 */
	public function GetItemAvailabilityConfig()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemAvailabilityConfig.class.php");
		return parent::__soapCall("GetItemAvailabilityConfig",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetProperties SetProperties(PlentySoapRequest_SetProperties $oPlentySoapRequest_SetProperties)
	 *
	 * @param PlentySoapRequest_SetProperties $oPlentySoapRequest_SetProperties
	 *
	 * @return PlentySoapResponse_SetProperties
	 */
	public function SetProperties(PlentySoapRequest_SetProperties $oPlentySoapRequest_SetProperties)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetProperties.class.php");
		return parent::__soapCall("SetProperties",array($oPlentySoapRequest_SetProperties));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteProperty DeleteProperty(PlentySoapRequest_DeleteProperty $oPlentySoapRequest_DeleteProperty)
	 *
	 * @param PlentySoapRequest_DeleteProperty $oPlentySoapRequest_DeleteProperty
	 *
	 * @return PlentySoapResponse_DeleteProperty
	 */
	public function DeleteProperty(PlentySoapRequest_DeleteProperty $oPlentySoapRequest_DeleteProperty)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteProperty.class.php");
		return parent::__soapCall("DeleteProperty",array($oPlentySoapRequest_DeleteProperty));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetPropertyGroups SetPropertyGroups(PlentySoapRequest_SetPropertyGroups $oPlentySoapRequest_SetPropertyGroups)
	 *
	 * @param PlentySoapRequest_SetPropertyGroups $oPlentySoapRequest_SetPropertyGroups
	 *
	 * @return PlentySoapResponse_SetPropertyGroups
	 */
	public function SetPropertyGroups(PlentySoapRequest_SetPropertyGroups $oPlentySoapRequest_SetPropertyGroups)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetPropertyGroups.class.php");
		return parent::__soapCall("SetPropertyGroups",array($oPlentySoapRequest_SetPropertyGroups));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeletePropertyGroup DeletePropertyGroup(PlentySoapRequest_DeletePropertyGroup $oPlentySoapRequest_DeletePropertyGroup)
	 *
	 * @param PlentySoapRequest_DeletePropertyGroup $oPlentySoapRequest_DeletePropertyGroup
	 *
	 * @return PlentySoapResponse_DeletePropertyGroup
	 */
	public function DeletePropertyGroup(PlentySoapRequest_DeletePropertyGroup $oPlentySoapRequest_DeletePropertyGroup)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeletePropertyGroup.class.php");
		return parent::__soapCall("DeletePropertyGroup",array($oPlentySoapRequest_DeletePropertyGroup));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetPropertiesToItem SetPropertiesToItem(PlentySoapRequest_SetPropertiesToItem $oPlentySoapRequest_SetPropertiesToItem)
	 *
	 * @param PlentySoapRequest_SetPropertiesToItem $oPlentySoapRequest_SetPropertiesToItem
	 *
	 * @return PlentySoapResponse_SetPropertiesToItem
	 */
	public function SetPropertiesToItem(PlentySoapRequest_SetPropertiesToItem $oPlentySoapRequest_SetPropertiesToItem)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetPropertiesToItem.class.php");
		return parent::__soapCall("SetPropertiesToItem",array($oPlentySoapRequest_SetPropertiesToItem));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_RemovePropertyFromItem RemovePropertyFromItem(PlentySoapRequest_RemovePropertyFromItem $oPlentySoapRequest_RemovePropertyFromItem)
	 *
	 * @param PlentySoapRequest_RemovePropertyFromItem $oPlentySoapRequest_RemovePropertyFromItem
	 *
	 * @return PlentySoapResponse_RemovePropertyFromItem
	 */
	public function RemovePropertyFromItem(PlentySoapRequest_RemovePropertyFromItem $oPlentySoapRequest_RemovePropertyFromItem)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_RemovePropertyFromItem.class.php");
		return parent::__soapCall("RemovePropertyFromItem",array($oPlentySoapRequest_RemovePropertyFromItem));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetDefaultAttributeTypeForMarket GetDefaultAttributeTypeForMarket()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetDefaultAttributeTypeForMarket
	 */
	public function GetDefaultAttributeTypeForMarket()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetDefaultAttributeTypeForMarket.class.php");
		return parent::__soapCall("GetDefaultAttributeTypeForMarket",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeletePriceSets DeletePriceSets(PlentySoapRequest_DeletePriceSets $PlentySoapRequest_DeletePriceSets)
	 *
	 * @param PlentySoapRequest_DeletePriceSets $PlentySoapRequest_DeletePriceSets
	 *
	 * @return PlentySoapResponse_DeletePriceSets
	 */
	public function DeletePriceSets(PlentySoapRequest_DeletePriceSets $PlentySoapRequest_DeletePriceSets)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeletePriceSets.class.php");
		return parent::__soapCall("DeletePriceSets",array($PlentySoapRequest_DeletePriceSets));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetMarketItemNumbers GetMarketItemNumbers(PlentySoapRequest_GetMarketItemNumbers $PlentySoapRequest_GetMarketItemNumbers)
	 *
	 * @param PlentySoapRequest_GetMarketItemNumbers $PlentySoapRequest_GetMarketItemNumbers
	 *
	 * @return PlentySoapResponse_GetMarketItemNumbers
	 */
	public function GetMarketItemNumbers(PlentySoapRequest_GetMarketItemNumbers $PlentySoapRequest_GetMarketItemNumbers)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetMarketItemNumbers.class.php");
		return parent::__soapCall("GetMarketItemNumbers",array($PlentySoapRequest_GetMarketItemNumbers));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetMarketItemNumbers SetMarketItemNumbers(PlentySoapRequest_SetMarketItemNumbers $PlentySoapRequest_SetMarketItemNumbers)
	 *
	 * @param PlentySoapRequest_SetMarketItemNumbers $PlentySoapRequest_SetMarketItemNumbers
	 *
	 * @return PlentySoapResponse_SetMarketItemNumbers
	 */
	public function SetMarketItemNumbers(PlentySoapRequest_SetMarketItemNumbers $PlentySoapRequest_SetMarketItemNumbers)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetMarketItemNumbers.class.php");
		return parent::__soapCall("SetMarketItemNumbers",array($PlentySoapRequest_SetMarketItemNumbers));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemAttributes GetItemAttributes(PlentySoapRequest_GetItemAttributes $PlentySoapRequest_GetItemAttributes)
	 *
	 * @param PlentySoapRequest_GetItemAttributes $PlentySoapRequest_GetItemAttributes
	 *
	 * @return PlentySoapResponse_GetItemAttributes
	 */
	public function GetItemAttributes(PlentySoapRequest_GetItemAttributes $PlentySoapRequest_GetItemAttributes)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemAttributes.class.php");
		return parent::__soapCall("GetItemAttributes",array($PlentySoapRequest_GetItemAttributes));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemsTexts SetItemsTexts(PlentySoapRequest_SetItemsTexts $PlentySoapRequest_SetItemsTexts)
	 *
	 * @param PlentySoapRequest_SetItemsTexts $PlentySoapRequest_SetItemsTexts
	 *
	 * @return PlentySoapResponse_SetItemsTexts
	 */
	public function SetItemsTexts(PlentySoapRequest_SetItemsTexts $PlentySoapRequest_SetItemsTexts)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemsTexts.class.php");
		return parent::__soapCall("SetItemsTexts",array($PlentySoapRequest_SetItemsTexts));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsTexts GetItemsTexts(PlentySoapRequest_GetItemsTexts $PlentySoapRequest_GetItemsTexts)
	 *
	 * @param PlentySoapRequest_GetItemsTexts $PlentySoapRequest_GetItemsTexts
	 *
	 * @return PlentySoapResponse_GetItemsTexts
	 */
	public function GetItemsTexts(PlentySoapRequest_GetItemsTexts $PlentySoapRequest_GetItemsTexts)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsTexts.class.php");
		return parent::__soapCall("GetItemsTexts",array($PlentySoapRequest_GetItemsTexts));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteItemAttribute DeleteItemAttribute(PlentySoapRequest_DeleteItemAttribute $PlentySoapRequest_DeleteItemAttribute)
	 *
	 * @param PlentySoapRequest_DeleteItemAttribute $PlentySoapRequest_DeleteItemAttribute
	 *
	 * @return PlentySoapResponse_DeleteItemAttribute
	 */
	public function DeleteItemAttribute(PlentySoapRequest_DeleteItemAttribute $PlentySoapRequest_DeleteItemAttribute)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteItemAttribute.class.php");
		return parent::__soapCall("DeleteItemAttribute",array($PlentySoapRequest_DeleteItemAttribute));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SearchItemsSKU SearchItemsSKU(PlentySoapRequest_SearchItemsSKU $PlentySoapRequest_SearchItemsSKU)
	 *
	 * @param PlentySoapRequest_SearchItemsSKU $PlentySoapRequest_SearchItemsSKU
	 *
	 * @return PlentySoapResponse_SearchItemsSKU
	 */
	public function SearchItemsSKU(PlentySoapRequest_SearchItemsSKU $PlentySoapRequest_SearchItemsSKU)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SearchItemsSKU.class.php");
		return parent::__soapCall("SearchItemsSKU",array($PlentySoapRequest_SearchItemsSKU));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemsFreeTextFields SetItemsFreeTextFields(PlentySoapRequest_SetItemsFreeTextFields $PlentySoapRequest_SetItemsFreeTextFields)
	 *
	 * @param PlentySoapRequest_SetItemsFreeTextFields $PlentySoapRequest_SetItemsFreeTextFields
	 *
	 * @return PlentySoapResponse_SetItemsFreeTextFields
	 */
	public function SetItemsFreeTextFields(PlentySoapRequest_SetItemsFreeTextFields $PlentySoapRequest_SetItemsFreeTextFields)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemsFreeTextFields.class.php");
		return parent::__soapCall("SetItemsFreeTextFields",array($PlentySoapRequest_SetItemsFreeTextFields));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetStoreCategories SetStoreCategories(PlentySoapRequest_SetStoreCategories $PlentySoapRequest_SetStoreCategories)
	 *
	 * @param PlentySoapRequest_SetStoreCategories $PlentySoapRequest_SetStoreCategories
	 *
	 * @return PlentySoapResponse_SetStoreCategories
	 */
	public function SetStoreCategories(PlentySoapRequest_SetStoreCategories $PlentySoapRequest_SetStoreCategories)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetStoreCategories.class.php");
		return parent::__soapCall("SetStoreCategories",array($PlentySoapRequest_SetStoreCategories));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetItemsWarehouseSettings SetItemsWarehouseSettings(PlentySoapRequest_SetItemsWarehouseSettings $PlentySoapRequest_SetItemsWarehouseSettings)
	 *
	 * @param PlentySoapRequest_SetItemsWarehouseSettings $PlentySoapRequest_SetItemsWarehouseSettings
	 *
	 * @return PlentySoapResponse_SetItemsWarehouseSettings
	 */
	public function SetItemsWarehouseSettings(PlentySoapRequest_SetItemsWarehouseSettings $PlentySoapRequest_SetItemsWarehouseSettings)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetItemsWarehouseSettings.class.php");
		return parent::__soapCall("SetItemsWarehouseSettings",array($PlentySoapRequest_SetItemsWarehouseSettings));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsWarehouseSettings GetItemsWarehouseSettings(PlentySoapRequest_GetItemsWarehouseSettings $PlentySoapRequest_GetItemsWarehouseSettings)
	 *
	 * @param PlentySoapRequest_GetItemsWarehouseSettings $PlentySoapRequest_GetItemsWarehouseSettings
	 *
	 * @return PlentySoapResponse_GetItemsWarehouseSettings
	 */
	public function GetItemsWarehouseSettings(PlentySoapRequest_GetItemsWarehouseSettings $PlentySoapRequest_GetItemsWarehouseSettings)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsWarehouseSettings.class.php");
		return parent::__soapCall("GetItemsWarehouseSettings",array($PlentySoapRequest_GetItemsWarehouseSettings));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsPreviewLink GetItemsPreviewLink(PlentySoapRequest_GetItemsPreviewLink $PlentySoapRequest_GetItemsPreviewLink)
	 *
	 * @param PlentySoapRequest_GetItemsPreviewLink $PlentySoapRequest_GetItemsPreviewLink
	 *
	 * @return PlentySoapResponse_GetItemsPreviewLink
	 */
	public function GetItemsPreviewLink(PlentySoapRequest_GetItemsPreviewLink $PlentySoapRequest_GetItemsPreviewLink)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsPreviewLink.class.php");
		return parent::__soapCall("GetItemsPreviewLink",array($PlentySoapRequest_GetItemsPreviewLink));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsSearchData GetItemsSearchData(PlentySoapRequest_GetItemsSearchData $PlentySoapRequest_GetItemsSearchData)
	 *
	 * @param PlentySoapRequest_GetItemsSearchData $PlentySoapRequest_GetItemsSearchData
	 *
	 * @return PlentySoapResponse_GetItemsSearchData
	 */
	public function GetItemsSearchData(PlentySoapRequest_GetItemsSearchData $PlentySoapRequest_GetItemsSearchData)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsSearchData.class.php");
		return parent::__soapCall("GetItemsSearchData",array($PlentySoapRequest_GetItemsSearchData));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsDefaultShippingCost GetItemsDefaultShippingCost(PlentySoapRequest_GetItemsDefaultShippingCost $PlentySoapRequest_GetItemsDefaultShippingCost)
	 *
	 * @param PlentySoapRequest_GetItemsDefaultShippingCost $PlentySoapRequest_GetItemsDefaultShippingCost
	 *
	 * @return PlentySoapResponse_GetItemsDefaultShippingCost
	 */
	public function GetItemsDefaultShippingCost(PlentySoapRequest_GetItemsDefaultShippingCost $PlentySoapRequest_GetItemsDefaultShippingCost)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsDefaultShippingCost.class.php");
		return parent::__soapCall("GetItemsDefaultShippingCost",array($PlentySoapRequest_GetItemsDefaultShippingCost));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_AddOrderNotes AddOrderNotes(PlentySoapRequest_AddOrderNotes $oPlentySoapRequest_AddOrderNotes)
	 *
	 * @param PlentySoapRequest_AddOrderNotes $oPlentySoapRequest_AddOrderNotes
	 *
	 * @return PlentySoapResponse_AddOrderNotes
	 */
	public function AddOrderNotes(PlentySoapRequest_AddOrderNotes $oPlentySoapRequest_AddOrderNotes)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_AddOrderNotes.class.php");
		return parent::__soapCall("AddOrderNotes",array($oPlentySoapRequest_AddOrderNotes));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetDeliveryOrders SetDeliveryOrders(PlentySoapRequest_SetDeliveryOrders $oPlentySoapRequest_SetDeliveryOrders)
	 *
	 * @param PlentySoapRequest_SetDeliveryOrders $oPlentySoapRequest_SetDeliveryOrders
	 *
	 * @return PlentySoapResponse_SetDeliveryOrders
	 */
	public function SetDeliveryOrders(PlentySoapRequest_SetDeliveryOrders $oPlentySoapRequest_SetDeliveryOrders)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetDeliveryOrders.class.php");
		return parent::__soapCall("SetDeliveryOrders",array($oPlentySoapRequest_SetDeliveryOrders));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetDeliveryOrders GetDeliveryOrders(PlentySoapRequest_GetDeliveryOrders $oPlentySoapRequest_GetDeliveryOrders)
	 *
	 * @param PlentySoapRequest_GetDeliveryOrders $oPlentySoapRequest_GetDeliveryOrders
	 *
	 * @return PlentySoapResponse_GetDeliveryOrders
	 */
	public function GetDeliveryOrders(PlentySoapRequest_GetDeliveryOrders $oPlentySoapRequest_GetDeliveryOrders)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetDeliveryOrders.class.php");
		return parent::__soapCall("GetDeliveryOrders",array($oPlentySoapRequest_GetDeliveryOrders));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_AddDocument AddDocument(PlentySoapRequest_AddDocument $oPlentySoapRequest_AddDocument)
	 *
	 * @param PlentySoapRequest_AddDocument $oPlentySoapRequest_AddDocument
	 *
	 * @return PlentySoapResponse_AddDocument
	 */
	public function AddDocument(PlentySoapRequest_AddDocument $oPlentySoapRequest_AddDocument)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_AddDocument.class.php");
		return parent::__soapCall("AddDocument",array($oPlentySoapRequest_AddDocument));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetOrderDocument GetOrderDocument(PlentySoapRequest_GetOrderDocument $oPlentySoapRequest_GetOrderDocument)
	 *
	 * @param PlentySoapRequest_GetOrderDocument $oPlentySoapRequest_GetOrderDocument
	 *
	 * @return PlentySoapResponse_GetOrderDocument
	 */
	public function GetOrderDocument(PlentySoapRequest_GetOrderDocument $oPlentySoapRequest_GetOrderDocument)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetOrderDocument.class.php");
		return parent::__soapCall("GetOrderDocument",array($oPlentySoapRequest_GetOrderDocument));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetOrderStatus SetOrderStatus(PlentySoapRequest_SetOrderStatus $PlentySoapRequest_SetOrderStatus)
	 *
	 * @param PlentySoapRequest_SetOrderStatus $PlentySoapRequest_SetOrderStatus
	 *
	 * @return PlentySoapResponse_SetOrderStatus
	 */
	public function SetOrderStatus(PlentySoapRequest_SetOrderStatus $PlentySoapRequest_SetOrderStatus)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetOrderStatus.class.php");
		return parent::__soapCall("SetOrderStatus",array($PlentySoapRequest_SetOrderStatus));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetOrderStatusList GetOrderStatusList(PlentySoapRequest_GetOrderStatusList $oPlentySoapRequest_GetOrderStatusList)
	 *
	 * @param PlentySoapRequest_GetOrderStatusList $oPlentySoapRequest_GetOrderStatusList
	 *
	 * @return PlentySoapResponse_GetOrderStatusList
	 */
	public function GetOrderStatusList(PlentySoapRequest_GetOrderStatusList $oPlentySoapRequest_GetOrderStatusList)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetOrderStatusList.class.php");
		return parent::__soapCall("GetOrderStatusList",array($oPlentySoapRequest_GetOrderStatusList));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_AddOrders AddOrders(PlentySoapRequest_AddOrders $oPlentySoapRequest_AddOrders)
	 *
	 * @param PlentySoapRequest_AddOrders $oPlentySoapRequest_AddOrders
	 *
	 * @return PlentySoapResponse_AddOrders
	 */
	public function AddOrders(PlentySoapRequest_AddOrders $oPlentySoapRequest_AddOrders)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_AddOrders.class.php");
		return parent::__soapCall("AddOrders",array($oPlentySoapRequest_AddOrders));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteOrderItems DeleteOrderItems(PlentySoapRequest_DeleteOrderItems $oPlentySoapRequest_DeleteOrderItems)
	 *
	 * @param PlentySoapRequest_DeleteOrderItems $oPlentySoapRequest_DeleteOrderItems
	 *
	 * @return PlentySoapResponse_DeleteOrderItems
	 */
	public function DeleteOrderItems(PlentySoapRequest_DeleteOrderItems $oPlentySoapRequest_DeleteOrderItems)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteOrderItems.class.php");
		return parent::__soapCall("DeleteOrderItems",array($oPlentySoapRequest_DeleteOrderItems));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetOrderItems SetOrderItems(PlentySoapRequest_SetOrderItems $oPlentySoapRequest_SetOrderItems)
	 *
	 * @param PlentySoapRequest_SetOrderItems $oPlentySoapRequest_SetOrderItems
	 *
	 * @return PlentySoapResponse_SetOrderItems
	 */
	public function SetOrderItems(PlentySoapRequest_SetOrderItems $oPlentySoapRequest_SetOrderItems)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetOrderItems.class.php");
		return parent::__soapCall("SetOrderItems",array($oPlentySoapRequest_SetOrderItems));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetOrdersHead SetOrdersHead(PlentySoapRequest_SetOrdersHead $oPlentySoapRequest_SetOrdersHead)
	 *
	 * @param PlentySoapRequest_SetOrdersHead $oPlentySoapRequest_SetOrdersHead
	 *
	 * @return PlentySoapResponse_SetOrdersHead
	 */
	public function SetOrdersHead(PlentySoapRequest_SetOrdersHead $oPlentySoapRequest_SetOrdersHead)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetOrdersHead.class.php");
		return parent::__soapCall("SetOrdersHead",array($oPlentySoapRequest_SetOrdersHead));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetBookOutgoingItems SetBookOutgoingItems(PlentySoapRequest_SetBookOutgoingItems $oPlentySoapRequest_SetBookOutgoingItems)
	 *
	 * @param PlentySoapRequest_SetBookOutgoingItems $oPlentySoapRequest_SetBookOutgoingItems
	 *
	 * @return PlentySoapResponse_SetBookOutgoingItems
	 */
	public function SetBookOutgoingItems(PlentySoapRequest_SetBookOutgoingItems $oPlentySoapRequest_SetBookOutgoingItems)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetBookOutgoingItems.class.php");
		return parent::__soapCall("SetBookOutgoingItems",array($oPlentySoapRequest_SetBookOutgoingItems));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetBackPostOutgoingItems SetBackPostOutgoingItems(PlentySoapRequest_SetBackPostOutgoingItems $oPlentySoapRequest_SetBackPostOutgoingItems)
	 *
	 * @param PlentySoapRequest_SetBackPostOutgoingItems $oPlentySoapRequest_SetBackPostOutgoingItems
	 *
	 * @return PlentySoapResponse_SetBackPostOutgoingItems
	 */
	public function SetBackPostOutgoingItems(PlentySoapRequest_SetBackPostOutgoingItems $oPlentySoapRequest_SetBackPostOutgoingItems)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetBackPostOutgoingItems.class.php");
		return parent::__soapCall("SetBackPostOutgoingItems",array($oPlentySoapRequest_SetBackPostOutgoingItems));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_AddOrdersPackageNumber AddOrdersPackageNumber(PlentySoapRequest_AddOrdersPackageNumber $oAddOrdersPackageNumberRequest)
	 *
	 * @param PlentySoapRequest_AddOrdersPackageNumber $oAddOrdersPackageNumberRequest
	 *
	 * @return PlentySoapResponse_AddOrdersPackageNumber
	 */
	public function AddOrdersPackageNumber(PlentySoapRequest_AddOrdersPackageNumber $oAddOrdersPackageNumberRequest)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_AddOrdersPackageNumber.class.php");
		return parent::__soapCall("AddOrdersPackageNumber",array($oAddOrdersPackageNumberRequest));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteOrderPackageNumber DeleteOrderPackageNumber(PlentySoapRequest_DeleteOrderPackageNumber $oPlentySoapRequest_DeleteOrderPackageNumber)
	 *
	 * @param PlentySoapRequest_DeleteOrderPackageNumber $oPlentySoapRequest_DeleteOrderPackageNumber
	 *
	 * @return PlentySoapResponse_DeleteOrderPackageNumber
	 */
	public function DeleteOrderPackageNumber(PlentySoapRequest_DeleteOrderPackageNumber $oPlentySoapRequest_DeleteOrderPackageNumber)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteOrderPackageNumber.class.php");
		return parent::__soapCall("DeleteOrderPackageNumber",array($oPlentySoapRequest_DeleteOrderPackageNumber));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetOrdersPaymentInformation GetOrdersPaymentInformation(PlentySoapRequest_GetOrdersPaymentInformation $oPlentySoapRequest_GetOrdersPaymentInformation)
	 *
	 * @param PlentySoapRequest_GetOrdersPaymentInformation $oPlentySoapRequest_GetOrdersPaymentInformation
	 *
	 * @return PlentySoapResponse_GetOrdersPaymentInformation
	 */
	public function GetOrdersPaymentInformation(PlentySoapRequest_GetOrdersPaymentInformation $oPlentySoapRequest_GetOrdersPaymentInformation)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetOrdersPaymentInformation.class.php");
		return parent::__soapCall("GetOrdersPaymentInformation",array($oPlentySoapRequest_GetOrdersPaymentInformation));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetOrdersShipmentNumbers GetOrdersShipmentNumbers(PlentySoapRequest_GetOrdersShipmentNumbers $oPlentySoapRequest_GetOrdersShipmentNumbers)
	 *
	 * @param PlentySoapRequest_GetOrdersShipmentNumbers $oPlentySoapRequest_GetOrdersShipmentNumbers
	 *
	 * @return PlentySoapResponse_GetOrdersShipmentNumbers
	 */
	public function GetOrdersShipmentNumbers(PlentySoapRequest_GetOrdersShipmentNumbers $oPlentySoapRequest_GetOrdersShipmentNumbers)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetOrdersShipmentNumbers.class.php");
		return parent::__soapCall("GetOrdersShipmentNumbers",array($oPlentySoapRequest_GetOrdersShipmentNumbers));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SearchOrders SearchOrders(PlentySoapRequest_SearchOrders $oPlentySoapRequest_SearchOrders)
	 *
	 * @param PlentySoapRequest_SearchOrders $oPlentySoapRequest_SearchOrders
	 *
	 * @return PlentySoapResponse_SearchOrders
	 */
	public function SearchOrders(PlentySoapRequest_SearchOrders $oPlentySoapRequest_SearchOrders)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SearchOrders.class.php");
		return parent::__soapCall("SearchOrders",array($oPlentySoapRequest_SearchOrders));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetMethodOfPayments GetMethodOfPayments(PlentySoapRequest_GetMethodOfPayments $oPlentySoapRequest_GetMethodOfPayments)
	 *
	 * @param PlentySoapRequest_GetMethodOfPayments $oPlentySoapRequest_GetMethodOfPayments
	 *
	 * @return PlentySoapResponse_GetMethodOfPayments
	 */
	public function GetMethodOfPayments(PlentySoapRequest_GetMethodOfPayments $oPlentySoapRequest_GetMethodOfPayments)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetMethodOfPayments.class.php");
		return parent::__soapCall("GetMethodOfPayments",array($oPlentySoapRequest_GetMethodOfPayments));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_AddIncomingPayments AddIncomingPayments(PlentySoapRequest_AddIncomingPayments $oPlentySoapRequest_AddIncomingPayments)
	 *
	 * @param PlentySoapRequest_AddIncomingPayments $oPlentySoapRequest_AddIncomingPayments
	 *
	 * @return PlentySoapResponse_AddIncomingPayments
	 */
	public function AddIncomingPayments(PlentySoapRequest_AddIncomingPayments $oPlentySoapRequest_AddIncomingPayments)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_AddIncomingPayments.class.php");
		return parent::__soapCall("AddIncomingPayments",array($oPlentySoapRequest_AddIncomingPayments));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetIncomingPayments GetIncomingPayments(PlentySoapRequest_GetIncomingPayments $oPlentySoapRequest_GetIncomingPayments)
	 *
	 * @param PlentySoapRequest_GetIncomingPayments $oPlentySoapRequest_GetIncomingPayments
	 *
	 * @return PlentySoapResponse_GetIncomingPayments
	 */
	public function GetIncomingPayments(PlentySoapRequest_GetIncomingPayments $oPlentySoapRequest_GetIncomingPayments)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetIncomingPayments.class.php");
		return parent::__soapCall("GetIncomingPayments",array($oPlentySoapRequest_GetIncomingPayments));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetShippingServiceProvider GetShippingServiceProvider()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetShippingServiceProvider
	 */
	public function GetShippingServiceProvider()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetShippingServiceProvider.class.php");
		return parent::__soapCall("GetShippingServiceProvider",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetShippingProfiles GetShippingProfiles(PlentySoapRequest_GetShippingProfiles $oPlentySoapRequest_GetShippingProfiles)
	 *
	 * @param PlentySoapRequest_GetShippingProfiles $oPlentySoapRequest_GetShippingProfiles
	 *
	 * @return PlentySoapResponse_GetShippingProfiles
	 */
	public function GetShippingProfiles(PlentySoapRequest_GetShippingProfiles $oPlentySoapRequest_GetShippingProfiles)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetShippingProfiles.class.php");
		return parent::__soapCall("GetShippingProfiles",array($oPlentySoapRequest_GetShippingProfiles));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetShippingProfileConfigurations GetShippingProfileConfigurations(PlentySoapRequest_GetShippingProfileConfigurations $oPlentySoapRequest_GetShippingProfileConfigurations)
	 *
	 * @param PlentySoapRequest_GetShippingProfileConfigurations $oPlentySoapRequest_GetShippingProfileConfigurations
	 *
	 * @return PlentySoapResponse_GetShippingProfileConfigurations
	 */
	public function GetShippingProfileConfigurations(PlentySoapRequest_GetShippingProfileConfigurations $oPlentySoapRequest_GetShippingProfileConfigurations)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetShippingProfileConfigurations.class.php");
		return parent::__soapCall("GetShippingProfileConfigurations",array($oPlentySoapRequest_GetShippingProfileConfigurations));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_AddShippingProfile AddShippingProfile(PlentySoapRequest_AddShippingProfile $oPlentySoapRequest_AddShippingProfile)
	 *
	 * @param PlentySoapRequest_AddShippingProfile $oPlentySoapRequest_AddShippingProfile
	 *
	 * @return PlentySoapResponse_AddShippingProfile
	 */
	public function AddShippingProfile(PlentySoapRequest_AddShippingProfile $oPlentySoapRequest_AddShippingProfile)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_AddShippingProfile.class.php");
		return parent::__soapCall("AddShippingProfile",array($oPlentySoapRequest_AddShippingProfile));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetSalesOrderReferrer GetSalesOrderReferrer()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetSalesOrderReferrer
	 */
	public function GetSalesOrderReferrer()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetSalesOrderReferrer.class.php");
		return parent::__soapCall("GetSalesOrderReferrer",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetEmailTemplate GetEmailTemplate(PlentySoapRequest_GetEmailTemplate $oPlentySoapRequest_GetEmailTemplate)
	 *
	 * @param PlentySoapRequest_GetEmailTemplate $oPlentySoapRequest_GetEmailTemplate
	 *
	 * @return PlentySoapResponse_GetEmailTemplate
	 */
	public function GetEmailTemplate(PlentySoapRequest_GetEmailTemplate $oPlentySoapRequest_GetEmailTemplate)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetEmailTemplate.class.php");
		return parent::__soapCall("GetEmailTemplate",array($oPlentySoapRequest_GetEmailTemplate));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteEmailTemplates DeleteEmailTemplates(PlentySoapRequest_DeleteEmailTemplates $oPlentySoapRequest_DeleteEmailTemplates)
	 *
	 * @param PlentySoapRequest_DeleteEmailTemplates $oPlentySoapRequest_DeleteEmailTemplates
	 *
	 * @return PlentySoapResponse_DeleteEmailTemplates
	 */
	public function DeleteEmailTemplates(PlentySoapRequest_DeleteEmailTemplates $oPlentySoapRequest_DeleteEmailTemplates)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteEmailTemplates.class.php");
		return parent::__soapCall("DeleteEmailTemplates",array($oPlentySoapRequest_DeleteEmailTemplates));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetEmailTemplates SetEmailTemplates(PlentySoapRequest_SetEmailTemplates $oPlentySoapRequest_SetEmailTemplates)
	 *
	 * @param PlentySoapRequest_SetEmailTemplates $oPlentySoapRequest_SetEmailTemplates
	 *
	 * @return PlentySoapResponse_SetEmailTemplates
	 */
	public function SetEmailTemplates(PlentySoapRequest_SetEmailTemplates $oPlentySoapRequest_SetEmailTemplates)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetEmailTemplates.class.php");
		return parent::__soapCall("SetEmailTemplates",array($oPlentySoapRequest_SetEmailTemplates));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetEmailTemplates GetEmailTemplates(PlentySoapRequest_GetEmailTemplates $oPlentySoapRequest_GetEmailTemplates)
	 *
	 * @param PlentySoapRequest_GetEmailTemplates $oPlentySoapRequest_GetEmailTemplates
	 *
	 * @return PlentySoapResponse_GetEmailTemplates
	 */
	public function GetEmailTemplates(PlentySoapRequest_GetEmailTemplates $oPlentySoapRequest_GetEmailTemplates)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetEmailTemplates.class.php");
		return parent::__soapCall("GetEmailTemplates",array($oPlentySoapRequest_GetEmailTemplates));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetOrdersInvoiceDocumentURLs GetOrdersInvoiceDocumentURLs(PlentySoapRequest_GetOrdersInvoiceDocumentURLs $oPlentySoapRequest_GetOrdersInvoiceDocumentURLs)
	 *
	 * @param PlentySoapRequest_GetOrdersInvoiceDocumentURLs $oPlentySoapRequest_GetOrdersInvoiceDocumentURLs
	 *
	 * @return PlentySoapResponse_GetOrdersInvoiceDocumentURLs
	 */
	public function GetOrdersInvoiceDocumentURLs(PlentySoapRequest_GetOrdersInvoiceDocumentURLs $oPlentySoapRequest_GetOrdersInvoiceDocumentURLs)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetOrdersInvoiceDocumentURLs.class.php");
		return parent::__soapCall("GetOrdersInvoiceDocumentURLs",array($oPlentySoapRequest_GetOrdersInvoiceDocumentURLs));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetOrdersCreditNoteDocumentURLs GetOrdersCreditNoteDocumentURLs(PlentySoapRequest_GetOrdersCreditNoteDocumentURLs $oPlentySoapRequest_GetOrdersCreditNoteDocumentURLs)
	 *
	 * @param PlentySoapRequest_GetOrdersCreditNoteDocumentURLs $oPlentySoapRequest_GetOrdersCreditNoteDocumentURLs
	 *
	 * @return PlentySoapResponse_GetOrdersCreditNoteDocumentURLs
	 */
	public function GetOrdersCreditNoteDocumentURLs(PlentySoapRequest_GetOrdersCreditNoteDocumentURLs $oPlentySoapRequest_GetOrdersCreditNoteDocumentURLs)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetOrdersCreditNoteDocumentURLs.class.php");
		return parent::__soapCall("GetOrdersCreditNoteDocumentURLs",array($oPlentySoapRequest_GetOrdersCreditNoteDocumentURLs));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetOrdersDeliveryNoteDocumentURLs GetOrdersDeliveryNoteDocumentURLs(PlentySoapRequest_GetOrdersDeliveryNoteDocumentURLs $oPlentySoapRequest_GetOrdersDeliveryNoteDocumentURLs)
	 *
	 * @param PlentySoapRequest_GetOrdersDeliveryNoteDocumentURLs $oPlentySoapRequest_GetOrdersDeliveryNoteDocumentURLs
	 *
	 * @return PlentySoapResponse_GetOrdersDeliveryNoteDocumentURLs
	 */
	public function GetOrdersDeliveryNoteDocumentURLs(PlentySoapRequest_GetOrdersDeliveryNoteDocumentURLs $oPlentySoapRequest_GetOrdersDeliveryNoteDocumentURLs)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetOrdersDeliveryNoteDocumentURLs.class.php");
		return parent::__soapCall("GetOrdersDeliveryNoteDocumentURLs",array($oPlentySoapRequest_GetOrdersDeliveryNoteDocumentURLs));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetOrdersDunningLetterDocumentURLs GetOrdersDunningLetterDocumentURLs(PlentySoapRequest_GetOrdersDunningLetterDocumentURLs $oPlentySoapRequest_GetOrdersDunningLetterDocumentURLs)
	 *
	 * @param PlentySoapRequest_GetOrdersDunningLetterDocumentURLs $oPlentySoapRequest_GetOrdersDunningLetterDocumentURLs
	 *
	 * @return PlentySoapResponse_GetOrdersDunningLetterDocumentURLs
	 */
	public function GetOrdersDunningLetterDocumentURLs(PlentySoapRequest_GetOrdersDunningLetterDocumentURLs $oPlentySoapRequest_GetOrdersDunningLetterDocumentURLs)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetOrdersDunningLetterDocumentURLs.class.php");
		return parent::__soapCall("GetOrdersDunningLetterDocumentURLs",array($oPlentySoapRequest_GetOrdersDunningLetterDocumentURLs));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetOrdersOfferDocumentURLs GetOrdersOfferDocumentURLs(PlentySoapRequest_GetOrdersOfferDocumentURLs $oPlentySoapRequest_GetOrdersOfferDocumentURLs)
	 *
	 * @param PlentySoapRequest_GetOrdersOfferDocumentURLs $oPlentySoapRequest_GetOrdersOfferDocumentURLs
	 *
	 * @return PlentySoapResponse_GetOrdersOfferDocumentURLs
	 */
	public function GetOrdersOfferDocumentURLs(PlentySoapRequest_GetOrdersOfferDocumentURLs $oPlentySoapRequest_GetOrdersOfferDocumentURLs)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetOrdersOfferDocumentURLs.class.php");
		return parent::__soapCall("GetOrdersOfferDocumentURLs",array($oPlentySoapRequest_GetOrdersOfferDocumentURLs));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetOrdersOrderConfirmationDocumentURLs GetOrdersOrderConfirmationDocumentURLs(PlentySoapRequest_GetOrdersOrderConfirmationDocumentURLs $oPlentySoapRequest_GetOrdersOrderConfirmationDocumentURLs)
	 *
	 * @param PlentySoapRequest_GetOrdersOrderConfirmationDocumentURLs $oPlentySoapRequest_GetOrdersOrderConfirmationDocumentURLs
	 *
	 * @return PlentySoapResponse_GetOrdersOrderConfirmationDocumentURLs
	 */
	public function GetOrdersOrderConfirmationDocumentURLs(PlentySoapRequest_GetOrdersOrderConfirmationDocumentURLs $oPlentySoapRequest_GetOrdersOrderConfirmationDocumentURLs)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetOrdersOrderConfirmationDocumentURLs.class.php");
		return parent::__soapCall("GetOrdersOrderConfirmationDocumentURLs",array($oPlentySoapRequest_GetOrdersOrderConfirmationDocumentURLs));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetReturns GetReturns(PlentySoapRequest_GetReturns $oPlentySoapRequest_GetReturns)
	 *
	 * @param PlentySoapRequest_GetReturns $oPlentySoapRequest_GetReturns
	 *
	 * @return PlentySoapResponse_GetReturns
	 */
	public function GetReturns(PlentySoapRequest_GetReturns $oPlentySoapRequest_GetReturns)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetReturns.class.php");
		return parent::__soapCall("GetReturns",array($oPlentySoapRequest_GetReturns));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetReturns SetReturns(PlentySoapRequest_SetReturns $oPlentySoapRequest_SetReturns)
	 *
	 * @param PlentySoapRequest_SetReturns $oPlentySoapRequest_SetReturns
	 *
	 * @return PlentySoapResponse_SetReturns
	 */
	public function SetReturns(PlentySoapRequest_SetReturns $oPlentySoapRequest_SetReturns)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetReturns.class.php");
		return parent::__soapCall("SetReturns",array($oPlentySoapRequest_SetReturns));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetRepairs SetRepairs(PlentySoapRequest_SetRepairs $oPlentySoapRequest_SetRepairs)
	 *
	 * @param PlentySoapRequest_SetRepairs $oPlentySoapRequest_SetRepairs
	 *
	 * @return PlentySoapResponse_SetRepairs
	 */
	public function SetRepairs(PlentySoapRequest_SetRepairs $oPlentySoapRequest_SetRepairs)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetRepairs.class.php");
		return parent::__soapCall("SetRepairs",array($oPlentySoapRequest_SetRepairs));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetCreditNotes SetCreditNotes(PlentySoapRequest_SetCreditNotes $oPlentySoapRequest_SetCreditNotes)
	 *
	 * @param PlentySoapRequest_SetCreditNotes $oPlentySoapRequest_SetCreditNotes
	 *
	 * @return PlentySoapResponse_SetCreditNotes
	 */
	public function SetCreditNotes(PlentySoapRequest_SetCreditNotes $oPlentySoapRequest_SetCreditNotes)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetCreditNotes.class.php");
		return parent::__soapCall("SetCreditNotes",array($oPlentySoapRequest_SetCreditNotes));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetWarranties SetWarranties(PlentySoapRequest_SetWarranties $oPlentySoapRequest_SetWarranties)
	 *
	 * @param PlentySoapRequest_SetWarranties $oPlentySoapRequest_SetWarranties
	 *
	 * @return PlentySoapResponse_SetWarranties
	 */
	public function SetWarranties(PlentySoapRequest_SetWarranties $oPlentySoapRequest_SetWarranties)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetWarranties.class.php");
		return parent::__soapCall("SetWarranties",array($oPlentySoapRequest_SetWarranties));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetReasonsForReturn GetReasonsForReturn()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetReasonsForReturn
	 */
	public function GetReasonsForReturn()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetReasonsForReturn.class.php");
		return parent::__soapCall("GetReasonsForReturn",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetReorders SetReorders(PlentySoapRequest_SetReorders $oPlentySoapRequest_SetReorders)
	 *
	 * @param PlentySoapRequest_SetReorders $oPlentySoapRequest_SetReorders
	 *
	 * @return PlentySoapResponse_SetReorders
	 */
	public function SetReorders(PlentySoapRequest_SetReorders $oPlentySoapRequest_SetReorders)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetReorders.class.php");
		return parent::__soapCall("SetReorders",array($oPlentySoapRequest_SetReorders));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetReorder GetReorder(PlentySoapRequest_GetReorder $oPlentySoapRequest_GetReorder)
	 *
	 * @param PlentySoapRequest_GetReorder $oPlentySoapRequest_GetReorder
	 *
	 * @return PlentySoapResponse_GetReorder
	 */
	public function GetReorder(PlentySoapRequest_GetReorder $oPlentySoapRequest_GetReorder)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetReorder.class.php");
		return parent::__soapCall("GetReorder",array($oPlentySoapRequest_GetReorder));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteReorder DeleteReorder(PlentySoapRequest_DeleteReorder $oPlentySoapRequest_DeleteReorder)
	 *
	 * @param PlentySoapRequest_DeleteReorder $oPlentySoapRequest_DeleteReorder
	 *
	 * @return PlentySoapResponse_DeleteReorder
	 */
	public function DeleteReorder(PlentySoapRequest_DeleteReorder $oPlentySoapRequest_DeleteReorder)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteReorder.class.php");
		return parent::__soapCall("DeleteReorder",array($oPlentySoapRequest_DeleteReorder));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetMarketplaceTransactions GetMarketplaceTransactions(PlentySoapRequest_GetMarketplaceTransactions $oPlentySoapRequest_GetMarketplaceTransactions)
	 *
	 * @param PlentySoapRequest_GetMarketplaceTransactions $oPlentySoapRequest_GetMarketplaceTransactions
	 *
	 * @return PlentySoapResponse_GetMarketplaceTransactions
	 */
	public function GetMarketplaceTransactions(PlentySoapRequest_GetMarketplaceTransactions $oPlentySoapRequest_GetMarketplaceTransactions)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetMarketplaceTransactions.class.php");
		return parent::__soapCall("GetMarketplaceTransactions",array($oPlentySoapRequest_GetMarketplaceTransactions));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetOrderStatusHistory GetOrderStatusHistory(PlentySoapRequest_GetOrderStatusHistory $oPlentySoapRequest_GetOrderStatusHistory)
	 *
	 * @param PlentySoapRequest_GetOrderStatusHistory $oPlentySoapRequest_GetOrderStatusHistory
	 *
	 * @return PlentySoapResponse_GetOrderStatusHistory
	 */
	public function GetOrderStatusHistory(PlentySoapRequest_GetOrderStatusHistory $oPlentySoapRequest_GetOrderStatusHistory)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetOrderStatusHistory.class.php");
		return parent::__soapCall("GetOrderStatusHistory",array($oPlentySoapRequest_GetOrderStatusHistory));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_AddOrderStatusHistory AddOrderStatusHistory(PlentySoapRequest_AddOrderStatusHistory $oPlentySoapRequest_AddOrderStatusHistory)
	 *
	 * @param PlentySoapRequest_AddOrderStatusHistory $oPlentySoapRequest_AddOrderStatusHistory
	 *
	 * @return PlentySoapResponse_AddOrderStatusHistory
	 */
	public function AddOrderStatusHistory(PlentySoapRequest_AddOrderStatusHistory $oPlentySoapRequest_AddOrderStatusHistory)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_AddOrderStatusHistory.class.php");
		return parent::__soapCall("AddOrderStatusHistory",array($oPlentySoapRequest_AddOrderStatusHistory));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_AddDeliveryOrder AddDeliveryOrder(PlentySoapRequest_AddDeliveryOrder $oPlentySoapRequest_AddDeliveryOrder)
	 *
	 * @param PlentySoapRequest_AddDeliveryOrder $oPlentySoapRequest_AddDeliveryOrder
	 *
	 * @return PlentySoapResponse_AddDeliveryOrder
	 */
	public function AddDeliveryOrder(PlentySoapRequest_AddDeliveryOrder $oPlentySoapRequest_AddDeliveryOrder)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_AddDeliveryOrder.class.php");
		return parent::__soapCall("AddDeliveryOrder",array($oPlentySoapRequest_AddDeliveryOrder));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCustomerOrderOverviewLink GetCustomerOrderOverviewLink(PlentySoapRequest_GetCustomerOrderOverviewLink $oPlentySoapRequest_GetCustomerOrderOverviewLink)
	 *
	 * @param PlentySoapRequest_GetCustomerOrderOverviewLink $oPlentySoapRequest_GetCustomerOrderOverviewLink
	 *
	 * @return PlentySoapResponse_GetCustomerOrderOverviewLink
	 */
	public function GetCustomerOrderOverviewLink(PlentySoapRequest_GetCustomerOrderOverviewLink $oPlentySoapRequest_GetCustomerOrderOverviewLink)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCustomerOrderOverviewLink.class.php");
		return parent::__soapCall("GetCustomerOrderOverviewLink",array($oPlentySoapRequest_GetCustomerOrderOverviewLink));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetShipmentRegistration SetShipmentRegistration(PlentySoapRequest_SetShipmentRegistration $oPlentySoapRequest_SetShipmentRegistration)
	 *
	 * @param PlentySoapRequest_SetShipmentRegistration $oPlentySoapRequest_SetShipmentRegistration
	 *
	 * @return PlentySoapResponse_SetShipmentRegistration
	 */
	public function SetShipmentRegistration(PlentySoapRequest_SetShipmentRegistration $oPlentySoapRequest_SetShipmentRegistration)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetShipmentRegistration.class.php");
		return parent::__soapCall("SetShipmentRegistration",array($oPlentySoapRequest_SetShipmentRegistration));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetOrderCheckout GetOrderCheckout(PlentySoapRequest_GetOrderCheckout $oPlentySoapRequest_GetOrderCheckout)
	 *
	 * @param PlentySoapRequest_GetOrderCheckout $oPlentySoapRequest_GetOrderCheckout
	 *
	 * @return PlentySoapResponse_GetOrderCheckout
	 */
	public function GetOrderCheckout(PlentySoapRequest_GetOrderCheckout $oPlentySoapRequest_GetOrderCheckout)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetOrderCheckout.class.php");
		return parent::__soapCall("GetOrderCheckout",array($oPlentySoapRequest_GetOrderCheckout));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetDeliveryCharges GetDeliveryCharges(PlentySoapRequest_GetDeliveryCharges $oPlentySoapRequest_GetDeliveryCharges)
	 *
	 * @param PlentySoapRequest_GetDeliveryCharges $oPlentySoapRequest_GetDeliveryCharges
	 *
	 * @return PlentySoapResponse_GetDeliveryCharges
	 */
	public function GetDeliveryCharges(PlentySoapRequest_GetDeliveryCharges $oPlentySoapRequest_GetDeliveryCharges)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetDeliveryCharges.class.php");
		return parent::__soapCall("GetDeliveryCharges",array($oPlentySoapRequest_GetDeliveryCharges));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetPartsCompatibilityListings GetPartsCompatibilityListings(PlentySoapRequest_GetPartsCompatibilityListings $oPlentySoapRequest_GetPartsCompatibilityListings)
	 *
	 * @param PlentySoapRequest_GetPartsCompatibilityListings $oPlentySoapRequest_GetPartsCompatibilityListings
	 *
	 * @return PlentySoapResponse_GetPartsCompatibilityListings
	 */
	public function GetPartsCompatibilityListings(PlentySoapRequest_GetPartsCompatibilityListings $oPlentySoapRequest_GetPartsCompatibilityListings)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetPartsCompatibilityListings.class.php");
		return parent::__soapCall("GetPartsCompatibilityListings",array($oPlentySoapRequest_GetPartsCompatibilityListings));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetPartsCompatibilityListings SetPartsCompatibilityListings(PlentySoapRequest_SetPartsCompatibilityListings $oPlentySoapRequest_SetPartsCompatibilityListings)
	 *
	 * @param PlentySoapRequest_SetPartsCompatibilityListings $oPlentySoapRequest_SetPartsCompatibilityListings
	 *
	 * @return PlentySoapResponse_SetPartsCompatibilityListings
	 */
	public function SetPartsCompatibilityListings(PlentySoapRequest_SetPartsCompatibilityListings $oPlentySoapRequest_SetPartsCompatibilityListings)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetPartsCompatibilityListings.class.php");
		return parent::__soapCall("SetPartsCompatibilityListings",array($oPlentySoapRequest_SetPartsCompatibilityListings));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetListings GetListings(PlentySoapRequest_GetListings $oPlentySoapRequest_GetListings)
	 *
	 * @param PlentySoapRequest_GetListings $oPlentySoapRequest_GetListings
	 *
	 * @return PlentySoapResponse_GetListings
	 */
	public function GetListings(PlentySoapRequest_GetListings $oPlentySoapRequest_GetListings)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetListings.class.php");
		return parent::__soapCall("GetListings",array($oPlentySoapRequest_GetListings));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_UpdateListingsStop UpdateListingsStop(PlentySoapRequest_UpdateListingsStop $oPlentySoapRequest_UpdateListingsStop)
	 *
	 * @param PlentySoapRequest_UpdateListingsStop $oPlentySoapRequest_UpdateListingsStop
	 *
	 * @return PlentySoapResponse_UpdateListingsStop
	 */
	public function UpdateListingsStop(PlentySoapRequest_UpdateListingsStop $oPlentySoapRequest_UpdateListingsStop)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_UpdateListingsStop.class.php");
		return parent::__soapCall("UpdateListingsStop",array($oPlentySoapRequest_UpdateListingsStop));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_UpdateListingsStart UpdateListingsStart(PlentySoapRequest_UpdateListingsStart $oPlentySoapRequest_UpdateListingsStart)
	 *
	 * @param PlentySoapRequest_UpdateListingsStart $oPlentySoapRequest_UpdateListingsStart
	 *
	 * @return PlentySoapResponse_UpdateListingsStart
	 */
	public function UpdateListingsStart(PlentySoapRequest_UpdateListingsStart $oPlentySoapRequest_UpdateListingsStart)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_UpdateListingsStart.class.php");
		return parent::__soapCall("UpdateListingsStart",array($oPlentySoapRequest_UpdateListingsStart));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_UpdateListingsUpdate UpdateListingsUpdate(PlentySoapRequest_UpdateListingsUpdate $oPlentySoapRequest_UpdateListingsUpdate)
	 *
	 * @param PlentySoapRequest_UpdateListingsUpdate $oPlentySoapRequest_UpdateListingsUpdate
	 *
	 * @return PlentySoapResponse_UpdateListingsUpdate
	 */
	public function UpdateListingsUpdate(PlentySoapRequest_UpdateListingsUpdate $oPlentySoapRequest_UpdateListingsUpdate)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_UpdateListingsUpdate.class.php");
		return parent::__soapCall("UpdateListingsUpdate",array($oPlentySoapRequest_UpdateListingsUpdate));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_UpdateListingsVerify UpdateListingsVerify(PlentySoapRequest_UpdateListingsVerify $oPlentySoapRequest_UpdateListingsVerify)
	 *
	 * @param PlentySoapRequest_UpdateListingsVerify $oPlentySoapRequest_UpdateListingsVerify
	 *
	 * @return PlentySoapResponse_UpdateListingsVerify
	 */
	public function UpdateListingsVerify(PlentySoapRequest_UpdateListingsVerify $oPlentySoapRequest_UpdateListingsVerify)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_UpdateListingsVerify.class.php");
		return parent::__soapCall("UpdateListingsVerify",array($oPlentySoapRequest_UpdateListingsVerify));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_UpdateListingsRelist UpdateListingsRelist(PlentySoapRequest_UpdateListingsRelist $oPlentySoapRequest_UpdateListingsRelist)
	 *
	 * @param PlentySoapRequest_UpdateListingsRelist $oPlentySoapRequest_UpdateListingsRelist
	 *
	 * @return PlentySoapResponse_UpdateListingsRelist
	 */
	public function UpdateListingsRelist(PlentySoapRequest_UpdateListingsRelist $oPlentySoapRequest_UpdateListingsRelist)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_UpdateListingsRelist.class.php");
		return parent::__soapCall("UpdateListingsRelist",array($oPlentySoapRequest_UpdateListingsRelist));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetMarketStoreCategories GetMarketStoreCategories(PlentySoapRequest_GetMarketStoreCategories $oPlentySoapRequest_GetMarketStoreCategories)
	 *
	 * @param PlentySoapRequest_GetMarketStoreCategories $oPlentySoapRequest_GetMarketStoreCategories
	 *
	 * @return PlentySoapResponse_GetMarketStoreCategories
	 */
	public function GetMarketStoreCategories(PlentySoapRequest_GetMarketStoreCategories $oPlentySoapRequest_GetMarketStoreCategories)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetMarketStoreCategories.class.php");
		return parent::__soapCall("GetMarketStoreCategories",array($oPlentySoapRequest_GetMarketStoreCategories));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetMarketShippingProfiles GetMarketShippingProfiles(PlentySoapRequest_GetMarketShippingProfiles $oPlentySoapRequest_GetMarketShippingProfiles)
	 *
	 * @param PlentySoapRequest_GetMarketShippingProfiles $oPlentySoapRequest_GetMarketShippingProfiles
	 *
	 * @return PlentySoapResponse_GetMarketShippingProfiles
	 */
	public function GetMarketShippingProfiles(PlentySoapRequest_GetMarketShippingProfiles $oPlentySoapRequest_GetMarketShippingProfiles)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetMarketShippingProfiles.class.php");
		return parent::__soapCall("GetMarketShippingProfiles",array($oPlentySoapRequest_GetMarketShippingProfiles));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetMarketLogs GetMarketLogs(PlentySoapRequest_GetMarketLogs $oPlentySoapRequest_GetMarketLogs)
	 *
	 * @param PlentySoapRequest_GetMarketLogs $oPlentySoapRequest_GetMarketLogs
	 *
	 * @return PlentySoapResponse_GetMarketLogs
	 */
	public function GetMarketLogs(PlentySoapRequest_GetMarketLogs $oPlentySoapRequest_GetMarketLogs)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetMarketLogs.class.php");
		return parent::__soapCall("GetMarketLogs",array($oPlentySoapRequest_GetMarketLogs));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetMarketDirectories GetMarketDirectories(PlentySoapRequest_GetMarketDirectories $oPlentySoapRequest_GetMarketDirectories)
	 *
	 * @param PlentySoapRequest_GetMarketDirectories $oPlentySoapRequest_GetMarketDirectories
	 *
	 * @return PlentySoapResponse_GetMarketDirectories
	 */
	public function GetMarketDirectories(PlentySoapRequest_GetMarketDirectories $oPlentySoapRequest_GetMarketDirectories)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetMarketDirectories.class.php");
		return parent::__soapCall("GetMarketDirectories",array($oPlentySoapRequest_GetMarketDirectories));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetMarketAccounts GetMarketAccounts(PlentySoapRequest_GetMarketAccounts $oPlentySoapRequest_GetMarketAccounts)
	 *
	 * @param PlentySoapRequest_GetMarketAccounts $oPlentySoapRequest_GetMarketAccounts
	 *
	 * @return PlentySoapResponse_GetMarketAccounts
	 */
	public function GetMarketAccounts(PlentySoapRequest_GetMarketAccounts $oPlentySoapRequest_GetMarketAccounts)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetMarketAccounts.class.php");
		return parent::__soapCall("GetMarketAccounts",array($oPlentySoapRequest_GetMarketAccounts));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteListingsTemplates DeleteListingsTemplates(PlentySoapRequest_DeleteListingsTemplates $oPlentySoapRequest_DeleteListingsTemplates)
	 *
	 * @param PlentySoapRequest_DeleteListingsTemplates $oPlentySoapRequest_DeleteListingsTemplates
	 *
	 * @return PlentySoapResponse_DeleteListingsTemplates
	 */
	public function DeleteListingsTemplates(PlentySoapRequest_DeleteListingsTemplates $oPlentySoapRequest_DeleteListingsTemplates)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteListingsTemplates.class.php");
		return parent::__soapCall("DeleteListingsTemplates",array($oPlentySoapRequest_DeleteListingsTemplates));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetListingsTemplates GetListingsTemplates(PlentySoapRequest_GetListingsTemplates $oPlentySoapRequest_GetListingsTemplates)
	 *
	 * @param PlentySoapRequest_GetListingsTemplates $oPlentySoapRequest_GetListingsTemplates
	 *
	 * @return PlentySoapResponse_GetListingsTemplates
	 */
	public function GetListingsTemplates(PlentySoapRequest_GetListingsTemplates $oPlentySoapRequest_GetListingsTemplates)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetListingsTemplates.class.php");
		return parent::__soapCall("GetListingsTemplates",array($oPlentySoapRequest_GetListingsTemplates));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetListingsTemplates SetListingsTemplates(PlentySoapRequest_SetListingsTemplates $oPlentySoapRequest_SetListingsTemplates)
	 *
	 * @param PlentySoapRequest_SetListingsTemplates $oPlentySoapRequest_SetListingsTemplates
	 *
	 * @return PlentySoapResponse_SetListingsTemplates
	 */
	public function SetListingsTemplates(PlentySoapRequest_SetListingsTemplates $oPlentySoapRequest_SetListingsTemplates)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetListingsTemplates.class.php");
		return parent::__soapCall("SetListingsTemplates",array($oPlentySoapRequest_SetListingsTemplates));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetListingsProperties GetListingsProperties(PlentySoapRequest_GetListingsProperties $oPlentySoapRequest_GetListingsProperties)
	 *
	 * @param PlentySoapRequest_GetListingsProperties $oPlentySoapRequest_GetListingsProperties
	 *
	 * @return PlentySoapResponse_GetListingsProperties
	 */
	public function GetListingsProperties(PlentySoapRequest_GetListingsProperties $oPlentySoapRequest_GetListingsProperties)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetListingsProperties.class.php");
		return parent::__soapCall("GetListingsProperties",array($oPlentySoapRequest_GetListingsProperties));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetListingsLayoutTemplates GetListingsLayoutTemplates(PlentySoapRequest_GetListingsLayoutTemplates $oPlentySoapRequest_GetListingsLayoutTemplates)
	 *
	 * @param PlentySoapRequest_GetListingsLayoutTemplates $oPlentySoapRequest_GetListingsLayoutTemplates
	 *
	 * @return PlentySoapResponse_GetListingsLayoutTemplates
	 */
	public function GetListingsLayoutTemplates(PlentySoapRequest_GetListingsLayoutTemplates $oPlentySoapRequest_GetListingsLayoutTemplates)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetListingsLayoutTemplates.class.php");
		return parent::__soapCall("GetListingsLayoutTemplates",array($oPlentySoapRequest_GetListingsLayoutTemplates));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteListingsProperties DeleteListingsProperties(PlentySoapRequest_DeleteListingsProperties $oPlentySoapRequest_DeleteListingsProperties)
	 *
	 * @param PlentySoapRequest_DeleteListingsProperties $oPlentySoapRequest_DeleteListingsProperties
	 *
	 * @return PlentySoapResponse_DeleteListingsProperties
	 */
	public function DeleteListingsProperties(PlentySoapRequest_DeleteListingsProperties $oPlentySoapRequest_DeleteListingsProperties)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteListingsProperties.class.php");
		return parent::__soapCall("DeleteListingsProperties",array($oPlentySoapRequest_DeleteListingsProperties));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_DeleteListingsLayoutTemplates DeleteListingsLayoutTemplates(PlentySoapRequest_DeleteListingsLayoutTemplates $oPlentySoapRequest_DeleteListingsLayoutTemplates)
	 *
	 * @param PlentySoapRequest_DeleteListingsLayoutTemplates $oPlentySoapRequest_DeleteListingsLayoutTemplates
	 *
	 * @return PlentySoapResponse_DeleteListingsLayoutTemplates
	 */
	public function DeleteListingsLayoutTemplates(PlentySoapRequest_DeleteListingsLayoutTemplates $oPlentySoapRequest_DeleteListingsLayoutTemplates)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_DeleteListingsLayoutTemplates.class.php");
		return parent::__soapCall("DeleteListingsLayoutTemplates",array($oPlentySoapRequest_DeleteListingsLayoutTemplates));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetListingsLayoutTemplates SetListingsLayoutTemplates(PlentySoapRequest_SetListingsLayoutTemplates $oPlentySoapRequest_SetListingsLayoutTemplates)
	 *
	 * @param PlentySoapRequest_SetListingsLayoutTemplates $oPlentySoapRequest_SetListingsLayoutTemplates
	 *
	 * @return PlentySoapResponse_SetListingsLayoutTemplates
	 */
	public function SetListingsLayoutTemplates(PlentySoapRequest_SetListingsLayoutTemplates $oPlentySoapRequest_SetListingsLayoutTemplates)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetListingsLayoutTemplates.class.php");
		return parent::__soapCall("SetListingsLayoutTemplates",array($oPlentySoapRequest_SetListingsLayoutTemplates));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetListings SetListings(PlentySoapRequest_SetListings $oPlentySoapRequest_SetListings)
	 *
	 * @param PlentySoapRequest_SetListings $oPlentySoapRequest_SetListings
	 *
	 * @return PlentySoapResponse_SetListings
	 */
	public function SetListings(PlentySoapRequest_SetListings $oPlentySoapRequest_SetListings)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetListings.class.php");
		return parent::__soapCall("SetListings",array($oPlentySoapRequest_SetListings));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetMarketListings SetMarketListings(PlentySoapRequest_SetMarketListings $oPlentySoapRequest_SetMarketListings)
	 *
	 * @param PlentySoapRequest_SetMarketListings $oPlentySoapRequest_SetMarketListings
	 *
	 * @return PlentySoapResponse_SetMarketListings
	 */
	public function SetMarketListings(PlentySoapRequest_SetMarketListings $oPlentySoapRequest_SetMarketListings)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetMarketListings.class.php");
		return parent::__soapCall("SetMarketListings",array($oPlentySoapRequest_SetMarketListings));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetMarketListingItemVariants GetMarketListingItemVariants(PlentySoapRequest_GetMarketListingItemVariants $oPlentySoapRequest_GetMarketListingItemVariants)
	 *
	 * @param PlentySoapRequest_GetMarketListingItemVariants $oPlentySoapRequest_GetMarketListingItemVariants
	 *
	 * @return PlentySoapResponse_GetMarketListingItemVariants
	 */
	public function GetMarketListingItemVariants(PlentySoapRequest_GetMarketListingItemVariants $oPlentySoapRequest_GetMarketListingItemVariants)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetMarketListingItemVariants.class.php");
		return parent::__soapCall("GetMarketListingItemVariants",array($oPlentySoapRequest_GetMarketListingItemVariants));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCurrentStocks GetCurrentStocks(PlentySoapRequest_GetCurrentStocks $oPlentySoapResponse_GetCurrentStocks)
	 *
	 * @param PlentySoapRequest_GetCurrentStocks $oPlentySoapResponse_GetCurrentStocks
	 *
	 * @return PlentySoapResponse_GetCurrentStocks
	 */
	public function GetCurrentStocks(PlentySoapRequest_GetCurrentStocks $oPlentySoapResponse_GetCurrentStocks)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCurrentStocks.class.php");
		return parent::__soapCall("GetCurrentStocks",array($oPlentySoapResponse_GetCurrentStocks));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetCurrentStocks SetCurrentStocks(PlentySoapRequest_SetCurrentStocks $oPlentySoapRequest_SetCurrentStocks)
	 *
	 * @param PlentySoapRequest_SetCurrentStocks $oPlentySoapRequest_SetCurrentStocks
	 *
	 * @return PlentySoapResponse_SetCurrentStocks
	 */
	public function SetCurrentStocks(PlentySoapRequest_SetCurrentStocks $oPlentySoapRequest_SetCurrentStocks)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetCurrentStocks.class.php");
		return parent::__soapCall("SetCurrentStocks",array($oPlentySoapRequest_SetCurrentStocks));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetIncomingStocks SetIncomingStocks(PlentySoapRequest_SetIncomingStocks $oPlentySoapRequest_SetIncomingStocks)
	 *
	 * @param PlentySoapRequest_SetIncomingStocks $oPlentySoapRequest_SetIncomingStocks
	 *
	 * @return PlentySoapResponse_SetIncomingStocks
	 */
	public function SetIncomingStocks(PlentySoapRequest_SetIncomingStocks $oPlentySoapRequest_SetIncomingStocks)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetIncomingStocks.class.php");
		return parent::__soapCall("SetIncomingStocks",array($oPlentySoapRequest_SetIncomingStocks));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetStocksTransfer SetStocksTransfer(PlentySoapRequest_SetStocksTransfer $oPlentySoapRequest_SetStocksTransfer)
	 *
	 * @param PlentySoapRequest_SetStocksTransfer $oPlentySoapRequest_SetStocksTransfer
	 *
	 * @return PlentySoapResponse_SetStocksTransfer
	 */
	public function SetStocksTransfer(PlentySoapRequest_SetStocksTransfer $oPlentySoapRequest_SetStocksTransfer)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetStocksTransfer.class.php");
		return parent::__soapCall("SetStocksTransfer",array($oPlentySoapRequest_SetStocksTransfer));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetWarehouseList GetWarehouseList(PlentySoapRequest_GetWarehouseList $oPlentySoapRequest_GetWarehouseList)
	 *
	 * @param PlentySoapRequest_GetWarehouseList $oPlentySoapRequest_GetWarehouseList
	 *
	 * @return PlentySoapResponse_GetWarehouseList
	 */
	public function GetWarehouseList(PlentySoapRequest_GetWarehouseList $oPlentySoapRequest_GetWarehouseList)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetWarehouseList.class.php");
		return parent::__soapCall("GetWarehouseList",array($oPlentySoapRequest_GetWarehouseList));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetRacksList GetRacksList(PlentySoapRequest_GetRacksList $oPlentySoapRequest_GetRacksList)
	 *
	 * @param PlentySoapRequest_GetRacksList $oPlentySoapRequest_GetRacksList
	 *
	 * @return PlentySoapResponse_GetRacksList
	 */
	public function GetRacksList(PlentySoapRequest_GetRacksList $oPlentySoapRequest_GetRacksList)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetRacksList.class.php");
		return parent::__soapCall("GetRacksList",array($oPlentySoapRequest_GetRacksList));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetWarehouseItem GetWarehouseItem(PlentySoapRequest_GetWarehouseItem $oPlentySoapRequest_GetWarehouseItem)
	 *
	 * @param PlentySoapRequest_GetWarehouseItem $oPlentySoapRequest_GetWarehouseItem
	 *
	 * @return PlentySoapResponse_GetWarehouseItem
	 */
	public function GetWarehouseItem(PlentySoapRequest_GetWarehouseItem $oPlentySoapRequest_GetWarehouseItem)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetWarehouseItem.class.php");
		return parent::__soapCall("GetWarehouseItem",array($oPlentySoapRequest_GetWarehouseItem));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCurrentStocks4Marketplace GetCurrentStocks4Marketplace(PlentySoapRequest_GetCurrentStocks4Marketplace $oPlentySoapRequest_GetCurrentStocks4Marketplace)
	 *
	 * @param PlentySoapRequest_GetCurrentStocks4Marketplace $oPlentySoapRequest_GetCurrentStocks4Marketplace
	 *
	 * @return PlentySoapResponse_GetCurrentStocks4Marketplace
	 */
	public function GetCurrentStocks4Marketplace(PlentySoapRequest_GetCurrentStocks4Marketplace $oPlentySoapRequest_GetCurrentStocks4Marketplace)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCurrentStocks4Marketplace.class.php");
		return parent::__soapCall("GetCurrentStocks4Marketplace",array($oPlentySoapRequest_GetCurrentStocks4Marketplace));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetMultiShops GetMultiShops()
	 *
	 * @param 
	 *
	 * @return PlentySoapResponse_GetMultiShops
	 */
	public function GetMultiShops()
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetMultiShops.class.php");
		return parent::__soapCall("GetMultiShops",array());
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetWarehouseStorageLocation GetWarehouseStorageLocation(PlentySoapRequest_GetWarehouseStorageLocation $oPlentySoapRequest_GetWarehouseStorageLocation)
	 *
	 * @param PlentySoapRequest_GetWarehouseStorageLocation $oPlentySoapRequest_GetWarehouseStorageLocation
	 *
	 * @return PlentySoapResponse_GetWarehouseStorageLocation
	 */
	public function GetWarehouseStorageLocation(PlentySoapRequest_GetWarehouseStorageLocation $oPlentySoapRequest_GetWarehouseStorageLocation)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetWarehouseStorageLocation.class.php");
		return parent::__soapCall("GetWarehouseStorageLocation",array($oPlentySoapRequest_GetWarehouseStorageLocation));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsStock GetItemsStock(PlentySoapRequest_GetItemsStock $oPlentySoapRequest_GetItemsStock)
	 *
	 * @param PlentySoapRequest_GetItemsStock $oPlentySoapRequest_GetItemsStock
	 *
	 * @return PlentySoapResponse_GetItemsStock
	 */
	public function GetItemsStock(PlentySoapRequest_GetItemsStock $oPlentySoapRequest_GetItemsStock)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsStock.class.php");
		return parent::__soapCall("GetItemsStock",array($oPlentySoapRequest_GetItemsStock));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemsStockSearch GetItemsStockSearch(PlentySoapRequest_GetItemsStockSearch $oPlentySoapRequest_GetItemsStockSearch)
	 *
	 * @param PlentySoapRequest_GetItemsStockSearch $oPlentySoapRequest_GetItemsStockSearch
	 *
	 * @return PlentySoapResponse_GetItemsStockSearch
	 */
	public function GetItemsStockSearch(PlentySoapRequest_GetItemsStockSearch $oPlentySoapRequest_GetItemsStockSearch)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemsStockSearch.class.php");
		return parent::__soapCall("GetItemsStockSearch",array($oPlentySoapRequest_GetItemsStockSearch));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetStockMovements GetStockMovements(PlentySoapRequest_GetStockMovements $oPlentySoapRequest_GetStockMovements)
	 *
	 * @param PlentySoapRequest_GetStockMovements $oPlentySoapRequest_GetStockMovements
	 *
	 * @return PlentySoapResponse_GetStockMovements
	 */
	public function GetStockMovements(PlentySoapRequest_GetStockMovements $oPlentySoapRequest_GetStockMovements)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetStockMovements.class.php");
		return parent::__soapCall("GetStockMovements",array($oPlentySoapRequest_GetStockMovements));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetWarehouse SetWarehouse(PlentySoapRequest_SetWarehouse $oPlentySoapRequest_SetWarehouse)
	 *
	 * @param PlentySoapRequest_SetWarehouse $oPlentySoapRequest_SetWarehouse
	 *
	 * @return PlentySoapResponse_SetWarehouse
	 */
	public function SetWarehouse(PlentySoapRequest_SetWarehouse $oPlentySoapRequest_SetWarehouse)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetWarehouse.class.php");
		return parent::__soapCall("SetWarehouse",array($oPlentySoapRequest_SetWarehouse));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetContentPage GetContentPage(PlentySoapRequest_GetContentPage $oPlentySoapRequest_GetContentPage)
	 *
	 * @param PlentySoapRequest_GetContentPage $oPlentySoapRequest_GetContentPage
	 *
	 * @return PlentySoapResponse_GetContentPage
	 */
	public function GetContentPage(PlentySoapRequest_GetContentPage $oPlentySoapRequest_GetContentPage)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetContentPage.class.php");
		return parent::__soapCall("GetContentPage",array($oPlentySoapRequest_GetContentPage));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetContentPages SetContentPages(PlentySoapRequest_SetContentPages $oPlentySoapRequest_SetContentPages)
	 *
	 * @param PlentySoapRequest_SetContentPages $oPlentySoapRequest_SetContentPages
	 *
	 * @return PlentySoapResponse_SetContentPages
	 */
	public function SetContentPages(PlentySoapRequest_SetContentPages $oPlentySoapRequest_SetContentPages)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetContentPages.class.php");
		return parent::__soapCall("SetContentPages",array($oPlentySoapRequest_SetContentPages));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_AddTicket AddTicket(PlentySoapRequest_AddTicket $oPlentySoapRequest_AddTicket)
	 *
	 * @param PlentySoapRequest_AddTicket $oPlentySoapRequest_AddTicket
	 *
	 * @return PlentySoapResponse_AddTicket
	 */
	public function AddTicket(PlentySoapRequest_AddTicket $oPlentySoapRequest_AddTicket)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_AddTicket.class.php");
		return parent::__soapCall("AddTicket",array($oPlentySoapRequest_AddTicket));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_AddTicketLeafe AddTicketLeafe(PlentySoapRequest_AddTicketLeafe $oPlentySoapRequest_AddTicketLeafe)
	 *
	 * @param PlentySoapRequest_AddTicketLeafe $oPlentySoapRequest_AddTicketLeafe
	 *
	 * @return PlentySoapResponse_AddTicketLeafe
	 */
	public function AddTicketLeafe(PlentySoapRequest_AddTicketLeafe $oPlentySoapRequest_AddTicketLeafe)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_AddTicketLeafe.class.php");
		return parent::__soapCall("AddTicketLeafe",array($oPlentySoapRequest_AddTicketLeafe));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetTermsAndCancellation GetTermsAndCancellation(PlentySoapRequest_GetTermsAndCancellation $PlentySoapRequest_GetTermsAndCancellation)
	 *
	 * @param PlentySoapRequest_GetTermsAndCancellation $PlentySoapRequest_GetTermsAndCancellation
	 *
	 * @return PlentySoapResponse_GetTermsAndCancellation
	 */
	public function GetTermsAndCancellation(PlentySoapRequest_GetTermsAndCancellation $PlentySoapRequest_GetTermsAndCancellation)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetTermsAndCancellation.class.php");
		return parent::__soapCall("GetTermsAndCancellation",array($PlentySoapRequest_GetTermsAndCancellation));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetTermsAndCancellation SetTermsAndCancellation(PlentySoapRequest_SetTermsAndCancellation $PlentySoapRequest_SetTermsAndCancellation)
	 *
	 * @param PlentySoapRequest_SetTermsAndCancellation $PlentySoapRequest_SetTermsAndCancellation
	 *
	 * @return PlentySoapResponse_SetTermsAndCancellation
	 */
	public function SetTermsAndCancellation(PlentySoapRequest_SetTermsAndCancellation $PlentySoapRequest_SetTermsAndCancellation)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetTermsAndCancellation.class.php");
		return parent::__soapCall("SetTermsAndCancellation",array($PlentySoapRequest_SetTermsAndCancellation));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetLegalInformation GetLegalInformation(PlentySoapRequest_GetLegalInformation $PlentySoapRequest_GetLegalInformation)
	 *
	 * @param PlentySoapRequest_GetLegalInformation $PlentySoapRequest_GetLegalInformation
	 *
	 * @return PlentySoapResponse_GetLegalInformation
	 */
	public function GetLegalInformation(PlentySoapRequest_GetLegalInformation $PlentySoapRequest_GetLegalInformation)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetLegalInformation.class.php");
		return parent::__soapCall("GetLegalInformation",array($PlentySoapRequest_GetLegalInformation));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetLegalInformation SetLegalInformation(PlentySoapRequest_SetLegalInformation $PlentySoapRequest_SetLegalInformation)
	 *
	 * @param PlentySoapRequest_SetLegalInformation $PlentySoapRequest_SetLegalInformation
	 *
	 * @return PlentySoapResponse_SetLegalInformation
	 */
	public function SetLegalInformation(PlentySoapRequest_SetLegalInformation $PlentySoapRequest_SetLegalInformation)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetLegalInformation.class.php");
		return parent::__soapCall("SetLegalInformation",array($PlentySoapRequest_SetLegalInformation));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetReportingFile GetReportingFile(PlentySoapRequest_GetReportingFile $PlentySoapRequest_GetReportingFile)
	 *
	 * @param PlentySoapRequest_GetReportingFile $PlentySoapRequest_GetReportingFile
	 *
	 * @return PlentySoapResponse_GetReportingFile
	 */
	public function GetReportingFile(PlentySoapRequest_GetReportingFile $PlentySoapRequest_GetReportingFile)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetReportingFile.class.php");
		return parent::__soapCall("GetReportingFile",array($PlentySoapRequest_GetReportingFile));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetFolderEmails GetFolderEmails(PlentySoapRequest_GetFolderEmails $PlentySoapRequest_GetFolderEmails)
	 *
	 * @param PlentySoapRequest_GetFolderEmails $PlentySoapRequest_GetFolderEmails
	 *
	 * @return PlentySoapResponse_GetFolderEmails
	 */
	public function GetFolderEmails(PlentySoapRequest_GetFolderEmails $PlentySoapRequest_GetFolderEmails)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetFolderEmails.class.php");
		return parent::__soapCall("GetFolderEmails",array($PlentySoapRequest_GetFolderEmails));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetEmailFolderList GetEmailFolderList(PlentySoapRequest_GetEmailFolderList $PlentySoapRequest_GetEmailFolderList)
	 *
	 * @param PlentySoapRequest_GetEmailFolderList $PlentySoapRequest_GetEmailFolderList
	 *
	 * @return PlentySoapResponse_GetEmailFolderList
	 */
	public function GetEmailFolderList(PlentySoapRequest_GetEmailFolderList $PlentySoapRequest_GetEmailFolderList)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetEmailFolderList.class.php");
		return parent::__soapCall("GetEmailFolderList",array($PlentySoapRequest_GetEmailFolderList));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetAutonomousReturns SetAutonomousReturns(PlentySoapRequest_SetAutonomousReturns $oPlentySoapRequest_SetAutonomousReturns)
	 *
	 * @param PlentySoapRequest_SetAutonomousReturns $oPlentySoapRequest_SetAutonomousReturns
	 *
	 * @return PlentySoapResponse_SetAutonomousReturns
	 */
	public function SetAutonomousReturns(PlentySoapRequest_SetAutonomousReturns $oPlentySoapRequest_SetAutonomousReturns)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetAutonomousReturns.class.php");
		return parent::__soapCall("SetAutonomousReturns",array($oPlentySoapRequest_SetAutonomousReturns));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCampaignList GetCampaignList(PlentySoapRequest_GetCampaignList $PlentySoapRequest_GetCampaignList)
	 *
	 * @param PlentySoapRequest_GetCampaignList $PlentySoapRequest_GetCampaignList
	 *
	 * @return PlentySoapResponse_GetCampaignList
	 */
	public function GetCampaignList(PlentySoapRequest_GetCampaignList $PlentySoapRequest_GetCampaignList)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCampaignList.class.php");
		return parent::__soapCall("GetCampaignList",array($PlentySoapRequest_GetCampaignList));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetCouponListOfCampaign GetCouponListOfCampaign(PlentySoapRequest_GetCouponListOfCampaign $PlentySoapRequest_GetCouponListOfCampaign)
	 *
	 * @param PlentySoapRequest_GetCouponListOfCampaign $PlentySoapRequest_GetCouponListOfCampaign
	 *
	 * @return PlentySoapResponse_GetCouponListOfCampaign
	 */
	public function GetCouponListOfCampaign(PlentySoapRequest_GetCouponListOfCampaign $PlentySoapRequest_GetCouponListOfCampaign)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetCouponListOfCampaign.class.php");
		return parent::__soapCall("GetCouponListOfCampaign",array($PlentySoapRequest_GetCouponListOfCampaign));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_ValidateCoupons ValidateCoupons(PlentySoapRequest_ValidateCoupons $PlentySoapRequest_ValidateCoupons)
	 *
	 * @param PlentySoapRequest_ValidateCoupons $PlentySoapRequest_ValidateCoupons
	 *
	 * @return PlentySoapResponse_ValidateCoupons
	 */
	public function ValidateCoupons(PlentySoapRequest_ValidateCoupons $PlentySoapRequest_ValidateCoupons)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_ValidateCoupons.class.php");
		return parent::__soapCall("ValidateCoupons",array($PlentySoapRequest_ValidateCoupons));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_GetItemMediaFiles GetItemMediaFiles(PlentySoapRequest_GetItemMediaFiles $PlentySoapRequest_GetItemMediaFiles)
	 *
	 * @param PlentySoapRequest_GetItemMediaFiles $PlentySoapRequest_GetItemMediaFiles
	 *
	 * @return PlentySoapResponse_GetItemMediaFiles
	 */
	public function GetItemMediaFiles(PlentySoapRequest_GetItemMediaFiles $PlentySoapRequest_GetItemMediaFiles)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_GetItemMediaFiles.class.php");
		return parent::__soapCall("GetItemMediaFiles",array($PlentySoapRequest_GetItemMediaFiles));
	}
	
	/**
	 *
	 * Soap function call
	 * PlentySoapResponse_SetDynamicExport SetDynamicExport(PlentySoapRequest_SetDynamicExport $oPlentySoapRequest_SetDynamicExport)
	 *
	 * @param PlentySoapRequest_SetDynamicExport $oPlentySoapRequest_SetDynamicExport
	 *
	 * @return PlentySoapResponse_SetDynamicExport
	 */
	public function SetDynamicExport(PlentySoapRequest_SetDynamicExport $oPlentySoapRequest_SetDynamicExport)
	{
		require_once("E:\workspace\shopgeneral_soap_client/lib/soap/model/PlentySoapResponse_SetDynamicExport.class.php");
		return parent::__soapCall("SetDynamicExport",array($oPlentySoapRequest_SetDynamicExport));
	}
	

}
