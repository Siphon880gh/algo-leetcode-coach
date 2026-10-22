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
            'message' => "Problem: A table lists coordinate pairs (X, Y); rows may repeat. Two rows are symmetric when one’s X equals the other’s Y and one’s Y equals the other’s X. Report each symmetric coordinate once, as the one with X ≤ Y. Column names, the output columns and the ordering are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nJoin condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Swapped values on two different rows', 'next' => 's2'],
                ['label' => 'Swapped values, same row allowed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A single (5, 5) would match itself; the sample adds (5, 5).\nStep back to when you allowed the same row.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Report?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every joined row', 'next' => 'wrong_b'],
                ['label' => 'DISTINCT rows with X ≤ Y', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both orders and duplicates appear; the sample gives 6 rows instead of 3.\nStep back to when you skipped the filter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sample → (20, 20), (20, 21), (22, 23).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
