<?php

class STranslate {

    public static function searcharray($text, $var) {

        foreach ($var as $val) {
            if (is_array($val) && search($text, $val)) {
                return true;
            } elseif ($val == $text) {
                return $val;
            }
        }

        return false;
    }

    public static function encodeEmail($email, $mask = '****') {

        $ar_symbol = explode('@', $email);

        if (count($ar_symbol) > 1) {

            $first = $ar_symbol[0];
            $second = '@' . $ar_symbol[1];
            $lenght = mb_strlen((string)$ar_symbol[0]);
            $start = 0;
            $end = 2;

            $start2 = $end + (int)mb_strlen($mask);

            if ($lenght >= $start2) {
                $second = mb_substr($email, $start2);
            }

            if ($lenght <= 3) {
                $end = 1;
            }

            $str0 = substr($first, $start, $end);

            return (string)$str0 . $mask . $second;
        } else {
            return $mask;
        }
    }

    public static function transliter($string) {

        $converter = array(
            '"' => '', "'" => '',
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            ' ' => '-', '?' => '',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => "`", 'ы' => 'y', 'ъ' => "`",
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => "'", 'Ы' => 'Y', 'Ъ' => "'",
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
            '/' => '|', '\\' => '|',
        );

        return strtr($string, $converter);
    }

    public static function crop_str($string, $limit) {

        $substring_limited = substr($string, 0, $limit); //режем строку от 0 до limit

        return substr($substring_limited, 0, strrpos($substring_limited, ' ')); //берем часть обрезанной строки от 0 до последнего пробела
    }

}

?>