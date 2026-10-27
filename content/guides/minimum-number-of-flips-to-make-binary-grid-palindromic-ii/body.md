## Fours, pairs, centre

1. For each group of four mirror cells add min(ones, 4 − ones).
2. If m and n are odd, the centre must be 0: add its value.
3. Middle pairs: d = mismatched pairs, p = ones in matched pairs. If d > 0 add d (each can become 00 or 11 to fix p mod 4); else add 2 if p mod 4 ≠ 0.

Examples → 3, 2, 2. Checked against trying every target grid on 150 random grids up to 12 cells.

Skipping the mod-4 fix: example 3 → 0 instead of 2.

Time: O(m n)  
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
