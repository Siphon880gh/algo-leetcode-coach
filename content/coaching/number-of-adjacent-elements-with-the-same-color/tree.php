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
            'message' => "Read the problem statement above.\nBefore recolouring index i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove its old equal pairs', 'next' => 's2'],
                ['label' => 'Only add the new pairs afterwards', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Stale pairs stay counted; Example 1 → [0,1,1,1,3] instead of [0,1,1,0,2].\nStep back to when you skipped the removal.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two uncoloured neighbours?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A pair, since both are 0', 'next' => 'wrong_b'],
                ['label' => 'Never a pair', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only coloured cells count; Example 1 → [2,2,1,0,2] instead of [0,1,1,0,2].\nStep back to when you counted zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per query. Examples → [0,1,1,0,2], [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
