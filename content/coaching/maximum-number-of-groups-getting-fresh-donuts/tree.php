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
            'message' => "Read the problem statement above.\nWhat matters about a group?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its size mod batchSize', 'next' => 's2'],
                ['label' => 'Its exact size', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only the leftover after each group affects freshness.\nStep back to when you used exact sizes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Memo key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The order of groups so far', 'next' => 'wrong_b'],
                ['label' => 'The remaining count per remainder', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Orders explode; counts determine the leftover.\nStep back to when you keyed by order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Remainder-0 groups?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always happy, count them directly', 'next' => 'success'],
                ['label' => 'Put them in the search', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Serving them first keeps them happy and leaves the leftover unchanged.\nStep back to when you searched over them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 4, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
