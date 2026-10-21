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
            'message' => "Read the problem statement above.\nGreedy: always the biggest square?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it fails on 11 × 13', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy gives 8 there, but 6 is possible.\nStep back to when you chose greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where to place the next square?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Anywhere free', 'next' => 'wrong_b'],
                ['label' => 'At the lowest, leftmost empty cell', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A fixed order avoids revisiting the same tilings.\nStep back to when you chose any cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Prune when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count ≥ best so far', 'next' => 'success'],
                ['label' => 'Never', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without pruning the search explodes.\nStep back to when you skipped pruning.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Exponential but fast for n, m ≤ 13. 2 × 3 → 3. 5 × 8 → 5. 11 × 13 → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
