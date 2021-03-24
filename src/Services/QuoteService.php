<?php

namespace App\Services;

use App\Repository\QuoteRepository;
use cebe\markdown\Markdown;

class QuoteService {

    private $parser;
    private $quoteRepo;

    public function __construct(QuoteRepository $quoteRepo, Markdown $parser)
    {
        $this->quoteRepo = $quoteRepo;
        $this->parser = $parser;
    }

    public function getQuotes():array{

        $qImportants = $this->quoteRepo->quoteImportant();
        $qNone = $this->quoteRepo->quoteNone();


        $quotes = array_merge($qImportants,$qNone  );

        $parseQuotes = [];

        foreach($quotes as $quote){
            $parseQuotes[] = [
                'id' => $quote->getId(),
                'title' => $quote->getTitle(),
                'content' => $this->parser->parse($quote->getContent()),
                'position' => $quote->getPosition(),
                'createdAt' => $quote->getCreatedAt()
            ];
        }


        return $parseQuotes;
    }

}