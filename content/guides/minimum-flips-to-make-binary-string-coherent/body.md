## Shapes

1. ones = count of 1.
2. At most one 1: max(0, ones − 1).
3. All 1s: n − ones.
4. 1 0…0 1 (n ≥ 2): (s[0] ≠ 1) + (s[n − 1] ≠ 1) + ones in s[1 … n − 2].
5. Return the minimum.

With two or more 1s, any 0 with two 1s on one side forms a forbidden pattern, which leaves only the last two shapes.

Examples → 1, 1, 0. Checked against every flip set for all strings up to length 8.

Dropping the all-1s shape: constructed check (run in code) "1111" → 2 instead of 0.

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
