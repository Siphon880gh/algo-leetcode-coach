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
            'message' => "Problem: Boxes are pushed into a row of rooms from either the left or the right end; a box stops before a lower room, and boxes cannot be stacked. Return the maximum number of boxes placed. For instance, boxes [1,2,2,3,4] with rooms [3,4,1,2] → 4. (Restated from memory; limits and examples may differ slightly.)\nEffective height of a room?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(min from left, min from right)', 'next' => 's2'],
                ['label' => 'Its own height', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A lower room on the way blocks the box.\nStep back to when you used the raw height.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fill order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Biggest boxes first into the tallest raw rooms', 'next' => 'wrong_b'],
                ['label' => 'Sort both, two pointers', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Raw heights ignore blocking.\nStep back to when you used raw rooms.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Box too tall for this room?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Advance the room only', 'next' => 'success'],
                ['label' => 'Skip the box', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A taller room later may fit it.\nStep back to when you skipped the box.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + m log m). The example → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
