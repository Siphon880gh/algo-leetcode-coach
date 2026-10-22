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
            'message' => "Read the problem statement above.\nSome 1s already exist?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − (number of 1s)', 'next' => 's2'],
                ['label' => 'n − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every existing 1 saves a step; [1,1,2] → 2 instead of 1.\nStep back to when you ignored the extra 1s.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No 1s, shortest gcd-1 window has length L?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(L − 1) + n', 'next' => 'wrong_b'],
                ['label' => '(L − 1) + (n − 1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The new 1 itself needs no spreading step; Example 1 → 5 instead of 4.\nStep back to when you counted n spreading steps.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² log max). Examples → 4, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
