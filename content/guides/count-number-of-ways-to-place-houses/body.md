## Independent sides

1. `a, b = 1, 1`; repeat `n` times: `a, b = b, (a + b) mod M`.
2. Return `b² mod M`.

Examples → 4, 9.

On one side, the last plot is empty (any arrangement of n − 1 plots) or has a house (plot n − 1 empty, any arrangement of n − 2), which is the Fibonacci recurrence with 2 ways for n = 1. Houses opposite each other are allowed, so the two sides multiply. Square after reducing, in 64-bit.

Time: O(n)  
Space: O(1)

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
