<?php

/**
 * gomoob/php-pushwoosh
 *
 * @copyright Copyright (c) 2014, GOMOOB SARL (http://gomoob.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE.md file)
 */
namespace Gomoob\Pushwoosh\Model\Notification;

use Gomoob\Pushwoosh\Model\Condition\IntCondition;
use Gomoob\Pushwoosh\Model\Condition\ListCondition;
use Gomoob\Pushwoosh\Model\Condition\StringCondition;
use Gomoob\Pushwoosh\Exception\PushwooshException;

/**
 * Test case used to test the <code>Notification</code> class.
 *
 * @author Baptiste GAILLARD (baptiste.gaillard@gomoob.com)
 * @group  NotificationTest
 */
class NotificationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test method for the <tt>addCondition($condition)</tt>, <tt>getConditions()</tt> and
     * <tt>setConditions($conditions)</tt> functions.
     */
    public function testAddGetSetConditions()
    {
        // Test for 'addCondition'
        $notification = new Notification();
        $condition0 = IntCondition::create('intTag')->eq(10);
        $condition1 = ListCondition::create('listTag')->in(['value1', 'value2', 'value3']);
        $condition2 = StringCondition::create('stringTag')->eq('stringValue');

        $this->assertNull($notification->getConditions());
        $notification->addCondition($condition0);
        $notification->addCondition($condition1);
        $notification->addCondition($condition2);

        $conditions = $notification->getConditions();
        $this->assertCount(3, $conditions);
        $this->assertSame($condition0, $conditions[0]);
        $this->assertSame($condition1, $conditions[1]);
        $this->assertSame($condition2, $conditions[2]);

        // Test for 'setConditions'
        $notification = new Notification();
        $this->assertNull($notification->getConditions());
        $notification->setConditions([$condition0, $condition1, $condition2]);

        $conditions = $notification->getConditions();
        $this->assertCount(3, $conditions);
        $this->assertSame($condition0, $conditions[0]);
        $this->assertSame($condition1, $conditions[1]);
        $this->assertSame($condition2, $conditions[2]);

    }

    /**
     * Test method for the <tt>addDevice($device)</tt>, <tt>getDevices()</tt> and <tt>setDevices($devices)</tt>
     * functions.
     */
    public function testAddGetSetDevices()
    {
        // Test for 'addDevice'
        $notification = new Notification();
        $this->assertNull($notification->getDevices());
        $this->assertSame($notification, $notification->addDevice('device0'));
        $this->assertSame($notification, $notification->addDevice('device1'));
        $this->assertSame($notification, $notification->addDevice('device2'));
        $devices = $notification->getDevices();
        $this->assertCount(3, $devices);
        $this->assertContains('device0', $devices);
        $this->assertContains('device1', $devices);
        $this->assertContains('device2', $devices);

        // Test for 'setDevices'
        $notification = new Notification();
        $this->assertNull($notification->getDevices());
        $devices = ['device0', 'device1', 'device2'];
        $this->assertSame($notification, $notification->setDevices($devices));
        $devices = $notification->getDevices();
        $this->assertCount(3, $devices);
        $this->assertContains('device0', $devices);
        $this->assertContains('device1', $devices);
        $this->assertContains('device2', $devices);
    }

    /**
     * Test method for the <tt>addPlatform($platform)</tt>, <tt>getPlatforms()</tt> and
     * <tt>setPlatforms($platforms)</tt> functions.
     */
    public function testGetSetPlatforms()
    {
        $platform0 = Platform::amazon();
        $platform1 = Platform::android();
        $platform2 = Platform::blackBerry();

        // Test for the 'addPlatform' method
        $notification = new Notification();
        $this->assertNull($notification->getPlatforms());
        $this->assertSame($notification, $notification->setPlatforms([$platform0, $platform1, $platform2]));
        $platforms = $notification->getPlatforms();
        $this->assertCount(3, $platforms);
        $this->assertSame($platform0, $platforms[0]);
        $this->assertSame($platform1, $platforms[1]);
        $this->assertSame($platform2, $platforms[2]);

        // Test for the 'setPlatforms' method
        $notification = new Notification();
        $this->assertNull($notification->getPlatforms());
        $this->assertSame($notification, $notification->addPlatform($platform0));
        $this->assertSame($notification, $notification->addPlatform($platform1));
        $this->assertSame($notification, $notification->addPlatform($platform2));
        $platforms = $notification->getPlatforms();
        $this->assertCount(3, $platforms);
        $this->assertSame($platform0, $platforms[0]);
        $this->assertSame($platform1, $platforms[1]);
        $this->assertSame($platform2, $platforms[2]);

    }

    /**
     * Test method for the <tt>getADM()</tt> and <tt>setADM($aDM)</tt> functions.
     */
    public function testGetSetADM()
    {
        $notification = new Notification();
        $this->assertNull($notification->getADM());
        $aDM = new ADM();
        $this->assertSame($notification, $notification->setADM($aDM));
        $this->assertSame($aDM, $notification->getADM());
    }

    /**
     * Test method for the <tt>getAndroid()</tt> and <tt>setAndroid($android)</tt> functions.
     */
    public function testGetSetAndroid()
    {
        $notification = new Notification();
        $this->assertNull($notification->getAndroid());
        $android = new Android();
        $this->assertSame($notification, $notification->setAndroid($android));
        $this->assertSame($android, $notification->getAndroid());
    }

    /**
     * Test method for the <tt>getBlackBerry()</tt> and <tt>setBlackBerry($blackBerry)</tt> functions.
     */
    public function testGetSetBlackBerry()
    {
        $notification = new Notification();
        $this->assertNull($notification->getBlackBerry());
        $blackBerry = new BlackBerry();
        $this->assertSame($notification, $notification->setBlackBerry($blackBerry));
        $this->assertSame($blackBerry, $notification->getBlackBerry());
    }

    /**
     * Test method for the <tt>getContent()</tt> and <tt>setContent($aDM)</tt> functions.
     */
    public function testGetSetContent()
    {
        $notification = new Notification();
        $this->assertNull($notification->getContent());
        $this->assertSame($notification, $notification->setContent('CONTENT'));
        $this->assertSame('CONTENT', $notification->getContent());
    }

    /**
     * Test method for the <tt>getData()</tt> and <tt>setData($data)</tt> functions.
     */
    public function testGetSetData()
    {
        $notification = new Notification();
        $this->assertNull($notification->getData());
        $data = ['field0' => 'field0_value', 'field1' => 'field1_value'];
        $this->assertSame($notification, $notification->setData($data));
        $data = $notification->getData();
        $this->assertCount(2, $data);
        $this->assertSame('field0_value', $data['field0']);
        $this->assertSame('field1_value', $data['field1']);
    }

    /**
     * Test method for the <tt>getFilter()</tt> and <tt>setFilter($filter)</tt> functions.
     */
    public function testGetSetFilter()
    {
        $notification = new Notification();
        $this->assertNull($notification->getFilter());
        $this->assertSame($notification, $notification->setFilter('FILTER'));
        $this->assertSame('FILTER', $notification->getFilter());
    }

    /**
     * Test method for the <tt>getIOS()</tt> and <tt>setIOS($iOS)</tt> functions.
     */
    public function testGetSetIOS()
    {
        $notification = new Notification();
        $this->assertNull($notification->getIOS());
        $iOS = new IOS();
        $this->assertSame($notification, $notification->setIOS($iOS));
        $this->assertSame($iOS, $notification->getIOS());
    }

    /**
     * Test method for the <tt>getLink()</tt> and <tt>setLink($link)</tt> functions.
     */
    public function testGetSetLink()
    {
        $notification = new Notification();
        $this->assertNull($notification->getLink());
        $this->assertSame($notification, $notification->setLink('http://www.gomoob.com'));
        $this->assertSame('http://www.gomoob.com', $notification->getLink());
    }

    /**
     * Test method for the <tt>getMac()</tt> and <tt>setMac($mac)</tt> functions.
     */
    public function testGetSetMac()
    {
        $notification = new Notification();
        $this->assertNull($notification->getMac());
        $mac = new Mac();
        $this->assertSame($notification, $notification->setMac($mac));
        $this->assertSame($mac, $notification->getMac());
    }

    /**
     * Test method for the <tt>getMinimizeLink()</tt> and <tt>setMinimizeLink($minimizeLink)</tt> functions.
     */
    public function testGetSetMinimizeLink()
    {
        $notification = new Notification();
        $this->assertNull($notification->getMinimizeLink());
        $minimizeLink = MinimizeLink::bitly();
        $this->assertSame($notification, $notification->setMinimizeLink($minimizeLink));
        $this->assertSame($minimizeLink, $notification->getMinimizeLink());
    }

    /**
     * Test method for the <tt>getPageId()</tt> and <tt>setPageId($pageId)</tt> functions.
     */
    public function testGetSetPageId()
    {
        $notification = new Notification();
        $this->assertNull($notification->getPageId());
        $this->assertSame($notification, $notification->setPageId(15));
        $this->assertSame(15, $notification->getPageId());
    }

    /**
     * Test method for the <tt>getSafari()</tt> and <tt>setSafari($safari)</tt> functions.
     */
    public function testGetSetSafari()
    {
        $notification = new Notification();
        $this->assertNull($notification->getSafari());
        $safari = new Safari();
        $this->assertSame($notification, $notification->setSafari($safari));
        $this->assertSame($safari, $notification->getSafari());
    }

    /**
     * Test method for the <tt>getSendDate</tt> and <tt>setSendDate($sendDate)</tt> functions.
     */
    public function testGetSetSendDate()
    {
        $notification = new Notification();

        // Test with an invalid send date string
        try {
            $notification->setSendDate('aaa');
            $this->fail('Must have thrown a PushwooshException !');

        } catch (PushwooshException $pe) {
            // Expected

        }

        // Test with a send date which is neither a \DateTime neither a string
        try {
            $notification->setSendDate(654);
            $this->fail('Must have thrown a PushwooshException !');

        } catch (PushwooshException $pe) {
            // Expected

        }

        // Test with 'now'
        $this->assertSame($notification, $notification->setSendDate('now'));
        $this->assertSame('now', $notification->getSendDate());

        // Test with a valid string date provided
        $this->assertSame($notification, $notification->setSendDate('2014-01-01 10:06'));
        $this->assertSame(
            \DateTime::createFromFormat('Y-m-d H:i', '2014-01-01 10:06')->getTimestamp(),
            $notification->getSendDate()->getTimestamp()
        );

        // Test with a \DateTime
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i', '2014-01-01 10:06');
        $this->assertSame($notification, $notification->setSendDate($dateTime));
        $this->assertSame($dateTime, $notification->getSendDate());

    }

    /**
     * Test method for the <tt>getWNS()</tt> and <tt>setWNS($wNS)</tt> functions.
     */
    public function testGetSetWNS()
    {
        $notification = new Notification();
        $this->assertNull($notification->getWNS());
        $wNS = new WNS();
        $this->assertSame($notification, $notification->setWNS($wNS));
        $this->assertSame($wNS, $notification->getWNS());
    }

    /**
     * Test method for the <tt>getWP()</tt> and <tt>setWP($wP)</tt> functions.
     */
    public function testGetSetWP()
    {
        $notification = new Notification();
        $this->assertNull($notification->getWP());
        $wP = new WP();
        $this->assertSame($notification, $notification->setWP($wP));
        $this->assertSame($wP, $notification->getWP());
    }

    /**
     * Test method for the <tt>isIgnoreUserTimezone()</tt> and <tt>setIgnoreUserTimezone()</tt> functions.
     */
    public function testIsSetIgnoreUserTimezone()
    {
        $notification = new Notification();
        $this->assertTrue($notification->isIgnoreUserTimezone());
        $this->assertSame($notification, $notification->setIgnoreUserTimezone(false));
        $this->assertFalse($notification->isIgnoreUserTimezone());
    }

    /**
     * Test method for the <tt>jsonSerialize()</tt> function.
     */
    public function testJsonSerialize()
    {
        $array = Notification::create()
            ->setSendDate('now')
            ->setIgnoreUserTimezone(true)
            ->setContent(
                [
                    'en' => 'English',
                    'ru' => 'Русский',
                    'de' => 'Deutsch'
                ]
            )
            ->setPageId(39)
            ->setLink('http://google.com')
            ->setMinimizeLink(MinimizeLink::none())
            ->setData(
                [
                   'custom' => 'json data'
                ]
            )
            ->setPlatforms(
                [
                    Platform::iOS(),
                    Platform::blackBerry(),
                    Platform::android(),
                    Platform::nokia(),
                    Platform::windowsPhone7(),
                    Platform::macOSX(),
                    Platform::windows8(),
                    Platform::amazon(),
                    Platform::safari(),
                    Platform::chrome()
                ]
            )
            ->setDevices(
                [
                    'dec301908b9ba8df85e57a58e40f96f523f4c2068674f5fe2ba25cdc250a2a41'
                ]
            )
            ->setFilter('FILTER_NAME')
            ->setConditions(
                [
                    IntCondition::create('intTag')->gte(10),
                    StringCondition::create('stringTag')->eq('stringValue'),
                    ListCondition::create('listTag')->in(['value0', 'value1', 'value2'])
                ]
            )
            ->setADM(
                ADM::create()
                    ->setBanner('http://example.com/banner.png')
                    ->setCustomIcon('http://example.com/image.png')
                    ->setHeader('Header')
                    ->setIcon('icon')
                    ->setPriority(-1)
                    ->setRootParams(['key' => 'value'])
                    ->setSound('push.mp3')
                    ->setTtl(3600)
            )
            ->setAndroid(
                Android::create()
                    ->setBadges(5)
                    ->setBanner('http://example.com/banner.png')
                    ->setCustomIcon('http://example.com/image.png')
                    ->setGcmTtl(3600)
                    ->setHeader('Header')
                    ->setIbc('#AA9966')
                    ->setIcon('icon')
                    ->setLed('#4455cc')
                    ->setPriority(-1)
                    ->setRootParams(['key' => 'value'])
                    ->setSound('push.mp3')
                    ->setVibration(true)
            )
            ->setBlackBerry(
                BlackBerry::create()
                    ->setHeader('header')
            )
            ->setChrome(
                Chrome::create()
                    ->setGcmTtl(3600)
                    ->setIcon('icon')
                    ->setTitle('Title')
            )
            ->setIOS(
                IOS::create()
                    ->setApnsTrimContent(true)
                    ->setBadges(5)
                    ->setRootParams(['aps' => ['content-available' => '1']])
                    ->setSound('sound file.wav')
                    ->setTtl(3600)
                    ->setTrimContent(true)
            )
            ->setMac(
                Mac::create()
                    ->setBadges(3)
                    ->setRootParams(['content-available' => '1'])
                    ->setSound('sound.caf')
                    ->setTtl(3600)
            )
            ->setSafari(
                Safari::create()
                    ->setAction('Click here')
                    ->setTitle('Title')
                    ->setTtl(3600)
                    ->setUrlArgs(['firstArgument', 'secondArgument'])
            )
            ->setWNS(
                WNS::create()
                    ->setContent(
                        [
                            'en' => 'ENENENEN',
                            'de' => 'DEDEDEDE'
                        ]
                    )
                    ->setTag('myTag')
                    ->setType('Badge')
            )
            ->setWP(
                WP::create()
                    ->setBackbackground('/Resources/Green.jpg')
                    ->setBackcontent('back content')
                    ->setBackground('/Resources/Red.jpg')
                    ->setBacktitle('back title')
                    ->setCount(3)
                    ->setType('Tile')
            )
            ->jsonSerialize();

        // Test the generic properties
        $this->assertCount(58, $array);
        $this->assertSame('now', $array['send_date']);
        $this->assertTrue($array['ignore_user_timezone']);
        $this->assertCount(3, $array['content']);
        $this->assertSame('English', $array['content']['en']);
        $this->assertSame('Русский', $array['content']['ru']);
        $this->assertSame('Deutsch', $array['content']['de']);
        $this->assertSame(39, $array['page_id']);
        $this->assertSame('http://google.com', $array['link']);
        $this->assertSame(0, $array['minimize_link']);
        $this->assertCount(1, $array['data']);
        $this->assertSame('json data', $array['data']['custom']);
        $this->assertCount(10, $array['platforms']);
        $this->assertSame(1, $array['platforms'][0]);
        $this->assertSame(2, $array['platforms'][1]);
        $this->assertSame(3, $array['platforms'][2]);
        $this->assertSame(4, $array['platforms'][3]);
        $this->assertSame(5, $array['platforms'][4]);
        $this->assertSame(7, $array['platforms'][5]);
        $this->assertSame(8, $array['platforms'][6]);
        $this->assertSame(9, $array['platforms'][7]);
        $this->assertSame(10, $array['platforms'][8]);
        $this->assertSame(11, $array['platforms'][9]);
        $this->assertCount(1, $array['devices']);
        $this->assertSame('dec301908b9ba8df85e57a58e40f96f523f4c2068674f5fe2ba25cdc250a2a41', $array['devices'][0]);
        $this->assertSame('FILTER_NAME', $array['filter']);
        $this->assertCount(3, $array['conditions']);
        $this->assertSame('intTag', $array['conditions'][0][0]);
        $this->assertSame('GTE', $array['conditions'][0][1]);
        $this->assertSame(10, $array['conditions'][0][2]);
        $this->assertSame('stringTag', $array['conditions'][1][0]);
        $this->assertSame('EQ', $array['conditions'][1][1]);
        $this->assertSame('stringValue', $array['conditions'][1][2]);
        $this->assertSame('listTag', $array['conditions'][2][0]);
        $this->assertSame('IN', $array['conditions'][2][1]);
        $this->assertCount(3, $array['conditions'][2][2]);
        $this->assertSame('value0', $array['conditions'][2][2][0]);
        $this->assertSame('value1', $array['conditions'][2][2][1]);
        $this->assertSame('value2', $array['conditions'][2][2][2]);

        // Test the ADM parameters
        $this->assertSame('http://example.com/banner.png', $array['adm_banner']);
        $this->assertSame('http://example.com/image.png', $array['adm_custom_icon']);
        $this->assertSame('Header', $array['adm_header']);
        $this->assertSame('icon', $array['adm_icon']);
        $this->assertSame(-1, $array['adm_priority']);
        $this->assertSame(['key' => 'value'], $array['adm_root_params']);
        $this->assertSame('push.mp3', $array['adm_sound']);
        $this->assertSame(3600, $array['adm_ttl']);

        // Test Android parameters
        $this->assertSame(5, $array['android_badges']);
        $this->assertSame('http://example.com/banner.png', $array['android_banner']);
        $this->assertSame('http://example.com/image.png', $array['android_custom_icon']);
        $this->assertSame(3600, $array['android_gcm_ttl']);
        $this->assertSame('Header', $array['android_header']);
        $this->assertSame('#AA9966', $array['android_ibc']);
        $this->assertSame('icon', $array['android_icon']);
        $this->assertSame('#4455cc', $array['android_led']);
        $this->assertSame(-1, $array['android_priority']);
        $this->assertSame(['key' => 'value'], $array['android_root_params']);
        $this->assertSame('push.mp3', $array['android_sound']);
        $this->assertSame(1, $array['android_vibration']);

        // Test BlackBerry parameters
        $this->assertSame('header', $array['blackberry_header']);

        // Test Chrome parameters
        $this->assertSame(3600, $array['chrome_gcm_ttl']);
        $this->assertSame('icon', $array['chrome_icon']);
        $this->assertSame('Title', $array['chrome_title']);

        // Test IOS parameters
        $this->assertSame(1, $array['apns_trim_content']);
        $this->assertSame(5, $array['ios_badges']);
        $this->assertSame(['aps' => ['content-available' => '1']], $array['ios_root_params']);
        $this->assertSame('sound file.wav', $array['ios_sound']);
        $this->assertSame(3600, $array['ios_ttl']);
        $this->assertSame(1, $array['ios_trim_content']);

        // Test Mac parameters
        $this->assertSame(3, $array['mac_badges']);
        $this->assertSame(['content-available' => '1'], $array['mac_root_params']);
        $this->assertSame('sound.caf', $array['mac_sound']);
        $this->assertSame(3600, $array['mac_ttl']);

        // Test Safari parameters
        $this->assertSame('Click here', $array['safari_action']);
        $this->assertSame('Title', $array['safari_title']);
        $this->assertSame(3600, $array['safari_ttl']);
        $this->assertSame(['firstArgument', 'secondArgument'], $array['safari_url_args']);

        // Test WNS parameters
        $this->assertSame(
            [
                'en' => 'ENENENEN',
                'de' => 'DEDEDEDE'
            ],
            $array['wns_content']
        );
        $this->assertSame('myTag', $array['wns_tag']);
        $this->assertSame('Badge', $array['wns_type']);

        // Test WP parameters
        $this->assertSame('/Resources/Green.jpg', $array['wp_backbackground']);
        $this->assertSame('back content', $array['wp_backcontent']);
        $this->assertSame('/Resources/Red.jpg', $array['wp_background']);
        $this->assertSame('back title', $array['wp_backtitle']);
        $this->assertSame(3, $array['wp_count']);
        $this->assertSame('Tile', $array['wp_type']);
    }
}
