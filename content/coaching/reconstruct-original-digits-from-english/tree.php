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
                ['label' => 'Count each letter, then use letters that belong to only one digit word', 'next' => 's2'],
                ['label' => 'Search s for whole words like "zero" and remove them, or backtrack', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The letters are shuffled, so whole words never appear in order, and backtracking over 1e5 letters is far too slow.\nStep back to when you searched for whole words.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which letters only appear in one word?\nPick the first wave.",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'o → one and i → nine, since they appear most', 'next' => 'wrong_b'],
                ['label' => 'z → zero, w → two, u → four, x → six, g → eight', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. o is in zero, one, two, four. i is in five, six, eight, nine. Start with them and you cannot tell which word used the letter.\nStep back to when you started from shared letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Second wave: h is in three and eight, so threes = h − eights. f is in four and five. s is in six and seven. Third wave: o leftover is one, i leftover is nine. O(n) time, O(1) space.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Evens by unique letters, then 3, 5, 7, then 1, 9. Emit 0 to 9', 'next' => 'success'],
                ['label' => 'Count three straight from h without subtracting eights', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each count must subtract the digits already pinned. h alone over-counts three by the number of eights.\nStep back to when you used a shared letter without subtracting.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Unique letters first, then subtract to peel off the shared ones. \"owoztneoer\" → \"012\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
