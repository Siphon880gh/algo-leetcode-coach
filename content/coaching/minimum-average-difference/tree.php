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
            'message' => "Read the problem statement above.\nRight side empty at i = n − 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its average is 0', 'next' => 's2'],
                ['label' => 'Skip that index', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 [0] has no other index, so it would return nothing instead of 0.\nStep back to when you skipped the last index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie in difference?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the last index', 'next' => 'wrong_b'],
                ['label' => 'Keep the first index', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [0,0,0] → 2 instead of 0.\nStep back to when you kept the last.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One running prefix and the total', 'next' => 'success'],
                ['label' => 'Recompute both sides at each index', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. n reaches 10^5, so that is quadratic.\nStep back to when you recomputed the sums.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
