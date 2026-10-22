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
                ['label' => 'Larger taskId first', 'next' => 's2'],
                ['label' => 'Smaller taskId first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Tasks (user 1, 101, 10) and (user 2, 102, 10) → execTop 1 instead of 2.\nStep back to when you took the smaller id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Popped entry?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Trust it', 'next' => 'wrong_b'],
                ['label' => 'Check it against the map', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The example → 2 instead of 3 at the first execTop.\nStep back to when you trusted the heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log N) amortized. Example → [null, null, null, 3, null, null, 5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
