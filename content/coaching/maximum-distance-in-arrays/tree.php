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
            'message' => "Read the problem statement above.\nAnswer max over everything minus min over everything?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the two values must come from different arrays', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The global max and min can sit in the same array, which is not allowed.\nStep back to when you used the global extremes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which values of each array matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every value', 'next' => 'wrong_b'],
                ['label' => 'Only its first and last: the arrays are sorted', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Inner values are never an array's smallest or largest.\nStep back to when you scanned whole arrays.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "For each array, in what order do you work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare with the running min and max first, then update them', 'next' => 'success'],
                ['label' => 'Update the running min and max first, then compare', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Updating first could pair the array with itself.\nStep back to when you updated first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Running min and max from earlier arrays only: O(m) time, O(1) space. [[1,2,3],[4,5],[1,2,3]] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
