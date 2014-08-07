<?php
if ((isset($_POST['leter']))and(isset($_POST['number'])))
{

// ---------------       Input

    class Registry
    {
        /**
         * Registry hash-table
         *
         * @var array
         */
        protected static $_registry = array();

        /**
         * Put item into the registry
         *
         * @param string $key
         * @param mixed $item
         * @return void
         */
        public static function set($key, $item) {
            if (!array_key_exists($key, self::$_registry)) {
                self::$_registry[$key] = $item;
            }
        }

        /**
         * Get item by key
         *
         * @param string $key
         * @return false|mixed
         */
        public static function get($key) {
            if (array_key_exists($key, self::$_registry)) {
                return self::$_registry[$key];
            }

            return false;
        }

        /**
         * Remove item from the regisry
         *
         * @param string $key
         * @return void
         */
        public static function remove($key) {
            if (array_key_exists($key, self::$_registry)) {
                unset(self::$_registry[$key]);
            }
        }

        protected function __construct() {

        }
    }
    Registry::set('piece',htmlspecialchars( $_POST['piece']));
    Registry::set('x',htmlspecialchars( $_POST['leter']));
    Registry::set('y',htmlspecialchars( $_POST['number']));

  
  echo("<br/>");
    echo $_POST['piece'];
      echo("<br/>");
  
   // echo("<br/>");
   //  echo $_POST['website_string'];
   //    echo("<br/>");

// ---------------       Input                   END


// $leter_new=htmlspecialchars( $_POST['leter']);
// $number_new=htmlspecialchars( $_POST['number']);


    class Rook {
        public $pieceName= 'Rook'; // for error mesrjes   $this->pieceName

        protected $letterindex_new;
        protected $number_new;
        public $letterindex_old= '1'; //a
        public $number_old= '1';

        public $leter_to_index=array('a'=>'1','b'=>'2','c'=>'3','d'=>'4','e'=>'5','f'=>'6','g'=>'7','h'=>'8');

        function __construct($letterindex_new, $number_new)
        {

            $this->letterindex_new=$this->leter_to_index[$letterindex_new]; //TO DO CHECK, WITH JAVA SCRIPT
            $this->number_new=$number_new;
        }

// ---------------       Check WAY COORDINATS

       public   $checkWay_ERROR=""; // invalid moove coordinats

            public function cW_inborder($x,$y){  // REDO WETH JAVA SCRIPT
                if ((1<= $x)and($x<=8)and(1<= $y)and($y<=8)){
                    return true;
                } else {
                    $this->checkWay_ERROR .= "<br>moove coordinats not in borders ";
                    return false;
                       }
            }

            public function cW_initself($x,$y){
                if (($x==$this->letterindex_old)and($y==$this->number_old)){
                    $this->checkWay_ERROR .= "<br>moove coordinats not chenjed ";
                    return false;

                } else {
                    return true;
                }
            }

            public function cW_Rock_rules($x,$y){
                if ( (($x== $this->letterindex_old)and($y!==$this->number_old))or
                   (($x!==$this->letterindex_old)and($y==$this->number_old))
                    )
                   {
                    return true;
                } else {
                    $this->checkWay_ERROR .= "<br>moove coordinats not correct for $this->pieceName figure ";
                    return false;
                }
            }

           // TO DO   cW_barrier
           // TO DO   cW_target



        public function checkWay()
        {

            echo "this -> letterindex_new<br>";
            echo $this->letterindex_new;
            echo "<br>";
            echo "this -> number_new<br>";
            echo $this->number_new;
            // return ( $this->letter_new);
          if ( ($this->cW_inborder($this->letterindex_new,$this->number_new ))and
             ($this->cW_initself($this->letterindex_new,$this->number_new )) and
             ($this->cW_Rock_rules($this->letterindex_new,$this->number_new ))
              )
            {
              echo "<br/>TRUE";   // return (true);
            }else { echo( "<br/>checkWay Error ".$this->checkWay_ERROR);}

        }
// ----------------       Check WAY COORDINATS    ---------- END

    }

    class Bishop extends  Rook {
       public $pieceName= 'Bishop'; // for error mesrjes
       public $letterindex_old= '3'; //c
       public $number_old= '1';
        // ---------------       Check WAY COORDINATS
       
       public function cW_Rock_rules($x,$y){
           if ( (($x== $this->letterindex_old)and($y!==$this->number_old))or
               (($x!==$this->letterindex_old)and($y==$this->number_old))
           )
           {
               return true;
           } else {
               $this->checkWay_ERROR .= "<br>moove coordinats not correct for ROCK figure ";
               return false;
           }
       }

       // ----------------       Check WAY COORDINATS    ---------- END

    }




//
//    if ( $_POST['piece']=='Rock' ){
//     $piece = new Rook( htmlspecialchars( $_POST['leter']), htmlspecialchars( $_POST['number']));
//    }
//    if ( $_POST['piece']=='Bishop' ){
//        echo("Bishop");
//     $piece = new Bishop( htmlspecialchars( $_POST['leter']), htmlspecialchars( $_POST['number']));
//    }
    if ( $_POST['piece']=='Rock' ){
        $piece = new Rook( htmlspecialchars( $_POST['leter']), htmlspecialchars( $_POST['number']));
    }
    if ( $_POST['piece']=='Bishop' ){
        echo("Bishop");
        $piece = new Bishop( htmlspecialchars( $_POST['leter']), htmlspecialchars( $_POST['number']));
    }

    $piece->checkWay();
//   $rook_wight_left = new Rook( Registry::get('x'), Registry::get('y'));
//   $rook_wight_left->checkWay();

};
