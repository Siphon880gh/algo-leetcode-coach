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
            'message' => "Read the problem statement above.\nThe new node holds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'gcd of the two values', 'next' => 's2'],
                ['label' => 'The smaller value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is not the gcd; example 1 → [18, 6, 6, 6, 10, 3, 3].\nStep back to when you used the minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After inserting, move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One step', 'next' => 'wrong_b'],
                ['label' => 'Two steps', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You land on the new node; in code it was still inserting after 100 steps.\nStep back to when you moved one step.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log V). Examples → [18, 6, 6, 2, 10, 1, 3], [7].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
