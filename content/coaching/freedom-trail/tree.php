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
                ['label' => 'DP: f[i][j] = steps after key[i] spelled at ring position j', 'next' => 's2'],
                ['label' => 'Greedy: rotate to the nearest copy each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The nearest copy of a letter can leave you far from the next letter. Only a DP over all copies is safe.\nStep back to when you chose the nearest copy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "From position k to j on a ring of n.\nDistance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|j − k|', 'next' => 'wrong_b'],
                ['label' => 'min(|j − k|, n − |j − k|)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The ring wraps; going the other way can be shorter.\nStep back to when you used |j − k| only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "f[i][j] = min over k of f[i − 1][k] + dist(k, j) + 1, only for j holding key[i] and k holding key[i − 1]. Start from position 0. Answer min f[m − 1][j]. O(m n²).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Position DP, circular distance, + 1 per press', 'next' => 'success'],
                ['label' => 'Count only rotations', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each key character needs a press. Without + 1 per character, \"gd\" would be 2, not 4.\nStep back to when you skipped the press.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. DP over copies, wrap distance, and a press per letter. \"godding\", \"gd\" → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
