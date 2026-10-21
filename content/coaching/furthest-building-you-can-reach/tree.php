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
            'message' => "Read the problem statement above.\nUse bricks first, ladders when out?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: ladders go to the largest climbs', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Bricks would be wasted on big climbs.\nStep back to when you used bricks first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heap type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Max-heap of all climbs', 'next' => 'wrong_b'],
                ['label' => 'Min-heap of ladder climbs', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You need the smallest ladder climb to swap to bricks.\nStep back to when you used a max-heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Down or flat step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Free', 'next' => 'success'],
                ['label' => 'Costs a brick', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only climbs cost.\nStep back to when you charged it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log L). Examples → 4, 7, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
