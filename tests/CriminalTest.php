<?php
/**
 * CriminalTest
 *
 * PHP Version 5.3
 *
 * @category Test
 * @package  Boscot
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPL v3
 * @link     None
 */

require_once __DIR__."/../vendor/autoload.php";

use Boscot\Test\GameTest;


/**
 * Class: CriminalTest
 * 
 * Test Criminal classes
 *
 * @category Test
 * @package  Boscot
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPL v3
 * @link     None
 * @see      PHPUnit_Framework_TestCase
 */
class CriminalTest extends GameTest
{
	public $domain = "thebestapp.criminalcasegame.com";

    /**
     * Configuration
     *
     * Create Criminal object
     *
     * @return void
     */
    protected function setUp()
	{

    }

    
    /**
     * Test all action method of the controller
     *
     * @return void
     */
    public function testHack()
	{
		$nonce = 'boscot';

		#$json = '{"id":1,"batch":[{"id":1,"response":[]},{"id":2,"response":{"day":1,"collected":1}}],"nonce":"0bde"}';
		$query_json = '{"batch":[{"action":"getRequests","id":16,"params":{"fb_id":"100002502431024"}}],"id":15,"nonce":"'.$nonce.'"}';
		$query_base = base64_encode($query_json);

		$request =
<<<EOF
POST /bridge.php HTTP/1.1
Host: $this->domain
Content-Type: application/x-www-form-urlencoded
Connection: close

query=aFYMuMD2LeLDVqAD30SuTrLPqun29Z0lwyC6o18Q9sw.$query_base
EOF;
$content = $this->sendData($request, GameTest::DOMAIN);

$this->assertSame(1, preg_match('#"from":"1000#ms', $content));
$this->assertSame(1, preg_match('#compensation#ms', $content));

    }
}
