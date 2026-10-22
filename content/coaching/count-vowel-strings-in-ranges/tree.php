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
            'message' => "Read the problem statement above.\nMark a word when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First and last letters are vowels', 'next' => 's2'],
                ['label' => 'Its first letter is a vowel', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The last letter matters too; words = ['ab'], queries = [[0,0]] → [1] instead of [0].\nStep back to when you checked only the first letter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer for [l, r]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'pre[r] − pre[l]', 'next' => 'wrong_b'],
                ['label' => 'pre[r + 1] − pre[l]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That drops word r; Example 1 → [1,2,0] instead of [2,3,0].\nStep back to when you used pre[r].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). Examples → [2,3,0], [3,2,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
