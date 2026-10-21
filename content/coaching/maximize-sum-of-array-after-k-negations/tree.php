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
            'message' => "Read the problem statement above.\nWhich value do you flip first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The most negative', 'next' => 's2'],
                ['label' => 'The largest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Flipping a positive lowers the sum.\nStep back to when you flipped the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Negatives run out with k left and even. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Flip the smallest again', 'next' => 'wrong_b'],
                ['label' => 'Stop; pairs of flips cancel', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An even number of flips on one value changes nothing.\nStep back to when you flipped again.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k left is odd. Which value takes the flip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest absolute value', 'next' => 'success'],
                ['label' => 'The last flipped value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It may not be the smallest now.\nStep back to when you picked the last flipped value.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [4,2,3], k = 1 → 5. [3,−1,0,2], k = 3 → 6. [2,−3,−1,5,−4], k = 2 → 13.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
