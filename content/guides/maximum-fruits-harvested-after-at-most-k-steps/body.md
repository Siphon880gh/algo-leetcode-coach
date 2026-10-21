## Cost of an interval

1. For fruit indices `l … r`: `L = s − min(pos[l], s)` and `Rr = max(pos[r], s) − s` (each 0 if that side is not needed).
2. Steps `= min(2L + Rr, L + 2Rr)`: go to one end first, come back, then go to the other.
3. Move `r` right (stop past `s + k`); while the cost exceeds `k`, `l += 1`; track the best window sum.

Examples → 9, 14, 0. Checked against trying every left distance on random inputs.

Turning around more than once never helps, so only those two orders matter. As `r` grows, the smallest feasible `l` never moves left, which makes the two-pointer sweep valid.

Time: O(n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
