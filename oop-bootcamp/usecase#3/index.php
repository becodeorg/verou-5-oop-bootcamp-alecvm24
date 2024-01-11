<?php
class Content 
{
    public $title;
    public $text;
    public $isBreakingNews;

    public function __construct($title, $text, $isBreakingNews = false) 
    {
        $this->title = $title;
        $this->text = $text;
        $this->isBreakingNews = $isBreakingNews;
    }

    public function display()
    {
        $modifiedTitle = $this->title;

        if ($this->isBreakingNews)
        {
            $modifiedTitle = "BREAKING: " . $modifiedTitle;
        }

        if ($this instanceof Ad)
        {
            $modifiedTitle = strtoupper($modifiedTitle);
        } elseif ($this instanceof Vacancy)
        {
            $modifiedTitle .= " - apply now !";
        }

        echo "<h2>$modifiedTitle</h2>";
        echo "<p>$this->text</p>";
        echo "<hr>";
    }
}

class Article extends Content
{

}

class Ad extends Content
{

}

class Vacancy extends Content
{

}

$articles = [
    new Article ("Article 1", "This is the text for article 1."),
    new Article ("Article 2","This is the text for article 2.", true),
];

$ads = [
    new Ad ("Ad title", "This is a text for an ad"),
];

$vacancies = [
    new Vacancy("Vacancy title", "This is a text for a vacancy"),
];

foreach( $articles as $article)
{
    $article->display();
}

foreach($ads as $ad)
{
    $ad->display();
}

foreach($vacancies as $vacancy)
{
    $vacancy->display();
}

?>