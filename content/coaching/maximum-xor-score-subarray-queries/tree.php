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
            'message' => "Read the problem statement above.\nScore of nums[i..j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's[i][j − 1] XOR s[i + 1][j]', 'next' => 's2'],
                ['label' => 'Plain XOR of the subarray', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [14, 60, 63] instead of [12, 60, 60].\nStep back to when you used the plain XOR.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "best[i][j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just s[i][j]', 'next' => 'wrong_b'],
                ['label' => 'Max with best[i][j − 1] and best[i + 1][j]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Queries ask about any subarray inside: example 1 → [6, 60, 27].\nStep back to when you used s[i][j] only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² + q). Examples → [12, 60, 60], [7, 14, 11, 14, 5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
