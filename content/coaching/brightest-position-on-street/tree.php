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
            'message' => "Problem: Each street lamp is [position, range] and lights every integer from position − range to position + range inclusive. The brightness of a position is the number of lamps lighting it. Return the brightest position; if several tie, return the smallest. For instance, [[-3,2],[1,2],[3,3]] → −1, [[1,0],[0,1]] → 1, [[1,2]] → −1. (Restated from memory; limits and examples may differ slightly.)\nWhere does a lamp stop lighting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add −1 at p + r + 1', 'next' => 's2'],
                ['label' => 'Add −1 at p + r', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. p + r is still lit; the range is inclusive.\nStep back to when you ended at p + r.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which positions to check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every integer position in range', 'next' => 'wrong_b'],
                ['label' => 'Only event keys', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Positions can be far apart; brightness only changes at event keys.\nStep back to when you walked every integer.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Ties?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Update only on strictly greater', 'next' => 'success'],
                ['label' => 'Update on greater or equal', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That returns the largest tied position, not the smallest.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → −1, 1, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
