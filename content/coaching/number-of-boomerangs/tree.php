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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fix the center i, then group the other points by distance to i', 'next' => 's2'],
                ['label' => 'Try every triple (i, j, k) and compare distances', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. All triples is O(n³), about 1.25e8 for n = 500, and it repeats the same distance work.\nStep back to when you tried every triple.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For center i, build a map: distance → how many points.\nWhich key do you use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The real distance with sqrt', 'next' => 'wrong_b'],
                ['label' => 'Squared distance dx² + dy² (an exact integer)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. sqrt gives floating-point values, and equal distances can come out slightly different.\nStep back to when you took the square root.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Max squared distance is 2 × (2e4)² = 8e8, which fits in 32 bits. O(n²) time, O(n) space per center.\nHow many boomerangs does a group of c points give?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c × (c − 1) ordered pairs', 'next' => 'success'],
                ['label' => 'c × (c − 1) / 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Order matters: (i, j, k) and (i, k, j) are different. c(c − 1) / 2 counts each unordered pair once and halves the answer.\nStep back to when you divided by 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Fix the center, count squared distances, add c(c − 1) per group. [[0,0],[1,0],[2,0]] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
