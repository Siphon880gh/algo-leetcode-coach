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
            'message' => "Read the problem statement above.\nConvert num to an integer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it can have 10⁴ digits', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That overflows fixed-width integers.\nStep back to when you converted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k has more digits than num. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop at the first digit', 'next' => 'wrong_b'],
                ['label' => 'Keep going while k > 0 after the digits run out', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The higher digits of k still need to be written.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "In which order are digits produced?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lowest first, so reverse at the end', 'next' => 'success'],
                ['label' => 'Highest first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You start from the last digit.\nStep back to when you skipped the reverse.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(max(n, log k)). [1,2,0,0], k = 34 → [1,2,3,4]. [2,7,4], k = 181 → [4,5,5]. [2,1,5], k = 806 → [1,0,2,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
