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
        array('email', 'length', 'max'=>256),
        array('fullName, cityRegion', 'length', 'max'=>256),
        array('address', 'length', 'max'=>1024),
        array('comment', 'length', 'max'=>2048),
        array('phone', 'length', 'max'=>50),
        array('phone','match','pattern'=>'/^[\d\(\)\+\s]+$/', 'message'=>'Неверный формат телефона. Могут присутствовать цифры и символы:пробел, ")", "(", "+"'),
        array('index', 'numerical', 'integerOnly'=>true),
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
