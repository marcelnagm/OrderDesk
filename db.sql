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



CREATE TABLE `mybtcprices` (
  `id` bigint(20) NOT NULL,
  `high` varchar(60) NOT NULL,
  `last` varchar(60) NOT NULL,
  `timestamp` varchar(60) NOT NULL,
  `volume` varchar(60) NOT NULL,
  `vwap` varchar(60) NOT NULL,
  `low` varchar(60) NOT NULL,
  `ask` varchar(60) NOT NULL,
  `bid` varchar(60) NOT NULL,
  `myrate` varchar(60) NOT NULL,
  `FiftyBlock` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `myethprices`
--

CREATE TABLE `myethprices` (
  `id` bigint(20) NOT NULL,
  `high` varchar(60) NOT NULL,
  `last` varchar(60) NOT NULL,
  `timestamp` varchar(60) NOT NULL,
  `volume` varchar(60) NOT NULL,
  `vwap` varchar(60) NOT NULL,
  `low` varchar(60) NOT NULL,
  `ask` double NOT NULL,
  `bid` varchar(60) NOT NULL,
  `myrate` double NOT NULL,
  `FiftyBlock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `skus`
--

CREATE TABLE `skus` (
  `PRODUCT_ID` int(11) NOT NULL,
  `TITLE` varchar(60) NOT NULL,
  `CATEGORIES` varchar(50) NOT NULL,
  `SKU` varchar(30) NOT NULL,
  `PRICE` varchar(60) NOT NULL,
  `PRODUCT_TYPE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `skus`
--

INSERT INTO `skus` (`PRODUCT_ID`, `TITLE`, `CATEGORIES`, `SKU`, `PRICE`, `PRODUCT_TYPE`) VALUES
(8, 'ESTABLISHED FUND - BITCOIN', 'Currency', 'EST001', '50', 'service'),
(9, 'SEASONED FUND - BITCOIN & ETHEREUM', 'Currency', 'SEA001', '50', 'service'),
(10, 'EXPANDED FUND - TOP 5', 'Currency', 'EXP001', '50', 'service'),
(12, 'VISION FUND', 'Currency', 'VIS001', '50', 'service'),
(13, 'PAPER WALLET DELIVERY', 'Services', 'PAP001', '20', 'physical'),
(14, 'PRIVATE BITCOIN ADDRESS', 'Services', 'PRIV001', '10', 'service'),
(15, 'SEND BITCOIN', 'Services', 'SND001', '20', 'service');

-- --------------------------------------------------------

--
-- Estrutura da tabela `topten`
--

CREATE TABLE `topten` (
  `id` bigint(11) NOT NULL,
  `id_cap` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `symbol` varchar(60) NOT NULL,
  `rank` int(11) NOT NULL,
  `price_usd` varchar(60) NOT NULL,
  `price_btc` varchar(60) NOT NULL,
  `h24_volume_usd` varchar(60) NOT NULL,
  `market_cap_usd` varchar(60) NOT NULL,
  `available_supply` varchar(60) NOT NULL,
  `total_supply` varchar(60) NOT NULL,
  `percent_change_1h` varchar(60) NOT NULL,
  `percent_change_7d` varchar(60) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `visionary`
--

CREATE TABLE `visionary` (
  `id` bigint(11) NOT NULL,
  `id_cap` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `symbol` varchar(60) NOT NULL,
  `rank` int(11) NOT NULL,
  `price_usd` varchar(60) NOT NULL,
  `price_btc` varchar(60) NOT NULL,
  `h24_volume_usd` varchar(60) NOT NULL,
  `market_cap_usd` varchar(60) NOT NULL,
  `available_supply` varchar(60) NOT NULL,
  `total_supply` varchar(60) NOT NULL,
  `percent_change_1h` varchar(60) NOT NULL,
  `percent_change_7d` varchar(60) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mybtcprices`
--
ALTER TABLE `mybtcprices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myethprices`
--
ALTER TABLE `myethprices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skus`
--
ALTER TABLE `skus`
  ADD PRIMARY KEY (`PRODUCT_ID`);

--
-- Indexes for table `topten`
--
ALTER TABLE `topten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visionary`
--
ALTER TABLE `visionary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mybtcprices`
--
ALTER TABLE `mybtcprices`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `myethprices`
--
ALTER TABLE `myethprices`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `skus`
--
ALTER TABLE `skus`
  MODIFY `PRODUCT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `topten`
--
ALTER TABLE `topten`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `visionary`
--
ALTER TABLE `visionary`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;COMMIT;
