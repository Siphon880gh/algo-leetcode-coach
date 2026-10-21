## Left part, then right removals

1. `pre = 0`, `best = n`.
2. For each `i`: `pre = min(pre + 2·[s[i] = '1'], i + 1)`; `best = min(best, pre + n − 1 − i)`.
3. Return `best`.

Examples → 5, 2. Checked against every (left count, right count) split on 500 random strings.

Any plan removes a prefix from the left, a suffix from the right, and pays 2 for each illegal car in between. The DP picks the best prefix plus middle for each boundary.

Time: O(n)  
Space: O(1)

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
