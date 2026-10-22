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
            'message' => "Read the problem statement above.\nPair which servers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From different branches of c', 'next' => 's2'],
                ['label' => 'Any two qualifying servers', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Same-branch paths share an edge; example 1 → all 10s.\nStep back to when you paired freely.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairs across branches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'S² − Σ s²', 'next' => 'wrong_b'],
                ['label' => '(S² − Σ s²) / 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts each pair twice; example 1 → [0, 8, 12, 12, 8, 0].\nStep back to when you dropped the halving.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → [0, 4, 6, 6, 4, 0], [2, 0, 0, 0, 0, 0, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
