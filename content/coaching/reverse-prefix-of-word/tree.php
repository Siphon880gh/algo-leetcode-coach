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
            'message' => "Read the problem statement above.\nWhich occurrence ends the segment?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first', 'next' => 's2'],
                ['label' => 'The last', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. abcdefd reverses up to index 3, not 6.\nStep back to when you used the last.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is ch itself reversed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, stop before it', 'next' => 'wrong_b'],
                ['label' => 'Yes, the end is inclusive', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. abcdefd → dcbaefd moves d to the front.\nStep back to when you excluded ch.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "ch not in word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return word unchanged', 'next' => 'success'],
                ['label' => 'Reverse the whole word', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Nothing is reversed; abcd → abcd.\nStep back to when you reversed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → dcbaefd, zxyxxe, abcd.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
