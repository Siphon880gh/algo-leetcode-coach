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
            'message' => "Read the problem statement above.\nSearch outward from each index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: two linear sweeps cover both sides', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That can be O(n²).\nStep back to when you searched from each index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The left sweep has not seen c yet. Distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'A large sentinel, so the right sweep decides', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With no c to the left, that side gives no answer.\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do the sweeps combine?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the minimum at each index', 'next' => 'success'],
                ['label' => 'Take the average', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The nearest occurrence on either side wins.\nStep back to when you averaged.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). s \"loveleetcode\", c \"e\" → [3,2,1,0,1,0,0,1,2,2,1,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
