<?php

use AppBundle\DataFixtures\ORM\LoadUserData;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ExpectationException;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Behat\Symfony2Extension\Driver\KernelDriver;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use PHPUnit\Framework\Assert;
use PlantBundle\DataFixtures\ORM\LoadPlantData;

/** @noinspection PhpUndefinedClassInspection */
class FeatureContext extends MinkContext implements Context
{
    use KernelDictionary;
    public function __construct()
    {
    }
    /**
     * @AfterScenario @database
     */
    public function loadDataFixtures()
    {
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $loader = new Loader();
        $loader->addFixture(new LoadUserData());
        $loader->addFixture(new LoadPlantData);
        $purger = new ORMPurger();
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);
        $executor = new ORMExecutor($entityManager, $purger);
        $executor->execute($loader->getFixtures());
    }

    /**
     * @Given /^I am authenticated as "([^"]*)" using "([^"]*)"$/
     * @param string $username
     * @param string $password
     */
    public function iAmAuthenticatedAs($username, $password) {
        $this->visit('/login');
        $this->fillField('username', $username);
        $this->fillField('password', $password);
        $this->pressButton('Log in');
    }
    /**
     * @When /^I click "([^"]*)"$/
     * @param $link
     */
    public function iClick($link)
    {
        $this->clickLink($link);
    }
    /**
     * @Then I should see the following text in row:
     * @param TableNode $table
     * @throws Exception
     */
    public function iShouldSeeTheFollowingText(TableNode $table)
    {
        $headlines = $table->getRow(0);
        foreach ($table as $text)
        {
            // key is an unique value used to find certain column
            $key = $text[$headlines[0]];
            $row = $this
                ->getSession()
                ->getPage()
                ->find('css', 'table tr:contains("'.$key.'")');
            Assert::assertNotNull($row,'Cannot find any text "'.$key.'"');
            for($i=1; $i<count($headlines); $i++)
            {
                Assert::assertContains( $text[$headlines[$i]], $row->getHtml(),
                    'Text "'.$text[$headlines[$i]].'" does not exist in table row #'.$i .'with "'.$key.'"');
            }
        }
    }
    /**
     * @Then I should not see the following text in row:
     * @param TableNode $table
     * @throws Exception
     */
    public function iShouldNotSeeTheFollowingText(TableNode $table)
    {
        $headlines = $table->getRow(0);
        $countHeadlines=count($headlines);
        $countFind=0;
        foreach ($table as $text)
        {
            // key is an unique value used to find certain column
            $key = $text[$headlines[0]];
            $row = $this
                ->getSession()
                ->getPage()
                ->find('css', 'table tr:contains("'.$key.'")');
            if($row!=null)
            {   $countFind+=1;
                for($i=1; $i<count($headlines); $i++)
                {
                    if(strpos($row->getHtml(), $text[$headlines[$i]])===true)
                    {
                        $countFind+=1;
                    }
                    else
                    {
                        break;
                    }
                }
                Assert::assertTrue($countHeadlines!=$countFind,'In row found '.$countFind.' words on '.$countHeadlines .'with "'.$key.'"');
            }
        }

    }
    /**
     * @When I click :linkText in the :rowText row
     * @param $linkText
     * @param $rowText
     * @throws Exception
     */
    public function iClickInTheRow($linkText, $rowText)
    {
        $row = $this
            ->getSession()
            ->getPage()
            ->find('css', 'table tr:contains("'.$rowText.'")');
        Assert::assertNotNull($row, "Row is empty");
        $link = $row->findLink($linkText);
        Assert::assertNotNull($link,'Link"'.$linkText.'" does not exist in row with text "'.$linkText.'"');
        $link->click();
    }

    /**
     *
     * @Then /^the "([^"]*)" option from "([^"]*)" should be selected$/
     * @param string $option
     * @param string $select
     */
    public function theOptionFromShouldBeSelected($option, $select)
    {
        $selectField = $this->getSession()->getPage()->findField($select);
        Assert::assertNotNull($selectField,"Not select field id|name|label|value \"'.$select.'\"'");
        $optionField = $selectField->find('named', array(
            'option',
            $option,
        ));
        Assert::assertNotNull($optionField,"Not select option field");
        Assert::assertTrue($optionField->isSelected(),'Select option field with text "'.$option.'" is not selected in the select "'.$select.'"');
    }
}

