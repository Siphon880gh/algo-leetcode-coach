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
            'message' => "Read the problem statement above.\naddBack(x) with x ≥ cur?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it: x is still in the set', 'next' => 's2'],
                ['label' => 'Push it onto the heap', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The number exists twice; the Example → 2, 1, 2 instead of 1, 2, 3.\nStep back to when you pushed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "addBack(x) already in the heap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push it again', 'next' => 'wrong_b'],
                ['label' => 'Ignore it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. popSmallest, addBack(1), addBack(1), then two pops → 1, 1 instead of 1, 2.\nStep back to when you pushed a duplicate.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "popSmallest takes from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The heap when non-empty, else cur', 'next' => 'success'],
                ['label' => 'Always cur', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Added-back numbers never return; the Example ends 4, 5, 6 instead of 1, 4, 5.\nStep back to when you ignored the heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log k) per call. Example → null, null, 1, 2, 3, null, 1, 4, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
