<?php

class Desavouer {

  /**
   * Private class vars
   *
   * @var $backlinks object
   */
  private $backlinks, $domains = array(), $start;

  /**
   * Class constructor
   *
   */
  function __construct()
  {
    $this->start = microtime(true);
    $this->checkArguments();
    $this->getBacklinks();
    $this->processDomains();
    $this->buildOutput();
    $this->showStats();
  }

  /**
   * Check script arguments
   *
   *
   * @return void
   */
  private function checkArguments()
  {
    global $argv;
    if(isset($argv[1])) {
      switch($argv[1]) {
        case('help'):
          $this->printHelp();
          break;
        case('run'):
          $this->checkRequirements();
          break;
      }
    } else {
      $this->printHelp();
    }
  }

  /**
   * Displays our help menu
   *
   * @return void
   */
  private function printHelp()
  {
    echo "
    \n
    ~~~|| desavouer (disavow) ||~~~
    \n
    This script is built to take a dump of urls in a text file and convert them to
    domains to be uploaded to Google's disavow tool. Each url should on its own line
    in the text file.\n
    To run the script: 'php desavouer.php run'\n
    To display this menu: 'php desavouer.php help'\n
    ";
    die();
  }

  /**
   * Checks to see if the environment meets requirements
   *
   * @return void
   */
  private function checkRequirements()
  {
    if(!file_exists(__DIR__.'/backlinks.txt')) {
      exit('Copy backlinks.txt.sample to backlinks.txt and enter all your URLs to process.');
    }
  }

  /**
   * Reads our backlinks file and brings them into the script
   *
   * @return void
   */
  private function getBacklinks()
  {
    $this->backlinks = file_get_contents(__DIR__.'/backlinks.txt');
    $this->backlinks = explode("\n", $this->backlinks);
  }

  /**
   * Processes our domains and gets the host
   *
   * @return void
   */
  private function processDomains()
  {
    if(sizeof($this->backlinks) > 0) {
      foreach($this->backlinks as $backlink) {
        $parsed = parse_url($backlink);
        if(isset($parsed['host'])) $this->checkExistence($parsed['host']);
      }
    }
  }

  /**
   * Checks the existence of our domain in the array of domains
   *
   * @param string
   *
   * @return void
   */
  private function checkExistence($domain)
  {
    if(!in_array($domain, $this->domains)) {
      $this->domains[] = $domain;
    }
  }

  /**
   * Builds our output string and writes it to file
   *
   * @return void
   */
  private function buildOutput()
  {
    $output = "";
    foreach($this->domains as $domain) {
      $output .= "domain:".$domain."\n";
    }
    if("" !== trim($output)) {
      file_put_contents('output.txt', $output);
    }
  }

  /**
   * Shows our final stats once the job has been done
   *
   * @return void
   */
  private function showStats()
  {
    echo "\n";
    echo "Process completed successfully.";
    echo "\n";
    echo "\n";
    echo "/\/\/\/\/\/\/\/\/\n";
    echo "Backlinks: ".(sizeof($this->backlinks))."\n";
    echo "Unique Domains: ".(sizeof($this->domains))."\n";
    echo "Time: ".(microtime(true) - $this->start)." seconds\n";
    echo "/\/\/\/\/\/\/\/\/";
    echo "\n";
  }

}
new Desavouer();