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
            'message' => "Read the problem statement above.\nCut where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Shortest prefix reaching the suffix MEX', 'next' => 's2'],
                ['label' => 'Take everything', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [2] instead of [2, 1].\nStep back to when you took the whole array.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No 0 left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One block for the rest', 'next' => 'wrong_b'],
                ['label' => 'One element per block', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → [0] instead of [0, 0].\nStep back to when you merged the zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + V). Examples → [2, 1], [3], [0, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
