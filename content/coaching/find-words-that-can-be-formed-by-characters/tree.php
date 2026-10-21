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
            'message' => "Read the problem statement above.\nCheck only that each letter exists in chars?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare counts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A word may need a letter twice.\nStep back to when you checked existence.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After a good word, reduce the chars budget?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: each word is checked alone', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The words do not share the letters.\nStep back to when you reduced the budget.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Add what for a good word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its length', 'next' => 'success'],
                ['label' => '1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer is the sum of lengths.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total letters). [\"cat\",\"bt\",\"hat\",\"tree\"], \"atach\" → 6. [\"hello\",\"world\",\"leetcode\"], \"welldonehoneyr\" → 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
