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
            'message' => "Read the problem statement above.\nAre the three largest values always best?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not always: two negatives can beat them', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [-10,-10,1,3,2] → 300 from −10 · −10 · 3, but 3 · 2 · 1 = 6.\nStep back to when you took the top three.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which two candidates do you compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max1 · max2 · max3 and min1 · min2 · min3', 'next' => 'wrong_b'],
                ['label' => 'max1 · max2 · max3 and min1 · min2 · max1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Three negatives give a negative product; the two smallest need the largest value.\nStep back to when you multiplied three minimums.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can you avoid sorting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: one pass tracking three maxima and two minima', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Five running values are enough, which makes it O(n).\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. max(top three, two smallest × largest): O(n) with one pass. [-10,-10,1,3,2] → 300.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
