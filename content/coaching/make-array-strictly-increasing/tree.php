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
            'message' => "Read the problem statement above.\nDecide greedily at each index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep both options in a DP map', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Keeping or replacing can each be right later.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Replacement for last value prev?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any arr2 value greater than prev', 'next' => 'wrong_b'],
                ['label' => 'Smallest arr2 value greater than prev', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A smaller last value never hurts later steps.\nStep back to when you took any value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Map becomes empty. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 'success'],
                ['label' => 'Keep going', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No state can continue.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m log m). [1,5,3,6,7] with [1,3,2,4] → 1, with [4,3,1] → 2, with [1,6,3,3] → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
