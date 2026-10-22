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
            'message' => "Problem: A table lists tweets and their text. Report the tweets that break any of the rules the statement gives on length, number of mentions and number of hashtags. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nCombine the rules?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'OR', 'next' => 's2'],
                ['label' => 'AND', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check, nothing comes back.\nStep back to when you used AND.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count mentions how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LIKE with a wildcard', 'next' => 'wrong_b'],
                ['label' => 'Length lost when REPLACE removes @', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. LIKE only tells you whether one exists: in the guide’s check, tweets 2 and 3 drop out.\nStep back to when you used LIKE.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Order as the statement asks.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
