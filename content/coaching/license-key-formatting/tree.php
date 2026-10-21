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
                ['label' => 'Remove dashes and uppercase, then regroup', 'next' => 's2'],
                ['label' => 'Keep the original groups and just uppercase them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The original dashes mark the old groups, which do not match the new size.\nStep back to when you kept the old dashes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\"5F3Z2E9W\" with k = 4.\nFrom which end do you group?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From the left, with the leftover at the end', 'next' => 'wrong_b'],
                ['label' => 'From the right: a dash after every k characters, then reverse', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Grouping from the left makes the last group short. Only the first group may be short.\nStep back to when you grouped from the left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Forward version: the first group has m % k characters, or k if that is 0. Skip any leading dash. O(n) time.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strip dashes, uppercase, group from the right, handle all-dash input', 'next' => 'success'],
                ['label' => 'Return "-" when there are no characters', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. If s is all dashes, there are no characters and the answer is \"\", not \"-\".\nStep back to when you returned a dash.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Strip dashes, uppercase, group by k from the right. \"2-5g-3-J\", 2 → \"2-5G-3J\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
