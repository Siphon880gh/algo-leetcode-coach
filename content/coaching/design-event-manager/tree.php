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
            'message' => "Read the problem statement above.\nEqual priorities?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller id first', 'next' => 's2'],
                ['label' => 'Larger id first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [null, 5, null, 9, 2] instead of [null, 2, null, 5, 9].\nStep back to when you let larger ids win.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Popped entry is stale?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return it', 'next' => 'wrong_b'],
                ['label' => 'Skip it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): example 1 plus one more pollHighest → 9 instead of −1.\nStep back to when you trusted every heap entry.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log (e + q)) per call. Examples → [null, 2, null, 5, 9], [null, 7, 4, −1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
