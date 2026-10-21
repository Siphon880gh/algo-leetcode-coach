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
            'message' => "Problem: rows and cols up to 2e4; up to 100 words, each 1 to 10 letters. Write the sentence in order, one space between words, never splitting a word across lines. How many full sentences fit? [hello, world] on 2×8 → 1. [a, bcd, e] on 3×6 → 2. [i, had, apple, pie] on 4×5 → 1. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Place word by word, row by row, on a grid', 'next' => 'wrong_grid'],
                ['label' => 'Join words with a trailing space into s; move a cursor on repeating s', 'next' => 'cursor'],
            ],
        ],
        'wrong_grid' => [
            'message' => "You are wrong here. Word-by-word placement can take rows × cols steps when words are short: 2e4 × 2e4 = 4e8. That is too slow.\nStep back to when you simulated every word on the screen.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'cursor' => [
            'message' => "s = words joined by spaces plus one trailing space, length m. cur starts at 0. Each row: cur += cols.\nWhat do you check after the jump?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'If s[cur % m] is a space, cur += 1. Else back up while s[(cur − 1) % m] is not a space', 'next' => 'fix'],
                ['label' => 'Nothing. Keep the jump even if it lands inside a word', 'next' => 'wrong_split'],
            ],
        ],
        'wrong_split' => [
            'message' => "You are wrong. Landing inside a word means that word was cut across lines, which is not allowed. Back up to the start of that word so it moves to the next row.\nStep back to when you skipped the fix-up after the jump.",
            'outcome' => 'wrong',
            'rewind_to' => 'cursor',
            'choices' => [],
        ],
        'fix' => [
            'message' => "Landing on a space means the row ended exactly at a word boundary, so that space is used up. Landing inside a word means back up to the character after the last space. After all rows, cur // m is the answer. Time O(rows × max word length). Text Justification (68) pads spaces inside a line instead.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Trailing-space join, jump cols, fix the boundary, return cur // m. Not 68', 'next' => 'success'],
                ['label' => 'Drop the trailing space from s to save a character', 'next' => 'wrong_space'],
            ],
        ],
        'wrong_space' => [
            'message' => "You are wrong. The trailing space is the gap between the last word of one sentence and the first word of the next. Without it, m is off by one and cur // m miscounts.\nStep back to when you dropped the trailing space.",
            'outcome' => 'wrong',
            'rewind_to' => 'fix',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Join with a trailing space, jump cols per row, consume a landed space or back up out of a split word, return cur // m. [hello, world] on 2×8 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
