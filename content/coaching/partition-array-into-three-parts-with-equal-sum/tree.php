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
            'message' => "Read the problem statement above.\ntotal % 3 != 0. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'false', 'next' => 's2'],
                ['label' => 'Keep scanning', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Three equal integers must add to a multiple of 3.\nStep back to when you kept scanning.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The running sum hits total / 3. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the sum going', 'next' => 'wrong_b'],
                ['label' => 'Count a part and reset the sum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The next part must start from zero.\nStep back to when you kept the sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You counted 4 parts. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'true', 'next' => 'success'],
                ['label' => 'false', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With a total of 0, extra parts merge into the last.\nStep back to when you required exactly 3.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [0,2,1,−6,6,−7,9,1,2,0,1] → true. [0,2,1,−6,6,7,9,−1,2,0,1] → false. [3,3,6,5,−2,2,5,1,−9,4] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
