    CREATE TABLE dbo.Orders ( 
	id                   bigint NOT NULL   IDENTITY,
	order_id             varchar(60)    ,
	email                varchar(60)    ,
	shipping_method      varchar(60)    ,
	quantity_total       varchar(50)    ,
	weight_total         varchar(50)    ,
	product_total        varchar(50)    ,
	shipping_total       varchar(50)    ,
	handling_total       varchar(50)    ,
	tax_total            varchar(50)    ,
	discount_total       varchar(50)    ,
	order_total          varchar(50)    ,
	cc_number_masked     varchar(60)    ,
	cc_exp               varchar(12)    ,
	processor_response   varchar(60)    ,
	payment_type         varchar(60)    ,
	payment_status       varchar(60)    ,
	processor_balance    varchar(60)    ,
	customer_id          varchar(50)    ,
	email_count          varchar(60)    ,
	ip_address           varchar(100)    ,
	tag_color            varchar(60)    ,
	source_name          varchar(100)    ,
	source_id            varchar(60)    ,
	fulfillment_name     varchar(100)    ,
	fulfillment_id       varchar(60)    ,
	tag_name             varchar(100)    ,
	folder_id            varchar(60)    ,
	date_added           varchar(60)    ,
	date_updated         varchar(60)    ,
	shipping_id          varchar(60)    ,
	CONSTRAINT Pk_Orders PRIMARY KEY ( id )
 );

CREATE TABLE dbo.Shipment ( 
	id                   int NOT NULL   IDENTITY,
	order_id             int    ,
	tracking_number      varchar(250)    ,
	carrier_code         varchar(250)    ,
	shipment_method      varchar(20)    ,
	weight               varchar(30)    ,
	cost                 varchar(30)    ,
	sstatus              varchar(30)    ,
	tracking_url         varchar(250)    ,
	date_shipped         varchar(60)    ,
	date_added           varchar(50)    ,
	shipment_id          varchar(50)    ,
	source               varchar(60)    ,
	CONSTRAINT Pk_Shipment PRIMARY KEY ( id )
 );


CREATE TABLE dbo.Shipping ( 
	id                   bigint NOT NULL   IDENTITY,
	first_name           varchar(100)    ,
	last_name            varchar(100)    ,
	company              varchar(60)    ,
	address1             varchar(150)    ,
	address2             varchar(150)    ,
	address3             varchar(150)    ,
	address4             varchar(150)    ,
	city                 varchar(100)    ,
	sstate               varchar(100)    ,
	postal_code          varchar(20)    ,
	country              varchar(150)    ,
	phone                varchar(60)    ,
	CONSTRAINT Pk_Shipments PRIMARY KEY ( id )
 );

CREATE TABLE dbo.OrderItem ( 
	id                   bigint NOT NULL   IDENTITY,
	item_id              varchar(50)    ,
	order_id             varchar(60)    ,
	name                 varchar(100)    ,
	quantity             varchar(15)    ,
	weight               varchar(30)    ,
	code                 varchar(60)    ,
	category_code        varchar(30)    ,
	variation_list       varchar(250)    ,
	metadata             varchar(250)    ,
	delivery_type        varchar(50)    ,
	CONSTRAINT Pk_OrderItem PRIMARY KEY ( id )
 );

