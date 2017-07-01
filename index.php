/**
 * Class carpetGenerator
 * @package CarpetGenerator
 */
class carpetGenerator
{
    const CELL        = 12;

    const borderArray = [
        0 => [ 0 => "-", 1 => "¦" ],
        1 => [ 0 => '+', 1 => '+' ],
    ];

    const angle = [
        0 => [ 1 => '+', 2 => '+', 3 => '+', 4 => '+' ],
        1 => [ 1 => '+', 2 => '+', 3 => '+', 4 => '+' ],
    ];

    protected $symbol = [
        '0' => "¦", '1' => "¦", '2' => "¦", '3' => "¦", '4' => "_", '5' => '¦',
        '6' => '_', '7' => '¯', '8' => '¦', '9' => '¦', 'a' => '¦',
        'b' => '¦', 'c' => '¦', 'd' => '¦', 'e' => '¦', 'f' => '¦',
    ];

    protected $map = [ ];

    private function _randomString()
    {
        $hash = bin2hex(random_bytes(16));
        return serialize($hash);
    }


    public function generateMap()
    {
        $this->map = [ ];
        for ($i = 1; $i <= self::CELL; $i++) {
            for ($j = 1; $j <= self::CELL; $j++) {
                $this->map[$i][$j] = '¦';
            }
        }
    }

    public function generateBorder()
    {
        $tmp = random_int(0, 1);
        for ($i = 1; $i <= self::CELL; $i++) {
            $this->map[1][$i] = $this::borderArray[$tmp][0];
            $this->map[$i][1] = $this::borderArray[$tmp][1];
            $this->map[$i][self::CELL] = $this::borderArray[$tmp][1];
            $this->map[self::CELL][$i] = $this::borderArray[$tmp][0];
        }
        $this->map[1][1] = $this::angle[$tmp][1];
        $this->map[1][self::CELL] = $this::angle[$tmp][2];
        $this->map[self::CELL][1] = $this::angle[$tmp][3];
        $this->map[self::CELL][self::CELL] = $this::angle[$tmp][4];
    }

    public function generateCarpet($str = null)
    {
        $md5 = is_null($str) ? md5($this->_randomString()) : md5($str);
        for ($i = 2; $i <= self::CELL - 1; $i++) {
            for ($k = 2; $k <= self::CELL - 1; $k++) {
                $this->map[$i][$k] = $this->symbol[strval($md5[$k])];
            }
        }
        return $this->map;
    }

    public function showCarpet()
    {
        $result = '';
        for ($i = 1; $i <= self::CELL; $i++) {
            for ($j = 1; $j <= self::CELL; $j++) {
                $result .= $this->map[$i][$j];
            }
            $result .= '<br>';
        }
        return $result;
    }

}