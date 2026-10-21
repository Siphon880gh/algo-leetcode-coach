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
            'message' => "Read the problem statement above.\nCount paths that stay on the board?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Track probabilities directly: each move has weight 1/8', 'next' => 's2'],
                ['label' => 'Count paths, then divide by 8^k at the end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That works mathematically, but path counts reach 8¹⁰⁰ and overflow; probabilities stay in [0, 1].\nStep back to when you counted paths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A move leaves the board. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it on the edge cell', 'next' => 'wrong_b'],
                ['label' => 'Drop that mass; it never returns', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Once the knight leaves the board, it stays off.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Update the board in place?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: build a new board each step', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In place mixes step m with step m + 1.\nStep back to when you updated in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. k rounds over n² cells: O(k · n²). n = 3, k = 2, (0, 0) → 0.0625. n = 1, k = 0 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
