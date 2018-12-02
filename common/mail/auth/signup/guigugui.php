
<style type = "text/css">
    html{
        font-family:Tahoma;
        line-height:100%;
    }
    body, td{
        font-size:12px;
        font-family:Tahoma;
    }
    td.bg_gray, tr.bg_gray td {
        background-color: #CCCCCC;
    }
    table {
        border-collapse:collapse;
        border:0;
    }
    td{
        padding-left:3px;
        padding-right: 3px;
        padding-top:0px;
        padding-bottom:0px;
    }
    tr.bold td{
        font-weight:bold;
    }
    tr.vertical td{
        vertical-align:top;
        padding-bottom:10px;
    }
    h3{
        font-size:14px;
        margin:2px;
    }
    .jshop_cart_attribute{
        padding-top: 5px;
        font-size:11px;
    }
    .taxinfo{
        font-size:11px;
    }
</style>


<table>
    <tr class = "bg_gray">
        <td colspan = "2">
            <h3> _JSHOP_EMAIL_PURCHASE_ORDER</h3>
        </td>
    </tr>
    <tr>
        <td style="height:10px;font-size:1px;">&nbsp;</td>
    </tr>
    <tr>
        <td width="50%">
            _JSHOP_ORDER_NUMBER
        </td>
        <td width="50%">
            $this->order->order_number
        </td>
    </tr>
    <tr>
        <td>
            _JSHOP_ORDER_DATE
        </td>
        <td>
            $this->order->order_date
        </td>
    </tr>
    <tr>
        <td>
            _JSHOP_ORDER_STATUS
        </td>
        <td>
            $this->order->status
        </td>
    </tr>
    <tr>
        <td style="height:10px;font-size:1px;">&nbsp;</td>
    </tr>
    <tr class="bg_gray">
        <td colspan="2" width = "50%">
            <h3> _JSHOP_CUSTOMER_INFORMATION</h3>
        </td>
    </tr>
    <tr>
        <td  style="vertical-align:top;padding-top:10px;" width = "50%">
            <table cellspacing="0" cellpadding="0" style="line-height:100%;">
                <tr>
                    <td colspan="2"><b> _JSHOP_EMAIL_BILL_TO</b></td>
                </tr>

                <tr>
                    <td width="100"> _JSHOP_REG_TITLE</td>
                    <td> $this->order->title</td>
                </tr>
                <tr>
                    <td width="100"> print _JSHOP_FIRMA_NAME?>:</td>
                    <td> print $this->order->firma_name?></td>
                </tr>
                <tr>
                    <td width="100"> print _JSHOP_FULL_NAME?>:</td>
                    <td> print $this->order->l_name?>  print $this->order->f_name?>  print $this->order->m_name?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_BIRTHDAY?>:</td>
                    <td> print $this->order->birthday;?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_CLIENT_TYPE?>:</td>
                    <td> print $this->order->client_type_name;?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_FIRMA_CODE?>:</td>
                    <td> print $this->order->firma_code?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_VAT_NUMBER?>:</td>
                    <td> print $this->order->tax_number?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_HOME?>:</td>
                    <td> print $this->order->home?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_APARTMENT?>:</td>
                    <td> print $this->order->apartment?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_STREET_NR?>:</td>
                    <td> print $this->order->street?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_CITY?>:</td>
                    <td> print $this->order->city?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_STATE?>:</td>
                    <td> print $this->order->state?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_ZIP?>:</td>
                    <td> print $this->order->zip?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_COUNTRY?>:</td>
                    <td> print $this->order->country?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_TELEFON?>:</td>
                    <td> print $this->order->phone?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_MOBIL_PHONE?>:</td>
                    <td> print $this->order->mobil_phone?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_FAX?>:</td>
                    <td> print $this->order->fax?></td>
                </tr>


                <tr>
                    <td> print _JSHOP_EMAIL?>:</td>
                    <td> print $this->order->email?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_EXT_FIELD_1?>:</td>
                    <td> print $this->order->ext_field_1?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_EXT_FIELD_2?>:</td>
                    <td> print $this->order->ext_field_2?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_EXT_FIELD_3?>:</td>
                    <td> print $this->order->ext_field_3?></td>
                </tr>

            </table>
        </td>
        <td style="vertical-align:top;padding-top:10px;" width = "50%">

            <table cellspacing="0" cellpadding="0" style="line-height:100%;">
                <tr>
                    <td colspan=2><b> print _JSHOP_EMAIL_SHIP_TO?></b></td>
                </tr>

                <tr>
                    <td width="100"> print _JSHOP_REG_TITLE?>:</td>
                    <td> print $this->order->d_title?></td>
                </tr>

                <tr>
                    <td width="100"> print _JSHOP_FIRMA_NAME?>:</td>
                    <td >print $this->order->d_firma_name?></td>
                </tr>

                <tr>
                    <td width="100"> print _JSHOP_FULL_NAME?> </td>
                    <td>print $this->order->d_l_name?>  print $this->order->d_f_name?> print $this->order->d_m_name?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_BIRTHDAY?>:</td>
                    <td>print $this->order->d_birthday;?></td>
                </tr>

                <tr>
                    <td>print _JSHOP_HOME?>:</td>
                    <td>print $this->order->d_home?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_APARTMENT?>:</td>
                    <td>print $this->order->d_apartment?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_STREET_NR?>:</td>
                    <td> print $this->order->d_street?><br></td>
                </tr>

                <tr>
                    <td> print _JSHOP_CITY?>:</td>
                    <td> print $this->order->d_city?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_STATE?>:</td>
                    <td> print $this->order->d_state?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_ZIP ?>:</td>
                    <td> print $this->order->d_zip ?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_COUNTRY ?>:</td>
                    <td> print $this->order->d_country ?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_TELEFON ?>:</td>
                    <td> print $this->order->d_phone ?></td>
                </tr>
                <tr>
                    <td> print _JSHOP_MOBIL_PHONE?>:</td>
                    <td> print $this->order->d_mobil_phone?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_FAX ?>:</td>
                    <td> print $this->order->d_fax ?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_EMAIL ?>:</td>
                    <td> print $this->order->d_email ?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_EXT_FIELD_1?>:</td>
                    <td> print $this->order->d_ext_field_1?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_EXT_FIELD_2?>:</td>
                    <td> print $this->order->d_ext_field_2?></td>
                </tr>

                <tr>
                    <td> print _JSHOP_EXT_FIELD_3?>:</td>
                    <td> print $this->order->d_ext_field_3?></td>
                </tr>

            </table>

        </td>
    </tr>
    <tr>
        <td colspan = "2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan = "2" class="bg_gray">
            <h3> print _JSHOP_ORDER_ITEMS ?></h3>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="padding:0px;padding-top:10px;">
            <table width="100%" cellspacing="0" cellpadding="0" class="table_items">
                <tr><td colspan="5" style="vertical-align:top;padding-bottom:5px;font-size:1px;"><div style="height:1px;border-top:1px solid #999;"></div></td></tr>
                <tr class = "bold">
                    <td width="45%" style="padding-left:10px;padding-bottom:5px;"> print _JSHOP_NAME_PRODUCT?></td>
                    <td width="15%" style="padding-bottom:5px;"> if ($this->config->show_product_code_in_order){?> print _JSHOP_EAN_PRODUCT?> } ?></td>
                    <td width="10%" style="padding-bottom:5px;"> print _JSHOP_QUANTITY?></td>
                    <td width="15%" style="padding-bottom:5px;"> print _JSHOP_SINGLEPRICE?></td>
                    <td width="15%" style="padding-bottom:5px;"> print _JSHOP_PRICE_TOTAL?></td>
                </tr>
                <tr><td colspan="5" style="vertical-align:top;padding-bottom:10px;font-size:1px;"><div style="height:1px;border-top:1px solid #999;"></div></td></tr>


                <tr class="vertical">
                    <td>
                        <img src=" print $this->config->image_product_live_path?>/ if ($prod->thumb_image) print $prod->thumb_image; else print $this->noimage;?>" align="left" style="margin-right:5px;">

                        <div class="manufacturer"> print _JSHOP_MANUFACTURER?>: <span> print $prod->manufacturer?></span></div>

                        <div class="jshop_cart_attribute">
                            print sprintAtributeInOrder($prod->product_attributes)?>
                            print sprintFreeAtributeInOrder($prod->product_freeattributes)?>
                            print sprintExtraFiledsInOrder($prod->extra_fields)?>
                        </div>

                        <div class="deliverytime"> print _JSHOP_DELIVERY_TIME?>:  print $prod->delivery_time?></div>

                    </td>
                    <td> if ($this->config->show_product_code_in_order){?> print $prod->product_ean;?> } ?></td>
                    <td> print formatqty($prod->product_quantity);?> print $prod->_qty_unit;?></td>
                    <td>

                        <div class="taxinfo"> print productTaxInfo($prod->product_tax, $order->display_price);?></div>

                        <div class="basic_price"> print _JSHOP_BASIC_PRICE?>: <span> print sprintBasicPrice($prod);?></span></div>

                    </td>
                    <td>

                        <div class="taxinfo"> print productTaxInfo($prod->product_tax, $order->display_price);?></div>

                    </td>
                </tr>

                <tr>
                    <td colspan="5">

                        <div> print $file->file_descr?> <a href=" print JURI::root()?>index.php?option=com_jshopping&controller=product&task=getfile&oid= print $this->order->order_id?>&id= print $file->id?>&hash= print $this->order->file_hash?>&rl=1"> print _JSHOP_DOWNLOAD?></a></div>

                    </td>
                </tr>

                <tr><td colspan="5" style="vertical-align:top;padding-bottom:10px;font-size:1px;"><div style="height:1px;border-top:1px solid #999;"></div></td></tr>
                <tr>
                    <td colspan="5" style="text-align:right;font-size:11px;">
                        print _JSHOP_WEIGHT_PRODUCTS?>: <span> print formatweight($this->order->weight);?></span>
                    </td>
                </tr>

                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="4" align="right" style="padding-right:15px;"> print _JSHOP_SUBTOTAL ?>:</td>
                    <td class="price"> print formatprice($this->order->order_subtotal, $order->currency_code); ?> print $this->_tmp_ext_subtotal?></td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="padding-right:15px;"> print _JSHOP_RABATT_VALUE ?>: </td>
                    <td class="price">- print formatprice($this->order->order_discount, $order->currency_code); ?> print $this->_tmp_ext_discount?></td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="padding-right:15px;"> print _JSHOP_SHIPPING_PRICE ?>:</td>
                    <td class="price"> print formatprice($this->order->order_shipping, $order->currency_code); ?> print $this->_tmp_ext_shipping?></td>
                </tr>
                <tr>
                    <td colspan="4" align="right" style="padding-right:15px;"> print _JSHOP_PACKAGE_PRICE?>:</td>
                    <td class="price"> print formatprice($this->order->order_package, $order->currency_code); ?> print $this->_tmp_ext_shipping_package?></td>
                </tr>

                <tr>
                    <td colspan="4" align="right" style="padding-right:15px;"> print $this->order->payment_name;?>:</td>
                    <td class="price"> print formatprice($this->order->order_payment, $order->currency_code); ?> print $this->_tmp_ext_payment?></td>
                </tr>

                <tr>
                    <td colspan="4" align="right" style="padding-right:15px;"> print displayTotalCartTaxName($order->display_price);?> if ($this->show_percent_tax) print " ".formattax($percent)."%";?>:</td>
                    <td class="price"> print formatprice($value, $order->currency_code); ?> print $this->_tmp_ext_tax[$percent]?></td>
                </tr>

                <tr>
                    <td colspan="4" align="right" style="padding-right:15px;"><b> print $this->text_total ?>:</b></td>
                    <td class="price"><b> print formatprice($this->order->order_total, $order->currency_code)?> print $this->_tmp_ext_total?></b></td>
                </tr>
                <tr>
                    <td colspan="5">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="5" class="bg_gray"> print _JSHOP_CUSTOMER_NOTE ?></td>
                </tr>
                <tr>
                    <td colspan="5" style="padding-top:10px;"> print $this->order->order_add_info ?></td>
                </tr>
                <tr><td>&nbsp;</td></tr>

            </table>
        </td>
    </tr>

    <tr class = "bg_gray">
        <td>
            <h3> print _JSHOP_PAYMENT_INFORMATION ?></h3>
        </td>
        <td   colspan="2" >
            <h3> print _JSHOP_SHIPPING_INFORMATION </h3>
        </td>
    </tr>
    <tr>
        <td style="height:5px;font-size:1px;">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td valign="top">
            <div style="padding-bottom:4px;"> print $this->order->payment_name;?></div>
            <div style="font-size:11px;">
                print nl2br($this->order->payment_information);
                print $this->order->payment_description;
            </div>
        </td>
        <td valign="top"  colspan="2" >
            <div>"._JSHOP_DELIVERY_DATE.": ".$order->delivery_date_f."
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2"><br/><br/><a class = "policy" target="_blank" href=" print $this->liveurlhost.SEFLink('index.php?option=com_jshopping&controller=content&task=view&page=return_policy&tmpl=component', 1);?>"> print _JSHOP_RETURN_POLICY?></a></td>
    </tr>
    <tr>
        <td colspan = "2" style="padding-bottom:10px;">
            print $this->order_email_descr_end;?>
        </td>
    </tr>
</table>