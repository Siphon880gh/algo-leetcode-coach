## Comparator

1. Return `[...arr].sort((a, b) => fn(a) − fn(b))`.

Examples → [1, 2, 3, 4, 5], [{x: −1}, {x: 0}, {x: 1}], [[10, 1], [5, 2], [3, 4]]. Checked in Node.

The default sort compares strings: [10, 9, 1] → [1, 10, 9]. A comparator must return a number; returning fn(a) > fn(b) gives true or false, and in Node [2, 1] stays [2, 1].

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
