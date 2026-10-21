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
            'message' => "Read the problem statement above.\nWhat do you need first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The total length n', 'next' => 's2'],
                ['label' => 'Nothing; split as you walk', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Part sizes depend on n.\nStep back to when you skipped counting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which parts get an extra node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last n % k', 'next' => 'wrong_b'],
                ['label' => 'The first n % k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Earlier parts must be at least as long as later ones.\nStep back to when you gave extras to the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k > n. What are the extra parts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'null', 'next' => 'success'],
                ['label' => 'Empty nodes with value 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A part with no nodes is null.\nStep back to when you created nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + k). [1,2,3], k = 5 → [[1],[2],[3],[],[]]. [1..10], k = 3 → sizes 4, 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
