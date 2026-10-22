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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n²) DP with Hamming checks', 'next' => 's2'],
                ['label' => 'The greedy from part I', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It ignores the distance rule; [ab, cd, ad] with groups [1, 2, 3] → all three, but ab and cd differ in 2 letters.\nStep back to when you reused part I.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rebuild from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last index', 'next' => 'wrong_b'],
                ['label' => 'The index with the largest dp', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [ab, ac, zz] with groups [1, 2, 3] → [zz] instead of [ab, ac].\nStep back to when you started from the last index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² L). Examples → a longest answer such as [bab, cab]; [a, b, c, d].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
