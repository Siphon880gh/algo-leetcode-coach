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
            'message' => "Read the problem statement above.\nExample 2: replace every 1 with 2. Which pairs turn equal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the pairs written (1, 2) left to right', 'next' => 'wrong_a'],
                ['label' => 'All four, each holds a 1 and a 2', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. (2, 1) also becomes (2, 2). Counting ordered pairs gives 2 instead of 4.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Can a replacement break a pair that is already equal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, so subtract those pairs', 'next' => 'wrong_b'],
                ['label' => 'No, both ends change together', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An equal pair holds the same value twice, so a replacement changes both ends and it stays equal.\nStep back to when you subtracted them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Equal pairs plus the top unordered pair count. O(n). Examples give 2, 4 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
