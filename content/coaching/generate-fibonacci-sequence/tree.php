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
            'message' => "Read the problem statement above.\nYield or shift first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yield a, then shift', 'next' => 's2'],
                ['label' => 'Shift, then yield a', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The sequence starts at 0; callCount = 5 → [1,1,2,3,5] instead of [0,1,1,2,3].\nStep back to when you shifted first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update the pair how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a = b, then b = a + b', 'next' => 'wrong_b'],
                ['label' => '[a, b] = [b, a + b]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. b then adds the new a to itself; callCount = 5 → [0,1,2,4,8] instead of [0,1,1,2,3].\nStep back to when you updated one at a time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Examples → [0,1,1,2,3], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
