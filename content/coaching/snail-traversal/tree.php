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
            'message' => "Read the problem statement above.\nrowsCount · colsCount ≠ length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return []', 'next' => 's2'],
                ['label' => 'Fill what fits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That input is invalid; Example 3 → [[1],[3]] instead of [].\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Direction in column 1, 3, …?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Top to bottom', 'next' => 'wrong_b'],
                ['label' => 'Bottom to top', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The snail turns at each column; Example 1’s first row → [19,8,16,13] instead of [19,17,16,15].\nStep back to when you kept going down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → the 5 × 4 snail, [[1,2,3,4]], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
