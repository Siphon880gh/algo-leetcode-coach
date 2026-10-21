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
            'message' => "Read the problem statement above.\nGreedy shortest new piece?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: search all splits', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A short early piece can block better later splits.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After recursing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it', 'next' => 'wrong_b'],
                ['label' => 'Remove the piece from the set', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sibling branches must not see it.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Prune?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|seen| + (n − i) ≤ best → return', 'next' => 'success'],
                ['label' => 'No pruning possible', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each remaining char adds at most one piece.\nStep back to when you skipped pruning.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. \"ababccc\" → 5. \"aba\" → 2. \"aa\" → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
