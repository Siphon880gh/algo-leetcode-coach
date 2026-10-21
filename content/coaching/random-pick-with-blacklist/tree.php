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
            'message' => "Read the problem statement above.\nStore every allowed number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: n can be 10⁹', 'next' => 's2'],
                ['label' => 'Yes, and pick a random index', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That needs up to 10⁹ entries.\nStep back to when you stored the whitelist.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Draw again until the number is not blacklisted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: if most numbers are blacklisted, that takes many draws', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The expected number of draws can be huge.\nStep back to when you used rejection sampling.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "With m = n − |B|, what do blacklisted numbers below m map to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct allowed numbers in [m, n)', 'next' => 'success'],
                ['label' => 'Their position in the blacklist', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each must map to a real allowed number, and the counts in [m, n) match exactly.\nStep back to when you used positions.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|B|) setup, O(1) per pick. n = 7, blacklist [2,3,5] → picks uniformly from {0,1,4,6}.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
