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
            'message' => "Read the problem statement above.\nWhat is the best rearrangement of 102?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '201', 'next' => 'wrong_a'],
                ['label' => '210, digits in descending order', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Descending digits make the largest number: 2, 1, 0 gives 210.\nStep back to when you chose 201.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Example 2 with k = 2. Which numbers do you rearrange?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '102 and 14, the largest gains', 'next' => 'success'],
                ['label' => '102 and 90, the largest numbers', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 90 gains nothing while 14 gains 27. Picking the largest numbers gives 314 instead of 341.\nStep back to when you ranked by size.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sort by gain and take the top k. O(n log n). Examples give 366 and 341.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
