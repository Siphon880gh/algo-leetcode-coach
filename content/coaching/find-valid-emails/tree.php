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
            'message' => "Read the problem statement above.\nFilter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A character-class REGEXP', 'next' => 's2'],
                ['label' => 'LIKE \'%@%.com\'', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It also keeps x.y@abc.com.\nStep back to when you used LIKE.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Anchors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'None', 'next' => 'wrong_b'],
                ['label' => '^ and $', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. x.y@abc.com is kept again (y@abc.com matches inside).\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total email length). Example → 1, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
