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
            'message' => "Read the problem statement above.\nMerge when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Overlap or touch', 'next' => 's2'],
                ['label' => 'Only overlap', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [[1, 1], [2, 2]] with free [5, 5] → [[1, 1], [2, 2]] instead of [[1, 2]].\nStep back to when you skipped touching intervals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Left piece ends at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'freeStart', 'next' => 'wrong_b'],
                ['label' => 'freeStart − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [[1, 3]] instead of [[1, 2]].\nStep back to when you kept freeStart.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log m). Examples → [[2, 6], [12, 12], [14, 16]], [[1, 2]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
