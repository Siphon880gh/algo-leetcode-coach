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
            'message' => "Read the problem statement above.\nProcess each line on its own?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a block comment can span lines, so the in-block flag carries over', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. /* on one line can close on a later one.\nStep back to when you reset per line.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You see /*. How far do you advance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One character', 'next' => 'wrong_b'],
                ['label' => 'Two characters, so "/*/" does not also close the comment', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Advancing one would read */ in \"/*/\" and close immediately.\nStep back to when you advanced one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A line ends inside a block comment. What happens to the buffer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it; code before /* joins code after */', 'next' => 'success'],
                ['label' => 'Emit it as a line', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. \"a/*x\", \"y*/b\" must become one line \"ab\".\nStep back to when you emitted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass over all characters: O(total length). [\"a/*comment\", \"line\", \"more_comment*/b\"] → [\"ab\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
