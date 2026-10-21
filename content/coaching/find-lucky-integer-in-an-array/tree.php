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
            'message' => "Read the problem statement above.\nSeveral lucky numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the largest', 'next' => 's2'],
                ['label' => 'Return the first found', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement asks for the largest.\nStep back to when you returned the first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "None?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => '−1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. −1 signals no lucky number.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compare what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Frequency with value', 'next' => 'success'],
                ['label' => 'Index with value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Positions do not matter.\nStep back to when you used indices.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2,2,3,4] → 2. [1,2,2,3,3,3] → 3. [2,2,2,3,3] → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
