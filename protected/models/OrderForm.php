<?php
class OrderForm extends CFormModel{
    public $fullName;
    public $phone;
    public $email;
    public $cityRegion;
    public $index;
    public $address;
    public $comment;
    public $typeDelivery;
    
    public function rules() {
	return array(
	    array('email','email'),
	    array('address,index,cityRegion,phone,fullName','required','on'=>'delivery1'),
        array('address,phone,fullName','required','on'=>'delivery2'),
        array('comment,typeDelivery','safe'),
	);
    }
    public function attributeLabels(){
        return array(
            'address'=>'Адрес',
            'comment'=>'Комментарии к заказу ',
            'index'=>'Индекс',
            'cityRegion'=>'Город, область',
            'email'=>'Email',
            'phone'=>'Номер телефона',
            'fullName'=>'Полное ФИО'
        );
    }
    
}
?>
