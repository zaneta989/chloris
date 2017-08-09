<?php

use AppBundle\DataFixtures\ORM\LoadUserData;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Exception\ElementNotFoundException;
use Behat\Mink\Exception\ExpectationException;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

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

        $purger = new ORMPurger();
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);

        $executor = new ORMExecutor($entityManager, $purger);
        $executor->execute($loader->getFixtures());
    }
    /**
     * @Given /^I am authenticated as "([^"]*)" using "([^"]*)"$/
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

            if($row==null)
            {
               throw new Exception('Cannot find any text "'.$key.'"');
            }

            for($i=1; $i<count($headlines); $i++)
            {
                if(strpos($row->getHtml(), $text[$headlines[$i]])===false)
                {
                    var_dump($text[$headlines[$i]]);
                    var_dump($row->getHtml());

                    throw new Exception('Text "'.$text[$headlines[$i]].'" does not exist
                     in table row #'.$i .'with "'.$key.'"');
                }

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
        foreach ($table as $text)
        {
            // key is an unique value used to find certain column
            $key = $text[$headlines[0]];
            $row = $this
                ->getSession()
                ->getPage()
                ->find('css', 'table tr:contains("'.$key.'")');

            if($row!=null)
            {
                throw new Exception('Can find text "'.$key.'"');
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
        if($row == null)
        {
            throw new Exception("Row is empty");
        }
        $link = $row->findLink($linkText);

        if($link==null)
        {
            throw new Exception('Link"'.$linkText.'" does not exist in row with text "'.$linkText.'"');
        }

        $link->click();
    }
    /**
     *
     * @Then /^the "([^"]*)" option from "([^"]*)" should be selected$/
     *
     */
    public function theOptionFromShouldBeSelected($option, $select)
    {
        $selectField = $this->getSession()->getPage()->findField($select);
        if (null === $selectField) {
            throw new ElementNotFoundException($this->getSession(), 'select field', 'id|name|label|value', $select);
        }

        $optionField = $selectField->find('named', array(
            'option',
            $option,
        ));

        if (null === $optionField) {
            throw new ElementNotFoundException($this->getSession(), 'select option field', 'id|name|label|value', $option);
        }

        if (!$optionField->isSelected()) {
            throw new ExpectationException('Select option field with text "'.$option.'" is not selected in the select "'.$select.'"', $this->getSession());
        }
    }

}
