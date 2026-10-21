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
                ['label' => 'Two pointers: read i finds each run, write k fills the answer', 'next' => 's2'],
                ['label' => 'Build a new compressed string and copy it back', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A new string uses O(n) extra memory; the task asks for in-place with O(1) extra.\nStep back to when you built a new string.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "From i, move j while chars[j] == chars[i].\nWhat do you write?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'chars[k] = chars[i] and always write the count', 'next' => 'wrong_b'],
                ['label' => 'chars[k] = chars[i]; if j − i > 1, write each digit of j − i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A run of length 1 writes only the character. Writing \"a1\" makes the output longer than the input.\nStep back to when you wrote a count of 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Writing never passes reading: a run of length L >= 2 takes 1 + digits(L) <= L slots. O(n) time, O(1) space. Count and Say (38) builds a new string.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Char, then count digits only if > 1, one per slot. Not 38', 'next' => 'success'],
                ['label' => 'Write a two-digit count into one slot', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One slot holds one character. Writing 12 as a single slot is not a character.\nStep back to when you wrote the count in one slot.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Read each run, write the char, then each digit of the count when it is more than 1. [a,a,b,b,c,c,c] → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
