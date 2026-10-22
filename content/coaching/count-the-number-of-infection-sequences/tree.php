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
            'message' => "Read the problem statement above.\nCombine gaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'total! / Π gap!', 'next' => 's2'],
                ['label' => 'Multiply each gap’s own count', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Gaps interleave; example 2 → 1 instead of 3.\nStep back to when you multiplied the gaps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Inner gap of length L?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same as an edge gap', 'next' => 'wrong_b'],
                ['label' => 'Also 2^(L − 1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It grows from both ends; example 1 → 1 instead of 4.\nStep back to when you treated it like an edge.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
