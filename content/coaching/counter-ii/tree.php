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
            'message' => "Read the problem statement above.\nreset sets the value to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'init', 'next' => 's2'],
                ['label' => '0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The counter restarts at its own start; Example 1 → [6,0,−1] instead of [6,5,4].\nStep back to when you reset to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "increment returns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The old value: cur++', 'next' => 'wrong_b'],
                ['label' => 'The new value: ++cur', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The result must include the change; with post-increment and post-decrement, Example 1 → [5,5,5] instead of [6,5,4].\nStep back to when you used the old value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Examples → [6,5,4], [1,2,1,0,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
