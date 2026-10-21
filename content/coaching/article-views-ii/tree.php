<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: A views table logs who viewed which article on which date, and rows may repeat. Report the people who viewed more than one distinct article on the same day, sorted by id. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGroup by viewer only?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: viewer and date', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The articles must be on the same day.\nStep back to when you grouped by viewer.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "HAVING what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*) > 1', 'next' => 'wrong_b'],
                ['label' => 'COUNT(DISTINCT article_id) > 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Repeated rows of one article would pass.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A viewer qualifies on two days. Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Once: SELECT DISTINCT', 'next' => 'success'],
                ['label' => 'Twice', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each id appears once.\nStep back to when you kept both.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Distinct ids, ascending.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
