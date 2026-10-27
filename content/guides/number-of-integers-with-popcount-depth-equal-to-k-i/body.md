## Bits

1. k = 0: only x = 1, so return 1.
2. For each c in 1 … 60 with depth(c) = k − 1: add count(n, c), the numbers in [1, n] with c set bits (walk n’s bits; at each 1, add C(remaining, c − ones so far)).
3. For k = 1, subtract 1: x = 1 has one set bit but depth 0.

Examples → 2, 3. Checked against direct counting for n < 600 and every k.

Forgetting to remove x = 1 when k = 1: example 1 → 3 instead of 2.

Time: O(log² n)  
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
