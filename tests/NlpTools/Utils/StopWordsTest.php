<?php

namespace NlpTools\Utils;

use NlpTools\Documents\TokensDocument;
use NlpTools\Utils\Normalizers\Normalizer;

class StopWordsTest extends \PHPUnit_Framework_TestCase
{
    public function testStopwords()
    {
        $stopwords = new StopWords(
            array(
                "to",
                "the"
            )
        );

        $doc = new TokensDocument(explode(" ","if you tell the truth you do not have to remember anything"));
        $doc->applyTransformation($stopwords);
        $this->assertEquals(
            array(
                "if", "you", "tell", "truth", "you", "do", "not", "have", "remember", "anything"
            ),
            $doc->getDocumentData()
        );
    }

    public function testStopwordsWithTransformation()
    {
        $stopwords = new StopWords(
            array(
                "to",
                "the"
            ),
            Normalizer::factory("English")
        );

        $doc = new TokensDocument(explode(" ", "if you tell The truth you do not have To remember anything"));
        $doc->applyTransformation($stopwords);
        $this->assertEquals(
            array(
                "if", "you", "tell", "truth", "you", "do", "not", "have", "remember", "anything"
            ),
            $doc->getDocumentData()
        );
    }
}
