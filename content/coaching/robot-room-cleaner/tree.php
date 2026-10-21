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
            'message' => "Problem: a robot in an unknown grid. move() returns false at walls. turnLeft/turnRight turn 90°. clean() cleans. Clean every reachable cell. You do not know the start or the map. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Your own coordinates: start (0, 0), facing up, with a visited set', 'next' => 's2'],
                ['label' => 'Read the grid and BFS from the start', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You cannot read the grid; only the robot API exists. A BFS also needs to teleport between cells.\nStep back to when you planned with the map.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dfs(x, y, d) cleans and tries 4 directions.\nAfter returning from a child, how does the robot come back?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just return from the recursive call', 'next' => 'wrong_b'],
                ['label' => 'turnRight ×2, move, turnRight ×2 to face the same way again', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The recursion ends, but the robot is still in the child cell. The code and the robot disagree.\nStep back to when you only returned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Turn right after each direction, so after 4 tries the robot faces d again. Each cell is entered once. O(cells) moves.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Relative coords, DFS, explicit go-back. Not 490', 'next' => 'success'],
                ['label' => 'Always back up after trying a direction', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. If move() fails, the robot did not move. Backing up would leave the grid model wrong.\nStep back to when you backed up after a failed move.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. DFS with your own coordinates and an explicit move back. Every reachable cell gets cleaned.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
