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
            'message' => "Read the problem statement above.\nEach ? gets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The currently rarest letter', 'next' => 's2'],
                ['label' => 'Always a', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → aaa (value 3) instead of abc (value 0).\nStep back to when you always used a.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Place the picks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In pick order', 'next' => 'wrong_b'],
                ['label' => 'Sorted, left to right', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. abcdefghijklmnopqrstuvwxy?? ends in za instead of az.\nStep back to when you kept pick order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log 26 + q log q). Examples → abc, abac.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
