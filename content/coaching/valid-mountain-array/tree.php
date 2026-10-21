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
            'message' => "Read the problem statement above.\nThe climb ends at index 0. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false: there is no rise', 'next' => 's2'],
                ['label' => 'Keep going', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A mountain needs a rise first.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The climb ends at the last index. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return true', 'next' => 'wrong_b'],
                ['label' => 'Return false: there is no fall', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A mountain needs a fall too.\nStep back to when you returned true.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two equal neighbors on a slope?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They stop the walk, so the array fails', 'next' => 'success'],
                ['label' => 'They are allowed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The slopes must be strict.\nStep back to when you allowed a plateau.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2,1] → false. [3,5,5] → false. [0,3,2,1] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
