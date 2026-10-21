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
            'message' => "Read the problem statement above.\nWhat does a pair (a 1 in img1, a 1 in img2) tell you?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The shift that would put one on the other', 'next' => 's2'],
                ['label' => 'Nothing useful', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each such pair votes for exactly one shift vector.\nStep back to when you ignored the pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of pairs', 'next' => 'wrong_b'],
                ['label' => 'The highest vote count over all shift vectors', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The pairs are spread over many different shifts.\nStep back to when you counted every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Key the vote counter by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(dr, dc), or a single number with an offset per axis', 'next' => 'success'],
                ['label' => 'dr + dc', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Different shifts collide, e.g. (1, 0) and (0, 1).\nStep back to when you summed the components.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(a · b) for a and b ones. img1 = [[1,1,0],[0,1,0],[0,1,0]], img2 = [[0,0,0],[0,1,1],[0,0,1]] → 3. [[1]], [[1]] → 1. [[0]], [[0]] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
