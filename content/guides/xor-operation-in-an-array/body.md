## Direct loop

1. `r = 0`; for `i` in 0..n−1: `r ^= start + 2 * i`.

n = 5, start = 0 → 0^2^4^6^8 = 8. n = 4, start = 3 → 3^5^7^9 = 8.

For O(1): factor out the shared low bit, use the 0..x XOR pattern (x, 1, x+1, 0 by x mod 4) on start/2 + i, shift left, and restore the low bit when n and start are both odd. The loop is enough for n ≤ 1000.

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
