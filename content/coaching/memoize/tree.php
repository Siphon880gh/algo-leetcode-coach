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
            'message' => "Read the problem statement above.\nIs the result cached?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cache.has(key)', 'next' => 's2'],
                ['label' => 'cache.get(key) is truthy', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A cached 0 looks missing; sum(0, 0) twice → 2 calls instead of 1.\nStep back to when you tested truthiness.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Key for (3, 2) and (2, 3)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort the arguments first', 'next' => 'wrong_b'],
                ['label' => 'Different keys, in order', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement requires separate calls; (3, 2) then (2, 3) → 1 call instead of 2.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(arguments) per call. Examples → [4,4,1,3,2], [2,6,2,2,6,2], [8,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
