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
            'message' => "Read the problem statement above.\nHalve which label?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The larger one', 'next' => 's2'],
                ['label' => 'Always a', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. a can pass the meeting point; query [2,3] then never meets.\nStep back to when you always moved a.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cycle length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Steps', 'next' => 'wrong_b'],
                ['label' => 'Steps + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The added edge is part of the cycle; Example 1 → [3,4,2] instead of [4,5,3].\nStep back to when you dropped the +1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → [4,5,3], [2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
