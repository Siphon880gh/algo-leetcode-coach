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
            'message' => "Read the problem statement above.\nOrder of one number’s digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Most significant first', 'next' => 's2'],
                ['label' => 'As mod 10 produces them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. mod 10 yields them backwards; Example 1 → [3,1,5,2,3,8,7,7] instead of [1,3,2,5,8,3,7,7].\nStep back to when you skipped reversing.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order across numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted', 'next' => 'wrong_b'],
                ['label' => 'As in nums', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The output keeps positions; Example 1 → [1,2,3,3,5,7,7,8].\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total digits). Examples → [1,3,2,5,8,3,7,7], [7,1,3,9].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
