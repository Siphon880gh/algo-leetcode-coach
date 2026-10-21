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
            'message' => "Read the problem statement above.\nHow many inequalities do you check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All three: each pair must sum to more than the third', 'next' => 's2'],
                ['label' => 'Only x + y > z', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The longest side could be x or y, so one test is not enough.\nStep back to when you checked one pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "> or >=?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '>=', 'next' => 'wrong_b'],
                ['label' => '>', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal sums give a flat segment: 1, 2, 3 is not a triangle.\nStep back to when you used >=.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What goes in the triangle column?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'CASE … THEN \'Yes\' ELSE \'No\'', 'next' => 'success'],
                ['label' => 'The boolean, 1 or 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The expected column holds the strings Yes and No.\nStep back to when you returned 1 or 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. x + y > z AND x + z > y AND y + z > x → 'Yes', else 'No': O(n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
