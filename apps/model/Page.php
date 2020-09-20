<?php 
    namespace apps\model;
    use apps\core\Model;
    
    class Page extends Model{

        public function findall(){
            $sql = "
                SELECT 
                    BIL_ID,
                    BIL_DATE,
                    BIL_TITRE,
                    BIL_CONTENU 
                FROM 
                    T_BILLET
            ";
            return $this->db->query($sql)->fetch();
        }
        
    }