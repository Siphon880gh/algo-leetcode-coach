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
            'message' => "Read the problem statement above.\nIs a cell dug?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Set lookup', 'next' => 's2'],
                ['label' => 'Scan the dig list', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Up to 4 · 10^5 artifact cells times 10^5 dig entries is about 4 · 10^10 steps.\nStep back to when you scanned the list.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Extracted when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any of its cells is dug', 'next' => 'wrong_b'],
                ['label' => 'Every one of its cells is dug', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 2 instead of 1; artifact 1 still has (1,1) buried.\nStep back to when you accepted any cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cell range of an artifact?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r1 … r2 and c1 … c2 inclusive', 'next' => 'success'],
                ['label' => 'Exclusive of r2 and c2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A one-cell artifact like [0,0,0,0] would have no cells and count as extracted for free.\nStep back to when you excluded the far corner.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(dig + artifacts). Examples → 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
